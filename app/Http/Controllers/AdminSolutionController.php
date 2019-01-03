<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Meeting;
use App\Project;
use App\Project_Detail;
use App\Solution;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminSolutionController extends Controller
{
    //Add solution
    public function addSolution(Request $request, $id = null){
        $projectID = $id;
        $comrCount = Comment::where(['reply_id' => null, 'comment_id' => null])->count();
        $prorCount = Project::where(['finished' => 0])->count();
        $solrCount = Solution::where(['finished' => 0])->count();
        $metrCount = Meeting::where(['finished' => 0])->count();
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
            $solution->is_admin = 1;
            $solution->save();
            return redirect('/admin/detail-project-solutions/'. $projectID)->with('flash_message_success', 'Solution added Successfully !');
        }
        return view('admin.solutions.solution_add')->with(compact('projectID','comrCount','prorCount','solrCount','metrCount'));
    }
    //Edit solution
    public function editSolution(Request $request, $id = null){
        if($request->isMethod('post')){
            $data = $request->all();
            if($request->hasFile('file')){
                $file = $request->file('file');
                $fileName = $file->getClientOriginalName();
                $name = time() . $fileName;
                $file->move('images/backend_images/solutions/', $name);

            } else if (!empty($data['photo_cur'])) {
                $name = $data['photo_cur'];
            } else {
                $name = '';
            }
            $projectID = $request->project_id;
            Solution::where(['id'=>$id])->update(['date_s'=>$data['date_s'],
                                                'description'=>$data['description'],
                                                'file'=>$name]);
            return redirect('/admin/view-solutions/'. $projectID)->with('flash_message_success', 'Solution updated Successfully !');
        }
        $solutions = Solution::where(['id' => $id])->first();
        $comrCount = Comment::where(['reply_id' => null, 'comment_id' => null])->count();
        $prorCount = Project::where(['finished' => 0])->count();
        $solrCount = Solution::where(['finished' => 0])->count();
        $metrCount = Meeting::where(['finished' => 0])->count();
        return view('admin.solutions.solution_edit')->with(compact('solutions', 'comrCount','prorCount','solrCount','metrCount'));
    }
    //Delete solution
    public function deleteSolution($id = null){
        if(!empty($id)){
            Solution::where(['id'=>$id])->delete();
            return redirect()->back()->with('flash_message_success', 'Solution deleted Successfully !');
        }
    }
    //Update solutions (set status active or not)
    public function updateSolution(Request $request, $id = null)
    {
        $data = $request->all();
        Solution::where(['id'=>$id])->update(['finished'=>$data['finished']]);
        return redirect()->back()->with('flash_message_success', 'Solution status changed Successfully !');
    }
    //View solutions
    public function viewSolutions(){
        //$meetingDetails = Meeting_Detail::where(['meeting_id' => $id])->first();
        $solutions = Solution::get();
        $project = Project_Detail::get();
        $comrCount = Comment::where(['reply_id' => null, 'comment_id' => null])->count();
        $prorCount = Project::where(['finished' => 0])->count();
        $solrCount = Solution::where(['finished' => 0])->count();
        $metrCount = Meeting::where(['finished' => 0])->count();
        //$meetings = Meeting_Detail::get();
        return view('admin.solutions.solutions_view')->with(compact('solutions', 'project','comrCount','prorCount','solrCount','metrCount'));
    }
    //Delete solution file
    public function deleteSolutionFile($id = null){
        $solution = Solution::findOrFail($id);
        unlink('images/backend_images/solutions/' . $solution->file);
        //$solution->delete();
        Solution::where(['id'=>$id])->update(['file'=>'']);
        return redirect()->back()->with('flash_message_success', 'Solution document deleted Successfully !');
    }
}
