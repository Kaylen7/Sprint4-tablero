<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            @if($data['hosted'])
            {{__('Hosted Games')}}
            @elseif($data['joined'])
            {{__('Joined Games')}}
            @else
            {{ __('All Games')}}
            @endif
        </h2>
    </x-slot>
    <livewire:flash-alert />
    @if(count($data['games']) == 0 && $data['hosted'])
    <div class="flex flex-col items-center justify-center w-full h-80 p-6">
    <p class="mb-4"><b>Ops!</b><br/> looks like you don't have games.</p>
    <x-a-primary href="{{ route('games.create') }}">{{__('Create one?')}}</x-a-primary>
    </div>
    @elseif(count($data['games']) == 0 && $data['joined'])
    <div class="flex flex-col items-center justify-center w-full h-80 p-6">
    <p class="mb-4"><b>Ops!</b><br/> looks like you haven't joined any games.</p>
    <x-a-primary href="{{ route('games.index') }}">{{__('Join one?')}}</x-a-primary>
    </div>
    @endif
    <div class="w-full max-w-screen-lg grid grid-cols-2 lg:grid-cols-3 gap-4 p-6">
    @foreach($data['games'] as $game)
    <x-game-card :game="$game" />
    @endforeach
    </div>
</x-app-layout>