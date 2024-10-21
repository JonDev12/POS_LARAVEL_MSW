<?php

namespace App\Livewire\User;

use Livewire\Attributes\Title;
use Livewire\Component;
use App\Models\User;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

#[Title('Usuarios')]
class UserComponent extends Component
{
    use WithFileUploads;
    use WithPagination;
    //Propiedades clase
    public $search = '';
    public $totalRegistros = 0;
    public $cant = 5;
    //Propiedades Modelo
    public $Id;
    public $name;
    public $email;
    public $password;
    public $re_password;
    public $admin;
    public $active;
    public $image;
    public $imageModel;

    public function render()
    {
        $this->totalRegistros = User::count();
        $user = User::where('name', 'like', '%' . $this->search . '%')
        ->orderBy('id', 'desc')
        ->paginate($this->cant);
        return view('livewire.user.user-component', [
            'user' => $user
        ]);
    }

    public function create(){

        $this->Id = 0;
        $this->clean();
        
        $this->dispatch('open-modal', 'modalUser');
    }

    public function clean(){
        $this->reset(['Id','name','email','password','admin','active','image','imageModel']);
        $this->resetErrorBag();
    }
}
