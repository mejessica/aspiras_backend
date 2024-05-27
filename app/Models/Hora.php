<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Hora extends Model
{
    protected $table = 'horas';
    use HasFactory;
    protected $fillable = ['data', 'entrada1', 'saida1', 'entrada2', 'saida2'];

    public function getDiaDaSemanaAttribute() {
        $data = strtotime($this->data);
        return date('l', $data);
    }

    public function configuration(){
        return $this->belongsTo(Configuration::class, 'configuration_id', 'id');
    }
}
