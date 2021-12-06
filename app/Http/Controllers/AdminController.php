<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function login(Request $request)
    {
        $data = $request->all();

        session_start();

        if (
            $data['username'] == env('ADM_LOGIN') && $data['password'] == env('ADM_PASSWORD')
            || $_SESSION["LOGADO"] == true
        ) {
            $_SESSION["LOGADO"] = true;
            $users = User::all();
            return view('Consultas.Admin', compact('users'));
        } else {
            return response()->json(['response' => 'Unauthorized'], 401);
        };
    }

    public function revokeToken(Request $request)
    {
        $id = $request->id;

        $user = User::findOrFail($id);

        $user->token = 'Revoked';
        $user->save();

        return redirect()->route('adminView');
    }

    public function removeToken(Request $request)
    {
        $id = $request->id;

        $user = User::findOrFail($id);

        $user->token = 'Removido';
        $user->save();

        return redirect()->route('adminView');
    }

    public function showView()
    {
        $users = User::all();
        return view('Consultas.Admin', compact('users'));
    }

    public function showLogin()
    {
        return view('AdmLogin');
    }

    public function logout()
    {
        session_start();
        $_SESSION["LOGADO"] = false;

        return redirect()->route('adminLogin');
    }
}
