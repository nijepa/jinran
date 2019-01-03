<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Meeting;
use App\Project;
use App\Solution;
use App\Subtype;
use Illuminate\Http\Request;

class SubtypeController extends Controller
{
    //Add subtype
    public function addSubtype(Request $request){
        if($request->isMethod('post')){
            $data = $request->all();
            $type = new Subtype;
            $type->name = $data['name'];
            $type->save();
            return redirect('/admin/view-subtypes')->with('flash_message_success', 'Subtype added Successfully !');
        }
        $comrCount = Comment::where(['reply_id' => null, 'comment_id' => null])->count();
        $prorCount = Project::where(['finished' => 0])->count();
        $solrCount = Solution::where(['finished' => 0])->count();
        $metrCount = Meeting::where(['finished' => 0])->count();
        return view('admin.subtypes.subtype_add')->with(compact('comrCount','prorCount','solrCount','metrCount'));
    }
    //Edit subtype
    public function editSubtype(Request $request, $id = null){
        if($request->isMethod('post')){
            $data = $request->all();
            Subtype::where(['id'=>$id])->update(['name'=>$data['name']]);
            return redirect('/admin/view-subtypes')->with('flash_message_success', 'Subtype updated Successfully !');
        }
        $subtypeDetails = Subtype::where(['id' => $id])->first();
        $comrCount = Comment::where(['reply_id' => null, 'comment_id' => null])->count();
        $prorCount = Project::where(['finished' => 0])->count();
        $solrCount = Solution::where(['finished' => 0])->count();
        $metrCount = Meeting::where(['finished' => 0])->count();
        return view('admin.subtypes.subtype_edit')->with(compact('subtypeDetails','comrCount','prorCount','solrCount','metrCount'));
    }
    //Delete subtype
    public function deleteSubtype($id = null){
        if(!empty($id)){
            Subtype::where(['id'=>$id])->delete();
            return redirect()->back()->with('flash_message_success', 'Subtype deleted Successfully !');
        }
    }
    //View subtypes
    public function viewSubtypes(){
        $subtypes = Subtype::get();
        $comrCount = Comment::where(['reply_id' => null, 'comment_id' => null])->count();
        $prorCount = Project::where(['finished' => 0])->count();
        $solrCount = Solution::where(['finished' => 0])->count();
        $metrCount = Meeting::where(['finished' => 0])->count();
        return view('admin.subtypes.subtypes_view')->with(compact('subtypes','comrCount','prorCount','solrCount','metrCount'));
    }
}
