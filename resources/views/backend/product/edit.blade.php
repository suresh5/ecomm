@extends('backend.layouts.master')

@section('main-content')

<div class="card">
    <h5 class="card-header">Edit Product</h5>
    <div class="card-body">
      <form method="post" action="{{ route('product.update', $product->id) }}">
        @csrf
        @method('PUT')

        {{-- Title --}}
        <div class="form-group">
          <label for="inputTitle" class="col-form-label">Title <span class="text-danger">*</span></label>
          <input id="inputTitle" type="text" name="title" placeholder="Enter title"  
                 value="{{ old('title', $product->title) }}" class="form-control">
          @error('title')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>

        {{-- Is Featured --}}
        <div class="form-group">
          <label for="is_featured">Is Featured</label><br>
          <input type="checkbox" name="is_featured" id="is_featured" value="1" 
                 {{ old('is_featured', $product->is_featured) ? 'checked' : '' }}> Yes
        </div>

        {{-- Category --}}
        <div class="form-group">
          <label for="cat_id">Category <span class="text-danger">*</span></label>
          <select name="cat_id" id="cat_id" class="form-control">
              <option value="">--Select any category--</option>
              @foreach($categories as $cat_data)
                  <option value="{{ $cat_data->id }}" 
                    {{ old('cat_id', $product->cat_id) == $cat_data->id ? 'selected' : '' }}>
                    {{ $cat_data->title }}
                  </option>
              @endforeach
          </select>
        </div>

        {{-- Sub Category --}}
        <div class="form-group {{ $product->child_cat_id ? '' : 'd-none' }}" id="child_cat_div">
          <label for="child_cat_id">Sub Category</label>
          <select name="child_cat_id" id="child_cat_id" class="form-control">
              <option value="">--Select any category--</option>
              @if($subcategories ?? false)
                @foreach($subcategories as $child_cat)
                  <option value="{{ $child_cat->id }}" 
                    {{ old('child_cat_id', $product->child_cat_id) == $child_cat->id ? 'selected' : '' }}>
                    {{ $child_cat->title }}
                  </option>
                @endforeach
              @endif
          </select>
        </div>

        {{-- Brands --}}
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
                                   id="brand_{{ $brand->id }}"
                                   {{ in_array($brand->id, old('brand_ids', $product->brands->pluck('id')->toArray())) ? 'checked' : '' }}>
                            <label class="form-check-label" for="brand_{{ $brand->id }}">
                                {{ $brand->title }}
                            </label>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        {{-- Has Variants Toggle --}}
        <div class="form-check mb-3">
          <input type="checkbox" class="form-check-input" id="hasVariants" name="has_variants" value="1"
                 {{ old('has_variants', $product->has_variants) ? 'checked' : '' }}>
          <label class="form-check-label" for="hasVariants">This product has variants</label>
        </div>

        {{-- Simple Product Fields --}}
        <div id="simpleProductFields" class="mb-4 {{ old('has_variants', $product->has_variants) ? 'd-none' : '' }}">
            <div class="col-md-3 mb-3">
                <label for="price">Price</label>
                <input type="number" step="0.01" name="price" class="form-control" 
                       value="{{ old('price', $product->price) }}" placeholder="Enter price">
            </div>
            <div class="col-md-3 mb-3">
                <label for="discount">Discount (%)</label>
                <input type="number" step="0.01" name="discount" class="form-control"
                       value="{{ old('discount', $product->discount) }}" placeholder="Enter discount">
            </div>
            <div class="col-md-3 mb-3">
                <label for="stock">Stock</label>
                <input type="number" name="stock" class="form-control" 
                       value="{{ old('stock', $product->stock) }}" placeholder="Enter stock quantity">
            </div>
            <div class="col-md-3 mb-3">
                <label for="sku">SKU</label>
                <input type="text" name="sku" class="form-control" 
                       value="{{ old('sku', $product->sku) }}" placeholder="Enter SKU">
            </div>
        </div>

       {{-- Brand + Attribute Group Container --}}
