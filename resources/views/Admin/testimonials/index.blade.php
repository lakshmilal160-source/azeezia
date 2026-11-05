@extends('Admin.layout')

@section('title', 'Testimonials')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h4 class="fw-bold mb-1"><span class="text-muted fw-light">Social Proof /</span> Testimonials</h4>
        <p class="text-muted mb-0">Client feedback, event organizer reviews, and wedding host ratings</p>
    </div>
    <div>
        <a href="{{ route('admin.testimonials.create') }}" class="btn btn-primary">
            <i class="bx bx-plus-circle me-1"></i> Add Testimonial
        </a>
    </div>
</div>

<div class="card">
    <div class="table-responsive text-nowrap">
        <table class="table table-hover mb-0">
            <thead class="table-light">
                <tr>
                    <th>Customer</th>
                    <th>Rating</th>
                    <th>Review Snippet</th>
                    <th>Order</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody class="table-border-bottom-0">
                @forelse($testimonials as $item)
                    <tr>
                        <td>
                            <div class="d-flex align-items-center">
                                @if($item->image)
                                    <img src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->customer_name }}" class="rounded-circle me-2" style="width: 38px; height: 38px; object-fit: cover;">
                                @else
                                    <div class="avatar avatar-sm me-2">
                                        <span class="avatar-initial rounded-circle bg-label-primary">{{ substr($item->customer_name, 0, 1) }}</span>
                                    </div>
                                @endif
                                <div>
                                    <strong>{{ $item->customer_name }}</strong>
                                    <small class="text-muted d-block">{{ $item->designation ?: 'Client' }}</small>
                                </div>
                            </div>
                        </td>
                        <td>
                            @for($i = 1; $i <= 5; $i++)
                                <i class="bx bxs-star {{ $i <= ($item->rating ?? 5) ? 'text-warning' : 'text-muted' }} fs-6"></i>
                            @endfor
                        </td>
                        <td>
                            <div class="text-truncate" style="max-width: 320px;" title="{{ $item->review }}">
                                "{{ $item->review }}"
                            </div>
                        </td>
                        <td>{{ $item->sort_order }}</td>
                        <td>
                            @if($item->is_active)
                                <span class="badge bg-success">Active</span>
                            @else
                                <span class="badge bg-danger">Inactive</span>
                            @endif
                        </td>
                        <td>
                            <div class="d-flex gap-1">
                                <a href="{{ route('admin.testimonials.edit', $item->id) }}" class="btn btn-sm btn-icon btn-outline-secondary" title="Edit">
                                    <i class="bx bx-edit"></i>
                                </a>
                                <form action="{{ route('admin.testimonials.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Delete this review?');" class="d-inline">
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
                            <i class="bx bx-star fs-1 d-block mb-2"></i> No testimonials added yet. Click "Add Testimonial" to create one.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($testimonials->hasPages())
        <div class="card-footer py-3">
            {{ $testimonials->links() }}
        </div>
    @endif
</div>
@endsection

