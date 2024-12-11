<?php

namespace App\Livewire\Home;

use App\Models\Item;
use App\Models\Sale;
use Livewire\Component;
use Livewire\Attributes\Title;

#[Title('Inicio')]
class Inicio extends Component
{

    //Ventas hoy
    public $ventasHoy = 0;
    public $totalventasHoy = 0;
    public $articulosHoy = 0;
    public $productosHoy = 0;
    //Venta mes grafica
    public $listTotalVentasMes = ''; 
    //Cajas reportes
    public $cantidadVentas = 0;
    public $totalVentas = 0;
    public $cantidadArticulos = 0;
    public $cantidadProductos = 0;
    public function render()
    {
        $this->sales_today();
        $this->calVentasMes();
        $this->boxes_reports();
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

    public function boxes_reports(){
        $this->cantidadVentas = Sale::whereYear('fecha', '=', date('Y'))->count();
        $this->totalVentas = Sale::whereYear('fecha', '=', date('Y'))->sum('total');
        $this->cantidadArticulos = Item::whereYear('fecha', '=', date('Y'))->sum('qty');
        $this->cantidadProductos = Item::whereYear('fecha', '=', date('Y'))
        ->selectRaw('COUNT(DISTINCT product_id) as total')
        ->value('total');
    }
}
