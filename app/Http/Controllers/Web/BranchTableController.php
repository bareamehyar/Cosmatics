<?php

namespace App\Http\Controllers\Web;

use App\Helpers\GoogleMaps;
use App\Http\Controllers\Controller;
use App\Models\BranchTable;
use App\Models\BranchTableImages;
use App\Models\CategoryBranch;
use App\Models\ItemsList;
use App\Models\Slider;
use App\Rules\JoMobile;
use App\Rules\MapCheck;
use App\Traits\ApiResponse;
use App\Traits\Helper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use function PHPUnit\Framework\isEmpty;

class BranchTableController extends Controller
{
    use Helper,ApiResponse;



    protected function rules(){
        return [
            "branch_name"    => ["required", "unique:branch_table,store_name"],
            "phone_number"  => ["required", new JoMobile()],
            "category_id" => ["required" ,"exists:App\Models\CategoryBranch,id"],
            "img"       => ["required", "file", "mimes:jpg,jpeg,png,bmp","max:512"],
            "location"      => [new MapCheck()]
        ];
    }

    public function fields_names(){
        return [
            "category_id" => "category",
        ];
    }

    public function index(){
        if(!hasPermissions(["create-branch" ,"edit-branch", "delete-branch", "control-sliders-branches"]))
            return abort("401");

        $data["branchs"] =  BranchTable::all();

        return view("branch.index",$data);
    }
    public function create(){

        if(!hasPermissions("create-branch"))
            return abort("401");

        $data["categories"] = CategoryBranch::all();

        return view("branch.create",$data);

    }
    public function store(Request $request){
        if(!hasPermissions("create-branch"))
            return abort("401");

        $request->request->add(['location' => ["lat" => $request->latitude, "lng" => $request->longitude]]);
        $request->validate($this->rules(), [], $this->fields_names());

        $branch = new BranchTable();
        $branch->store_name = $request->branch_name;
        $branch->phone_number = $request->phone_number;
       $photoName = $this->upload($request->file("branch_photo"),$branch->directory_path);
        $branch->img_url = $branch->img_path_url  . $photoName;
        $branch->save();
        $this->setPageMessage("The Category Has Been Created Successfully");
        return redirect()->route("categories_branches.index");
      

    }
    public function edit($id){
        if(!hasPermissions("edit-branch"))
            return abort("401");
        $data['branch'] = $branch = BranchTable::findOrFail($id);
        $data["categories"] = CategoryBranch::all();

        return view("branch.edit",$data);

    }
    public function update(Request $request, $id){
        if(!hasPermissions("edit-branch"))
            return abort("401");

        $rules = $this->rules();
        $branch = BranchTable::findOrFail($id);

        if($request->branch_name == $branch->store_name){
            $rules["branch_name"] = [];
        }

        if(empty($request->file("img")))
            $rules["img"] = [];
        $request->request->add(['location' => ["lat" => $request->latitude, "lng" => $request->longitude]]);
        $request->validate($rules, [], $this->fields_names());
        $branch->store_name = $request->branch_name;
        $branch->phone_number = $request->phone_number;
        $branch->category_id = $request->category_id;

        if($request->file("img")){
            $path_part = explode("/",$branch->img_url);
            $path = $branch->imgPath . end($path_part);
            if(File::exists($path)) {
                File::delete($path);
            }
            $imgName = $this->upload($request->file("img"), $branch->imgPath);
            $branch->img_url = $branch->imgPathUrl . $imgName;
        }
        if($branch->latitude != $request->latitude || $branch->longitude != $request->longitude){
            $branch->latitude = $request->latitude;
            $branch->longitude = $request->longitude;
            $branch->address = GoogleMaps::getAddressFromCoordinates($request->latitude, $request->longitude);
        }
        $branch->save();
        $this->setPageMessage("The Branch Has Been Updated Successfully", 1);

        return redirect()->route("branches.index");
    }

    public function slider($id){
        if(!hasPermissions("control-sliders-branches"))
            return abort("401");

        $data['branch'] = BranchTable::findOrFail($id);

        return view("branch.slider",$data);
    }

    public function deleteSlider(Request $request){

        $data["status"] = 0;
        $data["s"] = $request->sliderId;
        $slider = BranchTableImages::find($request->sliderId);
        if($slider){
            $path_part = explode("/",$slider->image_url);
            $path = $slider->directory_path . end($path_part);
            if(File::exists($path)) {
                File::delete($path);
            }
            $slider->delete();
            $data["status"] = 1;
        }
        return response()->json($data);
    }

    public function saveSlider(Request $request){
        if(!hasPermissions("control-sliders-branches"))
            abort(401);
        //return empty($request->file("images"));
        $valid = Validator::make($request->all(),["images.*" => ["file", "mimes:jpg,jpeg,png,bmp","max:512"]]);
        $valid->setAttributeNames(["images.*" => "images"]);

        if($valid->fails()){
            return redirect()->back()->withErrors($valid->errors());
        }else{
            if(!empty($request->file("images"))){
                foreach ($request->file("images") as $img){
                    $slider = new BranchTableImages();
                    $slider->branch_id = $request->branch_id;
                    $photoName = $this->upload($img,$slider->directory_path);
                    $slider->image_url = $slider->img_path_url . $photoName;
                    $slider->save();
                }
                $this->setPageMessage("The Branch Slider Has Been Updated Successfully", 1);
            }
            return redirect()->route("branches.index");
        }

    }


    public function destroy(Request $request,$id){
        if(!hasPermissions("delete-branch"))
            abort(401);
        if(BranchTable::findOrFail($id)->delete())
            $this->setPageMessage("The Branch Has Been Deleted Successfully", 0);
        return redirect()->route("branches.index");
    }

    public function getByItem($id){
        $item = ItemsList::find($id);
        $branches = null;
        if($item->branches){
            foreach ($item->branches as $branch){
                $data["id"] = $branch->id;
                $data["name"] = $branch->store_name;
                $branches[] = $data;
            }
        }
        return $this->sendData($branches);
    }

    public function getByCategory($id){

        $branches = DB::table("items_list")->select("branch_table.*")
            ->join("items_branches", "items_branches.item_id","=","items_list.id")
            ->join("branch_table", "branch_table.id","=","items_branches.branch_id")
            ->where("items_list.category_id", $id)->groupBy("branch_table.id")->get();

        $data = null;
        if(isset($branches[0])){
            foreach ($branches as $branch){
                $dataBranch["id"] = $branch->id;
                $dataBranch["name"] = $branch->store_name;
                $data[] = $dataBranch;
            }
        }
        return $this->sendData($data);
    }
}
