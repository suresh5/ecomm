@extends('backend.layouts.master')
@section('title','E-SHOP || Attribute Create')
@section('main-content')

<div class="card">
    <h5 class="card-header">Add Attribute</h5>
    <div class="card-body">
      <form method="post" action="{{route('attribute.store')}}">
        {{csrf_field()}}
        <div class="form-group">
          <label for="inputTitle" class="col-form-label">Title <span class="text-danger">*</span></label>
        <input id="inputTitle" type="text" name="name" placeholder="Enter title"  value="{{old('name')}}" class="form-control">
        @error('name')
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

 