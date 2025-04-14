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
        $taches = Auth::user()->taches()->latest()->get();
        return response()->json($taches);
        
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
    // public function toggle(Tache $tache)
    // {
    //     // $this->authorize('update', $tache);
        
    //     $tache->update(['completed' => !$tache->completed]);
        
    //     return $tache;
    // }

        public function toggle(Tache $tache)
    {
        if (auth()->id() !== $tache->user_id) {
            return response()->json(['message' => 'Action non autorisée'], 403);
        }

        $tache->update(['completed' => !$tache->completed]);

        return response()->json($tache);
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


    public function filterByStatus($status)
    {
        $user = Auth::user(); // Auth sécurisé
        
        if (!$user) {
            return response()->json(['message' => 'Non authentifié'], 401);
        }
    
        $completed = $status === 'completed';
        
        $taches = $user->taches()->where('completed', $completed)->get();
        
        return response()->json($taches);
    }
    
    public function allTasks()
    {
        $tasks = Task::with('user')->get();
        return response()->json($tasks);
    }
       
    public function getAllWithUser()
    {
        $taches = \App\Models\Tache::with('user')->latest()->get();
        return response()->json($taches);
    }
    

    

}
