    <div class="bg-white py-20">
        <div class="max-w-xl mx-auto">
            <div class="text-center">
                <div class="relative flex flex-col items-center">
                    <h1 class="text-5xl font-bold text-green-700 dark:text-green-300">
                        Choose <span class="text-green-500">Categories</span>
                    </h1>
                    <div class="flex w-40 mt-2 mb-6 overflow-hidden rounded">
                        <div class="flex-1 h-2 bg-green-200"></div>
                        <div class="flex-1 h-2 bg-green-400"></div>
                        <div class="flex-1 h-2 bg-green-600"></div>
                    </div>
                </div>
                <p class="mb-12 text-base text-center text-green-700 dark:text-green-200">
                    Find your favorite category and explore the best products we offer.
                </p>
            </div>
        </div>

        <div class="max-w-[85rem] px-4 sm:px-6 lg:px-8 mx-auto">
            <div class="grid sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                @foreach ($categories as $category)
                    <a href="/products?selected_categories[0]={{ $category->id }}" wire:key="{{ $category->id }}"
                        class="group transform transition duration-300 hover:scale-[1.03] bg-white dark:bg-slate-900 border border-green-100 hover:shadow-lg rounded-2xl p-6 flex flex-col justify-between hover:border-green-400 dark:border-gray-700">
                        <div class="flex items-center gap-4">
                            <img class="h-24 w-24 rounded-xl object-cover border-2 border-green-300 shadow-lg group-hover:rotate-3 group-hover:scale-105 transition duration-300 ease-in-out"
                                src="{{ url('storage', $category->image) }}" alt="{{ $category->name }}" />

                            <div>
                                <h3
                                    class="text-lg font-bold text-green-700 dark:text-green-200 group-hover:text-green-500">
                                    {{ $category->name }}
                                </h3>
                            </div>
                        </div>
                        <div class="mt-4 flex justify-end text-green-500 group-hover:translate-x-1 transition">
                            <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none"
                                stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round">
                                <path d="m9 18 6-6-6-6" />
                            </svg>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </div>