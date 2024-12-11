<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
        if($role === 'host' && $this->players()->wherePivot('role', 'host')->exists()){
            throw ValidationException::withMessages(['role' => 'This game already has a host.']);
        }

        if($role === 'player' && $this->players()->wherePivot('role','player')->count() >= ($this->max_players -1)){
            throw ValidationException::withMessages(['game'=>'This game is full.']);
        }

        $this->players()->attach($user_id, ['role' => $role, 'joined_at' => now()]);
    }
}
