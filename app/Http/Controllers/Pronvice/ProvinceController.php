<?php

namespace App\Http\Controllers\Pronvice;

use App\Models\Province;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProvinceController extends Controller{
    
    public function searchProvincesByDepartment(Request $request){

        if(isset($request->department)){
            $provinces = Province::where('department_id', $request->department)->get();
            return response()->json(
                [
                    'lista' => $provinces,
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
