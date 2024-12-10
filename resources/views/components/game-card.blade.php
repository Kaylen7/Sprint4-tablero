<div class="p-4 border rounded shadow">
    <h2 class="text-lg font-bold">{{ $game->name ?? $game->boardgame_name }}</h2>
    {{$game->address ?? $game->place_id}}
    <p>{{$game->event_time->format('d/m/Y H:i')}}</p>
    @foreach ($game->players as $player)
    <span class="font-bold">{{$player->pivot->role === 'host' ? '@' . $player->alias : ''}}</span>
    @endforeach
    <p>{{ $game->is_private ? 'private' : 'public' }}</p>
    <p><i class="fa-solid fa-user"></i> {{ count($game->players) . '/' . $game->max_players }}</p>
</div>