<div>
@if (session('message') && $isVisible == true)
    <div id="alert" class="group bg-neutral p-2 rounded-md cursor-pointer" wire:click="hideAlert">
        {{ session('message') }}
    </div>
    <script>
        const alertButton = document.getElementById('alert');
        setTimeout(() => {
            alertButton.click();
        }, 2000);
    </script>
@endif
</div>