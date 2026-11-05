@extends('Admin.layout')

@section('title', 'Add What We Offer Item')

@section('content')
<div class="mb-4">
    <a href="{{ route('admin.what-we-offers.index') }}" class="btn btn-sm btn-outline-secondary mb-2">
        <i class="bx bx-arrow-back me-1"></i> Back to What We Offer List
    </a>
    <h4 class="fw-bold mb-1"><span class="text-muted fw-light">Convention Centre / What We Offer /</span> Add Item</h4>
    <p class="text-muted mb-0">Add an amenity, service, or event highlight to the What We Offer section.</p>
</div>

<div class="row">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-body p-4">
                <form action="{{ route('admin.what-we-offers.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <!-- Title -->
                    <div class="mb-3">
                        <label class="form-label" for="title">Title <span class="text-danger">*</span></label>
                        <input
                            type="text"
                            class="form-control @error('title') is-invalid @enderror"
                            id="title"
                            name="title"
                            value="{{ old('title') }}"
                            placeholder="e.g. Wedding Celebrations, Musical Extravaganzas, 5-Star Dining"
                            required
                        />
                        @error('title')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Images row -->
                    <div class="row g-3 mb-3">
                        <!-- Icon Upload (Convention Centre) -->
                        <div class="col-md-6">
                            <label class="form-label" for="icon">
                                Icon Image
                                <span class="badge bg-label-warning ms-1">Convention Centre</span>
                            </label>
                            <input
                                type="file"
                                class="form-control @error('icon') is-invalid @enderror"
                                id="icon"
                                name="icon"
                                accept="image/*"
                                onchange="previewImage(this, 'icon-preview')"
                            />
                            <div class="form-text">Icon displayed in the Convention Centre section. Max 2MB.</div>
                            @error('icon')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <div class="mt-2" id="icon-preview-wrapper" style="display:none;">
                                <img id="icon-preview" src="#" alt="Icon preview" class="img-thumbnail" style="max-height:100px;">
                            </div>
                        </div>

                        <!-- Image Upload (Home Section) -->
                        <div class="col-md-6">
                            <label class="form-label" for="image">
                                Photograph / Image
                                <span class="badge bg-label-info ms-1">Home Section</span>
                            </label>
                            <input
                                type="file"
                                class="form-control @error('image') is-invalid @enderror"
                                id="image"
                                name="image"
                                accept="image/*"
                                onchange="previewImage(this, 'image-preview')"
                            />
                            <div class="form-text">Photo displayed in the Home section. Max 5MB.</div>
                            @error('image')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <div class="mt-2" id="image-preview-wrapper" style="display:none;">
                                <img id="image-preview" src="#" alt="Image preview" class="img-thumbnail" style="max-height:100px;">
                            </div>
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
                            placeholder="Tailored setups featuring elegant decor, seamless arrangements, and world-class hospitality."
                        >{{ old('description') }}</textarea>
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="row g-3 mb-4">
                        <!-- Order -->
                        <div class="col-md-6">
                            <label class="form-label" for="order">Display Sequence Order</label>
                            <input
                                type="number"
                                min="0"
                                class="form-control @error('order') is-invalid @enderror"
                                id="order"
                                name="order"
                                value="{{ old('order', $nextOrder) }}"
                            />
                            @error('order')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Status -->
                        <div class="col-md-6">
                            <label class="form-label" for="status">Status</label>
                            <select class="form-select @error('status') is-invalid @enderror" id="status" name="status">
                                <option value="1" {{ old('status', '1') == '1' ? 'selected' : '' }}>Active &amp; Visible</option>
                                <option value="0" {{ old('status') === '0' ? 'selected' : '' }}>Inactive / Hidden</option>
                            </select>
                            @error('status')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary px-4">
                            <i class="bx bx-save me-1"></i> Save Offer Item
                        </button>
                        <a href="{{ route('admin.what-we-offers.index') }}" class="btn btn-outline-secondary">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Help Card -->
    <div class="col-lg-4">
        <div class="card border-0 bg-label-info">
            <div class="card-body">
                <h6 class="fw-bold mb-2"><i class="bx bx-info-circle me-1"></i> Image Usage Guide</h6>
                <ul class="mb-0 small ps-3">
                    <li class="mb-1"><strong>Icon</strong> — Small image/icon shown alongside each offer in the <em>Convention Centre</em> page.</li>
                    <li><strong>Photograph</strong> — Full-width or card photo shown in the <em>Home</em> page "What We Offer" grid.</li>
                </ul>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
function previewImage(input, previewId) {
    const preview = document.getElementById(previewId);
    const wrapper = document.getElementById(previewId + '-wrapper');
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = function(e) {
            preview.src = e.target.result;
            wrapper.style.display = 'block';
        };
        reader.readAsDataURL(input.files[0]);
    }
}
</script>
@endpush
@endsection
