@extends('Admin.layout')

@section('title', 'Resorts & Stay')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h4 class="fw-bold mb-1"><span class="text-muted fw-light">Properties /</span> Resorts & Stay</h4>
        <p class="text-muted mb-0">Manage resort accommodations, villa configurations, pricing, and photo galleries</p>
    </div>
    <div>
        <a href="{{ route('admin.resorts.create') }}" class="btn btn-primary">
            <i class="bx bx-plus-circle me-1"></i> Add Resort / Stay
        </a>
    </div>
</div>

<!-- Search & Filter -->
<div class="card mb-4">
    <div class="card-body">
        <form method="GET" action="{{ route('admin.resorts.index') }}" class="row g-3 align-items-center">
            <div class="col-md-6">
                <div class="input-group">
                    <span class="input-group-text"><i class="bx bx-search"></i></span>
                    <input type="text" name="search" class="form-control" placeholder="Search by resort name or address..." value="{{ request('search') }}">
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
                    <a href="{{ route('admin.resorts.index') }}" class="btn btn-outline-secondary">Reset</a>
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
                    <th>Resort Name</th>
                    <th>Contact Info</th>
                    <th>Room Types</th>
                    <th>Amenities</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody class="table-border-bottom-0">
                @forelse($resorts as $resort)
                    <tr>
                        <td>
                            <strong>{{ $resort->name }}</strong>
                            {{-- Slug (commented out per request)
                            <div class="text-muted small">
                                <code>/resorts/{{ $resort->slug }}</code>
                            </div>
                            --}}
                        </td>
                        <td>
                            <div><i class="bx bx-phone me-1 text-muted"></i>{{ $resort->contact_phone ?? '-' }}</div>
                            @if($resort->email)
                                <div class="small text-muted"><i class="bx bx-envelope me-1"></i>{{ $resort->email }}</div>
                            @endif
                        </td>
                        <td>
                            <span class="badge bg-label-info">{{ $resort->room_types_count }} Room Types</span>
                        </td>
                        <td>
                            @if(!empty($resort->amenities))
                                <span class="badge bg-label-primary">{{ count($resort->amenities) }} listed</span>
                            @else
                                <span class="text-muted small">-</span>
                            @endif
                        </td>
                        <td>
                            @if($resort->is_active)
                                <span class="badge bg-success">Active</span>
                            @else
                                <span class="badge bg-danger">Inactive</span>
                            @endif
                        </td>
                        <td>
                            <div class="d-flex gap-1">
                                <a href="{{ route('admin.resorts.show', $resort->id) }}" class="btn btn-sm btn-icon btn-outline-primary" title="Manage Rooms & Photos">
                                    <i class="bx bx-show"></i>
                                </a>
                                <a href="{{ route('admin.resorts.edit', $resort->id) }}" class="btn btn-sm btn-icon btn-outline-secondary" title="Edit Resort">
                                    <i class="bx bx-edit"></i>
                                </a>
                                <form action="{{ route('admin.resorts.destroy', $resort->id) }}" method="POST" onsubmit="return confirm('Delete this resort and all room types?');" class="d-inline">
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
                            <i class="bx bx-bed fs-1 d-block mb-2"></i>
                            No resorts configured yet. Click "Add Resort / Stay" to get started.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($resorts->hasPages())
        <div class="card-footer py-3">
            {{ $resorts->links() }}
        </div>
    @endif
</div>
@endsection

