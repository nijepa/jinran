<?php

namespace App\Http\Controllers;

use App\Category;
use App\Comment;
use App\Meeting;
use App\Project;
use App\Solution;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    //Add category
    public function addCategory(Request $request){
        if($request->isMethod('post')){
            $data = $request->all();
            $category = new Category;
            $category->name = $data['name'];
            $category->save();
            return redirect('/admin/view-categories')->with('flash_message_success', 'Category added Successfully !');
        }
        $comrCount = Comment::where(['reply_id' => null, 'comment_id' => null])->count();
        $prorCount = Project::where(['finished' => 0])->count();
        $solrCount = Solution::where(['finished' => 0])->count();
        $metrCount = Meeting::where(['finished' => 0])->count();
        return view('admin.categories.category_add')->with(compact('comrCount','prorCount','solrCount','metrCount'));
    }
    //Edit category
    public function editCategory(Request $request, $id = null){
        if($request->isMethod('post')){
            $data = $request->all();
            Category::where(['id'=>$id])->update(['name'=>$data['name']]);
            return redirect('/admin/view-categories')->with('flash_message_success', 'Category updated Successfully !');
        }
        $categoryDetails = Category::where(['id' => $id])->first();
        $comrCount = Comment::where(['reply_id' => null, 'comment_id' => null])->count();
        $prorCount = Project::where(['finished' => 0])->count();
        $solrCount = Solution::where(['finished' => 0])->count();
        $metrCount = Meeting::where(['finished' => 0])->count();
        return view('admin.categories.category_edit')->with(compact('categoryDetails','comrCount','prorCount','solrCount','metrCount'));
    }
    //Delete category
    public function deleteCategory($id = null){
        if(!empty($id)){
            Category::where(['id'=>$id])->delete();
            return redirect()->back()->with('flash_message_success', 'Category deleted Successfully !');
        }
    }
    //View categories
    public function viewCategories(){
        $categories = Category::get();
        $comrCount = Comment::where(['reply_id' => null, 'comment_id' => null])->count();
        $prorCount = Project::where(['finished' => 0])->count();
        $solrCount = Solution::where(['finished' => 0])->count();
        $metrCount = Meeting::where(['finished' => 0])->count();
        return view('admin.categories.categories_view')->with(compact('categories','comrCount','prorCount','solrCount','metrCount'));
    }
}