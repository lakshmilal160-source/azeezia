<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Enquiry;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class EnquiryController extends Controller
{
    /**
     * Display a listing of enquiries.
     */
    public function index(Request $request): View
    {
        $query = Enquiry::with(['conventionCentre', 'resort', 'organicFarm']);

        if ($request->filled('search')) {
            $searchTerm = '%'.$request->search.'%';
            $query->where(function ($q) use ($searchTerm) {
                $q->where('name', 'like', $searchTerm)
                    ->orWhere('email', 'like', $searchTerm)
                    ->orWhere('phone', 'like', $searchTerm)
                    ->orWhere('subject', 'like', $searchTerm);
            });
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('type')) {
            $query->where('enquiry_type', $request->type);
        }

        $enquiries = $query->latest()->paginate(15)->withQueryString();

        return view('Admin.enquiries.index', compact('enquiries'));
    }

    /**
     * Display the specified enquiry and reply/notes panel.
     */
    public function show(Enquiry $enquiry): View
    {
        $enquiry->load(['conventionCentre', 'resort', 'organicFarm']);

        return view('Admin.enquiries.show', compact('enquiry'));
    }

    /**
     * Update the enquiry status and internal notes.
     */
    public function update(Request $request, Enquiry $enquiry): RedirectResponse
    {
        $validated = $request->validate([
            'status' => ['required', 'string', 'in:new,contacted,in_progress,closed'],
            'admin_notes' => ['nullable', 'string'],
        ]);

        $enquiry->update($validated);

        return back()->with('success', 'Enquiry status and notes saved successfully.');
    }

    /**
     * Remove the specified enquiry.
     */
    public function destroy(Enquiry $enquiry): RedirectResponse
    {
        $enquiry->delete();

        return redirect()->route('admin.enquiries.index')
            ->with('success', 'Enquiry removed successfully.');
    }
}
