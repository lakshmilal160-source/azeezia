@extends('Admin.layout')

@section('title', 'Edit Banner')

@section('content')
<div class="mb-4">
    <a href="{{ route('admin.sliders.index') }}" class="btn btn-sm btn-outline-secondary mb-2">
        <i class="bx bx-arrow-back me-1"></i> Back to Banners
    </a>
    <h4 class="fw-bold mb-1"><span class="text-muted fw-light">Marketing /</span> Edit: {{ $slider->title }}</h4>
</div>

<div class="row">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-body p-4">
                <form action="{{ route('admin.sliders.update', $slider->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <!-- Title -->
                    <div class="mb-3">
                        <label class="form-label" for="title">Banner Title / Heading <span class="text-danger">*</span></label>
                        <input
                            type="text"
                            class="form-control @error('title') is-invalid @enderror"
                            id="title"
                            name="title"
                            value="{{ old('title', $slider->title) }}"
                            required
                        />
                        @error('title')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Subtitle -->
                    <div class="mb-3">
                        <label class="form-label" for="subtitle">Subtitle / Tagline</label>
                        <input
                            type="text"
                            class="form-control @error('subtitle') is-invalid @enderror"
                            id="subtitle"
                            name="subtitle"
                            value="{{ old('subtitle', $slider->subtitle) }}"
                        />
                        @error('subtitle')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Description -->
                    <div class="mb-3">
                        <label class="form-label" for="description">Short Paragraph</label>
                        <textarea
                            class="form-control @error('description') is-invalid @enderror"
                            id="description"
                            name="description"
                            rows="3"
                        >{{ old('description', $slider->description) }}</textarea>
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Image -->
                    <div class="mb-3">
                        <label class="form-label" for="image">Replace Banner Image</label>
                        <input type="file" class="form-control @error('image') is-invalid @enderror" id="image" name="image" accept="image/*">
                        @error('image')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror

                        @if($slider->image)
                            <div class="mt-2">
                                <span class="small text-muted d-block mb-1">Current Banner:</span>
                                <img src="{{ asset('storage/' . $slider->image) }}" alt="Preview" class="rounded border" style="width: 200px; height: 100px; object-fit: cover;">
                            </div>
                        @endif
                    </div>

                    <div class="row">
                        <!-- Button Text -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label" for="button_text">Button Text</label>
                            <input type="text" class="form-control @error('button_text') is-invalid @enderror" id="button_text" name="button_text" value="{{ old('button_text', $slider->button_text) }}">
                            @error('button_text')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Button URL -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label" for="button_url">Button Link URL</label>
                            <input type="text" class="form-control @error('button_url') is-invalid @enderror" id="button_url" name="button_url" value="{{ old('button_url', $slider->button_url) }}">
                            @error('button_url')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row">
                        <!-- Sort Order -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label" for="sort_order">Sort Order</label>
                            <input type="number" min="0" class="form-control @error('sort_order') is-invalid @enderror" id="sort_order" name="sort_order" value="{{ old('sort_order', $slider->sort_order) }}">
                            @error('sort_order')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Status -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label" for="is_active">Status</label>
                            <select class="form-select @error('is_active') is-invalid @enderror" id="is_active" name="is_active">
                                <option value="1" {{ old('is_active', $slider->is_active) ? 'selected' : '' }}>Active</option>
                                <option value="0" {{ !old('is_active', $slider->is_active) ? 'selected' : '' }}>Inactive</option>
                            </select>
                            @error('is_active')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary px-4">
                            <i class="bx bx-save me-1"></i> Update Banner
                        </button>
                        <a href="{{ route('admin.sliders.index') }}" class="btn btn-outline-secondary">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

