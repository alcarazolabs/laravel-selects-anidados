@extends('plantilla.plantilla')
@section('headers')
<meta name="csrf-token" content="{{ csrf_token() }}">

@endsection

@section('titulo','Registrar Comunidad')


@section('crudtitulo')
<li class="breadcrumb-item" style="color:#4B7BFF;"><a href="{{ route('admin.communities.index') }}"><i class="fas fa-map-marker-alt"></i> Comunidades</a></li>
<li class="breadcrumb-item active" aria-current="page">Registrar</li>
@endsection

@section('contenido')
<form method='POST', action="{{ route('admin.communities.store')}}">
@csrf

    <div class="row">
    <div class="col-md-4">
       <label>Departamento<label style="color:#A83834">* &nbsp;</label></label>
    </div>
    </div>
    <div class="row">
    <div class="col-md-4">
    <div class="form-group">
       <select class="form-control" id="_department" name="department">
        <option value="-1">Departamento</option>
        @foreach($departments as $id => $department)
        @if (old('department') == $department->id)
  		<option value="{{ $department->id }}" selected="selected">{{ $department->name }}</option>
    	@else
		<option value="{{ $department->id }}">{{ $department->name }}</option>
	    @endif
        @endforeach
       </select>
       <div class="invalid-feedback d-block">
           @foreach ($errors->get('department') as $error)
                {{ $error }}
            @endforeach
        </div>

    </div>
    </div>
    </div>


    <div class="row">
    <div class="col-md-4">
       <label>Pronvicia<label style="color:#A83834">* &nbsp;</label></label>
    </div>
    </div>
    <div class="row">
    <div class="col-md-4">
    <div class="form-group">
       <select class="form-control" id="_province" name="province">
       </select>
       <div class="invalid-feedback d-block">
           @foreach ($errors->get('province') as $error)
                {{ $error }}
            @endforeach
        </div>
    </div>
    </div>
    </div>


    <div class="row">
    <div class="col-md-4">
       <label>Distrito<label style="color:#A83834">* &nbsp;</label></label>
    </div>
    </div>
    <div class="row">
    <div class="col-md-4">
    <div class="form-group">
       <select class="form-control" id="_district" name="district">
       </select>
       <div class="invalid-feedback d-block">
           @foreach ($errors->get('district') as $error)
                {{ $error }}
            @endforeach
        </div>
    </div>
    </div>
    </div>

    <div class="row">
    <div class="col-md-8">
    <div class="form-group">
       <label>Nombre de la Comunidad<label style="color:#A83834">*</label></label>
       <input type="text" autocomplete="off" class="form-control" value="{{ old('name') }}" name="name" placeholder="Ingrese un nombre..">
        <div class="invalid-feedback d-block">
           @foreach ($errors->get('name') as $error)
                {{ $error }}
            @endforeach
        </div>
    </div>
    </div>

    </div>


    <button type="submit" class="btn btn-success"><i class="fas fa-save"></i> Guardar</button>
    <a href="{{ route('admin.cancelar','admin.communities.index') }}" class="btn btn-danger"><i class="fas fa-ban"></i> Cancelar</a>
    
</form>
@endsection


@section('js')
<script type="text/javascript">
  //token del formulario
  const csrfToken = document.head.querySelector("[name~=csrf-token][content]").content;

  document.addEventListener('DOMContentLoaded', function () {
        var oldProvince = ( ('{{ old("province") }}' !='') ? '{{ old("province") }}' : '-1');
        var oldDistrict = ( ('{{ old("district") }}' !='') ? '{{ old("district") }}' : '-1');
        //alert("pro: "+oldProvince + "dis:"+oldDistrict);

        if(oldProvince !=-1 && oldDistrict !=-1){
        //Obtener las provincias del departamento seleccionado
             fetch(" {{ route('admin.searchProvincesByDepartment') }}",{
                  method : 'POST',
                  body: JSON.stringify({department : '{{ old("department") }}'}),
                  headers:{
                      'Content-Type': 'application/json',
                      "X-CSRF-Token": csrfToken
                  }
              }).then(response =>{
                  return response.json()
              }).then( data =>{
                  var opciones ="<option value='-1'>Seleccione una Provincia</option>";

                  data.lista.forEach(function(province) {
                    opciones +=  '<option value="' +  province.id +  '" '  +  (( oldProvince == province.id) ? 'selected' : '') + '>' +  province.name + '</option>';  
                  });
              
                  document.getElementById("_province").innerHTML = opciones;
              }).catch(error =>console.error(error));

        //Obtener los distritos de la provincia seleccionada
        
              fetch(" {{ route('admin.searchDistrictsByProvince') }}",{
                  method : 'POST',
                  body: JSON.stringify({province : oldProvince}),
                  headers:{
                      'Content-Type': 'application/json',
                      "X-CSRF-Token": csrfToken
                  }
              }).then(response =>{
                  return response.json()
              }).then( data =>{
                  var opciones ="<option value='-1'>Seleccione un Distrito</option>";
                  
                  data.lista.forEach(function(district) {
                    opciones +=  '<option value="' +  district.id +  '" '  +  (( oldDistrict == district.id) ? 'selected="selected"' : '') + '>' +  district.name + '</option>';  
                  });
                
                  document.getElementById("_district").innerHTML = opciones;
              }).catch(error =>console.error(error));

        
      }



    });
 

    $('document').ready(function(){
     //Agregar un option al inicio al select departamentos
        /*let $option = $('<option />', {
        text: 'Departamento',
        value: -1,
        selected: true
        });
       $('#_department').prepend($option);*/

    });

    // Obtener las provincias de un departamento
    document.getElementById('_department').addEventListener('change',(e)=>{
        fetch(" {{ route('admin.searchProvincesByDepartment') }}",{
            method : 'POST',
            body: JSON.stringify({department : e.target.value}),
            headers:{
                'Content-Type': 'application/json',
                "X-CSRF-Token": csrfToken
            }
        }).then(response =>{
            return response.json()
        }).then( data =>{
            var opciones ="<option value='-1'>Elegir</option>";
            for (let i in data.lista) {
               opciones+= '<option value="'+data.lista[i].id+'">'+data.lista[i].name+'</option>';
            }
            document.getElementById("_province").innerHTML = opciones;
        }).catch(error =>console.error(error));
    })

    // Obtener los distritos de una provincia
    document.getElementById('_province').addEventListener('change',(e)=>{
        
        fetch(" {{ route('admin.searchDistrictsByProvince') }}",{
            method : 'POST',
            body: JSON.stringify({province : e.target.value}),
            headers:{
                'Content-Type': 'application/json',
                "X-CSRF-Token": csrfToken
            }
        }).then(response =>{
            return response.json()
        }).then( data =>{
            var opciones ="<option value='-1'>Elegir</option>";
            for (let i in data.lista) {
               opciones+= '<option value="'+data.lista[i].id+'">'+data.lista[i].name+'</option>';
            }
            document.getElementById("_district").innerHTML = opciones;
        }).catch(error =>console.error(error));
    })
   


</script>
@endsection