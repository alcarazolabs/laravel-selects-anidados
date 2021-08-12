<?php

namespace App\Http\Controllers\Community;

use App\Models\Community;
use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;

class CommunityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $numberPages = 5;
    
    public function index(Request $request){
        $communities = null;
        $filtro = $request->get('filtro');
        $tipo = $request->get('tipo');

        if($request->exists('filtro')){
            $filtro = $request->filtro;
            $pronvince = $request->province;
            
            $communities = Community::buscarfiltros($filtro, $pronvince)
                       ->orderBy('id', 'desc')->Paginate($this->numberPages)->withQueryString();
        }
        //obtener comunidades por name..
        if($request->exists('tipo')){
            $valor = $request->value;
            $communities = Community::buscarpor($tipo, $valor)
                    ->orderBy('id', 'desc')->Paginate($this->numberPages)->withQueryString();
        }

        if(!$request->exists('filtro') && !$request->exists('tipo') ){
            //como no existe ese parámetro get entonces obtener todos las comunidades normales:

            $communities = Community::orderBy('id', 'desc')->Paginate($this->numberPages)->withQueryString();
        }
        //Enviar departamentos
        $departments = Department::all();
                
        return view("community.index", compact('communities', 'departments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){
        //Enviar departamentos
        $departments = Department::all();
        
        return view("community.create", compact('departments'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){
        
        $request->validate([
            'name' => ['required', 'max:255', Rule::unique('communities', 'name')->where(function ($query) {
                return $query->whereNull('deleted_at');
            })],
            'department' => 'required|exists:departments,id|integer',
            'province' => 'required|exists:provinces,id|integer',
            'district' => 'required|exists:districts,id|integer',
            ]);
    
            //Crear Comunidad
            $comunidad = new Community;
            $comunidad->name = $request->name;
            $comunidad->department_id = $request->department;
            $comunidad->province_id = $request->province;
            $comunidad->district_id = $request->district;
            $comunidad->save();

            //Redireccionar
            return redirect()->route('admin.communities.index')
            ->with('status_success','Comunidad registrada correctamente!');
            
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id){
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id){
      
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id){
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id){
        
    }

    public function confirm($id){
        $community = Community::findOrFail($id);
        return view('community.confirm', compact('community'));
    }
}
