<?php

namespace App\Livewire\Category;

use App\Models\Category;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Ver Categoría')]
class CategoryShow extends Component
{
    public Category $category;

    public function render()
    {
        return view('livewire.category.category-show');
    }
}
