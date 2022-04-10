<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Rules\AlphaSpace;
use App\Rules\Password;
use App\Rules\HashMatching;
use App\Traits\Helper;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

use App\UsersDashboard;
use Illuminate\Http\Request;

class UsersDashboardController extends Controller
{
    use Helper;

    public function __construct(){
    }

    public function index(){
        if(!hasPermissions("admin-control"))
            abort("401");

        $data["users"] = UsersDashboard::where("id", "!=", Auth::user()->id)->get();
        return view("dashboard_users.index", $data);
    }

    public  function rules(){
        return [
            "full_name"     => ["required", "max:255"],
            "username"      => ["required", "max:255", "alpha_num", "unique:users_dashboards"],
            "email"         => ["required","email", "unique:users_dashboards"],
            "password"      => [ "required", new Password(), "confirmed"],
            "profile_photo" => [],
            "role"         => ["required", "exists:admin_roles,id"]
        ];
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(!hasPermissions("admin-control"))
            abort("401");

        $data["roles"] = Role::all();
        return view("dashboard_users.create",$data);
    }

    public function store(Request $request )
    {
        if(!hasPermissions("admin-control"))
            abort("401");

        $rules = $this->rules();
        if(!empty($request->file("profile_photo")))
            $rules["profile_photo"] = ["file", "mimes:jpg,jpeg,png,bmp","max:512"];
        $request->validate($rules);
        $user = new UsersDashboard();
        $user->full_name = $request->full_name;
        $user->username = $request->username;
        $user->email = $request->email;
        $user->password = $request->password;
        $user->role_id = $request->role;
        if(!empty($request->file("profile_photo"))){
            $photo_name = $this->upload($request->file("profile_photo"),$user->directory_path);
            $user->profile_photo = $photo_name;
        }
        $user->save();
        $this->setPageMessage("The Admin Has Been Created Successfully", 1);
        return redirect()->route("admins.index");
    }

    public function edit($id){
        if(!hasPermissions("admin-control"))
            abort("401");

        $data['user']   = UsersDashboard::findOrFail($id);
        if(Auth::user()->id == $id)
            redirect("admins.index");

        $data['roles']  = Role::all();
        return view("dashboard_users.edit",$data);
    }

    public function update(Request $request, $id){
        if(!hasPermissions("admin-control"))
            abort("401");

        $user = UsersDashboard::find($id);
        if(empty($request->password) && empty($request->password_confirmation)){
            $rules["password"] = [];
        }
        if(!empty($request->file("profile_photo")))
            $rules["profile_photo"] = ["file", "mimes:jpg,jpeg,png,bmp","max:512"];

        if($user->username === $request->username)
            $rules["username"] = [];
        if($user->email === $request->email)
            $rules["email"] = [];

        $request->validate($rules);

        $user->full_name = $request->full_name;
        $user->username = $request->username;
        $user->email = $request->email;
        $user->role_id = $request->role;
        if(isset($request->password) && !empty($request->password))
            $user->password = $request->password;
        if(!empty($request->file("profile_photo"))){
            $file = $user->directory_path . $user->profile_photo;
            if(File::exists($file)) {
                File::delete($file);
            }
            $photo_name = $this->upload($request->file("profile_photo"),$user->directory_path);
            $user->profile_photo = $photo_name;
        }
        $user->save();
        $this->setPageMessage("The User Has Been Updated Successfully", 1);
        return redirect()->route("admins.index");
    }



    public function profile(){
        $data['user'] = auth()->user();
        return view("profile", $data);
    }

    public function saveProfile(Request $request){
        $rules = $this->rules();
        $user = auth()->user();

        if(empty($request->password) && empty($request->password_confirmation) && empty($request->current_password)){
            $rules["password"] = [];
        }else{
            $rules["current_password"] = ["required", new HashMatching($user->password)];
        }
        if(!empty($request->file("profile_photo")))
            $rules["profile_photo"] = ["file", "mimes:jpg,jpeg,png,bmp","max:512"];

        if($user->username === $request->username)
            $rules["username"] = [];
        if($user->email === $request->email)
            $rules["email"] = [];

        $request->validate($rules);

        $user->full_name = $request->full_name;
        $user->username = $request->username;
        $user->email = $request->email;
        if(isset($request->password) && !empty($request->password))
            $user->password = $request->password;
        if(!empty($request->file("profile_photo"))){
            $file = $user->directory_path . $user->profile_photo;
            if(File::exists($file)) {
                File::delete($file);
            }
            $photo_name = $this->upload($request->file("profile_photo"),$user->directory_path);
            $user->profile_photo = $photo_name;
        }
        $user->save();
        $this->setPageMessage("The Profile Information Has Been Updated Successfully", 1);
        return redirect()->route("profile");
    }

    public function destroy(Request $request, $id){
        if(!hasPermissions("admin-control"))
            abort("401");

        UsersDashboard::findOrFail($id)->delete();
        $this->setPageMessage("The User Has Been Deleted Successfully", 0);
        return redirect()->route("admins.index");

    }

}
