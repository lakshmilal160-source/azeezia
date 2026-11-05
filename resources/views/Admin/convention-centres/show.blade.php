@extends('Admin.layout')

@section('title', $conventionCentre->name)

@section('content')
<div class="mb-4 d-flex flex-wrap justify-content-between align-items-center gap-3">
    <div>
        <a href="{{ route('admin.convention-centres.index') }}" class="btn btn-sm btn-outline-secondary mb-2">
            <i class="bx bx-arrow-back me-1"></i> Back to Centres
        </a>
        <h4 class="fw-bold mb-1"><span class="text-muted fw-light">Properties /</span> {{ $conventionCentre->name }}</h4>
        <div class="d-flex flex-wrap gap-3 align-items-center text-muted small">
            @if($conventionCentre->contact_phone)
                <span class="text-dark fw-semibold">
                    <i class="bx bx-phone text-primary me-1"></i> Hotline: {{ $conventionCentre->contact_phone }}
                </span>
            @endif
            @if($conventionCentre->email)
                <span><i class="bx bx-envelope text-info me-1"></i> {{ $conventionCentre->email }}</span>
            @endif
            @if($conventionCentre->address)
                <span><i class="bx bx-map-pin text-danger me-1"></i> {{ $conventionCentre->address }}</span>
            @endif
        </div>
    </div>
    <div class="d-flex gap-2">
        <a href="{{ route('admin.convention-centres.edit', $conventionCentre->id) }}" class="btn btn-outline-primary">
            <i class="bx bx-edit me-1"></i> Edit Details
        </a>
        <a href="{{ route('admin.infrastructures.index') }}" class="btn btn-outline-secondary">
            <i class="bx bx-cube-alt me-1"></i> Manage Infrastructure
        </a>
        <a href="{{ route('admin.what-we-offers.index') }}" class="btn btn-outline-success">
            <i class="bx bx-gift me-1"></i> Manage What We Offer
        </a>
    </div>
</div>

<div class="row">
    <!-- Left Column: Basic Details Summary -->
    <div class="col-lg-5 mb-4">
        <div class="card h-100">
            <div class="card-header border-bottom">
                <h5 class="card-title mb-0">Basic Details</h5>
            </div>
            <div class="card-body pt-3">
                <ul class="list-unstyled mb-0">
                    <li class="mb-3">
                        <span class="text-muted small d-block">Venue Name:</span>
                        <strong>{{ $conventionCentre->name }}</strong>
                    </li>
                    <li class="mb-3">
                        <span class="text-muted small d-block">Separate Mobile Number (Hotline):</span>
                        <strong class="text-primary"><i class="bx bx-phone me-1"></i>{{ $conventionCentre->contact_phone ?: 'Not specified' }}</strong>
                    </li>
                    <li class="mb-3">
                        <span class="text-muted small d-block">Email Address:</span>
                        <span>{{ $conventionCentre->email ?: 'Not specified' }}</span>
                    </li>
                    <li class="mb-3">
                        <span class="text-muted small d-block">Physical Address:</span>
                        <span>{{ $conventionCentre->address ?: 'Not specified' }}</span>
                    </li>
                    @if($conventionCentre->location_url)
                        <li class="mb-3">
                            <span class="text-muted small d-block">Location Map:</span>
                            <a href="{{ $conventionCentre->location_url }}" target="_blank" class="small"><i class="bx bx-map me-1"></i> View on Google Maps</a>
                        </li>
                    @endif
                    @if($conventionCentre->short_description)
                        <li class="mb-3">
                            <span class="text-muted small d-block">Summary:</span>
                            <p class="text-muted small mb-0">{{ $conventionCentre->short_description }}</p>
                        </li>
                    @endif
                    <li class="mb-0">
                        <span class="text-muted small d-block">Status:</span>
                        @if($conventionCentre->is_active)
                            <span class="badge bg-success">Active & Visible</span>
                        @else
                            <span class="badge bg-secondary">Inactive</span>
                        @endif
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <!-- Right Column: Gallery Management -->
    <div class="col-lg-7 mb-4">
        <!-- Upload Photo -->
        <div class="card mb-4">
            <div class="card-header border-bottom">
                <h5 class="card-title mb-0"><i class="bx bx-cloud-upload me-1 text-primary"></i> Upload Gallery Photograph</h5>
            </div>
            <div class="card-body pt-3">
                <form action="{{ route('admin.convention-centres.images.store', $conventionCentre->id) }}" method="POST" enctype="multipart/form-data" class="row g-3 align-items-end">
                    @csrf
                    <div class="col-md-5">
                        <label class="form-label">Select Image <span class="text-danger">*</span></label>
                        <input type="file" name="image" class="form-control" accept="image/*" required>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Alt Text (SEO)</label>
                        <input type="text" name="alt_text" class="form-control" placeholder="{{ $conventionCentre->name }} Photo">
                    </div>
                    <div class="col-md-3">
                        <button type="submit" class="btn btn-primary w-100">
                            <i class="bx bx-upload me-1"></i> Upload
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Photos Grid -->
        <div class="card">
            <div class="card-header border-bottom d-flex justify-content-between align-items-center">
                <h5 class="card-title mb-0">Photos ({{ $conventionCentre->images->count() }})</h5>
            </div>
            <div class="card-body p-3">
                <div class="row g-3">
                    @forelse($conventionCentre->images as $photo)
                        <div class="col-6 col-sm-4">
                            <div class="card h-100 shadow-sm border overflow-hidden">
                                <img src="{{ $photo->image_url }}" alt="{{ $photo->alt_text }}" class="w-100" style="height: 120px; object-fit: cover;">
                                <div class="p-2 d-flex justify-content-between align-items-center">
                                    <small class="text-muted text-truncate me-1">{{ $photo->alt_text ?: 'Photo' }}</small>
                                    <form action="{{ route('admin.convention-centres.images.destroy', $photo->id) }}" method="POST" onsubmit="return confirm('Delete photo?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-icon btn-outline-danger">
                                            <i class="bx bx-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-12 text-center py-4 text-muted">
                            No photos uploaded yet. Upload your first photo above.
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
