@props(['manga', 'full' => false])

@if ($full)
    @if (session('success'))
        <x-flashMsg msg="{{ session('success') }}" />
    @endif
    <div>
        <div class="flex">
            <div class="card">
                <div class="flex flex-col items-center">
                    <img class="rounded-md flex-shrink-0" src="{{ $manga->image }}" width="200" height="300" alt="{{ $manga->title }}">
                    <a href="{{ $manga->url }}" class="btn text-center mt-2 cursor-pointer bg-purple-800">Go to Asura Scans</a>
                </div>
                @auth
                    @if ($manga->isFollowedBy(auth()->user()))
                        <form action="{{ route('mangas.unfollow', $manga) }}" method="post">
                            @csrf
                            <button class="btn mt-3 bg-red-500">Unfollow</button>
                        </form>
                    @else
                        <form action="{{ route('mangas.follow', $manga) }}" method="post">
                            @csrf
                            <button class="btn mt-3">Follow</button>
                        </form>
                    @endif
                @endauth
            </div>
            <div class="card mx-4 w-full">
                <p class="text-3xl font-bold hover:text-purple-500 text overflow-hidden text-ellipsis whitespace-nowrap w-max">{{ $manga->title }}</p>
                <div class="mt-4">
                    <p class="text-2xl">Description</p>
                </div>
                <div class="card p-2 scrollable-div h-64 overflow-y-auto">
                        <ul class="list-inside space-y-2">
                            @foreach ($manga->chapters as $chapter)
                                <li class="my-1">
                                    <a href="{{ $chapter->links->first()->url }}" class="block w-full transition-colors text-black rounded-md p-2 hover:text-white hover:bg-blue-500">{{ $chapter->chapter_number }}</a>
                                </li>
                            @endforeach
                        </ul>
                </div>
            </div>
        </div>
    </div>
@else
    <div class="flex pb-1 border-b">
        <a href="{{ route('mangas.show', $manga) }}" class="flex flex-col md:flex-row md:items-start hover:bg-gray-100 rounded-md">
            <div class="flex-shrink-0">
                <img class="rounded-md shadow-darker-xl zoom-darken" src="{{ $manga->image }}" width="150" height="200" alt="{{ $manga->title }}">
            </div>
            <div class="md:ml-4 mt-4 md:mt-0">
                <p class="font-bold hover:text-purple-500 text overflow-hidden text-ellipsis whitespace-nowrap">{{ $manga->title }}</p>
                <ul class="mt-2">
                    @foreach ($manga->chapters->take(5) as $chapter)
                        <li class="my-1">
                            <a href="{{ $chapter->links->first()->url }}" class="text-gray-500 hover:underline">{{ $chapter->chapter_number }}</a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </a>
    </div>
@endif


