<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\CategoryBranch;
use App\Models\CategoryList;
use App\Rules\AlphaSpace;
use App\Rules\ArAlphaSpace;
use App\Traits\Helper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class CategoryBranchController extends Controller
{
    use Helper;

    public function rules(){
        return [
            "name_en" => ["required", new AlphaSpace(), "max:255"],
            "name_ar" => ["required",new ArAlphaSpace(), "max:255"],
            "category_photo" => ["required", "file", "mimes:jpg,jpeg,png,bmp","max:512"],
        ];
    }
    public function fields_names(){
        return [
            "name_en" => "english category name",
            "name_ar" => "arabic category name",
        ];
    }
    public function index(){
        if(!hasPermissions(["create-branch-category" ,"edit-branch-category", "delete-branch-category"]))
            abort(401);
        $data["categories"] = CategoryBranch::all();
        return view("category_branch.index",$data);
    }

    public function create(){
        if(!hasPermissions("create-branch-category"))
            abort(401);
        return view("category_branch.create");
    }

    public function store(Request $request){
        if(!hasPermissions("create-branch-category"))
            abort(401);

        $request->validate($this->rules(), [], $this->fields_names());
        $category = new CategoryBranch();
        $category->name_en = $request->name_en;
        $category->name_ar = $request->name_ar;
        $category->status = 1;
        $photoName = $this->upload($request->file("category_photo"),$category->directory_path);
        $category->img_url = $category->img_path_url  . $photoName;
        $category->save();
        $this->setPageMessage("The Category Has Been Created Successfully");
        return redirect()->route("categories_branches.index");
    }

    public function edit($id){
        if(!hasPermissions("edit-branch-category"))
            abort(401);

        $data["category"] = CategoryBranch::findOrFail($id);
        return view("category_branch.edit",$data);
    }

    public function update(Request $request, $id){
        if(!hasPermissions("edit-category"))
            abort(401);

        $rules= $this->rules();
        if(empty($request->file("category_photo")))
            $rules["category_photo"] = [];
        $request->validate($rules, [], $this->fields_names());

        $category= CategoryBranch::findOrFail($id);
        $category->name_en = $request->name_en;
        $category->name_ar = $request->name_ar;
        $category->status = isset($request->status) ? 1 : 2;
        if(!empty($request->file("category_photo"))){
            $path_part = explode("/",$category->img_url);
            $path = $category->directory_path . end($path_part);
            if(File::exists($path)) {
                File::delete($path);
            }
            $photoName = $this->upload($request->file("category_photo"),$category->directory_path);
            $category->img_url = $category->img_path_url  . $photoName;
        }
        $category->save();
        $this->setPageMessage("The Category Has Been Updated Successfully");
        return redirect()->route("categories_branches.index");
    }

    public function destroy($id){
        if(!hasPermissions("delete-branch-category"))
            abort(401);

        $category = CategoryBranch::findOrFail($id);
        $path_part = explode("/",$category->img_url);
        $path = $category->directory_path . end($path_part);
        if(File::exists($path)) {
            File::delete($path);
        }

        $category->delete();
        $this->setPageMessage("The Category Has Been Deleted Successfully", 0);
        return redirect()->route("categories_branches.index");
    }
}
