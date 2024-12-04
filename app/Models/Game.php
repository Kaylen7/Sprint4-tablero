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
        'email',
        'password',
        'address',
        'avatar'
    ];

    public function users(){
        return $this->belongsToMany(User::class, table:'game_players')
                    ->withPivot('user_id', 'role');
    }
}
