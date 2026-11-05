@extends('Admin.layout')

@section('title', 'Add Service')

@section('content')
<div class="mb-4">
    <a href="{{ route('admin.services.index') }}" class="btn btn-sm btn-outline-secondary mb-2">
        <i class="bx bx-arrow-back me-1"></i> Back to Services
    </a>
    <h4 class="fw-bold mb-1"><span class="text-muted fw-light">Content /</span> Add Service</h4>
</div>

<div class="row">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-body p-4">
                <form action="{{ route('admin.services.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <!-- Title -->
                    <div class="mb-3">
                        <label class="form-label" for="title">Service Title <span class="text-danger">*</span></label>
                        <input
                            type="text"
                            class="form-control @error('title') is-invalid @enderror"
                            id="title"
                            name="title"
                            data-slug-source
                            value="{{ old('title') }}"
                            placeholder="e.g. Grand Event Catering & Banquets"
                            required
                        />
                        @error('title')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- SEO Slug -->
                    <div class="mb-3">
                        <label class="form-label" for="slug">SEO URL Slug</label>
                        <div class="input-group">
                            <span class="input-group-text">{{ url('/services') }}/</span>
                            <input
                                type="text"
                                class="form-control @error('slug') is-invalid @enderror"
                                id="slug"
                                name="slug"
                                data-slug-target
                                value="{{ old('slug') }}"
                                placeholder="grand-event-catering-and-banquets"
                            />
                        </div>
                        @error('slug')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Description -->
                    <div class="mb-3">
                        <label class="form-label" for="description">Service Description</label>
                        <textarea
                            class="form-control @error('description') is-invalid @enderror"
                            id="description"
                            name="description"
                            rows="5"
                            placeholder="Detailed description of what this service includes..."
                        >{{ old('description') }}</textarea>
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Key Points -->
                    <div class="mb-3">
                        <label class="form-label" for="points">Key Highlights / Features (One per line)</label>
                        <textarea
                            class="form-control @error('points') is-invalid @enderror"
                            id="points"
                            name="points"
                            rows="4"
                            placeholder="Multi-cuisine catering&#10;Professional live counter chefs&#10;Customized dietary options"
                        >{{ old('points') }}</textarea>
                        <div class="form-text">Enter each bullet point feature on a new line.</div>
                        @error('points')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Image -->
                    <div class="mb-3">
                        <label class="form-label" for="image">Featured Service Image</label>
                        <input type="file" class="form-control @error('image') is-invalid @enderror" id="image" name="image" accept="image/*">
                        @error('image')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="row">
                        <!-- Sort Order -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label" for="sort_order">Display Sort Order</label>
                            <input type="number" min="0" class="form-control @error('sort_order') is-invalid @enderror" id="sort_order" name="sort_order" value="{{ old('sort_order', 0) }}">
                            @error('sort_order')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Status -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label" for="is_active">Status</label>
                            <select class="form-select @error('is_active') is-invalid @enderror" id="is_active" name="is_active">
                                <option value="1" {{ old('is_active', '1') == '1' ? 'selected' : '' }}>Active</option>
                                <option value="0" {{ old('is_active') == '0' ? 'selected' : '' }}>Inactive</option>
                            </select>
                            @error('is_active')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary px-4">
                            <i class="bx bx-save me-1"></i> Save Service
                        </button>
                        <a href="{{ route('admin.services.index') }}" class="btn btn-outline-secondary">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

