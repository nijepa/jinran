<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Meeting;
use App\Meeting_Detail;
use App\Project;
use App\Solution;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests;

class AdminCommentController extends Controller
{
    //View comments
    public function viewComments(){
        $comments = Comment::where(['reply' => null])->get();
        $meeting_detail = Meeting_Detail::get();
        $comment_detail = Comment::get();
        $comrCount = Comment::where(['reply_id' => null, 'comment_id' => null])->count();
        $prorCount = Project::where(['finished' => 0])->count();
        $solrCount = Solution::where(['finished' => 0])->count();
        $metrCount = Meeting::where(['finished' => 0])->count();
        return view('admin.comments.comments_view')->with(compact('comments','meeting_detail','comment_detail','comrCount','prorCount','solrCount','metrCount'));
    }
    //View replies
    public function viewReplies(){
        $comments = Comment::where(['comment' => null])->get();
        $comment_detail = Comment::get();
        $meeting_detail = Meeting_Detail::get();
        $comrCount = Comment::where(['reply_id' => null, 'comment_id' => null])->count();
        $prorCount = Project::where(['finished' => 0])->count();
        $solrCount = Solution::where(['finished' => 0])->count();
        $metrCount = Meeting::where(['finished' => 0])->count();
        return view('admin.comments.replies_view')->with(compact('comments','comment_detail','meeting_detail','comrCount','prorCount','solrCount','metrCount'));
    }
    //Update comments (set comments checked or not)
    public function updateComment(Request $request, $id = null)
    {
        $data = $request->all();
        Comment::where(['id'=>$id])->update(['checked_a'=>$data['checked_a']]);
        return redirect()->back()->with('flash_message_success', 'Comments checked/unchecked Successfully !');
    }
    //Add reply
    public function addReply(Request $request, $id = null){
        $comment = Comment::where(['id' => $id])->first();
        $meeting_detail =  Meeting_Detail::where(['id' => $comment->meeting_detail_id])->first();
        $comrCount = Comment::where(['reply_id' => null, 'comment_id' => null])->count();
        $prorCount = Project::where(['finished' => 0])->count();
        $solrCount = Solution::where(['finished' => 0])->count();
        $metrCount = Meeting::where(['finished' => 0])->count();
        if($request->isMethod('post')){
            $user = Auth::user();
            $data = $request->all();
            $reply = new Comment;
            if($file = $request->file('file')) {
                $fileName = $file->getClientOriginalName();
                $name = time() . $fileName;
                $file->move('/images/backend_images/comments/', $name);
                $reply->file_r = $name;
            }
            $reply->meeting_detail_id = $meeting_detail->id;
            $reply->comment_id = $comment->id;
            $reply->user_id = $user->id;
            $reply->reply = $data['reply'];
            $reply->save();
            Comment::where(['id'=>$comment->id])->update(['reply_id'=>$reply->id]);
            return redirect('/admin/view-reply/')->with('flash_message_success', 'Reply added Successfully !');
        }
        return view('admin.comments.reply_add')->with(compact('comment','meeting_detail','comrCount','prorCount','solrCount','metrCount'));
    }
    //Edit reply
    public function editReply(Request $request, $id = null){
        if($request->isMethod('post')){
            $data = $request->all();
            Comment::where(['id'=>$id])->update(['reply'=>$data['reply'],
                'file_r'=>$data['file_r']]);
            return redirect('/admin/view-reply')->with('flash_message_success', 'Reply updated Successfully !');
        }
        $replies = Comment::where(['id' => $id])->first();
        $comrCount = Comment::where(['reply_id' => null, 'comment_id' => null])->count();
        $prorCount = Project::where(['finished' => 0])->count();
        $solrCount = Solution::where(['finished' => 0])->count();
        $metrCount = Meeting::where(['finished' => 0])->count();
        return view('admin.comments.reply_edit')->with(compact('replies','comrCount','prorCount','solrCount','metrCount'));
    }
    //Delete reply
    public function deleteReply($id = null){
        if(!empty($id)){
            Comment::where(['id'=>$id])->delete();
            return redirect()->back()->with('flash_message_success', 'Reply deleted Successfully !');
        }
    }
    //Delete comment
    public function deleteComment($id = null){
        if(!empty($id)){
            Comment::where(['id'=>$id])->delete();
            return redirect()->back()->with('flash_message_success', 'Comment deleted Successfully !');
        }
    }
    //Details comment
    public function detailsComment(Request $request, $id = null){
    /**    if($request->isMethod('post')){
            $data = $request->all();
            Meeting_Detail::where(['id'=>$id])->update(['title'=>$data['title'],
                'description'=>$data['description'],
                'date_m'=>$data['date_m'],
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
        }**/
        $comments = Comment::where(['meeting_detail_id' => $id])->get();
        $meetingDet = Meeting_Detail::where(['id' => $id])->first();
        return view('admin.comments.comment_details')->with(compact( 'comments','meetingDet'));
    }
    //Delete comment file
    public function deleteCommentFile($id = null){
        $comment = Comment::findOrFail($id);
        if(!empty($id)){
            if(!empty($comment->file)){
                unlink('images/backend_images/solutions/' . $comment->file);
                Comment::where(['id'=>$id])->update(['file'=>'']);
            }else if(!empty($comment->file_r)){
                unlink('images/backend_images/solutions/' . $comment->file_r);
                Comment::where(['id'=>$id])->update(['file_r'=>'']);
            }
        }
        return redirect()->back()->with('flash_message_success', 'Comment document deleted Successfully !');
    }
}
