@extends('Admin.layout')

@section('title', 'Upcoming Projects')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h4 class="fw-bold mb-1"><span class="text-muted fw-light">Projects /</span> Upcoming Projects</h4>
        <p class="text-muted mb-0">Manage upcoming developments, concept renders, categories, and proposed project stages.</p>
    </div>
    <a href="{{ route('admin.upcoming-projects.create') }}" class="btn btn-primary">
        <i class="bx bx-plus me-1"></i> Add Project
    </a>
</div>

<!-- Filters -->
<div class="card mb-4">
    <div class="card-body">
        <form method="GET" action="{{ route('admin.upcoming-projects.index') }}" class="row g-3">
            <div class="col-md-5">
                <div class="input-group">
                    <span class="input-group-text"><i class="bx bx-search"></i></span>
                    <input
                        type="text"
                        name="search"
                        class="form-control"
                        placeholder="Search project title, category, description..."
                        value="{{ request('search') }}"
                    />
                </div>
            </div>
            <div class="col-md-3">
                <select name="category" class="form-select">
                    <option value="">All Categories</option>
                    @foreach($categories as $cat)
                        <option value="{{ $cat }}" {{ request('category') === $cat ? 'selected' : '' }}>{{ $cat }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-2">
                <select name="status" class="form-select">
                    <option value="">All Stages</option>
                    @foreach($statusOptions as $st)
                        <option value="{{ $st }}" {{ request('status') === $st ? 'selected' : '' }}>{{ $st }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-2 d-flex gap-2">
                <button type="submit" class="btn btn-secondary w-100">Filter</button>
                @if(request()->hasAny(['search', 'category', 'status']))
                    <a href="{{ route('admin.upcoming-projects.index') }}" class="btn btn-outline-secondary">Reset</a>
                @endif
            </div>
        </form>
    </div>
</div>

<!-- Navigation Tabs: Table View vs Live Design Preview -->
<div class="nav-align-top mb-4">
    <ul class="nav nav-pills mb-3" role="tablist">
        <li class="nav-item">
            <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab" data-bs-target="#navs-table">
                <i class="bx bx-table me-1"></i> Data Table View
            </button>
        </li>
        <li class="nav-item">
            <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-cards">
                <i class="bx bx-layout me-1"></i> Website Card Preview
            </button>
        </li>
    </ul>

    <div class="tab-content p-0 bg-transparent shadow-none">
        <!-- 1. Table View -->
        <div class="tab-pane fade show active" id="navs-table" role="tabpanel">
            <div class="card">
                <div class="table-responsive text-nowrap">
                    <table class="table table-hover mb-0">
                        <thead class="table-light">
                            <tr>
                                <th style="width: 70px;">#</th>
                                <th style="width: 140px;">Concept Image</th>
                                <th>Project Title & Subtitle</th>
                                <th>Category</th>
                                <th>Description</th>
                                <th style="width: 110px;">Stage</th>
                                <th style="width: 100px;">Status</th>
                                <th style="width: 110px;">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">
                            @forelse($projects as $project)
                                <tr>
                                    <td>
                                        <span class="badge bg-label-dark font-monospace fs-6">{{ $project->formatted_order }}</span>
                                    </td>
                                    <td>
                                        <div class="position-relative d-inline-block">
                                            @if($project->image)
                                                <a href="{{ asset('storage/' . $project->image) }}" target="_blank">
                                                    <img
                                                        src="{{ asset('storage/' . $project->image) }}"
                                                        alt="{{ $project->title }}"
                                                        class="rounded object-fit-cover shadow-sm border"
                                                        style="width: 110px; height: 70px;"
                                                    />
                                                </a>
                                            @else
                                                <div class="bg-lighter rounded d-flex align-items-center justify-content-center text-muted border" style="width: 110px; height: 70px;">
                                                    <small><i class="bx bx-image me-1"></i> No image</small>
                                                </div>
                                            @endif
                                            <!-- Overlaid Badge -->
                                            <span class="position-absolute top-0 start-0 m-1 badge text-uppercase px-2 py-1"
                                                  style="font-size: 0.65rem; letter-spacing: 0.8px; font-weight: 700;
                                                         background: {{ strtolower($project->status) === 'proposed' ? '#212529' : '#689f38' }};">
                                                {{ $project->status }}
                                            </span>
                                        </div>
                                    </td>
                                    <td>
                                        <strong class="text-dark d-block" style="font-size: 0.95rem;">{{ $project->title }}</strong>
                                        @if($project->subtitle)
                                            <div class="text-muted small">{{ $project->subtitle }}</div>
                                        @endif
                                    </td>
                                    <td>
                                        @if($project->category)
                                            <span class="badge bg-label-success text-uppercase fw-semibold" style="letter-spacing: 0.5px;">
                                                {{ $project->category }}
                                            </span>
                                        @else
                                            <span class="text-muted small">-</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($project->description)
                                            <div class="text-muted small text-wrap" style="max-width: 280px; line-height: 1.4;">
                                                {{ Str::limit($project->description, 110) }}
                                            </div>
                                        @else
                                            <span class="text-muted small">-</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if(strtolower($project->status) === 'proposed')
                                            <span class="badge bg-label-dark">{{ $project->status }}</span>
                                        @else
                                            <span class="badge bg-label-success">{{ $project->status }}</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($project->is_active)
                                            <span class="badge bg-success">Active</span>
                                        @else
                                            <span class="badge bg-danger">Draft</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="d-flex gap-1">
                                            <a href="{{ route('admin.upcoming-projects.edit', $project->id) }}" class="btn btn-sm btn-icon btn-outline-secondary" title="Edit Project">
                                                <i class="bx bx-edit"></i>
                                            </a>
                                            <form action="{{ route('admin.upcoming-projects.destroy', $project->id) }}" method="POST" onsubmit="return confirm('Delete this project?');" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-icon btn-outline-danger" title="Delete Project">
                                                    <i class="bx bx-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="text-center py-5">
                                        <i class="bx bx-rocket fs-1 text-muted d-block mb-2"></i>
                                        <h6 class="mb-1">No Upcoming Projects Found</h6>
                                        <p class="text-muted small mb-3">Add upcoming expansion projects, stays, or tourism developments.</p>
                                        <a href="{{ route('admin.upcoming-projects.create') }}" class="btn btn-sm btn-primary">
                                            <i class="bx bx-plus me-1"></i> Add First Project
                                        </a>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                @if($projects->hasPages())
                    <div class="card-footer border-top d-flex justify-content-end py-2">
                        {{ $projects->links() }}
                    </div>
                @endif
            </div>
        </div>

        <!-- 2. Website Cards Live Preview (Exact User Design) -->
        <div class="tab-pane fade" id="navs-cards" role="tabpanel">
            <div class="p-4 rounded-4" style="background-color: #f8f6f0;">
                <div class="mb-4">
                    <span class="badge bg-label-success text-uppercase mb-1">Frontend Preview</span>
                    <h5 class="fw-bold mb-1 text-dark">Upcoming Developments Showcase</h5>
                    <p class="text-muted small mb-0">Exact replica of how your projects display on the website with 2-digit numbers and badges.</p>
                </div>

                <div class="d-flex flex-column gap-4">
                    @forelse($projects as $project)
                        <div class="card border-0 rounded-4 shadow-sm overflow-hidden bg-white">
                            <div class="card-body p-4">
                                <div class="row align-items-center g-4">
                                    <!-- Left: Image with Badge -->
                                    <div class="col-md-auto">
                                        <div class="position-relative" style="width: 170px; height: 130px;">
                                            @if($project->image)
                                                <img
                                                    src="{{ asset('storage/' . $project->image) }}"
                                                    alt="{{ $project->title }}"
                                                    class="w-100 h-100 object-fit-cover rounded-3 shadow-sm"
                                                />
                                            @else
                                                <div class="w-100 h-100 rounded-3 d-flex flex-column align-items-center justify-content-center text-white"
                                                     style="background: linear-gradient(135deg, #3d5a45 0%, #233b2a 100%);">
                                                    <i class="bx bx-building fs-1 mb-1" style="opacity: 0.85;"></i>
                                                    <span class="small" style="font-size: 0.75rem;">Concept Render</span>
                                                </div>
                                            @endif

                                            <!-- Overlaid Status Badge -->
                                            <span class="position-absolute top-0 start-0 m-2 badge text-uppercase text-white px-2 py-1 shadow-sm"
                                                  style="font-size: 0.68rem; letter-spacing: 1px; font-weight: 700; border-radius: 4px;
                                                         background: {{ strtolower($project->status) === 'proposed' ? '#1f2421' : '#689f38' }};">
                                                {{ $project->status }}
                                            </span>
                                        </div>
                                    </div>

                                    <!-- Middle: Content -->
                                    <div class="col-md">
                                        <!-- Category & Subtitle -->
                                        <div class="d-flex align-items-center gap-1 mb-2">
                                            <span class="fw-bold text-uppercase" style="color: #689f38; font-size: 0.82rem; letter-spacing: 1.2px;">
                                                {{ $project->category ?? 'DEVELOPMENT' }}
                                            </span>
                                            @if($project->subtitle)
                                                <span class="text-muted" style="font-size: 0.85rem;">· {{ $project->subtitle }}</span>
                                            @endif
                                        </div>

                                        <!-- Title (Serif Heading) -->
                                        <h4 class="mb-2 text-dark" style="font-family: Georgia, 'Playfair Display', serif; font-size: 1.45rem; letter-spacing: -0.3px;">
                                            {{ $project->title }}
                                        </h4>

                                        <!-- Description -->
                                        <p class="mb-0 text-muted" style="font-size: 0.95rem; line-height: 1.6; max-width: 680px;">
                                            {{ $project->description }}
                                        </p>
                                    </div>

                                    <!-- Right: Status & Number Column with Dotted Divider -->
                                    <div class="col-md-auto text-center ps-md-4" style="border-left: 2px dotted #d1d5db; min-width: 140px;">
                                        <div class="fst-italic text-secondary mb-1" style="font-family: Georgia, serif; font-size: 1.15rem;">
                                            {{ $project->status }}
                                        </div>
                                        <div class="fw-bolder text-dark" style="font-family: Georgia, 'Playfair Display', serif; font-size: 2.2rem; line-height: 1;">
                                            {{ $project->formatted_order }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="text-center py-5 bg-white rounded-4 shadow-sm">
                            <i class="bx bx-rocket fs-1 text-muted d-block mb-2"></i>
                            <h6>No projects added yet</h6>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
