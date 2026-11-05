<?php

namespace App\Http\Controllers;

use App\Models\ConventionCentre;
use App\Models\OrganicFarm;
use App\Models\PageSeo;
use App\Models\Resort;
use App\Models\Service;
use Illuminate\Http\Response;

class SitemapController extends Controller
{
    /**
     * Generate dynamic XML sitemap for search engines.
     */
    public function sitemap(): Response
    {
        $urls = [];

        // 1. Static Pages from PageSeo where robots is not noindex
        $seoPages = PageSeo::where('robots', 'LIKE', '%index%')->get();
        foreach ($seoPages as $page) {
            $path = $page->page_key === 'home' ? '/' : '/'.$page->page_key;
            $urls[] = [
                'loc' => url($path),
                'lastmod' => $page->updated_at?->tz('UTC')->toAtomString() ?? now()->tz('UTC')->toAtomString(),
                'changefreq' => $page->page_key === 'home' ? 'daily' : 'weekly',
                'priority' => $page->page_key === 'home' ? '1.0' : '0.8',
            ];
        }

        // 2. Active Convention Centres
        $centres = ConventionCentre::where('is_active', true)->get();
        foreach ($centres as $centre) {
            $urls[] = [
                'loc' => url('/convention-centres/'.$centre->slug),
                'lastmod' => $centre->updated_at?->tz('UTC')->toAtomString() ?? now()->tz('UTC')->toAtomString(),
                'changefreq' => 'weekly',
                'priority' => '0.8',
            ];
        }

        // 3. Active Resorts
        $resorts = Resort::where('is_active', true)->get();
        foreach ($resorts as $resort) {
            $urls[] = [
                'loc' => url('/resorts/'.$resort->slug),
                'lastmod' => $resort->updated_at?->tz('UTC')->toAtomString() ?? now()->tz('UTC')->toAtomString(),
                'changefreq' => 'weekly',
                'priority' => '0.8',
            ];
        }

        // 4. Active Organic Farms
        $farms = OrganicFarm::where('is_active', true)->get();
        foreach ($farms as $farm) {
            $urls[] = [
                'loc' => url('/organic-farms/'.$farm->slug),
                'lastmod' => $farm->updated_at?->tz('UTC')->toAtomString() ?? now()->tz('UTC')->toAtomString(),
                'changefreq' => 'weekly',
                'priority' => '0.7',
            ];
        }

        // 5. Active Services
        $services = Service::where('is_active', true)->get();
        foreach ($services as $service) {
            $urls[] = [
                'loc' => url('/services/'.$service->slug),
                'lastmod' => $service->updated_at?->tz('UTC')->toAtomString() ?? now()->tz('UTC')->toAtomString(),
                'changefreq' => 'monthly',
                'priority' => '0.7',
            ];
        }

        $xml = '<?xml version="1.0" encoding="UTF-8"?>'."\n";
        $xml .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">'."\n";

        foreach ($urls as $item) {
            $xml .= "  <url>\n";
            $xml .= '    <loc>'.htmlspecialchars($item['loc'])."</loc>\n";
            $xml .= '    <lastmod>'.$item['lastmod']."</lastmod>\n";
            $xml .= '    <changefreq>'.$item['changefreq']."</changefreq>\n";
            $xml .= '    <priority>'.$item['priority']."</priority>\n";
            $xml .= "  </url>\n";
        }

        $xml .= '</urlset>';

        return response($xml, 200, ['Content-Type' => 'application/xml']);
    }

    /**
     * Generate dynamic robots.txt file with sitemap directive.
     */
    public function robots(): Response
    {
        $content = "User-agent: *\n";
        $content .= "Disallow: /admin\n";
        $content .= "Disallow: /admin/*\n";
        $content .= "Allow: /\n\n";
        $content .= 'Sitemap: '.url('/sitemap.xml')."\n";

        return response($content, 200, ['Content-Type' => 'text/plain']);
    }
}
