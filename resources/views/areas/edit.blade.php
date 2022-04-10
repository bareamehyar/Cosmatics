@extends("layouts.dashboard.app")

@section("page-nav-title")
    <div class="app-title">
        <div>
            <h1><i class="fa fa-dashboard"></i> Area</h1>
            <p>edit area</p>
        </div>
        <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
            <li class="breadcrumb-item"><a href="{{route("city.index",app()->getLocale())}}">Cities</a></li>
            <li class="breadcrumb-item"><a href="#">{{ $city->city_name }}</a></li>
            <li class="breadcrumb-item"><a href="{{route("area.index", [$city->id,app()->getLocale()])}}">Areas</a></li>
            <li class="breadcrumb-item"><a href="#">{{ $area->area_name }}</a></li>
            <li class="breadcrumb-item"><a href="#">Edit</a></li>

        </ul>
    </div>
@endsection
@section("content")
    <div class="row">
        <div class="col-lg-10 m-auto">
            <div class="tile">
                <h3 class="tile-title">Edit Area</h3>
                <div class="tile-body">
                    <form method="post" action="{{route("area.update", [ "id" => $area->id, "city_id" => $city->id,app()->getLocale()])}}" enctype="multipart/form-data">
                        @csrf
                        @method("put")
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="control-label">Area name</label>
                                    <input class="form-control @if($errors->has('area_name')) is-invalid @endif" type="text" name="area_name" placeholder="Enter Area Name" value="{{inputValue("area_name", $area)}}">
                                </div>
                                @error("area_name")
                                <div class="input-error">{{$message}}</div>
                                @enderror
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
