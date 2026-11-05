@extends('Admin.layout')

@section('title', 'Add Page Banner')

@section('content')
<div class="mb-4">
    <a href="{{ route('admin.banners.index') }}" class="btn btn-sm btn-outline-secondary mb-2">
        <i class="bx bx-arrow-back me-1"></i> Back to Banners
    </a>
    <h4 class="fw-bold mb-1"><span class="text-muted fw-light">Content / Page Banners /</span> Add Banner</h4>
    <p class="text-muted mb-0">Create a page banner with a 2-part styled headline, description, and hero background image.</p>
</div>

<div class="row">
    <!-- Form Column -->
    <div class="col-lg-7 mb-4">
        <div class="card">
            <div class="card-header border-bottom">
                <h5 class="card-title mb-0"><i class="bx bx-image-alt me-1 text-primary"></i> Banner Details</h5>
            </div>
            <div class="card-body pt-4">
                <form action="{{ route('admin.banners.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <!-- Page Selection -->
                    <div class="mb-3">
                        <label class="form-label" for="page_name">Page Name <span class="text-danger">*</span></label>
                        <input
                            type="text"
                            class="form-control @error('page_name') is-invalid @enderror"
                            id="page_name"
                            name="page_name"
                            list="commonPagesList"
                            data-slug-source
                            value="{{ old('page_name') }}"
                            placeholder="e.g. About Us or Convention Centres"
                            required
                        />
                        <datalist id="commonPagesList">
                            @foreach($suggestedPages as $name => $slug)
                                <option value="{{ $name }}">{{ $slug }}</option>
                            @endforeach
                        </datalist>
                        <div class="form-text">Choose a common website page or type your own custom page title.</div>
                        @error('page_name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Quick Page Badges -->
                    <div class="mb-3">
                        <label class="form-label d-block text-muted small fw-semibold">Quick Select Common Pages:</label>
                        <div class="d-flex flex-wrap gap-1">
                            @foreach($suggestedPages as $name => $slug)
                                <button type="button" class="btn btn-xs btn-outline-primary quick-page-btn" data-name="{{ $name }}" data-slug="{{ $slug }}">
                                    {{ $name }}
                                </button>
                            @endforeach
                        </div>
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
                                data-slug-target
                                value="{{ old('page_slug') }}"
                                placeholder="about"
                                required
                            />
                        </div>
                        <div class="form-text">Used on frontend code to query this banner (e.g. <code>PageBanner::getForPage('about')</code>).</div>
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
                                value="{{ old('title_part1') }}"
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
                                value="{{ old('title_part2') }}"
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
                            placeholder="Brief description or intro text displayed below the headline..."
                        >{{ old('description') }}</textarea>
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Banner Image -->
                    <div class="mb-3">
                        <label class="form-label" for="banner_image">Banner Background Image</label>
                        <input
                            type="file"
                            class="form-control @error('banner_image') is-invalid @enderror"
                            id="banner_image"
                            name="banner_image"
                            accept="image/*"
                        />
                        <div class="form-text">Recommended size: 1920x600px or wide hero format (JPG, PNG, WebP).</div>
                        @error('banner_image')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Status -->
                    <div class="mb-4">
                        <label class="form-label" for="is_active">Publish Status</label>
                        <select class="form-select @error('is_active') is-invalid @enderror" id="is_active" name="is_active">
                            <option value="1" {{ old('is_active', '1') == '1' ? 'selected' : '' }}>Active & Visible on Website</option>
                            <option value="0" {{ old('is_active') == '0' ? 'selected' : '' }}>Draft / Inactive</option>
                        </select>
                        @error('is_active')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary px-4">
                            <i class="bx bx-save me-1"></i> Save Banner
                        </button>
                        <a href="{{ route('admin.banners.index') }}" class="btn btn-outline-secondary">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Live Preview Column -->
    <div class="col-lg-5 mb-4">
        <div class="card sticky-top" style="top: 20px;">
            <div class="card-header border-bottom d-flex justify-content-between align-items-center py-3">
                <h6 class="card-title mb-0"><i class="bx bx-show me-1 text-info"></i> Live Banner Mockup</h6>
                <span class="badge bg-label-success">2-Line Design</span>
            </div>
            <div class="card-body p-3">
                <p class="text-muted small mb-2">Simulates how your 2-part title, description, and hero banner image will appear on the website:</p>

                <!-- Mockup Hero Container -->
                <div id="bannerPreviewContainer" class="position-relative rounded overflow-hidden shadow text-center p-4 d-flex flex-column justify-content-center align-items-center"
                     style="min-height: 280px; background: linear-gradient(135deg, #1b2838 0%, #2a3a4c 100%); background-size: cover; background-position: center;">
                    <!-- Dark Overlay -->
                    <div class="position-absolute top-0 start-0 w-100 h-100" style="background: rgba(15, 23, 42, 0.65); z-index: 1;"></div>

                    <!-- Content -->
                    <div class="position-relative" style="z-index: 2; max-width: 90%;">
                        <!-- Line 1: Accent / Subtitle -->
                        <div id="previewPart1" class="text-uppercase fw-semibold mb-2" style="color: #f6c23e; letter-spacing: 2px; font-size: 0.8rem;">
                            {{ old('title_part1', 'DISCOVER OUR STORY') }}
                        </div>

                        <!-- Line 2: Main Headline -->
                        <h3 id="previewPart2" class="fw-bolder text-white mb-2" style="font-size: 1.5rem; text-shadow: 0 2px 4px rgba(0,0,0,0.5);">
                            {{ old('title_part2', 'About Azeezia Group') }}
                        </h3>

                        <!-- Description -->
                        <p id="previewDescription" class="text-light small mb-0" style="opacity: 0.9; line-height: 1.5;">
                            {{ old('description', 'Dedicated to crafting exceptional hospitality experiences, world-class venues, and sustainable agricultural retreats.') }}
                        </p>
                    </div>
                </div>

                <div class="mt-3 p-2 bg-lighter rounded small border">
                    <div class="d-flex align-items-center mb-1">
                        <i class="bx bx-info-circle text-primary me-1"></i>
                        <strong class="text-dark">Frontend Blade Usage:</strong>
                    </div>
                    <code class="d-block text-wrap" style="font-size: 0.78rem;">
                        &#64;php $banner = \App\Models\PageBanner::getForPage('<span id="codeSlugPreview">about</span>'); &#64;endphp<br>
                        &lt;h6 class="accent"&gt;&#123;&#123; $banner-&gt;title_part1 &#125;&#125;&lt;/h6&gt;<br>
                        &lt;h1 class="main-title"&gt;&#123;&#123; $banner-&gt;title_part2 &#125;&#125;&lt;/h1&gt;<br>
                        &lt;p&gt;&#123;&#123; $banner-&gt;description &#125;&#125;&lt;/p&gt;
                    </code>
                </div>
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

    // Quick select buttons
    document.querySelectorAll('.quick-page-btn').forEach(btn => {
        btn.addEventListener('click', function () {
            const name = this.dataset.name;
            const slug = this.dataset.slug;

            document.getElementById('page_name').value = name;
            document.getElementById('page_slug').value = slug;
            if (codeSlugPreview) {
                codeSlugPreview.textContent = slug;
            }
        });
    });
});
</script>
@endpush

