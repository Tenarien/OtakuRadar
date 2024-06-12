<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <title>{{ env('APP_NAME') }}</title>
    @vite(['resources/js/app.js', 'resources/css/app.css'])
</head>
<body class="bg-slate-100 text-slate-900">
<header class='flex border-b py-4 px-4 sm:px-10 bg-white font-[sans-serif] min-h-[70px] tracking-wide relative z-50'>
    <div class='flex flex-wrap items-center gap-5 w-full'>
        <a href="{{ route('mangas.index') }}"><img src="{{ asset('svg/logo.svg') }}" alt="logo" class='w-36' />
        </a>

        <div id="collapseMenu"
             class='max-lg:hidden lg:!block max-lg:w-full max-lg:fixed max-lg:before:fixed max-lg:before:bg-black max-lg:before:opacity-50 max-lg:before:inset-0 max-lg:before:z-50'>
            <button id="toggleClose" class='lg:hidden fixed top-2 right-4 z-[100] rounded-full bg-white p-3'>
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 fill-black" viewBox="0 0 320.591 320.591">
                    <path
                        d="M30.391 318.583a30.37 30.37 0 0 1-21.56-7.288c-11.774-11.844-11.774-30.973 0-42.817L266.643 10.665c12.246-11.459 31.462-10.822 42.921 1.424 10.362 11.074 10.966 28.095 1.414 39.875L51.647 311.295a30.366 30.366 0 0 1-21.256 7.288z"
                        data-original="#000000"></path>
                    <path
                        d="M287.9 318.583a30.37 30.37 0 0 1-21.257-8.806L8.83 51.963C-2.078 39.225-.595 20.055 12.143 9.146c11.369-9.736 28.136-9.736 39.504 0l259.331 257.813c12.243 11.462 12.876 30.679 1.414 42.922-.456.487-.927.958-1.414 1.414a30.368 30.368 0 0 1-23.078 7.288z"
                        data-original="#000000"></path>
                </svg>
            </button>
            <ul
                class='lg:flex lg:ml-14 lg:gap-x-5 max-lg:space-y-3 max-lg:fixed max-lg:bg-white max-lg:w-1/2 max-lg:min-w-[300px] max-lg:top-0 max-lg:left-0 max-lg:p-6 max-lg:h-full max-lg:shadow-md max-lg:overflow-auto z-50'>
                <li class='mb-6 hidden max-lg:block'>
                    <a href="{{ route('mangas.index') }}"><img src="{{ asset('svg/logo.svg') }}" alt="logo" class='w-36' />
                    </a>
                </li>
                <li class='max-lg:border-b max-lg:py-3 px-3'>
                    <a href='{{ route('mangas.index') }}'
                       class='lg:hover:text-[#007bff] text-[#007bff] block font-semibold text-[15px]'>Home</a>
                </li>
                <li class='max-lg:border-b max-lg:py-3 px-3'><a href='javascript:void(0)'
                                                                class='lg:hover:text-[#007bff] text-gray-500 block font-semibold text-[15px]'>Bookmarks</a>
                </li>
                <li class='max-lg:border-b max-lg:py-3 px-3'><a href='javascript:void(0)'
                                                                class='lg:hover:text-[#007bff] text-gray-500 block font-semibold text-[15px]'>Manga</a>
                </li>
                <li class='max-lg:border-b max-lg:py-3 px-3'><a href='javascript:void(0)'
                                                                class='lg:hover:text-[#007bff] text-gray-500 block font-semibold text-[15px]'>Anime</a>
                </li>
                <li class='max-lg:border-b max-lg:py-3 px-3'><a href='#'
                                                                class='lg:hover:text-[#007bff] text-gray-500 block font-semibold text-[15px]'>Surprise me</a>
                </li>
            </ul>
        </div>

        <button id="toggleOpen" class='lg:hidden ml-auto'>
            <svg class="w-7 h-7" fill="#000" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd"
                      d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z"
                      clip-rule="evenodd"></path>
            </svg>
        </button>

        <div class='flex lg:ml-auto max-lg:w-full'>
            <div
                class='flex xl:w-80 max-xl:w-full bg-gray-100 px-6 py-3 rounded outline outline-transparent focus-within:outline-[#007bff] focus-within:bg-transparent'>
                <input type='text' placeholder='Search something...'
                       class='w-full text-sm bg-transparent rounded outline-none pr-2' />
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 192.904 192.904" width="16px"
                     class="cursor-pointer fill-gray-400">
                    <path
                        d="m190.707 180.101-47.078-47.077c11.702-14.072 18.752-32.142 18.752-51.831C162.381 36.423 125.959 0 81.191 0 36.422 0 0 36.423 0 81.193c0 44.767 36.422 81.187 81.191 81.187 19.688 0 37.759-7.049 51.831-18.751l47.079 47.078a7.474 7.474 0 0 0 5.303 2.197 7.498 7.498 0 0 0 5.303-12.803zM15 81.193C15 44.694 44.693 15 81.191 15c36.497 0 66.189 29.694 66.189 66.193 0 36.496-29.692 66.187-66.189 66.187C44.693 147.38 15 117.689 15 81.193z">
                    </path>
                </svg>
            </div>
        </div>
        @guest
            <div class='max-lg:border-b max-lg:py-3 px-3'>
                <a href="{{ route('login') }}" class='cursor-pointer lg:hover:text-[#007bff] text-gray-500 block font-semibold text-[15px]'>Log in</a>
            </div>
        @endguest
        @auth
            <div class='max-lg:border-b max-lg:py-3 px-3'>
                <form action="{{ route('logout') }}" method="post">
                    @csrf
                    <button class='cursor-pointer lg:hover:text-[#007bff] text-gray-500 block font-semibold text-[15px]'>Logout</button>
                </form>
            </div>
        @endauth
    </div>
</header>
    <main class="py-8 mx-52">
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
