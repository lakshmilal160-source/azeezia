@extends('Admin.layout')

@section('title', 'Overview Dashboard')

@section('content')
<div class="row">
    <!-- Welcome Banner -->
    <div class="col-12 mb-4">
        <div class="card bg-primary text-white shadow-sm">
            <div class="card-body p-4 d-flex flex-wrap justify-content-between align-items-center">
                <div>
                    <h3 class="card-title text-white mb-2">Welcome to {{ config('custom.app_name', 'Azeezia') }} Admin Panel 👋</h3>
                    <p class="mb-0 text-white-50">Manage your convention venues, luxury resort villas, organic farm experiences, and customer enquiries.</p>
                </div>
                <div class="mt-3 mt-md-0 d-flex gap-2">
                    <a href="{{ route('admin.enquiries.index') }}" class="btn btn-light text-primary position-relative fw-semibold">
                        <i class="bx bx-envelope me-1"></i> Customer Enquiries
                        @if($stats['new_enquiries'] > 0)
                            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                {{ $stats['new_enquiries'] }}
                            </span>
                        @endif
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Statistics Cards -->
    <div class="col-lg-3 col-md-6 col-6 mb-4">
        <a href="{{ route('admin.convention-centres.index') }}" class="text-decoration-none">
            <div class="card h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between mb-2">
                        <span class="badge bg-label-primary rounded p-2"><i class="bx bx-buildings fs-4"></i></span>
                        <span class="text-muted small">Properties</span>
                    </div>
                    <span class="fw-semibold d-block mb-1 text-dark">Convention Centres</span>
                    <h3 class="card-title mb-1 text-primary">{{ $stats['centres'] }}</h3>
                    <small class="text-muted"><i class="bx bx-check-circle text-success"></i> Banquet venues</small>
                </div>
            </div>
        </a>
    </div>

    <div class="col-lg-3 col-md-6 col-6 mb-4">
        <a href="{{ route('admin.resorts.index') }}" class="text-decoration-none">
            <div class="card h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between mb-2">
                        <span class="badge bg-label-info rounded p-2"><i class="bx bx-bed fs-4"></i></span>
                        <span class="text-muted small">Stay</span>
                    </div>
                    <span class="fw-semibold d-block mb-1 text-dark">Resorts & Villas</span>
                    <h3 class="card-title mb-1 text-info">{{ $stats['resorts'] }}</h3>
                    <small class="text-muted"><i class="bx bx-check-circle text-success"></i> Luxury accommodations</small>
                </div>
            </div>
        </a>
    </div>

    <div class="col-lg-3 col-md-6 col-6 mb-4">
        <a href="{{ route('admin.organic-farms.index') }}" class="text-decoration-none">
            <div class="card h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between mb-2">
                        <span class="badge bg-label-success rounded p-2"><i class="bx bx-leaf fs-4"></i></span>
                        <span class="text-muted small">Eco-Tourism</span>
                    </div>
                    <span class="fw-semibold d-block mb-1 text-dark">Organic Farms</span>
                    <h3 class="card-title mb-1 text-success">{{ $stats['farms'] }}</h3>
                    <small class="text-muted"><i class="bx bx-check-circle text-success"></i> Farm attractions</small>
                </div>
            </div>
        </a>
    </div>

    <div class="col-lg-3 col-md-6 col-6 mb-4">
        <a href="{{ route('admin.enquiries.index') }}" class="text-decoration-none">
            <div class="card h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between mb-2">
                        <span class="badge bg-label-warning rounded p-2"><i class="bx bx-envelope fs-4"></i></span>
                        @if($stats['new_enquiries'] > 0)
                            <span class="badge bg-danger">{{ $stats['new_enquiries'] }} New</span>
                        @else
                            <span class="text-muted small">Leads</span>
                        @endif
                    </div>
                    <span class="fw-semibold d-block mb-1 text-dark">Total Enquiries</span>
                    <h3 class="card-title mb-1 text-warning">{{ $stats['enquiries'] }}</h3>
                    <small class="text-muted">Customer booking requests</small>
                </div>
            </div>
        </a>
    </div>

    <!-- Secondary Row: Content & Services -->
    <div class="col-lg-3 col-md-6 col-6 mb-4">
        <div class="card h-100">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <span class="text-muted">Services</span>
                    <i class="bx bx-briefcase text-secondary fs-4"></i>
                </div>
                <h4 class="mb-1">{{ $stats['services'] }}</h4>
                <a href="{{ route('admin.services.index') }}" class="small text-primary">Manage Services &rarr;</a>
            </div>
        </div>
    </div>

    <div class="col-lg-3 col-md-6 col-6 mb-4">
        <div class="card h-100">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <span class="text-muted">Page Banners</span>
                    <i class="bx bx-image-alt text-secondary fs-4"></i>
                </div>
                <h4 class="mb-1">{{ $stats['banners'] }}</h4>
                <a href="{{ route('admin.banners.index') }}" class="small text-primary">Manage Banners &rarr;</a>
            </div>
        </div>
    </div>

    <div class="col-lg-3 col-md-6 col-6 mb-4">
        <div class="card h-100">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <span class="text-muted">Gallery Photos</span>
                    <i class="bx bx-images text-secondary fs-4"></i>
                </div>
                <h4 class="mb-1">{{ $stats['gallery_images'] }}</h4>
                <a href="{{ route('admin.gallery.index') }}" class="small text-primary">Manage Gallery &rarr;</a>
            </div>
        </div>
    </div>

    <div class="col-lg-3 col-md-6 col-6 mb-4">
        <div class="card h-100">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <span class="text-muted">Testimonials</span>
                    <i class="bx bx-star text-secondary fs-4"></i>
                </div>
                <h4 class="mb-1">{{ $stats['testimonials'] }}</h4>
                <a href="{{ route('admin.testimonials.index') }}" class="small text-primary">Manage Reviews &rarr;</a>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <!-- Recent Enquiries -->
    <div class="col-lg-8 mb-4">
        <div class="card h-100">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Recent Customer Enquiries</h5>
                <a href="{{ route('admin.enquiries.index') }}" class="btn btn-sm btn-outline-primary">View All</a>
            </div>
            <div class="table-responsive text-nowrap">
                <table class="table table-hover mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>Customer</th>
                            <th>Phone / Email</th>
                            <th>Type / Subject</th>
                            <th>Status</th>
                            <th>Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @forelse($recentEnquiries as $enquiry)
                            <tr>
                                <td>
                                    <strong>{{ $enquiry->name }}</strong>
                                </td>
                                <td>
                                    <div>{{ $enquiry->phone }}</div>
                                    <small class="text-muted">{{ $enquiry->email ?? '-' }}</small>
                                </td>
                                <td>
                                    <span class="badge bg-label-info">{{ ucfirst($enquiry->enquiry_type ?? 'General') }}</span>
                                    @if($enquiry->subject)
                                        <div class="small text-truncate" style="max-width: 150px;">{{ $enquiry->subject }}</div>
                                    @endif
                                </td>
                                <td>
                                    @if($enquiry->status === 'new')
                                        <span class="badge bg-danger">New</span>
                                    @elseif($enquiry->status === 'contacted')
                                        <span class="badge bg-warning">Contacted</span>
                                    @elseif($enquiry->status === 'closed')
                                        <span class="badge bg-secondary">Closed</span>
                                    @else
                                        <span class="badge bg-primary">{{ ucfirst($enquiry->status) }}</span>
                                    @endif
                                </td>
                                <td>{{ $enquiry->created_at->format('M d, Y') }}</td>
                                <td>
                                    <a href="{{ route('admin.enquiries.show', $enquiry->id) }}" class="btn btn-sm btn-icon btn-outline-primary">
                                        <i class="bx bx-show"></i>
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center py-4 text-muted">
                                    <i class="bx bx-envelope fs-1 d-block mb-1"></i> No enquiries received yet.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Quick Management Column -->
    <div class="col-lg-4 mb-4">
        <div class="card h-100">
            <div class="card-header pb-2">
                <h5 class="card-title mb-0">Quick Management</h5>
            </div>
            <div class="card-body">
                <div class="d-grid gap-2 mb-4">
                    <a href="{{ route('admin.convention-centres.create') }}" class="btn btn-outline-primary text-start">
                        <i class="bx bx-plus-circle me-1"></i> Add Convention Centre
                    </a>
                    <a href="{{ route('admin.resorts.create') }}" class="btn btn-outline-info text-start">
                        <i class="bx bx-plus-circle me-1"></i> Add Resort / Villa
                    </a>
                    <a href="{{ route('admin.organic-farms.create') }}" class="btn btn-outline-success text-start">
                        <i class="bx bx-plus-circle me-1"></i> Add Organic Farm
                    </a>
                    <a href="{{ route('admin.services.create') }}" class="btn btn-outline-secondary text-start">
                        <i class="bx bx-plus-circle me-1"></i> Add Service
                    </a>
                    <a href="{{ route('admin.banners.create') }}" class="btn btn-outline-warning text-start">
                        <i class="bx bx-plus-circle me-1"></i> Add Page Banner
                    </a>
                    <a href="{{ route('admin.upcoming-projects.create') }}" class="btn btn-outline-dark text-start">
                        <i class="bx bx-plus-circle me-1"></i> Add Upcoming Project
                    </a>
                    <a href="{{ route('admin.faqs.create') }}" class="btn btn-outline-secondary text-start">
                        <i class="bx bx-plus-circle me-1"></i> Add FAQ
                    </a>
                </div>

                <div class="p-3 bg-light rounded border">
                    <strong class="d-block mb-1 small text-dark"><i class="bx bx-cog me-1"></i> System Settings</strong>
                    <p class="text-muted small mb-2">Update site title, logo, contact phone, and meta description.</p>
                    <a href="{{ route('admin.settings.edit') }}" class="btn btn-sm btn-primary w-100">
                        Edit Settings
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
