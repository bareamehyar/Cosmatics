@extends("layouts.dashboard.app")

@section("css-links")
    <style>
        .input-icon i{
            color: var(--primary-dark);
            font-size: 13px;
        }
    </style>
@endsection
@section("page-nav-title")
    <div class="app-title">
        <div>
            <h1><i class="fa fa-dashboard"></i> Offers</h1>
            <p>Control and view all offers</p>
        </div>
        <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
            <li class="breadcrumb-item"><a href="#">Offers</a></li>
            <li class="breadcrumb-item"><a href="#">edit</a></li>
        </ul>
    </div>
@endsection
@section("content")
    <div class="row">
        <div class="col-lg-10 m-auto">
            <div class="tile">
                <h3 class="tile-title">Edit Offer</h3>
                <div class="tile-body">
                    <form method="post" action="{{route("offers.update", [$offer->id,app()->getLocale()])}}" enctype="multipart/form-data">
                        @csrf
                        @method("put")
                        <div class="row">
                            <div class="col-lg-6" >
                                <div class="form-group">
                                    <label for="exampleSelect1">Offer Type</label>
                                    <select class="form-control" id="OfferType" name="offer_value_type">
                                        <option value="1" @if(old("offer_value_type") == 1) selected @else @if($offer->offer_type == "p" && old("offer_value_type") == null) selected @endif @endif>Percent</option>
                                        <option value="2" @if(old("offer_value_type") == 2) selected @else @if($offer->offer_type == "m" && old("offer_value_type") == null) selected @endif @endif>Minus</option>
                                    </select>
                                </div>
                                @error("offer_value_type")
                                <div class="input-error">{{$message}}</div>
                                @enderror
                            </div>
                            <div class="col-lg-6" >
                                <div class="form-group">
                                    <label class="control-label">Offer Value</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend"><span class="input-group-text input-icon"><i class="@if(old("offer_value_type") == 1 || ($offer->offer_type == "p" && old("offer_value_type") == null)) fas fa-percent @else fas fa-minus @endif" id="OfferIcon"></i></span></div>
                                        <input class="form-control @if($errors->has('offer_value')) is-invalid @endif" type="text" name="offer_value" placeholder="Enter Offer Value" value="{{inputValue("offer_value",$offer, "value")}}">
                                    </div>
                                </div>
                                @error("offer_value")
                                <div class="input-error">{{$message}}</div>
                                @enderror
                            </div>
                            <div class="col-lg-6" >
                                <div class="form-group">
                                    <label for="exampleSelect1">Offer On</label>
                                    <select class="form-control" id="OfferOn" name="offer_type">
                                        <option value="1" @if(old("offer_type") == 1) selected @else @if($offer->translate_type == "category" && old("offer_type") == null) selected @endif @endif>Category</option>
                                        <option value="2" @if(old("offer_type") == 2) selected @else @if($offer->translate_type == "item" && old("offer_type") == null) selected @endif @endif>Item</option>
                                    </select>
                                </div>
                                @error("offer_type")
                                <div class="input-error">{{$message}}</div>
                                @enderror
                            </div>

                            <div class="col-lg-6" id="offerCategories" style="@if(old("offer_type") == 2 || ($offer->translate_type == "item" && old("offer_type") == null)) display:none @endif">
                                <div class="form-group">
                                    <label for="exampleSelect1">Category</label>
                                    <select class="form-control" id="exampleSelect1" name="category">
                                        @foreach($categories as $category)
                                            @if(!isset($allCurrentOffers["category"][$category->id]) || ($offer->translate_type == "category" && $category->id == $offer->type_id) )
                                                <option value="{{$category->id}}" @if(old("offer_type") == 1 || ($offer->translate_type == "category" && old("offer_type") == null)) {{selected("category", $category->id, $offer, "type_id")}} @endif>{{$category->category_name_en}} ( {{$category->category_name_ar}} )</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                                @error("category")
                                <div class="input-error">{{$message}}</div>
                                @enderror
                            </div>

                            <div class="col-lg-6"  id="offerItems" style="@if(old("offer_type") == 1 || ($offer->translate_type == "category" && old("offer_type") == null)) display:none @endif">
                                <div class="form-group">
                                    <label for="exampleSelect1">Items</label>
                                    <select class="form-control" id="exampleSelect1" name="item">
                                        @foreach($items as $item)
                                            @if(!isset($allCurrentOffers["item"][$item->id]) || ($offer->translate_type == "item" && $item->id == $offer->item->id))
                                                <option value="{{$item->id}}" @if(old("offer_type") == 2 || ($offer->translate_type == "item" && old("offer_type") == null)) {{selected("item", $item->id, $offer, "type_id")}} @endif>{{$item->item_name_en}} ( {{$item->item_name_ar}} )</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                                @error("item")
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
    <script type="text/javascript" src="{{asset("assets/js/plugins/select2.min.js")}}"></script>

    <script type="text/javascript">
        if(document.location.hostname == 'pratikborsadiya.in') {
            (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
                (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
                m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
            })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
            ga('create', 'UA-72504830-1', 'auto');
            ga('send', 'pageview');
        }
        $('#demoSelect').select2();

    </script>

    <script>
        $("#OfferOn").change(function (){
           if($(this).val() == 2){
               console.log($("#offerCategories"));
               $("#offerCategories").fadeOut(400,function (){
                  $("#offerItems").fadeIn();
               });
           }else{
               $("#offerItems").fadeOut(400,function (){
                   $("#offerCategories").fadeIn();
               });
           }
        });
        $("#OfferType").change(function (){
            let className = '';
           if($(this).val() == 1)
               className = "fas fa-percent";
           else
               className = "fas fa-minus";
            $("#OfferIcon")[0].className = className;
        });
    </script>

@endsection
