<?php

namespace App\Livewire\Sale;

use App\Models\Cart;
use App\Models\Sale;
use App\Models\Product;
use Livewire\Component;
use Livewire\Attributes\Title;
use Livewire\Attributes\Computed;
use Livewire\WithPagination;

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

     //Prppiedad para obtener los productos
     #[Computed()]
     public function products(){
         return Product::where('name', 'like', '%'.$this->search.'%')
             ->orderBy('id', 'desc')
             ->paginate($this->cant);
     }
 }
