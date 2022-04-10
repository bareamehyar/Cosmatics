
<!DOCTYPE html>
<html lang="en">

<!-- Main CSS-->
<link rel="stylesheet" type="text/css" href="{{asset("assets/css/main.css")}}">

<link rel="stylesheet" type="text/css" href="{{asset('assets/css/lib/all.min.css')}}">

<link rel="stylesheet" type="text/css" href="{{asset('assets/css/custom.css')}}">
<title>404 not found page</title>
<body class="app sidebar-mini rtl">



<div class="page-wrap d-flex flex-row align-items-center error-page">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12 text-center">
                <span class="display-1 d-block font-weight-bold color-primary code">404</span>
                <div class="mb-4 lead">The page you are looking for was not found.</div>
                <a href="{{url("/")}}" class="btn btn-link">Back to Home</a>
            </div>
        </div>
    </div>
</div>
<!-- Essential javascripts for application to work-->
<script src="{{asset("assets/js/jquery-3.2.1.min.js")}}"></script>
<script src="{{asset("assets/js/popper.min.js")}}"></script>
<script src="{{asset("assets/js/bootstrap.min.js")}}"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="{{asset("assets/js/main.js")}}"></script>
<script src="{{asset("assets/js/custom.js")}}"></script>

<!-- The javascript plugin to display page loading on top-->
<script src="{{asset("assets/js/plugins/pace.min.js")}}"></script>
</body>
</html>

