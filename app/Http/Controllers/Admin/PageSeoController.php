<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PageSeo;
use App\Services\ImageUploadService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PageSeoController extends Controller
{
    public function __construct(
        protected ImageUploadService $imageService
    ) {}

    /**
     * Display a listing of page SEO configurations.
     */
    public function index(): View
    {
        $pages = PageSeo::orderBy('page_key')->get();

        return view('Admin.seo.index', compact('pages'));
    }

    /**
     * Show form to edit SEO metadata for a page.
     */
    public function edit(PageSeo $seo): View
    {
        return view('Admin.seo.edit', compact('seo'));
    }

    /**
     * Update page SEO metadata.
     */
    public function update(Request $request, PageSeo $seo): RedirectResponse
    {
        $validated = $request->validate([
            'meta_title' => ['nullable', 'string', 'max:255'],
            'meta_description' => ['nullable', 'string', 'max:500'],
            'og_title' => ['nullable', 'string', 'max:255'],
            'og_description' => ['nullable', 'string', 'max:500'],
            'og_image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp', 'max:3072'],
            'canonical_url' => ['nullable', 'url', 'max:500'],
            'robots' => ['required', 'string', 'in:index,follow,noindex,follow,noindex,nofollow,index,nofollow'],
        ]);

        if ($request->hasFile('og_image')) {
            $this->imageService->delete($seo->og_image);
            $validated['og_image'] = $this->imageService->upload($request->file('og_image'), 'uploads/seo');
        } elseif ($request->boolean('remove_og_image')) {
            $this->imageService->delete($seo->og_image);
            $validated['og_image'] = null;
        }

        $seo->update($validated);

        return redirect()->route('admin.seo.index')
            ->with('success', "SEO metadata for '".ucfirst($seo->page_key)."' page updated successfully.");
    }

    /**
     * Show SEO Diagnostics & Sitemap/Robots Tools.
     */
    public function tools(): View
    {
        $seoPagesCount = PageSeo::count();
        $pagesWithFullMeta = PageSeo::whereNotNull('meta_title')->whereNotNull('meta_description')->count();

        return view('Admin.seo.tools', compact('seoPagesCount', 'pagesWithFullMeta'));
    }
}
