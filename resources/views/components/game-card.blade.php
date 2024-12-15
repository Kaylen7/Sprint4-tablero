<a id="{{ $game->id }}" class="p-4 border rounded shadow text-left" href="/games/{{ $game->id }}">
    <h2 class="text-xl font-bold">{{ $game->name }}</h2>
    {!! $game->boardgame_name ? '<b>' . $game->boardgame_name . '</b><br/>' : $game->boardgame_id !!}
    @foreach ($game->players as $player)
    <span class="font-bold">{{$player->pivot->role === 'host' ? '@' . $player->alias : ''}}</span>
    @endforeach
    <p>{{$game->event_time->format('d/m/Y H:i')}}</p>
    <p class="text-sm"><b>Address:</b> {{$game->address ?? $game->place_id}}</p>
    <p>{{ $game->is_private ? 'private' : 'public' }}</p>
    <p><i class="fa-solid fa-user"></i> {{ count($game->players) . '/' . $game->max_players }}</p>
</a>