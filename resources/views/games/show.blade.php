<x-app-layout>
<x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Game Details') }}
        </h2>
    </x-slot>
    <livewire:flash-alert />
<div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
    <h2 class="text-lg font-bold">{{ $game->name ?? $game->boardgame_name }}</h2>
    <p>{{ $game->description }}</p>
    {{$game->address ?? $game->place_id}}
    <p>{{$game->event_time->format('d/m/Y H:i')}}</p>
    @foreach ($game->players as $player)
    <span class="font-bold">{{$player->pivot->role === 'host' ? '@' . $player->alias : ''}}</span>
    @endforeach
    <p>{{ $game->is_private ? 'private' : 'public' }}</p>
    <p><i class="fa-solid fa-user"></i> {{ count($game->players) . '/' . $game->max_players }}</p>
    <h2 class="pt-4 text-lg font-bold">{{__('Players')}}</h2>
    @foreach ($game->players as $player)
    <p>{{$player->alias}}</p>
    @endforeach
</div>
<a href="{{$game->id}}/edit">Edit</a>

<form method="POST" action="{{ route('games.destroy', $game->id) }}">
    @csrf
    @method('DELETE')
<button type="submit">Delete</button>
</form>
</x-guest-layout>