<div id="brand-variant-section" class="{{ $product->has_variants ? '' : 'd-none' }}">
    @foreach ($product->variants->groupBy('brand_id') as $brandId => $brandVariants)
        <div class="border rounded p-3 mb-3 brand-variant-group">
            <div class="d-flex justify-content-between">
                <label>Brand</label>
                <button type="button" class="btn btn-danger btn-sm remove-brand">×</button>
            </div>

            {{-- Brand Select --}}
            <select name="brands[]" class="form-control mb-2 brand-select">
                <option value="">Select Brand</option>
                @foreach ($brands as $brand)
                    <option value="{{ $brand->id }}" {{ $brandId == $brand->id ? 'selected' : '' }}>
                        {{ $brand->title }}
                    </option>
                @endforeach
            </select>

            <div class="attribute-section">
                @foreach ($brandVariants as $variantIndex => $variant)
                    
                    {{-- Attributes --}}
                    <div class="mb-3">
                        <h6>Attributes for Variant {{ $variantIndex + 1 }}</h6>
                        @foreach ($variant->attributeValues as $valueObj)
                            <div class="d-flex attribute-row align-items-center mb-2">
                                {{-- Attribute dropdown --}}
                                <select class="form-control me-2"
                                    name="brand_variants[{{ $brandId }}][{{ $variantIndex }}][attributes][attribute_id][]"
                                    required>
                                    <option value="">Select Attribute</option>
                                    @foreach ($attributes as $attribute)
                                        <option value="{{ $attribute->id }}"
                                            @if ($attribute->id == $valueObj->pivot->attribute_id) selected @endif>
                                            {{ $attribute->name }}
                                        </option>
                                    @endforeach
                                </select>

                                {{-- Value dropdown --}}
                                <select class="form-control me-2"
                                    name="brand_variants[{{ $brandId }}][{{ $variantIndex }}][attributes][attribute_value_id][]"
                                    required>
                                    <option value="">Select Value</option>
                                    @foreach ($attributes->where('id', $valueObj->pivot->attribute_id)->first()?->values ?? [] as $val)
                                        <option value="{{ $val->id }}"
                                            @if ($val->id == $valueObj->id) selected @endif>
                                            {{ $val->value }}
                                        </option>
                                    @endforeach
                                </select>
                                <button type="button" class="btn btn-danger btn-sm remove-attribute">×</button>
                            </div>
                        @endforeach

                        {{-- Add Attribute Button --}}
                        <button type="button" class="btn btn-sm btn-outline-info add-attribute" 
                            data-brand="{{ $brandId }}" data-variant="{{ $variantIndex }}">
                            + Add Attribute
                        </button>
                    </div>

                    {{-- Specifications --}}
                    <div class="specification-section mb-3">
                        <h6>Specifications for Variant {{ $variantIndex + 1 }}</h6>
                        @foreach ($variant->specifications as $specIndex => $spec)
                            <div class="d-flex align-items-center mb-2 spec-row">
                                <input type="text"
                                    name="brand_variants[{{ $brandId }}][{{ $variantIndex }}][specifications][{{ $specIndex }}][spec_name]"
                                    class="form-control me-2" placeholder="Specification Name"
                                    value="{{ $spec->spec_name }}" required>

                                <input type="text"
                                    name="brand_variants[{{ $brandId }}][{{ $variantIndex }}][specifications][{{ $specIndex }}][spec_value]"
                                    class="form-control" placeholder="Specification Value"
                                    value="{{ $spec->spec_value }}" required>
                                <button type="button" class="btn btn-danger btn-sm remove-spec">×</button>
                            </div>
                        @endforeach

                        {{-- Add Spec Button --}}
                        <button type="button" class="btn btn-sm btn-outline-secondary add-variant-spec" 
                            data-brand="{{ $brandId }}" data-variant="{{ $variantIndex }}">
                            + Add Spec
                        </button>
                    </div>

                    {{-- Pricing / Stock --}}
                    <div class="mb-3 border p-2 rounded">
                        <h6>Pricing for Variant {{ $variantIndex + 1 }}</h6>
                        <div class="row g-2">
                            <div class="col">
                                 <label for="sku_{{ $brandId }}_{{ $loop->index }}" class="form-label">SKU</label>
                                <input type="text" name="brand_variants[{{ $brandId }}][{{ $variantIndex }}][sku]" 
                                       class="form-control" placeholder="SKU" value="{{ $variant->sku }}">
                            </div>
                            <div class="col">
                                 <label for="price_{{ $brandId }}_{{ $loop->index }}" class="form-label">Price</label>
                                <input type="number" name="brand_variants[{{ $brandId }}][{{ $variantIndex }}][price]" 
                                       class="form-control" placeholder="Price" value="{{ $variant->price }}">
                            </div>
                            <div class="col">
                                 <label for="stock_{{ $brandId }}_{{ $loop->index }}" class="form-label">STOCK</label>
                                <input type="number" name="brand_variants[{{ $brandId }}][{{ $variantIndex }}][stock]" 
                                       class="form-control" placeholder="Stock" value="{{ $variant->stock }}">
                            </div>
                            <div class="col">
                                 <label for="discount_{{ $brandId }}_{{ $loop->index }}" class="form-label">Discount</label>
                                <input type="number" name="brand_variants[{{ $brandId }}][{{ $variantIndex }}][discount]" 
                                       class="form-control" placeholder="Discount" value="{{ $variant->discount }}">
                            </div>
                        </div>
                    </div>

                @endforeach
            </div>
        </div>
    @endforeach
