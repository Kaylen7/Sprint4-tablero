<?php

namespace App\View\Components;

use Closure;
use App\Models\User;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;

class FriendCard extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public User $friend
    )
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.friend-card');
    }
}
