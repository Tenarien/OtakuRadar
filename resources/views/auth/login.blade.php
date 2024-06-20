<x-layout>
    <h1 class="title dark:text-slate-100">Log in</h1>

    <div class="mx-auto shadow-xl max-w-screen-sm card dark:bg-gray-600 pb-2">
    <form action="{{ route('login') }}" method="post">
        @csrf

        <div class="mb-4">
            <label for="email" class="dark:text-slate-100">Email</label>
            <input type="text" name="email" value="{{ old('email') }}" class="input dark:text-slate-100 dark:bg-gray-500 @error('email') !ring-red-500 @enderror">
            @error('email')
            <p class="error">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4 ">
            <label for="password" class="dark:text-slate-100">Password</label>
            <input type="password" name="password" class="input dark:text-slate-100 dark:bg-gray-500 @error('password') !ring-red-500 @enderror">
        </div>
        @error('password')
        <p class="error">{{ $message }}</p>
        @enderror
        <div class="flex mb-4 justify-between items-center">
            <div class="gap-4">
                <input type="checkbox" name="remember" id="remember">
                <label for="remember" class="dark:text-slate-100">Remember me</label>
            </div>
            <a href="" class="hover:text-slate-500 dark:hover:text-slate-300">Forgot Password</a>
        </div>

        @error('failed')
        <p class="error">{{ $message }}</p>
        @enderror

        <button type="submit" class="btn hover:bg-slate-700">Login</button>
    </form>
        <div class="font-bold my-2">
            <a class="hover:text-slate-500 dark:hover:text-slate-300" href="{{ route('register') }}">Don't have an account?</a>
        </div>
    </div>
</x-layout>
