<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Configuration extends Model
{
    protected $table = 'configurations';
    use HasFactory;
    protected $fillable = ['segunda', 'terca', 'quarta', 'quinta', 'sexta', 'sabado', 'domingo', 'feriado', 'user_id'];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function hora() {
        return $this->hasMany(Hora::class);
    }
   
}
