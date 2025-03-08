<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ligas extends Model
{

    protected $primaryKey = 'pk_ligas';
  
    public function pais()
    {
        return $this->belongsTo(Pais::class, 'fk_pais', 'pk_pais');
    }
}
