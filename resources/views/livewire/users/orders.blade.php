<div>
    <div class="w-full p-3 flex gap-2 items-center">
        <div>
            <div class="inline-block">
                <x-jet-label value="From" />
                <input type="date" max="{{ now()->subDay()->toDateString() }}" wire:model.defer="dateFrom" id="from">
            </div>

            <div class="inline-block">
                <x-jet-label value="To" />
                <input type="date" wire:model.defer="dateTo" id="to">
            </div>
        </div>
        <div class="flex gap-0 bg-sky-300 cursor-pointer rounded hover:shadow-md">
            <div class="p-3 select-none" wire:click="$refresh">
                Buscar
            </div>
            <div class="p-3 border-l border-sky-400">
                <i class="fa-solid fa-magnifying-glass"></i>
            </div>
        </div>
    </div>
    <div class="overflow-x-auto">
        <table class="table table-compact md:w-4/5 mx-auto">
            <thead>
                <tr>
                    <th></th> 
                    <th>Valor</th> 
                    <th class="cursor-pointer select-none" wire:click="order">
                        Fecha Orden
                        @if ($dir == 'asc')
                            <i class="fa-solid fa-arrow-up-short-wide ml-3"></i>
                        @else
                            <i class="fa-solid fa-arrow-down-short-wide ml-3"></i>
                        @endif
                    </th> 
                    <th></th> 
                </tr>
            </thead> 
            <tbody>
                @foreach ($data as $order)
                    <tr>
                        <th>{{ $loop->iteration }}</th> 
                        <td><b>$</b> {{ number_format($order['price']) }}</td> 
                        <td class="px-5">{{ $order['date']->format('d-F-Y')}}</td>
                        <td><button class="btn btn-ghost btn-xs" wire:click="openDetails({{$loop->index}})">Detalle</button></td>
                    </tr>   
                @endforeach
            </tfoot>
        </table>
    </div>

    {{-- Modal --}}
    <x-jet-dialog-modal wire:model="openShow">
        @slot('title')
            Detalles de tu compra
        @endslot
        @slot('content')
            <div class="overflow-x-auto">
                <table class="table table-compact w-full">
                    <thead>
                    <tr>
                        <th></th> 
                        <th>Nombre</th> 
                        <th>Cantidad</th> 
                        <th>Precio</th> 
                    </tr>
                    </thead> 
                    <tbody>
                        @foreach ($this->data[$n]['products'] as $product)
                            <tr>
                                <th>
                                    @if ($product->getFirstMedia('cover'))
                                        <img src="{{ $product->getFirstMedia('cover')->getUrl('thumb') }}" class="h-10 w-10 object-cover object-center rounded-full shadow mx-auto" alt="">
                                    @else
                                        <img src="https://api.lorem.space/image/furniture?w=100&h=25" class="h-10 w-10 object-cover object-center rounded-full shadow mx-auto" alt="">
                                    @endif
                                </th> 
                                <td><a class="hover:text-orange-300" href="{{ route('products.show', $product)}}" target="_blank">{{ $product->name }}</a></td> 
                                <td>{{ $product->pivot->quantity }}</td> 
                                <td><b>$ </b>{{ number_format($product->pivot->price) }}</td> 
                            </tr>
                        @endforeach
                    </tbody> 
                    <tfoot>
                    <tr>
                        <th></th> 
                        <th></th> 
                        <th>Total:</th> 
                        <th><b>$ </b>{{ number_format($this->data[$n]['price']) }}</th> 
                    </tr>
                    </tfoot>
                </table>
            </div>        
        @endslot
        @slot('footer')
            <div>
                <button class="btn btn-sm btn-error" wire:click="$set('openShow', false)">Cerrar</button>
            </div>
        @endslot
    </x-jet-dialog-modal>
</div>