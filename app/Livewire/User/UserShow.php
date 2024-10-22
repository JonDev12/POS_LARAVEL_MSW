<?php

namespace App\Livewire\User;

use App\Models\User;
use Livewire\Component;
use Livewire\Attributes\Title;

#[Title('Ver usuario')]
class UserShow extends Component
{
    public User $user;
    public function render()
    {
        return view('livewire.user.user-show');
    }
}
