<x-layout>
    <h1 class="title">Register a new account</h1>

    <div class="mx-auto mx-w-screen-sm card">
        <form action="{{ route('register') }}" method="post" x-data="formSubmit" @submit.prevent="submit">
            @csrf
            <div class="mb-4">
                <label for="name">Username</label>
                <input type="text" name="name" value="{{ old('name') }}" class="input @error('name') !ring-red-500 @enderror">
                @error('name')
                <p class="error">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="email">Email</label>
                <input type="text" name="email" value="{{ old('email') }}" class="input @error('email') !ring-red-500 @enderror">
                @error('email')
                <p class="error">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="password">Password</label>
                <input type="password" name="password" class="input @error('password') !ring-red-500 @enderror">
                @error('password')
                <p class="error">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-4">
                <label for="password_confirmation">Confirm Password</label>
                <input type="password" name="password_confirmation" class="input @error('password') !ring-red-500 @enderror">
                @error('password_confirmation')
                <p class="error">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <input type="checkbox" name="subscribe" id="subscribe">
                <label for="subscribe">Subscribe to our newsletter</label>
            </div>

            <button x-ref="btn" type="submit" class="btn">Register</button>
        </form>
    </div>
</x-layout>
