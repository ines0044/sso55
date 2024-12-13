<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Created; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Platform;


class AdminController extends Controller
{
    public function showLoginForm()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        $user = User::where('username', $request->username)->first();
        $credentials = $request->only('username', 'password');

        if ($user && Auth::attempt($credentials)) {
            $user = Auth::user();
            if ($user->is_admin==1) {
                return redirect()->route('adminpage'); 
            } else {
                return redirect()->route('utilisateurs'); 
            }
        }

        $createdUser = Created::where('username', $request->username)->first();

        if ($createdUser && Hash::check($request->password, $createdUser->password)) {
            Auth::loginUsingId($createdUser->id);

            return redirect()->route('createdpage'); 

        return back()->withErrors(['username' => 'Identifiants incorrects']);
    }
}
public function showAdminPage()
    {
        $platforms = Platform::all(); // Récupère toutes les plateformes
        return view('adminpage', compact('platforms')); // Passe $platforms à la vue
    }
    

}