</div>


{{-- Button to Add New Brand --}}
<button type="button" id="addBrandVariant" class="btn btn-secondary mb-3">+ Add Brand Variant</button>

         {{-- Specification Groups --}}
<div id="spec-groups-wrapper">
    @php
        $groupIndex = 0;
        $specIndexes = [];
    @endphp

    @foreach($prospecifications as $label => $specGroup)
        <div class="spec-group border p-3 mb-3" data-group-index="{{ $groupIndex }}">
            <div class="d-flex justify-content-between align-items-center mb-2">
                <div>
                    <label>Group Label</label>
                    <input type="text" name="spec_groups[{{ $groupIndex }}][label]" value="{{ $label }}"
                           placeholder="Enter group label" class="form-control form-control-sm" required>
                </div>
                <button type="button" class="btn btn-danger btn-sm remove-group">Remove Group</button>
            </div>

            <div class="spec-list" id="spec-list-{{ $groupIndex }}">
                @php $specIndex = 0; @endphp
                @foreach($specGroup as $spec)
                    <div class="d-flex mb-2 spec-row">
                        <input type="text"
                               name="spec_groups[{{ $groupIndex }}][specifications][{{ $specIndex }}][name]"
                               value="{{ $spec->name }}" placeholder="Feature name"
                               class="form-control me-2" required>

                        <input type="text"
                               name="spec_groups[{{ $groupIndex }}][specifications][{{ $specIndex }}][value]"
                               value="{{ $spec->value }}" placeholder="Feature value"
                               class="form-control me-2" required>

                        <button type="button" class="btn btn-sm btn-danger remove-spec">x</button>
                    </div>
                    @php $specIndex++; @endphp
                @endforeach
                @php $specIndexes[$groupIndex] = $specIndex; @endphp
            </div>

            <button type="button" class="btn btn-sm btn-secondary add-spec" data-group="{{ $groupIndex }}">
                + Add Specification
            </button>
        </div>
        @php $groupIndex++; @endphp
    @endforeach
</div>

<button type="button" class="btn btn-primary" id="add-spec-group">+ Add Specification Group</button>

    {{-- Status --}}
        <div class="form-group">
          <label for="status" class="col-form-label">Status <span class="text-danger">*</span></label>
          <select name="status" class="form-control">
              <option value="active" {{ old('status', $product->status) == 'active' ? 'selected' : '' }}>Active</option>
              <option value="inactive" {{ old('status', $product->status) == 'inactive' ? 'selected' : '' }}>Inactive</option>
          </select>
          @error('status')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>

        {{-- Buttons --}}
        <div class="form-group mb-3">
          <button type="reset" class="btn btn-warning">Reset</button>
          <button class="btn btn-success" type="submit">Update</button>
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
    <script src="{{ asset('backend/summernote/summernote.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script>

  <script>
        $('#cat_id').change(function() {
            var cat_id = $(this).val();
            // alert(cat_id);
            if (cat_id != null) {
                // Ajax call
                $.ajax({
                    url: "/admin/category/" + cat_id + "/child",
                    data: {
                        _token: "{{ csrf_token() }}",
                        id: cat_id
                    },
                    type: "POST",
                    success: function(response) {
                        if (typeof(response) != 'object') {
                            response = $.parseJSON(response)
                        }
                        // console.log(response);
                        var html_option = "<option value=''>----Select sub category----</option>"
                        if (response.status) {
                            var data = response.data;
                            // alert(data);
                            if (response.data) {
                                $('#child_cat_div').removeClass('d-none');
                                $.each(data, function(id, title) {
                                    html_option += "<option value='" + id + "'>" + title +
                                        "</option>"
                                });
                            } else {}
                        } else {
                            $('#child_cat_div').addClass('d-none');
                        }
                        $('#child_cat_id').html(html_option);
                    }
                });
            } else {}
        })
    </script>

