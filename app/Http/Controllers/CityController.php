<?php

namespace App\Http\Controllers;

use App\City;
use App\Comment;
use App\Country;
use App\Meeting;
use App\Project;
use App\Solution;
use Illuminate\Http\Request;

class CityController extends Controller
{
    //Add city
    public function addCity(Request $request){
        $countries = Country::get();
        $countries_dropdown = "<option selected disabled >Select Country</option>";
        foreach($countries as $cou){
            $countries_dropdown .= "<option value='" . $cou->id . "'>" . $cou->name . "</option>";
        }
        $comrCount = Comment::where(['reply_id' => null, 'comment_id' => null])->count();
        $prorCount = Project::where(['finished' => 0])->count();
        $solrCount = Solution::where(['finished' => 0])->count();
        $metrCount = Meeting::where(['finished' => 0])->count();
        if($request->isMethod('post')){
            $data = $request->all();
            //echo "<pre>";print_r($data);die;
            $city = new City;
            $city->name = $data['name'];
            $city->country_id = $data['country_id'];
            $city->save();
            return redirect('/admin/view-cities')->with('flash_message_success', 'City added Successfully !');
        }
        return view('admin.cities.city_add')->with(compact('countries_dropdown','comrCount','prorCount','solrCount','metrCount'));
    }
    //Edit city
    public function editCity(Request $request, $id = null){
        $cityDetails = City::where(['id' => $id])->first();
        $countries = Country::get();
        $countries_dropdown = "<option selected disabled >Select Country</option>";
        foreach($countries as $cou){
            if($cou->id == $cityDetails->country->id){
                $selected = "selected";
            }else{
                $selected = "";
            }
            $countries_dropdown .= "<option value='" . $cou->id . "' " . $selected . ">" . $cou->name . "</option>";
        }
        $comrCount = Comment::where(['reply_id' => null, 'comment_id' => null])->count();
        $prorCount = Project::where(['finished' => 0])->count();
        $solrCount = Solution::where(['finished' => 0])->count();
        $metrCount = Meeting::where(['finished' => 0])->count();
        if($request->isMethod('post')){
            $data = $request->all();
            City::where(['id'=>$id])->update(['name'=>$data['name'], 'country_id'=>$data['country_id']]);
            return redirect('/admin/view-cities')->with('flash_message_success', 'City updated Successfully !');
        }
        return view('admin.cities.city_edit')->with(compact('cityDetails', 'countries_dropdown','comrCount','prorCount','solrCount','metrCount'));
    }
    //Delete city
    public function deleteCity($id = null){
        if(!empty($id)){
            City::where(['id'=>$id])->delete();
            return redirect()->back()->with('flash_message_success', 'City deleted Successfully !');
        }
    }
    //View cities
    public function viewCities(){
        $cities = City::get();
        $comrCount = Comment::where(['reply_id' => null, 'comment_id' => null])->count();
        $prorCount = Project::where(['finished' => 0])->count();
        $solrCount = Solution::where(['finished' => 0])->count();
        $metrCount = Meeting::where(['finished' => 0])->count();
        return view('admin.cities.cities_view')->with(compact('cities','comrCount','prorCount','solrCount','metrCount'));
    }
}
