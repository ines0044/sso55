<?php

namespace App\Http\Controllers;

use App\Models\Created;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use App\Models\Platform;

class CreatedController extends Controller
{    
    public function store(Request $request)
    {
       
        $validated = $request->validate([
            'username' => ['required', 'string', 'max:255', Rule::unique('createds', 'username')],
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'phone' => 'required|numeric|max:999999999999999',
            'email' => ['required', 'email', Rule::unique('createds', 'email')],
            'password' => 'required|string|min:8|confirmed',
            
        ], [
            
            'username.unique' => 'Le nom d\'utilisateur est déjà pris.',
            'email.unique' => 'Cet email est déjà utilisé.',
            'password.confirmed' => 'Les mots de passe ne correspondent pas.',
            'phone.numeric' => 'Le numéro de téléphone doit être composé uniquement de chiffres.',
            'password.min' => 'Le mot de passe doit avoir au moins 8 caracteres',
            'platform_id.exists' => "La plateforme sélectionnée n'existe pas.",
        
        ]);



        $validated['password'] = bcrypt($validated['password']);

        $created = Created::create($validated);

        // Si une plateforme est sélectionnée, associer l'utilisateur à la plateforme
        if ($request->platform_id) {
            $platform = Platform::find($request->platform_id);
            $platform->createds()->attach($created->id); // Relation pivot pour associer
        }

    return redirect()->route('created.index')->with('success', 'Utilisateur créé avec succès');
    }
        
    public function index()
    {
        $createds = Created::all();
        return view('utilisateurs', compact('createds'));
    }
    public function destroy($id)
    {
        $user = Created::findOrFail($id);
        $user->delete();
        return redirect()->route('created.index')->with('success', 'Utilisateur supprimé avec succès.');
    }
    public function getIsAdminAttribute()
   {
    return $this->is_admin === 1 ; 
   }
   public function edit($id)
   {
       $created = Created::findOrFail($id); 
       return view('edit', compact('created')); 
   }

   
   public function update(Request $request, $id)
   {
       $request->validate([
           'username' => 'required',
           'first_name' => 'required',
           'last_name' => 'required',
           'phone' => 'required|numeric',
           'email' => 'required|email',
       ]);

       $created = Created::findOrFail($id);
       $created->username = $request->input('username');
       $created->first_name = $request->input('first_name');
       $created->last_name = $request->input('last_name');
       $created->phone = $request->input('phone');
       $created->email = $request->input('email');
       $created->save();

       return redirect()->route('created.index')->with('success', 'Utilisateur mis à jour avec succès!');
    }
    
} 