<script>
    let groupIndex = {{ $groupIndex }};
    const specIndexes = @json($specIndexes);

    function renderSpecGroup(index, label = '') {
        return `
        <div class="spec-group border p-3 mb-3" data-group-index="${index}">
            <div class="d-flex justify-content-between align-items-center mb-2">
                <div>
                    <label>Group Label</label>
                    <input type="text" name="spec_groups[${index}][label]" value="${label}" placeholder="Enter group label" class="form-control form-control-sm" required>
                </div>
                <button type="button" class="btn btn-danger btn-sm remove-group">Remove Group</button>
            </div>

            <div class="spec-list" id="spec-list-${index}">
                ${renderSpecRow(index, 0)}
            </div>

            <button type="button" class="btn btn-sm btn-secondary add-spec" data-group="${index}">
                + Add Specification
            </button>
        </div>
    `;
    }

    function renderSpecRow(groupIndex, specIndex) {
        return `
        <div class="d-flex mb-2 spec-row">
            <input type="text" name="spec_groups[${groupIndex}][specifications][${specIndex}][name]" placeholder="Feature name" class="form-control me-2" required>
            <input type="text" name="spec_groups[${groupIndex}][specifications][${specIndex}][value]" placeholder="Feature value" class="form-control me-2" required>
            <button type="button" class="btn btn-sm btn-danger remove-spec">x</button>
        </div>
    `;
    }

    // Add new group
    document.getElementById('add-spec-group').addEventListener('click', function() {
        const wrapper = document.getElementById('spec-groups-wrapper');
        wrapper.insertAdjacentHTML('beforeend', renderSpecGroup(groupIndex));
        specIndexes[groupIndex] = 1;
        groupIndex++;
    });

    // Handle dynamic events
    document.addEventListener('click', function(e) {
        if (e.target.classList.contains('add-spec')) {
            const gIndex = e.target.dataset.group;
            const specList = document.getElementById(`spec-list-${gIndex}`);
            specList.insertAdjacentHTML('beforeend', renderSpecRow(gIndex, specIndexes[gIndex]++));
        }
        if (e.target.classList.contains('remove-spec')) {
            e.target.closest('.spec-row').remove();
        }
        if (e.target.classList.contains('remove-group')) {
            e.target.closest('.spec-group').remove();
        }
    });
</script>

    <script>
