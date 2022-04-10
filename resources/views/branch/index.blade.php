@extends("layouts.dashboard.app")

@section("page-nav-title")
    <div class="app-title">
        <div>
            <h1><i class="fa fa-dashboard"></i> Branches</h1>
            <p>Control and view all Branches of Store</p>
        </div>
        <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
            <li class="breadcrumb-item"><a href="#">Branches</a></li>
        </ul>
    </div>
@endsection
@section("content")
    @include("layouts.main-parts.page-message")
    <div class="row">
        <div class="col-md-12">
            <div class="tile">
                <div class="tile-body">
                    <div class="table-responsive">
                    <table class="table table-hover table-bordered" id="sampleTable">
                        <thead>
                            <tr>
                                <th>#ID</th>
                                <th>Image</th>
                                <th>Branch Place</th>
                                <th>Location on the Map</th>
                                <th>Address</th>
                                <th>Phone number</th>
                                <th>Category</th>
                                @if(hasPermissions("control-sliders-branches"))
                                <th>Slider</th>
                                @endif
                                @if(hasPermissions(["edit-branch", "delete-branch"]))
                                <th>Control</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($branchs as $branch)
                            <tr>

                                <td>{{$branch->id}}</td>
                                <td><img src="{{$branch->img_url}}" alt="image" style="width: 80px;max-height: 80px"></td>
                                <td>{{$branch->store_name}}</td>
                                <td>
                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#openMap{{$branch->id}}">
                                        Open The Map
                                    </button>
                                    <div class="modal fade" id="openMap{{$branch->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Location on the Map</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <iframe
                                                        id="map"
                                                        allowfullscreen
                                                        src="https://www.google.com/maps/embed/v1/place?key={{env("GOOGLE_API_KEY")}}&q={{$branch->latitude}},{{$branch->longitude}}">
                                                    </iframe>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td>{{$branch->address}}</td>
                                <td>{{$branch->phone_number}}</td>
                                <td>{{$branch->category->name_en}} ({{$branch->category->name_ar}})</td>
                                @if(hasPermissions("control-sliders-branches"))
                                <td><a href="{{route("branch.slider",[$branch->id,app()->getLocale()])}}" class="btn btn-primary">Control</a></td>
                                @endif
                                @if(hasPermissions(["edit-branch", "delete-branch"]))
                                <td>
                                    @if(hasPermissions("edit-branch"))
                                    <a href="{{route("branches.edit", [$branch->id,app()->getLocale()])}}" class="control-link edit"><i class="fas fa-edit"></i></a>
                                    @endif
                                    @if(hasPermissions("delete-branch"))
                                    <form action="{{route("branches.destroy", [$branch->id,app()->getLocale()])}}" method="post" id="delete{{$branch->id}}" style="display: none" data-swal-title="Delete Branch" data-swal-text="Are Your Sure To Delete This Branch ?" data-yes="Yes" data-no="No" data-success-msg="the branch has been deleted succssfully">@csrf @method("delete")</form>
                                    <span href="#" class="control-link remove form-confirm" data-form-id="#delete{{$branch->id}}"><i class="far fa-trash-alt"></i></span>
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
