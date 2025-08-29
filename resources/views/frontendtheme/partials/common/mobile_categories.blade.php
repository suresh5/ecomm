 <!-- Categories -->
    <div class="offcanvas offcanvas-start canvas-filter canvas-categories" id="shopCategories">
        <div class="canvas-wrapper">
            <div class="canvas-header">
                <span class="icon-left icon-filter"></span>
                <h5>Categories</h5>
                <span class="icon-close icon-close-popup" data-bs-dismiss="offcanvas" aria-label="Close"></span>
            </div>
            <div class="canvas-body">
                 @foreach($parentCategories as $category)
    <div class="wd-facet-categories">
        @if($category->children->isNotEmpty())
            <!-- Category with children -->
            <div role="dialog" 
                 class="facet-title collapsed" 
                 data-bs-target="#cat-{{ $category->id }}" 
                 data-bs-toggle="collapse" 
                 aria-expanded="false" 
                 aria-controls="cat-{{ $category->id }}">
                 
                   <span class="title">{{ $category->title }}</span>
                <span class="icon icon-arrow-down"></span>
            </div>

            <div id="cat-{{ $category->id }}" class="collapse">
                <ul class="facet-body">
                    @foreach($category->children as $child)
                        <li>
                            <a href="{{ route('category.products', $child->slug) }}" class="item link">
                                
                                <span class="title-sub text-caption-1 text-secondary">{{ $child->title }}</span>
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
        @else
            <!-- Category without children -->
            <a href="{{ route('category.products', $category->slug) }}" class="facet-title no-children">
               
                <span class="title">{{ $category->title }}</span>
            </a>
        @endif
    </div>
@endforeach

                 
            </div>
        </div>
    </div> 
    <!-- /Categories -->