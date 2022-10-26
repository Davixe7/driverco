<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
  public function getLogin(Request $request)
  {
    $request->validate([
      'email' => 'required'
    ]);

    $user = User::where('phone', $request->email)->first();

    if ($user) {
      $password = sprintf('%06d', random_int(0, 999999));
      $user->update(['password' => bcrypt($password)]);
      Storage::append('passwords.log', $user->name . " " . $password);
    }
    return response()->json(['data' => 'Message sent']);
  }

  public function login(Request $request)
  {
    $request->validate([
      'email' => 'required',
      'password' => 'required',
    ]);

    $user = User::where('phone', $request->email)->first();

    if (!$user || !Hash::check($request->password, $user->password)) {
      throw ValidationException::withMessages([
        'email' => ['Las credenciales son incorrectas'],
      ]);
    }

    return $user->createToken('main_device')->plainTextToken;
  }
}
