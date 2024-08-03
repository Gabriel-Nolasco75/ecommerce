<div>
    <x-container>

        <div class="card">

            <div class="grid md:grid-cols-2 gap-6">

                <div class="col-span-1">

                    <figure>
                        <img src="{{ $product->image }}" class="aspect-[1/1] w-full object-cover object-center" alt="{{ $product->name }}">
                    </figure>

                </div>

                <div class="col-span-1">

                    <h1 class="text-xl text-gray-300 font-bold mb-2">
                        {{$product->name}}
                    </h1>

                    <div class="flex items-center space-x-2">
                        <ul class="flex space-x-1 text-sm">
                            <li>
                                <i class="fa-solid fa-star text-yellow-400"></i>
                            </li>
                            <li>
                                <i class="fa-solid fa-star text-yellow-400"></i>
                            </li>
                            <li>
                                <i class="fa-solid fa-star text-yellow-400"></i>
                            </li>
                            <li>
                                <i class="fa-solid fa-star text-yellow-400"></i>
                            </li>
                            <li>
                                <i class="fa-solid fa-star text-yellow-400"></i>
                            </li>
                        </ul>

                        <p class="text-sm text-gray-300">4.7 (55)</p>
                    </div>

                    <p class="font-semibold text-2xl text-gray-300 mb-4">
                        COP {{$product->price}}
                    </p>

                    <div class="flex items-center space-x-6 mb-6"
                        x-data="{
                            qty: @entangle('qty'),
                        }">

                        <x-button 
                            x-on:click="qty = qty - 1"
                            x-bind:disabled="qty == 1">
                            -
                        </x-button>

                        <span class="text-gray-300 inline-block w-2 text-center" x-text="qty"></span>

                        <x-button x-on:click="qty = qty + 1">
                            +
                        </x-button>

                    </div>

                    <button class="btn btn-purple w-full mb-6"
                        wire:click="add_to_cart"
                        wire:loading.attr="disabled">
                        Agregar al carrito
                    </button>

                    <div class="text-sm text-gray-300 mb-4">
                        {{ $product->description }}
                    </div>

                    <div class="text-gray-300 flex items-center space-x-4">
                        <i class="fa-solid fa-truck-fast text-2xl"></i>

                        <p>Despacho a domicilio</p>
                    </div>

                </div>

            </div>

        </div>

    </x-container>
</div>
