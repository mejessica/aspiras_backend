<?php

namespace App\Http\Controllers;

use App\Schemas\UserSchema;
use App\Models\User;
use Neomerx\JsonApi\Encoder\Encoder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller{

    public function __construct(){
        $this->middleware('auth:api',['except'=>['store']]);
    }

    public function store(Request $request){
        $user = new User;
    
        $user->email=$request->input('data.attributes.email');
        $user->nome=$request->input('data.attributes.nome');
        $user->data_nasc=$request->input('data.attributes.data_nasc');
        $user->endereco=$request->input('data.attributes.endereco');
        $user->bairro=$request->input('data.attributes.bairro');
        $user->cidade=$request->input('data.attributes.cidade');
        $user->estado=$request->input('data.attributes.estado');
        $user->pais=$request->input('data.attributes.pais');
        $user -> password = Hash::make($request->input('data.attributes.password'));

        $user->save();

        $encoder = Encoder::instance([
            User::class => UserSchema::class
        ]); 

        return response($encoder->encodeData($user,200,['Content-Type'=> 'application/vnd.api+json']));
    }

    public function urlPrefix(){
        $user = Auth::user();
      
        $encoder = Encoder::instance([
            User::class => UserSchema::class
        ]); 

        return response($encoder->encodeData([$user],200,['Content-Type'=> 'application/vnd.api+json']));
    }

    public function findUser(Request $request, $id){
        $user = User::find($id);

        $encoder = Encoder::instance([
            User::class => UserSchema::class
        ]); 

        return response($encoder->encodeData($user,200,['Content-Type'=> 'application/vnd.api+json']));
    }

    public function update(Request $request, $id){
        $user = User::find($id);

        if (!empty($request->input('data.attributes.password'))) {
            $user->password = Hash::make($request->input('data.attributes.password'));
        }
        
        $user->email=$request->input('data.attributes.email');
        $user->nome=$request->input('data.attributes.nome');
        $user->data_nasc=$request->input('data.attributes.data_nasc');
        $user->endereco=$request->input('data.attributes.endereco');
        $user->bairro=$request->input('data.attributes.bairro');
        $user->cidade=$request->input('data.attributes.cidade');
        $user->estado=$request->input('data.attributes.estado');
        $user->pais=$request->input('data.attributes.pais');
        
        $user->save();

        $encoder = Encoder::instance([
            User::class => UserSchema::class
        ]); 

        return response($encoder->encodeData($user,200,['Content-Type'=> 'application/vnd.api+json']));

    }
}