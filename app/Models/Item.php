<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;
    protected $fillable = ['descricao', 'prioridade', 'realizado', 'todo_id'];

    public function todo(){
        return $this->belongsTo(Todo::class);
    }
}
