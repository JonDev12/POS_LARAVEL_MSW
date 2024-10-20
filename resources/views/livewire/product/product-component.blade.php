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
                    <td> 
                        <x-image :item="$product"/> 
                    </td>
                    <td>{{$product->name}}</td>
                    <td>{!!$product->precio!!}</td>
                    <td>{!!$product->stockLabel!!}</td>
                    <td>
                        <a class="badge badge-secondary" href="{{route('categories.show',$product->category->id)}}">{{$product->category->name}}</a>
                        
                    </td>
                    <td>{!!$product->activeLabel!!}</td>
                    <td>
                        <a href="{{route('products.show',$product)}}" class="btn btn-success btn-sm" title="Ver item">
                            <i class="far fa-eye"></i>
                        </a>
                    </td>
                    <td>
                        <a href="#" wire:click="edit({{$product->id}})" class="btn btn-primary btn-sm" title="Editar item">
                            <i class="far fa-edit"></i>
                        </a>
                    </td>
                    <td>
                        <a wire:click="destroy({{ $product->id }})" class="btn btn-danger btn-sm" title="Eliminar item">
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
