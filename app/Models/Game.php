<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Game extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'is_private',
        'max_players',
        'event_time',
        'joined_at',
        'created_at',
        'updated_at',
        'address',
        'boardgame_name',
        'place_id',
        'boardgame_id'
    ];

    protected $casts = [
        'event_time' => 'datetime'
    ];

    public function players(){
        return $this->belongsToMany(User::class, table:'game_players')
                    ->withPivot('user_id', 'role');
    }

    public function join(int $user_id, string $role = 'player'): void{

        $gameHostId = $this->players()->wherePivot('role', 'host')->pluck('user_id');
        $host = User::find($gameHostId)->first();
        $hostFriends = $host->getFriends();
        if($this->is_private && !$hostFriends->contains($user_id)){
            throw new \Exception("Can't join foreign game.");
        }

        if($role === 'host' && $this->players()->wherePivot('role', 'host')->exists()){
            throw new \Exception('This game already has a host.');
        }

        if($role === 'player' && $this->players()->wherePivot('role','player')->count() >= ($this->max_players -1)){
            throw new \Exception('This game is full.');
        }

        if($this->players()->find($user_id)){
            throw new \Exception('You are already in the game.');
        }

        $this->players()->attach($user_id, ['role' => $role, 'joined_at' => now()]);
    }

    public function inGame(int $user_id){
        return $this->players()->find($user_id);
    }

    public function leave(int $user_id){
        $inGame = $this->inGame($user_id);
        if($inGame){
            $this->players()->detach($user_id);
        } else {
            throw new \Exception("Can't leave a game you never joined.");
        }
    }
}
