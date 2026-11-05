<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\UpcomingProject;
use App\Services\ImageUploadService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class UpcomingProjectController extends Controller
{
    /**
     * Common suggested project categories.
     *
     * @var list<string>
     */
    protected array $suggestedCategories = [
        'WELLNESS RETREAT',
        'WATERFRONT DINING',
        'NATURE & TOURISM',
        'CONVENTION & EVENTS',
        'LUXURY STAY',
        'ECO LIVING',
    ];

    /**
     * Standard status stages matching user design.
     *
     * @var list<string>
     */
    protected array $statusOptions = [
        'Upcoming',
        'Proposed',
        'Under Construction',
        'Planning',
    ];

    /**
     * Create a new controller instance.
     */
    public function __construct(public ImageUploadService $imageService) {}

    /**
     * Display a listing of upcoming projects.
     */
    public function index(Request $request): View
    {
        $query = UpcomingProject::query();

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                    ->orWhere('category', 'like', "%{$search}%")
                    ->orWhere('subtitle', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%");
            });
        }

        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $projects = $query->orderBy('order', 'asc')->latest('id')->paginate(10)->withQueryString();
        $categories = UpcomingProject::whereNotNull('category')->distinct()->pluck('category');
        $statusOptions = $this->statusOptions;

        return view('Admin.upcoming-projects.index', compact('projects', 'categories', 'statusOptions'));
    }

    /**
     * Show the form for creating a new upcoming project.
     */
    public function create(): View
    {
        $suggestedCategories = $this->suggestedCategories;
        $statusOptions = $this->statusOptions;
        $nextOrder = (UpcomingProject::max('order') ?? 0) + 1;

        return view('Admin.upcoming-projects.create', compact('suggestedCategories', 'statusOptions', 'nextOrder'));
    }

    /**
     * Store a newly created upcoming project in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'category' => ['nullable', 'string', 'max:100'],
            'subtitle' => ['nullable', 'string', 'max:150'],
            'description' => ['nullable', 'string'],
            'image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp', 'max:5120'],
            'status' => ['required', 'string', 'max:50'],
            'order' => ['nullable', 'integer', 'min:1'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $this->imageService->upload($request->file('image'), 'uploads/upcoming-projects');
        }

        $validated['order'] = $validated['order'] ?? ((UpcomingProject::max('order') ?? 0) + 1);
        $validated['is_active'] = $request->boolean('is_active', true);

        UpcomingProject::create($validated);

        return redirect()->route('admin.upcoming-projects.index')
            ->with('success', 'Upcoming Project created successfully.');
    }

    /**
     * Show the form for editing the specified upcoming project.
     */
    public function edit(UpcomingProject $upcomingProject): View
    {
        $suggestedCategories = $this->suggestedCategories;
        $statusOptions = $this->statusOptions;

        return view('Admin.upcoming-projects.edit', compact('upcomingProject', 'suggestedCategories', 'statusOptions'));
    }

    /**
     * Update the specified upcoming project in storage.
     */
    public function update(Request $request, UpcomingProject $upcomingProject): RedirectResponse
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'category' => ['nullable', 'string', 'max:100'],
            'subtitle' => ['nullable', 'string', 'max:150'],
            'description' => ['nullable', 'string'],
            'image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp', 'max:5120'],
            'status' => ['required', 'string', 'max:50'],
            'order' => ['nullable', 'integer', 'min:1'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        if ($request->hasFile('image')) {
            $this->imageService->delete($upcomingProject->image);
            $validated['image'] = $this->imageService->upload($request->file('image'), 'uploads/upcoming-projects');
        } else {
            unset($validated['image']);
        }

        $validated['order'] = $validated['order'] ?? $upcomingProject->order;
        $validated['is_active'] = $request->boolean('is_active', true);

        $upcomingProject->update($validated);

        return redirect()->route('admin.upcoming-projects.index')
            ->with('success', 'Upcoming Project updated successfully.');
    }

    /**
     * Remove the specified upcoming project from storage.
     */
    public function destroy(UpcomingProject $upcomingProject): RedirectResponse
    {
        $this->imageService->delete($upcomingProject->image);
        $upcomingProject->delete();

        return redirect()->route('admin.upcoming-projects.index')
            ->with('success', 'Upcoming Project deleted successfully.');
    }
}
