@extends('Admin.layout')

@section('title', 'Homepage Sliders')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h4 class="fw-bold mb-1"><span class="text-muted fw-light">Marketing /</span> Homepage Banners</h4>
        <p class="text-muted mb-0">Manage high-impact hero banners and welcome slides</p>
    </div>
    <div>
        <a href="{{ route('admin.sliders.create') }}" class="btn btn-primary">
            <i class="bx bx-plus-circle me-1"></i> Add Banner
        </a>
    </div>
</div>

<div class="card">
    <div class="table-responsive text-nowrap">
        <table class="table table-hover mb-0">
            <thead class="table-light">
                <tr>
                    <th>Banner</th>
                    <th>Title & Subtitle</th>
                    <th>Action Button</th>
                    <th>Order</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody class="table-border-bottom-0">
                @forelse($sliders as $slider)
                    <tr>
                        <td style="width: 140px;">
                            <img src="{{ asset('storage/' . $slider->image) }}" alt="{{ $slider->title }}" class="rounded shadow-xs" style="width: 120px; height: 60px; object-fit: cover;">
                        </td>
                        <td>
                            <strong>{{ $slider->title }}</strong>
                            @if($slider->subtitle)
                                <div class="text-muted small">{{ $slider->subtitle }}</div>
                            @endif
                        </td>
                        <td>
                            @if($slider->button_text)
                                <span class="badge bg-label-primary">{{ $slider->button_text }}</span>
                            @else
                                <span class="text-muted small">-</span>
                            @endif
                        </td>
                        <td>{{ $slider->sort_order }}</td>
                        <td>
                            @if($slider->is_active)
                                <span class="badge bg-success">Active</span>
                            @else
                                <span class="badge bg-danger">Inactive</span>
                            @endif
                        </td>
                        <td>
                            <div class="d-flex gap-1">
                                <a href="{{ route('admin.sliders.edit', $slider->id) }}" class="btn btn-sm btn-icon btn-outline-secondary" title="Edit">
                                    <i class="bx bx-edit"></i>
                                </a>
                                <form action="{{ route('admin.sliders.destroy', $slider->id) }}" method="POST" onsubmit="return confirm('Delete this banner?');" class="d-inline">
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
                            <i class="bx bx-carousel fs-1 d-block mb-2"></i> No banners created yet. Click "Add Banner" to upload one.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($sliders->hasPages())
        <div class="card-footer py-3">
            {{ $sliders->links() }}
        </div>
    @endif
</div>
@endsection

