<section>
    {{-- Hero Section --}}


    <div class="w-full bg-white py-10 px-4 sm:px-6 lg:px-8 mx-auto max-w-[85rem]">
        <div class="grid gap-10">

            {{-- Top Content --}}
            <div class="text-center md:text-left text-green-700 dark:text-green-200">
                <h1 class="text-4xl sm:text-5xl lg:text-6xl leading-tight tracking-tight">
                    Start your journey with
                    <span class="text-green-600 bg-green-100 px-2 py-1 rounded-md shadow-sm inline-block font-bold">
                        Jui Power Digital IPS
                    </span>
                </h1>
                <p
                    class="mt-6 text-lg sm:text-xl md:text-2xl lg:text-3xl font-bold text-green-600 dark:text-green-300 tracking-wide flex items-center justify-center md:justify-start gap-2 min-h-[2.5rem] sm:min-h-[3rem]">
                    <span id="typing-text" class="whitespace-nowrap overflow-hidden text-ellipsis max-w-full"></span>
                    <span id="cursor" class="text-green-500 text-2xl sm:text-3xl font-bold">|</span>
                </p>



                <p class="mt-6 text-base sm:text-lg text-gray-700 dark:text-gray-300 max-w-xl">
                    Explore the Future of Uninterrupted Power —
                    <span class="text-green-700 font-medium">Eco-smart solutions</span> for every home and office.
                    Sustainable, reliable, and made for a better tomorrow.
                </p>
            </div>


            <div class="mt-6 flex flex-col sm:flex-row items-center gap-4 sm:gap-6 justify-center md:justify-start">
                <a href="/register"
                    class="px-6 py-3 text-white bg-green-600 hover:bg-green-700 rounded-full font-semibold shadow-md 
              transition-transform duration-300 ease-in-out transform hover:scale-105 focus:outline-none focus:ring-2 focus:ring-green-400">
                    🌿 Get Started
                </a>
                <a id="contact-sales-btn"
                    class="px-6 py-3 text-green-800 bg-green-100 hover:bg-green-200 border border-green-300 rounded-full font-medium shadow-sm 
    transition-transform duration-300 ease-in-out transform hover:scale-105 focus:outline-none focus:ring-2 focus:ring-green-200 cursor-pointer">
                    📞 Contact Sales Team
                </a>

                <script>
                    document.getElementById('contact-sales-btn').addEventListener('click', function() {
                        const phoneNumber = '01713540038'; // Replace with your number, include country code (no spaces)

                        // Check if user is on a mobile device
                        if (/Mobi|Android/i.test(navigator.userAgent)) {
                            window.location.href = `tel:${phoneNumber}`;
                        } else {
                            window.open(`https://wa.me/${phoneNumber.replace('+', '')}`, '_blank');
                        }
                    });
                </script>

            </div>








            {{-- Advertisement Slider --}}
            <div class="relative w-full h-[70vh] md:h-[400px] rounded-lg overflow-hidden shadow-lg" id="ad-slider">

                @if ($ads->count() > 0)
                    @foreach ($ads as $index => $ad)
                        <div class="absolute inset-0 transition-opacity duration-700"
                            style="opacity: {{ $index === 0 ? '1' : '0' }};" data-index="{{ $index }}">

                            {{-- Desktop Image --}}
                            <img src="{{ asset('storage/' . $ad->image) }}"
                                class="object-cover w-full h-full hidden sm:block" />

                            {{-- Mobile Image (or fallback to desktop) --}}
                            <img src="{{ asset('storage/' . ($ad->mobile_image ?? $ad->image)) }}"
                                class="object-cover w-full h-full block sm:hidden" />


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

            setInterval(() => {
                let nextIndex = (current + 1) % total;
                showSlide(nextIndex);
            }, 4000);
        });
    </script>



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
                    dots[i]?.classList.toggle('bg-green-600', i === index);
                    dots[i]?.classList.toggle('bg-gray-300', i !== index);
                });
                current = index;
            }

            prevBtn?.addEventListener('click', () => {
                showSlide((current - 1 + total) % total);
            });

            nextBtn?.addEventListener('click', () => {
                showSlide((current + 1) % total);
            });

            dots.forEach(dot => {
                dot.addEventListener('click', () => {
                    showSlide(parseInt(dot.getAttribute('data-index')));
                });
            });

            setInterval(() => {
                showSlide((current + 1) % total);
            }, 3000);
        });
    </script>
    {{-- script for typing effect --}}

    <script>
        document.addEventListener("DOMContentLoaded", () => {
            const textEl = document.getElementById("typing-text");
            const cursorEl = document.getElementById("cursor");

            const messages = [
                "No.1 Solar & IPS Provider in Bangladesh",
                "Smart, Green & Reliable Power Solutions",
                "Powering a Sustainable Tomorrow 💡☀️"
            ];

            let messageIndex = 0;
            let charIndex = 0;
            let isDeleting = false;

            function typeEffect() {
                const current = messages[messageIndex];
                const visibleText = current.substring(0, charIndex);
                textEl.textContent = visibleText;

                if (isDeleting) {
                    charIndex--;
                    if (charIndex === 0) {
                        isDeleting = false;
                        messageIndex = (messageIndex + 1) % messages.length;
                        setTimeout(typeEffect, 700);
                        return;
                    }
                } else {
                    charIndex++;
                    if (charIndex === current.length) {
                        isDeleting = true;
                        setTimeout(typeEffect, 1500);
                        return;
                    }
                }

                const delay = isDeleting ? 40 : 70;
                setTimeout(typeEffect, delay);
            }

            typeEffect();
        });
    </script>


    {{-- end script for typing effect --}}






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

    {{-- completed project section start --}}
    @livewire('show-projects')


    {{-- completed project section end --}}

    {{-- products reviews section start --}}




    </div>
