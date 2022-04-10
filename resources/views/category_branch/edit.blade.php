@extends("layouts.dashboard.app")

@section("page-nav-title")
    <div class="app-title">
        <div>
            <h1><i class="fa fa-dashboard"></i> Categories Branches</h1>
            <p>edit category branch</p>
        </div>
        <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
            <li class="breadcrumb-item"><a href="{{route("categories_branches.index",app()->getLocale())}}">Categories Branches</a></li>
            <li class="breadcrumb-item"><a href="#">Edit</a></li>
            <li class="breadcrumb-item"><a href="#">{{$category->id}}</a></li>
        </ul>
    </div>
@endsection

@section("content")
    <div class="row">
        <div class="col-lg-10 m-auto">
            <div class="tile">
                <h3 class="tile-title">Edit Category Branch</h3>
                <div class="tile-body">
                    <form method="post" action="{{route("categories_branches.update", [$category->id ,app()->getLocale()])}}" enctype="multipart/form-data">
                        @csrf
                        @method("put")
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="control-label">English Category Name</label>
                                    <input class="form-control @if($errors->has('name_en')) is-invalid @endif" type="text" name="name_en" placeholder="Enter English Category name" value="{{inputValue("name_en",$category)}}">
                                </div>
                                @error("name_en")
                                <div class="input-error">{{$message}}</div>
                                @enderror
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="control-label">Arabic Category Name</label>
                                    <input class="form-control @if($errors->has('name_ar')) is-invalid @endif" type="text" name="name_ar" placeholder="Enter Arabic Category name" value="{{inputValue("name_ar",$category)}}">
                                </div>
                                @error("name_ar")
                                <div class="input-error">{{$message}}</div>
                                @enderror
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="control-label">Category Photo</label>
                                        <div>
                                            <button class="btn btn-primary form-control button-upload-file" >
                                                <input class="input-file show-uploaded" data-upload-type="single" data-imgs-container-class="uploaded-images" type="file" name="category_photo">
                                                <span class="upload-file-content">
                                                <i class="fas fa-upload fa-lg upload-file-content-icon left"></i>
                                                <span class="upload-file-content-text">Upload Photo</span>
                                            </span>
                                            </button>
                                        </div>
                                    </div>
                                    @error("category_photo")
                                    <div class="input-error">{{$message}}</div>
                                    @enderror
                                </div>
                                <div class="col-lg-6">
                                    <label class="control-label">Category Status</label>
                                    <div class="toggle-flip">
                                        <label>
                                            <input type="checkbox" name="category_status" {{checked("status", 1, $category)}}><span class="flip-indecator" data-toggle-on="ON" data-toggle-off="OFF"></span>
                                        </label>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-5 col-sm-6">
                                    <div class="uploaded-images" style="margin-bottom: 20px;">
                                        <div class="img-container">
                                            <img src="{{ $category->img_url }}" alt="">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <div class="tile-footer">
                            <button class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Save</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
@endsection
@section("scripts")
    <script type="text/javascript">
        if(document.location.hostname == 'pratikborsadiya.in') {
            (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
                (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
                m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
            })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
            ga('create', 'UA-72504830-1', 'auto');
            ga('send', 'pageview');
        }
    </script>

@endsection
