<div>

    <x-card cardTitle="Listado categorias ({{ $this->totalRegistros }})">
        <x-slot:cardTools>
            <a href="#" class="btn btn-primary" wire:click="create">
                <i class="fas fa-plus-circle"></i>
                Crear categoria
            </a>
        </x-slot:cardTools>

        <x-table>
            <x-slot:thead>
                <th>ID</th>
                <th>Nombre categoria</th>
                <th width="3%">...</th>
                <th width="3%">...</th>
                <th width="3%">...</th>
            </x-slot:thead>

            @forelse ($categories as $category)
                <tr>
                    <td>{{$category->id}}</td>
                    <td>{{$category->name}}</td>
                    <td>
                        <a href="{{route('categories.show', $category)}}" class="btn btn-success btn-sm" title="Ver item">
                            <i class="far fa-eye"></i>
                        </a>
                    </td>
                    <td>
                        <a href="#" wire:click="edit({{$category->id}})" class="btn btn-primary btn-sm" title="Editar item">
                            <i class="far fa-edit"></i>
                        </a>
                    </td>
                    <td>
                        <a wire:click="$dispatch('delete', {id: {{$category->id}}, eventName:'destroyCategory'})" class="btn btn-danger btn-sm" title="Elminar item">
                            <i class="far fa-trash-alt"></i>
                        </a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center">No hay registros</td>
                </tr>
            @endforelse
        </x-table>
        <x-slot:cardFooter>
            {{ $categories->links() }}
        </x-slot:cardFooter>
    </x-card>

    <x-modal modalId="modalCategory" modalTitle="Categorias">
        <form wire:submit={{$Id == 0 ? "store" : "update($Id)"}}>
            <div class="form-row">
                <div class="form-group col-12">
                    <label for="name">Nombre:</label>
                    <input wire:model="name" id="name" type="text" class="form-control"
                        placeholder="Nombre categoria">
                    @error('name')
                        <div class="alert alert-danger w-100 mt-2">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="mt-3">
                <button class="btn btn-primary float-right">{{$Id == 0 ? 'Guardar' : 'Editar'}}</button>
            </div>
        </form>
    </x-modal>
</div>
