@extends('Admin.layout')

@section('title', 'What We Offer')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h4 class="fw-bold mb-1"><span class="text-muted fw-light">Convention Centre /</span> What We Offer</h4>
        <p class="text-muted mb-0">Manage services, event amenities, photos, and icons for the What We Offer section.</p>
    </div>
    <div>
        <a href="{{ route('admin.what-we-offers.create') }}" class="btn btn-primary">
            <i class="bx bx-plus-circle me-1"></i> Add Offer Item
        </a>
    </div>
</div>

<!-- Search & Filter -->
<div class="card mb-4">
    <div class="card-body">
        <form method="GET" action="{{ route('admin.what-we-offers.index') }}" class="row g-3 align-items-center">
            <div class="col-md-6">
                <div class="input-group">
                    <span class="input-group-text"><i class="bx bx-search"></i></span>
                    <input type="text" name="search" class="form-control" placeholder="Search by title or description..." value="{{ request('search') }}">
                </div>
            </div>
            <div class="col-md-3">
                <select name="status" class="form-select">
                    <option value="">All Statuses</option>
                    <option value="1" {{ request('status') === '1' ? 'selected' : '' }}>Active Only</option>
                    <option value="0" {{ request('status') === '0' ? 'selected' : '' }}>Inactive Only</option>
                </select>
            </div>
            <div class="col-md-3 d-flex gap-2">
                <button type="submit" class="btn btn-secondary w-100">Filter</button>
                @if(request()->hasAny(['search', 'status']))
                    <a href="{{ route('admin.what-we-offers.index') }}" class="btn btn-outline-secondary">Reset</a>
                @endif
            </div>
        </form>
    </div>
</div>

<!-- What We Offer Table -->
<div class="card">
    <div class="table-responsive text-nowrap">
        <table class="table table-hover align-middle mb-0">
            <thead class="table-light">
                <tr>
                    <th style="width: 70px;"># Order</th>
                    <th style="width: 90px;">Icon <small class="text-muted fw-normal d-block" style="font-size:10px;">Convention Centre</small></th>
                    <th style="width: 90px;">Image <small class="text-muted fw-normal d-block" style="font-size:10px;">Home Section</small></th>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody class="table-border-bottom-0">
                @forelse($offers as $offer)
                    <tr>
                        <td>
                            <span class="badge bg-label-dark fw-bold fs-6">{{ $offer->formatted_order }}</span>
                        </td>
                        <td>
                            @if($offer->icon)
                                <img src="{{ $offer->icon_url }}" alt="{{ $offer->title }} icon" class="rounded shadow-sm" style="width: 50px; height: 50px; object-fit: contain; background:#f5f5f5; padding:4px;">
                            @else
                                <div class="rounded bg-light text-muted d-flex align-items-center justify-content-center" style="width: 50px; height: 50px;">
                                    <i class="bx bx-image fs-4"></i>
                                </div>
                            @endif
                        </td>
                        <td>
                            @if($offer->image)
                                <img src="{{ $offer->image_url }}" alt="{{ $offer->title }}" class="rounded shadow-sm" style="width: 70px; height: 50px; object-fit: cover;">
                            @else
                                <div class="rounded bg-light text-muted d-flex align-items-center justify-content-center" style="width: 70px; height: 50px;">
                                    <i class="bx bx-gift fs-3"></i>
                                </div>
                            @endif
                        </td>
                        <td>
                            <strong class="text-dark fs-6">{{ $offer->title }}</strong>
                        </td>
                        <td>
                            <div class="text-muted small text-truncate" style="max-width: 300px;" title="{{ $offer->description }}">
                                {{ $offer->description ?: '-' }}
                            </div>
                        </td>
                        <td>
                            @if($offer->status)
                                <span class="badge bg-success">Active</span>
                            @else
                                <span class="badge bg-secondary">Inactive</span>
                            @endif
                        </td>
                        <td>
                            <div class="d-flex gap-1">
                                <a href="{{ route('admin.what-we-offers.edit', $offer->id) }}" class="btn btn-sm btn-icon btn-outline-secondary" title="Edit">
                                    <i class="bx bx-edit"></i>
                                </a>
                                <form action="{{ route('admin.what-we-offers.destroy', $offer->id) }}" method="POST" onsubmit="return confirm('Delete this What We Offer item?');" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-icon btn-outline-danger" title="Delete">
                                        <i class="bx bx-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center py-5 text-muted">
                            <i class="bx bx-gift fs-1 d-block mb-2 text-primary"></i>
                            No "What We Offer" items found. Click "Add Offer Item" to create one.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($offers->hasPages())
        <div class="card-footer py-3">
            {{ $offers->links() }}
        </div>
    @endif
</div>
@endsection
