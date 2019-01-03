<?php

namespace App\Http\Controllers;

use App\Category;
use App\City;
use App\Comment;
use App\Company;
use App\Country;
use App\Meeting;
use App\Project;
use App\Solution;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AdminController extends Controller
{
    //Login to admin
    public function login(Request $request){
        if($request->isMethod('post')){
            $data = $request->input();
            if(Auth::attempt(['email'=>$data['email'],'password'=>$data['password'], 'admin'=>'1'])){
                //echo "Success";die;
                Session::put('adminSession', $data['email']);
                return redirect('admin/dashboard');
            }else{
                //echo "Failed";die;
                return redirect('/admin')->with('flash_message_error', 'Invalid Username or Password');
            }
        }
        return view('admin.admin_login');
    }
    //Dashboard page
    public function dashboard(){
        $sessionUser = User::where(['email' => Auth::user()->email])->first();
        Session::put('userSession', $sessionUser['id']);
        if(Session::has('adminSession')){

        }else{
            return redirect('admin')->with('flash_message_error', 'Please login to access');
        }
        $meetings = Meeting::take(5)->orderBy('date_m','desc')->where(['finished' => 0])->get();
        $metCount = Meeting::count();
        $comments = Comment::where(['comment_id' => null])->take(5)->orderBy('created_at','desc')->get();
        $comCount = Comment::where(['comment_id' => null])->count();
        $replies = Comment::where(['comment' => null])->take(5)->orderBy('created_at','desc')->get();
        $repCount = Comment::where(['comment' => null])->count();
        $users = User::where(['company_id' => null])->take(5)->get();
        $projects = Project::take(5)->orderBy('date_p','desc')->get();
        $proCount = Project::count();
        $solutions = Solution::where(['finished' => 0])->get();
        $solCount = Solution::count();
        $useCount = User::count();
        $companies = Company::get();
        $compCount = Company::count();
        $citCount = City::count();
        $catCount = Category::count();
        $couCount = Country::count();
        $comrCount = Comment::where(['reply_id' => null, 'comment_id' => null])->count();
        $prorCount = Project::where(['finished' => 0])->count();
        $solrCount = Solution::where(['finished' => 0])->count();
        $metrCount = Meeting::where(['finished' => 0])->count();
        return view('admin.dashboard')->with(compact('meetings','metCount','comments','comCount',
                                                        'replies','repCount','users','useCount','companies',
                                                        'compCount','citCount','catCount','couCount','comrCount',
                                                        'projects','proCount','solutions','solCount','prorCount',
                                                        'solrCount','metrCount'));
    }
    //Administrator password
    public function settings(){
        $comrCount = Comment::where(['reply_id' => null, 'comment_id' => null])->count();
        $prorCount = Project::where(['finished' => 0])->count();
        $solrCount = Solution::where(['finished' => 0])->count();
        $metrCount = Meeting::where(['finished' => 0])->count();
        return view('admin.settings')->with(compact('comrCount','prorCount','solrCount','metrCount'));
    }
    //Check current password
    public function chkPassword(Request $request){
        $data = $request->all();
        $current_password = $data['current_pwd'];
        $check_password = User::where(['admin' => '1'])->first();
        if(Hash::check($current_password, $check_password->password)){
            echo "true";
        }else{
            echo "false";
        }
    }
    //Administrator password update
    public function updatePassword(Request $request){
        if($request->isMethod('post')){
            $data = $request->all();
            $check_password = User::where(['email' => Auth::user()->email])->first();
            $current_password = $data['current_pwd'];
            if(Hash::check($current_password, $check_password->password)){
                $password = bcrypt($data['new_pwd']);
                User::where('id', '1')->update(['password' => $password]);
                return redirect('/admin/settings')->with('flash_message_success', 'Password updated succesfully');
            }else{
                return redirect('/admin/settings')->with('flash_message_error', 'Incorrect current password');
            }
        }
    }
    //Logout from admin
    public function logout(){
        Session::flush();
        return redirect('/admin')->with('flash_message_success', 'Loged out Successfully');
    }
    //View documents
    public function viewDocuments(){
        $documents = Comment::whereNotNull('file')->orWhereNotNull('file_r')->get();
        $comrCount = Comment::where(['reply_id' => null, 'comment_id' => null])->count();
        $prorCount = Project::where(['finished' => 0])->count();
        $solrCount = Solution::where(['finished' => 0])->count();
        $metrCount = Meeting::where(['finished' => 0])->count();
        return view('admin.documents.documents_view')->with(compact('documents','comrCount','prorCount','solrCount','metrCount'));
    }
    //View reports
    public function viewReports(){
        $documents = Comment::whereNotNull('file')->orWhereNotNull('file_r')->get();
        $comrCount = Comment::where(['reply_id' => null, 'comment_id' => null])->count();
        $prorCount = Project::where(['finished' => 0])->count();
        $solrCount = Solution::where(['finished' => 0])->count();
        $metrCount = Meeting::where(['finished' => 0])->count();
        return view('admin.documents.documents_view')->with(compact('documents','comrCount','prorCount','solrCount','metrCount'));
    }
}