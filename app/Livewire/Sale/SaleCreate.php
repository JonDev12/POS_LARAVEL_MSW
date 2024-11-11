<?php

namespace App\Livewire\Sale;

use App\Models\Product;
use Livewire\Attributes\Computed;
use Livewire\Component;
use Livewire\Attributes\Title;
use Livewire\WithPagination;

#[Title('Ventas')]
class SaleCreate extends Component
{
    use WithPagination;

    public $search = '';
    public $cant = 5;
    public $totalRegistros = 0;

    public function render()
    {
        if($this->search != ''){
            $this->resetPage();
        }
        $this->totalRegistros = Product::count();
        return view('livewire.sale.sale-create', [
            'products' => $this->products()
        ]);
    }

    //Prppiedad para obtener los productos
    #[Computed()]
    public function products(){
        return Product::where('name', 'like', '%'.$this->search.'%')
            ->orderBy('id', 'desc')
            ->paginate($this->cant);
    }
}
