<!DOCTYPE html>
<html>
@include("layouts.auth.parts.header")
<body>
<section class="material-half-bg" >
    <div class="cover"></div>
</section>
<section class="login-content">
    <div class="logo">
        <img src="{{asset("assets/Asset 1.svg")}}" alt="" class="site-logo login">
    </div>
    @yield("content")
</section>
<!-- Essential javascripts for application to work-->
@include("layouts.auth.parts.footer")
</body>
</html>
