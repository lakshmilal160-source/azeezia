<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Resort;
use App\Models\ResortRoomType;
use App\Services\ImageUploadService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ResortRoomController extends Controller
{
    public function __construct(
        protected ImageUploadService $imageService
    ) {}

    /**
     * Display a listing of rooms & villa configurations.
     */
    public function index(Request $request): View
    {
        $query = ResortRoomType::with('resort')->withCount('images');

        if ($request->filled('search')) {
            $searchTerm = '%'.$request->search.'%';
            $query->where(function ($q) use ($searchTerm) {
                $q->where('name', 'like', $searchTerm)
                    ->orWhere('description', 'like', $searchTerm);
            });
        }

        if ($request->filled('resort_id')) {
            $query->where('resort_id', $request->resort_id);
        }

        if ($request->filled('status')) {
            $query->where('is_active', $request->status == '1');
        }

        $rooms = $query->orderBy('sort_order')->orderBy('id')->paginate(10)->withQueryString();
        $resorts = Resort::all();

        return view('Admin.resort-rooms.index', compact('rooms', 'resorts'));
    }

    /**
     * Show the form for creating a new room type.
     */
    public function create(Request $request): View
    {
        $resorts = Resort::all();
        $selectedResortId = $request->resort_id ?? ($resorts->first()?->id);
        $nextOrder = (ResortRoomType::max('sort_order') ?? 0) + 1;

        return view('Admin.resort-rooms.create', compact('resorts', 'selectedResortId', 'nextOrder'));
    }

    /**
     * Store a newly created room type.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'resort_id' => ['required', 'exists:resorts,id'],
            'name' => ['required', 'string', 'max:255'],
            'image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp', 'max:5120'],
            'image_2' => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp', 'max:5120'],
            'description' => ['nullable', 'string'],
            'bedrooms' => ['required', 'integer', 'min:1'],
            'bathrooms' => ['nullable', 'integer', 'min:1'],
            'max_guests' => ['nullable', 'integer', 'min:1'],
            'price' => ['required', 'numeric', 'min:0'],
            'price_unit' => ['nullable', 'string', 'max:30'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        $validated['price_unit'] = $validated['price_unit'] ?: 'per night';
        $validated['sort_order'] = $validated['sort_order'] ?? ((ResortRoomType::max('sort_order') ?? 0) + 1);
        $validated['is_active'] = $request->boolean('is_active', true);

        if ($request->hasFile('image')) {
            $validated['image'] = $this->imageService->upload($request->file('image'), 'uploads/rooms');
        }

        if ($request->hasFile('image_2')) {
            $validated['image_2'] = $this->imageService->upload($request->file('image_2'), 'uploads/rooms');
        }

        ResortRoomType::create($validated);

        return redirect()->route('admin.resort-rooms.index')
            ->with('success', 'Room / Villa type created successfully.');
    }

    /**
     * Show the form for editing the specified room type.
     */
    public function edit(ResortRoomType $resort_room): View
    {
        $resorts = Resort::all();
        $room = $resort_room;

        return view('Admin.resort-rooms.edit', compact('room', 'resorts'));
    }

    /**
     * Update the specified room type.
     */
    public function update(Request $request, ResortRoomType $resort_room): RedirectResponse
    {
        $validated = $request->validate([
            'resort_id' => ['required', 'exists:resorts,id'],
            'name' => ['required', 'string', 'max:255'],
            'image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp', 'max:5120'],
            'image_2' => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp', 'max:5120'],
            'description' => ['nullable', 'string'],
            'bedrooms' => ['required', 'integer', 'min:1'],
            'bathrooms' => ['nullable', 'integer', 'min:1'],
            'max_guests' => ['nullable', 'integer', 'min:1'],
            'price' => ['required', 'numeric', 'min:0'],
            'price_unit' => ['nullable', 'string', 'max:30'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        $validated['price_unit'] = $validated['price_unit'] ?: 'per night';
        $validated['sort_order'] = $validated['sort_order'] ?? 0;
        $validated['is_active'] = $request->boolean('is_active');

        if ($request->hasFile('image')) {
            if ($resort_room->image) {
                $this->imageService->delete($resort_room->image);
            }
            $validated['image'] = $this->imageService->upload($request->file('image'), 'uploads/rooms');
        }

        if ($request->hasFile('image_2')) {
            if ($resort_room->image_2) {
                $this->imageService->delete($resort_room->image_2);
            }
            $validated['image_2'] = $this->imageService->upload($request->file('image_2'), 'uploads/rooms');
        }

        $resort_room->update($validated);

        return redirect()->route('admin.resort-rooms.index')
            ->with('success', 'Room / Villa type updated successfully.');
    }

    /**
     * Remove the specified room type from storage.
     */
    public function destroy(ResortRoomType $resort_room): RedirectResponse
    {
        if ($resort_room->image) {
            $this->imageService->delete($resort_room->image);
        }

        if ($resort_room->image_2) {
            $this->imageService->delete($resort_room->image_2);
        }

        // Also delete any room-specific gallery images
        foreach ($resort_room->images as $img) {
            $this->imageService->delete($img->image);
            $img->delete();
        }

        $resort_room->delete();

        return redirect()->back()
            ->with('success', 'Room / Villa type deleted successfully.');
    }
}
