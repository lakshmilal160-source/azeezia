@extends('Admin.layout')

@section('title', 'Page Banners')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h4 class="fw-bold mb-1"><span class="text-muted fw-light">Content /</span> Page Banners</h4>
        <p class="text-muted mb-0">Manage top hero banners, 2-part styled titles, descriptions, and background imagery for each page.</p>
    </div>
    <a href="{{ route('admin.banners.create') }}" class="btn btn-primary">
        <i class="bx bx-plus me-1"></i> Add Page Banner
    </a>
</div>

<!-- Filters -->
<div class="card mb-4">
    <div class="card-body">
        <form method="GET" action="{{ route('admin.banners.index') }}" class="row g-3">
            <div class="col-md-6">
                <div class="input-group">
                    <span class="input-group-text"><i class="bx bx-search"></i></span>
                    <input
                        type="text"
                        name="search"
                        class="form-control"
                        placeholder="Search by page name, slug, or title..."
                        value="{{ request('search') }}"
                    />
                </div>
            </div>
            <div class="col-md-3">
                <select name="status" class="form-select">
                    <option value="">All Statuses</option>
                    <option value="1" {{ request('status') === '1' ? 'selected' : '' }}>Active Only</option>
                    <option value="0" {{ request('status') === '0' ? 'selected' : '' }}>Inactive Only</option>
                </select>
            </div>
            <div class="col-md-3 d-flex gap-2">
                <button type="submit" class="btn btn-secondary w-100">Filter</button>
                @if(request()->hasAny(['search', 'status']))
                    <a href="{{ route('admin.banners.index') }}" class="btn btn-outline-secondary">Reset</a>
                @endif
            </div>
        </form>
    </div>
</div>

<!-- Banners Table -->
<div class="card">
    <div class="table-responsive text-nowrap">
        <table class="table table-hover mb-0">
            <thead class="table-light">
                <tr>
                    <th style="width: 140px;">Banner Image</th>
                    <th>Page Details</th>
                    <th>Banner Title (2 Parts / Lines)</th>
                    <th>Description</th>
                    <th>Status</th>
                    <th style="width: 120px;">Actions</th>
                </tr>
            </thead>
            <tbody class="table-border-bottom-0">
                @forelse($banners as $banner)
                    <tr>
                        <td>
                            @if($banner->banner_image)
                                <a href="{{ asset('storage/' . $banner->banner_image) }}" target="_blank">
                                    <img
                                        src="{{ asset('storage/' . $banner->banner_image) }}"
                                        alt="{{ $banner->page_name }}"
                                        class="rounded object-fit-cover shadow-sm border"
                                        style="width: 120px; height: 60px;"
                                    />
                                </a>
                            @else
                                <div class="bg-lighter rounded d-flex align-items-center justify-content-center text-muted border" style="width: 120px; height: 60px;">
                                    <small><i class="bx bx-image me-1"></i> No image</small>
                                </div>
                            @endif
                        </td>
                        <td>
                            <strong class="d-block text-dark fs-6">{{ $banner->page_name }}</strong>
                            <span class="badge bg-label-info font-monospace small">/{{ $banner->page_slug }}</span>
                        </td>
                        <td>
                            @if($banner->title_part1)
                                <div class="badge bg-label-warning text-uppercase px-2 py-1 mb-1" style="font-size: 0.72rem; letter-spacing: 0.8px;">
                                    {{ $banner->title_part1 }}
                                </div>
                            @endif
                            <div class="fw-bold text-dark" style="font-size: 0.95rem;">
                                {{ $banner->title_part2 ?? '-' }}
                            </div>
                        </td>
                        <td>
                            @if($banner->description)
                                <div class="text-muted small text-wrap" style="max-width: 280px; line-height: 1.4;">
                                    {{ Str::limit($banner->description, 100) }}
                                </div>
                            @else
                                <span class="text-muted small">-</span>
                            @endif
                        </td>
                        <td>
                            @if($banner->is_active)
                                <span class="badge bg-success">Active</span>
                            @else
                                <span class="badge bg-danger">Inactive</span>
                            @endif
                        </td>
                        <td>
                            <div class="d-flex gap-1">
                                <a href="{{ route('admin.banners.show', $banner->id) }}" class="btn btn-sm btn-icon btn-outline-primary" title="Preview Banner">
                                    <i class="bx bx-show"></i>
                                </a>
                                <a href="{{ route('admin.banners.edit', $banner->id) }}" class="btn btn-sm btn-icon btn-outline-secondary" title="Edit Banner">
                                    <i class="bx bx-edit"></i>
                                </a>
                                <form action="{{ route('admin.banners.destroy', $banner->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this page banner?');" class="d-inline">
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
                        <td colspan="6" class="text-center py-5">
                            <i class="bx bx-image-alt fs-1 text-muted d-block mb-2"></i>
                            <h6 class="mb-1">No Page Banners Found</h6>
                            <p class="text-muted small mb-3">Add banner images and 2-line styled headings for each page.</p>
                            <a href="{{ route('admin.banners.create') }}" class="btn btn-sm btn-primary">
                                <i class="bx bx-plus me-1"></i> Add First Banner
                            </a>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($banners->hasPages())
        <div class="card-footer border-top d-flex justify-content-end py-2">
            {{ $banners->links() }}
        </div>
    @endif
</div>
@endsection

