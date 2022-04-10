@extends("layouts.dashboard.app")
@section("page-title")
    Delivery Price
@endSection
@section("page-nav-title")
    <div class="app-title">
        <div>
            <h1><i class="fa fa-dashboard"></i> Edit Delivery Price</h1>
            <p></p>
        </div>
        <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
            <li class="breadcrumb-item"><a href="{{route("delivery_price.index")}}">Delivery Price</a></li>
            <li class="breadcrumb-item"><a href="#">Edit</a></li>
        </ul>
    </div>
@endsection
@section("content")
@include("layouts.main-parts.page-message")
    <div class="row parent-box">
        <div class="col-lg-10 m-auto map-box">
            <div class="tile">
                <h3 class="tile-title">Edit Delivery Location Price</h3>
                <div class="tile-body" id="parent-box">
                    <!--- Info Section --->

                    <div id="info-box">
                        <form method="post" action="{{ route("delivery_price.update",$location->id) . (isset($_GET["redirect"]) ? "?redirect=" . $_GET["redirect"] : null) }}" enctype="multipart/form-data">
                            @csrf
                            @method("put")
                            <div id="location" class="text-with-icon">
                                <span class="icon color-primary-dark"><i class="fas fa-map-marker-alt"></i></span>
                                <span class="text">
                                    {{ 
                                        $location->country .
                                        (!empty($location->governorate)    ?   " - "  .  $location->governorate     : null) . 
                                        (!empty($location->locality)       ?   " - "  .  $location->locality        : null) . 
                                        (!empty($location->sub_locality)   ?   " - "  .  $location->sub_locality    : null) . 
                                        (!empty($location->neighborhood)   ?   " - "  .  $location->neighborhood    : null)
                                    }}
                                </span>
                            </div>
                            <div class="form-group">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="control-label">Price</label>
                                        <input class="form-control @if($errors->has('price')) is-invalid @endif" type="text" name="price" placeholder="Enter The Delivery Location Price" value="{{inputValue("price",$location) > 0 ? inputValue("price",$location) : null}}">
                                    </div>
                                    @error("price")
                                    <div class="input-error">{{$message}}</div>
                                    @enderror
                                </div>
                                <div class="col-lg-6">
                                    <label class="control-label">Supported</label>
                                    <div class="toggle-flip">
                                        <label>
                                            <input type="checkbox" name="supported" {{ checked("supported",1,$location) }}><span class="flip-indecator" data-toggle-on="ON" data-toggle-off="OFF"></span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="tile-footer">
                                <button class="btn btn-success" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Save</button>
                            </div>
                        </form>
                    </div>
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
