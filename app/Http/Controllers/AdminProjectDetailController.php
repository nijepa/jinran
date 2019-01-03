<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Meeting;
use App\Project;
use App\Project_Detail;
use App\Solution;
use App\Subtype;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminProjectDetailController extends Controller
{
    //Add project detail
    public function addProject(Request $request, $id = null){
        $projectID = $id;
        $subtypes = Subtype::get();
        $subtypes_dropdown = "<option selected disabled >Select Subtype</option>";
        foreach($subtypes as $sub){
            $subtypes_dropdown .= "<option value='" . $sub->id . "'>" . $sub->name . "</option>";
        }
        $comrCount = Comment::where(['reply_id' => null, 'comment_id' => null])->count();
        $prorCount = Project::where(['finished' => 0])->count();
        $solrCount = Solution::where(['finished' => 0])->count();
        $metrCount = Meeting::where(['finished' => 0])->count();
        if($request->isMethod('post')){
            $data = $request->all();
            $user = Auth::user();
            //echo "<pre>";print_r($data);die;
            $project = new Project_Detail;
            $project->project_id = $projectID;
            $project->date_pd = $data['date_pd'];
            $project->user_id = $user->id;
            $project->title = $data['title'];
            $project->description = $data['description'];
            $project->subtype_id = $data['subtype_id'];
            $project->save();
            return redirect('/admin/details-project/'. $projectID)->with('flash_message_success', 'Project detail added Successfully !');
        }
        return view('admin.projects_details.project_detail_add')->with(compact('subtypes_dropdown','projectID','comrCount','prorCount','solrCount','metrCount'));
    }
    //Edit project detail
    public function editProject(Request $request, $id = null){
        if($request->isMethod('post')){
            $data = $request->all();
            $projectID = $request->project_id;
            Project_Detail::where(['id'=>$id])->update(['title'=>$data['title'],
                'description'=>$data['description'],
                'subtype_id'=>$data['subtype_id']]);
            return redirect('/admin/details-project/'. $projectID)->with('flash_message_success', 'Project updated Successfully !');
        }
        $projectDetails = Project_Detail::where(['id' => $id])->first();
        $subtypes = Subtype::get();
        $subtypes_dropdown = "<option selected disabled >Select Subtype</option>";
        foreach($subtypes as $sub){
            if($sub->id == $projectDetails->subtype->id){
                $selected = "selected";
            }else{
                $selected = "";
            }
            $subtypes_dropdown .= "<option value='" . $sub->id . "' " . $selected . ">" . $sub->name . "</option>";
        }
        $comrCount = Comment::where(['reply_id' => null, 'comment_id' => null])->count();
        $prorCount = Project::where(['finished' => 0])->count();
        $solrCount = Solution::where(['finished' => 0])->count();
        $metrCount = Meeting::where(['finished' => 0])->count();
        return view('admin.projects_details.project_detail_edit')->with(compact('projectDetails', 'subtypes_dropdown','comrCount','prorCount','solrCount','metrCount'));
    }
    //Delete project detail
    public function deleteProject($id = null){
        if(!empty($id)){
            Project_Detail::where(['id'=>$id])->delete();
            return redirect()->back()->with('flash_message_success', 'Project deleted Successfully !');
        }
    }
    //Update project detail (set status active or not)
    public function updateProjectDetail(Request $request, $id = null)
    {
        $data = $request->all();
        Project_Detail::where(['id'=>$id])->update(['finished'=>$data['finished']]);
        return redirect()->back()->with('flash_message_success', 'Project detail status changed Successfully !');
    }
    //Project detail solutions
    public function detailsProject(Request $request, $id = null){
        $projectDetails = Project_Detail::where(['id' => $id])->first();
        $subtypes = Subtype::get();
        $subtypes_dropdown = "<option selected disabled >Select Subtype</option>";
        foreach($subtypes as $sub){
            if($sub->id == $projectDetails->subtype->id){
                $selected = "selected";
            }else{
                $selected = "";
            }
            $subtypes_dropdown .= "<option value='" . $sub->id . "' " . $selected . ">" . $sub->name . "</option>";
        }
        $solutions = Solution::where(['project_detail_id' => $id])->get();
        $comrCount = Comment::where(['reply_id' => null, 'comment_id' => null])->count();
        $prorCount = Project::where(['finished' => 0])->count();
        $solrCount = Solution::where(['finished' => 0])->count();
        $metrCount = Meeting::where(['finished' => 0])->count();
        return view('admin.projects_details.project_detail_solutions')->with(compact('projectDetails', 'subtypes_dropdown', 'solutions','comrCount','prorCount','solrCount','metrCount'));
    }
    //View project detail
    public function viewProjects(Request $request, $id = null){
        //$meetingDetails = Meeting_Detail::where(['meeting_id' => $id])->first();
        $projectDetails = Project_Detail::get();
        $subtypes = Subtype::get();
        $subtypes_dropdown = "<option selected disabled >Select Subtype</option>";
        foreach($subtypes as $sub){
            if($sub->id == $projectDetails->subtype->id){
                $selected = "selected";
            }else{
                $selected = "";
            }
            $subtypes_dropdown .= "<option value='" . $sub->id . "' " . $selected . ">" . $sub->name . "</option>";
        }
        $project = Project::where(['id' => $id])->first();
        $comrCount = Comment::where(['reply_id' => null, 'comment_id' => null])->count();
        $prorCount = Project::where(['finished' => 0])->count();
        $solrCount = Solution::where(['finished' => 0])->count();
        $metrCount = Meeting::where(['finished' => 0])->count();
        //$meetings = Meeting_Detail::get();
        return view('admin.projects_details.projects_details_view')->with(compact('projectDetails', 'project', 'subtypes_dropdown','comrCount','prorCount','solrCount','metrCount'));
    }
    //Export to PDF
    public function pdfMeeting(Request $request, $id = null){
        // Fetch all customers from database
        $data = Project_Detail::get();
        // Send data to the view using loadView function of PDF facade
        $pdf = PDF::loadView('admin/meetings/meeting_details_pdf',$data);
        // If you want to store the generated pdf to the server then you can use the store function
        $pdf->save(storage_path().'_filename.pdf');
        // Finally, you can download the file using download function
        return $pdf->download('meeting_details_pdf.pdf');
    }
}
