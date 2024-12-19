<div>

    <x-card cardTitle="Bienvenid@" cardFooter="">
        <x-slot:cardTools>
            @if (isAdmin())
                <a href="{{ route('sales.list') }}" class="btn btn-primary">
                    <i class="fas fa-shopping-cart"></i>
                    Ir a ventas
                </a>
            @endif
            <a href="{{ route('sales.create') }}" class="btn bg-purple">
                <i class="fas fa-cart-plus"></i>
                Crear Venta
            </a>
        </x-slot:cardTools>

        {{-- row cards ventas hoy --}}
        @include('home.row-cards-sales')

        @if (isAdmin())
            {{-- card grafica --}}
            @include('home.card-graph')
            {{-- Carga de grafica de ventas --}}
            {{-- {{$listTotalVentasMes}} --}}
            {{-- Boxes reports --}}
            @include('home.boxes-reports')
            {{-- Tablas de reportes --}}
            @include('home.tables-reports')
            {{-- -Mejores compradores/vendedores --}}
            @include('home.best-sellers-buyers')
        @endif
    </x-card>

</div>
