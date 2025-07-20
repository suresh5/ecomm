@extends('backend.layouts.master')
@section('title','E-SHOP || Attribute Edit')
@section('main-content')

<div class="card">
    <h5 class="card-header">Edit Attribute</h5>
    <div class="card-body">
      <form method="post" action="{{route('attribute.update',$attribute->id)}}">
        @csrf 
        @method('PATCH')
        <div class="form-group">
          <label for="inputTitle" class="col-form-label">Title <span class="text-danger">*</span></label>
        <input id="inputTitle" type="text" name="name" placeholder="Enter title"  value="{{$attribute->name}}" class="form-control">
        @error('name')
        <span class="text-danger">{{$message}}</span>
        @enderror
        </div>        
        
        <div class="form-group mb-3">
           <button class="btn btn-success" type="submit">Update</button>
        </div>
      </form>
    </div>
</div>

@endsection