<?php

namespace Database\Seeders;

use App\Models\Faq;
use App\Models\UpcomingProject;
use Illuminate\Database\Seeder;

class FaqAndUpcomingProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. FAQs
        $faqs = [
            [
                'question' => 'What is the maximum guest capacity of Azeezia Convention Centres?',
                'answer' => 'Our grand convention halls comfortably accommodate from 500 up to 3,000+ guests with dedicated dining spaces, VIP green rooms, and expansive car parking.',
                'order' => 1,
                'status' => true,
            ],
            [
                'question' => 'Can we book resort stays for wedding guests and family gatherings?',
                'answer' => 'Yes, our luxury villas and suites are located adjacent to the venue, offering comfortable accommodations with swimming pool access, garden views, and complimentary breakfast.',
                'order' => 2,
                'status' => true,
            ],
            [
                'question' => 'Are guided tours available for Azeezia Organic Farm?',
                'answer' => 'Yes, we host guided agro-tourism walks, harvest experiences, and fresh organic produce tastings for families, school groups, and visitors.',
                'order' => 3,
                'status' => true,
            ],
            [
                'question' => 'Do you offer in-house catering and event decoration services?',
                'answer' => 'Yes, our culinary team provides multi-cuisine catering (Traditional Kerala Sadya, North Indian, Continental, and Arabic) alongside complete stage decor, sound, and lighting solutions.',
                'order' => 4,
                'status' => true,
            ],
        ];

        foreach ($faqs as $faq) {
            Faq::firstOrCreate(['question' => $faq['question']], $faq);
        }

        // 2. Upcoming Projects (matching user design)
        $projects = [
            [
                'title' => 'Ayurvedic Spa and Wellness Resort',
                'category' => 'WELLNESS RETREAT',
                'subtitle' => 'Upcoming Destination',
                'description' => 'An upcoming destination dedicated to traditional Ayurvedic wellness, relaxation, and rejuvenation in a peaceful natural setting.',
                'status' => 'Upcoming',
                'order' => 1,
                'is_active' => true,
            ],
            [
                'title' => 'Floating Restaurant',
                'category' => 'WATERFRONT DINING',
                'subtitle' => 'Proposed Development',
                'description' => 'A proposed waterfront dining experience combining scenic surroundings, unique ambience, and memorable culinary moments.',
                'status' => 'Proposed',
                'order' => 2,
                'is_active' => true,
            ],
            [
                'title' => 'Boating and Farm Experiences',
                'category' => 'NATURE & TOURISM',
                'subtitle' => 'Upcoming Activities',
                'description' => 'An immersive nature adventure offering serene backwater boating, organic farm walks, and authentic rural interactions.',
                'status' => 'Upcoming',
                'order' => 3,
                'is_active' => true,
            ],
        ];

        foreach ($projects as $project) {
            UpcomingProject::firstOrCreate(['title' => $project['title']], $project);
        }
    }
}
