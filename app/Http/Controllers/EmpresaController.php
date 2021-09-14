<?php

namespace App\Http\Controllers;

use App\Models\Empresa;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;

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

    public function findEmpresa($id)
    {
        return $this->empresa->findOrFail($id);
    }

    public function showEmpresas()
    {
        $response = Http::get('');
        return $response->body();
        // return view('Consultas.Empresa',compact('response'));
    }

    public function registerEmpresa(Request $request)
    {
        $data = $request->all();
        Empresa::create($data);
    }
}
