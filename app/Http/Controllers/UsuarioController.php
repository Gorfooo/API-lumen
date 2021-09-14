<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;

class UsuarioController extends Controller
{
    private $usuario;

    public function __construct(Usuario $usuario)
    {
        $this->usuario = $usuario;
    }

    public function paginatedUsuario()
    {
        return DB::table('usuarios')
            ->join('empresas', 'usuarios.empresa_id', '=', 'empresas.id')
            ->select('usuarios.id', 'usuarios.nome', 'usuarios.telefone', 
            'usuarios.cpf', 'empresas.cnpj', 'usuarios.created_at', 'usuarios.updated_at')
            ->paginate(10);
    }

    public function findUsuario($id)
    {
        return $this->usuario->findOrFail($id);
    }

    public function showUsuarios()
    {
        $response = Http::get('');
        return $response->body();
        // return view('Consultas.Empresa',compact('response'));
    }

    public function registerUsuario(Request $request)
    {
        $data = $request->all();
        dd($data);
        // Usuario::create($data);
    }
}
