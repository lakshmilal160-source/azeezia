@extends('Admin.layout')

@section('title', 'Services')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h4 class="fw-bold mb-1"><span class="text-muted fw-light">Content /</span> Services</h4>
        <p class="text-muted mb-0">Manage services provided by Azeezia (Catering, Event Staging, Luxury Stays, Destination Weddings)</p>
    </div>
    <div>
        <a href="{{ route('admin.services.create') }}" class="btn btn-primary">
            <i class="bx bx-plus-circle me-1"></i> Add Service
        </a>
    </div>
</div>

<div class="card">
    <div class="table-responsive text-nowrap">
        <table class="table table-hover mb-0">
            <thead class="table-light">
                <tr>
                    <th>Image</th>
                    <th>Service Title / Slug</th>
                    <th>Key Highlights</th>
                    <th>Order</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody class="table-border-bottom-0">
                @forelse($services as $service)
                    <tr>
                        <td style="width: 80px;">
                            @if($service->image)
                                <img src="{{ asset('storage/' . $service->image) }}" alt="{{ $service->title }}" class="rounded" style="width: 60px; height: 42px; object-fit: cover;">
                            @else
                                <div class="bg-light rounded d-flex align-items-center justify-content-center text-muted" style="width: 60px; height: 42px;">
                                    <i class="bx bx-image"></i>
                                </div>
                            @endif
                        </td>
                        <td>
                            <strong>{{ $service->title }}</strong>
                            <div class="text-muted small"><code>/services/{{ $service->slug }}</code></div>
                        </td>
                        <td>
                            @if(!empty($service->points))
                                <span class="badge bg-label-info">{{ count($service->points) }} points</span>
                            @else
                                <span class="text-muted small">-</span>
                            @endif
                        </td>
                        <td>{{ $service->sort_order }}</td>
                        <td>
                            @if($service->is_active)
                                <span class="badge bg-success">Active</span>
                            @else
                                <span class="badge bg-danger">Inactive</span>
                            @endif
                        </td>
                        <td>
                            <div class="d-flex gap-1">
                                <a href="{{ route('admin.services.edit', $service->id) }}" class="btn btn-sm btn-icon btn-outline-secondary" title="Edit">
                                    <i class="bx bx-edit"></i>
                                </a>
                                <form action="{{ route('admin.services.destroy', $service->id) }}" method="POST" onsubmit="return confirm('Delete this service?');" class="d-inline">
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
                        <td colspan="6" class="text-center py-5 text-muted">
                            <i class="bx bx-briefcase fs-1 d-block mb-2"></i> No services added yet. Click "Add Service" to create one.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($services->hasPages())
        <div class="card-footer py-3">
            {{ $services->links() }}
        </div>
    @endif
</div>
@endsection

