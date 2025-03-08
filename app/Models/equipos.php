<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class equipos extends Model
{
    protected $primaryKey = 'pk_equipos';

    public function ligas(){
        return $this->belongsTo(Ligas::class, 'fk_ligas', 'pk_ligas');
    }
}
