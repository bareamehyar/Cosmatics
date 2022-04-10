@extends("layouts.dashboard.app")

@section("page-nav-title")
    <div class="app-title">
        <div>
            <h1><i class="fa fa-dashboard"></i> App Users</h1>
            <p>Control and view all App Users</p>
        </div>
        <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
            <li class="breadcrumb-item"><a href="#">App Users</a></li>
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
                                <th>First name</th>
                                <th>Phone number</th>
                                <td>User Type</td>


                                <th>Control</th>
                            </tr>
                            </thead>
                            <tbody>

                            @foreach($users as $user)
                                <tr>

                                    <td>{{$user->id}}</td>
                                    <td>{{$user->first_name}}</td>
                                    <td>{{$user->MobileNumber}}</td>

                                    <td>
                                        <div class="toggle-flip change-type-user">
                                            <label>
                                                <select id="selectType"onchange="changeType(this,{{$user->id}})" data-userid="{{$user->id}}" class="form-control form-control-sm">
                                                    @switch($user->Type)

                                                        @case  ('driver'):
                                                        <option value="{{$user->Type}}">{{$user->Type}}</option>
                                                        <option value="user">user</option>
                                                        <option value="vendor">vendor</option>
                                                        <option value="cashier">cashier</option>

                                                        @break;
                                                        @case ('user'):
                                                        <option value="{{$user->Type}}">{{$user->Type}}</option>
                                                        <option value="vendor">vendor</option>
                                                        <option value="driver">driver</option>
                                                        <option value="cashier">cashier</option>

                                                        @break;
                                                        @case ('vendor') :
                                                        <option value="{{$user->Type}}">{{$user->Type}}</option>
                                                        <option value="user">user</option>
                                                        <option value="driver">driver</option>
                                                        <option value="cashier">cashier</option>

                                                        @break;

                                                        @case ('cashier') :
                                                        <option value="{{$user->Type}}">{{$user->Type}}</option>
                                                        <option value="user">user</option>
                                                        <option value="driver">driver</option>
                                                        <option value="vendor">vendor</option>

                                                        @break;


                                                    @endswitch

                                                </select>


                                            </label>
                                        </div>
                                    </td>


                                    <td>
                                        <form action="{{route("users.app.destroy",[$user->id,app()->getLocale()])}}" method="post" id="delete{{$user->id}}" style="display: none" data-swal-title="Delete User" data-swal-text="Are Your Sure To Delete This User ?" data-yes="Yes" data-no="No" data-success-msg="the User has been deleted succssfully">@csrf @method("delete")</form>
                                        <span href="#" class="control-link remove form-confirm" data-form-id="#delete{{$user->id}}"><i class="far fa-trash-alt"></i></span>



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


    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">select branch </h5>
                </div>
                <div class="modal-body">
                    <form >
                        <div id="formDriver">
                            <select id="branch" class="form-control form-control-sm" >
                                <option value="empty">select one</option>
                                @foreach($Branchs as $branch)
                                    <option value="{{$branch->id}}">{{$branch-> store_name}}</option>
                                @endforeach

                            </select>
                        </div>

                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" onClick="work()" class="btn btn-primary" >Save</button>
                    <button type="button" id="closeType"class="btn btn-secondary" data-dismiss="modal">Close</button>
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
    <script type="text/javascript">

        $("#closeType").click(function(){

            $("#selectType").val("user");

        });

        function changeType(select,id){


            let UserType =$(select).val();
            let userId =id;
            if(UserType == "driver" || UserType == "vendor" || UserType == "cashier" ){

                $('#exampleModal').modal('show');
                $('#formDriver').append("<input type='hidden' id='userId' value="+userId+" >");
                $('#formDriver').append("<input type='hidden' id='type'  value="+UserType+" >");

            }


        }

        function work(){


            let branch =$('#branch').val();
            let userId =$('#userId').val();
            let UserType=$("#type").val();




            if( branch == "empty"){
                $("#selectType").val("user");
                $('#exampleModal').modal('hide');
            }else{


                $.ajax({
                    type: "POST",
                    url:"/api/users/app/change_type",
                    data:{userType: UserType, userId: userId,branch:branch}, // serializes the form's elements.
                    success: function(response)
                    {
                        console.log(response);
                        if(response.status == 1){
                            location.reload();

                        }
                    },
                    error:function(){
                        console.error("you have error");
                    }
                });





            }





        }


    </script>
@endsection
