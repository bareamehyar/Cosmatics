<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category_service;
use App\Models\Category_service_option;
use App\Models\ItemsList;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use App\Traits\Helper;
use Illuminate\Support\Facades\DB;
use App\Models\AddOnsList;
use App\Models\AddOnsTitle;


class servicesController extends Controller
{    use Helper;


        public function rules(){
        return [
            "service_name_en"   => ["required"],
            "service_name_ar"   => ["required"],
            "choice_type"       => ["required", "in:1,2"],
            "service_option_en.*" => ["required"],
            "service_option_ar.*" => ["required"],
            "price.*"           => ["required", "numeric", "min:0"]
        
        ];
        }
        
        public function attributes(){
        return [
        
            "service_option_en.*"   => "English name",
            "service_option_ar.*"   => "Arabic name",
            "price.*"             => "Price",
        
        ];
        }
    
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data["category_services"]=Category_service::all();
        return view("services.index",$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view("services.create");
    }

    public function link(){
        
    $data["Category_services"]=Category_service::all();
    $data["ItemsLists"]=ItemsList::all();
    return view("services.LinkService",$data);
    }
    
    
    public function linkItem(Request $request){
        
        
        $request->validate(["Service"=>"required","Item"=>"required"]);
        
        $Service=$request->Service;
        $ItemsID=$request->Item;
         $array=[];
        foreach($ItemsID as $ItemID){
           
        
     
        for($i=0;$i<count($Service);$i++){
            
           $category_service=Category_service::find($Service[$i]);
            if(!empty($category_service)){
                
                
            $addOn = new AddOnsTitle();
            $addOn->add_ons_name_en = $category_service->service_name_en;
            $addOn->add_ons_name_ar = $category_service->service_name_ar;
            $addOn->item_id = $ItemID;
            $addOn->which_choice = $category_service->which_choice;
            if($addOn->save()){
                    $category_services_options= DB::table("category_services")->where("category_services.id",$Service[$i])->join("category_service_options","category_services.id","=","category_service_options.service_id")->get(["category_service_options.service_option_en","category_service_options.service_option_ar","category_service_options.price"]);
                    foreach($category_services_options as $category_service_option ){
                        $option = new AddOnsList([
                        "add_ons_list_en"   => $category_service_option->service_option_en,
                        "add_ons_list_ar"   => $category_service_option->service_option_ar,
                        "price"             => $category_service_option->price
                    ]);
                    $addOn->addOnsList()->save($option);
                    
                    }
                
            }
            }
                
            }

 
           
         }

        
           return redirect()->route("services.index");
           
        }
        

   
       
       
    
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        
       
        
            
        $rules = $this->rules();
        $valid = Validator::make($request->all(), $rules);
        $valid->setAttributeNames($this->attributes());
        $numberOptions = count($request->service_option_en);

        if($valid->fails()){
            Session::put("options_count" , $numberOptions);
            return redirect()->back()->withErrors($valid->errors())->withInput($request->all());
        }else{
            $addOn = new Category_service();
            $addOn->service_name_en = $request->service_name_en;
            $addOn->service_name_ar = $request->service_name_ar;

            $addOn->which_choice = $request->choice_type;
            if($addOn->save()){
                for ($i=0; $i < $numberOptions;$i++){
                    $option = new Category_service_option([
                        "service_option_en"   => $request->service_option_en[$i],
                        "service_option_ar"   => $request->service_option_ar[$i],
                        "price"             => $request->price[$i],
                    ]);
                    $addOn->Category_service_option()->save($option);
                }
            }

        }
        $this->setPageMessage("The Add service Been Created Successfully", 1);
        return redirect()->route("services.index");
        
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $data["category_services"] = Category_service::findOrFail($id);
 
        if(Session::has("options_count")){
        //var_dump(Session::get("options_count"));die;
        $data["options_selected"] = Session::get("options_count");
        Session::remove("options_count");
        }
        return view("services.edit",$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        
    
        $rules = $this->rules();
        $valid = Validator::make($request->all(), $rules);
        $valid->setAttributeNames($this->attributes());

        if(!isset($request->service_option_en)){
         
            $rules = [
                "service_option_en.*" => [],
                "service_option_ar.*" => [],
                "price.*"           => []
            ];
        }else{
            
            $numberOptions = count($request->service_option_en);
        }

        if($valid->fails()){
            if(isset($numberOptions)){
                Session::put("options_count" , $numberOptions);
            }
            return redirect()->back()->withErrors($valid->errors())->withInput($request->all());
        }else{
            $addOn = Category_service::findOrFail($id);
            $addOn->service_name_en = $request->service_name_en;
            $addOn->service_name_ar = $request->service_name_ar;
            $addOn->which_choice = $request->choice_type;
            if($addOn->save()){
                if(isset($numberOptions)){
                    for ($i=0; $i < $numberOptions;$i++){
                        $option = new Category_service_option([
                            "service_option_en"   => $request->service_option_en[$i],
                            "service_option_ar"   => $request->service_option_ar[$i],
                            "price"             => $request->price[$i],
                        ]);
                        $addOn->Category_service_option()->save($option);
                    }
                }
            }

        }

        $this->setPageMessage("The  service  Has Been Updated Successfully", 1);
        return redirect()->route("services.index");
        
        
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        
        Category_service::find($id)->delete();
        $this->setPageMessage("The service Has Been Deleted Successfully",0);
        return redirect()->route("services.index");
    }
    
    
    
    
        public function destroyOption(Request $request)
    {
        $data["status"] =0;
        $option = Category_service_option::find($request->optionId);
        
        if($option){
            
            $totalOptions = Category_service_option::where("service_id", "=", $option->service_id)->count();
      
            if($totalOptions > 1){
                $option->delete();
                $data["status"] = 1;
            }
        }
        return response()->json($data);

    }
}
