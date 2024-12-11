<?php

namespace App\Http\Controllers;

use App\Models\Game;
use Illuminate\View\View;
use App\Policies\GamePolicy;
use Illuminate\Http\Request;
use App\Http\Requests\GameRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class GameController extends Controller
{
    use AuthorizesRequests;
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $user = auth()->user();
        
        if($request->query('hosted')){
           $games = $user->hostedGames()->get();
        } else {
            $games = Game::with('players')->get();
        }
        
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
        $game = Game::find($id);
        if (!$game){
            return back()->with('message', "Failed to find game.");
        }

        return view('games.show')->with('game', $game);
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $game = Game::find($id);
        if (!$game){
            return back()->with('message', "Failed to find game.");
        }
        try{
            $this->authorize('update', $game);
        } catch(\Exception $e){
            return back()->with('message', "You can only edit games you host.");
        }
        
        
        return view('games.edit')->with('game', $game);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(GameRequest $request, string $id)
    {
        $game = Game::find($id);
        $game->is_private = $request->is_private != '1' ? false : true;
        $game->update($request->only(['name', 'max_players', 'event_time', 'address', 'boardgame_name']));

        return redirect()->route('games.index')->with('message', 'Game updated sucessfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $game = Game::find($id);
        if (!$game){
            return back()->with('message', "Failed to find game.");
        }
        try{
            $this->authorize('delete', $game);
        } catch(\Exception $e){
            return back()->with('message', "You can only remove games you host.");
        }
        $game->delete();
        return redirect()->route('games.index')->with('message', 'Game removed.');
    }
}
