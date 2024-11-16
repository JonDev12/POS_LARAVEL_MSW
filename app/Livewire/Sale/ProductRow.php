<?php

namespace App\Livewire\Sale;

use App\Models\Product;
use Livewire\Component;
use Livewire\Attributes\On;

class ProductRow extends Component
{
    public Product $product;
    public $stock;
    public $stockLabel;

    protected function getListeners()
    {
        return [
            "decrementStock.{$this->product->id}" => 'decrementStock'
        ];
    }
    public function render()
    {
        $this->stockLabel = $this->stockLabel();
        return view('livewire.sale.product-row');
    }

    public function mount(){
        $this->stock = $this->product->stock;
    }

    public function addProduct(Product $product)
    {
        if($this->stock == 0){
            return;
        }

        $this->dispatch('add-product',$product);
        $this->stock--; //Decrementar stock en 1
    }

    public function decrementStock(){
        $this->stock--;
    }

    public function stockLabel(){
        if($this->stock <= $this->product->stock_minimo){
            return '<span class="badge bagde-pill badge-danger">'.$this->stock.'</span>';
        }else{
            return '<span class="badge bagde-pill badge-success">'.$this->stock.'</span>';
        }
    }
}
