@extends('Admin.layout')

@section('title', $resort->name . ' - Rooms & Photos')

@section('content')
<div class="mb-4 d-flex justify-content-between align-items-center">
    <div>
        <a href="{{ route('admin.resorts.index') }}" class="btn btn-sm btn-outline-secondary mb-2">
            <i class="bx bx-arrow-back me-1"></i> Back to Resorts
        </a>
        <h4 class="fw-bold mb-1"><span class="text-muted fw-light">Properties /</span> {{ $resort->name }}</h4>
        <p class="text-muted mb-0">
            <i class="bx bx-phone me-1"></i> Phone: {{ $resort->contact_phone ?? 'N/A' }}
            @if($resort->email)
                • <i class="bx bx-envelope ms-2 me-1"></i> Email: {{ $resort->email }}
            @endif
            {{-- Slug (commented out per request)
            • <code>/resorts/{{ $resort->slug }}</code>
            --}}
        </p>
    </div>
    <div>
        <a href="{{ route('admin.resorts.edit', $resort->id) }}" class="btn btn-outline-primary">
            <i class="bx bx-edit me-1"></i> Edit Resort Info
        </a>
    </div>
</div>

<div class="row">
    <!-- Room Types Column -->
    <div class="col-lg-7 mb-4">
        <!-- Existing Room Types -->
        <div class="card mb-4">
            <div class="card-header border-bottom">
                <h5 class="card-title mb-0">Room & Villa Types ({{ $resort->roomTypes->count() }})</h5>
            </div>
            <div class="table-responsive text-nowrap">
                <table class="table table-hover mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>Type Name</th>
                            <th>Bedrooms</th>
                            <th>Max Guests</th>
                            <th>Price</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @forelse($resort->roomTypes as $room)
                            <tr>
                                <td>
                                    <strong>{{ $room->name }}</strong>
                                    @if($room->description)
                                        <div class="small text-muted text-truncate" style="max-width: 150px;">{{ $room->description }}</div>
                                    @endif
                                </td>
                                <td>{{ $room->bedrooms }} BHK ({{ $room->bathrooms ?? 1 }} Bath)</td>
                                <td>{{ $room->max_guests ?? '-' }} Guests</td>
                                <td>
                                    <span class="fw-semibold text-primary">₹{{ number_format($room->price, 2) }}</span>
                                    <small class="text-muted d-block">{{ $room->price_unit }}</small>
                                </td>
                                <td>
                                    @if($room->is_active)
                                        <span class="badge bg-success">Active</span>
                                    @else
                                        <span class="badge bg-danger">Inactive</span>
                                    @endif
                                </td>
                                <td>
                                    <form action="{{ route('admin.resorts.rooms.destroy', $room->id) }}" method="POST" onsubmit="return confirm('Delete this room type?');" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-icon btn-outline-danger" title="Delete">
                                            <i class="bx bx-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center py-4 text-muted">
                                    No room/villa types configured yet.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Add Room Type Form -->
        <div class="card">
            <div class="card-header border-bottom">
                <h6 class="card-title mb-0"><i class="bx bx-plus-circle me-1"></i> Add Room / Villa Configuration</h6>
            </div>
            <div class="card-body pt-3">
                <form action="{{ route('admin.resorts.rooms.store', $resort->id) }}" method="POST">
                    @csrf
                    <div class="row g-2">
                        <div class="col-md-6 mb-2">
                            <label class="form-label">Room / Villa Title <span class="text-danger">*</span></label>
                            <input type="text" name="name" class="form-control" placeholder="e.g. 2BHK Presidential Pool Villa" required>
                        </div>
                        <div class="col-md-3 col-6 mb-2">
                            <label class="form-label">Bedrooms <span class="text-danger">*</span></label>
                            <input type="number" min="1" name="bedrooms" class="form-control" value="2" required>
                        </div>
                        <div class="col-md-3 col-6 mb-2">
                            <label class="form-label">Bathrooms</label>
                            <input type="number" min="1" name="bathrooms" class="form-control" value="2">
                        </div>
                        <div class="col-md-4 mb-2">
                            <label class="form-label">Max Guests</label>
                            <input type="number" min="1" name="max_guests" class="form-control" placeholder="4" value="4">
                        </div>
                        <div class="col-md-4 mb-2">
                            <label class="form-label">Price (INR) <span class="text-danger">*</span></label>
                            <input type="number" step="0.01" min="0" name="price" class="form-control" placeholder="4500.00" required>
                        </div>
                        <div class="col-md-4 mb-2">
                            <label class="form-label">Price Unit</label>
                            <input type="text" name="price_unit" class="form-control" value="per night" placeholder="per night">
                        </div>
                        <div class="col-12 mb-2">
                            <label class="form-label">Room Description</label>
                            <textarea name="description" class="form-control" rows="2" placeholder="Private balcony, king size bed, bathtub, garden view..."></textarea>
                        </div>
                        <div class="col-12 mb-2">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="is_active" id="room_active" value="1" checked>
                                <label class="form-check-label" for="room_active">Active & Open for booking</label>
                            </div>
                        </div>
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary btn-sm">Add Room Type</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Resort Photos Column -->
    <div class="col-lg-5 mb-4">
        <!-- Upload Photo Form -->
        <div class="card mb-4">
            <div class="card-header border-bottom">
                <h6 class="card-title mb-0"><i class="bx bx-camera me-1"></i> Upload Photo (with SEO Alt Text)</h6>
            </div>
            <div class="card-body pt-3">
                <form action="{{ route('admin.resorts.images.store', $resort->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Select Photo <span class="text-danger">*</span></label>
                        <input type="file" name="image" class="form-control" accept="image/*" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">
                            Image Alt Text (SEO)
                            <span class="badge bg-label-success ms-1">Google Search</span>
                        </label>
                        <input type="text" name="alt_text" class="form-control" value="{{ $resort->name }} bedroom interior" placeholder="e.g. Luxury villa swimming pool and garden">
                    </div>
                    @if($resort->roomTypes->count() > 0)
                        <div class="mb-3">
                            <label class="form-label">Associated Room Type (Optional)</label>
                            <select name="resort_room_type_id" class="form-select">
                                <option value="">General Resort Photo</option>
                                @foreach($resort->roomTypes as $rtype)
                                    <option value="{{ $rtype->id }}">{{ $rtype->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    @endif
                    <button type="submit" class="btn btn-outline-primary btn-sm">Upload Photo</button>
                </form>
            </div>
        </div>

        <!-- Photos Grid -->
        <div class="card">
            <div class="card-header border-bottom">
                <h5 class="card-title mb-0">Resort Photos ({{ $resort->images->count() }})</h5>
            </div>
            <div class="card-body pt-3">
                <div class="row g-2">
                    @forelse($resort->images as $photo)
                        <div class="col-6 position-relative">
                            <div class="border rounded p-1 bg-light text-center">
                                <img src="{{ asset('storage/' . $photo->image) }}" alt="{{ $photo->alt_text }}" class="rounded w-100 mb-1" style="height: 110px; object-fit: cover;">
                                <div class="small text-truncate text-muted" title="{{ $photo->alt_text }}">{{ $photo->alt_text ?: 'No alt text' }}</div>
                                <form action="{{ route('admin.resorts.images.destroy', $photo->id) }}" method="POST" onsubmit="return confirm('Delete photo?');" class="mt-1">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-xs btn-outline-danger py-0 px-2">Delete</button>
                                </form>
                            </div>
                        </div>
                    @empty
                        <div class="col-12 text-center py-4 text-muted">
                            <i class="bx bx-image fs-2 d-block mb-1"></i> No photos uploaded for this resort yet.
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

