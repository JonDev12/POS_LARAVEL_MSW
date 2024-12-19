<?php

namespace App\Livewire\Sale;

use App\Models\Cart;
use App\Models\Item;
use App\Models\Sale;
use App\Models\Product;
use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Attributes\Computed;

#[Title('Ventas')]
class SaleEdit extends Component
{
    use WithPagination;

    public $search = '';
    public $cant = 5;
    public $totalRegistros = 0;
    public Sale $sale;
    public $cart;
    public $loadCart = false;

    public function render()
    {
        if (!$this->loadCart) {
            $this->getItemsToCart();
        } else {
            $this->cart = Cart::getCart();
        }


        return view('livewire.sale.sale-edit', [
            'totalArticulos' => Cart::totalArticulos(),
            'total' => Cart::getTotal(),
            'products' => $this->products(),
        ]);
    }

    public function editSale()
    {
        // Actualizar total y pago de la venta
        $this->sale->total = Cart::getTotal();
        $this->sale->pago = $this->sale->total;
        $this->sale->update();

        $itemsIds = [];

        // Recorrer los ítems relacionados con la venta
        foreach ($this->sale->items as $item) {
            // Incrementar el stock del producto
            Product::find($item->product_id)->increment('stock', $item->qty);
            $item->delete(); // Eliminar el ítem
        }

        // Agregar productos del carrito a la venta
        foreach (Cart::getCart() as $product) {
            $item = new Item();
            $item->name = $product->name;
            $item->price = $product->price;
            $item->qty = $product->quantity;
            $item->image = $product->associatedModel->image->url;
            $item->product_id = $product->id;
            $item->fecha = date('Y-m-d');
            $item->save();

            Product::find($item->product_id)->decrement('stock', $item->qty);

            $itemsIds[$item->id] = [
                "qty" => $product->quantity,
                "fecha" => date('Y-m-d'),
            ];
        }

        // Sincronizar los nuevos ítems con la venta
        $this->sale->items()->sync($itemsIds);

        // Enviar mensaje de éxito
        $this->dispatch('msg', 'Venta editada correctamente', 'success', $this->sale->id);
    }


    public function getItemsToCart()
    {
        foreach ($this->sale->items as $item) {
            $product = Product::find($item->product_id);
            $existeItem = \Cart::session(userID())->get($item->product_id);

            if ($existeItem) {
                $this->cart = Cart::getCart();
                return;
            } else {    
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
        $this->loadCart = true;
        $this->cart = Cart::getCart();
    }

    public function mount()
    {
        //$this->cart = collect();
    }
    //Agregar producto al carrito
    #[On('add-product')]
    public function addProduct(Product $product)
    {
        //dump($product);
        Cart::add($product);
    }

    //Decrementar producto del carrito
    public function decrement($id)
    {
        Cart::decrement($id);
        $this->dispatch("incrementStock.{$id}");
    }

    //Incrementar producto del carrito
    public function increment($id)
    {
        Cart::increment($id);
        $this->dispatch("decrementStock.{$id}");
    }

    //Eliminar producto del carrito
    public function removeItem($id, $qty)
    {
        Cart::removeItem($id);
        $this->dispatch("devolverStock.{$id}", $qty);
    }

    //Prppiedad para obtener los productos
    #[Computed()]
    public function products()
    {
        return Product::where('name', 'like', '%' . $this->search . '%')
            ->orderBy('id', 'desc')
            ->paginate($this->cant);
    }
}
