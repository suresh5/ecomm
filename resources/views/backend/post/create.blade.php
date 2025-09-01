@extends('backend.layouts.master')

@section('main-content')

<div class="card">
    <h5 class="card-header">Add Post</h5>
    <div class="card-body">
      <form method="post" action="{{route('post.store')}}">
        {{csrf_field()}}
         <div class="form-group">
          <label for="inputTitle">Title <span class="text-danger">*</span></label>
          <input id="inputTitle" type="text" name="title" placeholder="Enter title"  value="{{old('title')}}" class="form-control">
          @error('title') <span class="text-danger">{{$message}}</span> @enderror
        </div>

        <div class="row">
          <div class="form-group col-md-6">
            <label for="post_cat_id">Category <span class="text-danger">*</span></label>
            <select name="post_cat_id" id="cat_id" class="form-control">
              <option value="">--Select category--</option>
              @foreach($categories as $key => $data)
                <option value='{{$data->id}}'>{{$data->title}}</option>
              @endforeach
            </select>
          </div>
          <div class="form-group  col-md-6 d-none" id="child_cat_div">
          <label for="child_cat_id">Sub Category</label>
          <select name="child_cat_id" id="child_cat_id" class="form-control">
              <option value="">--Select any category--</option>
              {{-- @foreach($parent_cats as $key=>$parent_cat)
                  <option value='{{$parent_cat->id}}'>{{$parent_cat->title}}</option>
              @endforeach --}}
          </select>
        </div>

        </div>

         <div class="row">

          <div class="form-group col-md-6">
            <label for="tags">Tags</label>
            <select name="tags[]" multiple data-live-search="true" class="form-control selectpicker">
              <option value="">--Select tag--</option>
              @foreach($tags as $key => $data)
                <option value='{{$data->title}}'>{{$data->title}}</option>
              @endforeach
            </select>
          </div>

           <div class="form-group col-md-6">
          <label for="pageslug">Page Slug</label>
          <input type="text" class="form-control" name="slug" value="{{ old('slug') }}">
        </div>
              </div>

        <div class="row">
          <div class="form-group col-md-4">
            <label for="article_type">Article Type</label>
            <select name="article_type" class="form-control">
              <option value="short">Short</option>
              <option value="detail">Detail</option>
            </select>
          </div>

          <div class="form-group col-md-4">
            <label for="content_type">Content Type</label>
            <select name="content_type" class="form-control">
              <option value="post">Post</option>
              <option value="video">Video</option>
              <option value="gallery">Gallery</option>
              <option value="image">Image</option>
            </select>
          </div>

          <div class="form-group col-md-4">
            <label for="added_by">Author</label>
            <select name="added_by" class="form-control">
              <option value="">--Select author--</option>
              @foreach($users as $key => $data)
                <option value='{{$data->id}}' {{($key==0) ? 'selected' : ''}}>{{$data->name}}</option>
              @endforeach
            </select>
          </div>
        </div>

 <div class="row">
          <div class="form-group col-md-4">
            <label for="status">Status</label>
            <select name="status" class="form-control">
              <option value="active">Active</option>
              <option value="inactive">Inactive</option>
            </select>
            @error('status') <span class="text-danger">{{$message}}</span> @enderror
          </div>

          <div class="form-group col-md-4">
            <label for="is_trending">Trending</label>
            <select name="is_trending" class="form-control">
              <option value="0">No</option>
              <option value="1">Yes</option>
            </select>
          </div>

          <div class="form-group col-md-4">
            <label for="is_featured">Featured</label>
            <select name="is_featured" class="form-control">
              <option value="0">No</option>
              <option value="1">Yes</option>
            </select>
          </div>
        </div>

        <div class="form-group">
        <label for="asset_url">Asset URL</label>
        <input type="text" class="form-control" name="asset_url" value="{{ old('asset_url') }}">
        </div>
        <div class="form-group">
        <label for="thumbnail">Web Thumbnail</label>
        <input type="text" class="form-control" name="thumbnail" value="{{ old('thumbnail') }}">
        </div>
        <div class="form-group">
        <label for="app_thumbnail">App Thumbnail</label>
        <input type="text" class="form-control" name="app_thumbnail" value="{{ old('app_thumbnail') }}">
        </div>
        <div class="form-group">
        <label for="cover">Cover Image</label>
        <input type="text" class="form-control" name="cover" value="{{ old('cover') }}">
        </div>

 <div class="form-group">
          <label for="seo_title">SEO Title</label>
          <input type="text" class="form-control" name="seo_title" value="{{ old('seo_title') }}">
        </div>

        <div class="form-group">
          <label for="seo_description">SEO Description</label>
          <textarea class="form-control" name="seo_description" rows="2">{{ old('seo_description') }}</textarea>
        </div>

        <div class="form-group">
          <label for="seo_keywords">SEO Keywords (comma-separated)</label>
          <input type="text" class="form-control" name="seo_keywords" value="{{ old('seo_keywords') }}">
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

    $(document).ready(function() {
      $('#quote').summernote({
        placeholder: "Write detail Quote.....",
          tabsize: 2,
          height: 100
      });
    });
    // $('select').selectpicker();

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