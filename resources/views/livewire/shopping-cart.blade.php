<div>

    <div class="grid  grid-cols-1 lg:grid-cols-7 gap-6">
        <div class="lg:col-span-5">
            <div class="flex justify-between mb-2">
                <h1 class="text-lg text-gray-300">
                    Carrito de compras ({{ Cart::count() }} productos)
                </h1>

                <button class="font-semibold text-gray-300 underline hover:text-purple-600 hover:no-underline"
                    wire:click="destroy()">
                    Limpiar carro
                </button>
            </div>

            <div class="card">
                <ul class="space-y-4">

                    @forelse (Cart::content() as $item)
                        <li class="md:flex">
                            <img class="w-full md:w-36 aspect-[16/9] object-cover object-center mr-2" src="{{$item->options->image}}" alt="{{$item->name}}">

                            <div class="w-80">
                                <p class="text-sm text-gray-300">
                                    <a href="{{route('products.show', $item->id)}}">
                                        {{$item->name}}
                                    </a>
                                </p>

                                <button class="bg-red-100 hover:bg-red-400 text-red-800 text-xs font-semibold rounded px-2.5 py-0.5"
                                    wire:click="remove('{{$item->rowId}}')">
                                    <i class="fa-solid fa-xmark"></i>
                                    Quitar
                                </button>
                            </div>

                            <p class="text-gray-300">
                                COP {{$item->price}}
                            </p>

                            <div class="ml-auto space-x-3">
                                <x-button
                                    wire:click="decrease('{{$item->rowId}}')">
                                    -
                                </x-button>
        
                                <span class="text-gray-300 inline-block w-2 text-center">
                                    {{ $item->qty }}
                                </span>
        
                                <x-button
                                    wire:click="increase('{{$item->rowId}}')">
                                    +
                                </x-button>
                            </div>

                        </li>
                    @empty
                    <div class="flex items-center p-4 text-sm text-gray-800 rounded-lg bg-gray-50 dark:bg-gray-800 dark:text-gray-300" role="alert">
                        <svg class="flex-shrink-0 inline w-4 h-4 me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                          <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
                        </svg>
                        <span class="sr-only">Info</span>
                        <div>
                          <span class="font-medium">No se puede Proceder!</span> Debes agregar productos al carrito para poder continuar!
                        </div>
                      </div>
                    @endforelse
    
                </ul>
            </div>
        </div>

        <div class="lg:col-span-2">

            <div class="card">

                <div class="flex justify-between font-semibold text-gray-300 mb-2">
                    <p>
                        Total:
                    </p>
                    <p>
                        COP {{ Cart::subtotal() }}
                    </p>
                </div>

                <a href="" class="btn btn-purple block w-full text-center">
                    Continuar compra
                </a>

            </div>

        </div>
    </div>

</div>
