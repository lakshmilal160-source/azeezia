<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\GalleryCategory;
use App\Models\GalleryImage;
use App\Services\ImageUploadService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;

class GalleryController extends Controller
{
    public function __construct(
        protected ImageUploadService $imageService
    ) {}

    /**
     * Display a listing of gallery images.
     */
    public function index(Request $request): View
    {
        $categories = GalleryCategory::orderBy('name')->get();

        $query = GalleryImage::with('category');

        if ($request->filled('category_id')) {
            $query->where('gallery_category_id', $request->category_id);
        }

        $images = $query->orderBy('sort_order')->latest()->paginate(18)->withQueryString();

        return view('Admin.gallery.index', compact('images', 'categories'));
    }

    /**
     * Show form for uploading an image to the gallery.
     */
    public function create(): View
    {
        $categories = GalleryCategory::where('is_active', true)->orderBy('name')->get();

        return view('Admin.gallery.create', compact('categories'));
    }

    /**
     * Store newly uploaded gallery image.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'gallery_category_id' => ['required', 'exists:gallery_categories,id'],
            'title' => ['nullable', 'string', 'max:255'],
            'image' => ['required', 'image', 'mimes:jpeg,png,jpg,webp', 'max:4096'],
            'alt_text' => ['nullable', 'string', 'max:255'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        $validated['image'] = $this->imageService->upload($request->file('image'), 'uploads/gallery');
        $validated['alt_text'] = $validated['alt_text'] ?: ($validated['title'] ?: 'Azeezia gallery photo');
        $validated['sort_order'] = $validated['sort_order'] ?? 0;
        $validated['is_active'] = $request->boolean('is_active', true);

        GalleryImage::create($validated);

        return redirect()->route('admin.gallery.index')
            ->with('success', 'Image added to gallery with SEO alt text.');
    }

    /**
     * Show form for editing image metadata.
     */
    public function edit(GalleryImage $gallery): View
    {
        $categories = GalleryCategory::orderBy('name')->get();

        return view('Admin.gallery.edit', compact('gallery', 'categories'));
    }

    /**
     * Update image metadata and alt text.
     */
    public function update(Request $request, GalleryImage $gallery): RedirectResponse
    {
        $validated = $request->validate([
            'gallery_category_id' => ['required', 'exists:gallery_categories,id'],
            'title' => ['nullable', 'string', 'max:255'],
            'image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp', 'max:4096'],
            'alt_text' => ['nullable', 'string', 'max:255'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        if ($request->hasFile('image')) {
            $this->imageService->delete($gallery->image);
            $validated['image'] = $this->imageService->upload($request->file('image'), 'uploads/gallery');
        } else {
            unset($validated['image']);
        }

        $validated['alt_text'] = $validated['alt_text'] ?: ($validated['title'] ?: 'Azeezia gallery photo');
        $validated['sort_order'] = $validated['sort_order'] ?? 0;
        $validated['is_active'] = $request->boolean('is_active');

        $gallery->update($validated);

        return redirect()->route('admin.gallery.index')
            ->with('success', 'Gallery image updated.');
    }

    /**
     * Remove the image from gallery.
     */
    public function destroy(GalleryImage $gallery): RedirectResponse
    {
        $this->imageService->delete($gallery->image);
        $gallery->delete();

        return redirect()->route('admin.gallery.index')
            ->with('success', 'Gallery photo deleted.');
    }

    /**
     * Manage gallery categories.
     */
    public function categories(): View
    {
        $categories = GalleryCategory::withCount('images')->orderBy('sort_order')->get();

        return view('Admin.gallery.categories', compact('categories'));
    }

    /**
     * Store new category.
     */
    public function storeCategory(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'slug' => ['nullable', 'string', 'max:255', 'unique:gallery_categories,slug'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        $validated['slug'] = ! empty($validated['slug']) ? Str::slug($validated['slug']) : Str::slug($validated['name']);
        $validated['sort_order'] = $validated['sort_order'] ?? 0;
        $validated['is_active'] = $request->boolean('is_active', true);

        GalleryCategory::create($validated);

        return back()->with('success', 'Gallery category created.');
    }

    /**
     * Delete a category.
     */
    public function destroyCategory(GalleryCategory $category): RedirectResponse
    {
        if ($category->images()->count() > 0) {
            return back()->with('error', 'Cannot delete category that still contains photos.');
        }

        $category->delete();

        return back()->with('success', 'Gallery category deleted.');
    }
}
