<x-layout>

    <h1 class="title dark:text-slate-200">Latest Mangas</h1>
    <div class="card flex justify-center dark:bg-gray-600">
        <div class="grid sm:grid-cols-1 md:grid-cols-2 md:gap-6 xl:gap-12 dark:bg-gray-600">
            @foreach ($mangas as $manga)
                <x-mangaCard :manga="$manga"/>
            @endforeach
        </div>
    </div>
    <div>
        {{ $mangas->links() }}
    </div>


</x-layout>
