<x-modal modalId="modalProduct" modalTitle="Productos" modalSize="modal-lg">

    <form wire:submit.prevent="{{ $Id == 0 ? 'store' : 'update(' . $Id . ')' }}">
        <div class="form-row">

            {{-- input Name --}}
            <div class="form-group col-md-7">
                <label for="name">Nombre:</label>
                <input wire:model="name" id="name" type="text" class="form-control"
                    placeholder="Nombre producto" id="name">
                @error('name')
                    <div class="alert alert-danger w-100 mt-2">{{ $message }}</div>
                @enderror
            </div>

            {{-- Select category --}}
            <div class="form-group col-md-5">
                <label for="category_id">Categoría:</label>
                <select wire:model = 'category_id' id = "category_id" class = "form-control">
                        <option value="0">Seleccionar</option>
                </select>
                @error('category_id')
                    <div class="alert alert-danger w-100 mt-2">{{ $message }}</div>
                @enderror
            </div>


        </div>

        <hr>
        <button class="btn btn-primary float-right">{{ $Id == 0 ? 'Guardar' : 'Editar' }}</button>
    </form>
    
</x-modal>