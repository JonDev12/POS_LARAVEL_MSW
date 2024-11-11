<?php

namespace App\Livewire\Sale;

use App\Models\Cart;
use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Attributes\Computed;

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
            'products' => $this->products(),
            'cart' => Cart::getCart(),
            'total' => Cart::getTotal()
        ]);
    }

    public function addProduct(Product $product){
        //dump($product);
        Cart::add($product);
    }

    //Prppiedad para obtener los productos
    #[Computed()]
    public function products(){
        return Product::where('name', 'like', '%'.$this->search.'%')
            ->orderBy('id', 'desc')
            ->paginate($this->cant);
    }
}
