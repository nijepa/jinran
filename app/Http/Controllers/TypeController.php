<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Meeting;
use App\Project;
use App\Solution;
use App\Type;
use Illuminate\Http\Request;

class TypeController extends Controller
{
    //Add type
    public function addType(Request $request){
        if($request->isMethod('post')){
            $data = $request->all();
            $type = new Type;
            $type->name = $data['name'];
            $type->save();
            return redirect('/admin/view-types')->with('flash_message_success', 'Type added Successfully !');
        }
        $comrCount = Comment::where(['reply_id' => null, 'comment_id' => null])->count();
        $prorCount = Project::where(['finished' => 0])->count();
        $solrCount = Solution::where(['finished' => 0])->count();
        $metrCount = Meeting::where(['finished' => 0])->count();
        return view('admin.types.type_add')->with(compact('comrCount','prorCount','solrCount','metrCount'));
    }
    //Edit type
    public function editType(Request $request, $id = null){
        if($request->isMethod('post')){
            $data = $request->all();
            Type::where(['id'=>$id])->update(['name'=>$data['name']]);
            return redirect('/admin/view-types')->with('flash_message_success', 'Type updated Successfully !');
        }
        $typeDetails = Type::where(['id' => $id])->first();
        $comrCount = Comment::where(['reply_id' => null, 'comment_id' => null])->count();
        $prorCount = Project::where(['finished' => 0])->count();
        $solrCount = Solution::where(['finished' => 0])->count();
        $metrCount = Meeting::where(['finished' => 0])->count();
        return view('admin.types.type_edit')->with(compact('typeDetails','comrCount','prorCount','solrCount','metrCount'));
    }
    //Delete type
    public function deleteType($id = null){
        if(!empty($id)){
            Type::where(['id'=>$id])->delete();
            return redirect()->back()->with('flash_message_success', 'Type deleted Successfully !');
        }
    }
    //View types
    public function viewTypes(){
        $types = Type::get();
        $comrCount = Comment::where(['reply_id' => null, 'comment_id' => null])->count();
        $prorCount = Project::where(['finished' => 0])->count();
        $solrCount = Solution::where(['finished' => 0])->count();
        $metrCount = Meeting::where(['finished' => 0])->count();
        return view('admin.types.types_view')->with(compact('types','comrCount','prorCount','solrCount','metrCount'));
    }
}