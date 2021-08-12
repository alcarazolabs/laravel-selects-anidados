@if (session('status_success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('status_success') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif

@if(session('alerta_data_relacionada'))
<div class="alert alert-danger alert-dismissible fade show" role="alert">
{{ session('alerta_data_relacionada') }}
<button type="button" class="close" data-dismiss="alert" aria-label="Close">
<span aria-hidden="true">&times;</span>
</button>
<!-- Habilitar input tipo checkbox para hacer eliminacion de datos relacionados -->
</div>
<div class="form-check">
  <input class="form-check-input" name="eliminar_relacionados" type="checkbox" value="">
  <label class="form-check-label" for="flexCheckDefault">
    Si eliminar datos relacionados incluido esto?
  </label>
  <hr>
</div>
@endif

@if(session('cancelar'))
<div class="alert alert-danger alert-dismissible fade show" role="alert">
{{ session('cancelar') }}
<button type="button" class="close" data-dismiss="alert" aria-label="Close">
<span aria-hidden="true">&times;</span>
</button>
</div>
@endif

