<x-layout>

<div class="">
    <div class="card grid sm:grid-cols-1 md:grid-cols-2 md:gap-6 xl:gap-12 dark:bg-gray-600">
        @foreach ($mangas as $manga)
            <x-mangaCard :manga="$manga" bookmark/>
        @endforeach
    </div>
</div>

</x-layout>
