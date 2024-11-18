<?php

namespace App\Livewire\Sale;

use App\Models\Cart;
use App\Models\Product;
use Livewire\Component;
use Livewire\Attributes\On;
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
    //Propiedades de pago
    public $pago = 0;
    public $devuelve= 0;

    public function render()
    {
        if($this->search != ''){
            $this->resetPage();
        }
        $this->totalRegistros = Product::count();
        return view('livewire.sale.sale-create', [
            'products' => $this->products(),
            'cart' => Cart::getCart(),
            'total' => Cart::getTotal(),
            'totalArticulos' => Cart::totalArticulos()
        ]);
    }

    //Agregar producto al carrito
    #[On('add-product')]
    public function addProduct(Product $product){
        //dump($product);
        Cart::add($product);
    }

    //Decrementar producto del carrito
    public function decrement($id){
        Cart::decrement($id);
        $this->dispatch("incrementStock.{$id}");
    }

    //Incrementar producto del carrito
    public function increment($id){
        Cart::increment($id);
        $this->dispatch("decrementStock.{$id}");
    }

    //Eliminar producto del carrito
    public function removeItem($id, $qty){
        Cart::removeItem($id);
        $this->dispatch("devolverStock.{$id}", $qty);
    }

    //Cancelar venta
    public function clear(){
        Cart::clear();
        $this->dispatch('msg', 'Venta cancelada');
        $this->dispatch('refreshProducts');
    }

    //Prppiedad para obtener los productos
    #[Computed()]
    public function products(){
        return Product::where('name', 'like', '%'.$this->search.'%')
            ->orderBy('id', 'desc')
            ->paginate($this->cant);
    }
}
