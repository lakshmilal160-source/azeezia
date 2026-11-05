<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Slider;
use App\Services\ImageUploadService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SliderController extends Controller
{
    public function __construct(
        protected ImageUploadService $imageService
    ) {}

    /**
     * Display a listing of homepage banners.
     */
    public function index(): View
    {
        $sliders = Slider::orderBy('sort_order')->latest()->paginate(10);

        return view('Admin.sliders.index', compact('sliders'));
    }

    /**
     * Show the form for creating a new slider.
     */
    public function create(): View
    {
        return view('Admin.sliders.create');
    }

    /**
     * Store a newly created slider.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'subtitle' => ['nullable', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'image' => ['required', 'image', 'mimes:jpeg,png,jpg,webp', 'max:5120'],
            'button_text' => ['nullable', 'string', 'max:100'],
            'button_url' => ['nullable', 'string', 'max:500'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        $validated['image'] = $this->imageService->upload($request->file('image'), 'uploads/sliders');
        $validated['sort_order'] = $validated['sort_order'] ?? 0;
        $validated['is_active'] = $request->boolean('is_active', true);

        Slider::create($validated);

        return redirect()->route('admin.sliders.index')
            ->with('success', 'Banner created successfully.');
    }

    /**
     * Show form for editing a slider.
     */
    public function edit(Slider $slider): View
    {
        return view('Admin.sliders.edit', compact('slider'));
    }

    /**
     * Update the specified slider.
     */
    public function update(Request $request, Slider $slider): RedirectResponse
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'subtitle' => ['nullable', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp', 'max:5120'],
            'button_text' => ['nullable', 'string', 'max:100'],
            'button_url' => ['nullable', 'string', 'max:500'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        if ($request->hasFile('image')) {
            $this->imageService->delete($slider->image);
            $validated['image'] = $this->imageService->upload($request->file('image'), 'uploads/sliders');
        } else {
            unset($validated['image']);
        }

        $validated['sort_order'] = $validated['sort_order'] ?? 0;
        $validated['is_active'] = $request->boolean('is_active');

        $slider->update($validated);

        return redirect()->route('admin.sliders.index')
            ->with('success', 'Banner updated successfully.');
    }

    /**
     * Remove the specified slider.
     */
    public function destroy(Slider $slider): RedirectResponse
    {
        $this->imageService->delete($slider->image);
        $slider->delete();

        return redirect()->route('admin.sliders.index')
            ->with('success', 'Banner deleted successfully.');
    }
}
