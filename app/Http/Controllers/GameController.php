<?php

namespace App\Http\Controllers;

use App\Models\Game;
use Illuminate\View\View;
use App\Http\Requests\GameRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;

class GameController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $games = Game::with('players')->get();
        return view('games.index')->with('games', $games);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('games.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(GameRequest $request)
    {
        DB::beginTransaction();

        try {
            $game = Game::create($request->validated());
            $game->created_at = now();
            $game->join(auth()->id(), 'host');

            DB::commit();

            return redirect('/games')->with('message', "Game created successfully!");

        } catch (\Exception $e){
            Log::error('Failed to create game: ' . $e->getMessage());

            if (isset($game)){
                $game->delete();
            }
            return back()->withInput()->with('message', "Failed to create game. Please try again.");
        }
        
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(GameRequest $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
