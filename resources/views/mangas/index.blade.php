<x-layout>

    <h1 class="title">Latest Mangas</h1>
    <div class="flex justify-between">
        <div class="grid gap-4 card">
            @foreach ($mangas as $manga)
                <x-mangaCard :manga="$manga" />
            @endforeach
        </div>
    </div>
    <div>
        {{ $mangas->links() }}
    </div>


</x-layout>
