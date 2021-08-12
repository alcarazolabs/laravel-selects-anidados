<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; 

class Community extends Model{
    use HasFactory;

    use SoftDeletes; //Implementamos el softdeletes
    //habilitar en true softdelente para poder hacer conteo de registros activos sin usar condiciones
    //cuando se haga un conteo a esta tabla no contara los borrados.
    protected $softDelete = true;

    protected $fillable = ['name', 'department_id', 'province_id', 'district_id'];

    public function scopeBuscarpor($query, $tipo, $valor){
        if( ($tipo) && ($valor)){   
          return $query->where($tipo,'like',"%$valor%");
        }
 }

    public function scopeBuscarfiltros($query, $filtro, $province){
        if( ($filtro)){
            switch ($filtro) {

                case 'filtro1':   //Obtener comunidades de un distrito
                    return $query->where('province_id', '=', $province);

                    break;
            }
  
        }
     }



    public function district() {
        return $this->belongsTo(District::class, 'district_id');
    }

    public function province() {
        return $this->belongsTo(Province::class, 'province_id');
    }
    
    public function department() {
        return $this->belongsTo(Department::class, 'department_id');
    }


}
