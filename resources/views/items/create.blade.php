@extends("layouts.dashboard.app")

@section("page-nav-title")
    <div class="app-title">
        <div>
            <h1><i class="fa fa-dashboard"></i> Items</h1>
            <p>create new item</p>
        </div>
        <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
            <li class="breadcrumb-item"><a href="{{route("items.index",app()->getLocale())}}">Items</a></li>
            <li class="breadcrumb-item"><a href="#">Create</a></li>
        </ul>
    </div>
@endsection
@section("content")
    <div class="row">
        <div class="col-lg-10 m-auto">
            <div class="tile">
                <h3 class="tile-title">Create New Item</h3>
                <div class="tile-body">
                    <form method="post" action="{{route("items.store",app()->getLocale())}}" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="control-label">English Item Name</label>
                                    <input class="form-control @if($errors->has('item_name_en')) is-invalid @endif" type="text" name="item_name_en" placeholder="Enter English Item name" value="{{inputValue("item_name_en")}}">
                                </div>
                                @error("item_name_en")
                                <div class="input-error">{{$message}}</div>
                                @enderror
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="control-label">Arabic Item Name</label>
                                    <input class="form-control @if($errors->has('item_name_ar')) is-invalid @endif" type="text" name="item_name_ar" placeholder="Enter Arabic Item name" value="{{inputValue("item_name_ar")}}">
                                </div>
                                @error("item_name_ar")
                                <div class="input-error">{{$message}}</div>
                                @enderror
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="exampleSelect1">Category</label>
                                    <select class="form-control" id="exampleSelect1" name="category_id">
                                        <option value="">None</option>
                                        @foreach($categories as $category)
                                            <option value="{{$category->id}}" {{selected("category_id", $category->id)}}>{{$category->category_name_en}} ( {{$category->category_name_ar}} )</option>
                                        @endforeach
                                    </select>
                                </div>
                                @error("category_id")
                                <div class="input-error">{{$message}}</div>
                                @enderror
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="control-label">Item Price</label>
                                    <input class="form-control @if($errors->has('item_price')) is-invalid @endif" type="text" name="item_price" placeholder="Enter Item Price" value="{{inputValue("item_price")}}">
                                </div>
                                @error("item_price")
                                <div class="input-error">{{$message}}</div>
                                @enderror
                            </div>

                            <div class="col-lg-6" >
                                <div class="form-group">
                                    <label class="control-label">quantity</label>
                                    <input class="form-control @if($errors->has('quantity')) is-invalid @endif" type="text" name="quantity" placeholder="Enter Item quantity" value="{{inputValue("quantity")}}">
                                </div>
                                @error("item_tax")
                                <div class="input-error">{{$message}}</div>
                                @enderror
                            </div>


                            <div class="col-lg-6" >
                                <div class="form-group">
                                    <label class="control-label">Item Tax</label>
                                    <input class="form-control @if($errors->has('item_tax')) is-invalid @endif" type="text" name="item_tax" placeholder="Enter Item Tax" value="{{inputValue("item_tax")}}">
                                </div>
                                @error("item_tax")
                                <div class="input-error">{{$message}}</div>
                                @enderror
                            </div>




                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="control-label">Arabic Item Description</label>
                                    <textarea class="form-control @if($errors->has('item_description_ar')) is-invalid @endif" type="text" name="item_description_ar" style="height: 120px" placeholder="Enter Arabic Description">{{inputValue("item_description_ar")}}</textarea>
                                </div>
                                @error("item_description_ar")
                                <div class="input-error">{{$message}}</div>
                                @enderror
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="control-label">English Item Description</label>
                                    <textarea class="form-control @if($errors->has('item_description_en')) is-invalid @endif" type="text" name="item_description_en" style="height: 120px" placeholder="Enter English Description" >{{inputValue("item_description_en")}}</textarea>
                                </div>
                                @error("item_description_en")
                                <div class="input-error">{{$message}}</div>
                                @enderror
                            </div>
                            
                              <div class="col-lg-6">
                                   <div class="row">
                                       <div class="col-lg-12" id="ColorInput">
                                           <div class="col-lg-12">
                                               <div class="form-group">
                                                   <label class="form-control-label" for="input-username"> color</label>
                                                   <input type="text"  name="color[]" class="form-control" placeholder="color">
                                               </div>
                                           </div>
                                       </div>
                                       <div class="col-lg-12 text-right ">
                                           <span class="addColor btn btn-success btn-sm ">
                                               <i class="fa fa-plus"></i>
                                           </span>
                                       </div>
                                   </div>
                                </div>

                                  <div class="col-lg-6">
                                      <div class="row">
                                          <div id="SizeInput" class="col-lg-12">
                                              <div class="col-lg-12">
                                                  <div class="form-group">
                                                      <label class="form-control-label" for="input-username">  size</label>
                                                     <input type="text"  name="Size[]" class="form-control" placeholder="Size">
                                                 </div>
                                             </div>
                                          </div>
                                          <div class="col-lg-12 text-right">
                                           <span class="addSize btn btn-success btn-sm ">
                                               <i class="fa fa-plus"></i>
                                           </span>
                                          </div>
                                      </div>
                                </div>
                            
                            
                            
                        </div>


                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="exampleSelect1">Branches</label>
                                <select class="form-control @if($errors->has('branches_ids')) is-invalid @endif" id="demoSelect" multiple="" name="branches_ids[]">
                                    <optgroup label="Select Branches">
                                        @foreach($branches as $branch)
                                            <option value="{{$branch->id}}" >{{$branch->store_name}}</option>
                                        @endforeach
                                    </optgroup>

                                </select>
                            </div>

                            @error("branches_ids")
                            <div class="input-error">{{$message}}</div>
                            @enderror
                        </div>

                        <hr>


                        <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="control-label">Item Photo</label>
                                        <div>
                                            <button class="btn btn-primary form-control button-upload-file" >
                                                <input class="input-file show-uploaded" data-upload-type="single" data-imgs-container-class="uploaded-images" type="file" name="item_image[]" multiple="multiple">
                                                <span class="upload-file-content">
                                                <i class="fas fa-upload fa-lg upload-file-content-icon left"></i>
                                                <span class="upload-file-content-text">Upload Photo</span>
                                            </span>
                                            </button>
                                        </div>
                                    </div>
                                    @error("item_image")
                                    <div class="input-error">{{$message}}</div>
                                    @enderror
                                </div>
                                <div class="col-lg-3 col-md-5 col-sm-6">
                                    <div class="uploaded-images" ></div>
                                </div>
                            </div>
                        <div class="tile-footer">
                            <button class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Create</button>
                        </div>
                    </form>
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
    <script type="text/javascript" src="{{asset("assets/js/item.js")}}"></script>

@endsection
@include("items.template")
