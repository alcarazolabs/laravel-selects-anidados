<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Province extends Model{
    use HasFactory;
    protected $table = 'provinces';
    protected $primaryKey = 'id';



    public function department() {
        return $this->belongsTo(Department::class, 'department_id');
    }



}


