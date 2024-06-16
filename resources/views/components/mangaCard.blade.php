@props(['manga', 'full' => false])

@if ($full)
    @if (session('success'))
        <x-flashMsg msg="{{ session('success') }}" />
    @endif
    <!-- Manga page -->
    <div>
        <div class="sm:flex mt-4 gap-4 pb-1 border-b overflow-hidden mr-2">
            <div class="card">
                <div class="flex flex-col items-center">
                    <div class="flex-none w-32 h-44">
                        <img class="rounded-md flex-shrink-0" src="{{ $manga->image }}" width="200" height="300" alt="{{ $manga->title }}">
                    </div>
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
                            <button class="btn mt-3">Get Notified</button>
                        </form>
                    @endif
                @endauth
            </div>
            <div class="card mt-4 sm:mt-0 w-full overflow-hidden">
                <p class="text-sm sm:text-xl md:text-3xl font-bold overflow-hidden text-ellipsis whitespace-nowrap max-w-full">{{ $manga->title }}</p>
                <div class="mt-4">
                    <p class="text-sm md:text-2xl text-center">Chapters</p>
                </div>
                <div class="card p-1 flex gap-4 mb-2">
                    <a href="{{ $manga->chapters->sortBy('id')->first()->links->first()->url }}" class="block text-sm sm:text-xl text-center w-1/2 bg-slate-600 transition-colors rounded-md p-4 text-white hover:bg-slate-500">
                        First Chapter
                    </a>
                    <a href="{{ $manga->chapters->sortByDesc('id')->first()->links->first()->url }}" class="block text-sm sm:text-xl text-center w-1/2 bg-slate-600 transition-colors rounded-md p-4 text-white hover:bg-slate-500">
                        Latest Chapter
                    </a>
                </div>
                <div class="card p-2 scrollable-div h-64 overflow-y-auto">
                        <ul class="list-inside space-y-2">
                            @foreach ($manga->chapters->sortByDesc('id') as $chapter)
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
    <!-- Index page -->
    <div class="flex mt-4 pb-1 border-b overflow-hidden mr-2">
        <a href="{{ route('mangas.show', $manga) }}" class="flex flex-col md:flex-row md:items-start rounded-md">
            <div class="flex-none w-24 h-36">
                <img class="rounded-md shadow-darker-xl object-cover w-full h-full" src="{{ $manga->image }}" alt="{{ $manga->title }}">
            </div>
            <div class="ml-4 md:ml-4 md:mt-0 flex-1 overflow-hidden">
                <p class="text text-lg font-bold hover:text-purple-500 overflow-hidden text-ellipsis whitespace-nowrap max-w-full">{{ $manga->title }}</p>
                <ul>
                    @foreach ($manga->chapters->sortByDesc('id')->take(5) as $chapter)
                        <li class="mt-1 overflow-hidden flex items-center justify-between">
                            <a href="{{ $chapter->links->first()->url }}" class="text-gray-500 text-ellipsis whitespace-nowrap hover:underline flex-1">{{ $chapter->chapter_number }}</a>
                            <span class="ml-8 hidden sm:block text-xs text-gray-400 text-ellipsis whitespace-nowrap flex-shrink-0">{{ $chapter->created_at->diffForHumans() }}</span>
                        </li>
                    @endforeach
                </ul>
            </div>
        </a>
    </div>
@endif


