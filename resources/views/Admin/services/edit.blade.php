@extends('Admin.layout')

@section('title', 'Edit Service')

@section('content')
<div class="mb-4">
    <a href="{{ route('admin.services.index') }}" class="btn btn-sm btn-outline-secondary mb-2">
        <i class="bx bx-arrow-back me-1"></i> Back to Services
    </a>
    <h4 class="fw-bold mb-1"><span class="text-muted fw-light">Content /</span> Edit: {{ $service->title }}</h4>
</div>

<div class="row">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-body p-4">
                <form action="{{ route('admin.services.update', $service->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <!-- Title -->
                    <div class="mb-3">
                        <label class="form-label" for="title">Service Title <span class="text-danger">*</span></label>
                        <input
                            type="text"
                            class="form-control @error('title') is-invalid @enderror"
                            id="title"
                            name="title"
                            value="{{ old('title', $service->title) }}"
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
                                value="{{ old('slug', $service->slug) }}"
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
                        >{{ old('description', $service->description) }}</textarea>
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
                        >{{ old('points', is_array($service->points) ? implode("\n", $service->points) : '') }}</textarea>
                        @error('points')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Current & New Image -->
                    <div class="mb-3">
                        <label class="form-label" for="image">Featured Image</label>
                        <input type="file" class="form-control @error('image') is-invalid @enderror" id="image" name="image" accept="image/*">
                        @error('image')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror

                        @if($service->image)
                            <div class="mt-3 d-flex align-items-center gap-3 p-2 border rounded bg-light">
                                <img src="{{ asset('storage/' . $service->image) }}" alt="Preview" style="width: 80px; height: 55px; object-fit: cover;" class="rounded border">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remove_image" id="remove_image" value="1">
                                    <label class="form-check-label text-danger small" for="remove_image">Remove this image</label>
                                </div>
                            </div>
                        @endif
                    </div>

                    <div class="row">
                        <!-- Sort Order -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label" for="sort_order">Sort Order</label>
                            <input type="number" min="0" class="form-control @error('sort_order') is-invalid @enderror" id="sort_order" name="sort_order" value="{{ old('sort_order', $service->sort_order) }}">
                            @error('sort_order')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Status -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label" for="is_active">Status</label>
                            <select class="form-select @error('is_active') is-invalid @enderror" id="is_active" name="is_active">
                                <option value="1" {{ old('is_active', $service->is_active) ? 'selected' : '' }}>Active</option>
                                <option value="0" {{ !old('is_active', $service->is_active) ? 'selected' : '' }}>Inactive</option>
                            </select>
                            @error('is_active')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary px-4">
                            <i class="bx bx-save me-1"></i> Update Service
                        </button>
                        <a href="{{ route('admin.services.index') }}" class="btn btn-outline-secondary">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

