<x-layout>

    <h1 class="title">Latest Mangas</h1>
    <div class="card flex justify-center">
        <div class="grid sm:grid-cols-1 md:grid-cols-2 md:gap-6 xl:gap-12">
            @foreach ($mangas as $manga)
                <x-mangaCard :manga="$manga"/>
            @endforeach
        </div>
    </div>
    <div>
        {{ $mangas->links() }}
    </div>


</x-layout>
