<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Testimonial;
use App\Services\ImageUploadService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class TestimonialController extends Controller
{
    public function __construct(
        protected ImageUploadService $imageService
    ) {}

    /**
     * Display a listing of testimonials.
     */
    public function index(): View
    {
        $testimonials = Testimonial::orderBy('sort_order')->latest()->paginate(10);

        return view('Admin.testimonials.index', compact('testimonials'));
    }

    /**
     * Show form for adding testimonial.
     */
    public function create(): View
    {
        return view('Admin.testimonials.create');
    }

    /**
     * Store new testimonial.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'customer_name' => ['required', 'string', 'max:255'],
            'designation' => ['nullable', 'string', 'max:255'],
            'review' => ['required', 'string'],
            'rating' => ['nullable', 'integer', 'min:1', 'max:5'],
            'image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp', 'max:2048'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $this->imageService->upload($request->file('image'), 'uploads/testimonials');
        }

        $validated['rating'] = $validated['rating'] ?? 5;
        $validated['sort_order'] = $validated['sort_order'] ?? 0;
        $validated['is_active'] = $request->boolean('is_active', true);

        Testimonial::create($validated);

        return redirect()->route('admin.testimonials.index')
            ->with('success', 'Testimonial created successfully.');
    }

    /**
     * Show form for editing testimonial.
     */
    public function edit(Testimonial $testimonial): View
    {
        return view('Admin.testimonials.edit', compact('testimonial'));
    }

    /**
     * Update testimonial.
     */
    public function update(Request $request, Testimonial $testimonial): RedirectResponse
    {
        $validated = $request->validate([
            'customer_name' => ['required', 'string', 'max:255'],
            'designation' => ['nullable', 'string', 'max:255'],
            'review' => ['required', 'string'],
            'rating' => ['nullable', 'integer', 'min:1', 'max:5'],
            'image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp', 'max:2048'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        if ($request->hasFile('image')) {
            $this->imageService->delete($testimonial->image);
            $validated['image'] = $this->imageService->upload($request->file('image'), 'uploads/testimonials');
        } elseif ($request->boolean('remove_image')) {
            $this->imageService->delete($testimonial->image);
            $validated['image'] = null;
        } else {
            unset($validated['image']);
        }

        $validated['rating'] = $validated['rating'] ?? 5;
        $validated['sort_order'] = $validated['sort_order'] ?? 0;
        $validated['is_active'] = $request->boolean('is_active');

        $testimonial->update($validated);

        return redirect()->route('admin.testimonials.index')
            ->with('success', 'Testimonial updated successfully.');
    }

    /**
     * Delete testimonial.
     */
    public function destroy(Testimonial $testimonial): RedirectResponse
    {
        $this->imageService->delete($testimonial->image);
        $testimonial->delete();

        return redirect()->route('admin.testimonials.index')
            ->with('success', 'Testimonial deleted successfully.');
    }
}
