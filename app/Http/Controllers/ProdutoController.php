<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Validator;
use Throwable;

class ProdutoController extends Controller
{
    private $produto;

    public function __construct(Produto $produto)
    {
        $this->produto = $produto;
    }

    public function paginatedProduto()
    {
        return DB::table('produtos')
            ->join('usuarios', 'produtos.usuario_id', '=', 'usuarios.id')
            ->select('produtos.id', 'produtos.nome', 'produtos.quanto', 'produtos.ncm', 'usuarios.cpf',
            'produtos.created_at', 'produtos.updated_at')
            ->paginate(10);
    }

    public function findProduto($id)
    {
        return $this->produto->findOrFail($id);
    }

    public function showProdutos()
    {
        $response = Http::get('');
        return $response->body();
        // return view('Consultas.Empresa',compact('response'));
    }

    public function registerProduto(Request $request)
    {
        $data = $request->all();

        $validator = Validator::make($data, [
            'nome' => 'required|max:255',
            'quanto' => 'required|numeric|between:-999999,999999',
            'ncm' => 'required|integer|digits_between:0,8',
            'usuario_id' => 'required|max:20|exists:usuarios,id',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()],400);
        }

        try {
            Produto::create($data);
        } catch (Throwable $e) {
            return response()->json(['error'=>'Erro na inserção'],400);
        }
        
        return response()->json(['success' => 'Produto cadastrado com sucesso!']);
    }
}
