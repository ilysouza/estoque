<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    //

    public function store(Request $request)
    {
        $verificacao = Cliente::where('cpf', '=', $request->cpf)->first();

        if ($verificacao == null) {
            $cliente = Cliente::create([
            'nome'=> $request->nome,
            'cpf'=> $request->cpf,
            'idade'=> $request->idade
        ]);
        
            return response()->json($cliente);

        } else {
             return response()->json('Este CPF já está sendo utilizado.');
    }

    }

    public function index()
    {
        $clientes = Cliente::all();

        return response()->json($clientes);
    }

    public function show($id)
    {
        $cliente = Cliente::find($id);

        if (!$id) {
            return response()->json('Cliente não encontrado.');
        }
        return response()->json($cliente);
    }

    public function update($id, Request $request)
    {
        $verificacao = Cliente::where('cpf', '=', $request)->first();
        $cliente = Cliente::find($id);

        if (!$cliente) {
            return response()->json('Cliente não encontrado...');
        }

        if (isset($request->nome)) {
            $cliente->nome = $request->nome;
        }
        if (isset($request->cpf)) {
            $cliente->cpf = $request->cpf;
        }
        if (isset($request->idade)) {
            $cliente->idade = $request->idade;
        }

        $cliente->update();

        return response()->json($cliente);
    }

    public function delete($id)
    {
        $cliente = Cliente::find($id);

        if (!$cliente) {
            return response()->json('Cliente não encontrado...');
        }
        $cliente->delete();

        return response()->json('Cliente deletado com sucesso.');
    }
}
