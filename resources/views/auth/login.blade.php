<x-layout>
    <h1 class="title">Log in</h1>

    <div class="mx-auto max-w-screen-sm card pb-2">
    <form action="{{ route('login') }}" method="post">
        @csrf

        <div class="mb-4">
            <label for="email">Email</label>
            <input type="text" name="email" value="{{ old('email') }}" class="input @error('email') !ring-red-500 @enderror">
            @error('email')
            <p class="error">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4 ">
            <label for="password">Password</label>
            <input type="password" name="password" class="input @error('password') !ring-red-500 @enderror">
        </div>
        @error('password')
        <p class="error">{{ $message }}</p>
        @enderror
        <div class="flex mb-4 justify-between items-center">
            <div class="gap-4">
                <input type="checkbox" name="remember" id="remember">
                <label for="remember">Remember me</label>
            </div>
            <a href="" class="hover:text-slate-500">Forgot Password</a>
        </div>

        @error('failed')
        <p class="error">{{ $message }}</p>
        @enderror

        <button type="submit" class="btn">Login</button>
    </form>
        <div class="font-bold my-2">
            <a class="hover:text-slate-500" href="{{ route('register') }}">Don't have an account</a>
        </div>
    </div>
</x-layout>
