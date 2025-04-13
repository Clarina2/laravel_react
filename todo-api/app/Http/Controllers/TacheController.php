<?php

namespace App\Http\Controllers;

use App\Models\tache;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TacheController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $user = tache::user();
        // $tache = \App\Models\tache::with('user')->latest()->get();
    
        // return response()->json([
        //     'me' => $user->id,
        //     'tache' => $tache
        // ]);

        $taches = Auth::user()->taches()->latest()->get();
        return response()->json($taches);
        
        // // Filtre par statut
        // if ($request->has('statut')) {
        //     $query->where('completed', $request->statut === 'termine');
        // }
        
        // // Filtre par catégorie (option bonus)
        // if ($request->has('categorie')) {
        //     $query->where('category', $request->categorie);
        // }
        
        // // Option bonus: voir les tâches des autres utilisateurs
        // if ($request->has('voir_tous') && $request->voir_tous === 'true') {
        //      // Admin peut voir toutes les tâches
        //      if (Auth::user()->is_admin) {
        //         return $query->with('user')->latest()->get();
        //     }
        //     // Sinon seulement les tâches publiques des autres
        //     $query->where(function($q) {
        //         $q->where('user_id', Auth::id())
        //           ->orWhere('is_public', true);
        //     });
        // } else {
        //     // Par défaut, seulement les tâches de l'utilisateur
        //     $query->where('user_id', Auth::id());
        // }
        
        // return $query->latest()->get();
    }
   

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'completed' => 'boolean',
            
        ]);
        
        $tache = Auth::user()->taches()->create([
            'title' => $request['title'],
            'description' => $request['description'],
            'completed' => false,
            
        ]);

        return response()->json($tache, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\tache  $tache
     * @return \Illuminate\Http\Response
     */
    public function show(tache $tache)
    {
        return response()->json($tache->load('user'));
       
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\tache  $tache
     * @return \Illuminate\Http\Response
     */
    // public function update(Request $request, tache $tache)
    // {
    //     $this->authorize('update', $tache);

    //     if (Auth::id() !== $tache->user_id) {
    //         return response()->json(['message' => 'Pas autorisé'], 403);
    //     }
        

    //     $request->validate([
    //         'title' => 'required|string|max:255',
    //         'description' => 'nullable|string',
    //         'completed' => 'boolean',
    //     ]);

    //     $tache->update($request->all());

    //     // return $tache;
    //     return response()->json($tache);
    // }

        public function update(Request $request, $id)
    {
        $tache = Tache::findOrFail($id);

        if (Auth::id() !== $tache->user_id) {
            return response()->json(['message' => 'Action non autorisée'], 403);
        }

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'completed' => 'boolean',
        ]);

        $tache->update($request->all());

        return response()->json($tache);
    }


    /**
     * Basculer le statut d'une tâche (terminé/non terminé)
     *
     * @param  \App\Models\Tache  $tache
     * @return \Illuminate\Http\Response
     */
    public function toggle(Tache $tache)
    {
        $this->authorize('update', $tache);
        
        $tache->update(['completed' => !$tache->completed]);
        
        return $tache;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\tache  $tache
     * @return \Illuminate\Http\Response
     */
    // public function destroy(tache $tache)
    // {
    //     $this->authorize('delete', $tache);
        
    //     $tache->delete();
        
    //     return response()->json(null, 204);
    // }

        public function destroy(tache $tache)
    {
        if (Auth::id() !== $tache->user_id) {
            return response()->json(['message' => 'Action non autorisée'], 403);
        }

        $tache->delete();

        return response()->json(null, 204);
    }

}
