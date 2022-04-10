<?php
namespace App\Http\Controllers\Web;
use App\Exports\ExeclExport;
use App\Http\Controllers\Controller;
use App\Models\BranchTable;
use App\Models\CategoryList;
use App\Models\ItemGallery;
use App\Models\ItemsList;
use App\Models\ItemSizes;
use App\Models\ItemsColors;
use App\Models\Slider;
use App\Rules\AlphaSpace;
use App\Rules\ArAlphaSpace;
use App\Traits\Helper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Maatwebsite\Excel\Facades\Excel;

class ItemsListController extends Controller
{

    use Helper;

    public function rules(){
        return [
            "item_name_en" => ["required",  "max:255"],
            "item_name_ar" => ["required", "max:255"],
            "item_price" => ["required"],
            "item_tax" => ["required","numeric","between:0,99.99"],
            "branches_ids" => ["required"],
            "item_description_ar" => ["required"],
            "item_description_en" => ["required"],
            "category_id"=> ["required", "exists:category_list,id"],
            // "item_image" => ["required", "file", "mimes:jpg,jpeg,png,bmp","max:512"],
        ];
    }
    public function index(){
        
        $data["items"] = ItemsList::all();
        return view("items.index",$data);
    }

    public function exportAsExcel(){
        $items = ItemsList::all();
        return $this->downloadExcelFile(
            ["item_name_en", "item_name_ar", "item_price",
            "item_description_en", "item_description_ar",
            "custom" => ["name" => "item_status", "values" => [1 => "active", 2 => "not-active"]]
            ], $items,
            ["english name", "arabic name", "price", "english description", "arabic description","status"]);
    }

    public function create(){
        $data["categories"] = CategoryList::all();
        $data["branches"] = BranchTable::all();
        return view("items.create",$data);
    }

    public function store(Request $request){
 
        $request->validate($this->rules());
        $item = new ItemsList();
        $item->item_name_en = $request->item_name_en;
        $item->item_name_ar = $request->item_name_ar;
        $item->item_price = $request->item_price;
        $item->tax = $request->item_tax;
        $filename = $request->item_image[0]->getClientOriginalName();
        $item->item_image= "https://dashboard.cosmatics.digisolapps.com/uploads/items/".$filename;
        $item->item_description_ar = $request->item_description_ar;
        $item->item_description_en = $request->item_description_en;
        $item->category_id = $request->category_id;

        $item->item_status = 1;

        if($item->save()){
            $item->branches()->sync($request->branches_ids);

            $last_insertedId = $item->id;
                        foreach($request->color as $color){
                            $colorModel = new ItemsColors();
                            // var_dump($color);
                            $colorModel->item_id=$last_insertedId;
                            $colorModel->color=$color;
                       
                            $colorModel->save();
                    }
            $Allphoto=  $request->file("item_image");
            foreach ($Allphoto as $photo) {
                $filename = $photo->getClientOriginalName();
                $photo->move('uploads/gallery/',$filename);
//                $photo->storeAs('public/upload/gallery/', $filename);
                $ProjectPhoto = new ItemGallery();
                $ProjectPhoto->item_id = $last_insertedId;
                $ProjectPhoto->image_url  = "https://dashboard.cosmatics.digisolapps.com/uploads/items/".$filename;
                $ProjectPhoto->save();
            }



                        foreach($request->Size as $size){
                            $sizeModel = new ItemSizes();
                            $sizeModel->item_id=$last_insertedId;
                            $sizeModel->Size=$size;
                            $sizeModel->save();
                    }
        }
          $this->setPageMessage("The Item Has Been Created Successfully");
        return redirect()->route("items.index", ["lang" => app()->getLocale()]);
    }

    public function edit($id){
        $data["item"] = $item = ItemsList::findOrFail($id);
        $data["categories"] = CategoryList::all();
        $data["branches"] = BranchTable::all();
       

        // $itemDefaultBranches = [];
        // if($item->branches)
        //     foreach ($item->branches as $branch)
        //         $itemDefaultBranches[$branch->id] = true;
        // $data["itemDefaultBranches"] = $itemDefaultBranches;

        return view("items.edit",$data);
    }
    
    
    

    public function update(Request $request, $id){
        $rules= $this->rules();
        $item= ItemsList::findOrFail($id);

        if(empty($request->file("item_image")))
            $rules["item_image"] = [];
      
        
        $item_color= new ItemsColors();
        $item_color->delete(array(
            'item_id' => $id
            ));
            foreach($request->color as $color){
                $colorModel = new ItemsColors();
                $colorModel->item_id=$id;
                $colorModel->color=$color;
                   
                $colorModel->save();
            }
        $item_size= new ItemSizes();
        $item_size->delete(array(
            'item_id' => $id
            ));
         foreach($request->Size as $size){
                $sizeModel = new ItemSizes();
                $sizeModel->item_id=$id;
                $sizeModel->Size=$size;
                $sizeModel->save();
            }
        $request->validate($rules);


        $item->item_name_en = $request->item_name_en;
        $item->item_name_ar = $request->item_name_ar;
        $item->item_price = $request->item_price;
        $item->tax = $request->item_tax;
        // $item->$item_size->Size=$request->Size;
        // $item->$item_color->color=$request->color;
        $item->item_description_ar = $request->item_description_ar;
        $item->item_description_en = $request->item_description_en;
        $item->category_id = $request->category_id;
        $item->item_status = isset($request->item_status) ? 1 : 2;


        if(!empty($request->file("item_image"))){
            $path_part = explode("/",$item->item_image);
            $path = $item->directory_path . end($path_part);
            if(File::exists($path)) {
                File::delete($path);
            }
            $photoName = $this->upload($request->file("item_image"),$item->directory_path);
            $item->item_image = $item->img_path_url  . $photoName;
        }
        $item->save();
       
        $this->setPageMessage("The Items Has Been Updated Successfully");
    return redirect()->route("items.index", ["lang" => app()->getLocale()]);    }



    public function destroy($id){
        $item = ItemsList::findOrFail($id);
        $path_part = explode("/",$item->item_image);
        $path = $item->directory_path . end($path_part);
        if(File::exists($path)) {
            File::delete($path);
        }
        $item->delete();
        $this->setPageMessage("The Item Has Been Deleted Successfully", 0);
     return redirect()->route("items.index", ["lang" => app()->getLocale()]);
    }
    
       public function gallery(Request $request)
    {
        {
            $gallery = new ItemGallery();
//            $this->validate($request,[
//                "image_url"=>'required', 'file', 'mimes:jpg,jpeg,png,bmp','max:512'
//            ]);

            if($request->hasFile('image_url'))
            {
               $file=$request->file('image_url');
               $extension=$file->getClientOriginalExtension();
               $filename=time().'.'.$extension;
               $file->move('uploads/items/',$filename);
               $gallery->image_url=$filename;
                 $gallery->save();
                return redirect()->route("items.index", ["lang" => app()->getLocale()]);
            }
//            $photoName = $this->upload($request->file("image_url"),$gallery->directory_path);
//            $gallery->image_url = $gallery->img_path_url  . $photoName;
//            $item_id = $request->input('item_id');
//            $data=array('image_url'=>$gallery,"item_id"=>$item_id);
//            DB::table('item_galleries')->insert(array('image_url'=>$gallery,"item_id"=>$item_id));


        }


    }
}
