@extends('Admin.layout')

@section('title', 'Photo Gallery')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h4 class="fw-bold mb-1"><span class="text-muted fw-light">Media /</span> Photo Gallery</h4>
        <p class="text-muted mb-0">High-resolution photography with SEO image alt text</p>
    </div>
    <div class="d-flex gap-2">
        <a href="{{ route('admin.gallery.categories') }}" class="btn btn-outline-primary">
            <i class="bx bx-category me-1"></i> Manage Categories
        </a>
        <a href="{{ route('admin.gallery.create') }}" class="btn btn-primary">
            <i class="bx bx-upload me-1"></i> Upload Photo
        </a>
    </div>
</div>

<!-- Category Filter Tabs -->
<div class="card mb-4">
    <div class="card-body py-2">
        <div class="d-flex flex-wrap gap-2 align-items-center">
            <span class="text-muted small fw-bold me-2">Category:</span>
            <a href="{{ route('admin.gallery.index') }}" class="btn btn-sm {{ !request('category_id') ? 'btn-primary' : 'btn-outline-secondary' }}">
                All Photos
            </a>
            @foreach($categories as $cat)
                <a href="{{ route('admin.gallery.index', ['category_id' => $cat->id]) }}" class="btn btn-sm {{ request('category_id') == $cat->id ? 'btn-primary' : 'btn-outline-secondary' }}">
                    {{ $cat->name }}
                </a>
            @endforeach
        </div>
    </div>
</div>

<div class="row g-3">
    @forelse($images as $img)
        <div class="col-xl-2 col-lg-3 col-md-4 col-6">
            <div class="card h-100 shadow-xs border">
                <div class="position-relative overflow-hidden" style="height: 140px;">
                    <img src="{{ asset('storage/' . $img->image) }}" alt="{{ $img->alt_text }}" class="w-100 h-100" style="object-fit: cover;">
                    @if($img->category)
                        <span class="position-absolute top-0 start-0 m-2 badge bg-dark bg-opacity-75 small">
                            {{ $img->category->name }}
                        </span>
                    @endif
                </div>
                <div class="card-body p-2 d-flex flex-column justify-content-between">
                    <div>
                        <strong class="d-block small text-truncate" title="{{ $img->title ?? 'Untitled' }}">
                            {{ $img->title ?: 'Untitled' }}
                        </strong>
                        <small class="text-muted d-block text-truncate" title="Alt: {{ $img->alt_text }}">
                            <i class="bx bx-tag small"></i> {{ $img->alt_text ?: 'No alt text' }}
                        </small>
                    </div>
                    <div class="d-flex justify-content-between align-items-center mt-2 pt-2 border-top">
                        <a href="{{ route('admin.gallery.edit', $img->id) }}" class="btn btn-xs btn-outline-secondary py-0 px-2">
                            <i class="bx bx-edit"></i>
                        </a>
                        <form action="{{ route('admin.gallery.destroy', $img->id) }}" method="POST" onsubmit="return confirm('Delete photo?');" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-xs btn-outline-danger py-0 px-2">
                                <i class="bx bx-trash"></i>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @empty
        <div class="col-12 text-center py-5">
            <div class="card py-5">
                <i class="bx bx-images fs-1 text-muted d-block mb-2"></i>
                <h5 class="text-muted">No gallery photos uploaded yet.</h5>
                <div>
                    <a href="{{ route('admin.gallery.create') }}" class="btn btn-primary btn-sm">Upload Photo</a>
                </div>
            </div>
        </div>
    @endforelse
</div>

@if($images->hasPages())
    <div class="mt-4">
        {{ $images->links() }}
    </div>
@endif
@endsection

