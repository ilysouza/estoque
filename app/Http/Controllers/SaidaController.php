<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Produto;
use App\Models\Saida;
use Illuminate\Http\Request;

class SaidaController extends Controller
{
    public function store(Request $request) {

        $produto = Produto::find($request->id_produto);
        $cliente = Cliente::find($request->id_cliente);

        if ($produto->faixa_etaria_minima > $cliente->idade) {
            return response()->json('A sua idade é inferior a idade permitida do produto. Não será possível realizar a compra.');
        } else {

        $saida = Saida::create([
                    'id_produto'=> $request->id_produto,
                    'id_cliente'=> $request->id_cliente,
                    'quantidade'=> $request->quantidade
                ]);

        $produto->quantidade_estoque = $produto->quantidade_estoque - $request->quantidade;

        $produto->update();
        return response()->json($saida);
        }
        
    }

    public function index(){
        $saidas = Saida::all();

        return response()->json($saidas);
    }

    public function delete($id){
        $saida = Saida::find($id);

        $produto = Produto::find($saida->id_produto);

        if (!$saida) {
            return response()->json('Saida não encontrada.');
        } else {

        $saida->delete();
        $produto->quantidade_estoque = $produto->quantidade_estoque + $saida->quantidade;
        $produto->update();
        return response()->json('Saida deletada com sucesso.');
        }

        
    }
}
