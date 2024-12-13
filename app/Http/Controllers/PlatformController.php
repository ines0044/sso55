<?php

namespace App\Http\Controllers;

use App\Models\Created;
use App\Models\Platform;
use Illuminate\Http\Request;

class PlatformController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'usernames' => 'nullable|string|max:255', // usernames séparés par des virgules
            'redirect_url' => 'required|url',
        ]);

        $platform = Platform::create([
            'name' => $validated['name'],
            'redirect_url' => $validated['redirect_url'],
            'username' => $validated['usernames'],
        ]);

        if (!empty($validated['usernames'])) {
            $usernames = explode(',', $validated['usernames']);
            $usernames = array_map('trim', $usernames);

            $userIds = Created::whereIn('username', $usernames)->pluck('id');
            $platform->createds()->attach($userIds);
        }

        return redirect()->route('platforms.index')->with('success', 'Plateforme créée avec succès.');
    }
    

public function update(Request $request, $id)
{
    $validated = $request->validate([
        'name' => 'required|string|max:255|unique:platforms,name,' . $id,
        'usernames' => 'nullable|string', // usernames séparés par des virgules
        'redirect_url' => 'required|url',
    ]);

    
    $platform = Platform::findOrFail($id);

    
    $platform->update([
        'name' => $validated['name'],
        'redirect_url' => $validated['redirect_url'],
    ]);

    
    if (!empty($validated['usernames'])) {
        
        $usernames = explode(',', $validated['usernames']);
        $usernames = array_map('trim', $usernames);

        
        $platform->username = implode(',', $usernames);
        $platform->save();

        
        $userIds = Created::whereIn('username', $usernames)->pluck('id');
        $platform->createds()->sync($userIds); 
    } else {
        
        $platform->createds()->detach();
        $platform->username = null;
        $platform->save();
    }

    return redirect()->route('platforms.index')->with('success', 'Plateforme mise à jour avec succès.');
}

public function edit($id)
{
    $platform = Platform::with('createds')->findOrFail($id);
    $usernames = $platform->createds->pluck('username')->implode(', '); // Convertir les usernames en chaîne

    return view('platforms.edit', compact('platform', 'usernames'));
}
public function index()
    {
        $platforms = Platform::with('createds')->get();
        return view('platforms.index', compact('platforms'));
    }

    public function destroy($id)
    {
        $platform = Platform::findOrFail($id);
        $platform->delete();

        return redirect()->route('platforms.index')->with('success', 'Plateforme supprimée avec succès.');
    }

}
   