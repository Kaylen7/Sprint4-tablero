<?php

namespace App\Livewire;

use Livewire\Component;

class FlashAlert extends Component
{
    public bool $isVisible = true;

    public function hideAlert()
    {
        $this->isVisible = false;
        session()->forget('message');
    }

}
