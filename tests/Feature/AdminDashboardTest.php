<?php

namespace Tests\Feature;

use App\Models\ConventionCentre;
use App\Models\Faq;
use App\Models\Infrastructure;
use App\Models\PageBanner;
use App\Models\UpcomingProject;
use App\Models\User;
use App\Models\WhatWeOffer;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class AdminDashboardTest extends TestCase
{
    use RefreshDatabase;

    protected User $admin;

    protected function setUp(): void
    {
        parent::setUp();

        $this->seed();

        $this->admin = User::where('email', 'admin@azeezia.com')->first() ?? User::factory()->create([
            'email' => 'admin@azeezia.com',
            'password' => Hash::make('admin123'),
        ]);
    }

    public function test_login_page_renders_successfully(): void
    {
        $response = $this->get('/admin');

        $response->assertStatus(200);
        $response->assertSee('Welcome to Admin Portal');
    }

    public function test_admin_can_authenticate_and_access_dashboard(): void
    {
        $response = $this->post('/admin/login', [
            'email' => 'admin@azeezia.com',
            'password' => 'admin123',
        ]);

        $response->assertRedirect(route('admin.dashboard'));
        $this->assertAuthenticatedAs($this->admin);

        $dashboardResponse = $this->actingAs($this->admin)->get(route('admin.dashboard'));
        $dashboardResponse->assertStatus(200);
        $dashboardResponse->assertSee('Convention Centres');
        $dashboardResponse->assertSee('Resorts');
    }

    public function test_settings_page_renders_with_seo_section_commented_out(): void
    {
        $response = $this->actingAs($this->admin)->get(route('admin.settings.edit'));
        $response->assertStatus(200);
        $response->assertSee('General Information');
        $response->assertSee('Website Name');
        $response->assertSee('Branding', false);
        // Basic SEO is commented out per user request so it does not render in the HTML
        $response->assertDontSee('Default Meta Title');
    }

    public function test_admin_can_create_resort_with_email_and_auto_generated_slug(): void
    {
        $response = $this->actingAs($this->admin)->post(route('admin.resorts.store'), [
            'name' => 'Azeezia Palm Retreat',
            'contact_phone' => '+91 9876543210',
            'email' => 'palmretreat@azeezia.com',
            'is_active' => '1',
            'short_description' => 'A luxury stay among palm trees.',
            'amenities' => 'Pool, Wi-Fi',
        ]);

        $response->assertRedirect();
        $this->assertDatabaseHas('resorts', [
            'name' => 'Azeezia Palm Retreat',
            'slug' => 'azeezia-palm-retreat',
            'email' => 'palmretreat@azeezia.com',
        ]);
    }

    public function test_admin_can_create_organic_farm_with_email_and_auto_generated_slug(): void
    {
        $response = $this->actingAs($this->admin)->post(route('admin.organic-farms.store'), [
            'name' => 'Azeezia Green Meadows Farm',
            'area_acres' => '15.5',
            'contact_phone' => '+91 9123456789',
            'email' => 'farmstay@azeezia.com',
            'is_active' => '1',
            'short_description' => 'Eco-friendly farm tours and fresh organic produce.',
        ]);

        $response->assertRedirect();
        $this->assertDatabaseHas('organic_farms', [
            'name' => 'Azeezia Green Meadows Farm',
            'slug' => 'azeezia-green-meadows-farm',
            'email' => 'farmstay@azeezia.com',
        ]);
    }

    public function test_dynamic_sitemap_and_robots_txt_are_accessible(): void
    {
        $sitemapResponse = $this->get('/sitemap.xml');
        $sitemapResponse->assertStatus(200);
        $sitemapResponse->assertHeader('Content-Type', 'application/xml');
        $this->assertStringContainsString('<urlset', $sitemapResponse->getContent());

        $robotsResponse = $this->get('/robots.txt');
        $robotsResponse->assertStatus(200);
        $this->assertStringContainsString('Sitemap:', $robotsResponse->getContent());
        $this->assertStringContainsString('Disallow: /admin', $robotsResponse->getContent());
    }

    public function test_property_modules_render_for_admin(): void
    {
        $this->actingAs($this->admin)->get(route('admin.convention-centres.index'))->assertStatus(200);
        $this->actingAs($this->admin)->get(route('admin.infrastructures.index'))->assertStatus(200);
        $this->actingAs($this->admin)->get(route('admin.what-we-offers.index'))->assertStatus(200);
        $this->actingAs($this->admin)->get(route('admin.resorts.index'))->assertStatus(200);
        $this->actingAs($this->admin)->get(route('admin.organic-farms.index'))->assertStatus(200);
        $this->actingAs($this->admin)->get(route('admin.services.index'))->assertStatus(200);
        $this->actingAs($this->admin)->get(route('admin.gallery.index'))->assertStatus(200);
        $this->actingAs($this->admin)->get(route('admin.enquiries.index'))->assertStatus(200);
        $this->actingAs($this->admin)->get(route('admin.settings.edit'))->assertStatus(200);
        $this->actingAs($this->admin)->get(route('admin.banners.index'))->assertStatus(200);
        $this->actingAs($this->admin)->get(route('admin.faqs.index'))->assertStatus(200);
        $this->actingAs($this->admin)->get(route('admin.upcoming-projects.index'))->assertStatus(200);
    }

    public function test_admin_can_manage_page_banners_with_two_part_title(): void
    {
        PageBanner::create([
            'page_name' => 'Convention Centres',
            'page_slug' => 'convention-centres',
            'title_part1' => 'WORLD-CLASS VENUES',
            'title_part2' => 'Grand Convention Centres',
            'is_active' => true,
        ]);

        // 1. Index view renders
        $indexResponse = $this->actingAs($this->admin)->get(route('admin.banners.index'));
        $indexResponse->assertStatus(200);
        $indexResponse->assertSee('Page Banners');
        $indexResponse->assertSee('Convention Centres');

        // 2. Create banner with 2-part title
        $createResponse = $this->actingAs($this->admin)->post(route('admin.banners.store'), [
            'page_name' => 'Ayurvedic Spa',
            'page_slug' => 'spa',
            'title_part1' => 'HEALING & WELLNESS',
            'title_part2' => 'Luxury Ayurvedic Spa Retreat',
            'description' => 'Holistic rejuvenation therapies amidst nature.',
            'is_active' => '1',
        ]);

        $createResponse->assertRedirect(route('admin.banners.index'));
        $this->assertDatabaseHas('page_banners', [
            'page_name' => 'Ayurvedic Spa',
            'page_slug' => 'spa',
            'title_part1' => 'HEALING & WELLNESS',
            'title_part2' => 'Luxury Ayurvedic Spa Retreat',
        ]);

        // 3. Edit view renders
        $banner = PageBanner::where('page_slug', 'spa')->firstOrFail();
        $editResponse = $this->actingAs($this->admin)->get(route('admin.banners.edit', $banner->id));
        $editResponse->assertStatus(200);
        $editResponse->assertSee('HEALING & WELLNESS');

        // 4. Update banner
        $updateResponse = $this->actingAs($this->admin)->put(route('admin.banners.update', $banner->id), [
            'page_name' => 'Ayurvedic Spa',
            'page_slug' => 'spa',
            'title_part1' => 'HOLISTIC HEALTH',
            'title_part2' => 'Premium Wellness Centre',
            'description' => 'Updated description.',
            'is_active' => '1',
        ]);

        $updateResponse->assertRedirect(route('admin.banners.index'));
        $this->assertDatabaseHas('page_banners', [
            'id' => $banner->id,
            'title_part1' => 'HOLISTIC HEALTH',
            'title_part2' => 'Premium Wellness Centre',
        ]);

        // 5. Test model helper
        $fetched = PageBanner::getForPage('spa');
        $this->assertNotNull($fetched);
        $this->assertEquals('HOLISTIC HEALTH Premium Wellness Centre', $fetched->full_title);
    }

    public function test_admin_can_manage_faqs(): void
    {
        // 1. Index renders
        $this->actingAs($this->admin)->get(route('admin.faqs.index'))->assertStatus(200);

        // 2. Create FAQ
        $createResponse = $this->actingAs($this->admin)->post(route('admin.faqs.store'), [
            'question' => 'How can I schedule a venue tour?',
            'answer' => 'You can reach our concierge desk or request a visit via the contact form.',
            'order' => 5,
            'status' => '1',
        ]);
        $createResponse->assertRedirect(route('admin.faqs.index'));
        $this->assertDatabaseHas('faqs', [
            'question' => 'How can I schedule a venue tour?',
            'order' => 5,
            'status' => 1,
        ]);

        // 3. Edit & Update FAQ
        $faq = Faq::where('question', 'How can I schedule a venue tour?')->firstOrFail();
        $this->actingAs($this->admin)->get(route('admin.faqs.edit', $faq->id))->assertStatus(200);

        $updateResponse = $this->actingAs($this->admin)->put(route('admin.faqs.update', $faq->id), [
            'question' => 'How do I book a private resort tour?',
            'answer' => 'Call our front desk directly for priority reservations.',
            'order' => 2,
            'status' => '1',
        ]);
        $updateResponse->assertRedirect(route('admin.faqs.index'));
        $this->assertDatabaseHas('faqs', [
            'id' => $faq->id,
            'question' => 'How do I book a private resort tour?',
            'order' => 2,
        ]);

        // 4. Delete FAQ
        $deleteResponse = $this->actingAs($this->admin)->delete(route('admin.faqs.destroy', $faq->id));
        $deleteResponse->assertRedirect(route('admin.faqs.index'));
        $this->assertDatabaseMissing('faqs', ['id' => $faq->id]);
    }

    public function test_admin_can_manage_upcoming_projects_with_status_and_category(): void
    {
        // 1. Index renders
        $this->actingAs($this->admin)->get(route('admin.upcoming-projects.index'))->assertStatus(200);

        // 2. Create Upcoming Project
        $createResponse = $this->actingAs($this->admin)->post(route('admin.upcoming-projects.store'), [
            'title' => 'Ayurvedic Spa and Wellness Resort',
            'category' => 'WELLNESS RETREAT',
            'subtitle' => 'Upcoming Destination',
            'description' => 'Dedicated to traditional Ayurvedic wellness and rejuvenation.',
            'status' => 'Upcoming',
            'order' => 1,
            'is_active' => '1',
        ]);
        $createResponse->assertRedirect(route('admin.upcoming-projects.index'));
        $this->assertDatabaseHas('upcoming_projects', [
            'title' => 'Ayurvedic Spa and Wellness Resort',
            'category' => 'WELLNESS RETREAT',
            'subtitle' => 'Upcoming Destination',
            'status' => 'Upcoming',
            'order' => 1,
        ]);

        // 3. Model formatted sequence accessor
        $project = UpcomingProject::where('title', 'Ayurvedic Spa and Wellness Resort')->firstOrFail();
        $this->assertEquals('01', $project->formatted_order);

        // 4. Edit & Update Project
        $this->actingAs($this->admin)->get(route('admin.upcoming-projects.edit', $project->id))->assertStatus(200);
        $updateResponse = $this->actingAs($this->admin)->put(route('admin.upcoming-projects.update', $project->id), [
            'title' => 'Floating Restaurant and Sunset Deck',
            'category' => 'WATERFRONT DINING',
            'subtitle' => 'Proposed Development',
            'description' => 'Scenic waterfront dining experience.',
            'status' => 'Proposed',
            'order' => 2,
            'is_active' => '1',
        ]);
        $updateResponse->assertRedirect(route('admin.upcoming-projects.index'));
        $this->assertDatabaseHas('upcoming_projects', [
            'id' => $project->id,
            'title' => 'Floating Restaurant and Sunset Deck',
            'status' => 'Proposed',
            'order' => 2,
        ]);
        $this->assertEquals('02', $project->fresh()->formatted_order);

        // 5. Delete Project
        $deleteResponse = $this->actingAs($this->admin)->delete(route('admin.upcoming-projects.destroy', $project->id));
        $deleteResponse->assertRedirect(route('admin.upcoming-projects.index'));
        $this->assertDatabaseMissing('upcoming_projects', ['id' => $project->id]);
    }

    public function test_admin_can_manage_convention_centre_basic_details_with_mobile(): void
    {
        // 1. Create Convention Centre with separate mobile number
        $response = $this->actingAs($this->admin)->post(route('admin.convention-centres.store'), [
            'name' => 'Azeezia Royal Convention',
            'contact_phone' => '+91 94470 99887',
            'email' => 'royal@azeezia.com',
            'address' => 'Padivattom, Kochi',
            'short_description' => 'A premier celebration destination.',
            'is_active' => '1',
        ]);

        $response->assertRedirect();
        $this->assertDatabaseHas('convention_centres', [
            'name' => 'Azeezia Royal Convention',
            'contact_phone' => '+91 94470 99887',
            'email' => 'royal@azeezia.com',
        ]);

        $centre = ConventionCentre::where('name', 'Azeezia Royal Convention')->firstOrFail();
        $this->assertEquals('+91 94470 99887', $centre->mobile);

        // 2. Index shows centre and separate phone
        $indexResponse = $this->actingAs($this->admin)->get(route('admin.convention-centres.index'));
        $indexResponse->assertStatus(200);
        $indexResponse->assertSee('+91 94470 99887');

        // 3. Show page renders basic details
        $showResponse = $this->actingAs($this->admin)->get(route('admin.convention-centres.show', $centre->id));
        $showResponse->assertStatus(200);
        $showResponse->assertSee('+91 94470 99887');
    }

    public function test_admin_can_manage_infrastructure_with_points(): void
    {
        // 1. Create Infrastructure space
        $response = $this->actingAs($this->admin)->post(route('admin.infrastructures.store'), [
            'title' => 'Zidan Grand  Hall',
            'description' => 'Acoustic mastery with luxury seating.',
            'points' => " Design\n2,000+ Guest Capacity\nJBL 25kW Audio",
            'order' => 1,
            'status' => '1',
        ]);

        $response->assertRedirect(route('admin.infrastructures.index'));
        $this->assertDatabaseHas('infrastructures', [
            'title' => 'Zidan Grand  Hall',
            'order' => 1,
            'status' => 1,
        ]);

        $infra = Infrastructure::where('title', 'Zidan Grand  Hall')->firstOrFail();
        $this->assertEquals('01', $infra->formatted_order);
        $this->assertCount(3, $infra->points_array);
        $this->assertEquals('Modern Design', $infra->points_array[0]);

        // 2. Update Infrastructure
        $updateResponse = $this->actingAs($this->admin)->put(route('admin.infrastructures.update', $infra->id), [
            'title' => 'Zidan Grand Ballroom',
            'description' => 'Updated luxury description.',
            'points' => "Central A/C\nGreen Rooms",
            'order' => 2,
            'status' => '1',
        ]);
        $updateResponse->assertRedirect(route('admin.infrastructures.index'));
        $this->assertDatabaseHas('infrastructures', [
            'id' => $infra->id,
            'title' => 'Zidan Grand Ballroom',
            'order' => 2,
        ]);

        // 3. Delete Infrastructure
        $deleteResponse = $this->actingAs($this->admin)->delete(route('admin.infrastructures.destroy', $infra->id));
        $deleteResponse->assertRedirect(route('admin.infrastructures.index'));
        $this->assertDatabaseMissing('infrastructures', ['id' => $infra->id]);
    }

    public function test_admin_can_manage_what_we_offer_section(): void
    {
        // 1. Create What We Offer item
        $response = $this->actingAs($this->admin)->post(route('admin.what-we-offers.store'), [
            'title' => 'Signature Wedding Celebrations',
            'description' => 'Exquisite floral and stage decor.',
            'order' => 1,
            'status' => '1',
        ]);

        $response->assertRedirect(route('admin.what-we-offers.index'));
        $this->assertDatabaseHas('what_we_offers', [
            'title' => 'Signature Wedding Celebrations',
            'order' => 1,
            'status' => 1,
        ]);

        $offer = WhatWeOffer::where('title', 'Signature Wedding Celebrations')->firstOrFail();
        $this->assertEquals('01', $offer->formatted_order);

        // 2. Update Offer
        $updateResponse = $this->actingAs($this->admin)->put(route('admin.what-we-offers.update', $offer->id), [
            'title' => 'Royal Wedding Gala Celebrations',
            'description' => 'Updated celebration package.',
            'order' => 2,
            'status' => '1',
        ]);
        $updateResponse->assertRedirect(route('admin.what-we-offers.index'));
        $this->assertDatabaseHas('what_we_offers', [
            'id' => $offer->id,
            'title' => 'Royal Wedding Gala Celebrations',
            'order' => 2,
        ]);

        // 3. Delete Offer
        $deleteResponse = $this->actingAs($this->admin)->delete(route('admin.what-we-offers.destroy', $offer->id));
        $deleteResponse->assertRedirect(route('admin.what-we-offers.index'));
        $this->assertDatabaseMissing('what_we_offers', ['id' => $offer->id]);
    }

    public function test_public_convention_center_page_renders_with_dynamic_data(): void
    {
        ConventionCentre::create([
            'name' => 'Azeezia Premier Convention',
            'slug' => 'azeezia-premier-convention',
            'contact_phone' => '+91 94470 55443',
            'email' => 'premier@azeezia.com',
            'is_active' => true,
        ]);

        Infrastructure::create([
            'title' => 'Zidan Auditorium Space',
            'description' => 'Seating for up to 2000 guests.',
            'points' => "Pillarless Design\nJBL Acoustics",
            'order' => 1,
            'status' => true,
        ]);

        WhatWeOffer::create([
            'title' => '5-Star Banqueting & Catering',
            'description' => 'Finest culinary arrangements.',
            'order' => 1,
            'status' => true,
        ]);

        $response = $this->get(route('convention-center'));
        $response->assertStatus(200);
        $response->assertSee('Azeezia Premier Convention');
        $response->assertSee('+91 94470 55443');
        $response->assertSee('Zidan Auditorium Space');
        // $response->assertSee('Pillarless Design');
        $response->assertSee('5-Star Banqueting & Catering');
    }
}
