@extends('Admin.layout')

@section('title', 'Add Resort / Stay')

@section('content')
<div class="mb-4">
    <a href="{{ route('admin.resorts.index') }}" class="btn btn-sm btn-outline-secondary mb-2">
        <i class="bx bx-arrow-back me-1"></i> Back to Resorts
    </a>
    <h4 class="fw-bold mb-1"><span class="text-muted fw-light">Properties /</span> Add Resort Property</h4>
    <p class="text-muted mb-0">Set up a new stay, villa, or resort location.</p>
</div>

<div class="row">
    <div class="col-lg-9">
        <div class="card">
            <div class="card-body p-4">
                <form action="{{ route('admin.resorts.store') }}" method="POST">
                    @csrf

                    <!-- Name -->
                    <div class="mb-3">
                        <label class="form-label" for="name">Resort / Villa Name <span class="text-danger">*</span></label>
                        <input
                            type="text"
                            class="form-control @error('name') is-invalid @enderror"
                            id="name"
                            name="name"
                            value="{{ old('name') }}"
                            placeholder="e.g. Azeezia Nature Palms Resort"
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
                                data-slug-target
                                value="{{ old('slug') }}"
                                placeholder="azeezia-nature-palms-resort"
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
                            placeholder="Overview of the stay for listing previews..."
                        >{{ old('short_description') }}</textarea>
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
                            placeholder="Detailed description of suites, environment, culinary options, check-in policies..."
                        >{{ old('description') }}</textarea>
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="row">
                        <!-- Contact Phone -->
                        <div class="col-md-4 mb-3">
                            <label class="form-label" for="contact_phone">Front Desk / Contact Phone</label>
                            <input
                                type="text"
                                class="form-control @error('contact_phone') is-invalid @enderror"
                                id="contact_phone"
                                name="contact_phone"
                                value="{{ old('contact_phone') }}"
                                placeholder="+91 98765 43210"
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
                                value="{{ old('email') }}"
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
                                <option value="1" {{ old('is_active', '1') == '1' ? 'selected' : '' }}>Active & Available for Booking</option>
                                <option value="0" {{ old('is_active') == '0' ? 'selected' : '' }}>Draft / Inactive</option>
                            </select>
                            @error('is_active')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Amenities -->
                    <div class="mb-3">
                        <label class="form-label" for="amenities">Key Amenities (Comma separated)</label>
                        <input
                            type="text"
                            class="form-control @error('amenities') is-invalid @enderror"
                            id="amenities"
                            name="amenities"
                            value="{{ old('amenities', 'Swimming Pool, Free Wi-Fi, King Bed, Complimentary Breakfast, Air Conditioned, Garden View') }}"
                            placeholder="Swimming Pool, Free Wi-Fi, Restaurant, Room Service"
                        />
                        <div class="form-text">Separate amenities with commas.</div>
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
                            placeholder="Physical address, landmark, state, pin code..."
                        >{{ old('address') }}</textarea>
                        @error('address')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary px-4">
                            <i class="bx bx-save me-1"></i> Save Resort
                        </button>
                        <a href="{{ route('admin.resorts.index') }}" class="btn btn-outline-secondary">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

