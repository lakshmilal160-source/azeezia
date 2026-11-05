@extends('Admin.layout')

@section('title', 'Edit Room: ' . $room->name)

@section('content')
<div class="mb-4">
    <a href="{{ route('admin.resort-rooms.index') }}" class="btn btn-sm btn-outline-secondary mb-2">
        <i class="bx bx-arrow-back me-1"></i> Back to Rooms List
    </a>
    <h4 class="fw-bold mb-1"><span class="text-muted fw-light">Resorts & Stay / Rooms & Villas /</span> Edit Configuration</h4>
    <p class="text-muted mb-0">Update villa specifications, pricing, photo, and booking status.</p>
</div>

<div class="row">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-body p-4">
                <form action="{{ route('admin.resort-rooms.update', $room->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <!-- Parent Resort Selection -->
                    <div class="mb-3">
                        <label class="form-label" for="resort_id">Resort / Property <span class="text-danger">*</span></label>
                        <select class="form-select @error('resort_id') is-invalid @enderror" id="resort_id" name="resort_id" required>
                            @foreach($resorts as $resort)
                                <option value="{{ $resort->id }}" {{ old('resort_id', $room->resort_id) == $resort->id ? 'selected' : '' }}>
                                    {{ $resort->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('resort_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Room Title / Name -->
                    <div class="mb-3">
                        <label class="form-label" for="name">Room / Villa Title <span class="text-danger">*</span></label>
                        <input
                            type="text"
                            class="form-control @error('name') is-invalid @enderror"
                            id="name"
                            name="name"
                            value="{{ old('name', $room->name) }}"
                            placeholder="e.g. 2BHK Presidential Pool Villa, 4BHK Royal Family Villa"
                            required
                        />
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Two Photos Upload Row -->
                    <div class="row g-3 mb-3">
                        <!-- Photo 1: Primary Photo -->
                        <div class="col-md-6">
                            <label class="form-label" for="image">
                                Primary Photo (Photo 1)
                                <span class="badge bg-label-primary ms-1">Main View</span>
                            </label>
                            @if($room->image)
                                <div class="mb-2">
                                    <img src="{{ $room->image_url }}" alt="{{ $room->name }} Photo 1" class="rounded shadow-sm" style="max-height: 110px; object-fit: cover;">
                                    <div class="form-text small text-muted">Current Photo 1. Upload to replace.</div>
                                </div>
                            @endif
                            <input
                                type="file"
                                class="form-control @error('image') is-invalid @enderror"
                                id="image"
                                name="image"
                                accept="image/*"
                                onchange="previewImage(this, 'room-preview-1')"
                            />
                            <div class="form-text">e.g. Master bedroom or exterior view. Max 5MB.</div>
                            @error('image')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <div class="mt-2" id="room-preview-1-wrapper" style="display:none;">
                                <img id="room-preview-1" src="#" alt="New Photo 1 preview" class="img-thumbnail" style="max-height:110px;">
                            </div>
                        </div>

                        <!-- Photo 2: Secondary Photo -->
                        <div class="col-md-6">
                            <label class="form-label" for="image_2">
                                Secondary Photo (Photo 2)
                                <span class="badge bg-label-info ms-1">Interior / Detail</span>
                            </label>
                            @if($room->image_2)
                                <div class="mb-2">
                                    <img src="{{ $room->image_2_url }}" alt="{{ $room->name }} Photo 2" class="rounded shadow-sm" style="max-height: 110px; object-fit: cover;">
                                    <div class="form-text small text-muted">Current Photo 2. Upload to replace.</div>
                                </div>
                            @endif
                            <input
                                type="file"
                                class="form-control @error('image_2') is-invalid @enderror"
                                id="image_2"
                                name="image_2"
                                accept="image/*"
                                onchange="previewImage(this, 'room-preview-2')"
                            />
                            <div class="form-text">e.g. Living area, bathroom, or private pool. Max 5MB.</div>
                            @error('image_2')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <div class="mt-2" id="room-preview-2-wrapper" style="display:none;">
                                <img id="room-preview-2" src="#" alt="New Photo 2 preview" class="img-thumbnail" style="max-height:110px;">
                            </div>
                        </div>
                    </div>

                    <!-- Bedrooms, Bathrooms, Max Guests Row -->
                    <div class="row g-3 mb-3">
                        <div class="col-md-4">
                            <label class="form-label" for="bedrooms">Bedrooms (BHK) <span class="text-danger">*</span></label>
                            <input
                                type="number"
                                min="1"
                                class="form-control @error('bedrooms') is-invalid @enderror"
                                id="bedrooms"
                                name="bedrooms"
                                value="{{ old('bedrooms', $room->bedrooms) }}"
                                required
                            />
                            @error('bedrooms')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-4">
                            <label class="form-label" for="bathrooms">Bathrooms</label>
                            <input
                                type="number"
                                min="1"
                                class="form-control @error('bathrooms') is-invalid @enderror"
                                id="bathrooms"
                                name="bathrooms"
                                value="{{ old('bathrooms', $room->bathrooms) }}"
                            />
                            @error('bathrooms')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-4">
                            <label class="form-label" for="max_guests">Max Guests</label>
                            <input
                                type="number"
                                min="1"
                                class="form-control @error('max_guests') is-invalid @enderror"
                                id="max_guests"
                                name="max_guests"
                                value="{{ old('max_guests', $room->max_guests) }}"
                            />
                            @error('max_guests')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Price & Price Unit Row -->
                    <div class="row g-3 mb-3">
                        <div class="col-md-6">
                            <label class="form-label" for="price">Price (₹ INR) <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text">₹</span>
                                <input
                                    type="number"
                                    step="0.01"
                                    min="0"
                                    class="form-control @error('price') is-invalid @enderror"
                                    id="price"
                                    name="price"
                                    value="{{ old('price', $room->price) }}"
                                    required
                                />
                            </div>
                            @error('price')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label" for="price_unit">Price Unit</label>
                            <input
                                type="text"
                                class="form-control @error('price_unit') is-invalid @enderror"
                                id="price_unit"
                                name="price_unit"
                                value="{{ old('price_unit', $room->price_unit) }}"
                                placeholder="per night"
                            />
                            @error('price_unit')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
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
                        >{{ old('description', $room->description) }}</textarea>
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Sort Order & Status Row -->
                    <div class="row g-3 mb-4">
                        <div class="col-md-6">
                            <label class="form-label" for="sort_order">Sort Order</label>
                            <input
                                type="number"
                                min="0"
                                class="form-control @error('sort_order') is-invalid @enderror"
                                id="sort_order"
                                name="sort_order"
                                value="{{ old('sort_order', $room->sort_order) }}"
                            />
                            <div class="form-text">Lower numbers appear first.</div>
                            @error('sort_order')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6 d-flex align-items-center pt-3">
                            <div class="form-check form-switch">
                                <input
                                    class="form-check-input"
                                    type="checkbox"
                                    role="switch"
                                    id="is_active"
                                    name="is_active"
                                    value="1"
                                    {{ old('is_active', $room->is_active) ? 'checked' : '' }}
                                />
                                <label class="form-check-label fw-semibold" for="is_active">
                                    Active & Open for Booking
                                </label>
                            </div>
                        </div>
                    </div>

                    <!-- Submit Buttons -->
                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary">
                            <i class="bx bx-check me-1"></i> Update Room Configuration
                        </button>
                        <a href="{{ route('admin.resort-rooms.index') }}" class="btn btn-outline-secondary">
                            Cancel
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Quick Info Column -->
    <div class="col-lg-4">
        <div class="card mb-3">
            <div class="card-header border-bottom">
                <h6 class="card-title mb-0"><i class="bx bx-info-circle me-1"></i> Room Information</h6>
            </div>
            <div class="card-body pt-3 small">
                <div class="d-flex justify-content-between mb-2">
                    <span class="text-muted">Resort:</span>
                    <strong>{{ $room->resort?->name ?? 'N/A' }}</strong>
                </div>
                <div class="d-flex justify-content-between mb-2">
                    <span class="text-muted">Created:</span>
                    <span>{{ $room->created_at?->format('M d, Y') ?? 'N/A' }}</span>
                </div>
                <div class="d-flex justify-content-between mb-2">
                    <span class="text-muted">Last Updated:</span>
                    <span>{{ $room->updated_at?->diffForHumans() ?? 'N/A' }}</span>
                </div>
                <div class="d-flex justify-content-between">
                    <span class="text-muted">Gallery Photos:</span>
                    <span class="badge bg-label-info">{{ $room->images->count() }} photos</span>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function previewImage(input, previewId) {
    const preview = document.getElementById(previewId);
    const wrapper = document.getElementById(previewId + '-wrapper');
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = function(e) {
            preview.src = e.target.result;
            wrapper.style.display = 'block';
        }
        reader.readAsDataURL(input.files[0]);
    } else {
        wrapper.style.display = 'none';
    }
}
</script>
@endsection
