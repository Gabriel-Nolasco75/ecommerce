<x-app-layout>

    @push('css')
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    @endpush

    <div class="swiper mb-12">
        <div class="swiper-wrapper">
            @foreach ($covers as $cover)
                <div class="swiper-slide">
                    <img src="{{ $cover->image }}" class="w-full aspect-[3/1] object-cover object-center" alt="slider">
                </div>
            @endforeach

        </div>
        <div class="swiper-pagination"></div>
        <div class="swiper-button-prev"></div>
        <div class="swiper-button-next"></div>
    </div>

    <x-container class="m-4">

        <h1 class="text-2xl font-bold text-gray-300 mb-4 mr-4">
            Ultimos productos
        </h1>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 2xl:grid-cols-6 gap-6">

            @foreach ($lastProducts as $product)
                
                <article class="card overflow-hidden">
                    <img src="{{$product->image}}" class="w-full h-48 object-cover object-center">

                    <div class="p-4">
                        <h1 class="text-lg font-bold text-gray-300 line-clamp-2 mb-2 min-h-[56px]">
                            {{$product->name}}
                        </h1>

                        <p class="text-gray-300 mb-4">
                            COP {{$product->price}}
                        </p>

                        <a href="{{route('products.show', $product)}}" class="btn btn-purple block w-full text-center">
                            Más información
                        </a>

                    </div>
                </article>

            @endforeach

        </div>

    </x-container>

    <x-container class="m-4">

        <h1 class="text-2xl font-bold text-gray-300 mb-4 mr-4">
            Ultimos productos
        </h1>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 2xl:grid-cols-6 gap-6">

            @foreach ($lastProducts as $product)
                
                <article class="card overflow-hidden">
                    <img src="{{$product->image}}" class="w-full h-48 object-cover object-center">

                    <div class="p-4">
                        <h1 class="text-lg font-bold text-gray-300 line-clamp-2 mb-2 min-h-[56px]">
                            {{$product->name}}
                        </h1>

                        <p class="text-gray-300 mb-4">
                            COP {{$product->price}}
                        </p>

                        <a href="{{route('products.show', $product)}}" class="btn btn-purple block w-full text-center">
                            Más información
                        </a>

                    </div>
                </article>

            @endforeach

        </div>

    </x-container>

    @push('js')
        <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

        <script>
            const swiper = new Swiper('.swiper', {
                loop: true,
                pagination: {
                    el: '.swiper-pagination',
                },
                navigation: {
                    nextEl: '.swiper-button-next',
                    prevEl: '.swiper-button-prev',
                },
                autoplay: {
                    delay: 5000,
                    disableOnInteraction: false,
                },
            });
        </script>
    @endpush

</x-app-layout>
