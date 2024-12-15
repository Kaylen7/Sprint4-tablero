<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Friends') }}
        </h2>
    </x-slot>
    <livewire:flash-alert />
    @if(count($friends) > 0)
    <div class="grid sm:grid-cols-3 gap-6 mt-4">
    <div class="pending-column p-4">
        <h3 class="text-lg font-bold mb-2">Pending Friends</h3>
        @foreach ($friends->where('status', 'pending') as $friend)
            <x-friend-card :friend="$friend" />
        @endforeach
    </div>

    <div class="accepted-column p-4">
        <h3 class="text-lg font-bold mb-2">Accepted Friends</h3>
        @foreach ($friends->where('status', 'accepted') as $friend)
            <x-friend-card :friend="$friend" />
        @endforeach
    </div>

    <div class="blocked-column p-4">
        <h3 class="text-lg font-bold mb-2">Blocked Friends</h3>
        @foreach ($friends->where('status', 'blocked') as $friend)
            <x-friend-card :friend="$friend" />
        @endforeach
    </div>
</div>
@endif
<div class="w-full mt-4">
<div class="m-auto p-4 max-w-xl sm:p-8 bg-white shadow sm:rounded-lg">
    <h1 class="text-lg font-bold mt-4">{{__('Add friends')}}</h1>
    <p class="text-sm mt-2">Find your id in your profile.</p>
    <form method="POST" action="{{ route('friends.add') }}">
    @csrf
    <div class="block mt-4">
            <x-input-label for="friend_id" :value="__('Friend Id')" />
            <x-text-input id="friend_id" class="block mt-1 w-full" type="text" name="friend_id" autofocus autocomplete="friend_id" />
            <x-input-error :messages="$errors->get('friend_id')" class="mt-2" />
    </div>
    <div class="flex flex-col">
    <x-primary-button class="mt-4 mx-auto">
        {{__('Add Friend')}}
    </x-primary-button>
    </div>
    </form>
</div>
</div>
</x-app-layout>
