<x-app-layout>
    @slot('title')
        Home
    @endslot
    <div class="py-12">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
            <h1 class="heading-1 text-center text-2xl">Woody E-commerce</h1>
            <input type="text" placeholder="Busca Tu Producto aquí" class="input input-ghost w-full block mx-auto text-center max-w-xs my-4">
            <div class="text-center mb-4">
                <a href="#" class="badge hover:shadow-md">Category</a>
                <a href="#" class="badge badge-primary hover:shadow-md">Category</a>
                <a href="#" class="badge badge-secondary hover:shadow-md">Category</a>
                <a href="#" class="badge badge-ghost hover:shadow-md">Category</a>
            </div>

            {{-- Productos destacados --}}
            
                <div class="p-5 my-4">
                    <h3 class="text-3xl font-bold">Productos destacados:</h3>
                    <p class="text-gray-500 text-sm mb-3">Echa un vistazo a nuestros productos populares: </p>
                </div>
                <div class="gap-4 grid p-8 sm:p-0 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-4 max-w-5xl mx-auto">
                    <div class="card w-full bg-base-100 shadow-xl mr-5">
                        <figure><img src="https://api.lorem.space/image/furniture?w=400&h=225" alt="Shoes" /></figure>
                        <div class="card-body">
                            <h2 class="card-title">Muebles!</h2>
                            <p>If a dog chews Muebles whose Muebles does he choose?</p>
                            <div class="card-actions justify-end">
                            <a href="#" class="btn btn-primary">Ver</a>
                            </div>
                        </div>
                    </div>
                    <div class="card w-full bg-base-100 shadow-xl">
                        <figure><img src="https://api.lorem.space/image/furniture?w=400&h=225" alt="Muebles" /></figure>
                        <div class="card-body">
                            <h2 class="card-title">Muebles!</h2>
                            <p>If a dog chews Muebles whose Muebles does he choose?</p>
                            <div class="card-actions justify-end">
                            <a href="#" class="btn btn-primary">Ver</a>
                            </div>
                        </div>
                    </div>
                    <div class="card w-full bg-base-100 shadow-xl">
                        <figure><img src="https://api.lorem.space/image/furniture?w=400&h=225" alt="Muebles" /></figure>
                        <div class="card-body">
                            <h2 class="card-title">Muebles!</h2>
                            <p>If a dog chews Muebles whose Muebles does he choose?</p>
                            <div class="card-actions justify-end">
                            <a href="#" class="btn btn-primary">Ver</a>
                            </div>
                        </div>
                    </div>
                    <div class="card w-full bg-base-100 shadow-xl">
                        <figure><img src="https://api.lorem.space/image/furniture?w=400&h=225" alt="Muebles" /></figure>
                        <div class="card-body">
                            <h2 class="card-title">Muebles!</h2>
                            <p>If a dog chews Muebles whose Muebles does he choose?</p>
                            <div class="card-actions justify-end">
                            <a href="#" class="btn btn-primary">Ver</a>
                            </div>
                        </div>
                    </div>
                </div>
    

            {{-- Mas Madera --}}
            <div class="hero min-h-screen my-4">
                <div class="hero-content flex-col lg:flex-row-reverse">
                  <img src="https://api.lorem.space/image/furniture?w=260&h=400" class="max-w-sm rounded-lg shadow-2xl" />
                  <div>
                    <h1 class="text-5xl font-bold">Madera Koa!</h1>
                    <p class="py-6">Provident cupiditate voluptatem et in. Quaerat fugiat ut assumenda excepturi exercitationem quasi. In deleniti eaque aut repudiandae et a id nisi.</p>
                    <button class="btn btn-primary">Ver nuevos crafts</button>
                  </div>
                </div>
            </div>

            
            {{-- Category --}}
            <div class="p-5 my-4">
                <h3 class="text-3xl font-bold">Nuevos en roble:</h3>
                <p class="text-gray-500 text-sm mb-3">Echa un vistazo a nuestros productos populares: </p>
            </div>
            <div class="card lg:card-side bg-base-100 shadow-xl">
                <figure><img src="https://api.lorem.space/image/furniture?w=400&h=400" alt="Album"></figure>
                <div class="card-body">
                    <h2 class="card-title">New oak released!</h2>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Nihil illum cum ratione ex! Iusto quisquam, consequuntur velit facilis, animi rem iure fugit dolores magnam, sapiente culpa vero repellat commodi et.</p>
                    <div class="card-actions justify-end">
                        <a class="btn btn-primary">Ver</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
