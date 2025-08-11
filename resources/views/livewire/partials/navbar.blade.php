<div>
    <header
        class="flex z-50 sticky top-0 flex-wrap md:justify-start md:flex-nowrap w-full bg-white/30 backdrop-blur-md text-sm py-3 md:py-0 shadow-lg border-b border-white/30 dark:bg-white dark:border-gray-700/30">
        <nav class="max-w-[85rem] w-full mx-auto px-4 md:px-6 lg:px-8" aria-label="Global">
            <div class="relative md:flex md:items-center md:justify-between">
                <div class="flex items-center justify-between">
                    <a class="flex items-center text-xl font-semibold dark:text-white dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600"
                        href="/" aria-label="Brand" wire:navigate>
                        <img src="/storage/logo/logo.png" alt="Brand Logo"
                            class="h-10 sm:h-12 md:h-14 lg:h-16 w-auto max-h-16 object-contain transition-all duration-300">
                    </a>
                    <div class="md:hidden">
                        <button type="button"
                            class="hs-collapse-toggle flex justify-center items-center w-9 h-9 text-sm font-semibold rounded-lg border border-gray-200 text-gray-800 hover:bg-gray-100 disabled:opacity-50 disabled:pointer-events-none dark:text-white dark:border-gray-700 dark:hover:bg-gray-700 dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600"
                            data-hs-collapse="#navbar-collapse-with-animation"
                            aria-controls="navbar-collapse-with-animation" aria-label="Toggle navigation">
                            <svg class="hs-collapse-open:hidden flex-shrink-0 w-4 h-4"
                                xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round">
                                <line x1="3" x2="21" y1="6" y2="6" />
                                <line x1="3" x2="21" y1="12" y2="12" />
                                <line x1="3" x2="21" y1="18" y2="18" />
                            </svg>
                            <svg class="hs-collapse-open:block hidden flex-shrink-0 w-4 h-4"
                                xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round">
                                <path d="M18 6 6 18" />
                                <path d="m6 6 12 12" />
                            </svg>
                        </button>
                    </div>
                </div>

                <div id="navbar-collapse-with-animation"
                    class="hs-collapse hidden overflow-hidden transition-all duration-300 basis-full grow md:block">
                    <div
                        class="overflow-hidden overflow-y-auto max-h-[75vh] [&::-webkit-scrollbar]:w-2 [&::-webkit-scrollbar-thumb]:rounded-full [&::-webkit-scrollbar-track]:bg-gray-100 [&::-webkit-scrollbar-thumb]:bg-gray-300 dark:[&::-webkit-scrollbar-track]:bg-slate-700 dark:[&::-webkit-scrollbar-thumb]:bg-slate-500">
                        <div
                            class="flex flex-col gap-x-0 mt-5 divide-y divide-dashed divide-gray-200 md:flex-row md:items-center md:justify-end md:gap-x-7 md:mt-0 md:ps-7 md:divide-y-0 md:divide-solid dark:divide-gray-700">

                            {{-- Navigation Links --}}
                            <a wire:navigate
                                class="relative font-medium transition-all duration-300 ease-in-out hover:text-green-600 hover:scale-[1.03] before:content-[''] before:absolute before:bottom-0.5 before:left-0 before:h-[2px] before:w-0 hover:before:w-full before:bg-green-600 before:transition-all before:duration-300 {{ request()->is('/') ? 'text-green-600' : 'text-gray-500' }} py-3 md:py-6 dark:text-green-500 dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600"
                                href="/" aria-current="page">Home</a>

                            <a wire:navigate
                                class="relative font-medium transition-all duration-300 ease-in-out hover:text-green-600 hover:scale-[1.03] before:content-[''] before:absolute before:bottom-0.5 before:left-0 before:h-[2px] before:w-0 hover:before:w-full before:bg-green-600 before:transition-all before:duration-300 {{ request()->is('categories') ? 'text-green-600' : 'text-gray-500' }} py-3 md:py-6 dark:text-green-500 dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600"
                                href="/categories">Category</a>

                            <a wire:navigate
                                class="relative font-medium transition-all duration-300 ease-in-out hover:text-green-600 hover:scale-[1.03] before:content-[''] before:absolute before:bottom-0.5 before:left-0 before:h-[2px] before:w-0 hover:before:w-full before:bg-green-600 before:transition-all before:duration-300 {{ request()->is('products') ? 'text-green-600' : 'text-gray-500' }} py-3 md:py-6 dark:text-green-500 dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600"
                                href="/products">Products</a>

                            {{-- Cart --}}
                            <a class="font-medium flex items-center text-gray-500 hover:text-gray-400 py-3 md:py-6 dark:text-gray-400 dark:hover:text-gray-500 dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600"
                                href="/cart">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="flex-shrink-0 w-5 h-5 mr-1">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M15.75 10.5V6a3.75 3.75 0 1 0-7.5 0v4.5m11.356-1.993 1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 0 1-1.12-1.243l1.264-12A1.125 1.125 0 0 1 5.513 7.5h12.974c.576 0 1.059.435 1.119 1.007ZM8.625 10.5a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm7.5 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                                </svg>
                                <span class="mr-1">Cart</span>
                                <span
                                    class="py-0.5 px-1.5 rounded-full text-xs font-medium bg-green-50 border border-green-200 text-green-600">
                                    {{ $total_count }}
                                </span>
                                <span wire:loading>Adding...</span>
                            </a>

                            {{-- Social Media Icons --}}
                            <div class="flex items-center gap-3 pt-3 md:pt-0 md:ml-6">
                                <a href="https://www.facebook.com/jpdisp" target="_blank" title="Facebook"
                                    class="w-10 h-10 flex items-center justify-center rounded-full bg-white text-blue-600 shadow hover:scale-110 hover:bg-blue-600 hover:text-white transition-all duration-300">
                                    <i class="fab fa-facebook-f text-lg"></i>
                                </a>
                                <a href="https://youtube.com/@juipowerdigitalips?si=kl7sETPbsRcQQID1" target="_blank" title="YouTube"
                                    class="w-10 h-10 flex items-center justify-center rounded-full bg-white text-red-600 shadow hover:scale-110 hover:bg-red-600 hover:text-white transition-all duration-300">
                                    <i class="fab fa-youtube text-lg"></i>
                                </a>
                                {{-- <a href="https://instagram.com/yourhandle" target="_blank" title="Instagram"
                                    class="w-10 h-10 flex items-center justify-center rounded-full bg-white text-pink-500 shadow hover:scale-110 hover:bg-pink-500 hover:text-white transition-all duration-300">
                                    <i class="fab fa-instagram text-lg"></i>
                                </a> --}}
                                <a href="https://wa.me/01713540038" target="_blank" title="WhatsApp"
                                    class="w-10 h-10 flex items-center justify-center rounded-full bg-white text-green-500 shadow hover:scale-110 hover:bg-green-500 hover:text-white transition-all duration-300">
                                    <i class="fab fa-whatsapp text-lg"></i>
                                </a>
                            </div>


                            {{-- Authentication --}}
                            @guest
                                <div class="pt-3 md:pt-0">
                                    <a class="py-2.5 px-4 inline-flex items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent bg-green-600 text-white hover:bg-green-700 disabled:opacity-50 disabled:pointer-events-none dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600"
                                        href="/login">
                                        <i class="fas fa-user"></i> Log in
                                    </a>
                                </div>
                            @endguest

                            @auth
                                <div class="relative hs-dropdown">
                                    <button type="button"
                                        class="flex items-center text-gray-500 hover:text-gray-400 font-medium dark:text-gray-400 dark:hover:text-gray-500"
                                        data-hs-dropdown>
                                        {{ Auth::user()->name }}
                                        <svg class="ml-2 w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none"
                                            stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                            <path d="m6 9 6 6 6-6" />
                                        </svg>
                                    </button>

                                    <div
                                        class="hs-dropdown-menu absolute right-0 top-full mt-2 z-50 hidden w-48 bg-white dark:bg-gray-800 shadow-md rounded-lg p-2 dark:border dark:border-gray-700">
                                        <a wire:navigate href="/my-orders"
                                            class="block px-4 py-2 text-sm text-gray-800 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-700">My
                                            Orders</a>
                                        <a href="#"
                                            class="block px-4 py-2 text-sm text-gray-800 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-700">My
                                            Account</a>
                                        <a href="/logout"
                                            class="block px-4 py-2 text-sm text-gray-800 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-700">Logout</a>
                                    </div>
                                </div>
                            @endauth

                        </div>
                    </div>
                </div>
            </div>
        </nav>
    </header>
</div>
