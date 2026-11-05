@extends('Admin.layout')

@section('title', 'Add Infrastructure')

@section('content')
<div class="mb-4">
    <a href="{{ route('admin.infrastructures.index') }}" class="btn btn-sm btn-outline-secondary mb-2">
        <i class="bx bx-arrow-back me-1"></i> Back to Infrastructure List
    </a>
    <h4 class="fw-bold mb-1"><span class="text-muted fw-light">Convention Centre / Infrastructure /</span> Add Infrastructure</h4>
    <p class="text-muted mb-0">Create an infrastructure venue space with title, photo, description, and bullet points.</p>
</div>

<div class="row">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-body p-4">
                <form action="{{ route('admin.infrastructures.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <!-- Title -->
                    <div class="mb-3">
                        <label class="form-label" for="title">Title / Space Name <span class="text-danger">*</span></label>
                        <input
                            type="text"
                            class="form-control @error('title') is-invalid @enderror"
                            id="title"
                            name="title"
                            value="{{ old('title') }}"
                            placeholder="e.g. Zidan Grand Auditorium, Majlis Dining Hall, Royal VIP Lounge"
                            required
                        />
                        @error('title')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Image Upload -->
                    <div class="mb-3">
                        <label class="form-label" for="image">Photograph / Space Image</label>
                        <input
                            type="file"
                            class="form-control @error('image') is-invalid @enderror"
                            id="image"
                            name="image"
                            accept="image/*"
                        />
                        <div class="form-text">Supported formats: JPEG, PNG, JPG, WEBP. Max 5MB.</div>
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
                            placeholder="A brief overview of the infrastructure space, architectural layout, and guest experience."
                        >{{ old('description') }}</textarea>
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
                            placeholder="Pillarless Architectural Design&#10;2,000+ Seating Guest Capacity&#10;25,000W Audiophile JBL Sound System&#10;Green Rooms with direct stage access&#10;Centralized Air Conditioning"
                        >{{ old('points') }}</textarea>
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
                                <option value="1" {{ old('status', '1') == '1' ? 'selected' : '' }}>Active & Visible</option>
                                <option value="0" {{ old('status') === '0' ? 'selected' : '' }}>Inactive / Hidden</option>
                            </select>
                            @error('status')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary px-4">
                            <i class="bx bx-save me-1"></i> Save Infrastructure
                        </button>
                        <a href="{{ route('admin.infrastructures.index') }}" class="btn btn-outline-secondary">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

