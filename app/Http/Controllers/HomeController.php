<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Company;
use App\Meeting;
use App\Meeting_Detail;
use App\Project;
use App\Project_Detail;
use App\Solution;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sessionUser = User::where(['email' => Auth::user()->email])->first();
        Session::put('userSession', $sessionUser['id']);
        Session::put('userSessionRole', $sessionUser['role_id']);
        Session::put('userSessionCompany', $sessionUser['company_id']);

        $value = Session::get('userSessionRole');
        if($value != 3){
            $value = Session::get('userSessionRole');
            $user_company = Session::get('userSessionCompany');
            if($value != 1) {
                $value = Session::get('userSessionCompany');
                $meetings = Meeting::where(['company_id' => $value,'finished'=>0])->get();
                $projects = Project::where(['company_id' => $value,'finished'=>0])->get();
                $solutions = \App\Solution::join('project__details', 'project__details.id', '=', 'solutions.project_detail_id')
                    ->join('projects', 'projects.id', '=', 'project__details.project_id')
                    ->join('users', 'users.id', '=', 'solutions.user_id')
                    ->select('users.*','solutions.*','solutions.description as desc')
                    ->where(['projects.company_id' => $user_company,'solutions.finished' => 0])
                    ->get();
                /**$solutions = DB::table('solutions','users')
                    ->join('project__details', 'project__details.id', '=', 'solutions.project_detail_id')
                    ->join('projects', 'projects.id', '=', 'project__details.project_id')
                    ->join('users', 'users.id', '=', 'solutions.user_id')
                    ->where(['projects.company_id' => $user_company,'solutions.finished' => 0])
                    ->get();**/
                $replies = DB::table('comments','users')
                    ->join('meeting__details', 'meeting__details.id', '=', 'comments.meeting_detail_id')
                    ->join('meetings', 'meetings.id', '=', 'meeting__details.meeting_id')
                    ->join('users', 'users.id', '=', 'comments.user_id')
                    ->where(['meetings.company_id' => $user_company, 'checked' => 0,'comment' => null])
                    ->get();
                //$replies = Comment::where(['checked' => 0,'comment' => null])->get();
                //$solutions = Solution::where(['finished' => 0])->get();
            }else{
                $meetings = Meeting::get();
                $projects = Project::get();
                $replies = Comment::where(['checked' => 0,'comment' => null])->get();
                $solutions = Solution::where(['finished' => 0])->get();
            }
            //$user_company = Session::get('userSessionCompany');
            $company = Company::where(['id' => $user_company])->get();
        }else{
            Session::flush();
            return redirect('login')->with('flash_message_error', 'You dont have rights to access, please wait for email.');
        }
        return view('home')->with(compact('meetings','projects','replies',$replies,'solutions','company'));
    }

    public function about(){
        return view('author.about');
    }

    public function contact(){
        return view('author.contact');
    }

    //View meetings
    public function meetings(){
        $user_company = Session::get('userSessionCompany');
        $company = Company::where(['id' => $user_company])->get();
        $value = Session::get('userSessionRole');
        if($value != 1) {
            $value = Session::get('userSessionCompany');
            $meetings = Meeting::where(['company_id' => $value])->get();
        }else{
            $meetings = Meeting::get();
        }
        //$meetings = Meeting::get();
        return view('author.meetings')->with(compact('meetings','company'));
    }

    //View meetings details
    public function meetings_details(Request $request, $id = null){
        $meetings = Meeting::where(['id' => $id])->first();
        $meetingDet = Meeting_Detail::where(['meeting_id' => $id])->get();
        $companies = Company::get();
        $companies_dropdown = "<option selected disabled >Select Company</option>";
        foreach($companies as $com){
            if($com->id == $meetings->company->id){
                $selected = "selected";
            }else{
                $selected = "";
            }
            $companies_dropdown .= "<option value='" . $com->id . "' " . $selected . ">" . $com->name . "</option>";
        }
        //$meetings = Meeting::get();
        return view('author.meetings_details')->with(compact('meetings','meetingDet','companies_dropdown'));
    }

    //View comments
    public function comments(Request $request, $id = null){
        $user_company = Session::get('userSessionCompany');
        //$meeting = Meeting::where(['company_id' => $user_company])->first();
        //$replies = Reply::where(['meeting_id'=>$id])->all();
        $meetings = Meeting_Detail::where(['id' => $id])->first();
        $meeting = Meeting::where(['id' => $meetings->meeting_id])->first();
        $comments = Comment::where(['meeting_detail_id' => $id])->get();
        return view('author.comments')->with(compact('meetings','comments','meeting','replies'));
    }

    public function updateComments(Request $request, $id){
        Comment::findOrFail($id)->update($request->all());
        return redirect('/admin/comments');
    }

    //View projects
    public function projects(){
        $user_company = Session::get('userSessionCompany');
        $company = Company::where(['id' => $user_company])->get();
        $value = Session::get('userSessionRole');
        if($value != 1) {
            $value = Session::get('userSessionCompany');
            $projects = Project::where(['company_id' => $value])->get();
        }else{
            $projects = Project::get();
        }
        return view('author.projects')->with(compact('projects','company'));
    }

    //View projects details
    public function projects_details(Request $request, $id = null){
        $projects = Project::where(['id' => $id])->first();
        $projectDet = Project_Detail::where(['project_id' => $id])->get();
        $companies = Company::get();
        $companies_dropdown = "<option selected disabled >Select Company</option>";
        foreach($companies as $com){
            if($com->id == $projects->company->id){
                $selected = "selected";
            }else{
                $selected = "";
            }
            $companies_dropdown .= "<option value='" . $com->id . "' " . $selected . ">" . $com->name . "</option>";
        }
        return view('author.projects_details')->with(compact('projects','projectDet','companies_dropdown'));
    }

    //View solutions
    public function solutions(Request $request, $id = null){
        $user_company = Session::get('userSessionCompany');
        $projects = Project_Detail::where(['id' => $id])->first();
        $project = Project::where(['id' => $projects->project_id])->first();
        $solutions = Solution::where(['project_detail_id' => $id])->get();
        return view('author.solutions')->with(compact('projects','solutions','project'));
    }

    //Update solutions (set status active or not)
    public function updateSolution(Request $request, $id = null)
    {
        $data = $request->all();
        Solution::where(['id'=>$id])->update(['finished'=>$data['finished']]);
        return redirect()->back()->with('flash_message_success', 'Solution status changed Successfully !');
    }

    //Add solution
    public function addSolution(Request $request, $id = null){
        $projectID = $id;
        if($request->isMethod('post')){
            $data = $request->all();
            $user = Auth::user();
            //echo "<pre>";print_r($data);die;
            $solution = new Solution;
            if($file = $request->file('file')) {
                $fileName = $file->getClientOriginalName();
                $name = time() . $fileName;
                $file->move('images/backend_images/solutions', $name);
                $solution->file = $name;
            }
            $solution->project_detail_id = $projectID;
            $solution->date_s = $data['date_s'];
            $solution->user_id = $user->id;
            $solution->description = $data['description'];
            $solution->save();
            return redirect()->back()->with('flash_message_success', 'Solution added Successfully !');
        }
       // return view('admin.solutions.solution_add')->with(compact('projectID','comrCount','prorCount','solrCount'));
    }

}
