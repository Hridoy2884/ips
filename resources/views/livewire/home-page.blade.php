<section>
    {{-- Hero Section --}}
    <div class="w-full bg-white py-10 px-4 sm:px-6 lg:px-8 mx-auto max-w-[85rem]">
        <div class="grid md:grid-cols-2 gap-10 md:items-center">
            {{-- Left Content --}}
            <div>
                <h1 class="text-green-600 text-3xl font-bold sm:text-4xl lg:text-6xl lg:leading-tight">
                    Start your journey with Jui Power Digital IPS

                    <span class="inline-block">
                        <img src="/storage/images/logo_text.png" alt="Logo" class="inline-block h-10 lg:h-12 ml-2" />
                    </span>
                </h1>
                <p class="mt-4 text-lg text-gray-800">
                    Explore the Future of Uninterrupted Power – From Home Essentials to Smart Backup Solutions, We've
                    Got You Covered!
                </p>
                <div class="mt-7 grid gap-3 sm:inline-flex">
                    <a href="/register"
                        class="py-3 px-4 inline-flex items-center gap-x-2 text-sm font-semibold rounded-lg bg-green-600 text-white hover:bg-green-700 transition">
                        Get Started
                    </a>
                    <a href="/contact"
                        class="py-3 px-4 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-300 bg-white text-gray-800 hover:bg-gray-50 transition">
                        Contact Sales Team
                    </a>
                </div>
            </div>

            {{-- Right Slider --}}
            <div class="relative w-full h-[350px] md:h-[400px] rounded-lg overflow-hidden shadow-lg" id="ad-slider">
                @if ($ads->count() > 0)
                    @foreach ($ads as $index => $ad)
                        <div class="absolute inset-0 transition-opacity duration-700"
                            style="opacity: {{ $index === 0 ? '1' : '0' }};" data-index="{{ $index }}">
                            <img src="{{ asset('storage/' . $ad->image) }}"
                                alt="{{ $ad->title ?? 'Advertisement ' . ($index + 1) }}"
                                class="object-cover w-full h-full" />
                        </div>
                    @endforeach
                @else
                    <div class="flex items-center justify-center w-full h-full bg-gray-100 dark:bg-gray-800">
                        <p class="text-gray-500 dark:text-gray-400">No advertisements to show</p>
                    </div>
                @endif

                {{-- Controls --}}
                <button id="prev-btn"
                    class="absolute left-3 top-1/2 transform -translate-y-1/2 bg-white/70 hover:bg-white/90 p-2 rounded-full shadow">
                    <svg class="w-5 h-5 text-gray-800" fill="none" stroke="currentColor" stroke-width="2"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                    </svg>
                </button>
                <button id="next-btn"
                    class="absolute right-3 top-1/2 transform -translate-y-1/2 bg-white/70 hover:bg-white/90 p-2 rounded-full shadow">
                    <svg class="w-5 h-5 text-gray-800" fill="none" stroke="currentColor" stroke-width="2"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                    </svg>
                </button>

                {{-- Indicators --}}
                <div class="absolute bottom-3 left-1/2 transform -translate-x-1/2 flex gap-2">
                    @foreach ($ads as $index => $ad)
                        <div class="w-3 h-3 rounded-full cursor-pointer transition-colors duration-300 {{ $index === 0 ? 'bg-green-600' : 'bg-gray-300' }}"
                            data-index="{{ $index }}"></div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    {{-- Slider JS --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const slides = document.querySelectorAll('#ad-slider > div[data-index]');
            const dots = document.querySelectorAll('#ad-slider div.absolute.bottom-3 div');
            const prevBtn = document.getElementById('prev-btn');
            const nextBtn = document.getElementById('next-btn');
            let current = 0;
            const total = slides.length;

            function showSlide(index) {
                slides.forEach((slide, i) => {
                    slide.style.opacity = i === index ? '1' : '0';
                    dots[i].classList.toggle('bg-green-600', i === index);
                    dots[i].classList.toggle('bg-gray-300', i !== index);
                });
                current = index;
            }

            prevBtn.addEventListener('click', () => {
                let nextIndex = (current - 1 + total) % total;
                showSlide(nextIndex);
            });

            nextBtn.addEventListener('click', () => {
                let nextIndex = (current + 1) % total;
                showSlide(nextIndex);
            });

            dots.forEach(dot => {
                dot.addEventListener('click', () => {
                    let index = parseInt(dot.getAttribute('data-index'));
                    showSlide(index);
                });
            });

            // Auto slide every 5 seconds
            setInterval(() => {
                let nextIndex = (current + 1) % total;
                showSlide(nextIndex);
            }, 5000);
        });
    </script>






    {{-- products section start --}}

    <section>
        @livewire('products-page')
    </section>


    {{-- product section end --}}

    {{-- Brand section start     --}}

    <div class="min-h-screen flex items-center justify-center bg-white dark:bg-gray-900 px-4">
        <section class="w-full max-w-7xl relative py-16">
            <div class="text-center mb-10">
                <h1 class="text-5xl font-bold dark:text-green-200">
                    Choose Popular <span class="text-green-500">Brands</span>
                </h1>
                <div class="flex w-40 mx-auto mt-2 mb-6 overflow-hidden rounded">
                    <div class="flex-1 h-2 bg-green-200"></div>
                    <div class="flex-1 h-2 bg-green-400"></div>
                    <div class="flex-1 h-2 bg-green-600"></div>
                </div>
                <p class="text-base text-gray-500 dark:text-gray-400">
                    Discover top-rated brands for your smart lifestyle.
                </p>
            </div>

            <div class="relative">
                <!-- Left Button -->
                <button id="brand-prev"
                    class="absolute left-0 top-1/2 -translate-y-1/2 z-10 bg-white dark:bg-gray-700 hover:bg-green-500 dark:hover:bg-green-600 text-green-600 dark:text-white hover:text-white p-3 rounded-full shadow-md transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                    </svg>
                </button>

                <!-- Right Button -->
                <button id="brand-next"
                    class="absolute right-0 top-1/2 -translate-y-1/2 z-10 bg-white dark:bg-gray-700 hover:bg-green-500 dark:hover:bg-green-600 text-green-600 dark:text-white hover:text-white p-3 rounded-full shadow-md transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                    </svg>
                </button>

                <!-- Brand Cards Scrollable Row -->
                <div id="brand-scroll" class="flex gap-6 overflow-x-auto scroll-smooth px-12 pb-4 scrollbar-hide">
                    @foreach ($brands as $brand)
                        <div class="flex-none w-64 bg-white rounded-lg shadow-md dark:bg-gray-800 transform transition duration-300 hover:scale-105"
                            wire:key="{{ $brand->id }}">
                            <a href="/products?selected_brands[0]={{ $brand->id }}">
                                <img src="{{ url('storage', $brand->image) }}" alt="{{ $brand->name }}"
                                    class="object-cover w-full h-40 rounded-t-lg" />
                            </a>
                            <div class="p-4 text-center">
                                <a href="/products?selected_brands[0]={{ $brand->id }}"
                                    class="text-xl font-semibold text-gray-900 dark:text-gray-300">
                                    {{ $brand->name }}
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Scroll Script -->
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    const scrollContainer = document.getElementById('brand-scroll');
                    const prevBtn = document.getElementById('brand-prev');
                    const nextBtn = document.getElementById('brand-next');

                    prevBtn.addEventListener('click', () => {
                        scrollContainer.scrollBy({
                            left: -300,
                            behavior: 'smooth'
                        });
                    });

                    nextBtn.addEventListener('click', () => {
                        scrollContainer.scrollBy({
                            left: 300,
                            behavior: 'smooth'
                        });
                    });
                });
            </script>

            <!-- Hide Scrollbar Utility -->
            <style>
                .scrollbar-hide::-webkit-scrollbar {
                    display: none;
                }

                .scrollbar-hide {
                    -ms-overflow-style: none;
                    scrollbar-width: none;
                }
            </style>
        </section>
    </div>




    {{-- Brand section end --}}

    {{-- category section start --}}
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


    {{-- category section end --}}

    {{-- customer review section start --}}
    <section class="py-14 font-poppins dark:bg-gray-800">
        <div class="max-w-6xl px-4 py-6 mx-auto lg:py-4 md:px-6">
            <div class="max-w-xl mx-auto">
                <div class="text-center ">
                    <div class="relative flex flex-col items-center">
                        <h1 class="text-5xl font-bold dark:text-gray-200"> Customer <span class="text-blue-500">
                                Reviews
                            </span> </h1>
                        <div class="flex w-40 mt-2 mb-6 overflow-hidden rounded">
                            <div class="flex-1 h-2 bg-blue-200">
                            </div>
                            <div class="flex-1 h-2 bg-blue-400">
                            </div>
                            <div class="flex-1 h-2 bg-blue-600">
                            </div>
                        </div>
                    </div>
                    <p class="mb-12 text-base text-center text-gray-500">
                        Lorem ipsum, dolor sit amet consectetur adipisicing elit. Delectus magni eius eaque?
                        Pariatur
                        numquam, odio quod nobis ipsum ex cupiditate?
                    </p>
                </div>
            </div>

            <div class="grid grid-cols-1 gap-6 lg:grid-cols-2 ">
                <div class="py-6 bg-white rounded-md shadow dark:bg-gray-900">
                    <div
                        class="flex flex-wrap items-center justify-between pb-4 mb-6 space-x-2 border-b dark:border-gray-700">
                        <div class="flex items-center px-6 mb-2 md:mb-0 ">
                            <div class="flex mr-2 rounded-full">
                                <img src="https://i.postimg.cc/rF6G0Dh9/pexels-emmy-e-2381069.jpg" alt=""
                                    class="object-cover w-12 h-12 rounded-full">
                            </div>
                            <div>
                                <h2 class="text-lg font-semibold text-gray-900 dark:text-gray-300">
                                    Adren Roy</h2>
                                <p class="text-xs text-gray-500 dark:text-gray-400">Web Designer</p>
                            </div>
                        </div>
                        <p class="px-6 text-base font-medium text-gray-600 dark:text-gray-400"> Joined 12, JULY , 2025
                        </p>
                    </div>
                    <p class="px-6 mb-6 text-base text-gray-500 dark:text-gray-400">
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Autem cupiditate similique,
                        iure minus sed fugit obcaecati minima quam reiciendis dicta!
                    </p>
                    <div class="flex flex-wrap justify-between pt-4 border-t dark:border-gray-700">
                        <div class="flex px-6 mb-2 md:mb-0">
                            <ul class="flex items-center justify-start mr-4">
                                <li>
                                    <a href="#">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="currentColor"
                                            class="w-4 mr-1 text-blue-500 dark:text-blue-400 bi bi-star-fill"
                                            viewBox="0 0 16 16">
                                            <path
                                                d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z">
                                            </path>
                                        </svg>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="currentColor"
                                            class="w-4 mr-1 text-blue-500 dark:text-blue-400 bi bi-star-fill"
                                            viewBox="0 0 16 16">
                                            <path
                                                d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z">
                                            </path>
                                        </svg>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="currentColor"
                                            class="w-4 mr-1 text-blue-500 dark:text-blue-400 bi bi-star-fill"
                                            viewBox="0 0 16 16">
                                            <path
                                                d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z">
                                            </path>
                                        </svg>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="currentColor"
                                            class="w-4 mr-1 text-blue-500 dark:text-blue-400 bi bi-star-fill"
                                            viewBox="0 0 16 16">
                                            <path
                                                d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z">
                                            </path>
                                        </svg>
                                    </a>
                                </li>
                            </ul>
                            <h2 class="text-sm text-gray-500 dark:text-gray-400">Rating:<span
                                    class="font-semibold text-gray-600 dark:text-gray-300">
                                    3.0</span>
                            </h2>
                        </div>
                        <div
                            class="flex items-center px-6 space-x-1 text-sm font-medium text-gray-500 dark:text-gray-400">
                            <div class="flex items-center">
                                <div class="flex mr-3 text-sm text-gray-700 dark:text-gray-400">
                                    <a href="#">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="currentColor"
                                            class="w-4 h-4 mr-1 text-blue-400 bi bi-hand-thumbs-up-fill"
                                            viewBox="0 0 16 16">
                                            <path
                                                d="M6.956 1.745C7.021.81 7.908.087 8.864.325l.261.066c.463.116.874.456 1.012.965.22.816.533 2.511.062 4.51a9.84 9.84 0 0 1 .443-.051c.713-.065 1.669-.072 2.516.21.518.173.994.681 1.2 1.273.184.532.16 1.162-.234 1.733.058.119.103.242.138.363.077.27.113.567.113.856 0 .289-.036.586-.113.856-.039.135-.09.273-.16.404.169.387.107.819-.003 1.148a3.163 3.163 0 0 1-.488.901c.054.152.076.312.076.465 0 .305-.089.625-.253.912C13.1 15.522 12.437 16 11.5 16H8c-.605 0-1.07-.081-1.466-.218a4.82 4.82 0 0 1-.97-.484l-.048-.03c-.504-.307-.999-.609-2.068-.722C2.682 14.464 2 13.846 2 13V9c0-.85.685-1.432 1.357-1.615.849-.232 1.574-.787 2.132-1.41.56-.627.914-1.28 1.039-1.639.199-.575.356-1.539.428-2.59z">
                                            </path>
                                        </svg>
                                    </a>
                                    <span>12</span>
                                </div>
                                <div class="flex text-sm text-gray-700 dark:text-gray-400">
                                    <a href="#" class="inline-flex hover:underline">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="currentColor" class="w-4 h-4 mr-1 text-blue-400 bi bi-chat"
                                            viewBox="0 0 16 16">
                                            <path
                                                d="M2.678 11.894a1 1 0 0 1 .287.801 10.97 10.97 0 0 1-.398 2c1.395-.323 2.247-.697 2.634-.893a1 1 0 0 1 .71-.074A8.06 8.06 0 0 0 8 14c3.996 0 7-2.807 7-6 0-3.192-3.004-6-7-6S1 4.808 1 8c0 1.468.617 2.83 1.678 3.894zm-.493 3.905a21.682 21.682 0 0 1-.713.129c-.2.032-.352-.176-.273-.362a9.68 9.68 0 0 0 .244-.637l.003-.01c.248-.72.45-1.548.524-2.319C.743 11.37 0 9.76 0 8c0-3.866 3.582-7 8-7s8 3.134 8 7-3.582 7-8 7a9.06 9.06 0 0 1-2.347-.306c-.52.263-1.639.742-3.468 1.105z">
                                            </path>
                                        </svg>Reply</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="py-6 bg-white rounded-md shadow dark:bg-gray-900">
                    <div
                        class="flex flex-wrap items-center justify-between pb-4 mb-6 space-x-2 border-b dark:border-gray-700">
                        <div class="flex items-center px-6 mb-2 md:mb-0 ">
                            <div class="flex mr-2 rounded-full">
                                <img src="https://i.postimg.cc/q7pv50zT/pexels-edmond-dant-s-4342352.jpg"
                                    alt="" class="object-cover w-12 h-12 rounded-full">
                            </div>
                            <div>
                                <h2 class="text-lg font-semibold text-gray-900 dark:text-gray-300">
                                    Sonira Roy</h2>
                                <p class="text-xs text-gray-500 dark:text-gray-400">Manager</p>
                            </div>
                        </div>
                        <p class="px-6 text-base font-medium text-gray-600 dark:text-gray-400"> Joined 12, JULY , 2025
                        </p>
                    </div>
                    <p class="px-6 mb-6 text-base text-gray-500 dark:text-gray-400">
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Autem cupiditate similique,
                        iure minus sed fugit obcaecati minima quam reiciendis dicta!
                    </p>
                    <div class="flex flex-wrap justify-between pt-4 border-t dark:border-gray-700">
                        <div class="flex px-6 mb-2 md:mb-0">
                            <ul class="flex items-center justify-start mr-4">
                                <li>
                                    <a href="#">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="currentColor"
                                            class="w-4 mr-1 text-blue-500 dark:text-blue-400 bi bi-star-fill"
                                            viewBox="0 0 16 16">
                                            <path
                                                d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z">
                                            </path>
                                        </svg>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="currentColor"
                                            class="w-4 mr-1 text-blue-500 dark:text-blue-400 bi bi-star-fill"
                                            viewBox="0 0 16 16">
                                            <path
                                                d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z">
                                            </path>
                                        </svg>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="currentColor"
                                            class="w-4 mr-1 text-blue-500 dark:text-blue-400 bi bi-star-fill"
                                            viewBox="0 0 16 16">
                                            <path
                                                d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z">
                                            </path>
                                        </svg>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="currentColor"
                                            class="w-4 mr-1 text-blue-500 dark:text-blue-400 bi bi-star-fill"
                                            viewBox="0 0 16 16">
                                            <path
                                                d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z">
                                            </path>
                                        </svg>
                                    </a>
                                </li>
                            </ul>
                            <h2 class="text-sm text-gray-500 dark:text-gray-400">Rating:<span
                                    class="font-semibold text-gray-600 dark:text-gray-300">
                                    3.0</span>
                            </h2>
                        </div>
                        <div
                            class="flex items-center px-6 space-x-1 text-sm font-medium text-gray-500 dark:text-gray-400">
                            <div class="flex items-center">
                                <div class="flex mr-3 text-sm text-gray-700 dark:text-gray-400">
                                    <a href="#"><svg xmlns="http://www.w3.org/2000/svg" width="16"
                                            height="16" fill="currentColor"
                                            class="w-4 h-4 mr-1 text-blue-400 bi bi-hand-thumbs-up-fill"
                                            viewBox="0 0 16 16">
                                            <path
                                                d="M6.956 1.745C7.021.81 7.908.087 8.864.325l.261.066c.463.116.874.456 1.012.965.22.816.533 2.511.062 4.51a9.84 9.84 0 0 1 .443-.051c.713-.065 1.669-.072 2.516.21.518.173.994.681 1.2 1.273.184.532.16 1.162-.234 1.733.058.119.103.242.138.363.077.27.113.567.113.856 0 .289-.036.586-.113.856-.039.135-.09.273-.16.404.169.387.107.819-.003 1.148a3.163 3.163 0 0 1-.488.901c.054.152.076.312.076.465 0 .305-.089.625-.253.912C13.1 15.522 12.437 16 11.5 16H8c-.605 0-1.07-.081-1.466-.218a4.82 4.82 0 0 1-.97-.484l-.048-.03c-.504-.307-.999-.609-2.068-.722C2.682 14.464 2 13.846 2 13V9c0-.85.685-1.432 1.357-1.615.849-.232 1.574-.787 2.132-1.41.56-.627.914-1.28 1.039-1.639.199-.575.356-1.539.428-2.59z">
                                            </path>
                                        </svg></a>
                                    <span>12</span>
                                </div>
                                <div class="flex text-sm text-gray-700 dark:text-gray-400">
                                    <a href="#" class="inline-flex hover:underline">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="currentColor" class="w-4 h-4 mr-1 text-blue-400 bi bi-chat"
                                            viewBox="0 0 16 16">
                                            <path
                                                d="M2.678 11.894a1 1 0 0 1 .287.801 10.97 10.97 0 0 1-.398 2c1.395-.323 2.247-.697 2.634-.893a1 1 0 0 1 .71-.074A8.06 8.06 0 0 0 8 14c3.996 0 7-2.807 7-6 0-3.192-3.004-6-7-6S1 4.808 1 8c0 1.468.617 2.83 1.678 3.894zm-.493 3.905a21.682 21.682 0 0 1-.713.129c-.2.032-.352-.176-.273-.362a9.68 9.68 0 0 0 .244-.637l.003-.01c.248-.72.45-1.548.524-2.319C.743 11.37 0 9.76 0 8c0-3.866 3.582-7 8-7s8 3.134 8 7-3.582 7-8 7a9.06 9.06 0 0 1-2.347-.306c-.52.263-1.639.742-3.468 1.105z">
                                            </path>
                                        </svg>Reply</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="py-6 bg-white rounded-md shadow dark:bg-gray-900">
                    <div
                        class="flex flex-wrap items-center justify-between pb-4 mb-6 space-x-2 border-b dark:border-gray-700">
                        <div class="flex items-center px-6 mb-2 md:mb-0 ">
                            <div class="flex mr-2 rounded-full">
                                <img src="https://i.postimg.cc/JzmrHQmk/pexels-pixabay-220453.jpg" alt=""
                                    class="object-cover w-12 h-12 rounded-full">
                            </div>
                            <div>
                                <h2 class="text-lg font-semibold text-gray-900 dark:text-gray-300">
                                    William harry</h2>
                                <p class="text-xs text-gray-500 dark:text-gray-400">Marketing Officer</p>
                            </div>
                        </div>
                        <p class="px-6 text-base font-medium text-gray-600 dark:text-gray-400"> Joined 12, SEP , 2022
                        </p>
                    </div>
                    <p class="px-6 mb-6 text-base text-gray-500 dark:text-gray-400">
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Autem cupiditate similique,
                        iure minus sed fugit obcaecati minima quam reiciendis dicta!
                    </p>
                    <div class="flex flex-wrap justify-between pt-4 border-t dark:border-gray-700">
                        <div class="flex px-6 mb-2 md:mb-0">
                            <ul class="flex items-center justify-start mr-4">
                                <li>
                                    <a href="#">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="currentColor"
                                            class="w-4 mr-1 text-blue-500 dark:text-blue-400 bi bi-star-fill"
                                            viewBox="0 0 16 16">
                                            <path
                                                d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z">
                                            </path>
                                        </svg>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="currentColor"
                                            class="w-4 mr-1 text-blue-500 dark:text-blue-400 bi bi-star-fill"
                                            viewBox="0 0 16 16">
                                            <path
                                                d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z">
                                            </path>
                                        </svg>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="currentColor"
                                            class="w-4 mr-1 text-blue-500 dark:text-blue-400 bi bi-star-fill"
                                            viewBox="0 0 16 16">
                                            <path
                                                d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z">
                                            </path>
                                        </svg>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="currentColor"
                                            class="w-4 mr-1 text-blue-500 dark:text-blue-400 bi bi-star-fill"
                                            viewBox="0 0 16 16">
                                            <path
                                                d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z">
                                            </path>
                                        </svg>
                                    </a>
                                </li>
                            </ul>
                            <h2 class="text-sm text-gray-500 dark:text-gray-400">Rating:<span
                                    class="font-semibold text-gray-600 dark:text-gray-300">
                                    3.0</span>
                            </h2>
                        </div>
                        <div
                            class="flex items-center px-6 space-x-1 text-sm font-medium text-gray-500 dark:text-gray-400">
                            <div class="flex items-center">
                                <div class="flex mr-3 text-sm text-gray-700 dark:text-gray-400">
                                    <a href="#"><svg xmlns="http://www.w3.org/2000/svg" width="16"
                                            height="16" fill="currentColor"
                                            class="w-4 h-4 mr-1 text-blue-400 bi bi-hand-thumbs-up-fill"
                                            viewBox="0 0 16 16">
                                            <path
                                                d="M6.956 1.745C7.021.81 7.908.087 8.864.325l.261.066c.463.116.874.456 1.012.965.22.816.533 2.511.062 4.51a9.84 9.84 0 0 1 .443-.051c.713-.065 1.669-.072 2.516.21.518.173.994.681 1.2 1.273.184.532.16 1.162-.234 1.733.058.119.103.242.138.363.077.27.113.567.113.856 0 .289-.036.586-.113.856-.039.135-.09.273-.16.404.169.387.107.819-.003 1.148a3.163 3.163 0 0 1-.488.901c.054.152.076.312.076.465 0 .305-.089.625-.253.912C13.1 15.522 12.437 16 11.5 16H8c-.605 0-1.07-.081-1.466-.218a4.82 4.82 0 0 1-.97-.484l-.048-.03c-.504-.307-.999-.609-2.068-.722C2.682 14.464 2 13.846 2 13V9c0-.85.685-1.432 1.357-1.615.849-.232 1.574-.787 2.132-1.41.56-.627.914-1.28 1.039-1.639.199-.575.356-1.539.428-2.59z">
                                            </path>
                                        </svg></a>
                                    <span>12</span>
                                </div>
                                <div class="flex text-sm text-gray-700 dark:text-gray-400">
                                    <a href="#" class="inline-flex hover:underline">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="currentColor" class="w-4 h-4 mr-1 text-blue-400 bi bi-chat"
                                            viewBox="0 0 16 16">
                                            <path
                                                d="M2.678 11.894a1 1 0 0 1 .287.801 10.97 10.97 0 0 1-.398 2c1.395-.323 2.247-.697 2.634-.893a1 1 0 0 1 .71-.074A8.06 8.06 0 0 0 8 14c3.996 0 7-2.807 7-6 0-3.192-3.004-6-7-6S1 4.808 1 8c0 1.468.617 2.83 1.678 3.894zm-.493 3.905a21.682 21.682 0 0 1-.713.129c-.2.032-.352-.176-.273-.362a9.68 9.68 0 0 0 .244-.637l.003-.01c.248-.72.45-1.548.524-2.319C.743 11.37 0 9.76 0 8c0-3.866 3.582-7 8-7s8 3.134 8 7-3.582 7-8 7a9.06 9.06 0 0 1-2.347-.306c-.52.263-1.639.742-3.468 1.105z">
                                            </path>
                                        </svg>Reply</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="py-6 bg-white rounded-md shadow dark:bg-gray-900">
                    <div
                        class="flex flex-wrap items-center justify-between pb-4 mb-6 space-x-2 border-b dark:border-gray-700">
                        <div class="flex items-center px-6 mb-2 md:mb-0 ">
                            <div class="flex mr-2 rounded-full">
                                <img src="https://i.postimg.cc/4NMZPYdh/pexels-dinielle-de-veyra-4195342.jpg"
                                    alt="" class="object-cover w-12 h-12 rounded-full">
                            </div>
                            <div>
                                <h2 class="text-lg font-semibold text-gray-900 dark:text-gray-300">
                                    James jack</h2>
                                <p class="text-xs text-gray-500 dark:text-gray-400">Java Programmer</p>
                            </div>
                        </div>
                        <p class="px-6 text-base font-medium text-gray-600 dark:text-gray-400"> Joined 12, SEP , 2022
                        </p>
                    </div>
                    <p class="px-6 mb-6 text-base text-gray-500 dark:text-gray-400">
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Autem cupiditate similique,
                        iure minus sed fugit obcaecati minima quam reiciendis dicta!
                    </p>
                    <div class="flex flex-wrap justify-between pt-4 border-t dark:border-gray-700">
                        <div class="flex px-6 mb-2 md:mb-0">
                            <ul class="flex items-center justify-start mr-4">
                                <li>
                                    <a href="#">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="currentColor"
                                            class="w-4 mr-1 text-blue-500 dark:text-blue-400 bi bi-star-fill"
                                            viewBox="0 0 16 16">
                                            <path
                                                d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z">
                                            </path>
                                        </svg>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="currentColor"
                                            class="w-4 mr-1 text-blue-500 dark:text-blue-400 bi bi-star-fill"
                                            viewBox="0 0 16 16">
                                            <path
                                                d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z">
                                            </path>
                                        </svg>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="currentColor"
                                            class="w-4 mr-1 text-blue-500 dark:text-blue-400 bi bi-star-fill"
                                            viewBox="0 0 16 16">
                                            <path
                                                d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z">
                                            </path>
                                        </svg>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="currentColor"
                                            class="w-4 mr-1 text-blue-500 dark:text-blue-400 bi bi-star-fill"
                                            viewBox="0 0 16 16">
                                            <path
                                                d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z">
                                            </path>
                                        </svg>
                                    </a>
                                </li>
                            </ul>
                            <h2 class="text-sm text-gray-500 dark:text-gray-400">Rating:<span
                                    class="font-semibold text-gray-600 dark:text-gray-300">
                                    3.0</span>
                            </h2>
                        </div>
                        <div
                            class="flex items-center px-6 space-x-1 text-sm font-medium text-gray-500 dark:text-gray-400">
                            <div class="flex items-center">
                                <div class="flex mr-3 text-sm text-gray-700 dark:text-gray-400">
                                    <a href="#"><svg xmlns="http://www.w3.org/2000/svg" width="16"
                                            height="16" fill="currentColor"
                                            class="w-4 h-4 mr-1 text-blue-400 bi bi-hand-thumbs-up-fill"
                                            viewBox="0 0 16 16">
                                            <path
                                                d="M6.956 1.745C7.021.81 7.908.087 8.864.325l.261.066c.463.116.874.456 1.012.965.22.816.533 2.511.062 4.51a9.84 9.84 0 0 1 .443-.051c.713-.065 1.669-.072 2.516.21.518.173.994.681 1.2 1.273.184.532.16 1.162-.234 1.733.058.119.103.242.138.363.077.27.113.567.113.856 0 .289-.036.586-.113.856-.039.135-.09.273-.16.404.169.387.107.819-.003 1.148a3.163 3.163 0 0 1-.488.901c.054.152.076.312.076.465 0 .305-.089.625-.253.912C13.1 15.522 12.437 16 11.5 16H8c-.605 0-1.07-.081-1.466-.218a4.82 4.82 0 0 1-.97-.484l-.048-.03c-.504-.307-.999-.609-2.068-.722C2.682 14.464 2 13.846 2 13V9c0-.85.685-1.432 1.357-1.615.849-.232 1.574-.787 2.132-1.41.56-.627.914-1.28 1.039-1.639.199-.575.356-1.539.428-2.59z">
                                            </path>
                                        </svg></a>
                                    <span>12</span>
                                </div>
                                <div class="flex text-sm text-gray-700 dark:text-gray-400">
                                    <a href="#" class="inline-flex hover:underline">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="currentColor" class="w-4 h-4 mr-1 text-blue-400 bi bi-chat"
                                            viewBox="0 0 16 16">
                                            <path
                                                d="M2.678 11.894a1 1 0 0 1 .287.801 10.97 10.97 0 0 1-.398 2c1.395-.323 2.247-.697 2.634-.893a1 1 0 0 1 .71-.074A8.06 8.06 0 0 0 8 14c3.996 0 7-2.807 7-6 0-3.192-3.004-6-7-6S1 4.808 1 8c0 1.468.617 2.83 1.678 3.894zm-.493 3.905a21.682 21.682 0 0 1-.713.129c-.2.032-.352-.176-.273-.362a9.68 9.68 0 0 0 .244-.637l.003-.01c.248-.72.45-1.548.524-2.319C.743 11.37 0 9.76 0 8c0-3.866 3.582-7 8-7s8 3.134 8 7-3.582 7-8 7a9.06 9.06 0 0 1-2.347-.306c-.52.263-1.639.742-3.468 1.105z">
                                            </path>
                                        </svg>Reply</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    {{-- customer review section end --}}

    </div>
