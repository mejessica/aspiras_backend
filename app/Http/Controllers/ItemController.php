<?php

namespace App\Http\Controllers;

use App\Schemas\ItemSchema;
use App\Models\Item;
use Illuminate\Http\Request;
use Neomerx\JsonApi\Encoder\Encoder;
use Illuminate\Support\Facades\Auth;
use App\Models\Todo;


class ItemController extends Controller
{
    public function __construct(){
        $this->middleware('auth:api');
    }

    public function store(Request $request){
        $request->validate([
            'data.attributes.descricao'=>'required|string|max:255',
            'data.attributes.prioridade'=>'required',
            'data.attributes.realizado'=>'required'
           
        ]);

        $todo_item = new Item();

        $todo_item->descricao = $request->input('data.attributes.descricao');
        $todo_item->prioridade = $request->input('data.attributes.prioridade');
        $todo_item->realizado = $request->input('data.attributes.realizado');
        $todo = Todo::find($request->input('data.relationships.todo.data.id'));
        $todo_item->todo()->associate($todo);

        $todo_item->save();

        
        $encoder = Encoder::instance([
            Item::class => ItemSchema::class
        ]); 

        return response($encoder->encodeData($todo_item,200,['Content-Type'=> 'application/vnd.api+json']));
    }

    public function findAll(Request $request){
        $query = Item::where('todo_id', $request->id)->get();

        $encoder = Encoder::instance([
            Item::class => ItemSchema::class
        ]); 

        return response($encoder->encodeData($query,200,['Content-Type'=> 'application/vnd.api+json']));
    }

    public function update(Request $request, $id){
        $request->validate([
            'data.attributes.descricao'=>'required|string|max:255',
            'data.attributes.prioridade'=>'required',
            'data.attributes.realizado'=>'required'
        ]);

        $item = Item::find($id);
        $item->descricao = $request->input('data.attributes.descricao');
        $item->prioridade = $request->input('data.attributes.prioridade');
        $item->realizado = $request->input('data.attributes.realizado');

        $item->save();

        $encoder = Encoder::instance([
            Item::class => ItemSchema::class
        ]);

        return response($encoder->encodeData($item,200,['Content-Type'=> 'application/vnd.api+json']));
    }

    public function findItem(Request $request, $id){
        $item = Item::find($id);

        $encoder = Encoder::instance([
            Item::class => ItemSchema::class
        ]);

        return response($encoder->encodeData($item,200,['Content-Type'=> 'application/vnd.api+json']));

    }

    public function destroy($id){
        $item = Item::find($id);

        $item->delete();

        $encoder = Encoder::instance([
            Item::class => ItemSchema::class
        ]);

        return response($encoder->encodeData($item,200,['Content-Type'=> 'application/vnd.api+json']));
    }
}
