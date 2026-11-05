<?php

namespace App\Http\Controllers;

use App\Mail\EnquiryMail;
use App\Models\ConventionCentre;
use App\Models\Enquiry;
use App\Models\Faq;
use App\Models\GalleryCategory;
use App\Models\GalleryImage;
use App\Models\Infrastructure;
use App\Models\PageBanner;
use App\Models\Resort;
use App\Models\ResortRoomType;
use App\Models\Service;
use App\Models\Testimonial;
use App\Models\UpcomingProject;
use App\Models\WhatWeOffer;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\View\View;

class WebsiteController extends Controller
{
    public function home(): View
    {
        $banner = PageBanner::where('page_slug', 'home')->first();
        $services = Service::where('is_active', 1)->get();
        $conventionFeatures = WhatWeOffer::active()->ordered()->get();
        $testimonials = Testimonial::where('is_active', true)
            ->orderBy('sort_order')
            ->latest('id')
            ->get();
        $gallery = GalleryImage::with('category')
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->latest('id')
            ->get();
        $upcomingProjects = UpcomingProject::active()->ordered()->get();

        return view('frontend.index', compact('banner', 'services', 'conventionFeatures', 'testimonials', 'gallery', 'upcomingProjects'));
    }

    public function about(): View
    {
        $banner = PageBanner::where('page_slug', 'about')->first();
        $faqs = Faq::where('status', true)
            ->orderBy('order')
            ->get();

        return view('frontend.about', compact('banner', 'faqs'));
    }

    public function conventionCenter(): View
    {
        $banner = PageBanner::where('page_slug', 'convention-centres')->first();

        $centre = ConventionCentre::with('images')
            ->where('is_active', true)
            ->first();

        $infrastructures = Infrastructure::active()->ordered()->get();
        $offers = WhatWeOffer::active()->ordered()->get();

        return view('frontend.convention-center', compact('banner', 'centre', 'infrastructures', 'offers'));
    }

    public function gallery(): View
    {
        $banner = PageBanner::where('page_slug', 'gallery')->first();
        $categories = GalleryCategory::active()
            ->ordered()
            ->withCount(['images' => fn ($q) => $q->active()])
            ->get();
        $galleryImages = GalleryImage::with('category')
            ->active()
            ->ordered()
            ->get();

        return view('frontend.gallery', compact('banner', 'categories', 'galleryImages'));
    }

    public function contact(): View
    {
        $banner = PageBanner::where('page_slug', 'contact')->first();
        $conventionContact = ConventionCentre::getContact();
        $resortContact = Resort::getContact();

        return view('frontend.contact', compact('banner', 'conventionContact', 'resortContact'));
    }

    public function resort(): View
    {
        $banner = PageBanner::where('page_slug', 'resorts')->first();
        $resort = Resort::with(['roomTypes' => fn ($q) => $q->active()->ordered()])
            ->where('is_active', true)
            ->first();
        $rooms = ResortRoomType::with('resort')->active()->ordered()->get();

        return view('frontend.resort', compact('banner', 'resort', 'rooms'));
    }

    public function organicFarm(): View
    {
        $banner = PageBanner::where('page_slug', 'organic-farms')->first();

        $galleryImages = GalleryImage::with('category')
            ->whereHas('category', function ($query) {
                $query->whereIn('slug', ['organic-farm', 'organic-farms'])
                    ->orWhere('name', 'like', '%organic%farm%');
            })
            ->active()
            ->ordered()
            ->get();

        return view('frontend.organic-farm', compact('banner', 'galleryImages'));
    }

    public function service(): View
    {
        $banner = PageBanner::where('page_slug', 'services')->first();
        $services = Service::active()->ordered()->get();

        return view('frontend.services', compact('banner', 'services'));
    }

    /**
     * Store a new customer contact/event enquiry and send notification email.
     */
    public function storeContact(Request $request): JsonResponse|RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'max:30'],
            'email' => ['required', 'email', 'max:255'],
            'details' => ['nullable', 'string', 'max:5000'],
            'message' => ['nullable', 'string', 'max:5000'],
            'g-recaptcha-response' => ['required'],
        ], [
            'g-recaptcha-response.required' => 'Please verify that you are not a robot.',
        ]);

        $messageContent = trim($validated['details'] ?? $validated['message'] ?? '');
        if (empty($messageContent)) {
            if ($request->expectsJson() || $request->ajax()) {
                return response()->json([
                    'errors' => ['details' => ['Please provide your event details or message.']],
                ], 422);
            }

            return back()->withErrors(['details' => 'Please provide your event details or message.'])->withInput();
        }

        // Verify Google reCAPTCHA
        $secretKey = config('services.recaptcha.secret_key');
        if (! empty($secretKey)) {
            try {
                $response = Http::withoutVerifying()
                    ->timeout(8)
                    ->asForm()
                    ->post('https://www.google.com/recaptcha/api/siteverify', [
                        'secret' => $secretKey,
                        'response' => $request->input('g-recaptcha-response'),
                        'remoteip' => $request->ip(),
                    ]);

                $result = $response->json();
                if (! ($result['success'] ?? false)) {
                    if ($request->expectsJson() || $request->ajax()) {
                        return response()->json([
                            'errors' => ['captcha' => ['Please verify that you are not a robot.']],
                        ], 422);
                    }

                    return back()->withErrors(['captcha' => 'Please verify that you are not a robot.'])->withInput();
                }
            } catch (\Throwable $e) {
                Log::warning('reCAPTCHA verification warning: '.$e->getMessage());
                if (! app()->environment('local')) {
                    if ($request->expectsJson() || $request->ajax()) {
                        return response()->json([
                            'errors' => ['captcha' => ['Unable to verify reCAPTCHA. Please try again.']],
                        ], 422);
                    }

                    return back()->withErrors(['captcha' => 'Unable to verify reCAPTCHA. Please try again.'])->withInput();
                }
            }
        }

        $enquiry = Enquiry::create([
            'name' => $validated['name'],
            'phone' => $validated['phone'],
            'email' => $validated['email'],
            'subject' => 'Event Enquiry from Website',
            'message' => $messageContent,
            'enquiry_type' => 'general',
            'status' => 'new',
        ]);

        try {
            $recipient = config('mail.from.address', 'admin@azeezia.com');
            Mail::to($recipient)->send(new EnquiryMail($enquiry));
        } catch (\Throwable $e) {
            Log::warning('Customer enquiry notification email failed: '.$e->getMessage());
        }

        if ($request->expectsJson() || $request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Thank you, '.$enquiry->name.'! Your event enquiry has been received. Our team will contact you shortly.',
            ]);
        }

        return back()->with('success', 'Thank you! Your event enquiry has been received. Our team will contact you shortly.');
    }
}
