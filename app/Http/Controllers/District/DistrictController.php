<?php

namespace App\Http\Controllers\District;

use App\Http\Controllers\Controller;
use App\Models\District;
use Illuminate\Http\Request;

class DistrictController extends Controller{
    

    public function searchDistrictsByProvince(Request $request){

        if(isset($request->province)){
            $districts = District::where('province_id', $request->province)->get();
            return response()->json(
                [
                    'lista' => $districts,
                    'success' => true
                ]
                );
            
        }else{
            return response()->json(
                [
                    'success' => false
                ]
             );

        }
    }

}
