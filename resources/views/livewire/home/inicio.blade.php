<div>

    <x-card cardTitle="Bienvenid@"  cardFooter="">
        <x-slot:cardTools>
            <a href="{{route('sales.list')}}" class="btn btn-primary">
                <i class="fas fa-shopping-cart"></i>
                Ir a ventas
            </a>
            <a href="{{route('sales.create')}}" class="btn bg-purple">
                <i class="fas fa-cart-plus"></i>
                Crear Venta
            </a>
        </x-slot:cardTools>

        {{--row cards ventas hoy--}}
        @include('home.row-cards-sales')
        {{--card grafica--}}
        @include('home.card-graph')
        {{--Carga de grafica de ventas--}}
        {{--{{$listTotalVentasMes}}--}}
        {{--Boxes reports--}}
        @include('home.boxes-reports')
        {{--Tablas de reportes--}}
        @include('home.tables-reports')
        {{---Mejores compradores/vendedores--}}
        @include('home.best-sellers-buyers')
    </x-card>

</div>
