@extends('Admin.layout')

@section('title', 'Add Upcoming Project')

@section('content')
<div class="mb-4">
    <a href="{{ route('admin.upcoming-projects.index') }}" class="btn btn-sm btn-outline-secondary mb-2">
        <i class="bx bx-arrow-back me-1"></i> Back to Projects
    </a>
    <h4 class="fw-bold mb-1"><span class="text-muted fw-light">Projects / Upcoming Projects /</span> Add Project</h4>
    <p class="text-muted mb-0">Create a new development with live visual mockup preview matching your website design.</p>
</div>

<div class="row">
    <!-- Form Column -->
    <div class="col-lg-7 mb-4">
        <div class="card">
            <div class="card-header border-bottom">
                <h5 class="card-title mb-0"><i class="bx bx-rocket me-1 text-primary"></i> Project Information</h5>
            </div>
            <div class="card-body pt-4">
                <form action="{{ route('admin.upcoming-projects.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <!-- Title -->
                    <div class="mb-3">
                        <label class="form-label" for="title">Project Title <span class="text-danger">*</span></label>
                        <input
                            type="text"
                            class="form-control @error('title') is-invalid @enderror"
                            id="title"
                            name="title"
                            value="{{ old('title') }}"
                            placeholder="e.g. Ayurvedic Spa and Wellness Resort"
                            required
                        />
                        @error('title')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="row">
                        <!-- Category -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label" for="category">Category (Uppercase Kicker)</label>
                            <input
                                type="text"
                                class="form-control @error('category') is-invalid @enderror"
                                id="category"
                                name="category"
                                list="suggestedCategoriesList"
                                value="{{ old('category') }}"
                                placeholder="e.g. WELLNESS RETREAT"
                            />
                            <datalist id="suggestedCategoriesList">
                                @foreach($suggestedCategories as $cat)
                                    <option value="{{ $cat }}"></option>
                                @endforeach
                            </datalist>
                            @error('category')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Subtitle / Detail -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label" for="subtitle">Subtitle / Type</label>
                            <input
                                type="text"
                                class="form-control @error('subtitle') is-invalid @enderror"
                                id="subtitle"
                                name="subtitle"
                                value="{{ old('subtitle') }}"
                                placeholder="e.g. Upcoming Destination or Proposed Development"
                            />
                            @error('subtitle')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Quick Category Chips -->
                    <div class="mb-3">
                        <span class="small text-muted me-1 d-block mb-1">Quick Category Suggestions:</span>
                        <div class="d-flex flex-wrap gap-1">
                            @foreach($suggestedCategories as $cat)
                                <button type="button" class="btn btn-xs btn-outline-primary select-cat-btn" data-category="{{ $cat }}">
                                    {{ $cat }}
                                </button>
                            @endforeach
                        </div>
                    </div>

                    <!-- Description -->
                    <div class="mb-3">
                        <label class="form-label" for="description">Description</label>
                        <textarea
                            class="form-control @error('description') is-invalid @enderror"
                            id="description"
                            name="description"
                            rows="4"
                            placeholder="An upcoming destination dedicated to traditional wellness, relaxation, and rejuvenation in a peaceful setting..."
                        >{{ old('description') }}</textarea>
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="row">
                        <!-- Status Stage -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label" for="status">Project Stage / Status Badge <span class="text-danger">*</span></label>
                            <select class="form-select @error('status') is-invalid @enderror" id="status" name="status" required>
                                @foreach($statusOptions as $st)
                                    <option value="{{ $st }}" {{ old('status', 'Upcoming') === $st ? 'selected' : '' }}>{{ $st }}</option>
                                @endforeach
                            </select>
                            <div class="form-text">Controls the badge on top of the image and the right-side status label.</div>
                            @error('status')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Sequence Number / Order -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label" for="order">Sequence Number (Order)</label>
                            <input
                                type="number"
                                min="1"
                                class="form-control @error('order') is-invalid @enderror"
                                id="order"
                                name="order"
                                value="{{ old('order', $nextOrder) }}"
                            />
                            <div class="form-text">Renders as 2-digit number (e.g. 1 &rarr; 01, 2 &rarr; 02).</div>
                            @error('order')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Concept Image Upload -->
                    <div class="mb-3">
                        <label class="form-label" for="image">Concept Image / Architectural Render</label>
                        <input
                            type="file"
                            class="form-control @error('image') is-invalid @enderror"
                            id="image"
                            name="image"
                            accept="image/*"
                        />
                        <div class="form-text">Recommended: 1200x800px (JPG, PNG, WebP).</div>
                        @error('image')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Visibility Status -->
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
                            <i class="bx bx-save me-1"></i> Save Project
                        </button>
                        <a href="{{ route('admin.upcoming-projects.index') }}" class="btn btn-outline-secondary">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Live Preview Mockup Column -->
    <div class="col-lg-5 mb-4">
        <div class="card sticky-top" style="top: 20px;">
            <div class="card-header border-bottom d-flex justify-content-between align-items-center py-3">
                <h6 class="card-title mb-0"><i class="bx bx-show me-1 text-info"></i> Live Card Mockup</h6>
                <span class="badge bg-label-success">Exact Design Replica</span>
            </div>
            <div class="card-body p-3" style="background-color: #f8f6f0;">
                <p class="text-muted small mb-3">Live representation of how this project card will look on your website:</p>

                <!-- Mockup Card -->
                <div class="card border-0 rounded-4 shadow-sm overflow-hidden bg-white p-3">
                    <div class="d-flex flex-column gap-3">
                        <!-- Top Header with Thumbnail & Number -->
                        <div class="d-flex justify-content-between align-items-start gap-3">
                            <!-- Image Thumbnail with Badge -->
                            <div class="position-relative rounded-3 overflow-hidden flex-shrink-0" style="width: 140px; height: 100px;">
                                <div id="previewImageWrapper" class="w-100 h-100 d-flex flex-column align-items-center justify-content-center text-white"
                                     style="background: linear-gradient(135deg, #3d5a45 0%, #233b2a 100%);">
                                    <i class="bx bx-building fs-2 mb-0" style="opacity: 0.85;"></i>
                                </div>

                                <!-- Overlaid Status Badge -->
                                <span id="previewBadge" class="position-absolute top-0 start-0 m-2 badge text-uppercase text-white px-2 py-1 shadow-sm"
                                      style="font-size: 0.62rem; letter-spacing: 0.8px; font-weight: 700; background: #689f38; border-radius: 4px;">
                                    UPCOMING
                                </span>
                            </div>

                            <!-- Right: Status & Number Column -->
                            <div class="text-end ps-2" style="border-left: 2px dotted #d1d5db; min-width: 90px;">
                                <div id="previewStatusLabel" class="fst-italic text-secondary small mb-1" style="font-family: Georgia, serif; font-size: 1rem;">
                                    Upcoming
                                </div>
                                <div id="previewOrderNumber" class="fw-bolder text-dark" style="font-family: Georgia, 'Playfair Display', serif; font-size: 2rem; line-height: 1;">
                                    {{ sprintf('%02d', $nextOrder) }}
                                </div>
                            </div>
                        </div>

                        <!-- Content Area -->
                        <div>
                            <!-- Category & Subtitle -->
                            <div class="d-flex align-items-center gap-1 mb-1">
                                <span id="previewCategory" class="fw-bold text-uppercase" style="color: #689f38; font-size: 0.78rem; letter-spacing: 1px;">
                                    WELLNESS RETREAT
                                </span>
                                <span id="previewSubtitle" class="text-muted" style="font-size: 0.8rem;">· Upcoming Destination</span>
                            </div>

                            <!-- Title -->
                            <h5 id="previewTitle" class="mb-2 text-dark" style="font-family: Georgia, 'Playfair Display', serif; font-size: 1.25rem;">
                                Ayurvedic Spa and Wellness Resort
                            </h5>

                            <!-- Description -->
                            <p id="previewDescription" class="mb-0 text-muted" style="font-size: 0.88rem; line-height: 1.5;">
                                An upcoming destination dedicated to traditional wellness, relaxation, and rejuvenation in a peaceful setting...
                            </p>
                        </div>
                    </div>
                </div>

                <div class="mt-3 p-2 bg-white rounded small border text-muted">
                    <i class="bx bx-check-circle text-success me-1"></i>
                    Updates in real-time as you fill in the form fields.
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const titleInput = document.getElementById('title');
    const categoryInput = document.getElementById('category');
    const subtitleInput = document.getElementById('subtitle');
    const descInput = document.getElementById('description');
    const statusSelect = document.getElementById('status');
    const orderInput = document.getElementById('order');
    const imageInput = document.getElementById('image');

    const previewTitle = document.getElementById('previewTitle');
    const previewCategory = document.getElementById('previewCategory');
    const previewSubtitle = document.getElementById('previewSubtitle');
    const previewDesc = document.getElementById('previewDescription');
    const previewBadge = document.getElementById('previewBadge');
    const previewStatusLabel = document.getElementById('previewStatusLabel');
    const previewOrderNumber = document.getElementById('previewOrderNumber');
    const previewImageWrapper = document.getElementById('previewImageWrapper');

    // Title
    if (titleInput && previewTitle) {
        titleInput.addEventListener('input', function () {
            previewTitle.textContent = this.value.trim() ? this.value : 'Project Title';
        });
    }

    // Category
    if (categoryInput && previewCategory) {
        categoryInput.addEventListener('input', function () {
            previewCategory.textContent = this.value.trim() ? this.value.toUpperCase() : 'DEVELOPMENT';
        });
    }

    // Subtitle
    if (subtitleInput && previewSubtitle) {
        subtitleInput.addEventListener('input', function () {
            previewSubtitle.textContent = this.value.trim() ? '· ' + this.value : '';
        });
    }

    // Description
    if (descInput && previewDesc) {
        descInput.addEventListener('input', function () {
            previewDesc.textContent = this.value.trim() ? this.value : 'Project description will appear here...';
        });
    }

    // Status Stage
    if (statusSelect && previewBadge && previewStatusLabel) {
        statusSelect.addEventListener('change', function () {
            const val = this.value;
            previewBadge.textContent = val.toUpperCase();
            previewStatusLabel.textContent = val;
            if (val.toLowerCase() === 'proposed') {
                previewBadge.style.background = '#212529';
            } else {
                previewBadge.style.background = '#689f38';
            }
        });
    }

    // Order
    if (orderInput && previewOrderNumber) {
        orderInput.addEventListener('input', function () {
            const num = parseInt(this.value, 10);
            previewOrderNumber.textContent = isNaN(num) ? '01' : (num < 10 ? '0' + num : num);
        });
    }

    // Image Upload Preview
    if (imageInput && previewImageWrapper) {
        imageInput.addEventListener('change', function () {
            const file = this.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    previewImageWrapper.innerHTML = '<img src="' + e.target.result + '" class="w-100 h-100 object-fit-cover">';
                };
                reader.readAsDataURL(file);
            }
        });
    }

    // Quick Category Buttons
    document.querySelectorAll('.select-cat-btn').forEach(btn => {
        btn.addEventListener('click', function () {
            categoryInput.value = this.dataset.category;
            previewCategory.textContent = this.dataset.category;
        });
    });
});
</script>
@endpush
