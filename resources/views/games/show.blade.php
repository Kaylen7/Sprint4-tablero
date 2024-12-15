<x-app-layout>
<x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Game Details') }}
        </h2>
    </x-slot>
    <livewire:flash-alert />
<div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
    <h2 class="text-lg font-bold">{{ $data['game']->name ?? $data['game']->boardgame_name }}</h2>
    <p>{{ $data['game']->description }}</p>
    {{$data['game']->address ?? $data['game']->place_id}}
    <p>{{$data['game']->event_time->format('d/m/Y H:i')}}</p>
    @foreach ($data['game']->players as $player)
    <span class="font-bold">{{$player->pivot->role === 'host' ? '@' . $player->alias : ''}}</span>
    @endforeach
    <p>{{ $data['game']->is_private ? 'private' : 'public' }}</p>
    <p><i class="fa-solid fa-user"></i> {{ count($data['game']->players) . '/' . $data['game']->max_players }}</p>
    <h2 class="pt-4 text-lg font-bold">{{__('Players')}}</h2>
    @foreach ($data['game']->players as $player)
    <p>{{$player->alias}}</p>
    @endforeach
</div>

@if($data['hosted'])
<div class="flex flex-row gap-6 mt-6">
<x-a-primary href="{{$data['game']->id}}/edit">Edit</x-a-primary>

<form method="POST" action="{{ route('games.destroy', $data['game']->id) }}">
    @csrf
    @method('DELETE')
<x-primary-button type="submit">Delete</x-primary-button>
</form>
</div>
@elseif($data['joined'])
<form method="POST" action="{{ route('games.leave') }}" class="mt-6">
    @csrf
    <input type="hidden" name="game_id" value="{{$data['game']->id}}" />
<x-primary-button type="submit">Leave Game</x-primary-button>
</form>
@else
<form method="POST" action="{{ route('games.join') }}" class="mt-6">
    @csrf
    <input type="hidden" name="game_id" value="{{$data['game']->id}}" />
<x-primary-button type="submit">Join Game</x-primary-button>
</form>
@endif
</x-guest-layout>