@extends('Admin.layout')

@section('title', $resort->name . ' - Rooms & Villa Configurations')

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
        </p>
    </div>
    <div class="d-flex gap-2">
        <a href="{{ route('admin.resort-rooms.create', ['resort_id' => $resort->id]) }}" class="btn btn-primary">
            <i class="bx bx-plus-circle me-1"></i> Add Room / Villa
        </a>
        <a href="{{ route('admin.resorts.edit', $resort->id) }}" class="btn btn-outline-primary">
            <i class="bx bx-edit me-1"></i> Edit Resort Info
        </a>
    </div>
</div>

<div class="row">
    <!-- Room Types Full Width Column -->
    <div class="col-12 mb-4">
        <!-- Existing Room Types -->
        <div class="card mb-4">
            <div class="card-header border-bottom d-flex justify-content-between align-items-center">
                <h5 class="card-title mb-0">Room & Villa Types ({{ $resort->roomTypes->count() }})</h5>
                <a href="{{ route('admin.resort-rooms.create', ['resort_id' => $resort->id]) }}" class="btn btn-sm btn-primary">
                    <i class="bx bx-plus-circle me-1"></i> Add Room / Villa
                </a>
            </div>
            <div class="table-responsive text-nowrap">
                <table class="table table-hover mb-0">
                    <thead class="table-light">
                        <tr>
                            <th style="width: 120px;">Photos</th>
                            <th>Type Name</th>
                            <th>Bedrooms</th>
                            <th>Max Guests</th>
                            <th>Price</th>
                            <th>Status</th>
                            <th style="width: 100px;">Action</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @forelse($resort->roomTypes as $room)
                            <tr>
                                <td>
                                    <div class="d-flex gap-1 align-items-center">
                                        @if($room->image)
                                            <img src="{{ $room->image_url }}" alt="{{ $room->name }} 1" class="rounded shadow-sm" style="width: 44px; height: 34px; object-fit: cover;" title="Primary Photo">
                                        @else
                                            <div class="rounded bg-light text-muted d-flex align-items-center justify-content-center" style="width: 44px; height: 34px;" title="No Primary Photo">
                                                <i class="bx bx-bed"></i>
                                            </div>
                                        @endif
                                        @if($room->image_2)
                                            <img src="{{ $room->image_2_url }}" alt="{{ $room->name }} 2" class="rounded shadow-sm" style="width: 44px; height: 34px; object-fit: cover;" title="Secondary Photo">
                                        @else
                                            <div class="rounded bg-light text-muted d-flex align-items-center justify-content-center" style="width: 44px; height: 34px;" title="No Secondary Photo">
                                                <i class="bx bx-image"></i>
                                            </div>
                                        @endif
                                    </div>
                                </td>
                                <td>
                                    <strong>{{ $room->name }}</strong>
                                    @if($room->description)
                                        <div class="small text-muted text-truncate" style="max-width: 250px;">{{ $room->description }}</div>
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
                                    <div class="d-flex gap-1">
                                        <a href="{{ route('admin.resort-rooms.edit', $room->id) }}" class="btn btn-sm btn-icon btn-outline-primary" title="Edit Room">
                                            <i class="bx bx-edit-alt"></i>
                                        </a>
                                        <form action="{{ route('admin.resorts.rooms.destroy', $room->id) }}" method="POST" onsubmit="return confirm('Delete this room type?');" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-icon btn-outline-danger" title="Delete Room">
                                                <i class="bx bx-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center py-5 text-muted">
                                    <i class="bx bx-bed fs-1 d-block mb-2"></i>
                                    No room/villa types configured yet for this resort.
                                    <div class="mt-2">
                                        <a href="{{ route('admin.resort-rooms.create', ['resort_id' => $resort->id]) }}" class="btn btn-sm btn-primary">
                                            <i class="bx bx-plus-circle me-1"></i> Add First Room Type
                                        </a>
                                    </div>
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
                <h6 class="card-title mb-0"><i class="bx bx-plus-circle me-1"></i> Quick Add Room / Villa Configuration</h6>
            </div>
            <div class="card-body pt-3">
                <form action="{{ route('admin.resorts.rooms.store', $resort->id) }}" method="POST" enctype="multipart/form-data">
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
                        <div class="col-md-6 mb-2">
                            <label class="form-label">Primary Photo (Photo 1)</label>
                            <input type="file" name="image" class="form-control" accept="image/*">
                        </div>
                        <div class="col-md-6 mb-2">
                            <label class="form-label">Secondary Photo (Photo 2)</label>
                            <input type="file" name="image_2" class="form-control" accept="image/*">
                        </div>
                        <div class="col-12 mb-2">
                            <label class="form-label">Room Description</label>
                            <textarea name="description" class="form-control" rows="2" placeholder="Private balcony, plunge pool, king size bed, luxury bathroom, garden view..."></textarea>
                        </div>
                        <div class="col-12 mb-2">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="is_active" id="room_active" value="1" checked>
                                <label class="form-check-label" for="room_active">Active & Open for booking</label>
                            </div>
                        </div>
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary btn-sm">Save Room Configuration</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
