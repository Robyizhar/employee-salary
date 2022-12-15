<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Auth;
use Validator;
use App\Models\User;


class AuthController extends Controller {

    public function login(Request $request) {

        $this->validate($request, [
            'email'    => 'required|email',
            'password' => 'required|string',
        ]);

        // return $this->respond($request, 'Berhasil Login.',  200);

        $user = User::where('email', $request->email)->has('roles')->first();

        if (empty($user) || !Hash::check($request->password, $user->password)) {
            return $this->respondWithError('User Kredensial tidak ditemukan', 400);
        }

        $credentials = [
            'tokenType' => 'Bearer',
            'accessToken' => $user->createToken($user->name, ['admin'])->plainTextToken
        ];

        return $this->respond($credentials, 'Berhasil Login.',  200);
    }

    public function logout() {
        auth()->user()->tokens()->delete();
        return [
            'message' => 'You have successfully logged out and the token was successfully deleted'
        ];
    }
}
