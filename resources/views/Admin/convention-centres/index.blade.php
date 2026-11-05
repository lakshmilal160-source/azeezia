@extends('Admin.layout')

@section('title', 'Convention Centres')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h4 class="fw-bold mb-1"><span class="text-muted fw-light">Convention Centre /</span> Basic Details</h4>
        <p class="text-muted mb-0">Manage convention centre basic information, hotline, email, and photo gallery</p>
    </div>
    <div>
        <a href="{{ route('admin.convention-centres.create') }}" class="btn btn-primary">
            <i class="bx bx-plus-circle me-1"></i> Add Convention Centre
        </a>
    </div>
</div>

<!-- Search & Filter -->
<div class="card mb-4">
    <div class="card-body">
        <form method="GET" action="{{ route('admin.convention-centres.index') }}" class="row g-3 align-items-center">
            <div class="col-md-6">
                <div class="input-group">
                    <span class="input-group-text"><i class="bx bx-search"></i></span>
                    <input type="text" name="search" class="form-control" placeholder="Search by name, mobile, email, or address..." value="{{ request('search') }}">
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
                    <a href="{{ route('admin.convention-centres.index') }}" class="btn btn-outline-secondary">Reset</a>
                @endif
            </div>
        </form>
    </div>
</div>

<div class="card">
    <div class="table-responsive text-nowrap">
        <table class="table table-hover align-middle mb-0">
            <thead class="table-light">
                <tr>
                    <th>Centre Name</th>
                    <th>Mobile Number</th>
                    <th>Email Address</th>
                    <th>Address</th>
                    <th>Gallery</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody class="table-border-bottom-0">
                @forelse($centres as $centre)
                    <tr>
                        <td>
                            <strong>{{ $centre->name }}</strong>
                        </td>
                        <td>
                            @if($centre->contact_phone)
                                <div class="text-dark fw-semibold">
                                    <i class="bx bx-phone text-primary me-1"></i>{{ $centre->contact_phone }}
                                </div>
                            @else
                                <span class="text-muted small">No mobile added</span>
                            @endif
                        </td>
                        <td>
                            @if($centre->email)
                                <div><i class="bx bx-envelope text-info me-1"></i>{{ $centre->email }}</div>
                            @else
                                <span class="text-muted small">-</span>
                            @endif
                        </td>
                        <td>
                            <div class="text-truncate small text-muted" style="max-width: 200px;">
                                {{ $centre->address ?? '-' }}
                            </div>
                        </td>
                        <td>
                            <a href="{{ route('admin.convention-centres.show', $centre->id) }}" class="badge bg-label-secondary text-decoration-none">
                                <i class="bx bx-images me-1"></i>{{ $centre->images_count }} Photos
                            </a>
                        </td>
                        <td>
                            @if($centre->is_active)
                                <span class="badge bg-success">Active</span>
                            @else
                                <span class="badge bg-danger">Inactive</span>
                            @endif
                        </td>
                        <td>
                            <div class="d-flex gap-1">
                                <a href="{{ route('admin.convention-centres.show', $centre->id) }}" class="btn btn-sm btn-icon btn-outline-primary" title="View & Manage Photos">
                                    <i class="bx bx-show"></i>
                                </a>
                                <a href="{{ route('admin.convention-centres.edit', $centre->id) }}" class="btn btn-sm btn-icon btn-outline-secondary" title="Edit">
                                    <i class="bx bx-edit"></i>
                                </a>
                                <form action="{{ route('admin.convention-centres.destroy', $centre->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this convention centre?');" class="d-inline">
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
                            <i class="bx bx-buildings fs-1 d-block mb-2"></i>
                            No convention centres found. Click "Add Convention Centre" to create one.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($centres->hasPages())
        <div class="card-footer py-3">
            {{ $centres->links() }}
        </div>
    @endif
</div>
@endsection
