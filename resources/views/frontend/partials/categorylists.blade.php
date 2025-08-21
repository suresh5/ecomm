<div class="container my-4">
    <div class="row">
        @foreach($categories as $category)
            @if($category->children->isNotEmpty())
                <!-- Category with Subcategories -->
                <div class="col-12 mb-4">
                    <div class="card border rounded shadow-sm">
                        <div class="row g-0">
                            <!-- Left: Main Category -->
                            <div class="col-md-3 d-flex flex-column justify-content-center align-items-center p-3 border-end">
                                <img src="{{ $category->photo ?? '/default-category.png' }}" 
                                     alt="{{ $category->title }}" 
                                     class="img-fluid rounded mb-2" style="max-height:120px; object-fit:contain;">
                                <h5 class="fw-bold mb-2">{{ $category->title }}</h5>
                                <a href="{{ route('category.products', $category->slug) }}" class="btn btn-primary btn-sm">
                                    View Products
                                </a>
                            </div>

                            <!-- Right: Subcategories -->
                            <div class="col-md-9 p-3">
                                
                                <div class="row g-4">
    @foreach($category->children as $sub)
        <div class="col-md-4 col-sm-6 col-12 d-flex">
            <a href="{{ route('category.products', $sub->slug) }}" class="text-decoration-none w-100">
                <div class="card h-100 border shadow-sm text-center p-3 hover-shadow">
                    <h6 class="fw-semibold text-dark mb-0">{{ $sub->title }}</h6>
                </div>
            </a>
        </div>
    @endforeach
</div>

                            </div>
                        </div>
                    </div>
                </div>
            @else
                <!-- Single Category without Subcategories -->
                <div class="col-md-3 mb-4">
                    <div class="card border rounded shadow-sm h-100 text-center p-3">
                        <img src="{{ $category->photo ?? '/default-category.png' }}" 
                             alt="{{ $category->title }}" 
                             class="img-fluid rounded mb-2" style="max-height:100px; object-fit:contain;">
                        <h6 class="fw-bold">{{ $category->title }}</h6>
                        <a href="{{ route('category.products', $category->slug) }}" class="btn btn-outline-primary btn-sm mt-2">
                            View Products
                        </a>
                    </div>
                </div>
            @endif
        @endforeach
    </div>
</div>