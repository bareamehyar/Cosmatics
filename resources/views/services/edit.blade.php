@extends("layouts.dashboard.app")

@section("page-nav-title")
    <div class="app-title">
        <div>
            <h1><i class="fa fa-dashboard"></i> Edit Service</h1>
            <p>edit </p>
        </div>
        <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>

        </ul>
    </div>
@endsection
@section("content")
    <div class="row">
        <div class="col-lg-10 m-auto">
            <form method="post" action="{{route("services.update",[$category_services->id,app()->getLocale()])}}" enctype="multipart/form-data">
                @csrf
                @method('put')
                <div class="tile">
                    <h3 class="tile-title">Edit Add On Category</h3>
                    <div class="tile-body">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="control-label">English Name</label>
                                    <input class="form-control @if($errors->has('service_name_en')) is-invalid @endif" type="text" name="service_name_en" placeholder="Enter English name" value="{{inputValue("service_name_en",$category_services)}}">
                                </div>
                                @error("service_name_en")
                                <div class="input-error">{{$message}}</div>
                                @enderror
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="control-label">Arabic Name</label>
                                    <input class="form-control @if($errors->has('service_name_ar')) is-invalid @endif" type="text" name="service_name_ar" placeholder="Enter Arabic name" value="{{inputValue("service_name_ar",$category_services)}}">
                                </div>
                                @error("service_name_ar")
                                <div class="input-error">{{$message}}</div>
                                @enderror
                            </div>
                            <div class="col-lg-6" >
                                <div class="form-group">
                                    <label for="">Choice type</label>
                                    <div class="custom-control custom-radio">
                                        <input type="radio" id="customRadio1" name="choice_type" class="custom-control-input" value="1"  {{checked("choice_type", 1,$category_services, 'which_choice')}}>
                                        <label class="custom-control-label" for="customRadio1">Single</label>
                                    </div>
                                    <div class="custom-control custom-radio">
                                        <input type="radio" id="customRadio2" name="choice_type" class="custom-control-input" value="2" {{checked("choice_type", 2,$category_services, 'which_choice')}}>
                                        <label class="custom-control-label" for="customRadio2">Multi</label>
                                    </div>
                                </div>
                                @error("choice_type")
                                <div class="input-error">{{$message}}</div>
                                @enderror
                            </div>
                        </div>

                    </div>
                </div>
                <div class="tile">
                    <h3 class="tile-title">Options</h3>
                    <div class="tile-body options-container">
                        <div class="table-responsive">
                            <table class="table table-hover table-bordered" id="sampleTable">
                                <thead>
                                <tr>
                                    <th>#ID</th>
                                    <th>English name</th>
                                    <th>Arabic name</th>
                                    <th>Price</th>
                                    <th>Control</th>
                                </tr>
                                </thead>
                                <tbody>

                                @foreach($category_services->Category_service_option as $option)
                                    <tr class="option-row">
                                        <td>{{$option->id}}</td>
                                        <td>{{$option->service_option_en}}</td>
                                        <td>{{$option->service_option_ar}}</td>
                                        <td>{{$option->price}}</td>
                                        <td>
                                            <span class="btn btn-primary delete-option" data-option="{{$option->id}}">Delete</span>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>

                        @if(isset($options_selected))
                            @for($i=0; $i < $options_selected; $i++)
                            <div class="option-box">
                                <div class='text-right mt-3 mb-3'>
                                    <span class='btn btn-primary remove-option'>Remove</span>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="control-label">English Name</label>
                                            <input class="form-control @if($errors->has('service_option_en.' . $i)) is-invalid @endif" type="text" name="service_option_en[]" placeholder="Enter English name" value="{{isset(old("service_option_en")[$i]) ? old("service_option_en")[$i] : null}}">
                                        </div>
                                        @error("service_option_en." . $i)
                                        <div class="input-error">{{$message}}</div>
                                        @enderror
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="control-label">Arabic Name</label>
                                            <input class="form-control @if($errors->has('service_option_ar.' . $i)) is-invalid @endif" type="text" name="service_option_ar[]" placeholder="Enter Arabic name" value="{{isset(old("service_option_ar")[$i]) ? old("service_option_ar")[$i] : null}}">
                                        </div>
                                        @error("service_option_ar." . $i)
                                        <div class="input-error">{{$message}}</div>
                                        @enderror
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="control-label">Adding Price</label>
                                            <input class="form-control @if($errors->has('price.' . $i)) is-invalid @endif" type="text" name="price[]" placeholder="Enter Price" value="{{isset(old("price")[$i]) ? old("price")[$i] : null}}">
                                        </div>
                                        @error("price." . $i)
                                        <div class="input-error">{{$message}}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            @endfor
                        @endif
                    </div>
                    <div class="col-lg-12">
                        <span class="btn btn-primary add-option"><i class="fas fa-plus"></i>  Add Option</span>
                    </div>
                    <div class="tile-footer">
                        <button class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Save</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
@section("scripts")
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
        $(".add-option").on("click",function(){
            let container = $(".options-container");
            let row = $("<div class='row'></div>");
            let box = $("<div class='option-box'></div>");


            let group1 = $("<div class='form-group'></div>");
            group1.append($("<label class='control-label'></label>").text("English name"));
            group1.append($('<input class="form-control" type="text" name="service_option_en[]" placeholder="Enter English name"">'));
            row.append($("<div class='col-lg-6'></div>").append(group1));


            let group2 = $("<div class='form-group'></div>");
            group2.append($("<label class='control-label'></label>").text("Arabic name"));
            group2.append($('<input class="form-control" type="text" name="service_option_ar[]" placeholder="Enter Arabic name"">'));
            row.append($("<div class='col-lg-6'></div>").append(group2));

            let group3 = $("<div class='form-group'></div>");
            group3.append($("<label class='control-label'></label>").text("Adding Price"));
            group3.append($('<input class="form-control" type="text" name="price[]" placeholder="Enter Adding Price"">'));
            row.append($("<div class='col-lg-6'></div>").append(group3));

            box.append($("<div class='text-right mt-3 mb-3'></div>").
            append($("<span class='btn btn-primary remove-option'>Remove</span>")));
            box.append(row);
            container.append(box.append(box));
            container.append($("hr"));
        });

        $(document).on("click",".remove-option",function (){
           $(this).parents(".option-box").remove();
        });

        $(document).on("click",".delete-option",function (){

           let optionId = $(this).data("option");
           let row = $(this).parents(".option-row");
            $.ajax({
                type: "POST",
                url:"/api/service/option/delete",
                data:{optionId: optionId}, // serializes the form's elements.
                success: function(response)
                {
                    if(response.status==1){
                         location.reload();
                    }
                    console.log(response);
                },
                error:function(){
                    console.error("you have error");
                }
            });
        });
    </script>

@endsection
