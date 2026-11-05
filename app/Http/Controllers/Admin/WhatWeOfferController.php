<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\WhatWeOffer;
use App\Services\ImageUploadService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class WhatWeOfferController extends Controller
{
    public function __construct(
        protected ImageUploadService $imageService
    ) {}

    /**
     * Display a listing of What We Offer items.
     */
    public function index(Request $request): View
    {
        $query = WhatWeOffer::query();

        if ($request->filled('search')) {
            $searchTerm = '%'.$request->search.'%';
            $query->where(function ($q) use ($searchTerm) {
                $q->where('title', 'like', $searchTerm)
                    ->orWhere('description', 'like', $searchTerm);
            });
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status == '1');
        }

        $offers = $query->orderBy('order')->orderBy('id')->paginate(10)->withQueryString();

        return view('Admin.what-we-offers.index', compact('offers'));
    }

    /**
     * Show the form for creating a new offer item.
     */
    public function create(): View
    {
        $nextOrder = (WhatWeOffer::max('order') ?? 0) + 1;

        return view('Admin.what-we-offers.create', compact('nextOrder'));
    }

    /**
     * Store a newly created offer item.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp', 'max:5120'],
            'icon' => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp,svg', 'max:2048'],
            'description' => ['nullable', 'string'],
            'order' => ['nullable', 'integer', 'min:0'],
            'status' => ['nullable', 'boolean'],
        ]);

        $validated['order'] = $validated['order'] ?? ((WhatWeOffer::max('order') ?? 0) + 1);
        $validated['status'] = $request->boolean('status', true);

        if ($request->hasFile('image')) {
            $validated['image'] = $this->imageService->upload($request->file('image'), 'uploads/what-we-offers');
        }

        if ($request->hasFile('icon')) {
            $validated['icon'] = $this->imageService->upload($request->file('icon'), 'uploads/what-we-offers/icons');
        }

        WhatWeOffer::create($validated);

        return redirect()->route('admin.what-we-offers.index')
            ->with('success', '"What We Offer" item created successfully.');
    }

    /**
     * Show the form for editing the offer item.
     */
    public function edit(WhatWeOffer $whatWeOffer): View
    {
        return view('Admin.what-we-offers.edit', compact('whatWeOffer'));
    }

    /**
     * Update the specified offer item.
     */
    public function update(Request $request, WhatWeOffer $whatWeOffer): RedirectResponse
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp', 'max:5120'],
            'icon' => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp,svg', 'max:2048'],
            'description' => ['nullable', 'string'],
            'order' => ['nullable', 'integer', 'min:0'],
            'status' => ['nullable', 'boolean'],
        ]);

        $validated['order'] = $validated['order'] ?? $whatWeOffer->order;
        $validated['status'] = $request->boolean('status');

        if ($request->hasFile('image')) {
            if ($whatWeOffer->image) {
                $this->imageService->delete($whatWeOffer->image);
            }
            $validated['image'] = $this->imageService->upload($request->file('image'), 'uploads/what-we-offers');
        } else {
            unset($validated['image']);
        }

        if ($request->hasFile('icon')) {
            if ($whatWeOffer->icon) {
                $this->imageService->delete($whatWeOffer->icon);
            }
            $validated['icon'] = $this->imageService->upload($request->file('icon'), 'uploads/what-we-offers/icons');
        } else {
            unset($validated['icon']);
        }

        $whatWeOffer->update($validated);

        return redirect()->route('admin.what-we-offers.index')
            ->with('success', '"What We Offer" item updated successfully.');
    }

    /**
     * Remove the specified offer item.
     */
    public function destroy(WhatWeOffer $whatWeOffer): RedirectResponse
    {
        if ($whatWeOffer->image) {
            $this->imageService->delete($whatWeOffer->image);
        }

        if ($whatWeOffer->icon) {
            $this->imageService->delete($whatWeOffer->icon);
        }

        $whatWeOffer->delete();

        return redirect()->route('admin.what-we-offers.index')
            ->with('success', '"What We Offer" item deleted successfully.');
    }
}
