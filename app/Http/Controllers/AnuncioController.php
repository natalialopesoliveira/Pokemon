<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AnuncioController extends Controller
{
    public function create(Request $request)
    {

        $conta= new Conta;
        $conta->nome= $request->nome;
        $conta->email= $request->email;
        $conta->empresa= $request->empresa;
        $conta->segmento= $request->segmento;
        $conta->estado= $request->estado;
        $conta->senha= $request->senha;

        $conta->save();

        // return redirect('/...');
    }

}
