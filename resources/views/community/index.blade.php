@extends('plantilla.plantilla')
@section('headers')
<meta name="csrf-token" content="{{ csrf_token() }}">

@endsection
@section('titulo','Comunidades')

@section('custom_css')
  <style type="text/css">
  .reduce-margin{
    margin-bottom: 0px !important;

  }
  fieldset{
   border:1px solid #cccc;
   padding:5px;
}
legend.scheduler-border {
   /*Estilo para darle title-border al scheduler dentro del fieldset */
    width:inherit; /* Or auto */
    padding:0 10px; /* To give a bit of padding on the left and right */
    border-bottom:none;
    font-size:15px;
}

form.form-inline{
margin-bottom: 15px;
padding-top:10px;
}



  </style>
@endsection


@section('crudtitulo')
<li class="breadcrumb-item"><i class="fas fa-map-marker-alt"></i> Comunidades</li>

@endsection

@section('contenido')

@include('plantilla.mensajes')
<div id="contenedor-bucador">
<fieldset>
<legend class="scheduler-border">Opciones de búsqueda de comunidades</legend>

  <form id="form-search">
    <div class="row">
    <div class="col-sm-12">
          <div class="form-inline">
              <div class="form-group">
              <label class="control-label">Departamentos: &nbsp;</label>
                  <select  id="_department" name="department"  class="form-control" id="exampleFormControlSelect1">
                  <option value='-1'>Seleccione un Departamento</option> 
                     @foreach($departments as $department)
                      <option value="{{ $department->id }}"  @if( request()->department == $department->id) selected="selected" @endif >{{ $department->name }}</option>

                      @endforeach
                  </select>
              
                </div>

                
                <div class="form-group">
                <label class="control-label">&nbsp; Provincias: &nbsp;</label>
                    <select class="form-control" id="_province" name="province">
                    <option value="-1">Seleccione una Provincia</option>
                  </select>
                
                    <label class="control-label">&nbsp; Distritos: &nbsp;</label>
                    <select class="form-control" id="_district" name="district">
                    <option value="-1">Seleccione un Distrito</option>
                  </select>
                </div>
        
              <div class="form-group" style="padding-top:10px;">
              <label class="control-label">Filtro de Búqueda: &nbsp;</label>
                  <select id="select-filtro" name="filtro" class="form-control" id="exampleFormControlSelect2">
                  <option value="filtro0" @if(request()->filtro == 'filtro0') selected @endif>Seleccionar filtro de búsqueda</option>
                  <option value="filtro1" @if(request()->filtro == 'filtro1') selected @endif>Obtener comunidades de un distrito</option>

                  </select> 
                  &nbsp;
                  <button id="btn-search" class="btn btn-outline-success" type="submit"><i class="fas fa-search"></i> Buscar</button> 
              </div>
              
       </div>
    </div>
    </div>

  </form>  


 <form id="form-search2" class="form-inline">
    <div class="form-inline">
    <div class="form-group">
    <label class="control-label">Buscar por: &nbsp;</label>
    <select id="select-filtro2" name="tipo" class="form-control" id="exampleFormControlSelect2">
        <option value="filtro02" @if(request()->tipo == 'filtro02') selected @endif>Seleccionar</option>
        <option value="name" @if(request()->tipo == 'name') selected @endif>Buscar comunidad por el nombre</option>

        </select> 
        &nbsp;
        <input name="value" size="24" class="form-control" value="{{ old('value', request()->value) }}" autocomplete="off" type="search" placeholder="Ingrese datos..">
        &nbsp;
        <button id="btn-search" class="btn btn-outline-success" type="submit"><i class="fas fa-search"></i> Buscar</button> 
        &nbsp;
        <a title="Refrescar vista" href="{{ route('admin.communities.index') }}" class="btn btn-success">
        <i class="fas fa-sync-alt"></i></a>
      </div>
      </div>

      
</form>
</fieldset>
</div>
@endsection

