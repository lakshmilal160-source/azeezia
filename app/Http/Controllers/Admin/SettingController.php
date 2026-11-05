<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SiteSetting;
use App\Services\ImageUploadService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SettingController extends Controller
{
    public function __construct(
        protected ImageUploadService $imageService
    ) {}

    /**
     * Show site settings edit form.
     */
    public function edit(): View
    {
        $settings = SiteSetting::getAllSettings();

        return view('Admin.settings.edit', compact('settings'));
    }

    /**
     * Update site settings.
     */
    public function update(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'site_name' => ['nullable', 'string', 'max:255'],
            'site_tagline' => ['nullable', 'string', 'max:255'],
            'site_email' => ['nullable', 'email', 'max:255'],
            'site_phone' => ['nullable', 'string', 'max:50'],
            'site_address' => ['nullable', 'string'],
            'logo' => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp,svg', 'max:2048'],
            'favicon' => ['nullable', 'image', 'mimes:jpeg,png,ico', 'max:1024'],
            'facebook_url' => ['nullable', 'url', 'max:255'],
            'instagram_url' => ['nullable', 'url', 'max:255'],
            'youtube_url' => ['nullable', 'url', 'max:255'],
            // Simple SEO Fields
            'meta_title' => ['nullable', 'string', 'max:255'],
            'meta_description' => ['nullable', 'string', 'max:500'],
            'meta_keywords' => ['nullable', 'string', 'max:500'],
            'google_analytics_id' => ['nullable', 'string', 'max:100'],
        ]);

        $currentSettings = SiteSetting::getAllSettings();

        // Handle Logo
        if ($request->hasFile('logo')) {
            if (! empty($currentSettings['logo'])) {
                $this->imageService->delete($currentSettings['logo']);
            }
            $validated['logo'] = $this->imageService->upload($request->file('logo'), 'uploads/settings');
        }

        // Handle Favicon
        if ($request->hasFile('favicon')) {
            if (! empty($currentSettings['favicon'])) {
                $this->imageService->delete($currentSettings['favicon']);
            }
            $validated['favicon'] = $this->imageService->upload($request->file('favicon'), 'uploads/settings');
        }

        foreach ($validated as $key => $value) {
            SiteSetting::updateOrCreate(
                ['setting_key' => $key],
                ['setting_value' => $value]
            );
        }

        return back()->with('success', 'Settings updated successfully.');
    }
}
