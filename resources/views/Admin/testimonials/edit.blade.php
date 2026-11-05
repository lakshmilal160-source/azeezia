@extends('Admin.layout')

@section('title', 'Edit Testimonial')

@section('content')
<div class="mb-4">
    <a href="{{ route('admin.testimonials.index') }}" class="btn btn-sm btn-outline-secondary mb-2">
        <i class="bx bx-arrow-back me-1"></i> Back to Testimonials
    </a>
    <h4 class="fw-bold mb-1"><span class="text-muted fw-light">Social Proof /</span> Edit: {{ $testimonial->customer_name }}</h4>
</div>

<div class="row">
    <div class="col-lg-7">
        <div class="card">
            <div class="card-body p-4">
                <form action="{{ route('admin.testimonials.update', $testimonial->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <!-- Customer Name -->
                    <div class="mb-3">
                        <label class="form-label" for="customer_name">Customer / Client Name <span class="text-danger">*</span></label>
                        <input
                            type="text"
                            class="form-control @error('customer_name') is-invalid @enderror"
                            id="customer_name"
                            name="customer_name"
                            value="{{ old('customer_name', $testimonial->customer_name) }}"
                            required
                        />
                        @error('customer_name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Designation -->
                    <div class="mb-3">
                        <label class="form-label" for="designation">Designation / Occasion</label>
                        <input
                            type="text"
                            class="form-control @error('designation') is-invalid @enderror"
                            id="designation"
                            name="designation"
                            value="{{ old('designation', $testimonial->designation) }}"
                        />
                        @error('designation')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Review -->
                    <div class="mb-3">
                        <label class="form-label" for="review">Customer Review / Feedback <span class="text-danger">*</span></label>
                        <textarea
                            class="form-control @error('review') is-invalid @enderror"
                            id="review"
                            name="review"
                            rows="4"
                            required
                        >{{ old('review', $testimonial->review) }}</textarea>
                        @error('review')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="row">
                        <!-- Rating -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label" for="rating">Star Rating (1 - 5)</label>
                            <select class="form-select @error('rating') is-invalid @enderror" id="rating" name="rating">
                                <option value="5" {{ old('rating', $testimonial->rating) == 5 ? 'selected' : '' }}>⭐⭐⭐⭐⭐ (5 Stars)</option>
                                <option value="4" {{ old('rating', $testimonial->rating) == 4 ? 'selected' : '' }}>⭐⭐⭐⭐ (4 Stars)</option>
                                <option value="3" {{ old('rating', $testimonial->rating) == 3 ? 'selected' : '' }}>⭐⭐⭐ (3 Stars)</option>
                            </select>
                        </div>

                        <!-- Sort Order -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label" for="sort_order">Sort Order</label>
                            <input type="number" min="0" class="form-control" id="sort_order" name="sort_order" value="{{ old('sort_order', $testimonial->sort_order) }}">
                        </div>
                    </div>

                    <!-- Photo -->
                    <div class="mb-3">
                        <label class="form-label" for="image">Replace Customer Avatar Photo</label>
                        <input type="file" class="form-control @error('image') is-invalid @enderror" id="image" name="image" accept="image/*">
                        @error('image')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror

                        @if($testimonial->image)
                            <div class="mt-2 d-flex align-items-center gap-2">
                                <img src="{{ asset('storage/' . $testimonial->image) }}" alt="Avatar" class="rounded-circle border" style="width: 48px; height: 48px; object-fit: cover;">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remove_image" id="remove_image" value="1">
                                    <label class="form-check-label text-danger small" for="remove_image">Remove photo</label>
                                </div>
                            </div>
                        @endif
                    </div>

                    <!-- Status -->
                    <div class="mb-3">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="is_active" id="is_active" value="1" {{ old('is_active', $testimonial->is_active) ? 'checked' : '' }}>
                            <label class="form-check-label" for="is_active">Publish on Website</label>
                        </div>
                    </div>

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary px-4">
                            <i class="bx bx-save me-1"></i> Update Testimonial
                        </button>
                        <a href="{{ route('admin.testimonials.index') }}" class="btn btn-outline-secondary">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

