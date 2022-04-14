<div class="w-full">
    @if ($addresses->count())
        <div>
            <h3 class="font-semibold text-xl">Selecciona tu direccion</h3>
            <p class="text-sm">Estas son tus direcciones asociadas, selecciona una.</p>

            <x-jet-input-error for="slAddress" class="mt-2"/>
            <select class="select select-secondary block w-full max-w-xs mx-auto mt-1" wire:model="slAddress">
                <option selected value="">Selecciona</option>
                @foreach ($addresses as $address)
                    <option value="{{$address->id}}">{{ $address->town . $address->house}}</option>                
                @endforeach
            </select>

            <div class="divider">O</div>

            <p class="text-sm">Añade una nueva direccion</p>
            <button wire:click="$set('openAdd', true)" class="btn btn-outline btn-success btn-sm block mx-auto">
                Añadir
            </button>
        </div>
    @else
        <p class="text-center mb-3">No hay direcciones asociadas, registrala ahora!</p>
        <button class="btn btn-outline btn-success btn-sm block mx-auto" wire:click="$set('openAdd', true)">
            Añadir
        </button>
    @endif

    <x-jet-dialog-modal wire:model="openAdd">
        @slot('title')
            Añadir direccion
        @endslot
        @slot('content')
            <div class="p-2">
                <x-jet-input-error for="address.town" />
                <x-jet-label value="Ciudad" />
                <input type="text" wire:model="address.town" placeholder="Ibagué - Tolima" class="input input-bordered w-full mb-3">

                <x-jet-input-error for="address.neighborhood" />
                <x-jet-label value="Barrio" />
                <input type="text" wire:model="address.neighborhood" placeholder="San Simón" class="input input-bordered w-full mb-3">

                <x-jet-input-error for="address.house" />
                <x-jet-label value="Casa" />
                <input type="text" wire:model="address.house" placeholder="Mnz 21 Cs 78" class="input input-bordered w-full mb-3">

            </div>            
        @endslot
        @slot('footer')
            <div>
                <button class="btn btn-sm btn-outline btn-success" wire:click="addAddress()">Añadir</button>
                <button class="btn btn-sm btn-error" wire:click="$set('openAdd', false)">Cancelar</button>
            </div>
        @endslot
    </x-jet-dialog-modal>
</div>
