
@extends("layouts.dashboard.app")

@section("page-nav-title")
    <div class="app-title">
        <div>
            <h1><i class="fa fa-dashboard"></i>Link Service With Ttems</h1>
            <p>Service with Items</p>
        </div>
        <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
        </ul>
    </div>
@endsection
@section("content")



    <div class="row">
        <div class="col-lg-12 m-auto">
            <div class="tile">
                <h3 class="tile-title">Link  Service</h3>



                         @if ($errors->any())
                           @foreach ($errors->all() as $error)


                            <div class="alert alert-danger" >{{$error}}</div>


                            @endforeach
                        @endif





                <div class="tile-body">
                    <form method="post" action="{{route("services.storeLink",app()->getLocale())}}" enctype="multipart/form-data">
                        @csrf
                        <div class="row">



                                <div class="col-md-6">
                                    <div class="tile">
                                        <div class="tile-body">
                                            <div class="table-responsive">
                                                <table class="table table-hover table-bordered" id="sampleTable">
                                                    <thead>
                                                    <tr>
                                                        <th>select</th>
                                                        <th>item Image</th>
                                                        <th>English Item name</th>
                                                        <th>Arabic Item name</th>


                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @foreach($ItemsLists as $ItemsList)
                                                        <tr>
                                                            <td><input type="checkBox" name="Item[]" value="{{$ItemsList->id}}"></td>
                                                            <td><img src="{{$ItemsList->item_image}}" alt="" style="width: 90px"></td>
                                                            <td>{{$ItemsList->item_name_en}}</td>
                                                            <td>{{$ItemsList->item_name_ar}}</td>


                                                        </tr>
                                                    @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>



                            </div>


                                <div class="col-md-6">
                                    <div class="tile">
                                        <div class="tile-body">
                                            <div class="table-responsive">
                                                <table class="table table-hover table-bordered" id="sampleTable2">
                                                    <thead>
                                                    <tr>
                                                        <th>select</th>
                                                        <th>English service name</th>
                                                        <th>Arabic service name</th>


                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @foreach($Category_services as $Category_service)
                                                        <tr>
                                                            <td><input type="checkBox" name="Service[]" value="{{$Category_service->id}}"></td>
                                                            <td>{{$Category_service->service_name_en}}</td>
                                                            <td>{{$Category_service->service_name_ar}}</td>


                                                        </tr>
                                                    @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>



                            </div>



                        </div>

                        <div class="tile-footer">
                            <button class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Link</button>
                        </div>
                    </form>
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
       <script type="text/javascript">$('#sampleTable2').DataTable();</script>

    <!-- Google analytics script-->
    <script>

      $(function () {
        $('.bs-timepicker').timepicker();
      });


    </script>

@endsection

