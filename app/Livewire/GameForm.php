<?php

namespace App\Livewire;

use Livewire\Component;

class GameForm extends Component
{
    public bool $useManualAddress = true;
    public string $address = '';
    public int|null $placeId = null;

    public bool $useManualBoardgame = true;
    public string $boardgameName = '';
    public int|null $boardgameId = null;

    public function toggleManualSelection(string $variable): void{
        if(property_exists($this, $variable)){
            $this->$variable = !$this->$variable;
        }
    }
}
