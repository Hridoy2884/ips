<div class="w-full max-w-[85rem] py-10 px-4 sm:px-6 lg:px-8 mx-auto">
    <section class="py-10 bg-white font-poppins rounded-lg">
        <div class="px-4 py-4 mx-auto max-w-7xl lg:py-6 md:px-6">
            <div class="flex flex-wrap mb-24 -mx-3">
                <div class="w-full pr-2 lg:w-1/4 lg:block">

                    <div class="p-5 mb-5 bg-white border border-green-200 rounded-xl shadow-sm">
                        <h2 class="text-2xl font-semibold text-green-600 mb-4">Categories</h2>
                        <ul class="space-y-3">
                            @foreach ($categories as $category)
                                <li class="flex items-center">
                                    <input type="checkbox" wire:model.live="selected_categories"
                                        id="{{ $category->slug }}" value="{{ $category->id }}"
                                        class="w-4 h-4 text-green-600 focus:ring-green-500 border-green-300 rounded">
                                    <label for="{{ $category->slug }}"
                                        class="ml-3 text-green-800 text-base">{{ $category->name }}</label>
                                </li>
                            @endforeach
                        </ul>
                    </div>

                    <div class="p-5 mb-5 bg-white border border-green-200 rounded-xl shadow-sm">
                        <h2 class="text-2xl font-semibold text-green-600 mb-4">Brand</h2>
                        <ul class="space-y-3">
                            @foreach ($brands as $brand)
                                <li class="flex items-center">
                                    <input type="checkbox" wire:model.live="selected_brands" id="{{ $brand->slug }}"
                                        value="{{ $brand->id }}"
                                        class="w-4 h-4 text-green-600 focus:ring-green-500 border-green-300 rounded">
                                    <label for="{{ $brand->slug }}"
                                        class="ml-3 text-green-800 text-base">{{ $brand->name }}</label>
                                </li>
                            @endforeach
                        </ul>
                    </div>

                    <div class="p-5 mb-5 bg-white border border-green-200 rounded-xl shadow-sm">
                        <h2 class="text-2xl font-semibold text-green-600 mb-4">Product Status</h2>
                        <ul class="space-y-3">
                            <li class="flex items-center">
                                <input type="checkbox" id="featured" wire:model.live="featured" value="1"
                                    class="w-4 h-4 text-green-600 focus:ring-green-500 border-green-300 rounded">
                                <label for="featured" class="ml-3 text-green-800 text-base">Featured Product</label>
                            </li>
                            <li class="flex items-center">
                                <input type="checkbox" id="on_sale" wire:model.live="on_sale" value="1"
                                    class="w-4 h-4 text-green-600 focus:ring-green-500 border-green-300 rounded">
                                <label for="on_sale" class="ml-3 text-green-800 text-base">On Sale</label>
                            </li>
                        </ul>
                    </div>

                    <div class="p-5 mb-5 bg-white border border-green-200 rounded-xl shadow-sm">
                        <h2 class="text-2xl font-semibold text-green-600 mb-4">Price</h2>
                        <div class="text-green-800 mb-2">{{ Number::currency($price_range, 'BDT') }}</div>
                        <input type="range" wire:model.live="price_range"
                            class="w-full h-1 mb-4 bg-green-100 rounded cursor-pointer" max="50000" value="30000"
                            step="1000">
                        <div class="flex justify-between">
                            <span class="text-green-600 font-bold">{{ Number::currency(1000, 'BDT') }}</span>
                            <span class="text-green-600 font-bold">{{ Number::currency(50000, 'BDT') }}</span>
                        </div>
                    </div>

                </div>

                <div class="w-full px-3 lg:w-3/4">
                  {{-- product searc option --}}
                    <div class="px-3 mb-4">
                        <div>
                          
                            <input wire:model.live.debounce.300ms="search" type="text"
                                placeholder="🔍 Search products..."
                                class="w-full px-4 py-[20px] bg-green-50 text-green-800 placeholder:text-green-400 border border-green-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500 transition duration-200" />
                        </div>
                    </div>


                    <div class="flex flex-wrap items-center">
                        @foreach ($products as $product)
                            <div class="w-full px-3 mb-6 sm:w-1/2 md:w-1/3">
                                <div
                                    class="border border-green-200 rounded-xl shadow-md hover:shadow-lg transition duration-300 bg-white">
                                    <div class="relative bg-green-50 rounded-t-xl overflow-hidden">
                                        <a href="/products/{{ $product->slug }}">
                                            <img src="{{ url('storage', $product->images[0]) }}"
                                                alt="{{ $product->name }}" class="object-cover w-full h-56">
                                        </a>
                                    </div>
                                    <div class="p-4">
                                        <h3 class="text-lg font-semibold text-green-800">{{ $product->name }}</h3>
                                        <p class="text-green-600 font-bold mt-2">
                                            {{ Number::currency($product->price, 'BDT') }}</p>
                                        <div class="mt-4 text-center">
                                            <a wire:click.prevent='addToCart({{ $product->id }})'
                                                class="inline-flex items-center px-4 py-2 bg-green-500 text-white text-sm font-medium rounded hover:bg-green-600 transition">
                                                <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 16 16">
                                                    <path
                                                        d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .49.598l-1 5a.5.5 0 0 1-.465.401l-9.397.472L4.415 11H13a.5.5 0 0 1 0 1H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5z" />
                                                    <path
                                                        d="M3.102 4l.84 4.479 9.144-.459L13.89 4H3.102zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
                                                </svg>
                                                <span wire:loading.remove
                                                    wire:target='addToCart({{ $product->id }})'>Add to Cart</span>
                                                <span wire:loading
                                                    wire:target='addToCart({{ $product->id }})'>Adding...</span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="flex justify-end mt-6">
                        {{ $products->links() }}
                    </div>

                </div>
            </div>
        </div>
    </section>
</div>

