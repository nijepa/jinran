<?php

namespace App\Http\Controllers;

use App\Category;
use App\City;
use App\Comment;
use App\Company;
use App\Meeting;
use App\Project;
use App\Solution;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    //Add company
    public function addCompany(Request $request){
        $categories = Category::get();
        $categories_dropdown = "<option selected disabled >Select category</option>";
        foreach($categories as $cat){
            $categories_dropdown .= "<option value='" . $cat->id . "'>" . $cat->name . "</option>";
        }
        $cities = City::get();
        $cities_dropdown = "<option selected disabled >Select city</option>";
        foreach($cities as $cit){
            $cities_dropdown .= "<option value='" . $cit->id . "'>" . $cit->name . "</option>";
        }
        if($request->isMethod('post')){
            $data = $request->all();
            //echo "<pre>";print_r($data);die;
            $company = new Company;
            $company->name = $data['name'];
            $company->address = $data['address'];
            $company->phone = $data['phone'];
            $company->mobile = $data['mobile'];
            $company->email = $data['email'];
            $company->website = $data['website'];
            $company->category_id = $data['category_id'];
            $company->city_id = $data['city_id'];
            if($request->hasFile('photo_id')){
                $file = $request->file('photo_id');
                $fileName = $file->getClientOriginalName();
                $name = time() . $fileName;
                $file->move('images/backend_images/companies/', $name);
                $company->photo_id = $name;
            }
            $company->save();
            return redirect('/admin/view-companies')->with('flash_message_success', 'Company added Successfully !');
        }
        $comrCount = Comment::where(['reply_id' => null, 'comment_id' => null])->count();
        $prorCount = Project::where(['finished' => 0])->count();
        $solrCount = Solution::where(['finished' => 0])->count();
        $metrCount = Meeting::where(['finished' => 0])->count();
        return view('admin.companies.company_add')->with(compact('categories_dropdown','cities_dropdown','comrCount','prorCount','solrCount','metrCount'));
    }
    //Edit company
    public function editCompany(Request $request, $id = null){
        if($request->isMethod('post')){
            $data = $request->all();
            //echo "<pre>";print_r($data);die;
            if($request->hasFile('photo_id')){
                $file = $request->file('photo_id');
                $fileName = $file->getClientOriginalName();
                $name = time() . $fileName;
                $file->move('images/backend_images/companies/', $name);

            } else if (!empty($data['photo_cur'])) {
                $name = $data['photo_cur'];
            } else {
                $name = '';
            }
            Company::where(['id'=>$id])->update(['name'=>$data['name'],
                                                'address'=>$data['address'],
                                                'phone'=>$data['phone'],
                                                'mobile'=>$data['mobile'],
                                                'email'=>$data['email'],
                                                'website'=>$data['website'],
                                                'city_id'=>$data['city_id'],
                                                'photo_id'=>$name,
                                                'category_id'=>$data['category_id']]);
            return redirect('/admin/view-companies')->with('flash_message_success', 'Company updated Successfully !');
        }
        $companyDetails = Company::where(['id' => $id])->first();
        $categories = Category::get();
        $categories_dropdown = "<option selected disabled >Select Category</option>";
        foreach($categories as $cat){
            if($cat->id == $companyDetails->category->id){
                $selected = "selected";
            }else{
                $selected = "";
            }
            $categories_dropdown .= "<option value='" . $cat->id . "' " . $selected . ">" . $cat->name . "</option>";
        }
        $cities = City::get();
        $cities_dropdown = "<option selected disabled >Select City</option>";
        foreach($cities as $cit){
            if($cit->id == $companyDetails->city->id){
                $selected = "selected";
            }else{
                $selected = "";
            }
            $cities_dropdown .= "<option value='" . $cit->id . "' " . $selected . ">" . $cit->name . "</option>";
        }
        $comrCount = Comment::where(['reply_id' => null, 'comment_id' => null])->count();
        $prorCount = Project::where(['finished' => 0])->count();
        $solrCount = Solution::where(['finished' => 0])->count();
        $metrCount = Meeting::where(['finished' => 0])->count();
        return view('admin.companies.company_edit')->with(compact('companyDetails', 'categories_dropdown', 'cities_dropdown','comrCount','prorCount','solrCount','metrCount'));
    }
    //Delete company
    public function deleteCompany($id = null){
        if(!empty($id)){
            Company::where(['id'=>$id])->delete();
            return redirect()->back()->with('flash_message_success', 'Company deleted Successfully !');
        }
    }
    //View companies
    public function viewCompanies(){
        $companies = Company::orderBy('name', 'ASC')->get();
        $comrCount = Comment::where(['reply_id' => null, 'comment_id' => null])->count();
        $prorCount = Project::where(['finished' => 0])->count();
        $solrCount = Solution::where(['finished' => 0])->count();
        $metrCount = Meeting::where(['finished' => 0])->count();
        return view('admin.companies.companies_view')->with(compact('companies','comrCount','prorCount','solrCount','metrCount'));
    }
    //Delete company logo
    public function deleteCompanyImage($id = null){
        $company = Company::findOrFail($id);
        unlink('images/backend_images/companies/' . $company->photo_id);
        Company::where(['id'=>$id])->update(['photo_id'=>'']);
        return redirect()->back()->with('flash_message_success', 'Company logo deleted Successfully !');
    }
}
