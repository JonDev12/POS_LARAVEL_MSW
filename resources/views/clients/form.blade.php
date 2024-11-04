<x-modal modalId="modalClient" modalTitle="Clientes">
    <form wire:submit={{$Id==0 ? "store" : "update($Id)"}}>
        <div class="form-row">
            {{-- Input name --}}
            <div class="form-group col-md-6">
                <label for="name">Nombre:</label>
                <input wire:model='name' type="text" class="form-control" placeholder="Nombre" id="name">
                @error('name')
                    <div class="alert alert-danger w-100 mt-2">{{$message}}</div>
                @enderror
            </div>
            {{-- Input identificacion --}}
            <div class="form-group col-md-6">
                <label for="identificacion">Identificación:</label>
                <input wire:model='identificacion' type="text" class="form-control" placeholder="identificación" id="identificacion">
                @error('identificacion')
                    <div class="alert alert-danger w-100 mt-2">{{$message}}</div>
                @enderror
            </div>
            {{-- Input email --}}
            <div class="form-group col-md-6">
                <label for="email">Email:</label>
                <input wire:model='email' type="email" class="form-control" placeholder="email" id="email">
                @error('email')
                    <div class="alert alert-danger w-100 mt-2">{{$message}}</div>
                @enderror
            </div>
            {{-- Input telefono --}}
            <div class="form-group col-md-6">
                <label for="telefono">Telefono:</label>
                <input wire:model='telefono' type="telefono" class="form-control" placeholder="Telefono" id="telefono">
                @error('telefono')
                    <div class="alert alert-danger w-100 mt-2">{{$message}}</div>
                @enderror
            </div>
            {{-- Input empresa --}}
            <div class="form-group col-md-6">
                <label for="empresa">Empresa:</label>
                <input wire:model='empresa' type="empresa" class="form-control" placeholder="Empresa" id="empresa">
                @error('empresa')
                    <div class="alert alert-danger w-100 mt-2">{{$message}}</div>
                @enderror
            </div>
            {{-- Input nit --}}
            <div class="form-group col-md-6">
                <label for="nit">Nit:</label>
                <input wire:model='nit' type="nit" class="form-control" placeholder="Nit" id="nit">
                @error('nit')
                    <div class="alert alert-danger w-100 mt-2">{{$message}}</div>
                @enderror
            </div>
            
        </div>
        <hr>
        <button class="btn btn-primary float-right">{{$Id==0 ? 'Guardar' : 'Editar'}}</button>    
    </form>
 </x-modal>