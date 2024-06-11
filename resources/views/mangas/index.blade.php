<x-layout>

    <h1 class="title">Latest Mangas</h1>
    <div class="flex justify-between">
        <div class="grid grid-cols-2 gap-4">
            @foreach ($mangas as $manga)
                <x-mangaCard :manga="$manga" />
            @endforeach
        </div>
        <div class="card">

        </div>
    </div>
    <div>
        {{ $mangas->links() }}
    </div>


</x-layout>
