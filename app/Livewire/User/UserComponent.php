<?php

namespace App\Livewire\User;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Livewire\Attributes\Title;
use Illuminate\Support\Facades\Storage;

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
    public $admin = true;
    public $active = true;
    public $image;
    public $imageModel;

    public function render()
    {
        $this->totalRegistros = User::count();
        $users = User::where('name', 'like', '%' . $this->search . '%')
        ->orderBy('id', 'desc')
        ->paginate($this->cant);
        return view('livewire.user.user-component', [
            'users' => $users
        ]);
    }

    public function create(){

        $this->Id = 0;
        $this->clean();
        
        $this->dispatch('open-modal', 'modalUser');
    }

    //Crear Usuario
    public function store()
    {

        $rules = [
            'name' => 'required|min:5|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:8',
            're_password' => 'required|same:password',
            'image' => 'image|max:1024|nullable',
        ];

        $this->validate($rules);
        $user = new User();

        $user->name = $this->name;
        $user->email = $this->email;
        $user->password = bcrypt($this->password);
        $user->admin = $this->admin;
        $user->active = $this->active;
        $user->save();

        if($this->image){
            $customName = 'users/'.uniqid().'.'.$this->image->extension();
            $this->image->storeAs('public',$customName);
            $user->image()->create(['url'=>$customName]);
        }
        $this->dispatch('close-modal', 'modalUser');
        $this->dispatch('msg', 'Usuario creado con exito');
        $this->clean();
    }

    // Editar usuario
    public function edit(User $user)
    {
        $this->clean()  ;
        $this->Id = $user->id;
        $this->name = $user->name;
        $this->email = $user->email;
        $this->admin = $user->admin ? true : false;
        $this->active = $user->active ? true : false;
        $this->imageModel = $user->image ? $user->image->url : null;
        $this->dispatch('open-modal', 'modalUser');
    }

    // Actualizar usuario
    public function update(User $user) {
        $rules = [
            'name' => 'required|min:5|max:255',
            'email' => 'required|email|max:255|unique:users,id,'.$this->Id,
            'password' => 'min:8|nullable',
            're_password' => 'same:password',
            'image' => 'image|max:1024|nullable',
        ];

        $this->validate($rules);

        $user->name = $this->name;
        $user->email = $this->email;
        $user->admin = $this->admin;
        $user->active = $this->active;

        if($this->password){
            $user->password = $this->password;
        }

        $user->update();

        if($this->image){
        if($user->image!=null){
            Storage::delete('public/'.$user->image->url);
            $user->image()->delete();
        }
        $customName = 'users/'.uniqid().'.'.$this->image->extension();
        $this->image->storeAs('public',$customName);
        $user->image()->create(['url'=>$customName]);
    }
        $this->dispatch('close-modal', 'modalUser');
        $this->dispatch('msg', 'Usuario actualizado con exito');
        $this->clean();
    }

    public function clean(){
        $this->reset(['Id','name','email','password','admin','active','image','imageModel']);
        $this->resetErrorBag();
    }
}