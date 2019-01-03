<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Company;
use App\Meeting;
use App\Meeting_Detail;
use App\Project;
use App\Solution;
use Illuminate\Support\Facades\Auth;
use PDF;
use Illuminate\Http\Request;

class AdminMeetingController extends Controller
{
    //Add meeting
    public function addMeeting(Request $request){
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
            $user = Auth::user();
            $data = $request->all();
            //echo "<pre>";print_r($data);die;
            $meeting = new Meeting;
            $meeting->user_id = $user->id;
            $meeting->title = $data['title'];
            $meeting->date_m = $data['date_m'];
            $meeting->description = $data['description'];
            $meeting->company_id = $data['company_id'];
            $meeting->save();
            return redirect('/admin/view-meetings')->with('flash_message_success', 'Meeting added Successfully !');
        }
        return view('admin.meetings.meeting_add')->with(compact('companies_dropdown','comrCount',
                                                                            'prorCount','solrCount','metrCount'));
    }
    //Edit meeting
    public function editMeeting(Request $request, $id = null){
        if($request->isMethod('post')){
            $data = $request->all();
            Meeting::where(['id'=>$id])->update(['title'=>$data['title'],
                'description'=>$data['description'],
                'date_m'=>$data['date_m'],
                'company_id'=>$data['company_id']]);
            return redirect('/admin/view-meetings')->with('flash_message_success', 'Meeting updated Successfully !');
        }
        $meetingDetails = Meeting::where(['id' => $id])->first();
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
        $meetingDet = Meeting_Detail::where(['meeting_id' => $id])->get();
        $comrCount = Comment::where(['reply_id' => null, 'comment_id' => null])->count();
        $prorCount = Project::where(['finished' => 0])->count();
        $solrCount = Solution::where(['finished' => 0])->count();
        $metrCount = Meeting::where(['finished' => 0])->count();
        return view('admin.meetings.meeting_edit')->with(compact('meetingDetails', 'companies_dropdown',
                                                                            'meetingDet','comrCount','prorCount','solrCount','metrCount'));
    }
    //Details meeting
    public function detailsMeeting(Request $request, $id = null){
        if($request->isMethod('post')){
            $data = $request->all();
            Meeting::where(['id'=>$id])->update(['title'=>$data['title'],
                'description'=>$data['description'],
                'date_m'=>$data['date_m'],
                'company_id'=>$data['company_id']]);
            return redirect('/admin/view-meetings')->with('flash_message_success', 'Meeting updated Successfully !');
        }
        $meetingDetails = Meeting::where(['id' => $id])->first();
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
        $meetingDet = Meeting_Detail::where(['meeting_id' => $id])->get();
        $comrCount = Comment::where(['reply_id' => null, 'comment_id' => null])->count();
        $prorCount = Project::where(['finished' => 0])->count();
        $solrCount = Solution::where(['finished' => 0])->count();
        $metrCount = Meeting::where(['finished' => 0])->count();
        return view('admin.meetings.meeting_details')->with(compact('meetingDetails', 'companies_dropdown',
                                                                                'meetingDet','comrCount','prorCount','solrCount','metrCount'));
    }
    //Delete meeting
    public function deleteMeeting($id = null){
        if(!empty($id)){
            Meeting::where(['id'=>$id])->delete();
            return redirect()->back()->with('flash_message_success', 'Meeting deleted Successfully !');
        }
    }
    //View meetings
    public function viewMeetings(){
        $meetings = Meeting::get();
        $comrCount = Comment::where(['reply_id' => null, 'comment_id' => null])->count();
        $prorCount = Project::where(['finished' => 0])->count();
        $solrCount = Solution::where(['finished' => 0])->count();
        $metrCount = Meeting::where(['finished' => 0])->count();
        return view('admin.meetings.meetings_view')->with(compact('meetings','comrCount','prorCount',
                                                                            'solrCount','metrCount'));
    }
    //Update meeting (set status active or not)
    public function updateMeeting(Request $request, $id = null)
    {
        $data = $request->all();
        Meeting::where(['id'=>$id])->update(['finished'=>$data['finished']]);
        return redirect()->back()->with('flash_message_success', 'Meeting status changed Successfully !');
    }
    //Export to PDF
    public function pdfMeeting(Request $request, $id = null){
        // Fetch all customers from database
        $data = Meeting::where(['id' => $id])->get();;
        // Send data to the view using loadView function of PDF facade
        $pdf = PDF::loadView('admin/meetings/meeting_pdf',['data' => $data]);
        // If you want to store the generated pdf to the server then you can use the store function
        $pdf->save(storage_path().'_filename.pdf');
        // Finally, you can download the file using download function
        return $pdf->download('meeting_pdf.pdf');
    }
    //Export to PDF
    public function pdfMeetingDetail(Request $request, $id = null){
        // Fetch all customers from database
        $data = Meeting_Detail::where(['id' => $id])->get();;
        // Send data to the view using loadView function of PDF facade
        $pdf = PDF::loadView('admin/meetings/meeting_details_pdf',['data' => $data]);
        // If you want to store the generated pdf to the server then you can use the store function
        $pdf->save(storage_path().'_filename.pdf');
        // Finally, you can download the file using download function
        return $pdf->download('meeting_details_pdf.pdf');
    }
}
