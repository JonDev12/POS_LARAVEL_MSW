<?php

namespace App\Livewire\Sale;

use App\Models\Cart;
use App\Models\Sale;
use App\Models\Product;
use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Attributes\Computed;

#[Title('Editar venta')]
class SaleEdit extends Component
{
    use WithPagination;

    public $search = '';
    public $cant = 5;
    public $totalRegistros = 0;
    public Sale $sale;
    public $cart;

    public function render()
    {
        $this->getItemsToCart();
        return view('livewire.sale.sale-edit', [
            'totalArticulos' => Cart::totalArticulos(),
            'total' => Cart::getTotal(),
            'products' => $this->products(),
        ]);
    }

    public function getItemsToCart()
    {
        foreach ($this->sale->items as $item) {
            $product = Product::find($item->product_id);
            $existeItem = \Cart::session(userID())->get($item->product_id);

            if($existeItem){
                $this->cart = Cart::getCart();
                return;
            }else{
                \Cart::session(userID())->add([
                    'id' => $item->product_id,
                    'name' => $item->name,
                    'price' => $item->price,
                    'quantity' => $item->qty,
                    'attributes' => [],
                    'associatedModel' => $product,
                ]);
            }
        }
        $this->cart = Cart::getCart();
    }

    public function mount()
    {
        //$this->cart = collect();
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

     //Prppiedad para obtener los productos
     #[Computed()]
     public function products(){
         return Product::where('name', 'like', '%'.$this->search.'%')
             ->orderBy('id', 'desc')
             ->paginate($this->cant);
     }
 }
