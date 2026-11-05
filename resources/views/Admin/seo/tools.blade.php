@extends('Admin.layout')

@section('title', 'SEO Diagnostics & Tools')

@section('content')
<div class="mb-4">
    <a href="{{ route('admin.seo.index') }}" class="btn btn-sm btn-outline-secondary mb-2">
        <i class="bx bx-arrow-back me-1"></i> Back to SEO Meta
    </a>
    <h4 class="fw-bold mb-1"><span class="text-muted fw-light">SEO /</span> Diagnostics & Sitemap Tools</h4>
    <p class="text-muted mb-0">Monitor sitemaps, search crawler directives, and webmaster tools integration.</p>
</div>

<div class="row">
    <!-- Left Column: Search Engine Endpoints -->
    <div class="col-lg-6 mb-4">
        <div class="card h-100">
            <div class="card-header border-bottom">
                <h5 class="card-title mb-0 d-flex align-items-center">
                    <i class="bx bx-network-chart text-primary me-2 fs-4"></i> Search Engine Endpoints
                </h5>
            </div>
            <div class="card-body pt-4">
                <!-- Sitemap -->
                <div class="d-flex align-items-center justify-content-between p-3 border rounded mb-3 bg-light">
                    <div>
                        <strong class="d-block mb-1">Dynamic XML Sitemap</strong>
                        <div class="text-muted small">Auto-generated XML feed indexing all active pages, halls, resorts & offers.</div>
                        <a href="{{ route('sitemap') }}" target="_blank" class="small fw-semibold text-primary">
                            {{ route('sitemap') }} <i class="bx bx-link-external"></i>
                        </a>
                    </div>
                    <div>
                        <span class="badge bg-success">Live & Active</span>
                    </div>
                </div>

                <!-- Robots.txt -->
                <div class="d-flex align-items-center justify-content-between p-3 border rounded mb-3 bg-light">
                    <div>
                        <strong class="d-block mb-1">Crawler Directives (robots.txt)</strong>
                        <div class="text-muted small">Instructs Googlebot and Bingbot to crawl content while protecting /admin.</div>
                        <a href="{{ route('robots') }}" target="_blank" class="small fw-semibold text-primary">
                            {{ route('robots') }} <i class="bx bx-link-external"></i>
                        </a>
                    </div>
                    <div>
                        <span class="badge bg-success">Configured</span>
                    </div>
                </div>

                <!-- Webmaster Tools -->
                <div class="p-3 border rounded bg-light">
                    <strong class="d-block mb-1">Google Search Console Verification</strong>
                    <div class="text-muted small mb-2">Configure your verification meta tag in Site Settings to verify ownership with Google.</div>
                    <a href="{{ route('admin.settings.edit') }}" class="btn btn-sm btn-outline-primary">
                        <i class="bx bx-cog me-1"></i> Open Site Settings
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Right Column: SEO Best Practice Checklist -->
    <div class="col-lg-6 mb-4">
        <div class="card h-100">
            <div class="card-header border-bottom">
                <h5 class="card-title mb-0 d-flex align-items-center">
                    <i class="bx bx-check-shield text-success me-2 fs-4"></i> On-Page SEO Checklist
                </h5>
            </div>
            <div class="card-body pt-4">
                <ul class="list-group list-group-flush">
                    <li class="list-group-item px-0 d-flex align-items-start">
                        <i class="bx bx-check-circle text-success fs-4 me-2 mt-1"></i>
                        <div>
                            <strong>Clean & Keyword-Rich URL Slugs</strong>
                            <p class="text-muted small mb-0">All Convention Centres, Resorts, and Services automatically generate slug URLs (e.g., <code>/resorts/azeezia-luxury-villa</code>).</p>
                        </div>
                    </li>
                    <li class="list-group-item px-0 d-flex align-items-start">
                        <i class="bx bx-check-circle text-success fs-4 me-2 mt-1"></i>
                        <div>
                            <strong>Image Alt Attributes for Google Image Search</strong>
                            <p class="text-muted small mb-0">Every uploaded photo across halls, resorts, and galleries allows custom alt text to maximize image search traffic.</p>
                        </div>
                    </li>
                    <li class="list-group-item px-0 d-flex align-items-start">
                        <i class="bx bx-check-circle text-success fs-4 me-2 mt-1"></i>
                        <div>
                            <strong>Open Graph Meta Tags</strong>
                            <p class="text-muted small mb-0">High-resolution sharing cards automatically generate previews for WhatsApp, Facebook, Twitter, and LinkedIn.</p>
                        </div>
                    </li>
                    <li class="list-group-item px-0 d-flex align-items-start">
                        <i class="bx bx-check-circle text-success fs-4 me-2 mt-1"></i>
                        <div>
                            <strong>Self-Referencing Canonical URLs</strong>
                            <p class="text-muted small mb-0">Guards against duplicate content penalties when tracking queries (e.g. UTM parameters) are attached.</p>
                        </div>
                    </li>
                </ul>

                <div class="alert alert-info mt-3 mb-0 small">
                    <i class="bx bx-info-circle me-1"></i> <strong>Pro-Tip:</strong> Submit your <code>{{ route('sitemap') }}</code> in <a href="https://search.google.com/search-console" target="_blank" class="fw-semibold">Google Search Console</a> to expedite page indexing.
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

