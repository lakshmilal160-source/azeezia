@extends('Admin.layout')

@section('title', 'Edit Page Banner - ' . $banner->page_name)

@section('content')
<div class="mb-4">
    <a href="{{ route('admin.banners.index') }}" class="btn btn-sm btn-outline-secondary mb-2">
        <i class="bx bx-arrow-back me-1"></i> Back to Banners
    </a>
    <h4 class="fw-bold mb-1"><span class="text-muted fw-light">Content / Page Banners /</span> {{ $banner->page_name }}</h4>
    <p class="text-muted mb-0">Edit the 2-part styled headline, description, or hero image for this page banner.</p>
</div>

<div class="row">
    <!-- Form Column -->
    <div class="col-lg-12 mb-4">
        <div class="card">
            <div class="card-header border-bottom">
                <h5 class="card-title mb-0"><i class="bx bx-edit me-1 text-primary"></i> Edit Banner Details</h5>
            </div>
            <div class="card-body pt-4">
                <form action="{{ route('admin.banners.update', $banner->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <!-- Page Name -->
                    <div class="mb-3">
                        <label class="form-label" for="page_name">Page Name <span class="text-danger">*</span></label>
                        <input
                            type="text"
                            class="form-control @error('page_name') is-invalid @enderror"
                            id="page_name"
                            name="page_name"
                            list="commonPagesList"
                            value="{{ old('page_name', $banner->page_name) }}"
                            required
                        />
                        <datalist id="commonPagesList">
                            @foreach($suggestedPages as $name => $slug)
                                <option value="{{ $name }}">{{ $slug }}</option>
                            @endforeach
                        </datalist>
                        @error('page_name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Page Slug -->
                    <div class="mb-3">
                        <label class="form-label" for="page_slug">Page Identifier / Slug <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <span class="input-group-text font-monospace">{{ url('/') }}/</span>
                            <input
                                type="text"
                                class="form-control font-monospace @error('page_slug') is-invalid @enderror"
                                id="page_slug"
                                name="page_slug"
                                value="{{ old('page_slug', $banner->page_slug) }}"
                                required
                            />
                        </div>
                        <div class="form-text">Used on frontend code to query this banner: <code>PageBanner::getForPage('{{ $banner->page_slug }}')</code></div>
                        @error('page_slug')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="border rounded p-3 bg-light mb-3">
                        <h6 class="mb-3 fw-bold text-dark"><i class="bx bx-font me-1 text-primary"></i> 2-Part Headline (Styled Lines)</h6>

                        <!-- Title Part 1 -->
                        <div class="mb-3">
                            <div class="d-flex justify-content-between align-items-center mb-1">
                                <label class="form-label mb-0" for="title_part1">Title Line 1 (Top Accent / Subtitle)</label>
                                <span class="badge bg-label-warning small">Line 1 Typography</span>
                            </div>
                            <input
                                type="text"
                                class="form-control @error('title_part1') is-invalid @enderror"
                                id="title_part1"
                                name="title_part1"
                                value="{{ old('title_part1', $banner->title_part1) }}"
                                placeholder="e.g. DISCOVER OUR STORY or WORLD-CLASS VENUES"
                            />
                            <div class="form-text">Top subtitle or kicker line, rendered with accent styling or uppercase font.</div>
                            @error('title_part1')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Title Part 2 -->
                        <div class="mb-0">
                            <div class="d-flex justify-content-between align-items-center mb-1">
                                <label class="form-label mb-0" for="title_part2">Title Line 2 (Main Headline) <span class="text-danger">*</span></label>
                                <span class="badge bg-label-primary small">Line 2 Typography</span>
                            </div>
                            <input
                                type="text"
                                class="form-control @error('title_part2') is-invalid @enderror"
                                id="title_part2"
                                name="title_part2"
                                value="{{ old('title_part2', $banner->title_part2) }}"
                                placeholder="e.g. About Azeezia Group or Grand Convention Centres"
                                required
                            />
                            <div class="form-text">Main prominent headline line, rendered in large bold display font.</div>
                            @error('title_part2')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Description -->
                    <div class="mb-3">
                        <label class="form-label" for="description">Banner Description / Tagline</label>
                        <textarea
                            class="form-control @error('description') is-invalid @enderror"
                            id="description"
                            name="description"
                            rows="3"
                        >{{ old('description', $banner->description) }}</textarea>
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Current Banner Image & Upload -->
                    <div class="mb-3">
                        <label class="form-label" for="banner_image">Banner Background Image</label>
                        @if($banner->banner_image)
                            <div class="mb-2 p-2 bg-light rounded border d-flex align-items-center gap-3">
                                <img
                                    src="{{ asset('storage/' . $banner->banner_image) }}"
                                    alt="Current Banner"
                                    class="rounded border shadow-sm object-fit-cover"
                                    style="width: 140px; height: 70px;"
                                />
                                <div class="small">
                                    <strong class="d-block text-dark">Current Banner Photo</strong>
                                    <span class="text-muted">Upload a new image below to replace it.</span>
                                </div>
                            </div>
                        @endif
                        <input
                            type="file"
                            class="form-control @error('banner_image') is-invalid @enderror"
                            id="banner_image"
                            name="banner_image"
                            accept="image/*"
                        />
                        <div class="form-text">Leave blank to retain current image. Recommended: 1920x600px (JPG, PNG, WebP).</div>
                        @error('banner_image')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Status -->
                    <div class="mb-4">
                        <label class="form-label" for="is_active">Publish Status</label>
                        <select class="form-select @error('is_active') is-invalid @enderror" id="is_active" name="is_active">
                            <option value="1" {{ old('is_active', $banner->is_active) ? 'selected' : '' }}>Active & Visible on Website</option>
                            <option value="0" {{ !old('is_active', $banner->is_active) ? 'selected' : '' }}>Draft / Inactive</option>
                        </select>
                        @error('is_active')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary px-4">
                            <i class="bx bx-save me-1"></i> Update Banner
                        </button>
                        <a href="{{ route('admin.banners.index') }}" class="btn btn-outline-secondary">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const part1Input = document.getElementById('title_part1');
    const part2Input = document.getElementById('title_part2');
    const descInput = document.getElementById('description');
    const slugInput = document.getElementById('page_slug');
    const imageInput = document.getElementById('banner_image');

    const previewPart1 = document.getElementById('previewPart1');
    const previewPart2 = document.getElementById('previewPart2');
    const previewDesc = document.getElementById('previewDescription');
    const previewContainer = document.getElementById('bannerPreviewContainer');
    const codeSlugPreview = document.getElementById('codeSlugPreview');

    // Live update Line 1
    if (part1Input && previewPart1) {
        part1Input.addEventListener('input', function () {
            previewPart1.textContent = this.value.trim() ? this.value : 'LINE 1 (ACCENT TITLE)';
        });
    }

    // Live update Line 2
    if (part2Input && previewPart2) {
        part2Input.addEventListener('input', function () {
            previewPart2.textContent = this.value.trim() ? this.value : 'Line 2 (Main Headline)';
        });
    }

    // Live update Description
    if (descInput && previewDesc) {
        descInput.addEventListener('input', function () {
            previewDesc.textContent = this.value.trim() ? this.value : 'Banner description text will appear here...';
        });
    }

    // Live update code snippet slug
    if (slugInput && codeSlugPreview) {
        slugInput.addEventListener('input', function () {
            codeSlugPreview.textContent = this.value.trim() ? this.value : 'page-slug';
        });
    }

    // Live image preview
    if (imageInput && previewContainer) {
        imageInput.addEventListener('change', function () {
            const file = this.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    previewContainer.style.backgroundImage = 'url(' + e.target.result + ')';
                };
                reader.readAsDataURL(file);
            }
        });
    }
});
</script>
@endpush

