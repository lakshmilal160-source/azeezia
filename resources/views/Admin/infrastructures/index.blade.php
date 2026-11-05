@extends('Admin.layout')

@section('title', 'Infrastructure Spaces')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h4 class="fw-bold mb-1"><span class="text-muted fw-light">Convention Centre /</span> Infrastructure</h4>
        <p class="text-muted mb-0">Manage infrastructure spaces, halls, descriptions, and feature points</p>
    </div>
    <div>
        <a href="{{ route('admin.infrastructures.create') }}" class="btn btn-primary">
            <i class="bx bx-plus-circle me-1"></i> Add Infrastructure
        </a>
    </div>
</div>

<!-- Search & Filter -->
<div class="card mb-4">
    <div class="card-body">
        <form method="GET" action="{{ route('admin.infrastructures.index') }}" class="row g-3 align-items-center">
            <div class="col-md-6">
                <div class="input-group">
                    <span class="input-group-text"><i class="bx bx-search"></i></span>
                    <input type="text" name="search" class="form-control" placeholder="Search by title, description, or points..." value="{{ request('search') }}">
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
                    <a href="{{ route('admin.infrastructures.index') }}" class="btn btn-outline-secondary">Reset</a>
                @endif
            </div>
        </form>
    </div>
</div>

<!-- Infrastructure Table -->
<div class="card">
    <div class="table-responsive text-nowrap">
        <table class="table table-hover align-middle mb-0">
            <thead class="table-light">
                <tr>
                    <th style="width: 70px;"># Order</th>
                    <th style="width: 100px;">Image</th>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Points / Features</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody class="table-border-bottom-0">
                @forelse($infrastructures as $item)
                    <tr>
                        <td>
                            <span class="badge bg-label-dark fw-bold fs-6">{{ $item->formatted_order }}</span>
                        </td>
                        <td>
                            @if($item->image)
                                <img src="{{ $item->image_url }}" alt="{{ $item->title }}" class="rounded shadow-sm" style="width: 70px; height: 50px; object-fit: cover;">
                            @else
                                <div class="rounded bg-light text-muted d-flex align-items-center justify-content-center" style="width: 70px; height: 50px;">
                                    <i class="bx bx-image fs-3"></i>
                                </div>
                            @endif
                        </td>
                        <td>
                            <strong class="text-dark fs-6">{{ $item->title }}</strong>
                        </td>
                        <td>
                            <div class="text-muted small text-truncate" style="max-width: 240px;" title="{{ $item->description }}">
                                {{ $item->description ?: '-' }}
                            </div>
                        </td>
                        <td>
                            <div class="d-flex flex-wrap gap-1" style="max-width: 280px;">
                                @forelse($item->points_array as $pt)
                                    <span class="badge bg-label-primary text-truncate" style="max-width: 260px; font-size: 0.73rem;">
                                        <i class="bx bx-check me-1"></i>{{ $pt }}
                                    </span>
                                @empty
                                    <span class="text-muted small">No points added</span>
                                @endforelse
                            </div>
                        </td>
                        <td>
                            @if($item->status)
                                <span class="badge bg-success">Active</span>
                            @else
                                <span class="badge bg-secondary">Inactive</span>
                            @endif
                        </td>
                        <td>
                            <div class="d-flex gap-1">
                                <a href="{{ route('admin.infrastructures.edit', $item->id) }}" class="btn btn-sm btn-icon btn-outline-secondary" title="Edit">
                                    <i class="bx bx-edit"></i>
                                </a>
                                <form action="{{ route('admin.infrastructures.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Delete this infrastructure item?');" class="d-inline">
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
                            <i class="bx bx-cube-alt fs-1 d-block mb-2 text-primary"></i>
                            No infrastructure items found. Click "Add Infrastructure" to create one.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($infrastructures->hasPages())
        <div class="card-footer py-3">
            {{ $infrastructures->links() }}
        </div>
    @endif
</div>
@endsection

