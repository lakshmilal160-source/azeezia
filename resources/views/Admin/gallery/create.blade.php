@extends('Admin.layout')

@section('title', 'Upload Photo')

@section('content')
<div class="mb-4">
    <a href="{{ route('admin.gallery.index') }}" class="btn btn-sm btn-outline-secondary mb-2">
        <i class="bx bx-arrow-back me-1"></i> Back to Gallery
    </a>
    <h4 class="fw-bold mb-1"><span class="text-muted fw-light">Media /</span> Upload Photo to Gallery</h4>
</div>

<div class="row">
    <div class="col-lg-7">
        <div class="card">
            <div class="card-body p-4">
                <form action="{{ route('admin.gallery.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <!-- Category -->
                    <div class="mb-3">
                        <label class="form-label" for="gallery_category_id">Gallery Category <span class="text-danger">*</span></label>
                        <select class="form-select @error('gallery_category_id') is-invalid @enderror" id="gallery_category_id" name="gallery_category_id" required>
                            <option value="">Select Category</option>
                            @foreach($categories as $cat)
                                <option value="{{ $cat->id }}" {{ old('gallery_category_id') == $cat->id ? 'selected' : '' }}>
                                    {{ $cat->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('gallery_category_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Title -->
                    <div class="mb-3">
                        <label class="form-label" for="title">Photo Title / Caption</label>
                        <input
                            type="text"
                            class="form-control @error('title') is-invalid @enderror"
                            id="title"
                            name="title"
                            value="{{ old('title') }}"
                            placeholder="e.g. Evening Lighting in Grand Hall"
                        />
                        @error('title')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Image File -->
                    <div class="mb-3">
                        <label class="form-label" for="image">Photo File <span class="text-danger">*</span></label>
                        <input type="file" class="form-control @error('image') is-invalid @enderror" id="image" name="image" accept="image/*" required>
                        @error('image')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Alt Text for SEO -->
                    <div class="mb-3">
                        <label class="form-label" for="alt_text">
                            Image Alt Text (SEO)
                            <span class="badge bg-label-success ms-1">Google Image Search</span>
                        </label>
                        <input
                            type="text"
                            class="form-control @error('alt_text') is-invalid @enderror"
                            id="alt_text"
                            name="alt_text"
                            value="{{ old('alt_text') }}"
                            placeholder="e.g. Azeezia convention hall wedding banquet stage decoration"
                        />
                        <div class="form-text">Describe the image accurately to rank higher in Google Images.</div>
                        @error('alt_text')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="row">
                        <!-- Sort Order -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label" for="sort_order">Sort Order</label>
                            <input type="number" min="0" class="form-control" id="sort_order" name="sort_order" value="{{ old('sort_order', 0) }}">
                        </div>

                        <!-- Status -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label" for="is_active">Status</label>
                            <select class="form-select" id="is_active" name="is_active">
                                <option value="1" {{ old('is_active', '1') == '1' ? 'selected' : '' }}>Active</option>
                                <option value="0" {{ old('is_active') == '0' ? 'selected' : '' }}>Inactive</option>
                            </select>
                        </div>
                    </div>

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary px-4">
                            <i class="bx bx-upload me-1"></i> Upload Image
                        </button>
                        <a href="{{ route('admin.gallery.index') }}" class="btn btn-outline-secondary">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

