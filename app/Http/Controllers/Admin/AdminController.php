<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; 
use Illuminate\Support\Facades\Auth; 
use Illuminate\Support\Facades\Hash; //para encriptar claves
class AdminController extends Controller{
    
    public function __construct(){
        $this->middleware('auth');
    }
    
    public function index(){
        
        $users = DB::table('users')->count();

        return view('admin.index', compact('users'));
    }

    public function userConfig(){
    
       return view('admin.userconfig');
    
    }

    public function updateUserPassword(Request $request){

        if (!(Hash::check($request->get('current-password'), Auth::user()->password))) {
            // Si la contraseña actual no coincide con la original.. debe de coincidir para proceder a actualizar.
            return redirect()->back()->with("error","La contraseña actual no coincide con la que te registraste.");
        }

        if(strcmp($request->get('current-password'), $request->get('new-password')) == 0){
            //si la contraseña actual es igual a la nueva
            return redirect()->back()->with("error","Tu nueva contraseña nueva no debe ser igual a la anterior, por favor ingresa una nueva contraseña.");
        }

        $validatedData = $request->validate([
            'current-password' => 'required',
            'new-password' => 'required|string|min:6|confirmed',
        ]);

        //Cambiar Password
        $user = Auth::user();
        $user->password = bcrypt($request->get('new-password'));
        $user->save();

    return redirect()->back()->with("success","Contraseña actualizada correctamente !");

    }

}
