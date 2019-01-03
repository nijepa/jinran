<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Company;
use App\Meeting;
use App\Photo;
use App\Project;
use App\Role;
use App\Solution;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Image;


class UserController extends Controller
{
    //Add user
    public function addUser(Request $request){
        $roles = Role::get();
        $roles_dropdown = "<option selected disabled >Select role</option>";
        foreach($roles as $rol){
            $roles_dropdown .= "<option value='" . $rol->id . "'>" . $rol->name . "</option>";
        }
        $companies = Company::get();
        $companies_dropdown = "<option selected disabled >Select company</option>";
        foreach($companies as $com){
            $companies_dropdown .= "<option value='" . $com->id . "'>" . $com->name . "</option>";
        }
        if($request->isMethod('post')){
            $data = $request->all();
            //echo "<pre>";print_r($data);die;
            $user = new User;
            $user->name = $data['name'];
            $user->email = $data['email'];
            $user->password = bcrypt($data['password']);
            $user->role_id = $data['role_id'];
            $user->company_id = $data['company_id'];
            if($request->hasFile('image')){
                $file = $request->file('image');
                $fileName = $file->getClientOriginalName();
                $name = time() . $fileName;
                $file->move('images/backend_images/users/', $name);
                $user->photo_id = $name;
            }
            /**if($request->hasFile('image')){
                $image_tmp = Input::file('image');
                if ($image_tmp->isValid()) {
                    // Upload Images after Resize
                    $extension = $image_tmp->getClientOriginalExtension();
                    $fileName = rand(111,99999).'.'.$extension;
                    $large_image_path = 'images/backend_images/users/large'.'/'.$fileName;
                    $medium_image_path = 'images/backend_images/users/medium'.'/'.$fileName;
                    $small_image_path = 'images/backend_images/users/small'.'/'.$fileName;
                    Image::make($image_tmp)->save($large_image_path);
                    Image::make($image_tmp)->resize(600, 600)->save($medium_image_path);
                    Image::make($image_tmp)->resize(300, 300)->save($small_image_path);
                    $user->photo_id = $fileName;
                }
            }**/
            $user->save();
            return redirect('/admin/view-users')->with('flash_message_success', 'User added Successfully !');
        }
        $comrCount = Comment::where(['reply_id' => null, 'comment_id' => null])->count();
        $prorCount = Project::where(['finished' => 0])->count();
        $solrCount = Solution::where(['finished' => 0])->count();
        $metrCount = Meeting::where(['finished' => 0])->count();
        return view('admin.users.user_add')->with(compact('roles_dropdown','companies_dropdown','comrCount','prorCount','solrCount','metrCount'));
    }
    //Edit user
    public function editUser(Request $request, $id = null)
    {
        if ($request->isMethod('post')) {
            $data = $request->all();
            if(empty($data['company_id'])){
                $compid = null;
            }else{
                $compid = $data['company_id'];
            }
            if(empty($data['role_id'])){
                $rolid = 3;
            }else{
                $rolid = $data['role_id'];
            }
            if($request->hasFile('image')){
                $file = $request->file('image');
                $fileName = $file->getClientOriginalName();
                $name = time() . $fileName;
                $file->move('images/backend_images/users/', $name);
            } else if (!empty($data['photo_cur'])) {
                $name = $data['photo_cur'];
            } else {
                $name = '';
            }
            /**if ($request->hasFile('image')) {
                $image_tmp = Input::file('image');
                if ($image_tmp->isValid()) {
                    // Upload Images after Resize
                    $extension = $image_tmp->getClientOriginalExtension();
                    $fileName = rand(111, 99999) . '.' . $extension;
                    $large_image_path = 'images/backend_images/product/large' . '/' . $fileName;
                    $medium_image_path = 'images/backend_images/product/medium' . '/' . $fileName;
                    $small_image_path = 'images/backend_images/product/small' . '/' . $fileName;
                    Image::make($image_tmp)->save($large_image_path);
                    Image::make($image_tmp)->resize(600, 600)->save($medium_image_path);
                    Image::make($image_tmp)->resize(300, 300)->save($small_image_path);
                }
            } else if (!empty($data['photo_cur'])) {
                $fileName = $data['photo_cur'];
            } else {
                $fileName = '';
            }**/
            User::where(['id' => $id])->update(['name' => $data['name'],
                'email' => $data['email'],
                'password' => $data['password'],
                'role_id' => $rolid,
                'company_id' => $compid,
                'photo_id' => $name]);
            return redirect('/admin/view-users')->with('flash_message_success', 'User updated Successfully !');
        }
        $userDetails = User::where(['id' => $id])->first();
        $roles = Role::get();
        $roles_dropdown = "<option selected disabled >Select role</option>";
        foreach ($roles as $rol) {
            if($userDetails->role_id != null){
                if ($rol->id == $userDetails->role->id) {
                    $selected = "selected";
                } else {
                    $selected = "";
                }
            $roles_dropdown .= "<option value='" . $rol->id . "' " . $selected . ">" . $rol->name . "</option>";
            }else{
                $selected = "";
                $roles_dropdown .= "<option value='" . $rol->id . "' " . $selected . ">" . $rol->name . "</option>";
            }
        }
        $companies = Company::get();
        $companies_dropdown = "<option selected disabled >Select company</option>";
        foreach ($companies as $com) {
            if ($userDetails->company_id != null) {
                if ($com->id == $userDetails->company->id) {
                    $selected = "selected";
                } else {
                    $selected = "";
                }
                $companies_dropdown .= "<option value='" . $com->id . "' " . $selected . ">" . $com->name . "</option>";
            }else{
                $selected = "";
                $companies_dropdown .= "<option value='" . $com->id . "' " . $selected . ">" . $com->name . "</option>";
            }
        }
        $comrCount = Comment::where(['reply_id' => null, 'comment_id' => null])->count();
        $prorCount = Project::where(['finished' => 0])->count();
        $solrCount = Solution::where(['finished' => 0])->count();
        $metrCount = Meeting::where(['finished' => 0])->count();
        return view('admin.users.user_edit')->with(compact('userDetails', 'roles_dropdown', 'companies_dropdown','comrCount','prorCount','solrCount','metrCount'));
    }
    //Delete user
    public function deleteUser($id = null){
        if(!empty($id)){
            User::where(['id'=>$id])->delete();
            return redirect()->back()->with('flash_message_success', 'User deleted Successfully !');
        }
    }
    //View users
    public function viewUsers(){
        $users = User::get();
        $comrCount = Comment::where(['reply_id' => null, 'comment_id' => null])->count();
        $prorCount = Project::where(['finished' => 0])->count();
        $solrCount = Solution::where(['finished' => 0])->count();
        $metrCount = Meeting::where(['finished' => 0])->count();
        return view('admin.users.users_view')->with(compact('users','comrCount','prorCount','solrCount','metrCount'));
    }
    //Delete user image
    public function deleteUserImage($id = null){
        $user = User::findOrFail($id);
        unlink('images/backend_images/users/' . $user->photo_id);
        User::where(['id'=>$id])->update(['photo_id'=>'']);
        return redirect()->back()->with('flash_message_success', 'User image deleted Successfully !');
    }
}
