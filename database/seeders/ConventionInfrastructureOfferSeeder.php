<?php

namespace Database\Seeders;

use App\Models\ConventionCentre;
use App\Models\Infrastructure;
use App\Models\WhatWeOffer;
use Illuminate\Database\Seeder;

class ConventionInfrastructureOfferSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Convention Centre Basic Details
        ConventionCentre::updateOrCreate(
            ['slug' => 'azeezia-convention-centre'],
            [
                'name' => 'Azeezia Convention Centre',
                'contact_phone' => '+91 94470 12345',
                'email' => 'convention@azeezia.com',
                'address' => 'Civil Line Road, Padivattom, Kochi, Kerala - 682024',
                'location_url' => 'https://maps.google.com/?q=Azeezia+Convention+Centre+Kochi',
                'short_description' => "At Azeezia, we believe life's most cherished milestones deserve an extraordinary setting. Conceived with a deep reverence for nature and grand architectural hospitality, Azeezia seamlessly unites Kerala's finest  convention facilities with secluded luxury.",
                'description' => 'Azeezia Convention Centre offers a premier venue for grand weddings, high-profile corporate galas, and vibrant stage productions. Nestled in a resort-like green ambiance with 3-road accessibility, the property features a 2,000-seat main auditorium, 5-star dining spaces, and generous car parking.',
                'car_parking_capacity' => 500,
                'is_active' => true,
            ]
        );

        // 2. Infrastructure Table
        $infrastructures = [
            [
                'title' => 'Zidan Grand Auditorium',
                'description' => "Kerala's premier  auditorium with wall-to-wall carpeting and pristine acoustics.",
                'points' => "Architectural Design\n2,000+ Seating Guest Capacity\n25,000W Audiophile JBL Sound System\nGreen Rooms with direct stage access\nCentralized Air Conditioning",
                'order' => 1,
                'status' => true,
            ],
            [
                'title' => 'Majlis & Zidan Dining Halls',
                'description' => '5-star dining experience with Nano-White Granite marble tables, white leather chairs, and glass partition view.',
                'points' => "Nano-White Granite Marble Tables\nLuxurious White Leather Chairs\nGlass Partition Connection to Main Hall\nMulti-Cuisine Buffet Food Counters",
                'order' => 2,
                'status' => true,
            ],
            [
                'title' => 'Royal VIP Lounge & Boardroom',
                'description' => 'Exclusive air-conditioned lounge designed for dignitaries, bridal parties, and intimate VIP receptions.',
                'points' => "150 Guest Capacity\nDedicated Executive Restrooms\nDirect Private VIP Entrance\nPlush Executive Leather Seating",
                'order' => 3,
                'status' => true,
            ],
        ];

        foreach ($infrastructures as $infraData) {
            Infrastructure::updateOrCreate(
                ['title' => $infraData['title']],
                $infraData
            );
        }

        // 3. What We Offer Table
        $offers = [
            [
                'title' => 'Wedding Celebrations',
                'description' => 'Tailored setups featuring elegant decor, seamless arrangements, and world-class hospitality for unforgettable unions.',
                'order' => 1,
                'status' => true,
            ],
            [
                'title' => 'Musical Extravaganzas & Stage Shows',
                'description' => 'Designed to host everything from soulful acoustic performances to high-energy, electrifying concerts with theatrical lighting.',
                'order' => 2,
                'status' => true,
            ],
            [
                'title' => '5-Star Dining Facilities',
                'description' => 'Multiple food counters and expansive dining areas featuring Nano White Granite marble-top tables and glass partition view.',
                'order' => 3,
                'status' => true,
            ],
            [
                'title' => 'Audiophile Sound & Dynamic Lighting',
                'description' => 'Equipped with a high-end 25,000W JBL sound system and dynamic DJ/theatrical lighting setups to create immersive event atmospheres.',
                'order' => 4,
                'status' => true,
            ],
        ];

        foreach ($offers as $offerData) {
            WhatWeOffer::updateOrCreate(
                ['title' => $offerData['title']],
                $offerData
            );
        }
    }
}
