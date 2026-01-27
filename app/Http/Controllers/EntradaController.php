<?php

namespace App\Http\Controllers;

use App\Models\Entrada;
use App\Models\Produto;
use Illuminate\Http\Request;

class EntradaController extends Controller
{
    public function store(Request $request)
    {

        $produto = Produto::find($request->id_produto);

        if ($produto == null) {
            return response()->json('Este produto não existe.');
        } else {
            $entrada = Entrada::create([
                'id_produto' => $request->id_produto,
                'quantidade' => $request->quantidade
            ]);

            $soma = $produto->quantidade_estoque + $request->quantidade;
            $produto->quantidade_estoque = $soma;

            $produto->update();
            return response()->json($entrada);
        }
    }

    public function index()
    {
        $entradas = Entrada::all();

        return response()->json($entradas);
    }

    public function delete($id)
    {
        $entrada = Entrada::find($id);
        
        $produto = Produto::find($entrada->id_produto);

        if (!$entrada) {
            return response()->json('Entrada não encontrada.');
        } else {

            $entrada->delete();
            $produto->quantidade_estoque = $produto->quantidade_estoque - $entrada->quantidade;
            $produto->update();
            return response()->json('Entrada deletada com sucesso.');
        }
    }
}
