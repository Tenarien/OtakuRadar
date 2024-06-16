<x-layout>

<div class="card">
    <div class="">
        @foreach ($mangas as $manga)
            <x-mangaCard :manga="$manga"/>
        @endforeach
    </div>
</div>

</x-layout>
