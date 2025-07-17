<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
  public function returnRegisterView()
  {
    return view('register');
  }

  public function returnLoginView()
  {
    return view('login');
  }


  public function handleRegister(Request $request)
  {
    $validated = $request->validate([
      'name' => 'required|string|max:255',
      'email' => 'required|email|unique:users,email',
      'password' => 'required|string|min:6',
    ]);

    $user = new User();
    $user->name = $validated['name'];
    $user->email = $validated['email'];
    $user->password = bcrypt($validated['password']);
    $user->email_verified_at = now();
    $user->save();

    Auth::login($user);

    return response()->json([
      'success' => true,
      'user' => $user,
      'redirect' => '/'
    ]);
  }

  public function handleLogin(Request $request)
  {
    $credentials = $request->validate([
      'email' => 'required|email',
      'password' => 'required|string',
    ]);

    if (Auth::attempt($credentials)) {
      $request->session()->regenerate();
      return response()->json([
        'success' => true,
        'user' => Auth::user(),
        'redirect' => '/'
      ]);
    }

    return response()->json([
      'success' => false,
      'message' => 'Credenciales incorrectas.'
    ], 401);
  }

  public function handleLogout()
  {
    Auth::logout();
    return redirect('/');
  }
}
