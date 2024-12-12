<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('All Games') }}
        </h2>
    </x-slot>
    <livewire:flash-alert />
    @if(count($games) == 0)
    <div class="flex flex-col items-center justify-center w-full h-80 p-6">
    <p class="mb-4"><b>Ops!</b><br/> looks like you don't have games.</p>
    <a class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150" href="{{ route('games.create') }}">{{__('Create One?')}}</a>
    </div>
    @endif
    <div class="w-full max-w-screen-lg grid grid-cols-2 lg:grid-cols-3 gap-4 p-6">
    @foreach($games as $game)
    <x-game-card :game="$game" />
    @endforeach
    </div>
</x-app-layout>