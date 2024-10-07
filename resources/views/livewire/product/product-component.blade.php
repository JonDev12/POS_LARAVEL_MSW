<div>

    <x-card cardTitle="Listado productos ({{ $this->totalRegistros }})">
        <x-slot:cardTools>
            <a href="#" class="btn btn-primary" wire:click="create">
                <i class="fas fa-plus-circle"></i>
                Crear producto
            </a>
        </x-slot:cardTools>

        <x-table>
            <x-slot:thead>
                <th>ID</th>
                <th>Imagen</th>
                <th>Nombre</th>
                <th>Precio venta</th>
                <th>Stock</th>
                <th>Categoría</th>
                <th>Estado</th>
                <th width="3%">...</th>
                <th width="3%">...</th>
                <th width="3%">...</th>
            </x-slot:thead>

            @forelse ($products as $product)
                <tr>
                    <td>{{$product->id}}</td>
                    <td>Imagen</td>
                    <td>{{$product->name}}</td>
                    <td>{{$product->precio_venta}}</td>
                    <td>{{$product->stock}}</td>
                    <td>{{$product->category_id}}</td>
                    <td>Active</td>
                    <td>
                        <a href="{{route('products.show', $product)}}" class="btn btn-success btn-sm" title="Ver item">
                            <i class="far fa-eye"></i>
                        </a>
                    </td>
                    <td>
                        <a href="#" wire:click="edit({{$product->id}})" class="btn btn-primary btn-sm" title="Editar item">
                            <i class="far fa-edit"></i>
                        </a>
                    </td>
                    <td>
                        <a wire:click="$dispatch('delete', {id: {{$product->id}}, eventName:'destroyProduct'})" class="btn btn-danger btn-sm" title="Elminar item">
                            <i class="far fa-trash-alt"></i>
                        </a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="10" class="text-center">No hay registros</td>
                </tr>
            @endforelse
        </x-table>
        <x-slot:cardFooter>
            {{ $products->links() }}
        </x-slot:cardFooter>
    </x-card>

@include('products.modal')
</div>
