@extends('backend.layouts.master')

@section('main-content')
<div class="container">
    <h2>Edit Product</h2>

    <form action="{{ route('product.update', $product->id) }}" method="POST">
        @csrf
        @method('PUT')

        {{-- Product Title --}}
        <div class="mb-3">
            <label for="title" class="form-label">Product Title</label>
            <input type="text" name="title" class="form-control" value="{{ $product->title }}" required>
        </div>

        {{-- Category --}}
        <div class="mb-3">
            <label for="cat_id">Category</label>
            <select name="cat_id" id="cat_id" class="form-control" required>
                @foreach($categories as $cat)
                    <option value="{{ $cat->id }}" {{ $product->cat_id == $cat->id ? 'selected' : '' }}>
                        {{ $cat->title }}
                    </option>
                @endforeach
            </select>
        </div>

        {{-- Subcategory --}}
        <div class="mb-3 {{ $product->child_cat_id ? '' : 'd-none' }}" id="child_cat_div">
            <label for="child_cat_id">Sub Category</label>
            <select name="child_cat_id" id="child_cat_id" class="form-control">
                <option value="">--Select Sub Category--</option>
                @foreach($subcategories as $sub)
                    <option value="{{ $sub->id }}" {{ $product->child_cat_id == $sub->id ? 'selected' : '' }}>
                        {{ $sub->title }}
                    </option>
                @endforeach
            </select>
        </div>

        {{-- Status --}}
        <div class="mb-3">
            <label>Status</label>
            <select name="status" class="form-control">
                <option value="active" {{ $product->status == 'active' ? 'selected' : '' }}>Active</option>
                <option value="inactive" {{ $product->status == 'inactive' ? 'selected' : '' }}>Inactive</option>
            </select>
        </div>

        {{-- Variant Toggle --}}
        <div class="mb-3">
            <label><input type="checkbox" id="hasVariants" name="has_variants" {{ $product->has_variants ? 'checked' : '' }}> Has Variants?</label>
        </div>

        {{-- Brand + Attribute Group Container --}}
        <div id="brand-variant-section" class="{{ $product->has_variants ? '' : 'd-none' }}">
            @foreach ($product->variants->groupBy('brand_id') as $brandId => $brandVariants)
                <div class="border rounded p-3 mb-3 brand-variant-group">
                    <div class="d-flex justify-content-between">
                        <label>Brand</label>
                        <button type="button" class="btn btn-danger btn-sm remove-brand">×</button>
                    </div>
                    <select name="brands[]" class="form-control mb-2 brand-select">
                        <option value="">Select Brand</option>
                        @foreach($brands as $brand)
                            <option value="{{ $brand->id }}" {{ $brandId == $brand->id ? 'selected' : '' }}>
                                {{ $brand->title }}
                            </option>
                        @endforeach
                    </select>

                    <div class="attribute-section">
    @foreach ($brandVariants as $variantIndex => $variant)
        @foreach ($variant->attributeValues as $valueObj)
            <div class="d-flex align-items-center mb-2">
                {{-- Attribute dropdown --}}
                <select class="form-control me-2" name="brand_variants[{{ $brandId }}][{{ $variantIndex }}][attributes][attribute_id][]" required>
                    <option value="">Select Attribute</option>
                    @foreach ($attributes as $attribute)
                        <option value="{{ $attribute->id }}"
                            @if ($attribute->id == $valueObj->pivot->attribute_id) selected @endif>
                            {{ $attribute->name }}
                        </option>
                    @endforeach
                </select>

                {{-- Value dropdown --}}
                <select class="form-control me-2" name="brand_variants[{{ $brandId }}][{{ $variantIndex }}][attributes][attribute_value_id][]" required>
                    <option value="">Select Value</option>
                    @foreach ($attributes->where('id', $valueObj->pivot->attribute_id)->first()?->values ?? [] as $val)
                        <option value="{{ $val->id }}"
                            @if ($val->id == $valueObj->id) selected @endif>
                            {{ $val->value }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="specification-section mb-3">
        <h5>Specifications for Variant {{ $variantIndex + 1 }}</h5>

        @foreach ($variant->specifications as $specIndex => $spec)
            <div class="d-flex align-items-center mb-2">
                <input type="text" name="brand_variants[{{ $brandId }}][{{ $variantIndex }}][specifications][{{ $specIndex }}][spec_name]" 
                       class="form-control me-2" placeholder="Specification Name" value="{{ $spec->spec_name }}" required>

                <input type="text" name="brand_variants[{{ $brandId }}][{{ $variantIndex }}][specifications][{{ $specIndex }}][spec_value]" 
                       class="form-control" placeholder="Specification Value" value="{{ $spec->spec_value }}" required>
            </div>
        @endforeach

        {{-- Optional: Add button to dynamically add more specification fields via JS --}}
    </div>


        @endforeach
    @endforeach
</div>

                    {{-- Variant rows --}}
                    <div class="mt-3">
                        <table class="table table-bordered variant-table">
                            <thead>
                                <tr>
                                    <th>Variant</th>
                                    <th>SKU</th>
                                    <th>Price</th>
                                    <th>Stock</th>
                                    <th>Discount</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($brandVariants as $variant)
                                    <tr>
                                        <td>
                                            {{ implode(' / ', $variant->attributeValues->pluck('value')->toArray()) }}
                                         <input type="hidden" name="variant_keys[{{ $brandId }}][]" value="{{ implode(',', $variant->attributeValues->pluck('title')->toArray()) }}">

                                        
                                        </td>
                                        <td><input type="text" name="variant_data[{{ $brandId }}][sku][]" class="form-control" value="{{ $variant->sku }}"></td>
                                        <td><input type="number" name="variant_data[{{ $brandId }}][price][]" class="form-control" value="{{ $variant->price }}"></td>
                                        <td><input type="number" name="variant_data[{{ $brandId }}][stock][]" class="form-control" value="{{ $variant->stock }}"></td>
                                        <td><input type="number" name="variant_data[{{ $brandId }}][discount][]" class="form-control" value="{{ $variant->discount }}"></td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @endforeach
        </div>

        {{-- Button to Add New Brand --}}
        <button type="button" id="addBrandVariant" class="btn btn-secondary mb-3 d">+ Add Brand Variant</button>

        {{-- Non-variant input --}}
        <div id="nonVariantFields" class="{{ $product->has_variants ? 'd-none' : '' }}">
            <div class="mb-2">
                <label>Price</label>
                <input type="number" name="price" class="form-control" value="{{ $product->price }}">
            </div>
            <div class="mb-2">
                <label>Stock</label>
                <input type="number" name="stock" class="form-control" value="{{ $product->stock }}">
            </div>
        </div>

        <div id="specifications_wrapper">
    <label>General Specifications</label>
        @foreach($product->specifications as $i => $spec)
<div class="spec-row d-flex mb-2">
    <input type="text" name="specifications[{{ $i }}][name]" value="{{ $spec->name }}" class="form-control me-2" />
    <input type="text" name="specifications[{{ $i }}][value]" value="{{ $spec->value }}" class="form-control me-2" />
    <button type="button" class="btn btn-sm btn-danger remove-spec">x</button>
</div>
@endforeach</div>
<button type="button" id="add-specification" class="btn btn-sm btn-secondary mt-2">+ Add General Specification</button>

 <div class="form-group">
          <label for="status" class="col-form-label">Status <span class="text-danger">*</span></label>
          <select name="status" class="form-control">
              <option value="active">Active</option>
              <option value="inactive">Inactive</option>
          </select>
          @error('status')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>

        <button type="submit" class="btn btn-primary">Update Product</button>
    </form>
</div>
@endsection

@push('styles')
<link rel="stylesheet" href="{{asset('backend/summernote/summernote.min.css')}}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.css" />
@endpush
@push('scripts')
<script src="/vendor/laravel-filemanager/js/stand-alone-button.js"></script>
<script src="{{asset('backend/summernote/summernote.min.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script>

<script>
    let variantIndex = {{ count($product->variants) }};
    let specIndex = {{ count($product->specifications) }};
    const brands = @json($brands);
    const attributes = @json($attributes);
    const specifications = @json($product->specifications);


    document.getElementById('add-specification').addEventListener('click', function () {
    const wrapper = document.getElementById('specifications_wrapper');
    const row = 
        `<div class="spec-row d-flex mb-2">
            <input type="text" name="specifications[${specIndex}][name]" placeholder="Feature name" class="form-control me-2" />
            <input type="text" name="specifications[${specIndex}][value]" placeholder="Feature value" class="form-control me-2" />
            <button type="button" class="btn btn-sm btn-danger remove-spec">x</button>
        </div>`;
    wrapper.insertAdjacentHTML('beforeend', row);
    specIndex++;
});

document.addEventListener('click', function (e) {
    if (e.target.classList.contains('remove-spec')) {
        e.target.closest('.spec-row').remove();
    }
});

    function renderAttributeSelector(index, variantIndex) {
        return `
        <div class="d-flex align-items-center mb-2 attr-row-${variantIndex}">
            <select name="brand_variants[${variantIndex}][attributes][${index}][attribute_id]" class="form-control me-2" required>
                <option value="">Select Attribute</option>
                ${attributes.map(attr => `<option value="${attr.id}">${attr.name}</option>`).join('')}
            </select>
            <input type="text" class="form-control me-2" name="brand_variants[${variantIndex}][attributes][${index}][value]" placeholder="Value" required>
            <button type="button" class="btn btn-sm btn-danger remove-attr" data-index="${variantIndex}">X</button>
        </div>`;
    }

    function renderSpecification(index, variantIndex) {
    return `
    <div class="d-flex align-items-center mb-2 spec-row-${variantIndex}">
        <input type="text" class="form-control me-2" name="brand_variants[${variantIndex}][specifications][${index}][name]" placeholder="Specification Name" required>
        <input type="text" class="form-control me-2" name="brand_variants[${variantIndex}][specifications][${index}][value]" placeholder="Value" required>
        <button type="button" class="btn btn-sm btn-danger remove-spec" data-index="${variantIndex}">X</button>
    </div>`;
}

    function renderAttributeBlock(variantIndex, attrIndex = 0) {
    return `
    <div class="attribute-row d-flex mb-2">
        <select name="brand_variants[${variantIndex}][attributes][${attrIndex}][attribute_id]" class="form-control me-2 attribute-select">
            <option value="">-- Select Attribute --</option>
            ${attributes.map(attr => `<option value="${attr.id}">${attr.name}</option>`).join('')}
        </select>

        <select name="brand_variants[${variantIndex}][attributes][${attrIndex}][value_id]" class="form-control me-2 value-select">
            <option value="">-- Select Value --</option>
        </select>

        <button type="button" class="btn btn-sm btn-danger remove-attr">x</button>
    </div>`;
}


    function renderBrandVariantBlock(index) {
        return `
        <div class="variant-block border p-3 mb-4" data-variant-index="${index}">
            <div class="d-flex justify-content-between align-items-center mb-2">
                <strong>Brand Variant ${index + 1}</strong>
                <button type="button" class="btn btn-danger btn-sm remove-variant">X</button>
            </div>

            <!-- Brand -->
            <div class="form-group mb-3">
                <label>Brand</label>
                <select name="brand_variants[${index}][brand_id]" class="form-control" required>
                    <option value="">Choose Brand</option>
                    ${brands.map(b => `<option value="${b.id}">${b.title}</option>`).join('')}
                </select>
            </div>

            <!-- Attributes -->
            <h6 class="mb-1">Attributes</h6>
            <div class="attribute-area-${index}"></div>
            <button type="button" class="btn btn-sm btn-outline-info add-attribute" data-index="${index}">
                + Add Attribute
            </button>

            <!-- Specifications -->
            <h6 class="mt-3 mb-1">Specifications</h6>
            <div class="spec-area-${index}"></div>
            <button type="button" class="btn btn-sm btn-outline-secondary add-variant-spec" data-index="${index}">
                + Add Spec
            </button>

            <!-- Price / Stock -->
            <div class="price-stock-area mt-3 d-none" id="price-stock-${index}">
                <div class="row">
                    <div class="col-md-3">
                        <label>Price</label>
                        <input type="number" class="form-control" name="brand_variants[${index}][price]">
                    </div>
                    <div class="col-md-3">
                        <label>Discount</label>
                        <input type="number" class="form-control" name="brand_variants[${index}][discount]">
                    </div>
                    <div class="col-md-3">
                        <label>Stock</label>
                        <input type="number" class="form-control" name="brand_variants[${index}][stock]">
                    </div>
                    <div class="col-md-3">
                        <label>SKU</label>
                        <input type="text" class="form-control" name="brand_variants[${index}][sku]">
                    </div>
                </div>
            </div>
        </div>`;
    }

   
    document.addEventListener('DOMContentLoaded', function () {
    const addBtn = document.getElementById('addBrandVariant');
    if (addBtn) {
        addBtn.addEventListener('click', function () {
            const container = document.getElementById('brand-variant-section');
            container.insertAdjacentHTML('beforeend', renderBrandVariantBlock(variantIndex));
            variantIndex++;
        });
    }
});

    document.addEventListener('click', function (e) {
        // Add attribute
        

         if (e.target.classList.contains('add-attribute')) {
        const index = e.target.dataset.index;
        const container = document.querySelector(`.attribute-area-${index}`);
        const count = container.querySelectorAll('.attribute-row').length;

        container.insertAdjacentHTML('beforeend', renderAttributeBlock(index, count));

         // Show price-stock block
            const priceStock = document.getElementById(`price-stock-${index}`);
            if (priceStock && priceStock.classList.contains('d-none')) {
                priceStock.classList.remove('d-none');
            }
    }

    document.addEventListener('change', function (e) {
    if (e.target.classList.contains('attribute-select')) {
        const attrId = parseInt(e.target.value);
        const selectedAttr = attributes.find(attr => attr.id === attrId);

        if (!selectedAttr) return;

        const valueSelect = e.target.closest('.attribute-row')?.querySelector('.value-select');
        if (!valueSelect) return;

        valueSelect.innerHTML = `<option value="">-- Select Value --</option>`;
        selectedAttr.values.forEach(value => {
            const option = document.createElement('option');
            option.value = value.id;
            option.textContent = value.value;
            valueSelect.appendChild(option);
        });
    }
});

        // Remove attribute
        if (e.target.classList.contains('remove-attr')) {
            const vIdx = e.target.dataset.index;
            e.target.closest(`.attr-row-${vIdx}`).remove();

            const attrArea = document.querySelector(`.attribute-area-${vIdx}`);
            const remaining = attrArea.querySelectorAll(`.attr-row-${vIdx}`).length;
            const priceStock = document.getElementById(`price-stock-${vIdx}`);
            if (remaining === 0 && priceStock) {
                priceStock.classList.add('d-none');
            }
        }

        // Add spec
        if (e.target.classList.contains('add-variant-spec')) {
            const vIdx = e.target.dataset.index;
            const specArea = document.querySelector(`.spec-area-${vIdx}`);
            const specCount = specArea.querySelectorAll(`.spec-row-${vIdx}`).length;
            specArea.insertAdjacentHTML('beforeend', renderSpecification(specCount, vIdx));
        }

        // Remove spec
        if (e.target.classList.contains('remove-spec')) {
            const vIdx = e.target.dataset.index;
            e.target.closest(`.spec-row-${vIdx}`).remove();
        }

        // Remove entire variant block
        if (e.target.classList.contains('remove-variant')) {
            e.target.closest('.variant-block').remove();
        }
    });
 
</script>
 <script>
document.addEventListener('DOMContentLoaded', function () {
    const hasVariantsCheckbox = document.getElementById('hasVariants');
    const variantSection = document.getElementById('variantSection');
    const simpleFields = document.getElementById('simpleProductFields');

    hasVariantsCheckbox.addEventListener('change', function () {
        if (this.checked) {
            variantSection.classList.remove('d-none');
            simpleFields.classList.add('d-none');
        } else {
            variantSection.classList.add('d-none');
            simpleFields.classList.remove('d-none');
        }
    });

    // existing brand/specification logic goes here...
});
</script>
<script>
  $('#cat_id').change(function(){
    var cat_id=$(this).val();
    // alert(cat_id);
    if(cat_id !=null){
      // Ajax call
      $.ajax({
        url:"/admin/category/"+cat_id+"/child",
        data:{
          _token:"{{csrf_token()}}",
          id:cat_id
        },
        type:"POST",
        success:function(response){
          if(typeof(response) !='object'){
            response=$.parseJSON(response)
          }
          // console.log(response);
          var html_option="<option value=''>----Select sub category----</option>"
          if(response.status){
            var data=response.data;
            // alert(data);
            if(response.data){
              $('#child_cat_div').removeClass('d-none');
              $.each(data,function(id,title){
                html_option +="<option value='"+id+"'>"+title+"</option>"
              });
            }
            else{
            }
          }
          else{
            $('#child_cat_div').addClass('d-none');
          }
          $('#child_cat_id').html(html_option);
        }
      });
    }
    else{
    }
  })
</script>


@endpush
 
