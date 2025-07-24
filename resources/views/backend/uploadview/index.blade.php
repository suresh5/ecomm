@extends('backend.layouts.master')
@section('title','E-SHOP || Brand Page')
@section('main-content')
 <div class="container mt-4">
    <h4 class="mb-4">Manage Uploaded Assets</h4>
  <a href="{{route('upload.create')}}" class="btn btn-primary btn-sm float-right" data-toggle="tooltip" data-placement="bottom" title="Add User"><i class="fas fa-plus"></i> Upload New</a>
 
    <ul class="nav nav-tabs" id="assetTabs" role="tablist">
        <li class="nav-item" role="presentation">
            <a class="nav-link active" id="images-tab" data-toggle="tab" href="#images" role="tab">Images</a>
        </li>
        <li class="nav-item" role="presentation">
            <a class="nav-link" id="videos-tab" data-toggle="tab" href="#videos" role="tab">Videos</a>
        </li>
        <li class="nav-item" role="presentation">
            <a class="nav-link" id="shorts-tab" data-toggle="tab" href="#shorts" role="tab">Shorts</a>
        </li>
    </ul>

    <div class="tab-content mt-3" id="assetTabsContent">
        <!-- Images -->
        <div class="tab-pane fade show active" id="images" role="tabpanel">
            @if($images->count())
                <div class="row">
                    @foreach($images as $image)
                        <div class="col-md-3 mb-3">
                            <div class="card">
                                <img src="{{ asset($image->path) }}" class="card-img-top" alt="{{ $image->title }}">
                                <div class="card-body">
                                    <h6 class="card-title">{{ $image->title }}</h6>
                                   
                                    <div class="input-group mb-2">
  <input type="text" class="form-control" value="{{ asset($upload->path) }}" readonly id="asset-url-{{ $upload->id }}">
  <button class="btn btn-outline-secondary" type="button" onclick="copyToClipboard('asset-url-{{ $upload->id }}')">Copy</button>
</div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <p>No images found.</p>
            @endif
        </div>

        <!-- Videos -->
        <div class="tab-pane fade" id="videos" role="tabpanel">
            @if($videos->count())
                <ul class="list-group">
                    @foreach($videos as $video)
                        <li class="list-group-item">
                            <strong>{{ $video->title }}</strong> - 
                            <a href="{{ asset($video->path) }}" target="_blank">View Video</a>
                        </li>
                    @endforeach
                </ul>
            @else
                <p>No videos found.</p>
            @endif
        </div>

        <!-- Shorts -->
        <div class="tab-pane fade" id="shorts" role="tabpanel">
            @if($shorts->count())
                <ul class="list-group">
                    @foreach($shorts as $short)
                        <li class="list-group-item">
                            <strong>{{ $short->title }}</strong> - 
                            <a href="{{ asset($short->path) }}" target="_blank">View Short</a>
                        </li>
                    @endforeach
                </ul>
            @else
                <p>No shorts found.</p>
            @endif
        </div>
    </div>
</div>
@endsection
 @push('scripts')
<script>
  function copyToClipboard(elementId) {
    var copyText = document.getElementById(elementId);
    copyText.select();
    copyText.setSelectionRange(0, 99999); // For mobile
    document.execCommand("copy");

    alert("Copied: " + copyText.value);
  }
</script>
 @endpush