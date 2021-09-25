<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Validator;
use Throwable;

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
            'usuarios.cpf', 'empresas.cnpj', 'usuarios.created_at')
            ->paginate(10);
    }

    public function allUsuario()
    {
        return DB::table('usuarios')
            ->join('empresas', 'usuarios.empresa_id', '=', 'empresas.id')
            ->select('usuarios.id', 'usuarios.nome', 'usuarios.telefone', 
            'usuarios.cpf', 'empresas.cnpj', 'usuarios.created_at')
            ->get();
    }

    public function findUsuario($id)
    {
        return $this->usuario->findOrFail($id);
    }

    public function showUsuarios()
    {
        // $response = Http::get('https://viacep.com.br/ws/01001000/json/');
        $response = Http::get('https://jsonplaceholder.typicode.com/todos');        
        $data = $response->object();
        
        if(array_key_exists (0,$response->json())){
            $keys = array_keys((array)$data[0]);
            $multiple = true;
        }else{
            $keys = array_keys((array)$data);
            $multiple = false;
        }

        return view('Consultas.Usuario',compact('data','keys','multiple'));
    }

    public function registerUsuario(Request $request)
    {
        $data = $request->all();

        if(!$this->validaCPF($data['cpf'])){
            return response()->json(['error'=>'CPF inválido'],400);
        }

        $validator = Validator::make($data, [
            'nome' => 'required|max:255',
            'telefone' => 'required|max:255',
            'empresa_id' => 'required|max:20|exists:empresas,id',
        ]);
    
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()],400);
        }

        try {
            Usuario::create($data);
        } catch (Throwable $e) {
            return response()->json(['error'=>'Erro na inserção'],400);
        }
        
        return response()->json(['success' => 'Usuario cadastrado com sucesso!']);
    }

    public function validaCPF($cpf) {
 
        // Extrai somente os números
        $cpf = preg_replace( '/[^0-9]/is', '', $cpf );
         
        // Verifica se foi informado todos os digitos corretamente
        if (strlen($cpf) != 11) {
            return false;
        }
    
        // Verifica se foi informada uma sequência de digitos repetidos. Ex: 111.111.111-11
        if (preg_match('/(\d)\1{10}/', $cpf)) {
            return false;
        }
    
        // Faz o calculo para validar o CPF
        for ($t = 9; $t < 11; $t++) {
            for ($d = 0, $c = 0; $c < $t; $c++) {
                $d += $cpf[$c] * (($t + 1) - $c);
            }
            $d = ((10 * $d) % 11) % 10;
            if ($cpf[$c] != $d) {
                return false;
            }
        }
        return true;
    }
}
