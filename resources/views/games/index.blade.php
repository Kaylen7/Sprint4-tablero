<x-app-layout>
<div class="w-full max-w-screen-lg grid grid-cols-2 lg:grid-cols-3 gap-4 p-6">
    @foreach($games as $game)
    <x-game-card :game="$game" />
    @endforeach
</div>
</x-app-layout>