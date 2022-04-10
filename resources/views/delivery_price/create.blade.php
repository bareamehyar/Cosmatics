@extends("layouts.dashboard.app")
@section("page-title")
    Delivery Price
@endSection
@section('css-links')
    <style>
        #info-box{display: none;}
    </style>
@endsection

@section("page-nav-title")
    <div class="app-title">
        <div>
            <h1><i class="fa fa-dashboard"></i> Delivery Price</h1>
            <p>should by define the location to add the delivery price</p>
        </div>
        <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
            <li class="breadcrumb-item"><a href="{{route("delivery_price.index")}}">Delivery Price</a></li>
            <li class="breadcrumb-item"><a href="#">Create</a></li>
        </ul>
    </div>
@endsection
@section("content")
@include("layouts.main-parts.page-message")
    <div class="row parent-box">
        <div class="col-lg-10 m-auto map-box">
            <div class="tile">
                <h3 class="tile-title">Add New Delivery Location Price</h3>
                <div class="tile-body" id="parent-box">

                    <!--- Map Section --->

                    <div id="map-box" style="@if(Session::has("location_details")) display:none @endif">
                        <div id="map"></div>
                        <input type="hidden" name="latitude" id="lat" value="{{inputValue("latitude")}}">
                        <input type="hidden" name="longitude" id="lng" value="{{inputValue("longitude")}}">

                        <div class="tile-footer text-right">
                            <button class="btn btn-primary fetchAddressInfo" >Next<i class="fa fa-fw fa-lg fa-arrow-right" style="margin-left: 7px;margin-right:0"></i></button>
                        </div>
                    </div>

                    <!--- Info Section --->

                    <div id="info-box" style="@if(Session::has("location_details")) display:block @endif">
                        <form method="post" action="{{ route("delivery_price.store") }}" enctype="multipart/form-data">
                            @csrf
                            <div id="location" class="text-with-icon">
                                <span class="icon color-primary-dark"><i class="fas fa-map-marker-alt"></i></span>
                                <span class="text">
                                    @if(Session::has("location_details"))
                                    {{ !empty(Session::get("location_details")["country"]) ? Session::get("location_details")["country"] : null }}
                                    {{ !empty(Session::get("location_details")["governorate"]) ? " - " . Session::get("location_details")["governorate"] : null }}
                                    {{ !empty(Session::get("location_details")["locality"]) ? " - " . Session::get("location_details")["locality"] : null }}
                                    {{ !empty(Session::get("location_details")["subLocality"]) ? " - " . Session::get("location_details")["subLocality"] : null }}
                                    {{ !empty(Session::get("location_details")["neighborhood"]) ? " - " . Session::get("location_details")["neighborhood"] : null }}
                                    @endif
                                </span>
                            </div>
                            <div class="form-group">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="control-label">Price</label>
                                        <input class="form-control @if($errors->has('price')) is-invalid @endif" type="text" name="price" placeholder="Enter The Delivery Location Price" value="{{inputValue("price")}}">
                                    </div>
                                    @error("price")
                                    <div class="input-error">{{$message}}</div>
                                    @enderror
                                </div>
                                <div class="col-lg-6">
                                    <label class="control-label">Supported</label>
                                    <div class="toggle-flip">
                                        <label>
                                            <input type="checkbox" name="supported" checked><span class="flip-indecator" data-toggle-on="ON" data-toggle-off="OFF"></span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="tile-footer">
                                <span class="btn btn-primary" id="CancelLocation"><i class="fa fa-fw fa-lg fa-times-circle"></i>Cancel</span>
                                <button class="btn btn-success" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Add</button>
                            </div>
                        </form>
                    </div>


                </div>
            </div>
        </div>
    </div>
@endsection
@section("scripts")
    <script src="{{asset("assets/js/maps.js")}}"></script>
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
    <script
        src="https://maps.googleapis.com/maps/api/js?key={{env("GOOGLE_API_KEY")}}&callback=initMap&libraries=&v=weekly"
        async
    ></script>

    <script type="text/javascript">
        $(".fetchAddressInfo").on("click",function(e){
        e.preventDefault();
        let lat = parseFloat(inputLat.value);
        let lng = parseFloat(inputLng.value);

        let mapBox = $("#map-box");
        let infoBox = $("#info-box");
        let parentBox = $("#parent-box");
        let locationData = {};

    if(!isNaN(lat) && !isNaN(lng)){

        
        var latlng = new google.maps.LatLng(lat, lng);
        var geocoder = new google.maps.Geocoder();
        geocoder.geocode({ 'latLng': latlng }, function (results, status) {
            if (status !== google.maps.GeocoderStatus.OK) {
                alert(status);
            }
            if (status == google.maps.GeocoderStatus.OK) {
            results.forEach(element => {
                element.types.forEach(el => {
                    switch (el) {
                        case "country":
                                locationData.country = element.address_components[0].long_name 
                            break;
                            case "administrative_area_level_1":
                                locationData.governorate = element.address_components[0].long_name 
                            break;
                            case "locality":
                                locationData.locality = element.address_components[0].long_name 
                            break;
                            case "sublocality":
                                locationData.subLocality = element.address_components[0].long_name 
                            break;
                            case "neighborhood":
                                locationData.neighborhood = element.address_components[0].long_name 
                            break;
                    
                        default:
                            break;
                    }

                });
            });
            console.log(locationData);
            $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
            });
            $.ajax({
                type: "POST",
                url:"/api/delivery_location/initialize",
                data:locationData,
                success: function(response)
                {
                    if(response.status == 200){
                        let result = response.data.join(" - ");
                        mapBox.fadeOut(300,function(){
                            infoBox.find("#location").children(".text").text(result);
                            infoBox.fadeIn();
                        });
                    }else if(response.status == 300){
                        alert("The Location Already Registered");
                    }else{
                        alert("This Location is not supported");
                    }
                },
                error:function(){
                    console.error("you have error");
                }
            });
            
            }
        });

    }else{
        alert("Define The Location Please ..");
    }

    });
    $("#CancelLocation").on("click",function(e){


        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: "POST",
            url:"/api/delivery_location/cancel",
            success: function(response)
            {
                location.reload();
            },
            error:function(){
                console.error("you have error");
            }
        });

    });
    </script>
@endsection
