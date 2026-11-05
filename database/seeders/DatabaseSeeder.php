<?php

namespace Database\Seeders;

use App\Models\PageSeo;
use App\Models\SiteSetting;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            AdminSeeder::class,
        ]);

        // 2. Default SEO Pages
        //     $defaultPages = [
        //         [
        //             'page_key' => 'home',
        //             'meta_title' => 'Azeezia - Convention Centres, Luxury Resorts & Organic Farm',
        //             'meta_description' => 'Welcome to Azeezia. Explore our world-class convention centres, luxury resorts, and sustainable organic farms for your memorable experiences.',
        //             'og_title' => 'Azeezia - Premium Conventions, Resorts & Farms',
        //             'og_description' => 'Book grand halls, relax in serene resorts, and experience farm-fresh tranquility with Azeezia.',
        //             'canonical_url' => url('/'),
        //             'robots' => 'index,follow',
        //         ],
        //         [
        //             'page_key' => 'convention-centres',
        //             'meta_title' => 'Convention Centres & Grand Banquet Halls | Azeezia',
        //             'meta_description' => 'Discover spacious convention halls, dining spaces, and ample parking for grand weddings, exhibitions, and corporate events.',
        //             'og_title' => 'Convention Centres & Grand Banquet Halls | Azeezia',
        //             'og_description' => 'Perfect venues for unforgettable events and weddings.',
        //             'canonical_url' => url('/convention-centres'),
        //             'robots' => 'index,follow',
        //         ],
        //         [
        //             'page_key' => 'resorts',
        //             'meta_title' => 'Luxury Resorts & Villas | Azeezia',
        //             'meta_description' => 'Stay in luxury villas and premium resort rooms nestled in nature. Enjoy modern amenities and serene relaxation.',
        //             'og_title' => 'Luxury Resorts & Villas | Azeezia',
        //             'og_description' => 'Experience tranquility and comfort with our premium stay options.',
        //             'canonical_url' => url('/resorts'),
        //             'robots' => 'index,follow',
        //         ],
        //         [
        //             'page_key' => 'organic-farms',
        //             'meta_title' => 'Organic Farms & Eco-Tourism Experience | Azeezia',
        //             'meta_description' => 'Explore lush green organic farming, agro-tourism activities, and fresh farm produce in scenic natural surroundings.',
        //             'og_title' => 'Organic Farms & Eco-Tourism Experience | Azeezia',
        //             'og_description' => 'Connect with nature and fresh organic agriculture.',
        //             'canonical_url' => url('/organic-farms'),
        //             'robots' => 'index,follow',
        //         ],
        //         [
        //             'page_key' => 'services',
        //             'meta_title' => 'Our Services & Event Solutions | Azeezia',
        //             'meta_description' => 'Comprehensive event management, luxury hospitality, catering, and destination wedding services at Azeezia.',
        //             'og_title' => 'Our Services & Event Solutions | Azeezia',
        //             'og_description' => 'Tailored event and hospitality services for every occasion.',
        //             'canonical_url' => url('/services'),
        //             'robots' => 'index,follow',
        //         ],
        //         [
        //             'page_key' => 'offers',
        //             'meta_title' => 'Exclusive Offers & Packages | Azeezia',
        //             'meta_description' => 'Special deals, holiday packages, and seasonal offers on convention bookings and resort stays.',
        //             'og_title' => 'Exclusive Offers & Packages | Azeezia',
        //             'og_description' => 'Take advantage of limited-time discounts and special packages.',
        //             'canonical_url' => url('/offers'),
        //             'robots' => 'index,follow',
        //         ],
        //         [
        //             'page_key' => 'gallery',
        //             'meta_title' => 'Photo Gallery - Explore Azeezia Venues & Nature',
        //             'meta_description' => 'Browse photos of our convention halls, suites, landscapes, events, and organic farms.',
        //             'og_title' => 'Photo Gallery | Azeezia',
        //             'og_description' => 'See the beauty of our venues and accommodations.',
        //             'canonical_url' => url('/gallery'),
        //             'robots' => 'index,follow',
        //         ],
        //         [
        //             'page_key' => 'contact',
        //             'meta_title' => 'Contact Us - Azeezia Bookings & Enquiries',
        //             'meta_description' => 'Get in touch with our team for reservations, hall bookings, and customized package enquiries.',
        //             'og_title' => 'Contact Us | Azeezia',
        //             'og_description' => 'We are here to assist with your bookings and questions.',
        //             'canonical_url' => url('/contact'),
        //             'robots' => 'index,follow',
        //         ],
        //     ];

        //     foreach ($defaultPages as $page) {
        //         PageSeo::updateOrCreate(['page_key' => $page['page_key']], $page);
        //     }

        //     // 3. Default Site Settings
        //     $defaultSettings = [
        //         'site_name' => 'Azeezia',
        //         'site_tagline' => 'Convention Centres, Luxury Resorts & Organic Farm',
        //         'site_email' => 'info@azeezia.com',
        //         'site_phone' => '+91 98765 43210',
        //         'site_address' => 'Azeezia Complex, Kerala, India',
        //         'meta_description' => 'Premier destination for grand events, luxury hospitality, and serene nature.',
        //         'google_analytics_id' => '',
        //         'google_search_console' => '',
        //         'facebook_url' => 'https://facebook.com',
        //         'instagram_url' => 'https://instagram.com',
        //         'youtube_url' => 'https://youtube.com',
        //     ];

        //     foreach ($defaultSettings as $key => $value) {
        //         SiteSetting::updateOrCreate(['setting_key' => $key], ['setting_value' => $value]);
        //     }
    }
}
