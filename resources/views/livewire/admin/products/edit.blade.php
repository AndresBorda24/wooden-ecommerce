<div class=" whitespace-normal" data-theme="bumblebee">   
        <li wire:key="{{$product['id']}}"><button class="btn-accent text-gray-200" wire:click="$set('open', true)">Editar</button></li>
    
        <x-jet-dialog-modal wire:model="open">
            <x-slot name="title">
                <h2 class="text-gray-800 text-xl">Editar Producto</h2>
            </x-slot>
    
            <x-slot name="content">
                <x-jet-label for="name" value="Nombre" />
                <input type="text" wire:model.defer="product.name" placeholder="Type here" class="input input-bordered w-full">
    
                <div class="grid grid-cols-2 gap-4 my-2">
                    <div>
                        <x-jet-label for="stock" value="Stock" />
                        <input type="number" wire:model="product.stock" placeholder="Stock" class="input input-bordered w-full max-w-xs">
                    </div>
                    <div>
                        <x-jet-label for="price" value="Precio" />
                        <input type="number" wire:model.defer="product.price" placeholder="Precio" class="input input-bordered w-full max-w-xs">
                    </div>
                </div>
    
                <x-jet-label for="description" value="Descripcion"  />
                <textarea class="textarea textarea-bordered w-full" wire:model.defer="product.description" placeholder="Bio"></textarea>
    
                <div class="grid grid-cols-2 gap-4 my-2">
                    <div>
                        <x-jet-label for="category_id" value="Categoria" />
                        <select class="select select-bordered w-full max-w-xs" wire:model.defer="product.category_id">
                            <option disabled selected>Categoria</option>
                            @foreach ($categories as $key => $value)
                                <option value="{{$key}}">{{$value}}</option>
                            @endforeach
                            </select>
                    </div>
                    <div>
                        <x-jet-label for="wood_type_id" value="Madera" />
                        <select class="select select-bordered w-full max-w-xs" wire:model.defer="product.wood_type_id">
                            <option disabled selected>Madera</option>
                            @foreach ($maderas as $item => $value)
                                <option value="{{$item}}">{{$value}}</option>
                            @endforeach
                            </select>
                    </div>
                </div>
            </x-slot>
            
            <x-slot name="footer">
                <button class="btn btn-square">
                    Edit
                </button>
            </x-slot>
        </x-jet-dialog-modal>
</div>
