@extends('backend.layouts.master')
@section('title','E-SHOP || Attribute Value Create')
@section('main-content')

<div class="card">
    <h5 class="card-header">Add Attribute Value</h5>
    <div class="card-body">
        <form method="post" action="{{route('attribute-values.store')}}">
            @csrf
            <div class="form-group">
                <label for="attribute_id">Select Attribute <span class="text-danger">*</span></label>
                <select name="attribute_id" class="form-control" required>
                    <option value="">--Choose Attribute--</option>
                    @foreach($attributes as $attribute)
                        <option value="{{ $attribute->id }}">{{ $attribute->name }}</option>
                    @endforeach
                </select>
                @error('attribute_id')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="value" class="col-form-label">Value <span class="text-danger">*</span></label>
                <input type="text" name="value" placeholder="Enter value (e.g., Red, XL)" value="{{ old('value') }}" class="form-control" required>
                @error('value')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group mb-3">
                <button type="reset" class="btn btn-warning">Reset</button>
                <button type="submit" class="btn btn-success">Submit</button>
            </div>
        </form>
    </div>
</div>

@endsection
