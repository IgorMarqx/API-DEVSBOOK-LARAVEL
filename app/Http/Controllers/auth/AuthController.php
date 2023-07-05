<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', [
            'except' => [
                'login',
                'create',
                'unauthorized',
            ]
        ]);
    }

    public function unauthorized()
    {
        return response()->json(['error' => 'Não autorizado.'], 401);
    }


    public function login(Request $request)
    {
        $array = ['error' => ''];

        $data = $request->only('email', 'password');

        if ($data['email'] && $data['password']) {
            $token = Auth::attempt($data);

            if (!$token) {
                $array['error'] = 'E-mail ou senha incorretos.';

                return $array;
            }

            $array['token'] = $token;
            return $array;
        }

        $array['error'] = 'Preencha os campos.';
        return $array;
    }

    public function logout()
    {
        Auth::logout();
        return ['error' => ''];
    }

    public function refresh()
    {
        $token = Auth::refresh();
        return [
            'error' => '',
            'token' => $token,
        ];
    }

    public function create(Request $request)
    {
        $array = ['error' => ''];

        $data = $request->only('name', 'email', 'password', 'birthdate');

        if ($data['name'] && $data['email'] && $data['password'] && $data['birthdate']) {
            if (strtotime($data['birthdate']) == false) {
                $array['error'] = 'Data de nascimento inválida.';
                return $array;
            }

            $emailExist = User::where('email', $data['email'])->count();

            if ($emailExist == 0) {
                $hash = Hash::make($data['password']);

                $user = User::create([
                    'name' => $data['name'],
                    'email' => $data['email'],
                    'password' => $hash,
                    'birthdate' => $data['birthdate'],
                ]);
                $user->save();

                $token = Auth::attempt($data);

                if (!$token) {
                    $array['error'] = 'Ocorreu um erro.';
                    return $array;
                }

                $array['token'] = $token;
            } else {
                $array['error'] = 'E-mail já cadastrado.';
                return $array;
            }
        } else {
            $array['error'] = 'Preencha todos os campos.';
            return $array;
        }

        return $array;
    }
}
