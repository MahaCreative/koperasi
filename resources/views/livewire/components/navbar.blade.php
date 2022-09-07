<!-- Start Navbar -->
<div>
    <header class="absolute top-0 left-0 z-10 flex items-center w-full bg-transparent">
        <div class="container">
            <!-- Agar bisa muncul seperti dropdown buat pembungkus navnya menjadi relative -->
            <div class="relative flex items-center justify-between">
                <!-- Logo -->
                <div class="px-4">
                    <a href="{{ route('home') }}" class="block py-6 text-lg font-bold text-primary">Koperasi Berkah
                        Sejahtera</a>
                </div>
                <!-- Navbar -->
                <div class="flex items-center justify-center px-4 ">
                    <button id="hamburger" name="hamburger" class="absolute block right-4 lg:hidden">
                        <span class="transition duration-300 ease-out origin-top-left hamburger-line"></span>
                        <span class="transition duration-300 ease-out hamburger-line"></span>
                        <span class="transition duration-300 ease-out origin-bottom-left hamburger-line"></span>
                    </button>
                    <nav id="nav-menu"
                        class="lg:static lg:bg-transparent lg:max-w-full hidden absolute py-5 bg-white shadow-lg rounded-lg max-w-[250px] w-full right-4 top-full lg:block lg:shadow-none lg:rounded-none">
                        <ul class="block lg:flex">
                            <li class="group">
                                <a class="{{ request()->is('/') ? 'text-primary ' : ' text-dark' }} flex py-2 mx-4 text-base  group-hover:text-primary"
                                    href="{{ route('home') }}">Home</a>
                            </li>
                            <li class="group">
                                <a class="{{ request()->is('artikel') ? 'text-primary ' : 'text-dark ' }}flex py-2 mx-4 text-base  group-hover:text-primary"
                                    href="{{ route('user-artikel') }}">Artikel</a>
                            </li>
                            <li class="group">
                                <a class="{{ request()->is('about') ? 'text-primary ' : 'text-dark ' }}flex py-2 mx-4 text-base  group-hover:text-primary"
                                    href="{{ route('about') }}">Tentang Kami</a>
                            </li>
                            <li class="group">
                                <a class="{{ request()->is('kontak-kami') ? 'text-primary ' : 'text-dark ' }}flex py-2 mx-4 text-base  group-hover:text-primary"
                                    href="{{ route('kontak-kami') }}">Contact</a>
                            </li>
                            <li class="group">
                                <a class="{{ request()->is('galery') ? 'text-primary ' : 'text-dark ' }}flex py-2 mx-4 text-base  group-hover:text-primary"
                                    href="{{ route('galery') }}">Galery</a>
                            </li>

                            @guest

                                <li class="group">
                                    <a class="{{ request()->is('login') ? ' text-primary ' : ' text-dark ' }}flex py-2 mx-4 text-base  group-hover:text-primary"
                                        href="{{ route('login') }}">Login</a>
                                </li>
                                <li class="group">
                                    <a class="{{ request()->is('register') ? ' text-primary ' : ' text-dark ' }}flex py-2 mx-4 text-base  group-hover:text-primary"
                                        href="{{ route('register') }}">Register</a>
                                </li>
                            @else
                                <div class="flex justify-center items-center">
                                    <div>
                                        <div class="dropdown relative bg-primary rounded-md">
                                            <button
                                                class="dropdown-toggle  px-6 py-2.5 bg-primary text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-purple-700 hover:shadow-lg focus:bg-purple-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-purple-800 active:shadow-lg active:text-white transition duration-150 ease-in-out flex items-center whitespace-nowrap"
                                                type="button" id="dropdownMenuButton2" data-bs-toggle="dropdown"
                                                aria-expanded="false">
                                                {{ Auth::user()->username }}
                                                <svg aria-hidden="true" focusable="false" data-prefix="fas"
                                                    data-icon="caret-down" class="w-2 ml-2" role="img"
                                                    xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512">
                                                    <path fill="currentColor"
                                                        d="M31.3 192h257.3c17.8 0 26.7 21.5 14.1 34.1L174.1 354.8c-7.8 7.8-20.5 7.8-28.3 0L17.2 226.1C4.6 213.5 13.5 192 31.3 192z">
                                                    </path>
                                                </svg>
                                            </button>
                                            <ul class="dropdown-menu min-w-max absolute hidden bg-white text-base z-50 float-left py-2 list-none text-left rounded-lg shadow-lg mt-1 hidden m-0 bg-clip-padding border-none bg-gray-800"
                                                aria-labelledby="dropdownMenuButton2">
                                                <li>
                                                    <a class="dropdown-item text-sm py-2 px-4 pr-5 font-normal block w-full whitespace-nowrap bg-transparent text-gray-300 hover:bg-red-700 hover:text-white focus:text-white focus:bg-gray-700 active:bg-blue-600"
                                                        href="{{ route('dashboard') }}">Dashboard</a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item text-sm py-2 px-4 pr-5 font-normal block w-full whitespace-nowrap bg-transparent text-gray-300 hover:bg-red-700 hover:text-white focus:text-white focus:bg-gray-700 active:bg-blue-600"
                                                        href="#">Profile</a>
                                                </li>
                                                <li>
                                                    <a wire:click="logout"
                                                        class="dropdown-item text-sm py-2 px-4 pr-5 font-normal block w-full whitespace-nowrap bg-transparent text-gray-300 hover:bg-red-700 hover:text-white focus:text-white focus:bg-gray-700 active:bg-blue-600">Log
                                                        log out</a>
                                                </li>

                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            @endguest

                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </header>
</div>