@section('tabla')
<div id="no-more-tables">
<table class="table table-hover col-sm-12 table-bordered table-condensed cf">
  <thead class="thead-dark cf">
    <tr>
      <th>#</th>
      <th>Nombre de la Comunidad</th>
      <th>Distrito</th>
      <th>Provincia</th>
      <th>Departamento</th>
      <th>Acción</th>
    </tr>
  </thead>
  <tbody>
  
  @foreach($communities as $index => $community)
    <tr>
      <td data-title="#">{{$communities->firstItem() + $index}}</td>

      <td data-title="Nombre">{{$community->name}}</td>
      <td data-title="Distrito">{{$community->district->name}}</td>
      <td data-title="Provincia">{{$community->province->name}}</td>
      <td data-title="Departamento">{{$community->department->name}}</td>
      <td data-title="Accion">

       
        <a title="Ver registro" href="{{ route('admin.communities.show', $community->id)}}" class="btn btn-info btn-sm">
        <i class="fas fa-eye"></i> </a>
        </div>

        <a title="Editar registro" href="{{ route('admin.communities.edit', $community->id)}}" class="btn btn-success btn-sm">
        <i class="fa fa-edit"></i> </a>
       
        <a title="Eliminar registro" href="{{ route('admin.communities.confirm', $community->id) }}" class="btn btn-danger btn-sm">
        <i class="fa fa-trash-alt"></i> </a>
       
     </td>

    </tr>
  @endforeach
   </tbody>
   </table>

</div>

   <div class="form-inline">
   <p>Total de Registros: {{ $communities->total() }} </p> &nbsp;
    {{ $communities->links() }}
  </div>
 
@endsection


@section('js')
<script type="text/javascript">
//var APP_URL = '{{ request()->getSchemeAndHttpHost() }}';
  
  $('document').ready(function(){
    /*
    //Agregar un option al inicio al select departamentos
        let $option = $('<option />', {
        text: 'Departamento',
        value: -1,
        selected: true
        });
    $('#_department').prepend($option);
    */ 
        $('#form-search').submit(function(e){
        e.preventDefault();
        var filtro = $("#select-filtro").val();
        if(filtro=="filtro0"){
          Swal.fire('Selecciones un filtro de búsqueda.')
        }else{
          this.submit();
        }

      });
      
      $('#form-search2').submit(function(e){
        e.preventDefault();
        var filtro = $("#select-filtro2").val();
        if(filtro=="filtro02"){
          Swal.fire('Seleccione un tipo de búsqueda.')
        }else{
          this.submit();
        }

      });
   });
   const csrfToken = document.head.querySelector("[name~=csrf-token][content]").content;

    document.addEventListener('DOMContentLoaded', function () {
      //{{ request()->fullUrl() }}
      var province_id = '{{ request()->input("province") }}';
      var province_id = province_id != '' ? province_id : '-1'; 
      if(province_id!=-1){
        //Obtener las provincias del departamento seleccionado
        var department_id = '{{ request()->input("department") }}';
              fetch(" {{ route('admin.searchProvincesByDepartment') }}",{
                  method : 'POST',
                  body: JSON.stringify({department : department_id}),
                  headers:{
                      'Content-Type': 'application/json',
                      "X-CSRF-Token": csrfToken
                  }
              }).then(response =>{
                  return response.json()
              }).then( data =>{
                  var opciones ="<option value='-1'>Seleccione una Provincia</option>";

                  data.lista.forEach(function(province) {
                    opciones +=  '<option value="' +  province.id +  '" '  +  (( province_id == province.id) ? 'selected' : '') + '>' +  province.name + '</option>';  
                  });
              
                  document.getElementById("_province").innerHTML = opciones;
              }).catch(error =>console.error(error));

        //Obtener los distritos de la provincia seleccionada
        
              fetch(" {{ route('admin.searchDistrictsByProvince') }}",{
                  method : 'POST',
                  body: JSON.stringify({province : province_id}),
                  headers:{
                      'Content-Type': 'application/json',
                      "X-CSRF-Token": csrfToken
                  }
              }).then(response =>{
                  return response.json()
              }).then( data =>{
                  var opciones ="<option value='-1'>Seleccione un Distrito</option>";
                  var district_id = '{{ request()->input("district") }}';
                  data.lista.forEach(function(district) {
                    opciones +=  '<option value="' +  district.id +  '" '  +  (( district_id == district.id) ? 'selected="selected"' : '') + '>' +  district.name + '</option>';  
                  });
                
                  document.getElementById("_district").innerHTML = opciones;
              }).catch(error =>console.error(error));

        
      }

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
            var opciones ="<option value='-1'>Seleccione una Provincia</option>";
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
            var opciones ="<option value='-1'>Seleccione un Distrito</option>";
            for (let i in data.lista) {
               opciones+= '<option value="'+data.lista[i].id+'">'+data.lista[i].name+'</option>';
            }
            document.getElementById("_district").innerHTML = opciones;
        }).catch(error =>console.error(error));
    })
   


</script>
@endsection