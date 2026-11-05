<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PageBanner;
use App\Services\ImageUploadService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class PageBannerController extends Controller
{
    /**
     * Common pages suggested for quick setup.
     *
     * @var list<string>
     */
    protected array $suggestedPages = [
        'Home' => 'home',
        'About Us' => 'about',
        'Convention Centres' => 'convention-centres',
        'Resorts & Stay' => 'resorts',
        'Organic Farm' => 'organic-farms',
        'Services' => 'services',
        'Photo Gallery' => 'gallery',
        'Testimonials' => 'testimonials',
        'Contact Us' => 'contact',
    ];

    /**
     * Create a new controller instance.
     */
    public function __construct(public ImageUploadService $imageService) {}

    /**
     * Display a listing of all page banners.
     */
    public function index(Request $request): View
    {
        $query = PageBanner::query();

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('page_name', 'like', "%{$search}%")
                    ->orWhere('page_slug', 'like', "%{$search}%")
                    ->orWhere('title_part1', 'like', "%{$search}%")
                    ->orWhere('title_part2', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%");
            });
        }

        if ($request->filled('status')) {
            $query->where('is_active', $request->status == '1');
        }

        $banners = $query->latest('id')->paginate(10)->withQueryString();

        return view('Admin.banners.index', compact('banners'));
    }

    /**
     * Show the form for creating a new page banner.
     */
    public function create(): View
    {
        $suggestedPages = $this->suggestedPages;

        return view('Admin.banners.create', compact('suggestedPages'));
    }

    /**
     * Store a newly created page banner in database.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'page_name' => ['required', 'string', 'max:190'],
            'page_slug' => ['nullable', 'string', 'max:190', 'unique:page_banners,page_slug'],
            'title_part1' => ['nullable', 'string', 'max:255'],
            'title_part2' => ['nullable', 'string', 'max:255'],
            'description' => ['nullable', 'string', 'max:2000'],
            'banner_image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp', 'max:5120'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        if (empty($validated['page_slug'])) {
            $validated['page_slug'] = Str::slug($validated['page_name']);
        } else {
            $validated['page_slug'] = Str::slug($validated['page_slug']);
        }

        if ($request->hasFile('banner_image')) {
            $validated['banner_image'] = $this->imageService->upload($request->file('banner_image'), 'uploads/banners');
        }

        $validated['is_active'] = $request->boolean('is_active', true);

        $banner = PageBanner::create($validated);

        return redirect()->route('admin.banners.index')
            ->with('success', "Page banner for '{$banner->page_name}' created successfully.");
    }

    /**
     * Display the specified page banner details.
     */
    public function show(PageBanner $banner): View
    {
        return view('Admin.banners.show', compact('banner'));
    }

    /**
     * Show the form for editing the specified page banner.
     */
    public function edit(PageBanner $banner): View
    {
        $suggestedPages = $this->suggestedPages;

        return view('Admin.banners.edit', compact('banner', 'suggestedPages'));
    }

    /**
     * Update the specified page banner in database.
     */
    public function update(Request $request, PageBanner $banner): RedirectResponse
    {
        $validated = $request->validate([
            'page_name' => ['required', 'string', 'max:190'],
            'page_slug' => ['nullable', 'string', 'max:190', Rule::unique('page_banners', 'page_slug')->ignore($banner->id)],
            'title_part1' => ['nullable', 'string', 'max:255'],
            'title_part2' => ['nullable', 'string', 'max:255'],
            'description' => ['nullable', 'string', 'max:2000'],
            'banner_image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp', 'max:5120'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        if (empty($validated['page_slug'])) {
            $validated['page_slug'] = Str::slug($validated['page_name']);
        } else {
            $validated['page_slug'] = Str::slug($validated['page_slug']);
        }

        if ($request->hasFile('banner_image')) {
            $this->imageService->delete($banner->banner_image);
            $validated['banner_image'] = $this->imageService->upload($request->file('banner_image'), 'uploads/banners');
        } else {
            unset($validated['banner_image']);
        }

        $validated['is_active'] = $request->boolean('is_active', true);

        $banner->update($validated);

        return redirect()->route('admin.banners.index')
            ->with('success', "Page banner for '{$banner->page_name}' updated successfully.");
    }

    /**
     * Remove the specified page banner from storage.
     */
    public function destroy(PageBanner $banner): RedirectResponse
    {
        $pageName = $banner->page_name;
        $this->imageService->delete($banner->banner_image);
        $banner->delete();

        return redirect()->route('admin.banners.index')
            ->with('success', "Page banner for '{$pageName}' removed successfully.");
    }
}
