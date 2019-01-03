<?php

namespace App\Http\Controllers;

use App\Solution;
use Illuminate\Http\Request;

class SolutionController extends Controller
{
    //
    //Update solutions (set status active or not)
    public function updateSolution(Request $request, $id = null)
    {
        $data = $request->all();
        Solution::where(['id'=>$id])->update(['finished'=>$data['finished']]);
        return redirect()->back()->with('flash_message_success', 'Solution status changed Successfully !');
    }

}
