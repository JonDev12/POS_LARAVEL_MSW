<?php

namespace App\Livewire\Product;

use App\Models\Product;
use Livewire\Component;
use Livewire\Attributes\Title;

#[Title('Productos')]

class ProductComponent extends Component
{
    //Propiedades clase
    public $search = '';
    public $totalRegistros = 0;
    public $cant = 5;
//Propiedades para modelos
    public $Id;
    public $name;

    public function render()
    {
        $this->dispatch('open-modal', 'modalProduct');
        $this->totalRegistros = Product::count();
        $products = Product::where('name', 'like', '%' . $this->search . '%')
        ->orderBy('id', 'desc')
        ->paginate($this->cant);
        
        return view('livewire.product.product-component', [
            'products' => $products
        ]);
    }

    public function create(){
        $this->Id = 0;
        $this->reset(['name']);
        $this->resetErrorBag();
        $this->dispatch('open-modal', 'modalProduct');
    }
}
