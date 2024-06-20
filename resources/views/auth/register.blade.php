<x-layout>
    <h1 class="title dark:text-slate-100">Register a new account</h1>

    <div class="mx-auto shadow-xl max-w-screen-sm card dark:bg-gray-600 pb-2">
        <form action="{{ route('register') }}" method="post" x-data="formSubmit" @submit.prevent="submit">
            @csrf
            <div class="mb-4">
                <label for="name" class="dark:text-slate-100">Username</label>
                <input type="text" name="name" value="{{ old('name') }}" class="input dark:text-slate-100 dark:bg-gray-500 @error('name') !ring-red-500 @enderror">
                @error('name')
                <p class="error">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="email" class="dark:text-slate-100">Email</label>
                <input type="text" name="email" value="{{ old('email') }}" class="input dark:text-slate-100 dark:bg-gray-500 @error('email') !ring-red-500 @enderror">
                @error('email')
                <p class="error">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="password" class="dark:text-slate-100">Password</label>
                <input type="password" name="password" class="input dark:text-slate-100 dark:bg-gray-500 @error('password') !ring-red-500 @enderror">
                @error('password')
                <p class="error">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-4">
                <label for="password_confirmation" class="dark:text-slate-100">Confirm Password</label>
                <input type="password" name="password_confirmation" class="input dark:text-slate-100 dark:bg-gray-500 @error('password') !ring-red-500 @enderror">
                @error('password_confirmation')
                <p class="error">{{ $message }}</p>
                @enderror
            </div>

            <button x-ref="btn" type="submit" class="btn">Register</button>
        </form>
        <div class="mt-4 mb-2">
            <a class="dark:text-slate-100 dark:hover:text-slate-300 font-medium" href="{{ route('login') }}">Already have an account?</a>
        </div>
    </div>
</x-layout>
