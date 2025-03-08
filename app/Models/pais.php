<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class pais extends Model
{
    protected $primaryKey = 'pk_pais';

    public function ligas()
    {
        return $this->hasMany(Liga::class, 'fk_pais', 'pk_pais');
    }
}
