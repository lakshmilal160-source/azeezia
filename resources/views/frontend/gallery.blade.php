@extends('frontend.layout.default')
@push('style')
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/gallery.css') }}">
    <style>
.video-container {
    width: 100%;
    height: 500px;
    overflow: hidden;
    border-radius: 10px;
}

.video-container video {
    width: 100%;
    height: 100%;
    object-fit: cover;
    display: block;
}
      </style>
@endpush
@section('content')
@section('body-class', 'gallery-page')
<main>
    @include('frontend.partials.banner', [
        'image_url' => $banner['banner_image'] ?? '',
        'title' => $banner['title_part1'] ?? '',
        'subtitle' => $banner['title_part2'] ?? '',
    ])
    <!-- ========================================================================
         SECTION 2: FILTERABLE GALLERY SHOWCASE
         Stats strip, category filter pills, dynamic editorial cards & lightbox
         ======================================================================== -->
    <section class="gallery-showcase-section" id="gallery-showcase" aria-label="Curated Photo Collections">
        <div class="gallery-showcase-container">

            <!-- Category Filter Pills Bar -->
            <div class="gallery-filter-wrap">
                <div class="gallery-filter-bar" role="tablist" aria-label="Filter gallery by category">
                    <button class="gallery-filter-btn active" data-filter="all" role="tab" aria-selected="true">
                        <span>All Spaces</span>
                        <span class="filter-count">{{ isset($galleryImages) ? $galleryImages->count() : 0 }}</span>
                    </button>
                    @if (isset($categories) && $categories->isNotEmpty())
                        @foreach ($categories as $cat)
                            <button class="gallery-filter-btn" data-filter="{{ $cat->slug }}" role="tab"
                                aria-selected="false">
                                <span>{{ $cat->name }}</span>
                                <span class="filter-count">{{ $cat->images_count ?? $cat->images->count() }}</span>
                            </button>
                        @endforeach
                    @endif
                </div>
            </div>

            <!-- Dynamic Editorial Gallery Grid (Uniform 3 Columns Per Row) -->
            <div class="gallery-grid" id="galleryGrid" aria-live="polite">
                @if (isset($galleryImages) && $galleryImages->isNotEmpty())
                    @foreach ($galleryImages as $item)
                        @php
                            $categorySlug = $item->category?->slug ?? 'other';
                            $categoryName = $item->category?->name ?? 'Gallery';
                            $cardTitle = $item->title ?: '';
                            $imageSrc = $item->image_url;
                        @endphp
                        <article class="gallery-card" data-category="{{ $categorySlug }}"
                            data-category-label="{{ $categoryName }}" data-title="{{ $cardTitle }}">
                            <div class="gallery-card-img-wrap">
                                <img src="{{ $imageSrc }}" alt="{{ $item->alt_text ?: $cardTitle }}"
                                    class="gallery-card-img" loading="lazy">
                                <div class="gallery-card-overlay">
                                    <div class="gallery-card-top">
                                        <span class="gallery-card-tag">{{ $categoryName }}</span>
                                        <div class="gallery-card-zoom-btn" aria-hidden="true"><i
                                                class="fas fa-expand-alt"></i></div>
                                    </div>
                                    <div class="gallery-card-bottom">
                                        <h3 class="gallery-card-title">{{ $cardTitle }}</h3>
                                    </div>
                                </div>
                            </div>
                        </article>
                    @endforeach
                @else
                    <div class="gallery-empty-notice" role="status" style="display:block;grid-column:1/-1;">
                        <i class="fas fa-camera-retro"></i>
                        <h3>No Images Found</h3>
                        <p>No gallery images have been published yet.</p>
                    </div>
                @endif

                <!-- Fallback empty state notice (hidden by default) -->
                <div class="gallery-empty-notice" role="status">
                    <i class="fas fa-camera-retro"></i>
                    <h3>No Images Found</h3>
                    <p>Please select another category tab above to explore our spaces.</p>
                </div>

            </div>

        </div>
    </section>

    <!-- ========================================================================
         SECTION 3: CINEMATIC MOVING VIDEO GALLERY (EDITORIAL DECK DESIGN)
         Exact design matching reference: Left Stacked Heading, Right Overlapping
         Moving Video Cards Stack with Timeline Progress Bar & Sound Toggle
         ======================================================================== -->
    <section class="gallery-video-section az-story-video-section" id="video-gallery"
        aria-label="Azeezia Moving Video Gallery">
        <div class="az-story-section-container">

            <!-- Two-Column Editorial Stage -->
            <div class="az-story-editorial-stage">

                <!-- Left Column: Big Stacked Typography (Same Heading Typography as Home Page Gallery) -->
                <div class="az-story-left-col">
                    <div class="az-story-header-block">
                        <h2 class="az-editorial-heading az-story-heading heading-fade-in-up">
                            <span class="az-title-dark">BECOME</span>
                            <span class="az-title-dark">PART OF A</span>
                            <span class="az-title-accent">GREAT STORY</span>
                        </h2>
                        <p class="az-story-desc">
                            Architecture informs the approach to design. Explore moments from our grand celebrations,
                            luxury retreats, and organic living.
                        </p>

                    </div>
                </div>

                <!-- Right Column: Overlapping Cascading Deck of Moving Videos -->
                <div class="az-story-right-col">
                    <div class="az-story-deck-wrapper" id="azStoryDeckWrapper">

                        <div class="az-story-cards-stage" id="azStoryCardsStage">
                            {{-- <div class="video-container">
                                <video autoplay muted loop playsinline controls>
                                    <source src="{{asset('assets/frontend/images/v-azeezia.mp4')}}" type="video/mp4">
                                    Your browser does not support HTML5 video.
                                </video>
                            </div> --}}
                            <!-- Card 1: Convention Centre & Grand Weddings -->
                            <article class="az-story-card" data-card-index="0" data-youtube-id="M7lc1UVf-VE"
                                data-youtube-url="https://www.youtube.com/watch?v=pCAgCuQPuJQ" role="button"
                                tabindex="0" aria-label="Card 1: Grand Celebrations">
                                <div class="az-story-card-inner">
                                    <img src="{{ asset('assets/frontend/images/testimonial-arch-right.webp') }}"
                                        alt="Azeezia Grand Celebrations" class="az-deck-poster-img" loading="lazy">
                                    <div class="az-deck-youtube-holder"></div>
                                    <div class="az-story-card-overlay">
                                        <div class="az-story-card-top">
                                            <span class="az-story-badge"><i class="fab fa-youtube"
                                                    style="color:#FF0000; margin-right:4px;"></i> YOUTUBE</span>
                                            <a href="https://www.youtube.com/watch?v=pCAgCuQPuJQ" target="_blank"
                                                rel="noopener" class="az-deck-yt-btn" aria-label="Open on YouTube"
                                                title="Watch on YouTube">
                                                <i class="fab fa-youtube" aria-hidden="true"></i>
                                            </a>
                                        </div>
                                        <div class="az-deck-play-center" aria-label="Play YouTube video">
                                            <span class="az-play-pulse" aria-hidden="true"></span>
                                            <i class="fas fa-play" aria-hidden="true"></i>
                                        </div>
                                        <div class="az-story-card-bottom">
                                            <span class="az-story-cat-tag">Weddings &amp; Events</span>
                                            <h3 class="az-story-card-title">Grand Celebrations</h3>
                                        </div>
                                        <button class="az-deck-close-video-btn" aria-label="Close YouTube player"
                                            type="button" title="Close player">
                                            <i class="fas fa-times" aria-hidden="true"></i>
                                        </button>
                                    </div>
                                </div>
                            </article>

                            <!-- Card 2: Luxury Resort & Private Pool Villas -->
                            <article class="az-story-card" data-card-index="1" data-youtube-id="ScMzIvxBSi4"
                                data-youtube-url="https://www.youtube.com/watch?v=_Q2_rC3gccM" role="button"
                                tabindex="0" aria-label="Card 2: Pool Villa Retreats">
                                <div class="az-story-card-inner">
                                    <img src="{{ asset('assets/frontend/images/testimonial-arch-left.webp') }}"
                                        alt="Azeezia Pool Villa Retreats" class="az-deck-poster-img" loading="lazy">
                                    <div class="az-deck-youtube-holder"></div>
                                    <div class="az-story-card-overlay">
                                        <div class="az-story-card-top">
                                            <span class="az-story-badge"><i class="fab fa-youtube"
                                                    style="color:#FF0000; margin-right:4px;"></i> YOUTUBE</span>
                                            <a href="https://www.youtube.com/watch?v=_Q2_rC3gccM" target="_blank"
                                                rel="noopener" class="az-deck-yt-btn" aria-label="Open on YouTube"
                                                title="Watch on YouTube">
                                                <i class="fab fa-youtube" aria-hidden="true"></i>
                                            </a>
                                        </div>
                                        <div class="az-deck-play-center" aria-label="Play YouTube video">
                                            <span class="az-play-pulse" aria-hidden="true"></span>
                                            <i class="fas fa-play" aria-hidden="true"></i>
                                        </div>
                                        <div class="az-story-card-bottom">
                                            <span class="az-story-cat-tag">Luxury Resort</span>
                                            <h3 class="az-story-card-title">Pool Villa Retreats</h3>
                                        </div>
                                        <button class="az-deck-close-video-btn" aria-label="Close YouTube player"
                                            type="button" title="Close player">
                                            <i class="fas fa-times" aria-hidden="true"></i>
                                        </button>
                                    </div>
                                </div>
                            </article>

                            <!-- Card 3: 65+ Acre Organic Farm & Agro-Tour -->
                            <article class="az-story-card" data-card-index="2" data-youtube-id="L_LUpnjgPso"
                                data-youtube-url="https://www.youtube.com/watch?v=pCAgCuQPuJQ" role="button"
                                tabindex="0" aria-label="Card 3: 65+ Acre Farm Oasis">
                                <div class="az-story-card-inner">
                                    <img src="{{ asset('assets/frontend/images/2bhk.webp') }}"
                                        alt="Azeezia 65+ Acre Farm Oasis" class="az-deck-poster-img" loading="lazy">
                                    <div class="az-deck-youtube-holder"></div>
                                    <div class="az-story-card-overlay">
                                        <div class="az-story-card-top">
                                            <span class="az-story-badge"><i class="fab fa-youtube"
                                                    style="color:#FF0000; margin-right:4px;"></i> YOUTUBE</span>
                                            <a href="https://www.youtube.com/watch?v=pCAgCuQPuJQ" target="_blank"
                                                rel="noopener" class="az-deck-yt-btn" aria-label="Open on YouTube"
                                                title="Watch on YouTube">
                                                <i class="fab fa-youtube" aria-hidden="true"></i>
                                            </a>
                                        </div>
                                        <div class="az-deck-play-center" aria-label="Play YouTube video">
                                            <span class="az-play-pulse" aria-hidden="true"></span>
                                            <i class="fas fa-play" aria-hidden="true"></i>
                                        </div>
                                        <div class="az-story-card-bottom">
                                            <span class="az-story-cat-tag">Organic Farm</span>
                                            <h3 class="az-story-card-title">65+ Acre Farm Oasis</h3>
                                        </div>
                                        <button class="az-deck-close-video-btn" aria-label="Close YouTube player"
                                            type="button" title="Close player">
                                            <i class="fas fa-times" aria-hidden="true"></i>
                                        </button>
                                    </div>
                                </div>
                            </article>

                            <!-- Card 4: Signature Dining & Grand Feasts -->
                            <article class="az-story-card" data-card-index="3" data-youtube-id="tgbNymZ7vqY"
                                data-youtube-url="https://www.youtube.com/watch?v=_Q2_rC3gccM" role="button"
                                tabindex="0" aria-label="Card 4: Signature Culinary Art">
                                <div class="az-story-card-inner">
                                    <img src="{{ asset('assets/frontend/images/azeezia-stage.webp') }}"
                                        alt="Azeezia Signature Feasts" class="az-deck-poster-img" loading="lazy">
                                    <div class="az-deck-youtube-holder"></div>
                                    <div class="az-story-card-overlay">
                                        <div class="az-story-card-top">
                                            <span class="az-story-badge"><i class="fab fa-youtube"
                                                    style="color:#FF0000; margin-right:4px;"></i> YOUTUBE</span>
                                            <a href="https://www.youtube.com/watch?v=_Q2_rC3gccM" target="_blank"
                                                rel="noopener" class="az-deck-yt-btn" aria-label="Open on YouTube"
                                                title="Watch on YouTube">
                                                <i class="fab fa-youtube" aria-hidden="true"></i>
                                            </a>
                                        </div>
                                        <div class="az-deck-play-center" aria-label="Play YouTube video">
                                            <span class="az-play-pulse" aria-hidden="true"></span>
                                            <i class="fas fa-play" aria-hidden="true"></i>
                                        </div>
                                        <div class="az-story-card-bottom">
                                            <span class="az-story-cat-tag">Dining &amp; Feasts</span>
                                            <h3 class="az-story-card-title">Signature Feasts</h3>
                                        </div>
                                        <button class="az-deck-close-video-btn" aria-label="Close YouTube player"
                                            type="button" title="Close player">
                                            <i class="fas fa-times" aria-hidden="true"></i>
                                        </button>
                                    </div>
                                </div>
                            </article>

                        </div>

                    </div>
                </div>

            </div>

            <!-- Bottom Thin Progress Timeline Bar (Exact reference design) -->
            <div class="az-story-footer-row">
                <div class="az-story-timeline-track" id="azStoryTimeline">
                    <div class="az-story-timeline-fill" id="azStoryTimelineFill"></div>
                </div>
                <div class="az-story-counter-nav">
                    <button class="az-story-nav-btn prev" id="azStoryPrev" aria-label="Previous video">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <polyline points="15 18 9 12 15 6"></polyline>
                        </svg>
                    </button>
                    <span class="az-story-counter-text" id="azStoryCounter">01 / 04</span>
                    <button class="az-story-nav-btn next" id="azStoryNext" aria-label="Next video">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <polyline points="9 18 15 12 9 6"></polyline>
                        </svg>
                    </button>
                </div>
            </div>

        </div>
    </section>

    <!-- ========================================================================
       FULLSCREEN LIGHTBOX MODAL (CINEMA VIEW)
       ======================================================================== -->
    <div class="gallery-lightbox-modal" id="galleryLightboxModal" role="dialog" aria-modal="true"
        aria-label="Image Viewport">
        <!-- Top Bar -->
        <div class="lightbox-top-bar">
            <span class="lightbox-category-tag" id="lightboxCategoryTag">Gallery</span>
            <button class="lightbox-close-btn" id="lightboxCloseBtn" aria-label="Close fullscreen view">
                <i class="fas fa-times"></i>
            </button>
        </div>

        <!-- Main Image Stage -->
        <div class="lightbox-stage">
            <button class="lightbox-nav-btn lightbox-prev-btn" id="lightboxPrevBtn" aria-label="Previous photograph">
                <i class="fas fa-chevron-left"></i>
            </button>

            <div class="lightbox-img-wrapper">
                <img src="#" alt="Azeezia Expanded View" class="lightbox-active-img" id="lightboxActiveImg">
            </div>

            <button class="lightbox-nav-btn lightbox-next-btn" id="lightboxNextBtn" aria-label="Next photograph">
                <i class="fas fa-chevron-right"></i>
            </button>
        </div>

        <!-- Bottom Bar -->
        <div class="lightbox-bottom-bar">
            <div class="lightbox-caption-col">
                <h4 class="lightbox-caption-title" id="lightboxCaptionTitle">Photograph</h4>
            </div>
            <div class="lightbox-counter" id="lightboxCounter">01 / 01</div>
        </div>
    </div>
</main>
@push('script')
    <script src="{{ asset('assets/frontend/js/gallery.js') }}"></script>
@endpush
@endsection
