@php
    $collections = [
        ['title' => 'Agriculture',          'image' => 'frontend/images/collections/cls-bookstore-4.jpg', 'items' => 12],
        ['title' => 'Building Services',    'image' => 'frontend/images/collections/cls-bookstore-5.jpg', 'items' => 18],
        ['title' => 'Waste Water Solutions','image' => 'frontend/images/collections/cls-bookstore-6.jpg', 'items' => 24],
        ['title' => 'Solar Pumps',          'image' => 'frontend/images/collections/cls-bookstore-7.jpg', 'items' => 8],
        ['title' => 'Domestic Pumps',       'image' => 'frontend/images/collections/cls-bookstore-8.jpg', 'items' => 26],
       
    ];
    $chunks = array_chunk($collections, 5);
@endphp

<section class="flat-spacing">
    <div class="container position-relative">
        <div class="heading-section text-center wow fadeInUp">
            <h3>Shop by Categories</h3>
        </div>

        <div id="collectionCarousel" class="carousel slide" data-bs-ride="carousel" data-bs-interval="false">
            <div class="carousel-inner">
                @foreach ($chunks as $index => $chunk)
                    <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                        <div class="row gx-2 justify-content-center">
                            @foreach ($chunk as $collection)
                                <div class="col-md-2 col-6">
                                    <div class="card border-0 text-center collection-card">
                                        <img src="{{ asset($collection['image']) }}" class="img-fluid rounded mb-2" alt="{{ $collection['title'] }}">
                                        <div class="fw-semibold collection-title">{{ $collection['title'] }}</div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Carousel controls -->
            <button class="carousel-control-prev custom-carousel-arrow" type="button" data-bs-target="#collectionCarousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            </button>
            <button class="carousel-control-next custom-carousel-arrow" type="button" data-bs-target="#collectionCarousel" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
            </button>
        </div>
    </div>
</section>