<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Visitante extends Model
{
    protected $table = 'tb_cdm_visitante';
    
    
    
//    public function moradores()
//    {
//        return $this->belongsToMany('App\Models\Morador', 'tb_cdm_visitante_morador', 'visitante_id', 'morador_id');
//    }    
}
