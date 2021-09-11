<?php

namespace App\Http\Controllers;

use App\Models\Empresa;
use Illuminate\Support\Facades\Http;

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
}
