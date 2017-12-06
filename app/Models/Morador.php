<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Morador extends Model
{
    protected $table = 'tb_cdm_morador';
    
    
//    public function visitantes()
//    {
//        return $this->belongsToMany('App\Models\Visitante', 'tb_cdm_visitante_morador', 'morador_id', 'visitante_id');
//    }    
    
}
