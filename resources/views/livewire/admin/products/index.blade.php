<div>
    {{-- filtros --}}
    <div class="flex mb-4 gap-2 flex-wrap">
        <div class="form-control w-full sm:max-w-xs inline-block">
            <label class="label">
              <span class="label-text">Buscar producto:</span>
            </label>
            <input type="text" placeholder="Type here" wire:model="search" class="input input-bordered w-full">
        </div>
        <div class="form-control max-w-xs inline-block">
            <label class="label">
              <span class="label-text">Por pagina:</span>
            </label>
            <select class="select select-bordered w-full max-w-xs" wire:model="perPage">
                <option>10</option>
                <option>20</option>
                <option>30</option>
                <option>40</option>
                <option>50</option>
                <option>80</option>
                <option>100</option>
            </select>
        </div>
        <div class="form-control max-w-xs inline-block float-right">
            <label class="label">
              <span class="label-text">Crear producto:</span>
            </label>
            <button class="btn btn-outline btn-info mr-2 w-full">
                Crear
            </button>
        </div>
    </div>
    
    @if ($products->count())

        <div class="mb-2">
            {{ $products->links() }}
        </div>
        <div class="overflow-x-auto">
            <table class="table table-compact w-full" style="table-layout: auto !important;">
                <thead>
                    <tr class="cursor-pointer">
                        <th></th> 
                        <th wire:click="order('name')" class="text-sm">
                            <x-table-header :field="['name' => 'Nombre']" :order="$orderBy" :dir="$dir" />
                        </th> 
                        <th wire:click="order('price')" class="text-sm">
                            <x-table-header :field="['price' => 'Precio']" :order="$orderBy" :dir="$dir" />
                        </th> 
                        <th wire:click="order('stock')" class="text-sm">
                            <x-table-header :field="['stock' => 'Stock']" :order="$orderBy" :dir="$dir" />
                        </th> 
                        <th></th> 
                    </tr>
                </thead> 
                <tbody>
                    @foreach ($products as $product)
                        <tr>
                            <th>{{$product->id}}</th>
                            <td>{{$product->name}}</td>
                            <td class="px-6"><b>$ </b>{{ number_format($product->price) }}</td>
                            <td class="px-8">{{$product->stock}}</td>
                            <td>
                                <div class="relative" x-data="{ openOptions: false }">
                                    <button
                                    @click="openOptions = ! openOptions" 
                                    class="btn btn-success btn-sm w-full focus:ring-4 focus:border-yellow-600 focus:ring-yellow-600 focus:bg-yellow-500">
                                        Acciones
                                    </button>
                                    <div 
                                        x-show="openOptions" 
                                        x-cloak
                                        class="absolute -top-2"
                                        @click.away="openOptions = false"
                                        style="display: none !important; left: -8.3rem;">

                                        <ul class="menu bg-base-100 w-32 rounded-box shadow-lg text-gray-50" data-theme="dark">
                                            <li @clic="openOptions = false"><button wire:click="editModal({{$product}})">Editar</button></li>
                                            <li><button>Galeria</button></li>
                                            <li><a class="bg-red-500 hover:bg-red-600">Eliminar</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="6">
                            {{ $products->links() }}
                        </td> 
                    </tr>
                </tfoot>
            </table>
        </div>
    @else 
        <p>No hay productos que mostrar</p>
    @endif




    {{-- Modal de Edición --}}
    <x-jet-dialog-modal wire:model="openEdit">
        <x-slot name="title">
            <h2 class="text-gray-800 text-xl">Editar Producto</h2>
        </x-slot>

        <x-slot name="content">
            <div>
                @foreach ($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
            <x-jet-label for="name" value="Nombre" />
            <input type="text" wire:model.defer="editProduct.name" placeholder="Type here" class="input input-bordered w-full">

            <div class="grid grid-cols-2 gap-4 my-2">
                <div>
                    <x-jet-label for="stock" value="Stock" />
                    <input type="number" wire:model="editProduct.stock" placeholder="Stock" class="input input-bordered w-full max-w-xs">
                </div>
                <div>
                    <x-jet-label for="price" value="Precio" />
                    <input type="number" wire:model.defer="editProduct.price" placeholder="Precio" class="input input-bordered w-full max-w-xs">
                </div>
            </div>

            <x-jet-label for="description" value="Descripcion"  />
            <textarea class="textarea textarea-bordered w-full" wire:model.defer="editProduct.description" placeholder="Bio"></textarea>

            <div class="grid grid-cols-2 gap-4 my-2">
                <div>
                    <x-jet-label for="category_id" value="Categoria" />
                    <select class="select select-bordered w-full max-w-xs" wire:model.defer="editProduct.category_id">
                        <option disabled selected>Categoria</option>
                        @foreach ($categories as $key => $value)
                            <option value="{{$key}}">{{$value}}</option>
                        @endforeach
                        </select>
                </div>
                <div>
                    <x-jet-label for="wood_type_id" value="Madera" />
                    <select class="select select-bordered w-full max-w-xs" wire:model.defer="editProduct.wood_type_id">
                        <option disabled selected>Madera</option>
                        @foreach ($maderas as $item => $value)
                            <option value="{{$item}}">{{$value}}</option>
                        @endforeach
                        </select>
                </div>
            </div>
        </x-slot>
        
        <x-slot name="footer">
            <button class="btn btn-outline btn-success mr-2" wire:click="updateProduct">
                Edit
            </button>
            <button class="btn btn-outline btn-error" wire:click="$set('openEdit', false)">
                Cerrar
            </button>
        </x-slot>
    </x-jet-dialog-modal>
</div>
