<?php


namespace App\Models;
// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Support\Facades\DB;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'alias',
        'email',
        'password',
        'address',
        'avatar'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function games(){
        return $this->belongsToMany(Game::class, table:"game_players")
                    ->withPivot('joined_at', 'role', 'game_id')
                    ->withTimestamps();
    }

    public function hostedGames(){
        return $this->games()->wherePivot('role', 'host');
    }

    public function joinGame(Game $game, string $role='player'): void{
        $game->join($this, $role);
    }

    public function getFriends(){

        $allEntries = $this->getFriendRequests();
        $friendIds = $allEntries->flatMap(function ($friend) {
            return [$friend->user_id_one, $friend->user_id_two];
        })
        ->reject(fn($id) => $id === $this->id)
        ->unique()
        ->values();

        $users = User::whereIn('id', $friendIds)->get();

        $usersWithPivot = $users->map(function($user) use ($allEntries){
            $pivot = $allEntries->first(function ($entry) use ($user){
                return ($entry->user_id_one === $user->id && $entry->user_id_two === $this->id) || ($entry->user_id_two === $user->id && $entry->user_id_one === $this->id);
            });
            $user->status = $pivot->status ?? null;
            $user->start_date = $pivot->start_date ?? null;

            return $user;
        });

        return $usersWithPivot;
    }

    public function addFriend(User $user): void{
        $friend_id = $user->id;
        if($this->id === $friend_id){
            throw new \Exception ("Great self-love, but can't be registered here.");
        }
        
        $min = min($this->id, $friend_id);
        $max = max($this->id, $friend_id);

        $alreadyFriends = DB::table('friends')
                        ->where('user_id_one', $min)
                        ->where('user_id_two', $max)
                        ->exists();
        if($alreadyFriends){
            throw new \Exception ("Friendship registered already. Find other friends.");
        }

        DB::table('friends')->insert([
            'user_id_one' => $min,
            'user_id_two' => $max,
            'start_date' => now()
        ]);
    }

    public function getFriendRequests(){
        return DB::table('friends')
        ->where('user_id_one', $this->id)
        ->orWhere('user_id_two', $this->id)
        ->get();
    }

    public function changeFriendRequestStatus(int $senderId, string $status){
        $min = min($this->id, $senderId);
        $max = max($this->id, $senderId);

        $type = match($status){
            'accepted' => 'accepted',
            'blocked' => 'blocked',
            default => throw new \Exception('Unrecognized status')
        };

        return DB::table('friends')
        ->where('user_id_one', $min)
        ->where('user_id_two', $max)
        ->update(['status' => $type]);
    }

    public function removeFriendRequest(int $userId){
        $min = min($this->id, $userId);
        $max = max($this->id, $userId);

        return DB::table('friends')
        ->where('user_id_one', $min)
        ->where('user_id_two', $max)
        ->delete();
    }

    public function removeNotification(string $notificationId){
        return DB::table('notifications')
        ->where('id', $notificationId)
        ->delete();
    }
}
