<x-admin-layout>
    <div class="max-w-2xl p-4 bg-base-100 mx-auto sm:rounded sm:shadow-lg">
        <h2 class="text-xl">Ir a:</h2>
        <div class="divider"></div> 
        <div class="flex flex-col gap-3 mt-4 justify-center">
            <a href="{{ route('admin.products') }}" class="block">
                <div 
                    class="w-full p-4 text-gray-900 duration-300 rounded shadow-lg transition-all md:py-8 brightness-75 bg-cover bg-center bg-[url(https://api.lorem.space/image/furniture?w=500&h=200)] hover:brightness-90">

                    Productos
                </div>
            </a>
        </div>
    </div>
</x-admin-layout>