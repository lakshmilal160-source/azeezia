@extends('Admin.layout')

@section('title', 'Edit Resort')

@section('content')
<div class="mb-4">
    <a href="{{ route('admin.resorts.index') }}" class="btn btn-sm btn-outline-secondary mb-2">
        <i class="bx bx-arrow-back me-1"></i> Back to Resorts
    </a>
    <h4 class="fw-bold mb-1"><span class="text-muted fw-light">Properties /</span> Edit: {{ $resort->name }}</h4>
    <p class="text-muted mb-0">Modify resort profile, phone, amenities, and SEO slug.</p>
</div>

<div class="row">
    <div class="col-lg-9">
        <div class="card">
            <div class="card-body p-4">
                <form action="{{ route('admin.resorts.update', $resort->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <!-- Name -->
                    <div class="mb-3">
                        <label class="form-label" for="name">Resort / Villa Name <span class="text-danger">*</span></label>
                        <input
                            type="text"
                            class="form-control @error('name') is-invalid @enderror"
                            id="name"
                            name="name"
                            value="{{ old('name', $resort->name) }}"
                            required
                        />
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- SEO Slug (Commented out per request - uncomment if needed in the future)
                    <div class="mb-3">
                        <label class="form-label" for="slug">SEO URL Slug</label>
                        <div class="input-group">
                            <span class="input-group-text">{{ url('/resorts') }}/</span>
                            <input
                                type="text"
                                class="form-control @error('slug') is-invalid @enderror"
                                id="slug"
                                name="slug"
                                value="{{ old('slug', $resort->slug) }}"
                            />
                        </div>
                        @error('slug')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>
                    --}}

                    <!-- Short Description -->
                    <div class="mb-3">
                        <label class="form-label" for="short_description">Short Description (Snippet)</label>
                        <textarea
                            class="form-control @error('short_description') is-invalid @enderror"
                            id="short_description"
                            name="short_description"
                            rows="2"
                        >{{ old('short_description', $resort->short_description) }}</textarea>
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
                            rows="6"
                        >{{ old('description', $resort->description) }}</textarea>
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="row">
                        <!-- Contact Phone -->
                        <div class="col-md-4 mb-3">
                            <label class="form-label" for="contact_phone">Contact Phone</label>
                            <input
                                type="text"
                                class="form-control @error('contact_phone') is-invalid @enderror"
                                id="contact_phone"
                                name="contact_phone"
                                value="{{ old('contact_phone', $resort->contact_phone) }}"
                            />
                            @error('contact_phone')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Email Address -->
                        <div class="col-md-4 mb-3">
                            <label class="form-label" for="email">Resort Email Address</label>
                            <input
                                type="email"
                                class="form-control @error('email') is-invalid @enderror"
                                id="email"
                                name="email"
                                value="{{ old('email', $resort->email) }}"
                                placeholder="resort@azeezia.com"
                            />
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Status -->
                        <div class="col-md-4 mb-3">
                            <label class="form-label" for="is_active">Publish Status</label>
                            <select class="form-select @error('is_active') is-invalid @enderror" id="is_active" name="is_active">
                                <option value="1" {{ old('is_active', $resort->is_active) ? 'selected' : '' }}>Active & Available</option>
                                <option value="0" {{ !old('is_active', $resort->is_active) ? 'selected' : '' }}>Draft / Inactive</option>
                            </select>
                            @error('is_active')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Amenities -->
                    <div class="mb-3">
                        <label class="form-label" for="amenities">Amenities (Comma separated)</label>
                        <input
                            type="text"
                            class="form-control @error('amenities') is-invalid @enderror"
                            id="amenities"
                            name="amenities"
                            value="{{ old('amenities', is_array($resort->amenities) ? implode(', ', $resort->amenities) : '') }}"
                        />
                        @error('amenities')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Address -->
                    <div class="mb-4">
                        <label class="form-label" for="address">Resort Address</label>
                        <textarea
                            class="form-control @error('address') is-invalid @enderror"
                            id="address"
                            name="address"
                            rows="2"
                        >{{ old('address', $resort->address) }}</textarea>
                        @error('address')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary px-4">
                            <i class="bx bx-save me-1"></i> Update Resort
                        </button>
                        <a href="{{ route('admin.resorts.show', $resort->id) }}" class="btn btn-outline-info">
                            <i class="bx bx-bed me-1"></i> Manage Rooms & Photos
                        </a>
                        <a href="{{ route('admin.resorts.index') }}" class="btn btn-outline-secondary">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

