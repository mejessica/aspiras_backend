<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Schemas\HoraSchema;
use App\Schemas\ConfigurationSchema;
use App\Models\Hora;
use Neomerx\JsonApi\Encoder\Encoder;
use App\Models\Feriado;
use App\Models\Configuration;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class HoraController extends Controller
{
    public function store(Request $request){
       

        $verificaSeExiste = Feriado::where([
            ['configuration_id', '=', $request->input('data.relationships.configuration.data.id')],
            ['data', '=', $request->input('data.attributes.data')]
        ])->first();
        
        if(isset($verificaSeExiste) && !empty($verificaSeExiste)) {
            return response()->json(['error' => 'O feriado já existe para esta configuração.'], 422);
        }

        $hora = new Hora();

        $hora->data=$request->input('data.attributes.data');
        $hora->entrada1=$request->input('data.attributes.entrada1');
        $hora->saida1=$request->input('data.attributes.saida1');
        $hora->entrada2=$request->input('data.attributes.entrada2');
        $hora->saida2=$request->input('data.attributes.saida2');
        $config = Configuration::find($request->input('data.relationships.configuration.data.id'));
        $hora->configuration()->associate($config);

        $hora->save();

        $encoder = Encoder::instance([
            Hora::class => HoraSchema::class,
            Configuration::class => ConfigurationSchema::class
        ]);

        return response($encoder->encodeData($hora,200,['Content-Type'=> 'application/vnd.api+json']));
    }

    public function findAll(Request $request){

        if($request -> data){
        $user = Auth::user();
        $hora = Hora::with('configuration')
        ->join('configurations', 'horas.configuration_id', '=', 'configurations.id')
        ->select('horas.*') 
        ->where('data', $request->data)
        ->where('configurations.user_id', $user->id)->get();
    
        }
        
        if(isset($request->month)){
            if($request->year) {
            
                $trueMonth = $request->month+1;
                // $date = Carbon::parse($trueMonth);
                //  $date->daysInMonth;
                //  $date->weekNumberInMonth; 
                // echo $date;

                // $date = new Carbon($request->year."-"."$trueMonth");
                // $date = $request->year.'-'.$trueMonth;

                // $first = date($date.'-01');
                // $last = date($date.'-t');

                $first = Carbon::create($request->year, $trueMonth, 1)->startOfDay();
                $last = Carbon::create($request->year, $trueMonth, 1)->endOfMonth()->endOfDay();

                $user = Auth::user();
                $hora = Hora::with('configuration')
                ->join('configurations', 'horas.configuration_id', '=', 'configurations.id')
                ->whereBetween('horas.data', [$first, $last])
                ->select('horas.*')  
                ->where('configurations.user_id', $user->id)->orderBy('data', 'ASC')->get();
            }
        
        }

  
        $encoder = Encoder::instance([
            Hora::class => HoraSchema::class,
            Configuration::class => ConfigurationSchema::class
        ]);
        
        return response($encoder->encodeData($hora,200,['Content-Type'=> 'application/vnd.api+json']));
    }

    public function update(Request $request, $id){
        $query = Hora::find($id);

        $query->data = $request->input('data.attributes.data');
        $query->entrada1 = $request->input('data.attributes.entrada1');
        $query->saida1 = $request->input('data.attributes.saida1');
        $query->entrada2 = $request->input('data.attributes.entrada2');
        $query->saida2 = $request->input('data.attributes.saida2');

        $query->save();

        $encoder = Encoder::instance([
            Hora::class => HoraSchema::class,
            Configuration::class => ConfigurationSchema::class
        ]);
        
        return response($encoder->encodeData($query,200,['Content-Type'=> 'application/vnd.api+json']));
    }
}
