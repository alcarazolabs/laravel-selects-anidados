<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class District extends Model{
    use HasFactory;
    protected $table = 'districts';
    protected $primaryKey = 'id';

    public function province() {
        return $this->belongsTo(Province::class, 'province_id');
    }
    
    public function department() {
        return $this->belongsTo(Department::class, 'department_id');
    }
}
