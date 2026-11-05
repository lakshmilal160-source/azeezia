@extends('Admin.layout')

@section('title', 'Banner - ' . $banner->page_name)

@section('content')
<div class="mb-4 d-flex justify-content-between align-items-center">
    <div>
        <a href="{{ route('admin.banners.index') }}" class="btn btn-sm btn-outline-secondary mb-2">
            <i class="bx bx-arrow-back me-1"></i> Back to Banners
        </a>
        <h4 class="fw-bold mb-1"><span class="text-muted fw-light">Content / Page Banners /</span> {{ $banner->page_name }}</h4>
        <p class="text-muted mb-0">Identifier: <code>/{{ $banner->page_slug }}</code> • Status: {!! $banner->is_active ? '<span class="badge bg-success">Active</span>' : '<span class="badge bg-danger">Inactive</span>' !!}</p>
    </div>
    <div class="d-flex gap-2">
        <a href="{{ route('admin.banners.edit', $banner->id) }}" class="btn btn-primary">
            <i class="bx bx-edit me-1"></i> Edit Banner
        </a>
        <form action="{{ route('admin.banners.destroy', $banner->id) }}" method="POST" onsubmit="return confirm('Delete this page banner?');" class="d-inline">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-outline-danger">
                <i class="bx bx-trash me-1"></i> Delete
            </button>
        </form>
    </div>
</div>

<div class="row">
    <!-- Big Banner Hero Preview -->
    <div class="col-12 mb-4">
        <div class="card overflow-hidden shadow-sm">
            <div class="card-header border-bottom py-2 bg-light d-flex justify-content-between align-items-center">
                <span class="small fw-semibold text-muted text-uppercase">Full-Width Hero Banner Display</span>
                <span class="badge bg-label-info">2-Part Headline</span>
            </div>
            <div class="position-relative text-center p-5 d-flex flex-column justify-content-center align-items-center"
                 style="min-height: 340px;
                        @if($banner->banner_image)
                            background-image: url('{{ asset('storage/' . $banner->banner_image) }}');
                        @else
                            background: linear-gradient(135deg, #1b2838 0%, #2a3a4c 100%);
                        @endif
                        background-size: cover; background-position: center;">
                <!-- Dark Overlay -->
                <div class="position-absolute top-0 start-0 w-100 h-100" style="background: rgba(15, 23, 42, 0.65); z-index: 1;"></div>

                <!-- Banner Text Content -->
                <div class="position-relative" style="z-index: 2; max-width: 800px;">
                    @if($banner->title_part1)
                        <div class="text-uppercase fw-bold mb-2" style="color: #f6c23e; letter-spacing: 3px; font-size: 0.95rem;">
                            {{ $banner->title_part1 }}
                        </div>
                    @endif

                    <h1 class="fw-bolder text-white mb-3" style="font-size: 2.3rem; text-shadow: 0 2px 6px rgba(0,0,0,0.6);">
                        {{ $banner->title_part2 ?? $banner->page_name }}
                    </h1>

                    @if($banner->description)
                        <p class="text-light fs-6 mb-0" style="opacity: 0.92; line-height: 1.6;">
                            {{ $banner->description }}
                        </p>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Metadata Details -->
    <div class="col-lg-6 mb-4">
        <div class="card h-100">
            <div class="card-header border-bottom">
                <h5 class="card-title mb-0"><i class="bx bx-info-circle me-1 text-primary"></i> Banner Properties</h5>
            </div>
            <div class="card-body pt-3">
                <table class="table table-borderless mb-0">
                    <tbody>
                        <tr>
                            <td class="text-muted fw-semibold" style="width: 170px;">Target Page Name:</td>
                            <td class="text-dark fw-bold">{{ $banner->page_name }}</td>
                        </tr>
                        <tr>
                            <td class="text-muted fw-semibold">Page Slug / Key:</td>
                            <td><span class="badge bg-label-info font-monospace">{{ $banner->page_slug }}</span></td>
                        </tr>
                        <tr>
                            <td class="text-muted fw-semibold">Title Line 1 (Accent):</td>
                            <td>
                                @if($banner->title_part1)
                                    <span class="badge bg-label-warning text-uppercase">{{ $banner->title_part1 }}</span>
                                @else
                                    <span class="text-muted">-</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td class="text-muted fw-semibold">Title Line 2 (Headline):</td>
                            <td class="text-dark fw-semibold">{{ $banner->title_part2 ?? '-' }}</td>
                        </tr>
                        <tr>
                            <td class="text-muted fw-semibold">Image File:</td>
                            <td>
                                @if($banner->banner_image)
                                    <a href="{{ asset('storage/' . $banner->banner_image) }}" target="_blank" class="small">
                                        <i class="bx bx-link-external me-1"></i> View image file
                                    </a>
                                @else
                                    <span class="text-muted small">No custom image uploaded</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td class="text-muted fw-semibold">Last Updated:</td>
                            <td class="text-muted small">{{ $banner->updated_at->format('M d, Y - h:i A') }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Code Integration Card -->
    <div class="col-lg-6 mb-4">
        <div class="card h-100">
            <div class="card-header border-bottom">
                <h5 class="card-title mb-0"><i class="bx bx-code-alt me-1 text-primary"></i> Frontend Template Code</h5>
            </div>
            <div class="card-body pt-3">
                <p class="text-muted small mb-2">How to render this banner on your frontend Blade views:</p>
                <div class="p-3 bg-dark text-light rounded font-monospace small mb-3 overflow-auto" style="font-size: 0.8rem; line-height: 1.6;">
                    <span class="text-secondary">&lt;!-- Fetch banner by page slug --&gt;</span><br>
                    &#64;php<br>
                    &nbsp;&nbsp;$banner = \App\Models\PageBanner::getForPage('{{ $banner->page_slug }}');<br>
                    &#64;endphp<br><br>
                    &#64;if($banner)<br>
                    &nbsp;&nbsp;&lt;section class="page-banner" style="background-image: url('&#123;&#123; $banner-&gt;image_url &#125;&#125;');"&gt;<br>
                    &nbsp;&nbsp;&nbsp;&nbsp;&lt;div class="overlay"&gt;&lt;/div&gt;<br>
                    &nbsp;&nbsp;&nbsp;&nbsp;&lt;div class="container text-center"&gt;<br>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&lt;span class="banner-subtitle text-uppercase"&gt;&#123;&#123; $banner-&gt;title_part1 &#125;&#125;&lt;/span&gt;<br>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&lt;h1 class="banner-title"&gt;&#123;&#123; $banner-&gt;title_part2 &#125;&#125;&lt;/h1&gt;<br>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&lt;p class="banner-desc"&gt;&#123;&#123; $banner-&gt;description &#125;&#125;&lt;/p&gt;<br>
                    &nbsp;&nbsp;&nbsp;&nbsp;&lt;/div&gt;<br>
                    &nbsp;&nbsp;&lt;/section&gt;<br>
                    &#64;endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

