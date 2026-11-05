@extends('Admin.layout')

@section('title', 'Edit SEO - ' . ucfirst($seo->page_key))

@section('content')
<div class="mb-4">
    <a href="{{ route('admin.seo.index') }}" class="btn btn-sm btn-outline-secondary mb-2">
        <i class="bx bx-arrow-back me-1"></i> Back to All SEO Pages
    </a>
    <h4 class="fw-bold mb-1">
        <span class="text-muted fw-light">SEO /</span> Edit: {{ strtoupper(str_replace('-', ' ', $seo->page_key)) }}
    </h4>
    <p class="text-muted mb-0">Fine-tune search engine visibility and social media share previews for this page.</p>
</div>

<div class="row">
    <!-- Left Column: Form -->
    <div class="col-lg-7 mb-4">
        <div class="card">
            <div class="card-header border-bottom">
                <h5 class="card-title mb-0">Meta & Social Media Tags</h5>
            </div>
            <div class="card-body pt-4">
                <form action="{{ route('admin.seo.update', $seo->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <!-- Meta Title -->
                    <div class="mb-3">
                        <div class="d-flex justify-content-between align-items-center mb-1">
                            <label class="form-label mb-0" for="meta_title">
                                Meta Title <span class="text-danger">*</span>
                            </label>
                            <small class="text-muted" id="titleCounter">0 / 60 chars (Recommended: 50-60)</small>
                        </div>
                        <input
                            type="text"
                            class="form-control @error('meta_title') is-invalid @enderror"
                            id="meta_title"
                            name="meta_title"
                            value="{{ old('meta_title', $seo->meta_title) }}"
                            placeholder="e.g. Azeezia - Convention Centres, Luxury Resorts & Organic Farm"
                            required
                        />
                        @error('meta_title')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Meta Description -->
                    <div class="mb-3">
                        <div class="d-flex justify-content-between align-items-center mb-1">
                            <label class="form-label mb-0" for="meta_description">
                                Meta Description <span class="text-danger">*</span>
                            </label>
                            <small class="text-muted" id="descCounter">0 / 160 chars (Recommended: 150-160)</small>
                        </div>
                        <textarea
                            class="form-control @error('meta_description') is-invalid @enderror"
                            id="meta_description"
                            name="meta_description"
                            rows="4"
                            placeholder="Write a compelling, keyword-rich summary of the page for search engine results..."
                        >{{ old('meta_description', $seo->meta_description) }}</textarea>
                        @error('meta_description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="row">
                        <!-- Canonical URL -->
                        <div class="col-md-7 mb-3">
                            <label class="form-label" for="canonical_url">Canonical URL</label>
                            <input
                                type="url"
                                class="form-control @error('canonical_url') is-invalid @enderror"
                                id="canonical_url"
                                name="canonical_url"
                                value="{{ old('canonical_url', $seo->canonical_url ?? url($seo->page_key === 'home' ? '/' : '/' . $seo->page_key)) }}"
                                placeholder="https://yourdomain.com/page"
                            />
                            <div class="form-text">Prevents duplicate content penalties by telling Google the master URL.</div>
                            @error('canonical_url')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Robots Directive -->
                        <div class="col-md-5 mb-3">
                            <label class="form-label" for="robots">Robots Directive</label>
                            <select class="form-select @error('robots') is-invalid @enderror" id="robots" name="robots">
                                <option value="index,follow" {{ old('robots', $seo->robots) === 'index,follow' ? 'selected' : '' }}>index, follow (Default / Recommended)</option>
                                <option value="noindex,follow" {{ old('robots', $seo->robots) === 'noindex,follow' ? 'selected' : '' }}>noindex, follow</option>
                                <option value="noindex,nofollow" {{ old('robots', $seo->robots) === 'noindex,nofollow' ? 'selected' : '' }}>noindex, nofollow (Private)</option>
                                <option value="index,nofollow" {{ old('robots', $seo->robots) === 'index,nofollow' ? 'selected' : '' }}>index, nofollow</option>
                            </select>
                            @error('robots')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <hr class="my-4">
                    <h6 class="fw-bold mb-3 text-primary"><i class="bx bx-share-alt me-1"></i> Open Graph (Social Sharing)</h6>

                    <!-- OG Title -->
                    <div class="mb-3">
                        <label class="form-label" for="og_title">Open Graph Title</label>
                        <input
                            type="text"
                            class="form-control @error('og_title') is-invalid @enderror"
                            id="og_title"
                            name="og_title"
                            value="{{ old('og_title', $seo->og_title) }}"
                            placeholder="Title when shared on Facebook, WhatsApp, LinkedIn"
                        />
                        @error('og_title')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- OG Description -->
                    <div class="mb-3">
                        <label class="form-label" for="og_description">Open Graph Description</label>
                        <textarea
                            class="form-control @error('og_description') is-invalid @enderror"
                            id="og_description"
                            name="og_description"
                            rows="2"
                            placeholder="Description when shared on social networks..."
                        >{{ old('og_description', $seo->og_description) }}</textarea>
                        @error('og_description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- OG Image -->
                    <div class="mb-4">
                        <label class="form-label" for="og_image">Social Sharing Image (1200x630 px recommended)</label>
                        <input type="file" class="form-control @error('og_image') is-invalid @enderror" id="og_image" name="og_image" accept="image/*">
                        @error('og_image')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror

                        @if($seo->og_image)
                            <div class="mt-3 d-flex align-items-center gap-3 p-2 border rounded bg-light">
                                <img src="{{ asset('storage/' . $seo->og_image) }}" alt="OG Preview" style="width: 120px; height: 63px; object-fit: cover;" class="rounded border">
                                <div>
                                    <span class="d-block small text-muted">Current Social Share Image</span>
                                    <div class="form-check mt-1">
                                        <input class="form-check-input" type="checkbox" name="remove_og_image" id="remove_og_image" value="1">
                                        <label class="form-check-label text-danger small" for="remove_og_image">
                                            Remove this image
                                        </label>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary px-4">
                            <i class="bx bx-save me-1"></i> Save SEO Settings
                        </button>
                        <a href="{{ route('admin.seo.index') }}" class="btn btn-outline-secondary">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Right Column: Live Google & Social Previews -->
    <div class="col-lg-5 mb-4">
        <!-- Live Google SERP Preview -->
        <div class="card mb-4 border border-primary border-opacity-25 shadow-sm">
            <div class="card-header bg-light pb-2">
                <span class="badge bg-primary mb-1"><i class="bx bxl-google me-1"></i> Live Google Search Preview</span>
                <p class="small text-muted mb-0">This is how your link appears in Google search rankings:</p>
            </div>
            <div class="card-body pt-3">
                <div class="p-3 border rounded bg-white shadow-xs">
                    <!-- Google URL breadcrumb -->
                    <div class="d-flex align-items-center mb-1">
                        <div class="rounded-circle bg-light d-flex align-items-center justify-content-center me-2" style="width: 24px; height: 24px;">
                            <i class="bx bx-globe text-primary small"></i>
                        </div>
                        <div>
                            <div class="small text-dark fw-semibold lh-1">{{ parse_url(url('/'), PHP_URL_HOST) ?? 'azeezia.com' }}</div>
                            <div class="text-success small lh-1" id="serpUrl" style="font-size: 12px;">{{ url($seo->page_key === 'home' ? '' : $seo->page_key) }}</div>
                        </div>
                    </div>
                    <!-- Google Title -->
                    <h5 class="text-primary mb-1 text-decoration-none fw-normal" id="serpTitle" style="color: #1a0dab !important; cursor: pointer; font-size: 18px; line-height: 1.3;">
                        {{ $seo->meta_title ?? 'Page Title Will Appear Here' }}
                    </h5>
                    <!-- Google Snippet -->
                    <p class="text-secondary small mb-0 lh-sm" id="serpDesc" style="color: #4d5156 !important; font-size: 13px;">
                        {{ $seo->meta_description ?? 'Your page meta description will be displayed here in search engine results snippets to attract clicks...' }}
                    </p>
                </div>
            </div>
        </div>

        <!-- Social Media Sharing Card Preview -->
        <div class="card border border-info border-opacity-25 shadow-sm">
            <div class="card-header bg-light pb-2">
                <span class="badge bg-info mb-1"><i class="bx bxl-facebook me-1"></i> Live Social Share Card</span>
                <p class="small text-muted mb-0">Preview for WhatsApp, Facebook, Twitter, and LinkedIn:</p>
            </div>
            <div class="card-body pt-3">
                <div class="border rounded overflow-hidden bg-white shadow-xs">
                    <div style="height: 160px; background-color: #f0f2f5;" class="d-flex align-items-center justify-content-center text-muted">
                        @if($seo->og_image)
                            <img src="{{ asset('storage/' . $seo->og_image) }}" alt="OG" class="w-100 h-100" style="object-fit: cover;">
                        @else
                            <div class="text-center">
                                <i class="bx bx-image-alt fs-1 d-block mb-1"></i>
                                <span class="small">Upload 1200x630 image</span>
                            </div>
                        @endif
                    </div>
                    <div class="p-3 bg-light">
                        <small class="text-uppercase text-muted d-block mb-1" style="font-size: 11px;">{{ parse_url(url('/'), PHP_URL_HOST) ?? 'AZEEZIA.COM' }}</small>
                        <strong class="d-block text-dark mb-1" id="ogCardTitle">{{ $seo->og_title ?: ($seo->meta_title ?: 'Page Title') }}</strong>
                        <small class="text-muted d-block text-truncate" id="ogCardDesc">{{ $seo->og_description ?: ($seo->meta_description ?: 'Page description summary...') }}</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const titleInput = document.getElementById('meta_title');
        const descInput = document.getElementById('meta_description');
        const ogTitleInput = document.getElementById('og_title');
        const ogDescInput = document.getElementById('og_description');

        const titleCounter = document.getElementById('titleCounter');
        const descCounter = document.getElementById('descCounter');

        const serpTitle = document.getElementById('serpTitle');
        const serpDesc = document.getElementById('serpDesc');
        const ogCardTitle = document.getElementById('ogCardTitle');
        const ogCardDesc = document.getElementById('ogCardDesc');

        function updateTitle() {
            const val = titleInput.value.trim();
            const len = val.length;
            titleCounter.textContent = `${len} / 60 chars (Recommended: 50-60)`;
            if (len >= 50 && len <= 60) {
                titleCounter.className = 'text-success fw-bold';
            } else if (len > 60) {
                titleCounter.className = 'text-warning fw-bold';
            } else {
                titleCounter.className = 'text-muted';
            }

            serpTitle.textContent = val || 'Page Title Will Appear Here';
            if (!ogTitleInput.value.trim()) {
                ogCardTitle.textContent = val || 'Page Title';
            }
        }

        function updateDesc() {
            const val = descInput.value.trim();
            const len = val.length;
            descCounter.textContent = `${len} / 160 chars (Recommended: 150-160)`;
            if (len >= 150 && len <= 160) {
                descCounter.className = 'text-success fw-bold';
            } else if (len > 160) {
                descCounter.className = 'text-warning fw-bold';
            } else {
                descCounter.className = 'text-muted';
            }

            serpDesc.textContent = val || 'Your page meta description will be displayed here in search engine results snippets...';
            if (!ogDescInput.value.trim()) {
                ogCardDesc.textContent = val || 'Page description summary...';
            }
        }

        titleInput.addEventListener('input', updateTitle);
        descInput.addEventListener('input', updateDesc);

        ogTitleInput.addEventListener('input', function() {
            ogCardTitle.textContent = this.value.trim() || titleInput.value.trim() || 'Page Title';
        });

        ogDescInput.addEventListener('input', function() {
            ogCardDesc.textContent = this.value.trim() || descInput.value.trim() || 'Page description summary...';
        });

        updateTitle();
        updateDesc();
    });
</script>
@endpush

