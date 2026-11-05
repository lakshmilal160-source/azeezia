<?php

namespace App\Http\Controllers;

use App\Models\ConventionCentre;
use App\Models\Faq;
use App\Models\GalleryImage;
use App\Models\Infrastructure;
use App\Models\PageBanner;
use App\Models\Service;
use App\Models\Testimonial;
use App\Models\UpcomingProject;
use App\Models\WhatWeOffer;
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

    public function gallery()
    {
        $banner = PageBanner::where('page_slug', 'gallery')->first();

    }

    public function contact()
    {
        $banner = PageBanner::where('page_slug', 'contact')->first();

    }

    public function resort()
    {
        $banner = PageBanner::where('page_slug', 'resorts')->first();

    }

    public function organicFarm()
    {
        $banner = PageBanner::where('page_slug', 'organic-farms')->first();

    }
}
