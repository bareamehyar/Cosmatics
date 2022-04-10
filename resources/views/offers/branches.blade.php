@extends("layouts.dashboard.app")

@section("css-links")
    <style>
        .input-icon i{
            color: var(--primary-dark);
            font-size: 13px;
        }
        .detach-branch{
            color: #7e0000;
            cursor: pointer;
        }
    </style>
@endsection
@section("page-nav-title")
    <div class="app-title">
        <div>
            <h1><i class="fa fa-dashboard"></i> Offers</h1>
            <p>Control and view all offers</p>
        </div>
        <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
            <li class="breadcrumb-item"><a href="#">Offers</a></li>
            <li class="breadcrumb-item"><a href="#">Linked To Branches</a></li>
        </ul>
    </div>
@endsection
@section("content")
    <div class="row">
        <div class="col-lg-11 m-auto">
            <div class="tile">
                <h3 class="tile-title">Link Offer To Branches</h3>
                <div class="tile-body">
                    <div class="row">

                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="exampleSelect1">All Branches</label>
                                <select class="form-control" id="AttachBranch" name="branches">
                                    <option value="" >None</option>
                                    @foreach($branches as $branch)
                                        @if(!isset($branchesOfferIds[$branch->id]))
                                            <option value="{{$branch->id}}" >{{$branch->store_name}}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6" id="BranchesOffer">
                            @foreach($offer->branches as $branch)
                            <div class="tile branch">
                                <div class="tile-body">
                                    <div class="row">
                                        <div class="col-lg-10">{{$branch->store_name}}</div>
                                        <div class="col-lg-2 text-right detach-branch" data-branch-id="{{$branch->id}}"><i class="fas fa-trash-alt"></i></div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section("scripts")
    <script type="text/javascript" src="{{asset("assets/js/plugins/select2.min.js")}}"></script>

    <script type="text/javascript">
        if(document.location.hostname == 'pratikborsadiya.in') {
            (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
                (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
                m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
            })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
            ga('create', 'UA-72504830-1', 'auto');
            ga('send', 'pageview');
        }
        $('#demoSelect').select2();

    </script>

    <script>
        $("#OfferOn").change(function (){
            if($(this).val() == 2){
                console.log($("#offerCategories"));
                $("#offerCategories").fadeOut(400,function (){
                    $("#offerItems").fadeIn();
                });
            }else{
                $("#offerItems").fadeOut(400,function (){
                    $("#offerCategories").fadeIn();
                });
            }
        });
        $("#OfferType").change(function (){
            let className = '';
            if($(this).val() == 1)
                className = "fas fa-percent";
            else
                className = "fas fa-minus";
            $("#OfferIcon")[0].className = className;
        });

        // Attach Branch To Offer
        $("#AttachBranch").change(function (){
           // $(this)[0].options.length = 0;
            let branchId = $(this).val(),
                select = $(this);


            if(branchId != null){

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    type: "POST",
                    url:"/offers/{{$offer->id}}/branches/attach",
                    data:{branchId:branchId}, // serializes the form's elements.
                    success: function(response)
                    {
                        if(response.status == 1){

                            let htmlElements = `<div class="tile branch">
                                                <div class="tile-body">
                                                    <div class="row">
                                                        <div class="col-lg-10">${response.data.branch.name}</div>
                                                        <div class="col-lg-2 text-right detach-branch" data-branch-id="${response.data.branch.id}"><i class="fas fa-trash-alt"></i></div>
                                                    </div>
                                                </div>
                                            </div>`;
                            $("#BranchesOffer").append($(htmlElements));
                            select.find("option:selected").remove();


                        }
                    },
                    error:function(){
                        console.error("you have error");
                    }
                });

            }
        });



        //Detach Branch From Offer
        $(document).on("click", ".detach-branch", function (){
            // $(this)[0].options.length = 0;
            let branchId = $(this).data("branch-id"),
                button = $(this);


            if(branchId != null){

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    type: "POST",
                    url:"/offers/{{$offer->id}}/branches/detach",
                    data:{branchId:branchId}, // serializes the form's elements.
                    success: function(response)
                    {
                        if(response.status == 1){
                            let htmlElements = `<option value="${response.data.branch.id}" >${response.data.branch.name}</option>`;

                            $("#AttachBranch").append($(htmlElements));
                            button.parents(".tile.branch").remove();


                        }
                    },
                    error:function(){
                        console.error("you have error");
                    }
                });

            }
        });





    </script>

@endsection
