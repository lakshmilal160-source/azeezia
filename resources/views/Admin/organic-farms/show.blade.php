@extends('Admin.layout')

@section('title', $organicFarm->name . ' - Gallery Photos')

@section('content')
<div class="mb-4 d-flex justify-content-between align-items-center">
    <div>
        <a href="{{ route('admin.organic-farms.index') }}" class="btn btn-sm btn-outline-secondary mb-2">
            <i class="bx bx-arrow-back me-1"></i> Back to Farms
        </a>
        <h4 class="fw-bold mb-1"><span class="text-muted fw-light">Properties /</span> {{ $organicFarm->name }}</h4>
        <p class="text-muted mb-0">
            {{ $organicFarm->area_acres ?? 0 }} Acres • <i class="bx bx-phone me-1"></i> Phone: {{ $organicFarm->contact_phone ?? 'N/A' }}
            @if($organicFarm->email)
                • <i class="bx bx-envelope ms-2 me-1"></i> Email: {{ $organicFarm->email }}
            @endif
        </p>
    </div>
    <div>
        <a href="{{ route('admin.organic-farms.edit', $organicFarm->id) }}" class="btn btn-outline-primary">
            <i class="bx bx-edit me-1"></i> Edit Farm Details
        </a>
    </div>
</div>

<div class="row">
    <!-- Upload Photo Form -->
    <div class="col-lg-5 mb-4">
        <div class="card mb-4">
            <div class="card-header border-bottom">
                <h6 class="card-title mb-0"><i class="bx bx-camera me-1"></i> Upload Photo (with SEO Alt Text)</h6>
            </div>
            <div class="card-body pt-3">
                <form action="{{ route('admin.organic-farms.images.store', $organicFarm->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Select Photo <span class="text-danger">*</span></label>
                        <input type="file" name="image" class="form-control" accept="image/*" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">
                            Image Alt Text (SEO)
                            <span class="badge bg-label-success ms-1">Google Search</span>
                        </label>
                        <input type="text" name="alt_text" class="form-control" value="{{ $organicFarm->name }} harvest" placeholder="e.g. Organic vegetable farming harvest trails">
                        <div class="form-text">Improves ranking on Google Image search.</div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Sort Order</label>
                        <input type="number" name="sort_order" class="form-control" value="0">
                    </div>
                    <button type="submit" class="btn btn-primary btn-sm">Upload Photo</button>
                </form>
            </div>
        </div>

        <!-- Quick Summary Card -->
        <div class="card">
            <div class="card-header border-bottom">
                <h6 class="card-title mb-0">Highlights & Activities</h6>
            </div>
            <div class="card-body pt-3">
                @if(!empty($organicFarm->activities))
                    <strong class="small d-block mb-1">Activities:</strong>
                    <div class="d-flex flex-wrap gap-1 mb-3">
                        @foreach($organicFarm->activities as $act)
                            <span class="badge bg-label-info">{{ $act }}</span>
                        @endforeach
                    </div>
                @endif

                @if(!empty($organicFarm->facilities))
                    <strong class="small d-block mb-1">Facilities:</strong>
                    <div class="d-flex flex-wrap gap-1">
                        @foreach($organicFarm->facilities as $fac)
                            <span class="badge bg-label-success">{{ $fac }}</span>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Farm Photos Grid -->
    <div class="col-lg-7 mb-4">
        <div class="card">
            <div class="card-header border-bottom d-flex justify-content-between align-items-center">
                <h5 class="card-title mb-0">Farm Photos ({{ $organicFarm->images->count() }})</h5>
            </div>
            <div class="card-body pt-3">
                <div class="row g-3">
                    @forelse($organicFarm->images as $photo)
                        <div class="col-md-4 col-6 position-relative">
                            <div class="border rounded p-1 bg-light text-center h-100 d-flex flex-column justify-content-between">
                                <img src="{{ asset('storage/' . $photo->image) }}" alt="{{ $photo->alt_text }}" class="rounded w-100 mb-1" style="height: 120px; object-fit: cover;">
                                <div class="small text-truncate text-muted px-1" title="{{ $photo->alt_text }}">{{ $photo->alt_text ?: 'No alt text' }}</div>
                                <form action="{{ route('admin.organic-farms.images.destroy', $photo->id) }}" method="POST" onsubmit="return confirm('Delete this photo?');" class="mt-2">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-xs btn-outline-danger py-0 px-2 w-100">Delete</button>
                                </form>
                            </div>
                        </div>
                    @empty
                        <div class="col-12 text-center py-5 text-muted">
                            <i class="bx bx-image fs-1 d-block mb-2"></i> No photos uploaded for this farm yet.
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

