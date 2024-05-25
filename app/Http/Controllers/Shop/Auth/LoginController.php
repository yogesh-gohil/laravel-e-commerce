<?php

namespace App\Http\Controllers\Shop\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    public function __invoke(Request $request)
    {
        $user = User::whereRole('user')->whereEmail($request->email)->first();

        if (! Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }

        if ($user && $user->status !== User::STATUS_ACTIVE) {
            throw ValidationException::withMessages([
                'error' => ['User is not active.'],
            ]);
        }

        return response()->json([
            'token' => $user->createToken('default', [])->accessToken,
        ]);
    }
}
