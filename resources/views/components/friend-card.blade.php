
<div class="rounded mb-2">
    <b>{{ $friend->name }}</b><br/>
    {{ $friend->start_date }}
    <form method="POST" action="{{route('friends.destroy')}}">
            @csrf
            @method('delete')
            <input type="hidden" name="sender_id" value="{{$friend->id}}" />
        <x-primary-button class="ms-4">
            {{ __('Remove') }}
        </x-primary-button>
        </form>
</div>