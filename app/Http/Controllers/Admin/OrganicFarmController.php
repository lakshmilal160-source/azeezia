<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\OrganicFarm;
use App\Models\OrganicFarmImage;
use App\Services\ImageUploadService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;

class OrganicFarmController extends Controller
{
    public function __construct(
        protected ImageUploadService $imageService
    ) {}

    /**
     * Display a listing of organic farms.
     */
    public function index(Request $request): View
    {
        $query = OrganicFarm::withCount('images');

        if ($request->filled('search')) {
            $searchTerm = '%'.$request->search.'%';
            $query->where(function ($q) use ($searchTerm) {
                $q->where('name', 'like', $searchTerm)
                    ->orWhere('address', 'like', $searchTerm);
            });
        }

        if ($request->filled('status')) {
            $query->where('is_active', $request->status == '1');
        }

        $farms = $query->latest()->paginate(10)->withQueryString();

        return view('Admin.organic-farms.index', compact('farms'));
    }

    /**
     * Show the form for creating a new organic farm.
     */
    public function create(): View
    {
        return view('Admin.organic-farms.create');
    }

    /**
     * Store a newly created organic farm.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'slug' => ['nullable', 'string', 'max:255', 'unique:organic_farms,slug'],
            'short_description' => ['nullable', 'string', 'max:500'],
            'description' => ['nullable', 'string'],
            'area_acres' => ['nullable', 'numeric', 'min:0'],
            'address' => ['nullable', 'string'],
            'activities' => ['nullable', 'string'],
            'facilities' => ['nullable', 'string'],
            'contact_phone' => ['nullable', 'string', 'max:30'],
            'email' => ['nullable', 'email', 'max:255'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        if (empty($validated['slug'])) {
            $validated['slug'] = Str::slug($validated['name']);
        } else {
            $validated['slug'] = Str::slug($validated['slug']);
        }

        if (! empty($validated['activities'])) {
            $validated['activities'] = array_map('trim', explode(',', $validated['activities']));
        } else {
            $validated['activities'] = [];
        }

        if (! empty($validated['facilities'])) {
            $validated['facilities'] = array_map('trim', explode(',', $validated['facilities']));
        } else {
            $validated['facilities'] = [];
        }

        $validated['is_active'] = $request->boolean('is_active', true);

        $farm = OrganicFarm::create($validated);

        return redirect()->route('admin.organic-farms.show', $farm->id)
            ->with('success', 'Organic Farm created! You can now upload attraction and harvest photos.');
    }

    /**
     * Display organic farm details and gallery.
     */
    public function show(OrganicFarm $organicFarm): View
    {
        $organicFarm->load('images');

        return view('Admin.organic-farms.show', compact('organicFarm'));
    }

    /**
     * Show form for editing the farm.
     */
    public function edit(OrganicFarm $organicFarm): View
    {
        return view('Admin.organic-farms.edit', compact('organicFarm'));
    }

    /**
     * Update the specified organic farm.
     */
    public function update(Request $request, OrganicFarm $organicFarm): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'slug' => ['nullable', 'string', 'max:255', 'unique:organic_farms,slug,'.$organicFarm->id],
            'short_description' => ['nullable', 'string', 'max:500'],
            'description' => ['nullable', 'string'],
            'area_acres' => ['nullable', 'numeric', 'min:0'],
            'address' => ['nullable', 'string'],
            'activities' => ['nullable', 'string'],
            'facilities' => ['nullable', 'string'],
            'contact_phone' => ['nullable', 'string', 'max:30'],
            'email' => ['nullable', 'email', 'max:255'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        if (empty($validated['slug'])) {
            $validated['slug'] = $organicFarm->slug ?: Str::slug($validated['name']);
        } else {
            $validated['slug'] = Str::slug($validated['slug']);
        }

        if (! empty($validated['activities'])) {
            $validated['activities'] = array_map('trim', explode(',', $validated['activities']));
        } else {
            $validated['activities'] = [];
        }

        if (! empty($validated['facilities'])) {
            $validated['facilities'] = array_map('trim', explode(',', $validated['facilities']));
        } else {
            $validated['facilities'] = [];
        }

        $validated['is_active'] = $request->boolean('is_active');

        $organicFarm->update($validated);

        return redirect()->route('admin.organic-farms.index')
            ->with('success', 'Organic Farm updated successfully.');
    }

    /**
     * Remove the organic farm and images.
     */
    public function destroy(OrganicFarm $organicFarm): RedirectResponse
    {
        foreach ($organicFarm->images as $img) {
            $this->imageService->delete($img->image);
        }

        $organicFarm->delete();

        return redirect()->route('admin.organic-farms.index')
            ->with('success', 'Organic Farm deleted successfully.');
    }

    /**
     * Upload an image with alt text for SEO.
     */
    public function storeImage(Request $request, OrganicFarm $organicFarm): RedirectResponse
    {
        $request->validate([
            'image' => ['required', 'image', 'mimes:jpeg,png,jpg,webp', 'max:4096'],
            'alt_text' => ['nullable', 'string', 'max:255'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
        ]);

        $path = $this->imageService->upload($request->file('image'), 'uploads/farms');

        $organicFarm->images()->create([
            'image' => $path,
            'alt_text' => $request->alt_text ?: ($organicFarm->name.' organic harvest'),
            'sort_order' => $request->sort_order ?? 0,
        ]);

        return back()->with('success', 'Farm photo uploaded with SEO alt text.');
    }

    /**
     * Delete an image.
     */
    public function destroyImage(OrganicFarmImage $image): RedirectResponse
    {
        $this->imageService->delete($image->image);
        $image->delete();

        return back()->with('success', 'Farm photo deleted.');
    }
}
