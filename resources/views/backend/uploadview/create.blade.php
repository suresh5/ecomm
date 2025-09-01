@extends('backend.layouts.master')
@section('title','E-SHOP || Asset Create')
@section('main-content')

<div class="card">
    <h5 class="card-header">Asset Upload</h5>
    <div class="card-body">
        <form method="post" action="{{ route('upload.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="row">

                <div class="form-group col-md-4">
                    <label for="title">Title <span class="text-danger">*</span></label>
                    <input id="title" type="text" name="title" value="{{ old('title') }}" class="form-control" placeholder="Asset Title">
                    @error('title') <span class="text-danger">{{ $message }}</span> @enderror
                </div>

                <div class="form-group col-md-4">
                    <label for="type">Type <span class="text-danger">*</span></label>
                    <select name="type" class="form-control" onchange="toggleSubtype(this.value)">
                        <option value="">-- Select Type --</option>
                        <option value="image">Image</option>
                        <option value="video">Video</option>
                        <option value="short">Short</option>
                    </select>
                    @error('type') <span class="text-danger">{{ $message }}</span> @enderror
                </div>

                <div class="mb-3" id="image-subtype-group" style="display:none;">
        <label>Image Subtype</label>
        <select name="subtype" class="form-control">
            <option value="cover">Cover</option>
            <option value="appthumbnail">App Thumbnail</option>
            <option value="webthumbnail">Web Thumbnail</option>
        </select>
    </div>

              

            </div>
 <div class="row">
              <div class="form-group col-md-4">
                    <label for="file">Upload File <span class="text-danger">*</span></label>
                    <input type="file" name="file" class="form-control-file">
                    @error('file') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
</div>
            <div class="form-group mt-3">
                <button type="submit" class="btn btn-success">Upload</button>
                <a href="{{ route('upload.index') }}" class="btn btn-secondary">Back</a>
            </div>
        </form>
    </div>
</div>

@endsection

@push('styles')
<link rel="stylesheet" href="{{asset('backend/summernote/summernote.min.css')}}">
@endpush
@push('scripts')
<script src="/vendor/laravel-filemanager/js/stand-alone-button.js"></script>
<script src="{{asset('backend/summernote/summernote.min.js')}}"></script>
<script>
function toggleSubtype(type) {
    document.getElementById('image-subtype-group').style.display = type === 'image' ? 'block' : 'none';
}
</script>
<script>
    $('#lfm').filemanager('image');

    $(document).ready(function() {
    $('#description').summernote({
      placeholder: "Write short description.....",
        tabsize: 2,
        height: 150
    });
    });
</script>
@endpush