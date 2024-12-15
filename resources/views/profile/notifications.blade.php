<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Notifications') }}
        </h2>
    </x-slot>
    <livewire:flash-alert />
    <div class="py-12">
    @if(count($notifications) > 0)
        @foreach($notifications as $notification)

        @if(preg_match('/FriendRequestNotification$/', $notification->type))
        <div class="p-2 flex flex-row">
        {!! preg_replace('/^(.+?)sent/', '<b>$1</b>&nbsp;sent', $notification->data['message']) !!}
        <form method="POST" action="{{route('friends.accept')}}">
            @csrf
        <input type="hidden" name="sender_id" value="{{$notification->data['sender_id']}}" />
        <input type="hidden" name="notification_id" value="{{$notification->id}}" />
        <input type="hidden" name="status" value="accepted" />
        <x-primary-button class="ms-4">
            {{ __('Accept') }}
        </x-primary-button>
        </form>
        <form method="POST" action="{{route('friends.accept')}}">
            @csrf
            <input type="hidden" name="sender_id" value="{{$notification->data['sender_id']}}" />
            <input type="hidden" name="notification_id" value="{{$notification->id}}" />
            <input type="hidden" name="status" value="blocked" />
        <x-secondary-real-button class="ms-4">
            {{ __('Block User') }}
        </x-secondary-real-button>
        </form>
        <form method="POST" action="{{route('friends.destroy')}}">
            @csrf
            @method('delete')
            <input type="hidden" name="sender_id" value="{{$notification->data['sender_id']}}" />
            <input type="hidden" name="notification_id" value="{{$notification->id}}" />
        <x-secondary-real-button class="ms-4">
            {{ __('Ghost 🤫') }}
        </x-secondary-real-button>
        </form>
             
        </div>
        @else
        <div>
        {{ $notification->data['message'] }}
        </div>
        @endif
        @endforeach
    @else
     You don't have notifications.
    @endif 
    </div>
</x-app-layout>