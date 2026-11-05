@extends('Admin.layout')

@section('title', 'Edit Infrastructure: ' . $infrastructure->title)

@section('content')
<div class="mb-4">
    <a href="{{ route('admin.infrastructures.index') }}" class="btn btn-sm btn-outline-secondary mb-2">
        <i class="bx bx-arrow-back me-1"></i> Back to Infrastructure List
    </a>
    <h4 class="fw-bold mb-1"><span class="text-muted fw-light">Convention Centre / Infrastructure /</span> Edit Infrastructure</h4>
    <p class="text-muted mb-0">Update title, photograph, description, and bullet points.</p>
</div>

<div class="row">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-body p-4">
                <form action="{{ route('admin.infrastructures.update', $infrastructure->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <!-- Title -->
                    <div class="mb-3">
                        <label class="form-label" for="title">Title / Space Name <span class="text-danger">*</span></label>
                        <input
                            type="text"
                            class="form-control @error('title') is-invalid @enderror"
                            id="title"
                            name="title"
                            value="{{ old('title', $infrastructure->title) }}"
                            required
                        />
                        @error('title')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Current Image Preview & Upload -->
                    <div class="mb-3">
                        <label class="form-label" for="image">Photograph / Space Image</label>
                        @if($infrastructure->image)
                            <div class="mb-2">
                                <img src="{{ $infrastructure->image_url }}" alt="{{ $infrastructure->title }}" class="img-thumbnail rounded" style="max-height: 140px;">
                            </div>
                        @endif
                        <input
                            type="file"
                            class="form-control @error('image') is-invalid @enderror"
                            id="image"
                            name="image"
                            accept="image/*"
                        />
                        <div class="form-text">Upload a new photo to replace the current image. Supported formats: JPEG, PNG, JPG, WEBP.</div>
                        @error('image')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Description -->
                    <div class="mb-3">
                        <label class="form-label" for="description">Description</label>
                        <textarea
                            class="form-control @error('description') is-invalid @enderror"
                            id="description"
                            name="description"
                            rows="3"
                        >{{ old('description', $infrastructure->description) }}</textarea>
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Points / Bullet Highlights -->
                    <div class="mb-3">
                        <label class="form-label" for="points">
                            Points / Key Features <span class="badge bg-label-info ms-1">One per line</span>
                        </label>
                        <textarea
                            class="form-control @error('points') is-invalid @enderror"
                            id="points"
                            name="points"
                            rows="5"
                        >{{ old('points', $infrastructure->points) }}</textarea>
                        <div class="form-text">Type each feature point on a new line. They will be displayed as bullet points on the website.</div>
                        @error('points')
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
                                value="{{ old('order', $infrastructure->order) }}"
                            />
                            @error('order')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Status -->
                        <div class="col-md-6">
                            <label class="form-label" for="status">Status</label>
                            <select class="form-select @error('status') is-invalid @enderror" id="status" name="status">
                                <option value="1" {{ old('status', $infrastructure->status) ? 'selected' : '' }}>Active & Visible</option>
                                <option value="0" {{ !old('status', $infrastructure->status) ? 'selected' : '' }}>Inactive / Hidden</option>
                            </select>
                            @error('status')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary px-4">
                            <i class="bx bx-save me-1"></i> Update Infrastructure
                        </button>
                        <a href="{{ route('admin.infrastructures.index') }}" class="btn btn-outline-secondary">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

