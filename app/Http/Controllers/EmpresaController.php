<?php

namespace App\Http\Controllers;

use App\Models\Empresa;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Validator;
use Throwable;

class EmpresaController extends Controller
{
    private $empresa;

    public function __construct(Empresa $empresa)
    {
        $this->empresa = $empresa;
    }

    public function paginatedEmpresa()
    {
        return Empresa::paginate(30);
    }

    public function allEmpresa()
    {
        return Empresa::all();
    }

    public function findEmpresa($id)
    {
        return $this->empresa->findOrFail($id);
    }

    public function showEmpresas()
    {
        $response = Http::get('https://viacep.com.br/ws/01001000/json/');
        // $response = Http::get('https://jsonplaceholder.typicode.com/todos');        
        $data = $response->object();
        
        if(array_key_exists (0,$response->json())){
            $keys = array_keys((array)$data[0]);
            $multiple = true;
        }else{
            $keys = array_keys((array)$data);
            $multiple = false;
        }

        return view('Consultas.Empresa',compact('data','keys','multiple'));
    }

    public function registerEmpresa(Request $request)
    {
        $data = $request::all();
        
        if(!$this->validar_cnpj($data['cnpj'])){
            return response()->json(['error'=>'CNPJ inválido'],400);
        }

        $validator = Validator::make($data, [
            'nome' => 'required|max:255',
            'telefone' => 'required|max:255',
            'cnpj' => 'required|max:14',
        ]);
    
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()],400);
        }

        try {
            Empresa::create($data);
        } catch (Throwable $e) {
            return response()->json(['error'=>'Erro na inserção'],400);
        }

        return response()->json(['success' => 'Empresa cadastrada com sucesso!']);
    }

    public function validar_cnpj($cnpj)
    {
        $cnpj = preg_replace('/[^0-9]/', '', (string) $cnpj);
        
        // Valida tamanho
        if (strlen($cnpj) != 14)
            return false;

        // Verifica se todos os digitos são iguais
        if (preg_match('/(\d)\1{13}/', $cnpj))
            return false;	

        // Valida primeiro dígito verificador
        for ($i = 0, $j = 5, $soma = 0; $i < 12; $i++)
        {
            $soma += $cnpj[$i] * $j;
            $j = ($j == 2) ? 9 : $j - 1;
        }

        $resto = $soma % 11;

        if ($cnpj[12] != ($resto < 2 ? 0 : 11 - $resto))
            return false;

        // Valida segundo dígito verificador
        for ($i = 0, $j = 6, $soma = 0; $i < 13; $i++)
        {
            $soma += $cnpj[$i] * $j;
            $j = ($j == 2) ? 9 : $j - 1;
        }

        $resto = $soma % 11;

        return $cnpj[13] == ($resto < 2 ? 0 : 11 - $resto);
    }
}
