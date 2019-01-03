<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Company;
use App\Meeting;
use App\Project;
use App\Project_Detail;
use App\Solution;
use App\Type;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProjectController extends Controller
{
    //Add project
    public function addProject(Request $request){
        $companies = Company::get();
        $companies_dropdown = "<option selected disabled >Select company</option>";
        foreach($companies as $com){
            $companies_dropdown .= "<option value='" . $com->id . "'>" . $com->name . "</option>";
        }
        $types = Type::get();
        $types_dropdown = "<option selected disabled >Select Type</option>";
        foreach($types as $type){
            $types_dropdown .= "<option value='" . $type->id . "'>" . $type->name . "</option>";
        }
        if($request->isMethod('post')){
            $user = Auth::user();
            $data = $request->all();
            $project = new Project;
            $project->user_id = $user->id;
            $project->title = $data['title'];
            $project->description = $data['description'];
            $project->date_p = $data['date_p'];
            $project->company_id = $data['company_id'];
            $project->type_id = $data['type_id'];
            $project->save();
            return redirect('/admin/view-projects')->with('flash_message_success', 'Project added Successfully !');
        }
        $comrCount = Comment::where(['reply_id' => null, 'comment_id' => null])->count();
        $prorCount = Project::where(['finished' => 0])->count();
        $solrCount = Solution::where(['finished' => 0])->count();
        $metrCount = Meeting::where(['finished' => 0])->count();
        return view('admin.projects.project_add')->with(compact('companies_dropdown','types_dropdown','comrCount','prorCount','solrCount','metrCount'));
    }
    //Edit project
    public function editProject(Request $request, $id = null){
        if($request->isMethod('post')){
            $data = $request->all();
            Project::where(['id'=>$id])->update(['date_p'=>$data['date_p'],
                                                'company_id'=>$data['company_id'],
                                                'type_id'=>$data['type_id'],
                                                'title'=>$data['title'],
                                                'description'=>$data['description']]);
            return redirect('/admin/view-projects')->with('flash_message_success', 'Project updated Successfully !');
        }
        $projectDetails = Project::where(['id' => $id])->first();
        $companies = Company::get();
        $companies_dropdown = "<option selected disabled >Select Company</option>";
        foreach($companies as $com){
            if($com->id == $projectDetails->company->id){
                $selected = "selected";
            }else{
                $selected = "";
            }
            $companies_dropdown .= "<option value='" . $com->id . "' " . $selected . ">" . $com->name . "</option>";
        }
        $types = Type::get();
        $types_dropdown = "<option selected disabled >Select Type</option>";
        foreach($types as $typ){
            if($typ->id == $projectDetails->type->id){
                $selected = "selected";
            }else{
                $selected = "";
            }
            $types_dropdown .= "<option value='" . $typ->id . "' " . $selected . ">" . $typ->name . "</option>";
        }
        $projectDet = Project_Detail::where(['project_id' => $id])->get();
        $comrCount = Comment::where(['reply_id' => null, 'comment_id' => null])->count();
        $prorCount = Project::where(['finished' => 0])->count();
        $solrCount = Solution::where(['finished' => 0])->count();
        $metrCount = Meeting::where(['finished' => 0])->count();
        return view('admin.projects.project_edit')->with(compact('projectDetails','projectDet','companies_dropdown', 'types_dropdown', 'comrCount','prorCount','solrCount','metrCount'));
    }
    //Details project
    public function detailsProject(Request $request, $id = null){
        $projectDetails = Project::where(['id' => $id])->first();
        $companies = Company::get();
        $companies_dropdown = "<option selected disabled >Select Company</option>";
        foreach($companies as $com){
            if($com->id == $projectDetails->company->id){
                $selected = "selected";
            }else{
                $selected = "";
            }
            $companies_dropdown .= "<option value='" . $com->id . "' " . $selected . ">" . $com->name . "</option>";
        }
        $types = Type::get();
        $types_dropdown = "<option selected disabled >Select Type</option>";
        foreach($types as $typ){
            if($typ->id == $projectDetails->type->id){
                $selected = "selected";
            }else{
                $selected = "";
            }
            $types_dropdown .= "<option value='" . $typ->id . "' " . $selected . ">" . $typ->name . "</option>";
        }
        $projectDet = Project_Detail::where(['project_id' => $id])->get();
        $comrCount = Comment::where(['reply_id' => null, 'comment_id' => null])->count();
        $prorCount = Project::where(['finished' => 0])->count();
        $solrCount = Solution::where(['finished' => 0])->count();
        $metrCount = Meeting::where(['finished' => 0])->count();
        return view('admin.projects.project_details')->with(compact('projectDetails', 'companies_dropdown','types_dropdown', 'projectDet','comrCount','prorCount','solrCount','metrCount'));
    }
    //Update projects (set status active or not)
    public function updateProject(Request $request, $id = null)
    {
        $data = $request->all();
        Project::where(['id'=>$id])->update(['finished'=>$data['finished']]);
        return redirect()->back()->with('flash_message_success', 'Project status changed Successfully !');
    }
    //Delete project
    public function deleteProject($id = null){
        if(!empty($id)){
            Project::where(['id'=>$id])->delete();
            return redirect()->back()->with('flash_message_success', 'Project deleted Successfully !');
        }
    }
    //View projects
    public function viewProjects(){
        $projects = Project::get();
        $comrCount = Comment::where(['reply_id' => null, 'comment_id' => null])->count();
        $prorCount = Project::where(['finished' => 0])->count();
        $solrCount = Solution::where(['finished' => 0])->count();
        $metrCount = Meeting::where(['finished' => 0])->count();
        return view('admin.projects.projects_view')->with(compact('projects','comrCount','prorCount','solrCount','metrCount'));
    }
}
