@extends("layouts.dashboard.app")

@section("page-nav-title")
    <div class="app-title">
        <div>
            <h1><i class="fa fa-dashboard"></i> Payment Methods</h1>
            <p>Control and View All Payment Methods</p>
        </div>
        <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
            <li class="breadcrumb-item"><a href="#">Payment Methods</a></li>
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
                                <th>Title</th>
                                @if(hasPermissions(["edit-payment-method", "delete-payment-method"]))
                                <th>Control</th>
                                @endif
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($payments as $payment)
                                <tr>
                                    <td>{{$payment->id}}</td>
                                    <td>{{$payment->title}}</td>
                                    @if(hasPermissions(["edit-payment-method", "delete-payment-method"]))
                                    <td>
                                        @if(hasPermissions("edit-payment-method"))
                                        <a href="{{route("payment_method.edit", $payment->id)}}" class="control-link edit"><i class="fas fa-edit"></i></a>
                                        @endif
                                        @if(hasPermissions("delete-payment-method"))
                                        <form action="{{route("payment_method.destroy", $payment->id)}}" method="post" id="delete{{$payment->id}}" style="display: none" data-swal-title="Delete Payment" data-swal-text="Are Your Sure To Delete This Payment ?" data-yes="Yes" data-no="No" data-success-msg="the payment has been deleted succssfully">@csrf @method("delete") <input type="hidden" name="id" value="{{ $payment->id }}"></form>
                                        <span href="#" class="control-link remove form-confirm" data-form-id="#delete{{$payment->id}}"><i class="far fa-trash-alt"></i></span>
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
