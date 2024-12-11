<x-app-layout>
<x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('New Game') }}
        </h2>
    </x-slot>
<div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
    <form method="POST" action="{{ route('games.store') }}">
        @csrf

        <!-- Name -->
        <div class="block mt-4">
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Max players -->
        <div class="block mt-4">
            <x-input-label for="max_players" :value="__('Max players')" />
            <x-text-input id="max_players" class="block mt-1 w-full" min=1 type="number" name="max_players" :value="old('max_players')" required autofocus autocomplete="max_players" />
            <x-input-error :messages="$errors->get('max_players')" class="mt-2" />
        </div>

        <livewire:game-form />

        <div class="block mt-4">
            <x-input-label for="event_time" :value="__('Date and time')" />
            <x-text-input id="event_time" class="block mt-1 w-full" type="datetime-local" name="event_time" :value="old('event_time')" value="{{ now()->addMinutes(30) }}" autofocus autocomplete="event_time" />
            <x-input-error :messages="$errors->get('event_time')" class="mt-2" />
        </div>

        <!-- Is private -->
        <div class="block mt-4">
            <label for="is_private" class="inline-flex items-center">
                <input id="is_private" type="checkbox" value="1" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="is_private" {{ old('is_private') ? 'checked' : '' }}>
                <span class="ms-2 text-sm text-gray-600">{{ __('Private game') }}</span>
            </label>
        </div>

        <div class="flex items-center justify-end mt-4">

            <x-primary-button class="ms-4">
                {{ __('Create Game') }}
            </x-primary-button>
        </div>
    </form>
    
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
</div>
</x-guest-layout>