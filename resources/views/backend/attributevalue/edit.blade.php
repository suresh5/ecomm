@extends('backend.layouts.master')
@section('title','E-SHOP || Edit Attribute Value')
@section('main-content')

<div class="card">
    <h5 class="card-header">Edit Attribute Value</h5>
    <div class="card-body">
        <form method="post" action="{{ route('attribute-values.update', $attributeValue->id) }}">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="attribute_id">Select Attribute <span class="text-danger">*</span></label>
                <select name="attribute_id" class="form-control" required>
                    <option value="">--Choose Attribute--</option>
                    @foreach($attributes as $attribute)
                        <option value="{{ $attribute->id }}" {{ $attribute->id == $attributeValue->attribute_id ? 'selected' : '' }}>
                            {{ $attribute->name }}
                        </option>
                    @endforeach
                </select>
                @error('attribute_id')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="value" class="col-form-label">Value <span class="text-danger">*</span></label>
                <input type="text" name="value" class="form-control" value="{{ old('value', $attributeValue->value) }}" required>
                @error('value')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group mb-3">
                <button type="reset" class="btn btn-warning">Reset</button>
                <button class="btn btn-success" type="submit">Update</button>
            </div>
        </form>
    </div>
</div>

@endsection
