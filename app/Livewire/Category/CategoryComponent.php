<?php

namespace App\Livewire\Category;

use Livewire\Attributes\Title;
use Livewire\Component;
use App\Models\Category;
use Livewire\WithPagination;
    use Livewire\Attributes\On;

#[Title('Categorías')]
class CategoryComponent extends Component
{
    use WithPagination;

    //Propiedades de clase
    public $search = '';
    public $totalRegistros = 0;
    public $cant = 5;
    //Propiedades de Modelo
    public $Id;
    public $name;

    public function render()
    {
        if ($this->search != '') {
            $this->resetPage();
        }
        $this->totalRegistros = Category::count();
        $categories = Category::where('name', 'like', '%' . $this->search . '%')->orderBy('id', 'desc')->paginate($this->cant);
        return view('livewire.category.category-component', [
            'categories' => $categories
        ]);
    }

    public function mount() {}

    public function create(){
        $this->Id = 0;
        $this->reset(['name']);
        $this->resetErrorBag();
        $this->dispatch('open-modal', 'modalCategory');
    }

    // Crear categoría
    public function store()
    {

        $rules = [
            'name' => 'required|min:5|max:255|unique:categories'
        ];

        $messages = [
            'name.required' => 'El campo nombre es requerido',
            'name.min' => 'El campo nombre debe tener al menos 5 caracteres',
            'name.max' => 'El campo nombre debe tener máximo 255 caracteres',
            'name.unique' => 'Este campo ya se encuentra registrado'
        ];

        $this->validate($rules, $messages);

        $category = new Category();
        $category->name = $this->name;
        $category->save();

        $this->dispatch('close-modal', 'modalCategory');
        $this->dispatch('msg', 'Categoria creada con exito');
        $this->reset('name');
    }

    // Editar categoría
    public function edit(Category $category)
    {
        $this->Id = $category->id;
        $this->name = $category->name;
        $this->dispatch('open-modal', 'modalCategory');
    }

    // Actualizar categoría
    public function update(Category $category) {
        $rules = [
            'name' => 'required|min:5|max:255|unique:categories,id,'.$this->Id
        ];

        $messages = [
            'name.required' => 'El campo nombre es requerido',
            'name.min' => 'El campo nombre debe tener al menos 5 caracteres',
            'name.max' => 'El campo nombre debe tener máximo 255 caracteres',
            'name.unique' => 'Este campo ya se encuentra registrado'
        ];

        $this->validate($rules, $messages);
        $category->name = $this->name;
        $category->update();
        $this->dispatch('close-modal', 'modalCategory');
        $this->dispatch('msg', 'Categoria actualizada con exito');
        $this->reset('name');
    }

    // Eliminar categoría
    #[On('destroyCategory')]
    public function destroy($id)
    {
        $category = Category::findOrfail($id);
        $category->delete();
        $this->dispatch('msg', 'Categoria eliminada con exito');
    }
}
