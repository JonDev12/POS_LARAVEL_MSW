<?php

namespace App\Livewire\Product;

use Livewire\Component;
use Livewire\Attributes\Title;

#[Title('Productos')]

class ProductComponent extends Component
{
    public function render()
    {
        return view('livewire.product.product-component');
    }
}