document.addEventListener('DOMContentLoaded', function() {
    let brandIndex = {{ $product->variants->groupBy('brand_id')->count() }}; 

    // Add New Brand Variant Group
    document.getElementById('addBrandVariant').addEventListener('click', function() {
        const section = document.getElementById('brand-variant-section');
        const template = `
        <div class="border rounded p-3 mb-3 brand-variant-group">
            <div class="d-flex justify-content-between">
                <label>Brand</label>
                <button type="button" class="btn btn-danger btn-sm remove-brand">×</button>
            </div>
            <select name="brands[]" class="form-control mb-2 brand-select">
                <option value="">Select Brand</option>
                @foreach ($brands as $brand)
                    <option value="{{ $brand->id }}">{{ $brand->title }}</option>
                @endforeach
            </select>
            <div class="attribute-section">
                <div class="mb-3">
                    <h6>Attributes for Variant 1</h6>
                    <div class="d-flex attribute-row align-items-center mb-2">
                        <select class="form-control me-2"
                            name="brand_variants[new${brandIndex}][0][attributes][attribute_id][]" required>
                            <option value="">Select Attribute</option>
                            @foreach ($attributes as $attribute)
                                <option value="{{ $attribute->id }}">{{ $attribute->name }}</option>
                            @endforeach
                        </select>
                        <select class="form-control me-2"
                            name="brand_variants[new${brandIndex}][0][attributes][attribute_value_id][]" required>
                            <option value="">Select Value</option>
                        </select>
                        <button type="button" class="btn btn-danger btn-sm remove-attribute">×</button>
                    </div>
                    <button type="button" class="btn btn-sm btn-outline-info add-attribute" 
                        data-brand="new${brandIndex}" data-variant="0">
                        + Add Attribute
                    </button>
                </div>

                <div class="specification-section mb-3">
                    <h6>Specifications for Variant 1</h6>
                    <div class="d-flex align-items-center mb-2 spec-row">
                        <input type="text"
                            name="brand_variants[new${brandIndex}][0][specifications][0][spec_name]"
                            class="form-control me-2" placeholder="Specification Name" required>
                        <input type="text"
                            name="brand_variants[new${brandIndex}][0][specifications][0][spec_value]"
                            class="form-control" placeholder="Specification Value" required>
                        <button type="button" class="btn btn-danger btn-sm remove-spec">×</button>
                    </div>
                    <button type="button" class="btn btn-sm btn-outline-secondary add-variant-spec" 
                        data-brand="new${brandIndex}" data-variant="0">
                        + Add Spec
                    </button>
                </div>
            </div>
        </div>
        `;
        section.insertAdjacentHTML('beforeend', template);
        brandIndex++;
    });

    // Handle Remove Brand
    document.addEventListener('click', function(e) {
        if (e.target.classList.contains('remove-brand')) {
            e.target.closest('.brand-variant-group').remove();
        }
    });

     

    // Add Specification Row
    document.addEventListener('click', function(e) {
        if (e.target.classList.contains('add-variant-spec')) {
            const brandId = e.target.dataset.brand;
            const variantIndex = e.target.dataset.variant;
            const container = e.target.closest('.specification-section');
            const specCount = container.querySelectorAll('.spec-row').length;
            const row = `
            <div class="d-flex align-items-center mb-2 spec-row">
                <input type="text"
                    name="brand_variants[${brandId}][${variantIndex}][specifications][${specCount}][spec_name]"
                    class="form-control me-2" placeholder="Specification Name" required>
                <input type="text"
                    name="brand_variants[${brandId}][${variantIndex}][specifications][${specCount}][spec_value]"
                    class="form-control" placeholder="Specification Value" required>
                <button type="button" class="btn btn-danger btn-sm remove-spec">×</button>
            </div>
            `;
            e.target.insertAdjacentHTML('beforebegin', row);
        }
    });

    // Remove Specification Row
    document.addEventListener('click', function(e) {
        if (e.target.classList.contains('remove-spec')) {
            e.target.closest('.spec-row').remove();
        }
    });
});
</script>
<script>
    // Store attribute values in JS (from Laravel blade)
    const attributeValues = @json(
        $attributes->mapWithKeys(function($attr) {
            return [
                $attr->id => $attr->values->map(fn($val) => [
                    'id' => $val->id,
                    'name' => $val->value
                ])
            ];
        })
    );

    // Add Attribute Row
    document.addEventListener('click', function(e) {
        if (e.target.classList.contains('add-attribute')) {
            const brandId = e.target.dataset.brand;
            const variantIndex = e.target.dataset.variant;
            const container = e.target.closest('.mb-3');

            const row = `
            <div class="d-flex attribute-row align-items-center mb-2">
                <select class="form-control me-2 attribute-select"
                    name="brand_variants[${brandId}][${variantIndex}][attributes][attribute_id][]" required>
                    <option value="">Select Attribute</option>
                    @foreach ($attributes as $attribute)
                        <option value="{{ $attribute->id }}">{{ $attribute->name }}</option>
                    @endforeach
                </select>
                <select class="form-control me-2 value-select"
                    name="brand_variants[${brandId}][${variantIndex}][attributes][attribute_value_id][]" required>
                    <option value="">Select Value</option>
                </select>
                <button type="button" class="btn btn-danger btn-sm remove-attribute">×</button>
            </div>
            `;

            e.target.insertAdjacentHTML('beforebegin', row);
        }
    });

    // Remove Attribute Row
    document.addEventListener('click', function(e) {
        if (e.target.classList.contains('remove-attribute')) {
            e.target.closest('.attribute-row').remove();
        }
    });

    // Load Attribute Values when Attribute changes
    document.addEventListener('change', function(e) {
        if (e.target.classList.contains('attribute-select')) {
            const selectedAttrId = e.target.value;
            const valueSelect = e.target.closest('.attribute-row').querySelector('.value-select');

            // Reset value dropdown
            valueSelect.innerHTML = '<option value="">Select Value</option>';

            if (selectedAttrId && attributeValues[selectedAttrId]) {
                attributeValues[selectedAttrId].forEach(val => {
                    const opt = document.createElement('option');
                    opt.value = val.id;
                    opt.textContent = val.name;
                    valueSelect.appendChild(opt);
                });
            }
        }
    });
</script>

@endpush

