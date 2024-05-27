<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Schemas\ConfigurationSchema;
use App\Schemas\HoraSchema;
use App\Models\Hora;
use App\Models\Configuration;
use Neomerx\JsonApi\Encoder\Encoder;
use Illuminate\Support\Facades\Auth;

class ConfigurationController extends Controller
{
    public function __construct(){
        $this->middleware('auth:api');
    }

    public function store(Request $request){
       

        $config = new Configuration;

        $request->validate([
            'data.attributes.sab'=>'nullable',
            'data.attributes.dom'=>'nullable',
            'data.attributes.feriado'=>'nullable',
        ]);

        $config->segunda=$request->input('data.attributes.seg');
        $config->terca=$request->input('data.attributes.ter');
        $config->quarta=$request->input('data.attributes.qua');
        $config->quinta=$request->input('data.attributes.qui');
        $config->sexta=$request->input('data.attributes.sex');
        $config->sabado=$request->input('data.attributes.sab');
        $config->domingo=$request->input('data.attributes.dom');
        $config->feriado=$request->input('data.attributes.feriado');
        $config->user()->associate(Auth::user());

        $config->save();

        $encoder = Encoder::instance([
            Configuration::class => ConfigurationSchema::class,
            Hora::class => HoraSchema::class
            
        ]); 

        return response($encoder->encodeData($config,200,['Content-Type'=> 'application/vnd.api+json']));
    }

    public function findAll(Request $request){
        $config = Configuration::all();

        if($request->userId){ 
            $config = Configuration::where('user_id', $request->userId)->first();
        }

        $encoder = Encoder::instance([
            Configuration::class => ConfigurationSchema::class,
            Hora::class => HoraSchema::class
        ]);        
        
        return response($encoder->encodeData($config,200, ['Content-Type'=> 'application/vnd.api+json']));
    }

    public function update(Request $request, $id){
        $request->validate([
            'data.attributes.seg'=>'required',
            'data.attributes.ter'=>'required',
            'data.attributes.qua'=>'required',
            'data.attributes.qui'=>'required',
            'data.attributes.sex'=>'required',
        ]);

        $query = Configuration::find($id);

        $query->segunda = $request->input('data.attributes.seg');
        $query->terca = $request->input('data.attributes.ter');
        $query->quarta = $request->input('data.attributes.qua');
        $query->quinta = $request->input('data.attributes.qui');
        $query->sexta = $request->input('data.attributes.sex');
        $query->sabado = $request->input('data.attributes.sab');
        $query->domingo = $request->input('data.attributes.dom');
        $query->feriado = $request->input('data.attributes.feriado');
        
        $query->save();
        $encoder = Encoder::instance([
           Configuration::class => ConfigurationSchema::class,
           Hora::class => HoraSchema::class
       ]); 
  
        return response($encoder->encodeData($query,200,['Content-Type'=> 'application/vnd.api+json']));
  
     }

     public function findConfig(Request $request, $id){
        $config = Configuration::find($id);

        $encoder = Encoder::instance([
            Configuration::class => ConfigurationSchema::class,
            Hora::class => HoraSchema::class
        ]);

        return response($encoder->encodeData($config,200,['Content-Type'=> 'application/vnd.api+json']));
     }


}
