@extends("layouts.dashboard.app")

@section("page-nav-title")
    <div class="app-title">
        <div>
            <h1><i class="fa fa-dashboard"></i> Items</h1>
            <p>Control and view all Items</p>
        </div>
        <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
            <li class="breadcrumb-item"><a href="#">Items</a></li>
        </ul>
    </div>
@endsection
@section("content")
    @include("layouts.main-parts.page-message")
    <div class="row">
        <div class="col-lg-12 mb-3 text-right">
            <a href="{{route("items.export.excel",app()->getLocale())}}" download="download" class="btn btn-primary"><i class="far fa-fw fa-lg  fa-file-excel text-left"></i> Export As Excel</a>
        </div>
        <div class="col-md-12">
            <div class="tile">
                <div class="tile-body">
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered" id="sampleTable">
                            <thead>
                            <tr>
                                <th>#ID</th>
                                <th>Item Image</th>
                                <th>English Item name</th>
                                <th>Arabic Item name</th>
                                <th>Item price</th>
                                <th>Item Status</th>

                                <th>Branches</th>

                                @if(hasPermissions(["create-add-on's","edit-add-on's", "delete-add-on's"]))
                                    <th>Add On's</th>
                                @endif
                                <th>Item Data</th>
                                @if(hasPermissions(["edit-item", "delete-item"]))
                                    <th>Control</th>
                                @endif
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($items as $item)
                                <tr>
                                    <td>{{$item->id}}</td>
                                    <td><img src="{{$item->item_image}}" alt="" style="width: 100px"></td>
                                    <td>{{$item->item_name_en}}</td>
                                    <td>{{$item->item_name_ar}}</td>

                                    <!-- Branches Box-->
                                    <div class="modal fade" id="item-branch-{{$item->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-lgx">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Branches</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    @foreach($item->branches as $branch)
                                                        <span class="field-view">{{$branch->store_name}}</span>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <td>{{$item->item_price}}</td>
                                    <td>{{$item->item_status == 1 ? "Active" : "Non-Active"}}</td>
                                    <td>
                                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#item-branch-{{$item->id}}">
                                            View
                                        </button>
                                    </td>

                                    @if(hasPermissions(["create-add-on's","edit-add-on's", "delete-add-on's"]))
                                    <td><a href="{{route("items.add_ons",[$item->id,app()->getLocale()])}}" class="btn btn-primary">Control</a></td>
                                    @endif

                                <!-- Modal -->
                                    <div class="modal fade" id="showDataItem{{$item->id}}" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">

                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="staticBackdropLabel">{{$item->item_name_en}}</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>

                                                <div class="modal-body">
                                                    <div class="card">
                                                        <div class="card-body">
                                                            <img src="{{$item->item_image}}" class="card-img-top" style="width: 90%;" alt="...">
                                                        </div>
                                                        <div class="card-body">

                                                            <hr>
                                                            <h5 class="card-title">Arabic Category name</h5>
                                                            <p class="card-text">{{$item->category->category_name_ar}}</p>
                                                            <hr>
                                                            <h5 class="card-title">English Category name</h5>
                                                            <p class="card-text">{{$item->category->category_name_en}}</p>
                                                            <hr>
                                                            <h5 class="card-title">English Item description</h5>
                                                            <p class="card-text">{{$item->item_description_en}}</p>
                                                            <hr>
                                                            <h5 class="card-title">Arabic Item description</h5>
                                                            <p class="card-text">{{$item->item_description_ar}}</p>
                                                            <hr>
                                                            <h5 class="card-title">Tax</h5>
                                                            <p class="card-text">% {{$item->tax}}</p>
                                                            <hr>


                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                    <td>

                                       {{-- modal sizez  --}}
                                        <div class="modal fade" id="ItemSize{{$item->id}}" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-lg">
                                                <div class="modal-content">

                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="staticBackdropLabel">{{$item->item_name_en}}</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>

                                                    <div class="modal-body">
                                                        <div class="table-responsive">
                                                             <table>
                                                                <thead>
                                                                <th>Sizes</th>

                                                                </thead>
                                                                @foreach($item->ItemSizes as $itemSize)
                                                                    <tr><td>{{$itemSize->Size}}</td></tr>
                                                                @endforeach
                                                            </table>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                       {{-- end sizes--}}

                                        {{-- modal Gallery   --}}
                                            <div class="modal fade" id="itemImage{{$item->id}}" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-lg">
                                                <div class="modal-content">

                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="staticBackdropLabel">{{$item->item_name_en}}</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>

                                                    <div class="modal-body">
                                                        <div class="table-responsive">
                                                            <table class="table table-hover table-bordered" id="sampleTable">
                                                                <thead>
                                                                  <th>image</th>
                                                                </thead>
                                                                <tbody>
                                                                @foreach($item->ItemGallery as $ItemG)
                                                                    <tr>
                                                                              <td>
                                                                                  <img src="{{$ItemG->image_url}}" style="width:100px" />
                                                                              </td>
                                                                    </tr>
                                                                @endforeach
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        {{-- end Gallery--}}



                                        {{-- modal Colors   --}}
                                        <div class="modal fade" id="itemColor{{$item->id}}" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-lg">
                                                <div class="modal-content">

                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="staticBackdropLabel">{{$item->item_name_en}}</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>

                                                    <div class="modal-body">
                                                        <div class="table-responsive">
                                                            <table class="table table-hover table-bordered" id="sampleTable">
                                                                <thead>
                                                                <th>image</th>
                                                                <th>Color Name</th>
                                                                </thead>
                                                                <tbody>
                                                                @foreach($item->ItemColor as $color)
                                                                    <tr>
                                                                        <td>
                                                                            <img src="{{$color->url_image}}" style="width:150px" />
                                                                        </td>
                                                                        <td>
                                                                            {{$color->color}}
                                                                        </td>
                                                                    </tr>
                                                                @endforeach
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        {{-- end Colors--}}



                                        <a href="#" class="control-link" data-toggle="modal" data-target="#ItemSize{{$item->id}}">
                                            <i>Sizes</i>
                                        </a>
                                        <a href="#" class="control-link" data-toggle="modal" data-target="#itemImage{{$item->id}}">
                                            <i class="fas fa-images"></i>
                                        </a>
                                        <a href="#" class="control-link" data-toggle="modal" data-target="#itemColor{{$item->id}}">
                                            <i class="fas fa-tint"></i>
                                        </a>


                                    </td>


                                    @if(hasPermissions(["edit-item", "delete-item"]))
                                    <td>

                                        <a href="#" class="control-link" data-toggle="modal" data-target="#showDataItem{{$item->id}}">
                                            <i class="far fa-eye"></i>
                                        </a>



                                        @if(hasPermissions("edit-item"))
                                        <a href="{{route("items.edit", [$item->id,app()->getLocale()])}}" class="control-link edit"><i class="fas fa-edit"></i></a>
                                        @endif
                                        @if(hasPermissions( "delete-item"))
                                        <form action="{{route("items.destroy", [$item->id,app()->getLocale()])}}" method="post" id="delete{{$item->id}}" style="display: none" data-swal-title="Delete Item" data-swal-text="Are Your Sure To Delete This Item ?" data-yes="Yes" data-no="No" data-success-msg="the item has been deleted succssfully">@csrf @method("delete")</form>
                                        <span href="#" class="control-link remove form-confirm" data-form-id="#delete{{$item->id}}"><i class="far fa-trash-alt"></i></span>
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
