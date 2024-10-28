<?php

namespace App\Http\Controllers;

use App\Models\Vendedor;
use App\Responses\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class VendedorController extends Controller
{
    public function salvar(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nome' => 'required|string|max:200',
            'cpf' => 'required|string|max:15',
            'ano de nascimento' => 'required|int'
        ]);

        if ($validator->fails()) {
            return ApiResponse::error ($validator->errors(), 'Validation error');
        }

        $customer = Vendedor::create($request->all());
        return ApiResponse::ok('Vendedor salvo com sucesso', $customer);
    }

    public function editar(Request $request, int $id)
    {
        $validator = Validator::make($request->all(), [
            'nome' => 'required|string|max:200',
            'cpf' => 'required|string|max:15',
            'ano de nascimento' => 'required|int'
        ]);

        if ($validator->fails()) {
            return ApiResponse::error ($validator->errors(), 'Validation error');
        }

        $customer = Vendedor::findOrFail($id);
        $customer->update($request->all());

        return ApiResponse::ok('Vendedor atualizado com sucesso', $customer);
    }

    public function listar()
    {
        $customers = Vendedor::all();
        return ApiResponse::ok('Lista de vendedores', $customers);
    }

    public function listarPeloId(int $id)
    {
        $customer = Vendedor::findOrFail($id);

        return ApiResponse::ok('Vendedor a ser listado', $customer);
    }

    public function excluir(int $id)
    {
        $customer = Vendedor::findOrFail($id);
        $customer->delete();

        return ApiResponse::ok('Vendedor removido com sucesso');
    }
}
