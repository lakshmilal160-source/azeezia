@extends('Admin.layout')

@section('title', 'Organic Farms')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h4 class="fw-bold mb-1"><span class="text-muted fw-light">Properties /</span> Organic Farms</h4>
        <p class="text-muted mb-0">Manage eco-tourism farming locations, activities, produce, and media</p>
    </div>
    <div>
        <a href="{{ route('admin.organic-farms.create') }}" class="btn btn-primary">
            <i class="bx bx-plus-circle me-1"></i> Add Organic Farm
        </a>
    </div>
</div>

<!-- Search & Filter -->
<div class="card mb-4">
    <div class="card-body">
        <form method="GET" action="{{ route('admin.organic-farms.index') }}" class="row g-3 align-items-center">
            <div class="col-md-6">
                <div class="input-group">
                    <span class="input-group-text"><i class="bx bx-search"></i></span>
                    <input type="text" name="search" class="form-control" placeholder="Search by farm name or address..." value="{{ request('search') }}">
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
                    <a href="{{ route('admin.organic-farms.index') }}" class="btn btn-outline-secondary">Reset</a>
                @endif
            </div>
        </form>
    </div>
</div>

<div class="card">
    <div class="table-responsive text-nowrap">
        <table class="table table-hover mb-0">
            <thead class="table-light">
                <tr>
                    <th>Farm Name</th>
                    <th>Area (Acres)</th>
                    <th>Contact Info</th>
                    <th>Photos</th>
                    <th>Activities</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody class="table-border-bottom-0">
                @forelse($farms as $farm)
                    <tr>
                        <td>
                            <strong>{{ $farm->name }}</strong>
                            {{-- <div class="text-muted small"><code>/organic-farms/{{ $farm->slug }}</code></div> --}}
                        </td>
                        <td>
                            <span class="badge bg-label-success">{{ $farm->area_acres ? $farm->area_acres . ' Acres' : 'N/A' }}</span>
                        </td>
                        <td>
                            <div><i class="bx bx-phone me-1 text-muted"></i>{{ $farm->contact_phone ?? '-' }}</div>
                            @if($farm->email)
                                <div class="small text-muted"><i class="bx bx-envelope me-1"></i>{{ $farm->email }}</div>
                            @endif
                        </td>
                        <td>
                            <span class="badge bg-label-secondary">{{ $farm->images_count }} Photos</span>
                        </td>
                        <td>
                            @if(!empty($farm->activities))
                                <span class="badge bg-label-info">{{ count($farm->activities) }} activities</span>
                            @else
                                <span class="text-muted small">-</span>
                            @endif
                        </td>
                        <td>
                            @if($farm->is_active)
                                <span class="badge bg-success">Active</span>
                            @else
                                <span class="badge bg-danger">Inactive</span>
                            @endif
                        </td>
                        <td>
                            <div class="d-flex gap-1">
                                <a href="{{ route('admin.organic-farms.show', $farm->id) }}" class="btn btn-sm btn-icon btn-outline-primary" title="Photos & Details">
                                    <i class="bx bx-show"></i>
                                </a>
                                <a href="{{ route('admin.organic-farms.edit', $farm->id) }}" class="btn btn-sm btn-icon btn-outline-secondary" title="Edit Farm">
                                    <i class="bx bx-edit"></i>
                                </a>
                                <form action="{{ route('admin.organic-farms.destroy', $farm->id) }}" method="POST" onsubmit="return confirm('Delete this farm property?');" class="d-inline">
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
                            <i class="bx bx-leaf fs-1 d-block mb-2"></i>
                            No organic farm entries found. Click "Add Organic Farm" to create one.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($farms->hasPages())
        <div class="card-footer py-3">
            {{ $farms->links() }}
        </div>
    @endif
</div>
@endsection

