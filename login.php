<!doctype html>
<html>


<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - {{ APP_NAME }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        [x-cloak] {
            display: none !important;
        }
    </style>
    @livewireStyles

    {{-- <script defer src="https://unpkg.com/alpinejs@3.4.2/dist/cdn.min.js"></script>
    <script defer src="https://unpkg.com/@alpinejs/collapse@3.4.2/dist/cdn.min.js"></script> --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.5.1/chart.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/alertifyjs@1.14.0/build/css/alertify.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/alertifyjs@1.14.0/build/alertify.min.js"></script>
</head>

<body>

    <div x-data="{ menuOpen: false }" class="flex min-h-screen custom-scrollbar">
        <!-- start::Black overlay -->
        <div :class="menuOpen ? 'block' : 'hidden'" @click="menuOpen = false"
            class="fixed z-20 inset-0 bg-black opacity-50 transition-opacity lg:hidden"></div>
        <!-- end::Black overlay -->
        {{-- side bar --}}
        <aside :class="menuOpen ? 'translate-x-0 ease-out' : '-translate-x-full ease-in'"
            class="fixed z-30 inset-y-0 left-0 w-64 transition duration-300 bg-secondary overflow-y-auto lg:translate-x-0 lg:inset-0 custom-scrollbar">
            <!-- start::Logo -->
            <div class="flex items-center justify-center bg-black bg-opacity-30 h-16">
                <h1 class="text-gray-100 text-lg font-bold uppercase tracking-widest">{{ APP_NAME }}</h1>
            </div>
            <!-- end::Logo -->

            <!-- start::Navigation -->
            <nav class="py-10 custom-scrollbar">
                <!-- start::Menu link -->
                <a x-data="{ linkHover: false }" @mouseover="linkHover = true" @mouseleave="linkHover = false"
                    href="{{ route('vendor-dashboard') }}"
                    class="flex items-center text-gray-400 px-6 py-3 cursor-pointer hover:bg-black hover:bg-opacity-30 transition duration-200">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 transition duration-200"
                        :class="linkHover ? 'text-gray-100' : ''" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                    </svg>
                    <span class="ml-3 transition duration-200" :class="linkHover ? 'text-gray-100' : ''">
                        Dashboard
                    </span>
                </a>
                <!-- end::Menu link -->

                <!-- start::Menu link -->
                <a x-data="{ linkHover: false }" @mouseover="linkHover = true" @mouseleave="linkHover = false"
                    href="{{ route('vendor-profile') }}"
                    class="flex items-center text-gray-400 px-6 py-3 cursor-pointer hover:bg-black hover:bg-opacity-30 transition duration-200">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 transition duration-200"
                        :class="linkHover ? 'text-gray-100' : ''" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M5.121 19.071A10 10 0 1119.07 5.121a10 10 0 01-13.95 13.95zM12 10a4 4 0 100-8 4 4 0 000 8zm0 2a6.978 6.978 0 00-5.288 2.345A8.955 8.955 0 0112 20a8.955 8.955 0 015.288-5.655A6.978 6.978 0 0012 12z" />
                    </svg>
                    <span class="ml-3 transition duration-200" :class="linkHover ? 'text-gray-100' : ''">
                        Profile
                    </span>
                </a>

                {{-- spares --}}

                <div x-data="{ linkHover: false, linkActive: false }">
                    <div @mouseover="linkHover = true" @mouseleave="linkHover = false" @click="linkActive = !linkActive"
                        class="flex items-center justify-between text-gray-400 hover:text-gray-100 px-6 py-3 cursor-pointer hover:bg-black hover:bg-opacity-30 transition duration-200"
                        :class="linkActive ? 'bg-black bg-opacity-30 text-gray-100' : ''">
                        <div class="flex items-center">
                            <!-- Master Product Icon -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 transition duration-200"
                                :class="linkHover || linkActive ? 'text-gray-100' : ''" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3 7l9-4 9 4v6a9 9 0 11-18 0V7z" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 21V9l6-3v15" />
                            </svg>
                            <span class="ml-3">Master Product</span>
                        </div>
                        <svg class="w-3 h-3 transition duration-300" :class="linkActive ? 'rotate-90' : ''" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </div>
                    <!-- start::Submenu -->
                    <ul x-show="linkActive" x-cloak x-collapse.duration.300ms class="text-gray-400">
                        <!-- start::Submenu link Orders -->

                        <a x-data="{ linkHover: false }" @mouseover="linkHover = true" @mouseleave="linkHover = false"
                            href="{{ route('vendor_spares.index') }}"
                            class="flex items-center text-gray-400 px-6 py-3 cursor-pointer hover:bg-black hover:bg-opacity-30 transition duration-200">
                            <!-- Spares Icon -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 transition duration-200"
                                :class="linkHover ? 'text-gray-100' : ''" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12.454 2.293l1.414 1.414a1 1 0 010 1.414L10.243 9.828a1 1 0 01-1.414 0L7.414 8.414a1 1 0 010-1.414l6.036-6.035a1 1 0 011.414 0l1.414 1.414a1 1 0 010 1.414L10.828 10a1 1 0 01-1.414 0L8.414 8.586a1 1 0 010-1.414l6.035-6.036a1 1 0 011.414 0zM8.414 12.828l5.657 5.657a1 1 0 001.414 0l2.829-2.828a1 1 0 000-1.414l-6.036-6.035a1 1 0 00-1.414 0L7 10.414a1 1 0 000 1.414l1.414 1.414zM6 19v1a1 1 0 001 1h2a1 1 0 001-1v-2.586a1 1 0 00-.293-.707L5.586 13a1 1 0 00-.707-.293H3a1 1 0 00-1 1v2a1 1 0 001 1h1v1h1v1H4v-1H3v-2a1 1 0 011-1h1.586l4.707 4.707a1 1 0 00.707.293H14v2h-2a1 1 0 01-1-1v-1H9v1H8v1H7v-1H6v-1zM14 6h1v1h1V6h1V5h-1V4h-1v1h-1v1zM4 5v1h1V5H4zM8 5h1V4H8v1zM3 8v1h1V8H3zm0-2v1h1V6H3z" />
                            </svg>
                            <span class="ml-3 transition duration-200" :class="linkHover ? 'text-gray-100' : ''">
                                Spares
                            </span>
                        </a>
                        <a x-data="{ linkHover: false }" @mouseover="linkHover = true" @mouseleave="linkHover = false"
                            href="{{ route('vendor_accessories.index') }}"
                            class="flex items-center text-gray-400 px-6 py-3 cursor-pointer hover:bg-black hover:bg-opacity-30 transition duration-200">
                            <!-- Accessories Icon -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 transition duration-200"
                                :class="linkHover ? 'text-gray-100' : ''" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 8h14l1 12H4L5 8zm7-6a3 3 0 013 3v2H9V5a3 3 0 013-3z" />
                            </svg>
                            <span class="ml-3 transition duration-200" :class="linkHover ? 'text-gray-100' : ''">
                                Accessories
                            </span>
                        </a>
                        <a x-data="{ linkHover: false }" @mouseover="linkHover = true" @mouseleave="linkHover = false"
                            href="{{ route('kit_products.index') }}"
                            class="flex items-center text-gray-400 px-6 py-3 cursor-pointer hover:bg-black hover:bg-opacity-30 transition duration-200">
                            <!-- Kit Product Icon -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 transition duration-200"
                                :class="linkHover ? 'text-gray-100' : ''" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M20.25 8.25L12 2.25l-8.25 6L3 21h18L20.25 8.25z" />
                            </svg>
                            <span class="ml-3 transition duration-200" :class="linkHover ? 'text-gray-100' : ''">
                                Kit Products
                            </span>
                        </a>

                    </ul>
                </div>
                <!-- end::Menu link -->

                <!-- start::Menu link -->

                <a x-data="{ linkHover: false }" @mouseover="linkHover = true" @mouseleave="linkHover = false"
                    href="{{ route('packages.List') }}"
                    class="flex items-center text-gray-400 px-6 py-3 cursor-pointer hover:bg-black hover:bg-opacity-30 transition duration-200">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 transition duration-200"
                        :class="linkHover ? 'text-gray-100' : ''" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 8c2.21 0 4-1.79 4-4H8c0 2.21 1.79 4 4 4zm0 2c-3.31 0-6 2.69-6 6v3h12v-3c0-3.31-2.69-6-6-6zM4 19h16v-1H4v1z" />
                    </svg>
                    <span class="ml-3 transition duration-200" :class="linkHover ? 'text-gray-100' : ''">Buy Packages</span>
                </a>

                <a x-data="{ linkHover: false }" @mouseover="linkHover = true" @mouseleave="linkHover = false" href="#"
                    class="flex items-center text-gray-400 px-6 py-3 cursor-pointer hover:bg-black hover:bg-opacity-30 transition duration-200">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 transition duration-200"
                        :class="linkHover ? 'text-gray-100' : ''" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path
                            d="M1 5h1.424a3.228 3.228 0 0 0 6.152 0H19a1 1 0 1 0 0-2H8.576a3.228 3.228 0 0 0-6.152 0H1a1 1 0 1 0 0 2Zm18 4h-1.424a3.228 3.228 0 0 0-6.152 0H1a1 1 0 1 0 0 2h10.424a3.228 3.228 0 0 0 6.152 0H19a1 1 0 0 0 0-2Zm0 6H8.576a3.228 3.228 0 0 0-6.152 0H1a1 1 0 0 0 0 2h1.424a3.228 3.228 0 0 0 6.152 0H19a1 1 0 0 0 0-2Z" />
                    </svg>
                    <span class="ml-3 transition duration-200" :class="linkHover ? 'text-gray-100' : ''">Settings
                    </span>
                </a>
                <!-- end::Menu link -->

                <!-- start::Menu link -->
                <a x-data="{ linkHover: false }" @mouseover="linkHover = true" @mouseleave="linkHover = false" href="#"
                    class="flex items-center text-gray-400 px-6 py-3 cursor-pointer hover:bg-black hover:bg-opacity-30 transition duration-200">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 transition duration-200"
                        :class="linkHover ? 'text-gray-100' : ''" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                    <span class="ml-3 transition duration-200" :class="linkHover ? 'text-gray-100' : ''">Settlement
                    </span>
                </a>
                <!-- end::Menu link -->
                <!-- start::Menu link -->
                <a x-data="{ linkHover: false }" @mouseover="linkHover = true" @mouseleave="linkHover = false" href="{{ route('mechanic.credit.index') }}"
                    class="flex items-center text-gray-400 px-6 py-3 cursor-pointer hover:bg-black hover:bg-opacity-30 transition duration-200">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 transition duration-200"
                        :class="linkHover ? 'text-gray-100' : ''" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                    <span class="ml-3 transition duration-200" :class="linkHover ? 'text-gray-100' : ''">Mechanic
                    </span>
                </a>
                <!-- end::Menu link -->

                {{-- orders main menu --}}
                <!-- start::Menu link -->
                <div x-data="{ linkHover: false, linkActive: false }">
                    <div @mouseover="linkHover = true" @mouseleave="linkHover = false"
                        @click="linkActive = !linkActive"
                        class="flex items-center justify-between text-gray-400 hover:text-gray-100 px-6 py-3 cursor-pointer hover:bg-black hover:bg-opacity-30 transition duration-200"
                        :class="linkActive ? 'bg-black bg-opacity-30 text-gray-100' : ''">
                        <div class="flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 transition duration-200"
                                :class="linkHover || linkActive ? 'text-gray-100' : ''" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                            <span class="ml-3">Orders</span>
                        </div>
                        <svg class="w-3 h-3 transition duration-300" :class="linkActive ? 'rotate-90' : ''" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </div>
                    <!-- start::Submenu -->
                    <ul x-show="linkActive" x-cloak x-collapse.duration.300ms class="text-gray-400">

                        <!-- start::Submenu link Orders -->
                        <li
                            class="pl-10 pr-6 py-2 cursor-pointer hover:bg-black hover:bg-opacity-30 transition duration-200 hover:text-gray-100">
                            <a href="{{ route('vendor-orders') }}" class="flex items-center">
                                <span class="mr-2 text-sm">&bull;</span>
                                <span class="overflow-ellipsis">Orders</span>
                            </a>
                        </li>
                        <!-- end::Submenu link -->

                        <!-- start::Submenu link Orders -->
                        <li
                            class="pl-10 pr-6 py-2 cursor-pointer hover:bg-black hover:bg-opacity-30 transition duration-200 hover:text-gray-100">
                            <a href="./pages/ecommerce/products.html" class="flex items-center">
                                <span class="mr-2 text-sm">&bull;</span>
                                <span class="overflow-ellipsis">Shippments</span>
                            </a>
                        </li>
                        <!-- end::Submenu link -->

                        <!-- start::Submenu link Tracks-->
                        <li
                            class="pl-10 pr-6 py-2 cursor-pointer hover:bg-black hover:bg-opacity-30 transition duration-200 hover:text-gray-100">
                            <a href="./pages/ecommerce/productDetails.html" class="flex items-center">
                                <span class="mr-2 text-sm">&bull;</span>
                                <span class="overflow-ellipsis">Tracks</span>
                            </a>
                        </li>
                        <!-- end::Submenu link -->


                        <!-- start::Submenu link  Support -->
                        <li
                            class="pl-10 pr-6 py-2 cursor-pointer hover:bg-black hover:bg-opacity-30 transition duration-200 hover:text-gray-100">
                            <a href="./pages/ecommerce/shoppingCart.html" class="flex items-center">
                                <span class="mr-2 text-sm">&bull;</span>
                                <span class="overflow-ellipsis">Support</span>
                            </a>
                        </li>
                        <!-- end::Submenu link -->
                    </ul>
                    <!-- end::Submenu -->
                </div>
                <!-- end::Menu link -->

                <!-- start::Menu link -->
                <a x-data="{ linkHover: false }" @mouseover="linkHover = true" @mouseleave="linkHover = false"
                    href="./pages/colors.html"
                    class="flex items-center text-gray-400 px-6 py-3 cursor-pointer hover:bg-black hover:bg-opacity-30 transition duration-200">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 transition duration-200"
                        :class="linkHover ? 'text-gray-100' : ''" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h12a2 2 0 002-2v-4a2 2 0 00-2-2h-2.343M11 7.343l1.657-1.657a2 2 0 012.828 0l2.829 2.829a2 2 0 010 2.828l-8.486 8.485M7 17h.01" />
                    </svg>
                    <span class="ml-3 transition duration-200" :class="linkHover ? 'text-gray-100' : ''">
                        Report
                    </span>
                </a>
                <!-- end::Menu link -->

                <!-- start::Menu link -->
                <a x-data="{ linkHover: false }" @mouseover="linkHover = true" @mouseleave="linkHover = false"
                    href="./pages/colors.html"
                    class="flex items-center text-gray-400 px-6 py-3 cursor-pointer hover:bg-black hover:bg-opacity-30 transition duration-200">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 transition duration-200"
                        :class="linkHover ? 'text-gray-100' : ''" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h12a2 2 0 002-2v-4a2 2 0 00-2-2h-2.343M11 7.343l1.657-1.657a2 2 0 012.828 0l2.829 2.829a2 2 0 010 2.828l-8.486 8.485M7 17h.01" />
                    </svg>
                    <span class="ml-3 transition duration-200" :class="linkHover ? 'text-gray-100' : ''">
                        Shippments
                    </span>
                </a>
                <!-- end::Menu link -->

            </nav>
            <!-- end::Navigation -->
        </aside>
        {{-- side bar end --}}

        <div class="lg:pl-64 w-full flex flex-col">
            <!-- start::Topbar -->
            <div class="flex flex-col">
                <header class="flex justify-between items-center h-16 py-4 px-6 bg-secondary">
                    <!-- start::Mobile menu button -->
                    <div class="flex items-center">
                        <button @click="menuOpen = true"
                            class="text-gray-500 hover:text-primary focus:outline-none lg:hidden transition duration-200">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7">
                                </path>
                            </svg>
                        </button>
                    </div>
                    <!-- end::Mobile menu button -->

                    <!-- start::Right side top menu -->
                    <div class="flex items-center">
                        <!-- start::Notifications -->
                        <div x-data="{ linkActive: false }" class="relative mx-6">
                            <!-- start::Main link -->
                            <div @click="linkActive = !linkActive" class="cursor-pointer flex">
                                <svg class="w-6 h-6 cursor-pointer hover:white" fill="none" stroke="white" viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9">
                                    </path>
                                </svg>
                                <sub>
                                    <span class="bg-red-600 text-white px-1.5 py-0.5 rounded-full -ml-1 ">
                                        4
                                    </span>
                                </sub>
                            </div>
                            <!-- end::Main link -->

                            <!-- start::Submenu -->
                            <div x-show="linkActive" @click.away="linkActive = false" x-cloak
                                class="absolute right-0 w-96 top-11 border border-gray-300 z-10">
                                <!-- start::Submenu content -->
                                <div class="bg-white rounded max-h-96 overflow-y-scroll custom-scrollbar">
                                    <!-- start::Submenu header -->
                                    <div class="flex items-center justify-between px-4 py-2">
                                        <span class="font-bold">Notifications</span>
                                        <span class="text-xs px-1.5 py-0.5 bg-red-600 text-gray-100 rounded">
                                            4 new
                                        </span>
                                    </div>
                                    <hr>
                                    <!-- end::Submenu header -->
                                    <!-- start::Submenu link -->
                                    <a x-data="{ linkHover: false }" href="#"
                                        class="flex items-center justify-between py-4 px-3 hover:bg-gray-100 bg-opacity-20"
                                        @mouseover="linkHover = true" @mouseleave="linkHover = false">
                                        <div class="flex items-center">
                                            <svg class="w-8 h-8 bg-primary bg-opacity-20 text-primary px-1.5 py-0.5 rounded-full"
                                                fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z">
                                                </path>
                                            </svg>
                                            <div class="text-sm ml-3">
                                                <p class="text-gray-600 font-bold capitalize"
                                                    :class="linkHover ? 'text-primary' : ''">Order Completed</p>
                                                <p class="text-xs">Your order is completed</p>
                                            </div>
                                        </div>
                                        <span class="text-xs font-bold">
                                            5 min ago
                                        </span>
                                    </a>
                                    <!-- end::Submenu link -->
                                    <!-- start::Submenu link -->
                                    <a x-data="{ linkHover: false }" href="#"
                                        class="flex items-center justify-between py-4 px-3 hover:bg-gray-100 bg-opacity-20"
                                        @mouseover="linkHover = true" @mouseleave="linkHover = false">
                                        <div class="flex items-center">
                                            <img src="{{ $User->user_image_url }}" class="w-8 rounded-full">

                                            <div class="text-sm ml-3">
                                                <p class="text-gray-600 font-bold capitalize"
                                                    :class="linkHover ? 'text-primary' : ''">Maria sent you a message</p>
                                                <p class="text-xs">Hey there, how are you do...</p>
                                            </div>
                                        </div>
                                        <span class="text-xs font-bold">
                                            30 min ago
                                        </span>
                                    </a>
                                    <!-- end::Submenu link -->
                                    <!-- start::Submenu link -->
                                    <a x-data="{ linkHover: false }" href="#"
                                        class="flex items-center justify-between py-4 px-3 hover:bg-gray-100 bg-opacity-20"
                                        @mouseover="linkHover = true" @mouseleave="linkHover = false">
                                        <div class="flex items-center">
                                            <svg class="w-8 h-8 bg-primary bg-opacity-20 text-primary px-1.5 py-0.5 rounded-full"
                                                fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z">
                                                </path>
                                            </svg>
                                            <div class="text-sm ml-3">
                                                <p class="text-gray-600 font-bold capitalize"
                                                    :class="linkHover ? 'text-primary' : ''">Order Completed</p>
                                                <p class="text-xs">Your order is completed</p>
                                            </div>
                                        </div>
                                        <span class="text-xs font-bold">
                                            54 min ago
                                        </span>
                                    </a>
                                    <!-- end::Submenu link -->
                                    <!-- start::Submenu link -->
                                    <a x-data="{ linkHover: false }" href="#"
                                        class="flex items-center justify-between py-4 px-3 hover:bg-gray-100 bg-opacity-20"
                                        @mouseover="linkHover = true" @mouseleave="linkHover = false">
                                        <div class="flex items-center">
                                            <img src="{{ $User->user_image_url }}" class="w-8 rounded-full">
                                            <div class="text-sm ml-3">
                                                <p class="text-gray-600 font-bold capitalize"
                                                    :class="linkHover ? 'text-primary' : ''">Maria sent you a message</p>
                                                <p class="text-xs">Hey there, how are you do...</p>
                                            </div>
                                        </div>
                                        <span class="text-xs font-bold">
                                            1 hour ago
                                        </span>
                                    </a>
                                    <!-- end::Submenu link -->
                                    <!-- start::Submenu link -->
                                    <a x-data="{ linkHover: false }" href="#"
                                        class="flex items-center justify-between py-4 px-3 hover:bg-gray-100 bg-opacity-20"
                                        @mouseover="linkHover = true" @mouseleave="linkHover = false">
                                        <div class="flex items-center">
                                            <svg class="w-8 h-8 bg-primary bg-opacity-20 text-primary px-1.5 py-0.5 rounded-full"
                                                fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z">
                                                </path>
                                            </svg>
                                            <div class="text-sm ml-3">
                                                <p class="text-gray-600 font-bold capitalize"
                                                    :class="linkHover ? 'text-primary' : ''">Order Completed</p>
                                                <p class="text-xs">Your order is completed</p>
                                            </div>
                                        </div>
                                        <span class="text-xs font-bold">
                                            15 hours ago
                                        </span>
                                    </a>
                                    <!-- end::Submenu link -->
                                    <!-- start::Submenu link -->
                                    <a x-data="{ linkHover: false }" href="#"
                                        class="flex items-center justify-between py-4 px-3 hover:bg-gray-100 bg-opacity-20"
                                        @mouseover="linkHover = true" @mouseleave="linkHover = false">
                                        <div class="flex items-center">
                                            <img src="{{ $User->user_image_url }}" class="w-8 rounded-full">
                                            <div class="text-sm ml-3">
                                                <p class="text-gray-600 font-bold capitalize"
                                                    :class="linkHover ? 'text-primary' : ''">Maria sent you a message</p>
                                                <p class="text-xs">Hey there, how are you do...</p>
                                            </div>
                                        </div>
                                        <span class="text-xs font-bold">
                                            12 day ago
                                        </span>
                                    </a>
                                    <!-- end::Submenu link -->
                                    <!-- start::Submenu link -->
                                    <a x-data="{ linkHover: false }" href="#"
                                        class="flex items-center justify-between py-4 px-3 hover:bg-gray-100 bg-opacity-20"
                                        @mouseover="linkHover = true" @mouseleave="linkHover = false">
                                        <div class="flex items-center">
                                            <svg class="w-8 h-8 bg-primary bg-opacity-20 text-primary px-1.5 py-0.5 rounded-full"
                                                fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z">
                                                </path>
                                            </svg>
                                            <div class="text-sm ml-3">
                                                <p class="text-gray-600 font-bold capitalize"
                                                    :class="linkHover ? 'text-primary' : ''">Order Completed</p>
                                                <p class="text-xs">Your order is completed</p>
                                            </div>
                                        </div>
                                        <span class="text-xs font-bold">
                                            3 months ago
                                        </span>
                                    </a>
                                    <!-- end::Submenu link -->
                                    <!-- start::Submenu link -->
                                    <a x-data="{ linkHover: false }" href="#" class="flex items-center justify-between py-4 px-3 hover:bg-gray-100 bg-opacity-20" @mouseover="linkHover = true" @mouseleave="linkHover = false">
                                        <div class="flex items-center">
                                            <img src="{{ $User->user_image_url }}" class="w-8 rounded-full">
                                            <div class="text-sm ml-3">
                                                <p class="text-gray-600 font-bold capitalize"
                                                    :class="linkHover ? 'text-primary' : ''">Maria sent you a message</p>
                                                <p class="text-xs">Hey there, how are you do...</p>
                                            </div>
                                        </div>
                                        <span class="text-xs font-bold">
                                            10 months ago
                                        </span>
                                    </a>
                                    <!-- end::Submenu link -->
                                </div>
                                <!-- end::Submenu content -->
                            </div>
                            <!-- end::Submenu -->
                        </div>
                        <!-- end::Notifications -->

                        <!-- start::Profile -->
                        <div x-data="{ linkActive: false }" class="relative">
                            <!-- start::Main link -->
                            <div @click="linkActive = !linkActive" class="cursor-pointer">
                                <img src="{{ $User->user_image_url }}" alt="Default Profile Image" class="w-10 h-10 rounded-full">
                            </div>
                            <!-- end::Main link -->

                            <!-- start::Submenu -->
                            <div x-show="linkActive" @click.away="linkActive = false" x-cloak class="absolute right-0 w-40 top-11 border border-gray-300 z-20">
                                <!-- start::Submenu content -->
                                <div class="bg-white rounded">
                                    <!-- start::Submenu link -->
                                    {{-- <a x-data="{ linkHover: false }"
                        href="{{ route(auth()->guard('admin')->check() ? 'admin-profile' : 'vendor-profile') }}"
                                    class="flex items-center justify-between py-2 px-3 hover:bg-gray-100 bg-opacity-20" @mouseover="linkHover = true" @mouseleave="linkHover = false"> --}}

                                    <a x-data="{ linkHover: false }" href="{{ route('vendor-profile') }}" class="flex items-center justify-between py-2 px-3 hover:bg-gray-100 bg-opacity-20" @mouseover="linkHover = true" @mouseleave="linkHover = false">
                                        <div class="flex items-center">
                                            <svg class="w-5 h-5 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                            </svg>
                                            <div class="text-sm ml-3">
                                                <p class="text-gray-600 font-bold capitalize" :class="linkHover ? 'text-primary' : ''">Profile</p>
                                            </div>
                                        </div>
                                    </a>
                                    <!-- end::Submenu link -->
                                    <!-- start::Submenu link -->
                                    <a x-data="{ linkHover: false }" href="./email/inbox.html"
                                        class="flex items-center justify-between py-2 px-3 hover:bg-gray-100 bg-opacity-20"
                                        @mouseover="linkHover = true" @mouseleave="linkHover = false">
                                        <div class="flex items-center">
                                            <svg class="w-5 h-5 text-primary" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z">
                                                </path>
                                            </svg>
                                            <div class="text-sm ml-3">
                                                <p class="text-gray-600 font-bold capitalize"
                                                    :class="linkHover ? 'text-primary' : ''">
                                                    Inbox
                                                    <span
                                                        class="bg-red-600 text-gray-100 text-xs px-1.5 py-0.5 ml-2 rounded">3</span>
                                                </p>
                                            </div>
                                        </div>
                                    </a>
                                    <!-- end::Submenu link -->
                                    <!-- start::Submenu link -->
                                    <a x-data="{ linkHover: false }" href="./settings.html"
                                        class="flex items-center justify-between py-2 px-3 hover:bg-gray-100 bg-opacity-20"
                                        @mouseover="linkHover = true" @mouseleave="linkHover = false">
                                        <div class="flex items-center">
                                            <svg class="w-5 h-5 text-primary" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z">
                                                </path>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                            </svg>
                                            <div class="text-sm ml-3">
                                                <p class="text-gray-600 font-bold capitalize"
                                                    :class="linkHover ? 'text-primary' : ''">Settlement</p>
                                            </div>
                                        </div>
                                    </a>
                                    <!-- end::Submenu link -->
                                    <!-- start::Submenu link -->
                                    <a x-data="{ linkHover: false }" href="./settings.html"
                                        class="flex items-center justify-between py-2 px-3 hover:bg-gray-100 bg-opacity-20"
                                        @mouseover="linkHover = true" @mouseleave="linkHover = false">
                                        <div class="flex items-center">
                                            <svg class="w-5 h-5 text-primary" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z">
                                                </path>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                            </svg>
                                            <div class="text-sm ml-3">
                                                <p class="text-gray-600 font-bold capitalize"
                                                    :class="linkHover ? 'text-primary' : ''">Settings</p>
                                            </div>
                                        </div>
                                    </a>
                                    <!-- end::Submenu link -->

                                    <hr>

                                    <!-- start::Submenu link -->
                                    <form action="{{ route('vendor-logout') }}" method="POST" x-data="{ linkHover: false }"
                                        class="flex items-center justify-between py-2 px-3 hover:bg-gray-100 bg-opacity-20"
                                        @mouseover="linkHover = true" @mouseleave="linkHover = false">
                                        @csrf
                                        <button type="submit" class="flex items-center">
                                            <svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1">
                                                </path>
                                            </svg>
                                            <span class="ml-3 text-sm text-gray-600 font-bold capitalize"
                                                :class="linkHover ? 'text-primary' : ''">
                                                Log out
                                            </span>
                                        </button>
                                    </form>


                                    <!-- end::Submenu link -->
                                </div>
                                <!-- end::Submenu content -->
                            </div>
                            <!-- end::Submenu -->
                        </div>
                        <!-- end::Profile -->
                    </div>
                    <!-- end::Right side top menu -->
                </header>
            </div>

            <div class="h-full bg-gray-200 p-8">
                <!-- start::Form Layouts -->
                <div class="bg-white p-4 rounded-lg shadow-xl py-8 mt-12">
                    <!-- start:: Horizontal Form Layout -->
                    @if ($accessory_master->prod_id)
                    {!! Form::model($accessory_master, [
                    'route' => ['vendor_accessories.update', $accessory_master->prod_id],
                    'method' => 'PUT',
                    'class' => '',
                    'enctype' => 'multipart/form-data',
                    ]) !!}
                    @else
                    {!! Form::open([
                    'route' => ['vendor_accessories.storeSubmit'],
                    'method' => 'POST',
                    'class' => '',
                    'enctype' => 'multipart/form-data',
                    ]) !!}
                    @endif
                    <div class="flex flex-col space-y-8">
                        <div class="flex flex-col items-left">
                            <h4 class="text-xl capitalize text-left">{{ $accessory_master->prod_id ? 'Edit' : 'Add' }} Accessory</h4>
                        </div>
                        @include('flash_message')
                        <div class="flex justify-center">
                            <div class="w-full max-w-lg space-y-6">
                                {{-- <div x-data="generatePartNumber()" class="flex items-center my-4">
                            <div class="w-40">
                                {!! Form::label('prod_part_number', 'Part Number', ['class' => 'w-40']) !!}
                                <span class="text-red-500 ml-1">*</span>
                            </div>

                            <input type="text" x-model="partNumber" readonly
                                class="flex-1 py-2 px-3 border border-gray-300 mt-1 rounded bg-gray-100 focus:outline-none"
                                placeholder="Click 'Generate' to create Part Number" />

                          <button type="button" @click="generate()"
                                class="ml-2 bg-primary-site text-white py-2 px-4 rounded hover:bg-blue-600">
                                Generate
                            </button>

                            <input type="hidden" name="prod_part_number" x-ref="hiddenInput">
                        </div> --}}
                                <div class="flex items-center my-4">
                                    <div class="w-40">
                                        {!! Form::label('prod_part_number', 'Part Number') !!}
                                        <span class="text-red-500 ml-1">*</span>
                                    </div>
                                    {!! Form::text('prod_part_number', null, [
                                    'id' => 'prod_part_number',
                                    'class' => 'flex-1 py-2 px-3 border-gray-300 rounded focus:outline-none focus:ring-0 focus:border-gray-300',
                                    'placeholder' => 'Product No.',
                                    'required' => true,
                                    'oninput' => "this.value = this.value.replace(/\\D/g, '')", // Allow only numeric input
                                    ]) !!}
                                </div>

                                <div class="flex items-center my-4">
                                    <div class="w-40">
                                        {!! Form::label('prod_name', 'Accessory Name', ['class' => 'w-40']) !!}
                                        <span class="text-red-500 ml-1">*</span>
                                    </div>
                                    {!! Form::text('prod_name', $accessory_master->prod_name, [
                                    'class' =>
                                    'flex-1 py-2 px-3 border border-gray-300 mt-1 rounded focus:outline-none focus:ring focus:ring-blue-200 focus:border-blue-500',
                                    'placeholder' => 'Enter Accessory Name',
                                    ]) !!}
                                </div>
                                <!-- Image Upload Section -->
                                <div class="flex items-center my-4">
                                    <div class="w-40">
                                        {!! Form::label('product_images', 'Product Images', ['class' => 'w-40']) !!}
                                        <span class="text-red-500 ml-1">*</span>
                                    </div>
                                    {!! Form::file('product_images[]', [
                                    'class' =>
                                    'flex-1 py-2 px-3 border border-gray-300 mt-1 rounded focus:outline-none focus:ring focus:ring-blue-200 focus:border-blue-500',
                                    'multiple' => 'multiple',
                                    'accept' => 'image/*',
                                    ]) !!}
                                </div>

                                <!-- Optional: Preview images before upload (JavaScript) -->
                                <div id="image-preview" class="flex mt-4 space-x-4">
                                    <!-- Preview images will appear here -->
                                </div>

                                <div class="flex items-center my-4">
                                    <div class="w-40">
                                        {!! Form::label('prod_code', 'HSN Code') !!}
                                        <span class="text-red-500 ml-1">*</span>
                                    </div>
                                    {!! Form::text('prod_code', null, [
                                    'id' => 'prod_code',
                                    'class' => 'flex-1 py-2 border-gray-300 rounded focus:outline-none focus:ring-0 focus:border-gray-300',
                                    'placeholder' => 'Product Code',
                                    'required' => true,
                                    ]) !!}
                                </div>
                                <div class="flex items-center my-4">
                                    {{-- <div class="w-40"> --}}
                                    {!! Form::label('prod_country_of_origin', 'Country of Origin', ['class' => 'w-40']) !!}
                                    {{-- <span class="text-red-500 ml-1">*</span>
                            </div> --}}
                                    {!! Form::text('prod_country_of_origin', $accessory_master->prod_country_of_origin, [
                                    'class' =>
                                    'flex-1 py-2 px-3 border border-gray-300 mt-1 rounded focus:outline-none focus:ring focus:ring-blue-200 focus:border-blue-500',
                                    'placeholder' => 'Enter Country of Origin',
                                    ]) !!}
                                </div>
                                <div class="flex items-center my-4">
                                    <div class="w-40">
                                        {!! Form::label('prod_net_quantity', 'Net Quantity', ['class' => 'w-40']) !!}
                                        <span class="text-red-500 ml-1">*</span>
                                    </div>
                                    {!! Form::text('prod_net_quantity', $accessory_master->prod_net_quantity, [
                                    'class' =>
                                    'flex-1 py-2 px-3 border border-gray-300 mt-1 rounded focus:outline-none focus:ring focus:ring-blue-200 focus:border-blue-500',
                                    'placeholder' => 'Enter Net Quantity',
                                    ]) !!}
                                </div>
                                <div class="flex items-center my-4">
                                    {!! Form::label('prod_manufacturer_or_packer_name', 'Manufacturer/Packer Name', ['class' => 'w-40']) !!}
                                    {!! Form::text('prod_manufacturer_or_packer_name', $accessory_master->prod_manufacturer_or_packer_name, [
                                    'class' =>
                                    'flex-1 py-2 px-3 border border-gray-300 mt-1 rounded focus:outline-none focus:ring focus:ring-blue-200 focus:border-blue-500',
                                    'placeholder' => 'Enter Manufacturer or Packer Name',
                                    ]) !!}
                                </div>
                                <div class="flex items-center my-4">
                                    {!! Form::label('prod_manufacturing_date', 'Manufacturing Date', ['class' => 'w-40']) !!}
                                    {!! Form::date('prod_manufacturing_date', $accessory_master->prod_manufacturing_date, [
                                    'class' =>
                                    'flex-1 py-2 px-3 border border-gray-300 mt-1 rounded focus:outline-none focus:ring focus:ring-blue-200 focus:border-blue-500',
                                    ]) !!}
                                </div>
                                <div class="flex items-center my-4">
                                    <div class="w-40">
                                        {!! Form::label('prod_moq', 'Product MOQ', ['class' => 'w-40']) !!}
                                        <span class="text-red-500 ml-1">*</span>
                                    </div>
                                    {!! Form::number('prod_moq', $accessory_master->prod_moq, [
                                    'class' =>
                                    'flex-1 py-2 px-3 border border-gray-300 rounded focus:outline-none focus:ring focus:ring-blue-200 focus:border-blue-500',
                                    'placeholder' => 'Enter value',
                                    'min' => 0,
                                    'step' => 'any',
                                    ]) !!}
                                </div>
                                <div class="flex items-center my-4">
                                    <div class="w-40">
                                        {!! Form::label('prod_mrp_amount', 'MRP Price', ['class' => 'w-40']) !!}
                                        <span class="text-red-500 ml-1">*</span>
                                    </div>
                                    {!! Form::text('prod_mrp_amount', $accessory_master->prod_mrp_amount, [
                                    'class' =>
                                    'flex-1 py-2 px-3 border border-gray-300 mt-1 rounded focus:outline-none focus:ring focus:ring-blue-200 focus:border-blue-500',
                                    'placeholder' => 'Enter Price',
                                    ]) !!}
                                </div>

                                <div class="flex items-center my-4">
                                    <div class="w-40">
                                        {!! Form::label('prod_price', 'Price', ['class' => 'w-40']) !!}
                                        <span class="text-red-500 ml-1">*</span>
                                    </div>
                                    {!! Form::text('prod_price', $accessory_master->prod_price, [
                                    'class' =>
                                    'flex-1 py-2 px-3 border border-gray-300 mt-1 rounded focus:outline-none focus:ring focus:ring-blue-200 focus:border-blue-500',
                                    'placeholder' => 'Enter Price',
                                    ]) !!}
                                </div>

                                <div class="flex items-center my-4">
                                    <div class="w-40">
                                        {!! Form::label('prod_length', 'Length (cm)') !!}
                                        <span class="text-red-500 ml-1">*</span>
                                    </div>
                                    {!! Form::number('prod_length', null, [
                                    'id' => 'prod_length',
                                    'class' => 'flex-1 py-2 border-gray-300 rounded focus:outline-none focus:ring-0 focus:border-gray-300',
                                    'placeholder' => 'Enter Length (e.g., 10)',
                                    'required' => true,
                                    'step' => '0.01',
                                    ]) !!}
                                </div>

                                <div class="flex items-center my-4">
                                    <div class="w-40">
                                        {!! Form::label('prod_width', 'Width (cm)') !!}
                                        <span class="text-red-500 ml-1">*</span>
                                    </div>
                                    {!! Form::number('prod_width', null, [
                                    'id' => 'prod_width',
                                    'class' => 'flex-1 py-2 border-gray-300 rounded focus:outline-none focus:ring-0 focus:border-gray-300',
                                    'placeholder' => 'Enter Width (e.g., 5)',
                                    'required' => true,
                                    'step' => '0.01',
                                    ]) !!}
                                </div>

                                <div class="flex items-center my-4">
                                    <div class="w-40">
                                        {!! Form::label('prod_height', 'Height (cm)') !!}
                                        <span class="text-red-500 ml-1">*</span>
                                    </div>
                                    {!! Form::number('prod_height', null, [
                                    'id' => 'prod_height',
                                    'class' => 'flex-1 py-2 border-gray-300 rounded focus:outline-none focus:ring-0 focus:border-gray-300',
                                    'placeholder' => 'Enter Height (e.g., 8)',
                                    'required' => true,
                                    'step' => '0.01',
                                    ]) !!}
                                </div>

                                <div x-data="{ showTaxName: '{{ $accessory_master->prod_price_type === 'included' ? 'true' : 'false' }}' }">
                                    <div class="flex items-center my-4">
                                        <div class="w-40">
                                            {!! Form::label('prod_price_type', 'Tax Type', ['class' => 'w-40']) !!}
                                            <span class="text-red-500 ml-1">*</span>
                                        </div>

                                        {!! Form::select(
                                        'prod_price_type',
                                        ['included' => 'included', 'excluded' => 'excluded'],
                                        $accessory_master->prod_price_type,
                                        [
                                        'class' =>
                                        'flex-1 py-2 px-3 border border-gray-300 rounded focus:outline-none focus:ring focus:ring-blue-200 focus:border-blue-500',
                                        'placeholder' => 'Select Price Type',
                                        'x-on:change' => 'showTaxName = $event.target.value === "included"',
                                        ],
                                        ) !!}
                                    </div>
                                    <div class="flex items-center my-4" x-show="showTaxName" x-cloak>
                                        <div class="w-40">
                                            {!! Form::label('prod_tax_name', 'Tax Name', ['class' => 'w-40']) !!}
                                            <span class="text-red-500 ml-1">*</span>
                                        </div>
                                        {!! Form::select('prod_tax_name', [null => 'Select Tax'] + $taxName->toArray(), null, [
                                        'class' => 'flex-1 py-2 border-gray-300 rounded focus:border-gray-300 f
                                        
                                               

                    
</body>
</html>