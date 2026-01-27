<?php

namespace App\Http\Controllers;

use App\Models\Saida;
use Illuminate\Http\Request;

class SaidaController extends Controller
{
    public function store(Request $request) {
        $saida = Saida::create([
            'id_produto'=> $request->id_produto,
            'id_cliente'=> $request->id_cliente,
            'quantidade'=> $request->quantidade
        ]);

        return response()->json($saida);
    }

    public function index(){
        $saidas = Saida::all();

        return response()->json($saidas);
    }

    public function delete($id){
        $saida = Saida::find($id);

        if (!$saida) {
            return response()->json('Saida não encontrada.');
        }

        $saida->delete();

        return response()->json('Saida deletada com sucesso.');
    }
}
