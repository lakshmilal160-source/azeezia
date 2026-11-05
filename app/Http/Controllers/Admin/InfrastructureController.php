<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Infrastructure;
use App\Services\ImageUploadService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class InfrastructureController extends Controller
{
    public function __construct(
        protected ImageUploadService $imageService
    ) {}

    /**
     * Display a listing of infrastructure items.
     */
    public function index(Request $request): View
    {
        $query = Infrastructure::query();

        if ($request->filled('search')) {
            $searchTerm = '%'.$request->search.'%';
            $query->where(function ($q) use ($searchTerm) {
                $q->where('title', 'like', $searchTerm)
                    ->orWhere('description', 'like', $searchTerm)
                    ->orWhere('points', 'like', $searchTerm);
            });
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status == '1');
        }

        $infrastructures = $query->orderBy('order')->orderBy('id')->paginate(10)->withQueryString();

        return view('Admin.infrastructures.index', compact('infrastructures'));
    }

    /**
     * Show the form for creating a new infrastructure item.
     */
    public function create(): View
    {
        $nextOrder = (Infrastructure::max('order') ?? 0) + 1;

        return view('Admin.infrastructures.create', compact('nextOrder'));
    }

    /**
     * Store a newly created infrastructure item.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp', 'max:5120'],
            'description' => ['nullable', 'string'],
            'points' => ['nullable', 'string'],
            'order' => ['nullable', 'integer', 'min:0'],
            'status' => ['nullable', 'boolean'],
        ]);

        $validated['order'] = $validated['order'] ?? ((Infrastructure::max('order') ?? 0) + 1);
        $validated['status'] = $request->boolean('status', true);

        if ($request->hasFile('image')) {
            $validated['image'] = $this->imageService->upload($request->file('image'), 'uploads/infrastructures');
        }

        Infrastructure::create($validated);

        return redirect()->route('admin.infrastructures.index')
            ->with('success', 'Infrastructure item created successfully.');
    }

    /**
     * Show the form for editing the infrastructure item.
     */
    public function edit(Infrastructure $infrastructure): View
    {
        return view('Admin.infrastructures.edit', compact('infrastructure'));
    }

    /**
     * Update the specified infrastructure item.
     */
    public function update(Request $request, Infrastructure $infrastructure): RedirectResponse
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp', 'max:5120'],
            'description' => ['nullable', 'string'],
            'points' => ['nullable', 'string'],
            'order' => ['nullable', 'integer', 'min:0'],
            'status' => ['nullable', 'boolean'],
        ]);

        $validated['order'] = $validated['order'] ?? $infrastructure->order;
        $validated['status'] = $request->boolean('status');

        if ($request->hasFile('image')) {
            if ($infrastructure->image) {
                $this->imageService->delete($infrastructure->image);
            }
            $validated['image'] = $this->imageService->upload($request->file('image'), 'uploads/infrastructures');
        } else {
            unset($validated['image']);
        }

        $infrastructure->update($validated);

        return redirect()->route('admin.infrastructures.index')
            ->with('success', 'Infrastructure item updated successfully.');
    }

    /**
     * Remove the specified infrastructure item.
     */
    public function destroy(Infrastructure $infrastructure): RedirectResponse
    {
        if ($infrastructure->image) {
            $this->imageService->delete($infrastructure->image);
        }

        $infrastructure->delete();

        return redirect()->route('admin.infrastructures.index')
            ->with('success', 'Infrastructure item deleted successfully.');
    }
}
