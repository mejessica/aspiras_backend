<?php

namespace App\Http\Controllers;

use App\Schemas\TodoSchema;
use App\Models\Todo;
use Illuminate\Http\Request;
use Neomerx\JsonApi\Encoder\Encoder;
use Illuminate\Support\Facades\Auth;

class TodoController extends Controller
{
    public function __construct(){
        $this->middleware('auth:api');
    }

    public function store(Request $request){
        $request->validate([
            'data.attributes.nome'=>'required|string|max:255',
  
        ]);

        $todo = new Todo();
        $todo->nome = $request->input('data.attributes.nome');
        $todo->data_termino = $request->input('data.attributes.data_termino');
        $todo->user()->associate(Auth::user());
        $todo->save();
        
        $encoder = Encoder::instance([
            Todo::class => TodoSchema::class
        ]); 

        return response($encoder->encodeData($todo,200,['Content-Type'=> 'application/vnd.api+json']));
    }

    public function findAll(){
        $user = Auth::user();
        $todolist = Todo::where('user_id', $user->id)->get();
 
        $encoder = Encoder::instance([
            Todo::class => TodoSchema::class
        ]); 

        return response($encoder->encodeData($todolist,200, ['Content-Type'=> 'application/vnd.api+json']));

    }

    public function findItem(Request $request, $id){
        $todolist = Todo::find($id);

        $encoder = Encoder::instance([
            Todo::class => TodoSchema::class
        ]);        
        
        return response($encoder->encodeData($todolist,200, ['Content-Type'=> 'application/vnd.api+json']));
    }

    public function destroy(Request $request, $id){
        $todo = Todo::find($id);

        $todo->delete();

        $encoder = Encoder::instance([
            Todo::class => TodoSchema::class
        ]);

        return response($encoder->encodeData($todo,200,['Content-Type'=> 'application/vnd.api+json']));
    }

    

}
