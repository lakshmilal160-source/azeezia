@extends('Admin.layout')

@section('title', 'Page SEO & Meta Tags')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h4 class="fw-bold mb-1"><span class="text-muted fw-light">SEO /</span> Page Meta Tags</h4>
        <p class="text-muted mb-0">Control how each page of Azeezia is indexed and displayed on Google & Social Media</p>
    </div>
    <div>
        <a href="{{ route('admin.seo.tools') }}" class="btn btn-outline-primary">
            <i class="bx bx-wrench me-1"></i> SEO Tools & Sitemap
        </a>
    </div>
</div>

<div class="card">
    <div class="card-header border-bottom d-flex justify-content-between align-items-center py-3">
        <h5 class="card-title mb-0">Configured Pages ({{ $pages->count() }})</h5>
        <span class="badge bg-label-success">All Active</span>
    </div>
    <div class="table-responsive text-nowrap">
        <table class="table table-hover">
            <thead class="table-light">
                <tr>
                    <th>Page Key / Route</th>
                    <th>Meta Title</th>
                    <th>Meta Description</th>
                    <th>Robots</th>
                    <th>OG Image</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody class="table-border-bottom-0">
                @foreach($pages as $page)
                    <tr>
                        <td>
                            <strong class="text-primary text-uppercase">{{ str_replace('-', ' ', $page->page_key) }}</strong>
                            <div class="text-muted small">/{{ $page->page_key === 'home' ? '' : $page->page_key }}</div>
                        </td>
                        <td>
                            @if($page->meta_title)
                                <div class="text-truncate" style="max-width: 250px;" title="{{ $page->meta_title }}">
                                    {{ $page->meta_title }}
                                </div>
                                <small class="text-muted">{{ strlen($page->meta_title) }} chars</small>
                            @else
                                <span class="badge bg-label-warning">Missing Title</span>
                            @endif
                        </td>
                        <td>
                            @if($page->meta_description)
                                <div class="text-truncate" style="max-width: 280px;" title="{{ $page->meta_description }}">
                                    {{ $page->meta_description }}
                                </div>
                                <small class="text-muted">{{ strlen($page->meta_description) }} chars</small>
                            @else
                                <span class="badge bg-label-warning">Missing Description</span>
                            @endif
                        </td>
                        <td>
                            @if(str_contains($page->robots, 'noindex'))
                                <span class="badge bg-danger">{{ $page->robots }}</span>
                            @else
                                <span class="badge bg-label-success">{{ $page->robots }}</span>
                            @endif
                        </td>
                        <td>
                            @if($page->og_image)
                                <img src="{{ asset('storage/' . $page->og_image) }}" alt="OG" class="rounded border" style="width: 48px; height: 32px; object-fit: cover;">
                            @else
                                <span class="badge bg-label-secondary">None</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('admin.seo.edit', $page->id) }}" class="btn btn-sm btn-primary">
                                <i class="bx bx-edit me-1"></i> Edit SEO
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection

