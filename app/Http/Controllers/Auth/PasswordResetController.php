<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class PasswordResetController extends Controller
{
    public function sendResetLink(Request $request)
    {
        // Validar el correo electrónico
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|exists:users,email',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }

        // Personalizar el enlace de restablecimiento
        $status = Password::broker()->sendResetLink(
            $request->only('email'),
            function ($user, $token) {
                // Construir la URL completa con el token
                $url = $token . '?email=' . urlencode($user->email);

                // Puedes personalizar el correo aquí
                $user->sendPasswordResetNotification($url);
            }
        );

        return $status === Password::RESET_LINK_SENT
            ? response()->json(['status' => 'email enviado'])
            : response()->json(['error' => __($status)], 500);
    }

    public function resetPassword(Request $request)
    {
        // Validar la solicitud
        $validator = Validator::make($request->all(), [
            'token' => 'required',
            'email' => 'required|email|exists:users,email',
            'password' => 'required|min:8',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }

        // return response()->json( $request);

        // Intentar restablecer la contraseña
        $status = Password::reset(
            $request->only('email', 'password', 'token'),
            function ($user, $password) {
                $user->forceFill([
                    'password' => Hash::make($password)
                ])->save();
            }
        );

        return $status === Password::PASSWORD_RESET
            ? response()->json(['status' => __($status)])
            : response()->json(['error' => __($status)], 500);
    }
}
