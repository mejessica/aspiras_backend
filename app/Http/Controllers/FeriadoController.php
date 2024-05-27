<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Schemas\FeriadoSchema;
use App\Models\Feriado;
use Neomerx\JsonApi\Encoder\Encoder;
use App\Models\Configuration;
use Illuminate\Support\Facades\Auth;

class FeriadoController extends Controller
{
   public function __construct(){
      $this->middleware('auth:api');
  }

   public function store(Request $request){
      $request->validate([
         'data.attributes.descricao'=>'required|string|max:255',
         'data.attributes.data'=>'required',
     ]);

        $feriado = new Feriado;
        
        $feriado->data=$request->input('data.attributes.data');
        $feriado->descricao=$request->input('data.attributes.descricao');
        $config = Configuration::find($request->input('data.relationships.configuration.data.id'));
        $feriado->configuration()->associate($config);

        $feriado->save();

        $encoder = Encoder::instance([
         Feriado::class => FeriadoSchema::class
     ]); 

         return response($encoder->encodeData($feriado,200,['Content-Type'=> 'application/vnd.api+json']));
   }

   public function findAll(Request $request){
      $user = Auth::user();

      $feriado = Feriado::with('configuration')
      ->join('configurations', 'feriados.configuration_id', '=', 'configurations.id')
      ->select('feriados.*')  
      ->where('configurations.user_id', $user->id)->get();
     

      $encoder = Encoder::instance([
         Feriado::class => FeriadoSchema::class
     ]); 

      return response($encoder->encodeData($feriado,200,['Content-Type'=> 'application/vnd.api+json']));
   }

   public function update(Request $request, $id){
      $query = Feriado::find($id);

      $query->data = $request->input('data.attributes.data');
      $query->descricao = $request->input('data.attributes.descricao');

      $query->save();

      $encoder = Encoder::instance([
         Feriado::class => FeriadoSchema::class
     ]); 

      return response($encoder->encodeData($query,200,['Content-Type'=> 'application/vnd.api+json']));

      }

   public function findItem(Request $request, $id){
      $feriado = Feriado::find($id);

      $encoder = Encoder::instance([
         Feriado::class => FeriadoSchema::class
     ]); 

      return response($encoder->encodeData($feriado,200,['Content-Type'=> 'application/vnd.api+json']));
   }

   public function destroy(Request $request, $id){
      $feriado = Feriado::find($id);

      $feriado->delete();

      $encoder = Encoder::instance([
          Feriado::class => FeriadoSchema::class
      ]);

      return response($encoder->encodeData($feriado,200,['Content-Type'=> 'application/vnd.api+json']));
  }
 
}
