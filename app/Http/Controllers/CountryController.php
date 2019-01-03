<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Country;
use App\Meeting;
use App\Project;
use App\Solution;
use Illuminate\Http\Request;

class CountryController extends Controller
{
    //Add country
    public function addCountry(Request $request){
        if($request->isMethod('post')){
            $data = $request->all();
            //echo "<pre>";print_r($data);die;
            $country = new Country;
            $country->name = $data['name'];
            $country->save();
            return redirect('/admin/view-countries')->with('flash_message_success', 'Country added Successfully !');
        }
        $comrCount = Comment::where(['reply_id' => null, 'comment_id' => null])->count();
        $prorCount = Project::where(['finished' => 0])->count();
        $solrCount = Solution::where(['finished' => 0])->count();
        $metrCount = Meeting::where(['finished' => 0])->count();
        return view('admin.countries.country_add')->with(compact('comrCount','prorCount','solrCount','metrCount'));
    }
    //Edit country
    public function editCountry(Request $request, $id = null){
        if($request->isMethod('post')){
            $data = $request->all();
            Country::where(['id'=>$id])->update(['name'=>$data['name']]);
            return redirect('/admin/view-countries')->with('flash_message_success', 'Country updated Successfully !');
        }
        $countryDetails = Country::where(['id' => $id])->first();
        $comrCount = Comment::where(['reply_id' => null, 'comment_id' => null])->count();
        $prorCount = Project::where(['finished' => 0])->count();
        $solrCount = Solution::where(['finished' => 0])->count();
        $metrCount = Meeting::where(['finished' => 0])->count();
        return view('admin.countries.country_edit')->with(compact('countryDetails','comrCount','prorCount','solrCount','metrCount'));
    }
    //Delete country
    public function deleteCountry($id = null){
        if(!empty($id)){
            Country::where(['id'=>$id])->delete();
            return redirect()->back()->with('flash_message_success', 'Country deleted Successfully !');
        }
    }
    //View countries
    public function viewCountries(){
        $countries = Country::get();
        $comrCount = Comment::where(['reply_id' => null, 'comment_id' => null])->count();
        $prorCount = Project::where(['finished' => 0])->count();
        $solrCount = Solution::where(['finished' => 0])->count();
        $metrCount = Meeting::where(['finished' => 0])->count();
        return view('admin.countries.countries_view')->with(compact('countries','comrCount','prorCount','solrCount','metrCount'));
    }
}
