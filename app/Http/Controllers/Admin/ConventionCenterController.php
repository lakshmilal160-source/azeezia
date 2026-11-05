<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ConventionCentre;
use App\Models\ConventionCentreImage;
use App\Services\ImageUploadService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;

class ConventionCenterController extends Controller
{
    public function __construct(
        protected ImageUploadService $imageService
    ) {}

    /**
     * Display a listing of convention centres.
     */
    public function index(Request $request): View
    {
        $query = ConventionCentre::withCount('images');

        if ($request->filled('search')) {
            $searchTerm = '%'.$request->search.'%';
            $query->where(function ($q) use ($searchTerm) {
                $q->where('name', 'like', $searchTerm)
                    ->orWhere('address', 'like', $searchTerm)
                    ->orWhere('contact_phone', 'like', $searchTerm)
                    ->orWhere('email', 'like', $searchTerm);
            });
        }

        if ($request->filled('status')) {
            $query->where('is_active', $request->status == '1');
        }

        $centres = $query->latest()->paginate(10)->withQueryString();

        return view('Admin.convention-centres.index', compact('centres'));
    }

    /**
     * Show the form for creating a new convention centre.
     */
    public function create(): View
    {
        return view('Admin.convention-centres.create');
    }

    /**
     * Store a newly created convention centre.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'slug' => ['nullable', 'string', 'max:255', 'unique:convention_centres,slug'],
            'contact_phone' => ['nullable', 'string', 'max:30'],
            'email' => ['nullable', 'email', 'max:255'],
            'address' => ['nullable', 'string'],
            'location_url' => ['nullable', 'url', 'max:500'],
            'short_description' => ['nullable', 'string', 'max:1000'],
            'description' => ['nullable', 'string'],
            'car_parking_capacity' => ['nullable', 'integer', 'min:0'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        if (empty($validated['slug'])) {
            $validated['slug'] = Str::slug($validated['name']);
        } else {
            $validated['slug'] = Str::slug($validated['slug']);
        }

        $validated['is_active'] = $request->boolean('is_active', true);
        $validated['car_parking_capacity'] = $validated['car_parking_capacity'] ?? 0;

        $centre = ConventionCentre::create($validated);

        return redirect()->route('admin.convention-centres.show', $centre->id)
            ->with('success', 'Convention Centre created successfully.');
    }

    /**
     * Display the convention centre details and photos.
     */
    public function show(ConventionCentre $conventionCentre): View
    {
        $conventionCentre->load('images');

        return view('Admin.convention-centres.show', compact('conventionCentre'));
    }

    /**
     * Show the form for editing the convention centre.
     */
    public function edit(ConventionCentre $conventionCentre): View
    {
        return view('Admin.convention-centres.edit', compact('conventionCentre'));
    }

    /**
     * Update the specified convention centre.
     */
    public function update(Request $request, ConventionCentre $conventionCentre): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'slug' => ['nullable', 'string', 'max:255', 'unique:convention_centres,slug,'.$conventionCentre->id],
            'contact_phone' => ['nullable', 'string', 'max:30'],
            'email' => ['nullable', 'email', 'max:255'],
            'address' => ['nullable', 'string'],
            'location_url' => ['nullable', 'url', 'max:500'],
            'short_description' => ['nullable', 'string', 'max:1000'],
            'description' => ['nullable', 'string'],
            'car_parking_capacity' => ['nullable', 'integer', 'min:0'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        if (empty($validated['slug'])) {
            $validated['slug'] = Str::slug($validated['name']);
        } else {
            $validated['slug'] = Str::slug($validated['slug']);
        }

        $validated['is_active'] = $request->boolean('is_active');
        $validated['car_parking_capacity'] = $validated['car_parking_capacity'] ?? 0;

        $conventionCentre->update($validated);

        return redirect()->route('admin.convention-centres.index')
            ->with('success', 'Convention Centre updated successfully.');
    }

    /**
     * Remove the specified convention centre.
     */
    public function destroy(ConventionCentre $conventionCentre): RedirectResponse
    {
        foreach ($conventionCentre->images as $img) {
            $this->imageService->delete($img->image);
        }

        $conventionCentre->delete();

        return redirect()->route('admin.convention-centres.index')
            ->with('success', 'Convention Centre deleted successfully.');
    }

    /**
     * Upload an image with alt text for gallery.
     */
    public function storeImage(Request $request, ConventionCentre $conventionCentre): RedirectResponse
    {
        $request->validate([
            'image' => ['required', 'image', 'mimes:jpeg,png,jpg,webp', 'max:5120'],
            'alt_text' => ['nullable', 'string', 'max:255'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
        ]);

        $path = $this->imageService->upload($request->file('image'), 'uploads/convention-centres');

        $conventionCentre->images()->create([
            'image' => $path,
            'alt_text' => $request->alt_text ?: $conventionCentre->name,
            'sort_order' => $request->sort_order ?? 0,
        ]);

        return back()->with('success', 'Photo added to gallery.');
    }

    /**
     * Delete a gallery photo.
     */
    public function destroyImage(ConventionCentreImage $image): RedirectResponse
    {
        $this->imageService->delete($image->image);
        $image->delete();

        return back()->with('success', 'Photo deleted.');
    }
}
