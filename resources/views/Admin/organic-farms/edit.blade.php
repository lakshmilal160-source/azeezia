@extends('Admin.layout')

@section('title', 'Edit Organic Farm')

@section('content')
<div class="mb-4">
    <a href="{{ route('admin.organic-farms.index') }}" class="btn btn-sm btn-outline-secondary mb-2">
        <i class="bx bx-arrow-back me-1"></i> Back to Farms
    </a>
    <h4 class="fw-bold mb-1"><span class="text-muted fw-light">Properties /</span> Edit: {{ $organicFarm->name }}</h4>
    <p class="text-muted mb-0">Update farm specifications, activities, and SEO slug.</p>
</div>

<div class="row">
    <div class="col-lg-9">
        <div class="card">
            <div class="card-body p-4">
                <form action="{{ route('admin.organic-farms.update', $organicFarm->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <!-- Name -->
                    <div class="mb-3">
                        <label class="form-label" for="name">Farm Name <span class="text-danger">*</span></label>
                        <input
                            type="text"
                            class="form-control @error('name') is-invalid @enderror"
                            id="name"
                            name="name"
                            value="{{ old('name', $organicFarm->name) }}"
                            required
                        />
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Slug Section (Hidden: currently only one organic farm. Uncomment if needed in the future)
                    <div class="mb-3">
                        <label class="form-label" for="slug">SEO URL Slug</label>
                        <div class="input-group">
                            <span class="input-group-text">{{ url('/organic-farms') }}/</span>
                            <input
                                type="text"
                                class="form-control @error('slug') is-invalid @enderror"
                                id="slug"
                                name="slug"
                                value="{{ old('slug', $organicFarm->slug) }}"
                            />
                        </div>
                        @error('slug')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>
                    --}}

                    <!-- Short Description -->
                    <div class="mb-3">
                        <label class="form-label" for="short_description">Short Description</label>
                        <textarea
                            class="form-control @error('short_description') is-invalid @enderror"
                            id="short_description"
                            name="short_description"
                            rows="2"
                        >{{ old('short_description', $organicFarm->short_description) }}</textarea>
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
                        >{{ old('description', $organicFarm->description) }}</textarea>
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="row">
                        <!-- Total Area (Acres) -->
                        <div class="col-md-3 mb-3">
                            <label class="form-label" for="area_acres">Area in Acres</label>
                            <input
                                type="number"
                                step="0.01"
                                min="0"
                                class="form-control @error('area_acres') is-invalid @enderror"
                                id="area_acres"
                                name="area_acres"
                                value="{{ old('area_acres', $organicFarm->area_acres) }}"
                            />
                            @error('area_acres')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Contact Phone -->
                        <div class="col-md-3 mb-3">
                            <label class="form-label" for="contact_phone">Contact Phone</label>
                            <input
                                type="text"
                                class="form-control @error('contact_phone') is-invalid @enderror"
                                id="contact_phone"
                                name="contact_phone"
                                value="{{ old('contact_phone', $organicFarm->contact_phone) }}"
                            />
                            @error('contact_phone')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Farm Email -->
                        <div class="col-md-3 mb-3">
                            <label class="form-label" for="email">Farm Email Address</label>
                            <input
                                type="email"
                                class="form-control @error('email') is-invalid @enderror"
                                id="email"
                                name="email"
                                value="{{ old('email', $organicFarm->email) }}"
                                placeholder="farm@azeezia.com"
                            />
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Status -->
                        <div class="col-md-3 mb-3">
                            <label class="form-label" for="is_active">Publish Status</label>
                            <select class="form-select @error('is_active') is-invalid @enderror" id="is_active" name="is_active">
                                <option value="1" {{ old('is_active', $organicFarm->is_active) ? 'selected' : '' }}>Active & Visible</option>
                                <option value="0" {{ !old('is_active', $organicFarm->is_active) ? 'selected' : '' }}>Draft / Inactive</option>
                            </select>
                            @error('is_active')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Activities -->
                    <div class="mb-3">
                        <label class="form-label" for="activities">Activities (Comma separated)</label>
                        <input
                            type="text"
                            class="form-control @error('activities') is-invalid @enderror"
                            id="activities"
                            name="activities"
                            value="{{ old('activities', is_array($organicFarm->activities) ? implode(', ', $organicFarm->activities) : '') }}"
                        />
                        @error('activities')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Facilities -->
                    <div class="mb-3">
                        <label class="form-label" for="facilities">Facilities (Comma separated)</label>
                        <input
                            type="text"
                            class="form-control @error('facilities') is-invalid @enderror"
                            id="facilities"
                            name="facilities"
                            value="{{ old('facilities', is_array($organicFarm->facilities) ? implode(', ', $organicFarm->facilities) : '') }}"
                        />
                        @error('facilities')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Address -->
                    <div class="mb-4">
                        <label class="form-label" for="address">Farm Location Address</label>
                        <textarea
                            class="form-control @error('address') is-invalid @enderror"
                            id="address"
                            name="address"
                            rows="2"
                        >{{ old('address', $organicFarm->address) }}</textarea>
                        @error('address')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary px-4">
                            <i class="bx bx-save me-1"></i> Update Farm
                        </button>
                        <a href="{{ route('admin.organic-farms.show', $organicFarm->id) }}" class="btn btn-outline-info">
                            <i class="bx bx-camera me-1"></i> Manage Photos
                        </a>
                        <a href="{{ route('admin.organic-farms.index') }}" class="btn btn-outline-secondary">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

