<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Company;
use App\Meeting;
use App\Meeting_Detail;
//use Barryvdh\DomPDF\PDF;
use App\Project;
use App\Solution;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PDF;

class AdminMeetingDetailController extends Controller
{
    //Add meeting
    public function addMeeting(Request $request, $id = null){
        $meetingID = $id;
        $companies = Company::get();
        $companies_dropdown = "<option selected disabled >Select company</option>";
        foreach($companies as $com){
            $companies_dropdown .= "<option value='" . $com->id . "'>" . $com->name . "</option>";
        }
        $comrCount = Comment::where(['reply_id' => null, 'comment_id' => null])->count();
        $prorCount = Project::where(['finished' => 0])->count();
        $solrCount = Solution::where(['finished' => 0])->count();
        $metrCount = Meeting::where(['finished' => 0])->count();
        if($request->isMethod('post')){
            $data = $request->all();
            $user = Auth::user();
            //echo "<pre>";print_r($data);die;
            $meeting = new Meeting_Detail;
            $meeting->meeting_id = $meetingID;
            $meeting->user_id = $user->id;
            $meeting->title = $data['title'];
            $meeting->description = $data['description'];
            $meeting->company_id = $data['company_id'];
            $meeting->save();
            return redirect('/admin/details-meeting/'. $meetingID)->with('flash_message_success', 'Meeting detail added Successfully !');
        }
        return view('admin.meetings_details.meeting_detail_add')->with(compact('companies_dropdown','meetingID','comrCount','prorCount','solrCount','metrCount'));
    }
    //Edit meeting
    public function editMeeting(Request $request, $id = null){
        if($request->isMethod('post')){
            $data = $request->all();
            Meeting_Detail::where(['id'=>$id])->update(['title'=>$data['title'],
                                                        'description'=>$data['description'],
                                                        'company_id'=>$data['company_id']]);
            return redirect('/admin/view-meetings')->with('flash_message_success', 'Meeting updated Successfully !');
        }
        $meetingDetails = Meeting_Detail::where(['id' => $id])->first();
        $companies = Company::get();
        $companies_dropdown = "<option selected disabled >Select Company</option>";
        foreach($companies as $com){
            if($com->id == $meetingDetails->company->id){
                $selected = "selected";
            }else{
                $selected = "";
            }
            $companies_dropdown .= "<option value='" . $com->id . "' " . $selected . ">" . $com->name . "</option>";
        }
        $comrCount = Comment::where(['reply_id' => null, 'comment_id' => null])->count();
        $prorCount = Project::where(['finished' => 0])->count();
        $solrCount = Solution::where(['finished' => 0])->count();
        $metrCount = Meeting::where(['finished' => 0])->count();
        return view('admin.meetings_details.meeting_detail_edit')->with(compact('meetingDetails', 'companies_dropdown','comrCount','prorCount','solrCount','metrCount'));
    }
    //Delete meeting
    public function deleteMeeting($id = null){
        if(!empty($id)){
            Meeting_Detail::where(['id'=>$id])->delete();
            return redirect()->back()->with('flash_message_success', 'Meeting deleted Successfully !');
        }
    }
    //Meeting detail comments
    public function detailsMeeting(Request $request, $id = null){
        $meetingDetails = Meeting_Detail::where(['id' => $id])->first();
        $companies = Company::get();
        $companies_dropdown = "<option selected disabled >Select Company</option>";
        foreach($companies as $com){
            if($com->id == $meetingDetails->company->id){
                $selected = "selected";
            }else{
                $selected = "";
            }
            $companies_dropdown .= "<option value='" . $com->id . "' " . $selected . ">" . $com->name . "</option>";
        }
        $comments = Comment::where(['meeting_detail_id' => $id])->get();
        $comrCount = Comment::where(['reply_id' => null, 'comment_id' => null])->count();
        $prorCount = Project::where(['finished' => 0])->count();
        $solrCount = Solution::where(['finished' => 0])->count();
        $metrCount = Meeting::where(['finished' => 0])->count();
        return view('admin.meetings_details.meeting_detail_comments')->with(compact('meetingDetails',
                                                                                            'companies_dropdown', 'comments','comrCount','prorCount','solrCount','metrCount'));
    }
    //View meetings
    public function viewMeetings(Request $request, $id = null){
        //$meetingDetails = Meeting_Detail::where(['meeting_id' => $id])->first();
        $meetingDetails = Meeting_Detail::get();
        $companies = Company::get();
        $companies_dropdown = "<option selected disabled >Select Company</option>";
        foreach($companies as $com){
            if($com->id == $meetingDetails->company->id){
                $selected = "selected";
            }else{
                $selected = "";
            }
            $companies_dropdown .= "<option value='" . $com->id . "' " . $selected . ">" . $com->name . "</option>";
        }
        $meeting = Meeting::where(['id' => $id])->first();
        $comrCount = Comment::where(['reply_id' => null, 'comment_id' => null])->count();
        $prorCount = Project::where(['finished' => 0])->count();
        $solrCount = Solution::where(['finished' => 0])->count();
        $metrCount = Meeting::where(['finished' => 0])->count();
        //$meetings = Meeting_Detail::get();
        return view('admin.meetings_details.meetings_details_view')->with(compact('meetingDetails', 'meeting',
                                                                                            'companies_dropdown','comrCount',
                                                                                            'prorCount','solrCount','metrCount'));
    }
    //Export to PDF
    public function pdfMeeting(Request $request, $id = null){
        // Fetch all customers from database
        $data = Meeting_Detail::get();
        // Send data to the view using loadView function of PDF facade
        $pdf = PDF::loadView('admin/meetings/meeting_details_pdf',$data);
        // If you want to store the generated pdf to the server then you can use the store function
        $pdf->save(storage_path().'_filename.pdf');
        // Finally, you can download the file using download function
        return $pdf->download('meeting_details_pdf.pdf');
    }
}
