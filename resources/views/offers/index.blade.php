@extends("layouts.dashboard.app")

@section("page-nav-title")
    <div class="app-title">
        <div>
            <h1><i class="fa fa-dashboard"></i> Offers</h1>
            <p>Control and view all offers</p>
        </div>
        <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
            <li class="breadcrumb-item"><a href="#">Offers</a></li>
        </ul>
    </div>
@endsection
@section("content")
    @include("layouts.main-parts.page-message")
    <div class="row">
{{--        <div class="col-lg-12 mb-3 text-right">--}}
{{--            <a href="{{route("items.export.excel")}}" download="download" class="btn btn-primary"><i class="far fa-fw fa-lg  fa-file-excel text-left"></i> Export As Excel</a>--}}
{{--        </div>--}}
        <div class="col-md-12">
            <div class="tile">
                <div class="tile-body">
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered" id="sampleTable">
                            <thead>
                            <tr>
                                <th>#ID</th>
                                <th>Offer Value</th>
                                <th>Offer Type</th>
                                <th>Offer On</th>
                                @if(hasPermissions(["create-offer","edit-offer"]))
                                    <th>Branches</th>
                                @endif
                                @if(hasPermissions(["create-offer","edit-offer"]))
                                    <th>Control</th>
                                @endif
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($offers as $offer)
                                <tr>
                                    <td>{{$offer->id}}</td>
                                    <td>{{$offer->offer_type == "p" ? "%"  : "-"}} {{$offer->value}}</td>
                                    <td>@if($offer->translate_type == "category") On Category @else On Item @endif</td>

                                    <td>@if($offer->translate_type == "item")
                                            @if(!empty($offer->item))
                                              {{$offer->item->item_name_en}} ({{$offer->item->item_name_ar}})
                                            @endif
                                        @else
                                            @if(!empty($offer->category))
                                               {{$offer->category->category_name_en}} ({{$offer->category->category_name_ar}})
                                             @endif
                                        @endif
                                    </td>

                                    @if(hasPermissions(["create-offer","edit-offer"]))
                                    <td>
                                        <a href="{{route("offers.branches",[$offer->id,app()->getLocale()])}}" class="btn btn-primary">Link</a>
                                    </td>
                                    @endif
                                    @if(hasPermissions(["edit-offer", "delete-offer"]))
                                        <td>
                                            @if(hasPermissions("edit-offer"))
                                                <a href="{{route("offers.edit", [$offer->id,app()->getLocale()])}}" class="control-link edit"><i class="fas fa-edit"></i></a>
                                            @endif
                                            @if(hasPermissions( "delete-offer"))
                                                <form action="{{route("offers.destroy", [$offer->id,app()->getLocale()])}}" method="post" id="delete{{$offer->id}}" style="display: none" data-swal-title="Delete Offer" data-swal-text="Are Your Sure To Delete This Offer ?" data-yes="Yes" data-no="No" data-success-msg="the offer has been deleted succssfully">@csrf @method("delete")</form>
                                                <span href="#" class="control-link remove form-confirm" data-form-id="#delete{{$offer->id}}"><i class="far fa-trash-alt"></i></span>
                                            @endif
                                        </td>
                                    @endif
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
@section("scripts")
    <!-- Data table plugin-->
    <script type="text/javascript" src="{{asset("assets/js/plugins/jquery.dataTables.min.js")}}"></script>
    <script type="text/javascript" src="{{asset("assets/js/plugins/dataTables.bootstrap.min.js")}}"></script>
    <script type="text/javascript">$('#sampleTable').DataTable();</script>
    <!-- Google analytics script-->
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
