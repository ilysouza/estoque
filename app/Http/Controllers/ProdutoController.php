<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use Illuminate\Http\Request;
use Spatie\FlareClient\View;

class ProdutoController extends Controller
{
    //

    public function store(Request $request){
        $produto = Produto::create([
            'marca'=> $request->marca,
            'descricao'=> $request->descricao,
            'valor_unitario'=> $request->valor_unitario,
            'quantidade_estoque'=> $request->quantidade_estoque,
            'faixa_etaria_minima'=> $request->faixa_etaria_minima
        ]);
        return response()->json($produto);
    }

    public function index(){
        $produtos = Produto::all();

        return response()->json($produtos);
    }

    public function show($id){
        $produto = Produto::find($id);

        if (!$id) {
            return response()->json('Produto não encontrado.');
        }
        return response()->json($produto);
    }

    public function update($id, Request $request)
    {
        $produto = Produto::find($id);

        if (!$produto) {
            return response()->json('Produto não encontrado...');
        }

        if (isset($request->marca)) {
            $produto->marca = $request->marca;
        }
        if (isset($request->descricao)) {
            $produto->descricao = $request->descricao;
        }
        if (isset($request->valor_unitario)) {
            $produto->valor_unitario = $request->valor_unitario;
        }
        if (isset($request->quantidade_estoque)) {
            $produto->quantidade_estoque = $request->quantidade_estoque;
        }
        if (isset($request->faixa_etaria_minima)) {
            $produto->faixa_etaria_minima = $request->faixa_etaria_minima;
        }

        $produto->update();

        return response()->json($produto);
    }

    public function delete($id)
    {
        $produto = Produto::find($id);

        if (!$produto) {
            return response()->json('Produto não encontrado...');
        }
        $produto->delete();

        return response()->json('Produto deletado com sucesso.');
    }

}
