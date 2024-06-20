<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script>
        if (localStorage.getItem('darkMode') === 'enabled') {
            document.documentElement.classList.add('dark');
        }
    </script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <title>{{ env('APP_NAME') }}</title>
    @vite(['resources/js/app.js', 'resources/css/app.css'])

</head>
<body class="bg-slate-200 text-slate-900 dark:bg-gray-900 dark:text-gray-200">
<header id="header" class="flex items-center justify-between px-4 py-4 bg-slate-100 border-b min-h-[70px] fixed top-0 inset-x-0 z-50 dark:bg-gray-800 dark:border-gray-700">
    <a id="logo" href="{{ route('mangas.index') }}" class="w-36 transition">
        <img src="{{ asset('svg/logo.svg') }}" alt="logo" class="dark:invert">
    </a>
    <input type="hidden" id="userId" value="{{ Auth::user()->id ?? '' }}">
    <!-- Mobile Navigation -->
        <nav id="collapseMenu" class="hidden card fixed inset-y-0 left-0 bg-black z-50 w-1/2 p-6 lg:hidden overflow-auto bg-opacity-70 dark:bg-opacity-90">
            <button id="toggleClose" class="hidden"></button>
            <a href="{{ route('mangas.index') }}" class="w-36">
                <img src="{{ asset('svg/logo.svg') }}" alt="logo" class="mb-4 dark:invert">
            </a>
            <ul class="space-y-6">
                <li class="border-b">
                    <a href="{{ route('mangas.index') }}" class="text-white hover:text-blue-500 font-semibold">Home</a>
                </li>
                <li class="border-b">
                    <a href="{{ route('users.bookmark') }}" class="text-white hover:text-blue-500 font-semibold">Bookmarks</a>
                </li>
                <li class="border-b">
                    <a href="javascript:void(0)" class="text-white hover:text-blue-500 font-semibold">Manga</a>
                </li>
                <li class="border-b">
                    <a href="javascript:void(0)" class="text-white hover:text-blue-500 font-semibold">Anime</a>
                </li>
                <li class="border-b">
                    <a href="#" class="text-white hover:text-blue-500 font-semibold">Surprise me</a>
                </li>
                @guest
                    <li class="border-b">
                        <a href="{{ route('login') }}" class="font-bold text-white hover:text-blue-500">Log in</a>
                    </li>
                @endguest
                @auth
                    <li class="border-b">
                        <form action="{{ route('logout') }}" method="post">
                            @csrf
                            <button class="text-white hover:text-blue-500 font-semibold">Logout</button>
                        </form>
                    </li>
                @endauth
                <div id="dark-mode-icons-mobile">

                </div>
            </ul>
        </nav>

    <!-- Desktop Navigation -->
    <nav class="hidden lg:flex lg:items-center lg:gap-5 lg:ml-auto">
        <a href="{{ route('mangas.index') }}" class="text-gray-500 hover:text-blue-500 dark:text-gray-100 dark:hover:text-blue-400">Home</a>
        <a href="{{ route('users.bookmark') }}" class="text-gray-500 hover:text-blue-500 dark:text-gray-100 dark:hover:text-blue-400">Bookmarks</a>
        <a href="javascript:void(0)" class="text-gray-500 hover:text-blue-500 dark:text-gray-100 dark:hover:text-blue-400">Manga</a>
        <a href="javascript:void(0)" class="text-gray-500 hover:text-blue-500 dark:text-gray-100 dark:hover:text-blue-400">Anime</a>
        <a href="{{ route('mangas.random') }}" class="text-gray-500 hover:text-blue-500 dark:text-gray-100 dark:hover:text-blue-400">Surprise me</a>
    </nav>

    <!-- Dark mode icon -->
    <div id="dark-mode-icons-desktop">
        <div id="dark-mode-icons" class="hidden justify-center items-center">
            <svg id="main-sun-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="w-6 h-6 fill-current">
                <circle cx="12" cy="12" r="5" fill="currentColor"/>
                <g stroke="currentColor" stroke-width="2">
                    <line x1="12" y1="1" x2="12" y2="4"/>
                    <line x1="12" y1="20" x2="12" y2="23"/>
                    <line x1="4.22" y1="4.22" x2="6.34" y2="6.34"/>
                    <line x1="17.66" y1="17.66" x2="19.78" y2="19.78"/>
                    <line x1="1" y1="12" x2="4" y2="12"/>
                    <line x1="20" y1="12" x2="23" y2="12"/>
                    <line x1="4.22" y1="19.78" x2="6.34" y2="17.66"/>
                    <line x1="17.66" y1="6.34" x2="19.78" y2="4.22"/>
                </g>
            </svg>
            <svg id="main-moon-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="w-6 h-6 fill-current">
                <path d="M21.752 15.002a9.05 9.05 0 0 1-10.75-10.75A7.002 7.002 0 1 0 21.752 15.002z" fill="currentColor"/>
            </svg>
        </div>
    </div>



    <!-- Mobile Search Button -->
    <div class="flex gap-4">
        <button id="toggleOpen" class="lg:hidden">
            <svg class="w-7 h-7 fill-black dark:fill-slate-300" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd"
                      d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z"
                      clip-rule="evenodd"></path>
            </svg>
        </button>
        <button id="mobileSearchButton" class="lg:hidden flex items-center p-2 bg-gray-100 rounded dark:bg-gray-700">
            <svg class="w-5 h-5 fill-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 192.904 192.904">
                <path d="m190.707 180.101-47.078-47.077c11.702-14.072 18.752-32.142 18.752-51.831C162.381 36.423 125.959 0 81.191 0 36.422 0 0 36.423 0 81.193c0 44.767 36.422 81.187 81.191 81.187 19.688 0 37.759-7.049 51.831-18.751l47.079 47.078a7.474 7.474 0 0 0 5.303 2.197 7.498 7.498 0 0 0 5.303-12.803zM15 81.193C15 44.694 44.693 15 81.191 15c36.497 0 66.189 29.694 66.189 66.193 0 36.496-29.692 66.187-66.189 66.187C44.693 147.38 15 117.689 15 81.193z"></path>
            </svg>
        </button>
        <div>
            <x-search />
        </div>
    </div>


    <!-- Search Bar for larger screens -->
    <div id="searchBarContainer" class="hidden lg:flex gap-6 w-full lg:w-auto lg:ml-4 items-center">
        <div class="flex px-4 py-2 bg-gray-100 rounded focus-within:outline-blue-500 dark:bg-gray-600">
            <input type="text" class="searchInput w-full text-sm bg-transparent outline-none  dark:text-slate-100" placeholder="Search for something...">
            <svg class="w-5 h-5 fill-gray-400 cursor-pointer" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 192.904 192.904">
                <path d="m190.707 180.101-47.078-47.077c11.702-14.072 18.752-32.142 18.752-51.831C162.381 36.423 125.959 0 81.191 0 36.422 0 0 36.423 0 81.193c0 44.767 36.422 81.187 81.191 81.187 19.688 0 37.759-7.049 51.831-18.751l47.079 47.078a7.474 7.474 0 0 0 5.303 2.197 7.498 7.498 0 0 0 5.303-12.803zM15 81.193C15 44.694 44.693 15 81.191 15c36.497 0 66.189 29.694 66.189 66.193 0 36.496-29.692 66.187-66.189 66.187C44.693 147.38 15 117.689 15 81.193z"></path>
            </svg>
            <div class="searchResults absolute rounded-md shadow-darker-xl top-32 w-1/4 ml-auto mr-8 left-0 right-0 bg-slate-50 dark:bg-gray-600 border mt-1 opacity-0 max-h-0 overflow-hidden transition-all duration-500 ease-in-out"></div>
        </div>
        @guest
            <a href="{{ route('login') }}" class="text-white shadow-darker-xl rounded-full py-2 px-6 bg-slate-600 hover:bg-slate-500 shadow-md hover:shadow-lg transition-transform">Log in</a>
        @endguest
        @auth
            <form action="{{ route('logout') }}" method="post" class="inline">
                @csrf
                <button class="text-white shadow-darker-xl rounded-full py-2 px-6 bg-slate-600 hover:bg-slate-500 shadow-md hover:shadow-lg transition-transform">Logout</button>
            </form>
        @endauth
    </div>

    <!-- Hidden Mobile Search Bar -->
    <div id="mobileSearchBar" class=" hidden shadow-darker-xl rounded-full fixed inset-x-0 mx-4 mt-48 bg-white z-50">
        <div class="flex shadow-lg px-4 gap-4 py-2 bg-gray-100 rounded-full dark:bg-gray-500 dark:text-slate-100 focus-within:outline-blue-500 relative">
            <input type="text" placeholder="Search something..." class="searchInput dark:text-slate-100 w-full text-sm bg-transparent outline-none">
            <svg class="w-5 h-5 fill-gray-400 cursor-pointer" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 192.904 192.904">
                <path d="m190.707 180.101-47.078-47.077c11.702-14.072 18.752-32.142 18.752-51.831C162.381 36.423 125.959 0 81.191 0 36.422 0 0 36.423 0 81.193c0 44.767 36.422 81.187 81.191 81.187 19.688 0 37.759-7.049 51.831-18.751l47.079 47.078a7.474 7.474 0 0 0 5.303 2.197 7.498 7.498 0 0 0 5.303-12.803zM15 81.193C15 44.694 44.693 15 81.191 15c36.497 0 66.189 29.694 66.189 66.193 0 36.496-29.692 66.187-66.189 66.187C44.693 147.38 15 117.689 15 81.193z"></path>
            </svg>
            <div class="searchResults absolute dark:bg-gray-600 rounded-xl shadow-darker-xl top-9 left-0 right-0 bg-slate-50 border mt-1 opacity-0 max-h-0 overflow-hidden transition-all duration-500 ease-in-out"></div>
        </div>
    </div>
</header>
<main id="main" class="px-4 py-8 sm:px-6 md:px-10 lg:px-20 xl:px-20 transition">
    {{ $slot }}
</main>
<script>
    // Set form: x-data="formSubmit" @submit.prevent="submit" and button: x-ref="btn"
    document.addEventListener('alpine:init', () => {
        Alpine.data('formSubmit', () => ({
            submit() {
                this.$refs.btn.disabled = true;
                this.$refs.btn.classList.remove('bg-indigo-600', 'hover:bg-indigo-700');
                this.$refs.btn.classList.add('bg-indigo-400');
                this.$refs.btn.innerHTML =
                    `<span class="absolute left-2 top-1/2 -translate-y-1/2 transform">
                        <i class="fa-solid fa-spinner animate-spin"></i>
                        </span>Please wait...`;

                this.$el.submit()
            }
        }))
    })
</script>
</body>
</html>
