@extends('Admin.layout')

@section('title', 'Site Settings')

@section('content')
<div class="mb-4">
    <h4 class="fw-bold mb-1"><span class="text-muted fw-light">System /</span> Settings</h4>
    <p class="text-muted mb-0">Manage general site information, contact details, and branding</p>
</div>

<form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <div class="row">
        <!-- General Information -->
        <div class="col-lg-6 mb-4">
            <div class="card h-100">
                <div class="card-header border-bottom">
                    <h5 class="card-title mb-0"><i class="bx bx-info-circle me-1 text-primary"></i> General Information</h5>
                </div>
                <div class="card-body pt-4">
                    <div class="mb-3">
                        <label class="form-label" for="site_name">Website Name</label>
                        <input type="text" class="form-control" id="site_name" name="site_name" value="{{ old('site_name', $settings['site_name'] ?? 'Azeezia') }}">
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="site_tagline">Tagline</label>
                        <input type="text" class="form-control" id="site_tagline" name="site_tagline" value="{{ old('site_tagline', $settings['site_tagline'] ?? '') }}" placeholder="e.g. Convention Centres, Resorts & Organic Farm">
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="site_email">Contact Email</label>
                        <input type="email" class="form-control" id="site_email" name="site_email" value="{{ old('site_email', $settings['site_email'] ?? '') }}">
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="site_phone">Contact Phone</label>
                        <input type="text" class="form-control" id="site_phone" name="site_phone" value="{{ old('site_phone', $settings['site_phone'] ?? '') }}">
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="site_address">Address</label>
                        <textarea class="form-control" id="site_address" name="site_address" rows="3">{{ old('site_address', $settings['site_address'] ?? '') }}</textarea>
                    </div>
                </div>
            </div>
        </div>

        <!-- Branding & Social Media -->
        <div class="col-lg-6 mb-4">
            <div class="card h-100">
                <div class="card-header border-bottom">
                    <h5 class="card-title mb-0"><i class="bx bx-palette me-1 text-primary"></i> Branding & Social Links</h5>
                </div>
                <div class="card-body pt-4">
                    <!-- Logo Upload -->
                    <div class="mb-3">
                        <label class="form-label" for="logo">Website Logo</label>
                        <input type="file" class="form-control" id="logo" name="logo" accept="image/*">
                        @if(!empty($settings['logo']))
                            <div class="mt-2 p-2 bg-light rounded border d-inline-block">
                                <img src="{{ asset('storage/' . $settings['logo']) }}" alt="Logo" style="max-height: 45px;">
                            </div>
                        @endif
                    </div>

                    <!-- Favicon Upload -->
                    <div class="mb-3">
                        <label class="form-label" for="favicon">Favicon (.ico / .png)</label>
                        <input type="file" class="form-control" id="favicon" name="favicon" accept="image/*">
                        @if(!empty($settings['favicon']))
                            <div class="mt-2 p-2 bg-light rounded border d-inline-block">
                                <img src="{{ asset('storage/' . $settings['favicon']) }}" alt="Favicon" style="width: 32px; height: 32px;">
                            </div>
                        @endif
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="facebook_url">Facebook Link</label>
                        <input type="url" class="form-control" id="facebook_url" name="facebook_url" value="{{ old('facebook_url', $settings['facebook_url'] ?? '') }}" placeholder="https://facebook.com/...">
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="instagram_url">Instagram Link</label>
                        <input type="url" class="form-control" id="instagram_url" name="instagram_url" value="{{ old('instagram_url', $settings['instagram_url'] ?? '') }}" placeholder="https://instagram.com/...">
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="youtube_url">YouTube Link</label>
                        <input type="url" class="form-control" id="youtube_url" name="youtube_url" value="{{ old('youtube_url', $settings['youtube_url'] ?? '') }}" placeholder="https://youtube.com/...">
                    </div>
                </div>
            </div>
        </div>

        {{-- Basic SEO Settings (Commented out per request - uncomment if needed in the future)
        <div class="col-12 mb-4">
            <div class="card">
                <div class="card-header border-bottom">
                    <h5 class="card-title mb-0 d-flex align-items-center">
                        <i class="bx bx-globe text-primary me-2 fs-4"></i> Basic SEO Settings
                    </h5>
                </div>
                <div class="card-body pt-4">
                    <div class="row">
                        <!-- Meta Title -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label" for="meta_title">Default Meta Title</label>
                            <input type="text" class="form-control" id="meta_title" name="meta_title" value="{{ old('meta_title', $settings['meta_title'] ?? 'Azeezia - Convention Centres, Luxury Resorts & Organic Farm') }}" placeholder="e.g. Azeezia - Convention Centres & Resorts">
                            <div class="form-text">Appears in Google search title and browser tab.</div>
                        </div>

                        <!-- Google Analytics (Optional) -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label" for="google_analytics_id">Google Analytics ID (Optional)</label>
                            <input type="text" class="form-control" id="google_analytics_id" name="google_analytics_id" value="{{ old('google_analytics_id', $settings['google_analytics_id'] ?? '') }}" placeholder="e.g. G-XXXXXXXXXX">
                            <div class="form-text">Leave blank if not needed.</div>
                        </div>

                        <!-- Meta Description -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label" for="meta_description">Meta Description</label>
                            <textarea class="form-control" id="meta_description" name="meta_description" rows="3" placeholder="Brief summary of Azeezia for search results...">{{ old('meta_description', $settings['meta_description'] ?? '') }}</textarea>
                            <div class="form-text">Brief explanation of your business displayed in search results.</div>
                        </div>

                        <!-- Meta Keywords -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label" for="meta_keywords">Meta Keywords</label>
                            <textarea class="form-control" id="meta_keywords" name="meta_keywords" rows="3" placeholder="convention centres, wedding hall, luxury resort, organic farm">{{ old('meta_keywords', $settings['meta_keywords'] ?? '') }}</textarea>
                            <div class="form-text">Comma-separated keywords.</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        --}}

        <div class="col-12">
            <button type="submit" class="btn btn-primary px-4 py-2">
                <i class="bx bx-save me-1"></i> Save Settings
            </button>
        </div>
    </div>
</form>
@endsection
