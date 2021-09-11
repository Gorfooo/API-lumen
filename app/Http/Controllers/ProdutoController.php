<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

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
}
