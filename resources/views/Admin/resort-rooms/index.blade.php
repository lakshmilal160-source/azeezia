@extends('Admin.layout')

@section('title', 'Rooms & Villa Configurations')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h4 class="fw-bold mb-1"><span class="text-muted fw-light">Resorts & Stay /</span> Rooms & Villas</h4>
        <p class="text-muted mb-0">Manage villa room types, bedroom configurations, pricing, and photos</p>
    </div>
    <div class="d-flex gap-2">
        <a href="{{ route('admin.resorts.index') }}" class="btn btn-outline-secondary">
            <i class="bx bx-buildings me-1"></i> View Resorts
        </a>
        <a href="{{ route('admin.resort-rooms.create') }}" class="btn btn-primary">
            <i class="bx bx-plus-circle me-1"></i> Add Room / Villa
        </a>
    </div>
</div>

<!-- Search & Filter -->
<div class="card mb-4">
    <div class="card-body">
        <form method="GET" action="{{ route('admin.resort-rooms.index') }}" class="row g-3 align-items-center">
            <div class="col-md-5">
                <div class="input-group">
                    <span class="input-group-text"><i class="bx bx-search"></i></span>
                    <input type="text" name="search" class="form-control" placeholder="Search by room name or description..." value="{{ request('search') }}">
                </div>
            </div>
            @if($resorts->count() > 1)
                <div class="col-md-3">
                    <select name="resort_id" class="form-select">
                        <option value="">All Resorts</option>
                        @foreach($resorts as $r)
                            <option value="{{ $r->id }}" {{ request('resort_id') == $r->id ? 'selected' : '' }}>
                                {{ $r->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
            @endif
            <div class="{{ $resorts->count() > 1 ? 'col-md-2' : 'col-md-4' }}">
                <select name="status" class="form-select">
                    <option value="">All Statuses</option>
                    <option value="1" {{ request('status') === '1' ? 'selected' : '' }}>Active Only</option>
                    <option value="0" {{ request('status') === '0' ? 'selected' : '' }}>Inactive Only</option>
                </select>
            </div>
            <div class="col-md-2 d-flex gap-2">
                <button type="submit" class="btn btn-secondary w-100">Filter</button>
                @if(request()->hasAny(['search', 'resort_id', 'status']))
                    <a href="{{ route('admin.resort-rooms.index') }}" class="btn btn-outline-secondary">Reset</a>
                @endif
            </div>
        </form>
    </div>
</div>

<!-- Rooms Table -->
<div class="card">
    <div class="table-responsive text-nowrap">
        <table class="table table-hover align-middle mb-0">
            <thead class="table-light">
                <tr>
                    <th style="width: 70px;"># Order</th>
                    <th style="width: 120px;">Photos</th>
                    <th>Room / Villa Name</th>
                    <th>Resort</th>
                    <th>Configuration</th>
                    <th>Price</th>
                    <th>Status</th>
                    <th style="width: 110px;">Actions</th>
                </tr>
            </thead>
            <tbody class="table-border-bottom-0">
                @forelse($rooms as $room)
                    <tr>
                        <td>
                            <span class="badge bg-label-dark fw-bold">{{ $room->sort_order }}</span>
                        </td>
                        <td>
                            <div class="d-flex gap-1 align-items-center">
                                @if($room->image)
                                    <img src="{{ $room->image_url }}" alt="{{ $room->name }} 1" class="rounded shadow-sm" style="width: 48px; height: 38px; object-fit: cover;" title="Primary Photo">
                                @else
                                    <div class="rounded bg-light text-muted d-flex align-items-center justify-content-center" style="width: 48px; height: 38px;" title="No Primary Photo">
                                        <i class="bx bx-bed"></i>
                                    </div>
                                @endif

                                @if($room->image_2)
                                    <img src="{{ $room->image_2_url }}" alt="{{ $room->name }} 2" class="rounded shadow-sm" style="width: 48px; height: 38px; object-fit: cover;" title="Secondary Photo">
                                @else
                                    <div class="rounded bg-light text-muted d-flex align-items-center justify-content-center" style="width: 48px; height: 38px;" title="No Secondary Photo">
                                        <i class="bx bx-image"></i>
                                    </div>
                                @endif
                            </div>
                        </td>
                        <td>
                            <strong class="text-dark d-block">{{ $room->name }}</strong>
                            @if($room->description)
                                <div class="text-muted small text-truncate" style="max-width: 220px;" title="{{ $room->description }}">
                                    {{ $room->description }}
                                </div>
                            @endif
                        </td>
                        <td>
                            <span class="badge bg-label-secondary">{{ $room->resort?->name ?? 'N/A' }}</span>
                        </td>
                        <td>
                            <div class="small">
                                <i class="bx bx-home-alt text-muted me-1"></i><strong>{{ $room->bedrooms }}</strong> BHK
                                @if($room->bathrooms)
                                    <span class="text-muted">•</span> <strong>{{ $room->bathrooms }}</strong> Bath
                                @endif
                            </div>
                            @if($room->max_guests)
                                <div class="small text-muted">
                                    <i class="bx bx-user me-1"></i>Max {{ $room->max_guests }} Guests
                                </div>
                            @endif
                        </td>
                        <td>
                            <span class="fw-bold text-primary">₹{{ number_format($room->price, 2) }}</span>
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
                                <form action="{{ route('admin.resort-rooms.destroy', $room->id) }}" method="POST" onsubmit="return confirm('Delete this room type? This action cannot be undone.');" class="d-inline">
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
                        <td colspan="8" class="text-center py-5 text-muted">
                            <i class="bx bx-bed fs-1 d-block mb-2"></i>
                            No rooms or villa configurations found.
                            <div class="mt-2">
                                <a href="{{ route('admin.resort-rooms.create') }}" class="btn btn-sm btn-primary">
                                    <i class="bx bx-plus-circle me-1"></i> Add First Room Type
                                </a>
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($rooms->hasPages())
        <div class="card-footer border-top py-3">
            {{ $rooms->links() }}
        </div>
    @endif
</div>
@endsection
