@extends('Admin.layout')

@section('title', 'Enquiry Details - ' . $enquiry->name)

@section('content')
<div class="mb-4">
    <a href="{{ route('admin.enquiries.index') }}" class="btn btn-sm btn-outline-secondary mb-2">
        <i class="bx bx-arrow-back me-1"></i> Back to Enquiries
    </a>
    <h4 class="fw-bold mb-1"><span class="text-muted fw-light">Leads /</span> Enquiry from {{ $enquiry->name }}</h4>
    <p class="text-muted mb-0">Received on {{ $enquiry->created_at->format('F d, Y \a\t h:i A') }}</p>
</div>

<div class="row">
    <!-- Enquiry Content -->
    <div class="col-lg-7 mb-4">
        <div class="card mb-4">
            <div class="card-header border-bottom d-flex justify-content-between align-items-center">
                <h5 class="card-title mb-0">Customer Information</h5>
                <span class="badge {{ $enquiry->status === 'new' ? 'bg-danger' : ($enquiry->status === 'contacted' ? 'bg-warning' : 'bg-primary') }} text-uppercase">
                    {{ $enquiry->status }}
                </span>
            </div>
            <div class="card-body pt-4">
                <div class="row mb-3">
                    <div class="col-sm-4 text-muted">Customer Name:</div>
                    <div class="col-sm-8 fw-bold">{{ $enquiry->name }}</div>
                </div>

                <div class="row mb-3">
                    <div class="col-sm-4 text-muted">Phone Number:</div>
                    <div class="col-sm-8">
                        <a href="tel:{{ $enquiry->phone }}" class="text-primary fw-semibold">
                            <i class="bx bx-phone me-1"></i> {{ $enquiry->phone }}
                        </a>
                        <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $enquiry->phone) }}" target="_blank" class="btn btn-xs btn-outline-success ms-2">
                            <i class="bx bxl-whatsapp me-1"></i> WhatsApp
                        </a>
                    </div>
                </div>

                @if($enquiry->email)
                    <div class="row mb-3">
                        <div class="col-sm-4 text-muted">Email Address:</div>
                        <div class="col-sm-8">
                            <a href="mailto:{{ $enquiry->email }}" class="text-primary">
                                <i class="bx bx-envelope me-1"></i> {{ $enquiry->email }}
                            </a>
                        </div>
                    </div>
                @endif

                @if($enquiry->subject)
                    <div class="row mb-3">
                        <div class="col-sm-4 text-muted">Subject / Topic:</div>
                        <div class="col-sm-8 fw-semibold">{{ $enquiry->subject }}</div>
                    </div>
                @endif

                <div class="row mb-3">
                    <div class="col-sm-4 text-muted">Interested Venue / Stay:</div>
                    <div class="col-sm-8">
                        @if($enquiry->conventionCentre)
                            <span class="badge bg-label-primary fs-tiny"><i class="bx bx-buildings me-1"></i> {{ $enquiry->conventionCentre->name }}</span>
                        @elseif($enquiry->resort)
                            <span class="badge bg-label-info fs-tiny"><i class="bx bx-bed me-1"></i> {{ $enquiry->resort->name }}</span>
                        @elseif($enquiry->organicFarm)
                            <span class="badge bg-label-success fs-tiny"><i class="bx bx-leaf me-1"></i> {{ $enquiry->organicFarm->name }}</span>
                        @else
                            <span class="badge bg-label-secondary">{{ ucfirst($enquiry->enquiry_type ?: 'General') }}</span>
                        @endif
                    </div>
                </div>

                <hr class="my-3">

                <div>
                    <h6 class="fw-bold mb-2">Message Body:</h6>
                    <div class="p-3 bg-light rounded border text-secondary" style="white-space: pre-wrap; line-height: 1.6;">
                        {{ $enquiry->message ?: 'No additional message provided.' }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Update Status & Admin Notes -->
    <div class="col-lg-5 mb-4">
        <div class="card">
            <div class="card-header border-bottom">
                <h5 class="card-title mb-0"><i class="bx bx-check-shield me-1"></i> Status & Internal Notes</h5>
            </div>
            <div class="card-body pt-4">
                <form action="{{ route('admin.enquiries.update', $enquiry->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label class="form-label" for="status">Lead Status</label>
                        <select class="form-select @error('status') is-invalid @enderror" id="status" name="status">
                            <option value="new" {{ old('status', $enquiry->status) === 'new' ? 'selected' : '' }}>🔴 New (Uncontacted)</option>
                            <option value="contacted" {{ old('status', $enquiry->status) === 'contacted' ? 'selected' : '' }}>🟡 Contacted Customer</option>
                            <option value="in_progress" {{ old('status', $enquiry->status) === 'in_progress' ? 'selected' : '' }}>🔵 Discussion in Progress</option>
                            <option value="closed" {{ old('status', $enquiry->status) === 'closed' ? 'selected' : '' }}>🟢 Closed / Booked</option>
                        </select>
                        @error('status')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="admin_notes">Admin Internal Notes (Private)</label>
                        <textarea
                            class="form-control @error('admin_notes') is-invalid @enderror"
                            id="admin_notes"
                            name="admin_notes"
                            rows="5"
                            placeholder="Add notes about call summary, quoted pricing, booking dates, customer requirements..."
                        >{{ old('admin_notes', $enquiry->admin_notes) }}</textarea>
                        <div class="form-text">Visible only to admin staff.</div>
                        @error('admin_notes')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary w-100">
                        <i class="bx bx-save me-1"></i> Save Status & Notes
                    </button>
                </form>

                <hr class="my-4">

                <form action="{{ route('admin.enquiries.destroy', $enquiry->id) }}" method="POST" onsubmit="return confirm('Permanently delete this enquiry record?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-outline-danger w-100 btn-sm">
                        <i class="bx bx-trash me-1"></i> Delete Enquiry
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

