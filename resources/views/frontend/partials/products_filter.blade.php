<div class="bg-white p-4 rounded shadow-sm mb-4">
    <!-- Categories & Subcategories -->
    <h5 class="fw-bold mb-3">Categories</h5>
    <ul class="list-unstyled">
        @foreach($categories as $category)
            @if($category->children->isNotEmpty())
                {{-- Category with subcategories: toggle --}}
                <li class="mb-1" data-has-sub="1" data-cat-id="{{ $category->id }}">
                    <a class="d-flex justify-content-between align-items-center text-decoration-none fw-semibold text-dark" 
                       data-bs-toggle="collapse" href="#collapseCat{{ $category->id }}" role="button" aria-expanded="false" aria-controls="collapseCat{{ $category->id }}">
                        {{ $category->title }}
                        <span class="bi bi-chevron-down"></span>
                    </a>
                    <ul class="list-unstyled collapse ms-3 mt-1" id="collapseCat{{ $category->id }}">
                        @foreach($category->children as $child)
                            <li class="mb-1">
                                <div class="form-check">
                                    <input class="form-check-input category-checkbox" type="checkbox" value="{{ $child->id }}" id="child{{ $child->id }}">
                                    <label class="form-check-label" for="child{{ $child->id }}">
                                        {{ $child->title }}
                                    </label>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </li>
            @else
                {{-- Category without subcategories: checkbox --}}
                <li class="mb-1" data-has-sub="0" data-cat-id="{{ $category->id }}">
                    <div class="form-check">
                        <input class="form-check-input category-checkbox" type="checkbox" value="{{ $category->id }}" id="cat{{ $category->id }}">
                        <label class="form-check-label fw-semibold" for="cat{{ $category->id }}">
                            {{ $category->title }}
                        </label>
                    </div>
                </li>
            @endif
        @endforeach
    </ul>

    <!-- Attributes Filter -->
    <h5 class="fw-bold mt-4 mb-3">Attributes</h5>
    <form id="attribute-filter-form">
        @foreach($attributes as $attribute)
            <h6 class="mt-2">{{ $attribute->name }}</h6>
            @foreach($attribute->values as $value)
                <div class="form-check ms-2">
                    <input class="form-check-input attribute-checkbox" type="checkbox" value="{{ $value->id }}" id="attr{{ $value->id }}">
                    <label class="form-check-label" for="attr{{ $value->id }}">
                        {{ $value->value }}
                    </label>
                </div>
            @endforeach
        @endforeach
    </form>
</div>
