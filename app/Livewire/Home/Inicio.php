<?php

namespace App\Livewire\Home;

use App\Models\Item;
use App\Models\Sale;
use Livewire\Component;
use Livewire\Attributes\Title;

#[Title('Inicio')]
class Inicio extends Component
{

    public $ventasHoy = 0;
    public $totalventasHoy = 0;
    public $articulosHoy = 0;
    public $productosHoy = 0;
    public $listTotalVentasMes = ''; 
    public function render()
    {
        $this->sales_today();
        $this->calVentasMes();
        return view('livewire.home.inicio');
    }

    public function sales_today(){
        $this->ventasHoy = Sale::whereDate('fecha', date('Y-m-d'))->count();
        $this->totalventasHoy = Sale::whereDate('fecha', date('Y-m-d'))->sum('total');
        $this->articulosHoy = Item::whereDate('fecha', date('Y-m-d'))->sum('qty');
        //$this->productosHoy = count(Item::whereDate('fecha', date('Y-m-d'))->groupBy('product_id')->get());
        $this->productosHoy = Item::whereDate('fecha', date('Y-m-d'))
            ->distinct('product_id')
            ->count('product_id');
    }

    public function calVentasMes(){
        for ($i=1; $i <= 12; $i++) { 
            $this->listTotalVentasMes .= Sale::whereMonth('fecha', '=', $i)->sum('total').',';
        }
    }
}
