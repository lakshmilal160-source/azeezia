<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Resort;
use App\Models\ResortImage;
use App\Models\ResortRoomType;
use App\Services\ImageUploadService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;

class ResortController extends Controller
{
    public function __construct(
        protected ImageUploadService $imageService
    ) {}

    /**
     * Display a listing of resorts and villas.
     */
    public function index(Request $request): View
    {
        $query = Resort::withCount('roomTypes');

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

        $resorts = $query->latest()->paginate(10)->withQueryString();

        return view('Admin.resorts.index', compact('resorts'));
    }

    /**
     * Show the form for creating a new resort.
     */
    public function create(): View
    {
        return view('Admin.resorts.create');
    }

    /**
     * Store a newly created resort.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'slug' => ['nullable', 'string', 'max:255', 'unique:resorts,slug'],
            'short_description' => ['nullable', 'string', 'max:500'],
            'description' => ['nullable', 'string'],
            'address' => ['nullable', 'string'],
            'contact_phone' => ['nullable', 'string', 'max:30'],
            'email' => ['nullable', 'email', 'max:255'],
            'amenities' => ['nullable', 'string'], // Comma-separated in form
            'is_active' => ['nullable', 'boolean'],
        ]);

        if (empty($validated['slug'])) {
            $validated['slug'] = Str::slug($validated['name']);
        } else {
            $validated['slug'] = Str::slug($validated['slug']);
        }

        // Parse amenities from comma-separated string to array
        if (! empty($validated['amenities'])) {
            $validated['amenities'] = array_map('trim', explode(',', $validated['amenities']));
        } else {
            $validated['amenities'] = [];
        }

        $validated['is_active'] = $request->boolean('is_active', true);

        $resort = Resort::create($validated);

        return redirect()->route('admin.resorts.show', $resort->id)
            ->with('success', 'Resort created! You can now add room/villa types.');
    }

    /**
     * Display the resort details and room types.
     */
    public function show(Resort $resort): View
    {
        $resort->load('roomTypes');

        return view('Admin.resorts.show', compact('resort'));
    }

    /**
     * Show the form for editing the resort.
     */
    public function edit(Resort $resort): View
    {
        return view('Admin.resorts.edit', compact('resort'));
    }

    /**
     * Update the specified resort.
     */
    public function update(Request $request, Resort $resort): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'slug' => ['nullable', 'string', 'max:255', 'unique:resorts,slug,'.$resort->id],
            'short_description' => ['nullable', 'string', 'max:500'],
            'description' => ['nullable', 'string'],
            'address' => ['nullable', 'string'],
            'contact_phone' => ['nullable', 'string', 'max:30'],
            'email' => ['nullable', 'email', 'max:255'],
            'amenities' => ['nullable', 'string'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        if (empty($validated['slug'])) {
            $validated['slug'] = $resort->slug ?: Str::slug($validated['name']);
        } else {
            $validated['slug'] = Str::slug($validated['slug']);
        }

        if (! empty($validated['amenities'])) {
            $validated['amenities'] = array_map('trim', explode(',', $validated['amenities']));
        } else {
            $validated['amenities'] = [];
        }

        $validated['is_active'] = $request->boolean('is_active');

        $resort->update($validated);

        return redirect()->route('admin.resorts.index')
            ->with('success', 'Resort updated successfully.');
    }

    /**
     * Remove the specified resort and images from storage.
     */
    public function destroy(Resort $resort): RedirectResponse
    {
        foreach ($resort->images as $img) {
            $this->imageService->delete($img->image);
        }

        $resort->delete();

        return redirect()->route('admin.resorts.index')
            ->with('success', 'Resort deleted successfully.');
    }

    /**
     * Add a room or villa type.
     */
    public function storeRoomType(Request $request, Resort $resort): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp', 'max:5120'],
            'image_2' => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp', 'max:5120'],
            'bedrooms' => ['required', 'integer', 'min:1'],
            'bathrooms' => ['nullable', 'integer', 'min:1'],
            'max_guests' => ['nullable', 'integer', 'min:1'],
            'price' => ['required', 'numeric', 'min:0'],
            'price_unit' => ['nullable', 'string', 'max:30'],
            'description' => ['nullable', 'string'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        $validated['price_unit'] = $validated['price_unit'] ?: 'per night';
        $validated['sort_order'] = $validated['sort_order'] ?? 0;
        $validated['is_active'] = $request->boolean('is_active', true);

        if ($request->hasFile('image')) {
            $validated['image'] = $this->imageService->upload($request->file('image'), 'uploads/rooms');
        }

        if ($request->hasFile('image_2')) {
            $validated['image_2'] = $this->imageService->upload($request->file('image_2'), 'uploads/rooms');
        }

        $resort->roomTypes()->create($validated);

        return back()->with('success', 'Room type added successfully.');
    }

    /**
     * Delete a room type.
     */
    public function destroyRoomType(ResortRoomType $roomType): RedirectResponse
    {
        if ($roomType->image) {
            $this->imageService->delete($roomType->image);
        }

        if ($roomType->image_2) {
            $this->imageService->delete($roomType->image_2);
        }

        $roomType->delete();

        return back()->with('success', 'Room type deleted.');
    }

    /**
     * Upload resort photo with SEO alt text.
     */
    public function storeImage(Request $request, Resort $resort): RedirectResponse
    {
        $request->validate([
            'image' => ['required', 'image', 'mimes:jpeg,png,jpg,webp', 'max:4096'],
            'alt_text' => ['nullable', 'string', 'max:255'],
            'resort_room_type_id' => ['nullable', 'exists:resort_room_types,id'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
        ]);

        $path = $this->imageService->upload($request->file('image'), 'uploads/resorts');

        $resort->images()->create([
            'image' => $path,
            'alt_text' => $request->alt_text ?: ($resort->name.' luxury accommodation'),
            'resort_room_type_id' => $request->resort_room_type_id,
            'sort_order' => $request->sort_order ?? 0,
        ]);

        return back()->with('success', 'Photo uploaded with SEO alt text.');
    }

    /**
     * Delete resort photo.
     */
    public function destroyImage(ResortImage $image): RedirectResponse
    {
        $this->imageService->delete($image->image);
        $image->delete();

        return back()->with('success', 'Photo removed.');
    }
}
