@extends('Admin.layout')

@section('title', 'Gallery Categories')

@section('content')
<div class="mb-4">
    <a href="{{ route('admin.gallery.index') }}" class="btn btn-sm btn-outline-secondary mb-2">
        <i class="bx bx-arrow-back me-1"></i> Back to Gallery
    </a>
    <h4 class="fw-bold mb-1"><span class="text-muted fw-light">Media /</span> Gallery Categories</h4>
    <p class="text-muted mb-0">Organize photos into sections (e.g. Grand Ballroom, Villas, Farm, Dining)</p>
</div>

<div class="row">
    <!-- Existing Categories List -->
    <div class="col-lg-7 mb-4">
        <div class="card">
            <div class="card-header border-bottom">
                <h5 class="card-title mb-0">Existing Categories ({{ $categories->count() }})</h5>
            </div>
            <div class="table-responsive text-nowrap">
                <table class="table table-hover mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>Category Name / Slug</th>
                            <th>Photos</th>
                            <th>Order</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @forelse($categories as $cat)
                            <tr>
                                <td>
                                    <strong>{{ $cat->name }}</strong>
                                    <div class="text-muted small"><code>{{ $cat->slug }}</code></div>
                                </td>
                                <td>
                                    <span class="badge bg-label-info">{{ $cat->images_count }} photos</span>
                                </td>
                                <td>{{ $cat->sort_order }}</td>
                                <td>
                                    @if($cat->is_active)
                                        <span class="badge bg-success">Active</span>
                                    @else
                                        <span class="badge bg-danger">Inactive</span>
                                    @endif
                                </td>
                                <td>
                                    @if($cat->images_count == 0)
                                        <form action="{{ route('admin.gallery.categories.destroy', $cat->id) }}" method="POST" onsubmit="return confirm('Delete this category?');" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-icon btn-outline-danger" title="Delete">
                                                <i class="bx bx-trash"></i>
                                            </button>
                                        </form>
                                    @else
                                        <span class="text-muted small" title="Cannot delete category containing photos">In Use</span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center py-4 text-muted">
                                    No categories created yet. Add one on the right.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Create Category Form -->
    <div class="col-lg-5 mb-4">
        <div class="card">
            <div class="card-header border-bottom">
                <h6 class="card-title mb-0"><i class="bx bx-plus-circle me-1"></i> Add New Category</h6>
            </div>
            <div class="card-body pt-3">
                <form action="{{ route('admin.gallery.categories.store') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label" for="name">Category Name <span class="text-danger">*</span></label>
                        <input
                            type="text"
                            class="form-control"
                            id="name"
                            name="name"
                            data-slug-source
                            placeholder="e.g. Grand Conventions"
                            required
                        />
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="slug">URL Slug</label>
                        <input
                            type="text"
                            class="form-control"
                            id="slug"
                            name="slug"
                            data-slug-target
                            placeholder="grand-conventions"
                        />
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="sort_order">Sort Order</label>
                        <input type="number" min="0" class="form-control" id="sort_order" name="sort_order" value="0">
                    </div>

                    <div class="mb-3">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="is_active" id="cat_is_active" value="1" checked>
                            <label class="form-check-label" for="cat_is_active">Active & Available in Filters</label>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary btn-sm w-100">Create Category</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

