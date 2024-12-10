<div>
<div class="block mt-4">
    <x-input-label for="Place" :value="__('Place')" />
     <x-secondary-button type="button" wire:click="toggleManualSelection('useManualAddress')">
        {{ $useManualAddress ? 'Switch to selector' : 'Switch to writing'}}
    </x-secondary-button>

    <!-- Input -->
     @if (!$useManualAddress)
     <select wire:model="place_id" class="mt-2 w-full border rounded">
        <option value="" selected>Place selector not functional yet.</option>
    </select>
    <x-input-error :messages="$errors->get('place_id')" class="mt-2" />
     @else
    <x-text-input id="address" class="block mt-1 w-full" type="text" name="address" :value="old('address')" required autofocus autocomplete="address" placeholder="c/Llacuna, 105" />
    <x-input-error :messages="$errors->get('address')" class="mt-2" />
    @endif
</div>

<div class="block mt-4">
    <x-input-label for="boardgame" :value="__('Boardgame')" />
     <x-secondary-button type="button" wire:click="toggleManualSelection('useManualBoardgame')">
        {{ $useManualBoardgame ? 'Switch to selector' : 'Switch to writing'}}
    </x-secondary-button>

    <!-- Input -->
     @if (!$useManualBoardgame)
     <select wire:model="boardgame_id" class="mt-2 w-full border rounded">
        <option value="" selected>Boardgame selector not functional yet.</option>
    </select>
    <x-input-error :messages="$errors->get('boardgame_id')" class="mt-2" />
     @else
    <x-text-input id="boardgame_name" class="block mt-1 w-full" type="text" name="boardgame_name" :value="old('boardgame_name')" required autofocus autocomplete="boardgame_name" placeholder="Carcassone" />
    <x-input-error :messages="$errors->get('boardgame_name')" class="mt-2" />
    @endif
</div>
</div>
