@extends('backend.layouts.master')

@section('main-content')

<div class="card">
    <h5 class="card-header">Add Product</h5>
    <div class="card-body">
      <form method="post" action="{{route('product.store')}}">
        {{csrf_field()}}
        <div class="form-group">
          <label for="inputTitle" class="col-form-label">Title <span class="text-danger">*</span></label>
          <input id="inputTitle" type="text" name="title" placeholder="Enter title"  value="{{old('title')}}" class="form-control">
          @error('title')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>

      <div class="form-group">
          <label for="is_featured">Is Featured</label><br>
          <input type="checkbox" name='is_featured' id='is_featured' value='1' checked> Yes                        
        </div>
              {{-- {{$categories}} --}}

        <div class="form-group">
          <label for="cat_id">Category <span class="text-danger">*</span></label>
          <select name="cat_id" id="cat_id" class="form-control">
              <option value="">--Select any category--</option>
              @foreach($categories as $key=>$cat_data)
                  <option value='{{$cat_data->id}}'>{{$cat_data->title}}</option>
              @endforeach
          </select>
        </div>

        <div class="form-group d-none" id="child_cat_div">
          <label for="child_cat_id">Sub Category</label>
          <select name="child_cat_id" id="child_cat_id" class="form-control">
              <option value="">--Select any category--</option>
              {{-- @foreach($parent_cats as $key=>$parent_cat)
                  <option value='{{$parent_cat->id}}'>{{$parent_cat->title}}</option>
              @endforeach --}}
          </select>
        </div>

<div class="form-group">
    <label>Select Brands</label>
    <div class="row">
        @foreach ($brands as $brand)
            <div class="col-md-3">
                <div class="form-check">
                    <input class="form-check-input"
                           type="checkbox"
                           name="brand_ids[]"
                           value="{{ $brand->id }}"
                           id="brand_{{ $brand->id }}">
                    <label class="form-check-label" for="brand_{{ $brand->id }}">
                        {{ $brand->title }}
                    </label>
                </div>
            </div>
        @endforeach
    </div>
</div>




<div class="form-check mb-3">
  <input type="checkbox" class="form-check-input" id="hasVariants" name="has_variants" value="1">
  <label class="form-check-label" for="hasVariants">This product has variants</label>
</div>

<div id="simpleProductFields" class="mb-4">
    <div class="col-md-3 mb-3">
        <label for="price">Price</label>
        <input type="number" step="0.01" name="price" class="form-control" placeholder="Enter price">
    </div>
    <div class="col-md-3 mb-3">
        <label for="discount">Discount (%)</label>
        <input type="number" step="0.01" name="discount" class="form-control" placeholder="Enter discount">
    </div>
    <div class="col-md-3 mb-3">
        <label for="stock">Stock</label>
        <input type="number" name="stock" class="form-control" placeholder="Enter stock quantity">
    </div>
    <div class="col-md-3 mb-3">
        <label for="sku">SKU</label>
        <input type="text" name="sku" class="form-control" placeholder="Enter SKU">
    </div>
</div>


{{-- Variant Section --}}
<div id="variantSection" class="d-none">
  <button type="button" class="btn btn-primary mb-3" id="addBrandVariant">+ Add Brand Variant</button>
  <div id="brand-variant-section"></div>
</div>




        
<div id="specifications_wrapper">
    <label>General Specifications</label>
    <div class="spec-row d-flex mb-2">
        <input type="text" name="specifications[0][name]" placeholder="Feature name" class="form-control me-2" />
        <input type="text" name="specifications[0][value]" placeholder="Feature value" class="form-control me-2" />
        <button type="button" class="btn btn-sm btn-danger remove-spec">x</button>
    </div>
</div>
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
        <div class="form-group mb-3">
          <button type="reset" class="btn btn-warning">Reset</button>
           <button class="btn btn-success" type="submit">Submit</button>
        </div>
      </form>
    </div>
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

 

let specIndex = 1;

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







    $('#lfm').filemanager('image');

    $(document).ready(function() {
      $('#summary').summernote({
        placeholder: "Write short description.....",
          tabsize: 2,
          height: 100
      });
    });

    $(document).ready(function() {
      $('#description').summernote({
        placeholder: "Write detail description.....",
          tabsize: 2,
          height: 150
      });
    });
    // $('select').selectpicker();

</script>
 <script>
    let variantIndex = 0;

    const brands = @json($brands);
    const attributes = @json($attributes);
    const specifications = [];

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