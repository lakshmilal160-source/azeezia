<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ConventionCentre;
use App\Models\Enquiry;
use App\Models\Faq;
use App\Models\GalleryImage;
use App\Models\Infrastructure;
use App\Models\OrganicFarm;
use App\Models\PageBanner;
use App\Models\Resort;
use App\Models\Service;
use App\Models\Testimonial;
use App\Models\UpcomingProject;
use App\Models\WhatWeOffer;
use Illuminate\View\View;

class DashboardController extends Controller
{
    /**
     * Display the main admin dashboard with operational metrics.
     */
    public function index(): View
    {
        $stats = [
            'centres' => ConventionCentre::count(),
            'infrastructures' => Infrastructure::count(),
            'offers' => WhatWeOffer::count(),
            'resorts' => Resort::count(),
            'farms' => OrganicFarm::count(),
            'services' => Service::count(),
            'testimonials' => Testimonial::count(),
            'gallery_images' => GalleryImage::count(),
            'banners' => PageBanner::count(),
            'faqs' => Faq::count(),
            'projects' => UpcomingProject::count(),
            'enquiries' => Enquiry::count(),
            'new_enquiries' => Enquiry::where('status', 'new')->count(),
        ];

        $recentEnquiries = Enquiry::latest()->take(6)->get();
        $recentCentres = ConventionCentre::withCount('halls')->latest()->take(4)->get();
        $recentResorts = Resort::latest()->take(4)->get();

        return view('Admin.index', compact('stats', 'recentEnquiries', 'recentCentres', 'recentResorts'));
    }
}
