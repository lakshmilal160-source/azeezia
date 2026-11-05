@extends('Admin.layout')

@section('title', 'Edit ' . $conventionCentre->name)

@section('content')
<div class="mb-4 d-flex justify-content-between align-items-center">
    <div>
        <a href="{{ route('admin.convention-centres.index') }}" class="btn btn-sm btn-outline-secondary mb-2">
            <i class="bx bx-arrow-back me-1"></i> Back to Centres
        </a>
        <h4 class="fw-bold mb-1"><span class="text-muted fw-light">Properties /</span> Edit: {{ $conventionCentre->name }}</h4>
        <p class="text-muted mb-0">Update basic venue information, mobile hotline, email, and address.</p>
    </div>
    <div>
        <a href="{{ route('admin.convention-centres.show', $conventionCentre->id) }}" class="btn btn-outline-primary">
            <i class="bx bx-images me-1"></i> Manage Photos
        </a>
    </div>
</div>

<div class="row">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-body p-4">
                <form action="{{ route('admin.convention-centres.update', $conventionCentre->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <!-- Name -->
                    <div class="mb-3">
                        <label class="form-label" for="name">Convention Centre Name <span class="text-danger">*</span></label>
                        <input
                            type="text"
                            class="form-control @error('name') is-invalid @enderror"
                            id="name"
                            name="name"
                            value="{{ old('name', $conventionCentre->name) }}"
                            required
                        />
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- SEO URL Slug - Hidden/Commented per user preference --}}
                    {{-- 
                    <div class="mb-3">
                        <label class="form-label" for="slug">SEO URL Slug</label>
                        <input type="text" class="form-control @error('slug') is-invalid @enderror" id="slug" name="slug" value="{{ old('slug', $conventionCentre->slug) }}" />
                    </div>
                    --}}

                    <div class="row g-3 mb-3">
                        <!-- Separate Mobile Number -->
                        <div class="col-md-6">
                            <label class="form-label" for="contact_phone">
                                <i class="bx bx-phone me-1 text-primary"></i> Separate Mobile Number <span class="badge bg-label-info ms-1">Hotline</span>
                            </label>
                            <input
                                type="text"
                                class="form-control @error('contact_phone') is-invalid @enderror"
                                id="contact_phone"
                                name="contact_phone"
                                value="{{ old('contact_phone', $conventionCentre->contact_phone) }}"
                                placeholder="e.g. +91 94470 12345"
                            />
                            @error('contact_phone')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Email Address -->
                        <div class="col-md-6">
                            <label class="form-label" for="email">
                                <i class="bx bx-envelope me-1 text-primary"></i> Contact Email Address
                            </label>
                            <input
                                type="email"
                                class="form-control @error('email') is-invalid @enderror"
                                id="email"
                                name="email"
                                value="{{ old('email', $conventionCentre->email) }}"
                                placeholder="convention@azeezia.com"
                            />
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Address -->
                    <div class="mb-3">
                        <label class="form-label" for="address">Full Physical Address</label>
                        <textarea
                            class="form-control @error('address') is-invalid @enderror"
                            id="address"
                            name="address"
                            rows="2"
                        >{{ old('address', $conventionCentre->address) }}</textarea>
                        @error('address')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Google Maps Location Link -->
                    <div class="mb-3">
                        <label class="form-label" for="location_url">Google Maps Location Link</label>
                        <textarea
                            class="form-control @error('location_url') is-invalid @enderror"
                            id="location_url"
                            name="location_url"
                            rows="2"
                        >{{ old('location_url', $conventionCentre->location_url) }}</textarea>
                        @error('location_url')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Short Description -->
                    <div class="mb-3">
                        <label class="form-label" for="short_description">Short Description / Summary</label>
                        <textarea
                            class="form-control @error('short_description') is-invalid @enderror"
                            id="short_description"
                            name="short_description"
                            rows="2"
                        >{{ old('short_description', $conventionCentre->short_description) }}</textarea>
                        @error('short_description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Full Description -->
                    <div class="mb-3">
                        <label class="form-label" for="description">Full Description</label>
                        <textarea
                            class="form-control @error('description') is-invalid @enderror"
                            id="description"
                            name="description"
                            rows="4"
                        >{{ old('description', $conventionCentre->description) }}</textarea>
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Status -->
                    <div class="mb-4">
                        <label class="form-label" for="is_active">Status</label>
                        <select class="form-select @error('is_active') is-invalid @enderror" id="is_active" name="is_active">
                            <option value="1" {{ old('is_active', $conventionCentre->is_active) ? 'selected' : '' }}>Active & Visible</option>
                            <option value="0" {{ !old('is_active', $conventionCentre->is_active) ? 'selected' : '' }}>Inactive / Hidden</option>
                        </select>
                        @error('is_active')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary px-4">
                            <i class="bx bx-save me-1"></i> Update Convention Centre
                        </button>
                        <a href="{{ route('admin.convention-centres.index') }}" class="btn btn-outline-secondary">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
