<?php

namespace Database\Seeders;

use App\Models\ConventionCentre;
use App\Models\ConventionCentreOffer;
use App\Models\ConventionHall;
use Illuminate\Database\Seeder;

class ConventionCentreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $centre = ConventionCentre::updateOrCreate(
            ['slug' => 'azeezia-convention-centre'],
            [
                'name' => 'Azeezia Convention Centre',
                'contact_phone' => '+91 94470 12345',
                'email' => 'convention@azeezia.com',
                'address' => 'Civil Line Road, Padivattom, Kochi, Kerala - 682024',
                'location_url' => 'https://maps.google.com/?q=Azeezia+Convention+Centre+Kochi',
                'intro_eyebrow' => 'SERVING THRISSUR & CENTRAL KERALA',
                'short_description' => "At Azeezia, we believe life's most cherished milestones deserve an extraordinary setting. Conceived with a deep reverence for nature and grand architectural hospitality, Azeezia seamlessly unites Kerala's finest  convention facilities with secluded luxury.",
                'description' => 'Azeezia Convention Centre offers a premier venue for grand weddings, high-profile corporate galas, and vibrant stage productions. Nestled in a resort-like green ambiance with 3-road accessibility, the property features a 2,000-seat main auditorium, 5-star dining spaces, and generous car parking.',
                'auditorium_capacity' => 2000,
                'dining_capacity' => 300,
                'vip_lounge_capacity' => 150,
                'car_parking_capacity' => 500,
                'offer_section_heading' => 'What We Offer',
                'offer_watermark_text' => 'WHAT WE OFFER',
                'infrastructure_title' => 'INFRASTRUCTURE & VENUE SPACES',
                'infrastructure_subtitle' => 'Engineered with high-capacity acoustics, luxury nano-marble dining, and flexible configurations for grand weddings and celebrations.',
                'is_active' => true,
            ]
        );

        // Seed "What We Offer" Dynamic Amenities
        $offers = [
            [
                'title' => 'Wedding Celebrations',
                'description' => 'Tailored setups featuring elegant decor, seamless arrangements, and world-class hospitality for unforgettable unions.',
                'icon' => 'bx bx-heart',
                'sort_order' => 1,
                'is_active' => true,
            ],
            [
                'title' => 'Musical Extravaganzas & Stage Shows',
                'description' => 'Designed to host everything from soulful acoustic performances to high-energy, electrifying concerts with theatrical lighting.',
                'icon' => 'bx bx-music',
                'sort_order' => 2,
                'is_active' => true,
            ],
            [
                'title' => '5-Star Dining Facilities',
                'description' => 'Multiple food counters and expansive dining areas featuring Nano White Granite marble-top tables and glass partition view.',
                'icon' => 'bx bx-dish',
                'sort_order' => 3,
                'is_active' => true,
            ],
            [
                'title' => 'Audiophile Sound & Dynamic Lighting',
                'description' => 'Equipped with a high-end 25,000W JBL sound system and dynamic DJ/theatrical lighting setups to create immersive event atmospheres.',
                'icon' => 'bx bx-speaker',
                'sort_order' => 4,
                'is_active' => true,
            ],
        ];

        foreach ($offers as $offerData) {
            ConventionCentreOffer::updateOrCreate(
                [
                    'convention_centre_id' => $centre->id,
                    'title' => $offerData['title'],
                ],
                $offerData
            );
        }

        // Seed Infrastructure Spaces
        $spaces = [
            [
                'name' => 'Zidan Grand Auditorium',
                'badge' => 'GRAND AUDITORIUM',
                'seating_capacity' => 2000,
                'floating_capacity' => 3000,
                'dining_capacity' => 0,
                'description' => "Kerala's premier  auditorium with wall-to-wall carpeting and pristine acoustics.",
                'features' => "Architectural Design\n2,000+ Seating Capacity\n25,000W JBL Sound System\nGreen Rooms with direct stage access\nCentralized Air Conditioning",
                'sort_order' => 1,
                'is_active' => true,
            ],
            [
                'name' => 'Majlis & Zidan Dining Halls',
                'badge' => '5-STAR DINING',
                'seating_capacity' => 300,
                'floating_capacity' => 2000,
                'dining_capacity' => 2000,
                'description' => '5-star dining experience with Nano-White Granite marble tables, white leather chairs, and glass partition view.',
                'features' => "Nano-White Granite Marble Tables\nLuxurious White Leather Chairs\nGlass Partition Connection to Main Hall\nMulti-Cuisine Buffet Counters",
                'sort_order' => 2,
                'is_active' => true,
            ],
            [
                'name' => 'Royal VIP Lounge',
                'badge' => 'VIP SUITE',
                'seating_capacity' => 150,
                'floating_capacity' => 200,
                'dining_capacity' => 50,
                'description' => 'Exclusive air-conditioned lounge designed for dignitaries, bridal parties, and intimate VIP receptions.',
                'features' => "150 Guest Capacity\nDedicated Executive Restrooms\nDirect Private Entrance\nPlush Lounge Seating",
                'sort_order' => 3,
                'is_active' => true,
            ],
        ];

        foreach ($spaces as $spaceData) {
            ConventionHall::updateOrCreate(
                [
                    'convention_centre_id' => $centre->id,
                    'name' => $spaceData['name'],
                ],
                $spaceData
            );
        }
    }
}
