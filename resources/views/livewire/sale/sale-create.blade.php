<div>
    <x-card cardTitle="Crear Venta">
       <x-slot:cardTools>
          <a href="#" class="btn btn-primary btn-sm mr-2" {{--wire:click='create'--}}>
            <i class="fas fa-plus-circle"></i> Ir a ventas 
          </a>
          <a href="#" class="btn btn-danger btn-sm" wire:click='clear'>
            <i class="fas fa-trash"></i> Cancelar Venta 
          </a>
       </x-slot>

       {{-- Contenido --}}
       <div class="row">
            {{-- Detalles venta --}}
            <div class="col-md-6">
                @include('sales.card-details')
                {{--Pago venta--}}
                @include('sales.card-pago')
            </div>
            {{-- Detalles productos --}}
            <div class="col-md-6">
                @include('sales.list-products')
            </div>
       </div>

       <x-slot:cardFooter>
            
       </x-slot>
    </x-card>

</div>
