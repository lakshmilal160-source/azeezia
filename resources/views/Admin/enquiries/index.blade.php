@extends('Admin.layout')

@section('title', 'Customer Enquiries')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h4 class="fw-bold mb-1"><span class="text-muted fw-light">Leads /</span> Customer Enquiries</h4>
        <p class="text-muted mb-0">Track bookings, wedding enquiries, resort reservations, and messages</p>
    </div>
</div>

<!-- Filters -->
<div class="card mb-4">
    <div class="card-body">
        <form method="GET" action="{{ route('admin.enquiries.index') }}" class="row g-3 align-items-center">
            <div class="col-md-5">
                <div class="input-group">
                    <span class="input-group-text"><i class="bx bx-search"></i></span>
                    <input type="text" name="search" class="form-control" placeholder="Search by name, phone, email, subject..." value="{{ request('search') }}">
                </div>
            </div>
            <div class="col-md-3">
                <select name="status" class="form-select">
                    <option value="">All Statuses</option>
                    <option value="new" {{ request('status') === 'new' ? 'selected' : '' }}>New Leads</option>
                    <option value="contacted" {{ request('status') === 'contacted' ? 'selected' : '' }}>Contacted</option>
                    <option value="in_progress" {{ request('status') === 'in_progress' ? 'selected' : '' }}>In Progress</option>
                    <option value="closed" {{ request('status') === 'closed' ? 'selected' : '' }}>Closed</option>
                </select>
            </div>
            <div class="col-md-2">
                <select name="type" class="form-select">
                    <option value="">All Types</option>
                    <option value="convention" {{ request('type') === 'convention' ? 'selected' : '' }}>Convention</option>
                    <option value="resort" {{ request('type') === 'resort' ? 'selected' : '' }}>Resort</option>
                    <option value="farm" {{ request('type') === 'farm' ? 'selected' : '' }}>Farm</option>
                    <option value="general" {{ request('type') === 'general' ? 'selected' : '' }}>General</option>
                </select>
            </div>
            <div class="col-md-2 d-flex gap-2">
                <button type="submit" class="btn btn-secondary w-100">Filter</button>
                @if(request()->hasAny(['search', 'status', 'type']))
                    <a href="{{ route('admin.enquiries.index') }}" class="btn btn-outline-secondary">Reset</a>
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
                    <th>Customer Name</th>
                    <th>Phone / Email</th>
                    <th>Interested Property / Subject</th>
                    <th>Status</th>
                    <th>Date Received</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody class="table-border-bottom-0">
                @forelse($enquiries as $enquiry)
                    <tr>
                        <td>
                            <strong>{{ $enquiry->name }}</strong>
                        </td>
                        <td>
                            <div><i class="bx bx-phone small text-muted"></i> {{ $enquiry->phone }}</div>
                            @if($enquiry->email)
                                <small class="text-muted"><i class="bx bx-envelope small"></i> {{ $enquiry->email }}</small>
                            @endif
                        </td>
                        <td>
                            @if($enquiry->conventionCentre)
                                <span class="badge bg-label-primary"><i class="bx bx-buildings me-1"></i> {{ $enquiry->conventionCentre->name }}</span>
                            @elseif($enquiry->resort)
                                <span class="badge bg-label-info"><i class="bx bx-bed me-1"></i> {{ $enquiry->resort->name }}</span>
                            @elseif($enquiry->organicFarm)
                                <span class="badge bg-label-success"><i class="bx bx-leaf me-1"></i> {{ $enquiry->organicFarm->name }}</span>
                            @else
                                <span class="badge bg-label-secondary">{{ ucfirst($enquiry->enquiry_type ?: 'General') }}</span>
                            @endif

                            @if($enquiry->subject)
                                <div class="small text-truncate mt-1" style="max-width: 220px;" title="{{ $enquiry->subject }}">{{ $enquiry->subject }}</div>
                            @endif
                        </td>
                        <td>
                            @if($enquiry->status === 'new')
                                <span class="badge bg-danger">New Lead</span>
                            @elseif($enquiry->status === 'contacted')
                                <span class="badge bg-warning">Contacted</span>
                            @elseif($enquiry->status === 'in_progress')
                                <span class="badge bg-info">In Progress</span>
                            @elseif($enquiry->status === 'closed')
                                <span class="badge bg-secondary">Closed</span>
                            @else
                                <span class="badge bg-primary">{{ ucfirst($enquiry->status) }}</span>
                            @endif
                        </td>
                        <td>
                            <div>{{ $enquiry->created_at->format('M d, Y') }}</div>
                            <small class="text-muted">{{ $enquiry->created_at->format('h:i A') }}</small>
                        </td>
                        <td>
                            <div class="d-flex gap-1">
                                <a href="{{ route('admin.enquiries.show', $enquiry->id) }}" class="btn btn-sm btn-icon btn-outline-primary" title="View Enquiry">
                                    <i class="bx bx-show"></i>
                                </a>
                                <form action="{{ route('admin.enquiries.destroy', $enquiry->id) }}" method="POST" onsubmit="return confirm('Delete this enquiry?');" class="d-inline">
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
                            <i class="bx bx-envelope fs-1 d-block mb-2"></i> No customer enquiries matching criteria.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($enquiries->hasPages())
        <div class="card-footer py-3">
            {{ $enquiries->links() }}
        </div>
    @endif
</div>
@endsection

