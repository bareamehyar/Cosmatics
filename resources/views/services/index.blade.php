@extends("layouts.dashboard.app")

@section("page-nav-title")
    <div class="app-title">
        <div>
            <h1><i class="fa fa-dashboard"></i> services</h1>
            <p>Control and view all services</p>
        </div>
        <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
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
                                <th>English name</th>
                                <th>Arabic name</th>
                                <th>Choice Type</th>
                                <th>Control</th>

                            </tr>
                            </thead>
                            <tbody>
                            @foreach($category_services as $category_service)
                                <tr>
                                    <td>{{$category_service->id}}</td>
                                    <td>{{$category_service->service_name_en}}</td>
                                    <td>{{$category_service->service_name_ar}}</td>
                                    <td>{{$category_service->which_choice == 1 ? "Single" : "Multi"}}</td>



                                          <td>
                                 <a href="{{route("services.edit", [$category_service->id,app()->getLocale()])}}" class="control-link edit"><i class="fas fa-edit"></i></a>
                                <form action="{{route("services.destroy",[$category_service->id,app()->getLocale()])}}" method="post" id="delete{{$category_service->id}}" style="display: none" data-swal-title="Delete Service " data-swal-text="Are Your Sure To Delete This Service ?" data-yes="Yes" data-no="No" data-success-msg="the Service has been deleted succssfully">@csrf @method("delete")</form>
                                <span href="#" class="control-link remove form-confirm" data-form-id="#delete{{$category_service->id}}"><i class="far fa-trash-alt"></i></span>
                                </td>



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

@endsection
