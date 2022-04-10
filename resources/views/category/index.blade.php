@extends("layouts.dashboard.app")

@section("page-nav-title")
    <div class="app-title">
        <div>
            <h1><i class="fa fa-dashboard"></i> Categories</h1>
            <p>Control and view all Categories</p>
        </div>
        <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
            <li class="breadcrumb-item"><a href="#">Categories</a></li>
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
                                <th>Category Image</th>
                                <th>English Category name</th>
                                <th>Arabic Category name</th>
                                <th>Category Status</th>
                                @if(hasPermissions(["edit-category", "delete-category"]))
                                <th>Control</th>
                                @endif
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($categories as $category)
                                <tr>
                                    <td>{{$category->id}}</td>
                                    <td><img src="{{$category->category_image_url}}" width="100px" alt="" ></td>
                                    <td>{{$category->category_name_en}}</td>
                                    <td>{{$category->category_name_ar}}</td>
                                    <td>{{$category->category_status == 1 ? "Active" : "Non-Active"}}</td>
                                    @if(hasPermissions(["edit-category", "delete-category"]))
                                    <td>
                                        @if(hasPermissions("edit-category"))
                                        <a href="{{route("categories.edit",[$category->id,app()->getLocale()])}}" class="control-link edit"><i class="fas fa-edit"></i></a>
                                        @endif
                                        @if(hasPermissions("delete-category"))
                                        <form action="{{route("categories.destroy", [$category->id,app()->getLocale()] )}}" method="post" id="delete{{$category->id}}" style="display: none" data-swal-title="Delete Category" data-swal-text="Are Your Sure To Delete This Category ?" data-yes="Yes" data-no="No" data-success-msg="the category has been deleted succssfully">@csrf @method("delete")</form>
                                        <span href="#" class="control-link remove form-confirm" data-form-id="#delete{{$category->id}}"><i class="far fa-trash-alt"></i></span>
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
