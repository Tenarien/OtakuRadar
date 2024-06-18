@props(['manga', 'bookmark' => false, 'full' => false])
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
                <div class="p-1 flex justify-start gap-4 mb-2">
                    <a class="block text-sm sm:text-md text-center  bg-purple-600 transition-colors rounded-md p-1 text-white hover:bg-slate-500">AsuraScans</a>
                    <a class="block text-sm sm:text-md text-center  bg-slate-800 transition-colors rounded-md p-1 text-white hover:bg-slate-500">ReaperScans</a>
                    <a class="block text-sm sm:text-md text-center  bg-red-700 transition-colors rounded-md p-1 text-white hover:bg-slate-500">HiveToon</a>
                </div>
                <div class="card p-1 flex gap-4 mb-2">
                    <a href="" data-url="{{ $manga->chapters->sortBy('id')->first()->links->first()->url }}" data-next-url="{{ $manga->chapters->sortBy('id')->first()->nextLinkUrl() ?? '#' }}" data-chapter-id="{{ $manga->chapters->sortBy('id')->first()->id }}" class="iframe-link block text-sm sm:text-xl text-center w-1/2 bg-slate-600 transition-colors rounded-md p-4 text-white hover:bg-slate-500">
                        First Chapter
                    </a>
                    <a href="" data-url="{{ $manga->chapters->sortByDesc('id')->first()->links->first()->url }}" data-previous-url="{{ $manga->chapters->sortByDesc('id')->first()->previousLinkUrl() ?? '#' }}" data-chapter-id="{{ $manga->chapters->sortByDesc('id')->first()->id }}" class="iframe-link block text-sm sm:text-xl text-center w-1/2 bg-slate-600 transition-colors rounded-md p-4 text-white hover:bg-slate-500">
                        Latest Chapter
                    </a>
                </div>
                <div class="card p-2 scrollable-div h-64 overflow-y-auto">
                        <ul class="list-inside space-y-2">
                            @foreach ($manga->chapters->sortByDesc('id') as $chapter)
                                @php
                                    $userId = auth()->id();

                                    $isViewed = $chapter->chapterViews->contains('user_id', $userId);
                                @endphp
                                <li class="my-1">
                                    <a href="" class="iframe-link {{ $isViewed ? 'text-purple-500' : 'text-gray-500' }} block w-full transition-colors text-black rounded-md p-2 hover:text-white hover:bg-blue-500"
                                       data-url="{{ $chapter->links->first()->url }}"
                                       data-next-url="{{ $chapter->nextLinkUrl() ?? '#' }}"
                                       data-previous-url="{{ $chapter->previousLinkUrl() ?? '#' }}"
                                       data-chapter-id="{{ $chapter->id }}">{{ $chapter->chapter_number }}</a>
                                </li>
                            @endforeach
                        </ul>
                </div>
            </div>
        </div>
    </div>
@elseif ($bookmark)
    <div class="mt-4 p-4 border-b overflow-hidden bg-slate-200 shadow rounded-md shadow-xl transition-transform hover:scale-[1.02] mr-2">
        <a href="{{ route('mangas.show', $manga) }}" class="flex flex-col md:flex-row md:items-start rounded-md space-x-0 md:space-x-4">
            <div class="flex-none w-24 h-36 overflow-hidden rounded-md shadow-lg">
                <img class="rounded-md object-cover w-full h-full transition-transform hover:scale-105" src="{{ $manga->image }}" alt="{{ $manga->title }}">
            </div>
            <div>
                @auth
                    @if ($manga->isFollowedBy(auth()->user()))
                        <form action="{{ route('mangas.unfollow', $manga) }}" method="post">
                            @csrf
                            <button class="rounded-lg p-3 text-slate-200 mt-3 bg-red-500">Unfollow</button>
                        </form>
                    @else
                        <form action="{{ route('mangas.follow', $manga) }}" method="post">
                            @csrf
                            <button class="rounded-lg p-3 mt-3">Get Notified</button>
                        </form>
                    @endif
                @endauth
            </div>
            <div class="flex-1 mt-4 md:mt-0">
                <p class="text-lg font-semibold hover:text-purple-500 transition-colors truncate">{{ $manga->title }}</p>
                <ul class="mt-2 space-y-1">
                    @foreach ($manga->chapters->sortByDesc('id')->take(5) as $chapter)
                        @php
                            $userId = auth()->id();
                            $isViewed = $chapter->chapterViews->contains('user_id', $userId);
                        @endphp
                        <li class="flex items-center">
                            <a href="#"
                               class="iframe-link w-2/3 {{ $isViewed ? 'text-purple-500' : 'text-gray-500' }} text-sm hover:underline truncate"
                               data-url="{{ $chapter->links->first()->url }}"
                               data-next-url="{{ $chapter->nextLinkUrl() ?? '#' }}"
                               data-previous-url="{{ $chapter->previousLinkUrl() ?? '#' }}"
                               data-chapter-id="{{ $chapter->id }}">
                                {{ $chapter->chapter_number }}
                                @if (!$isViewed)
                                    <span id="new" class="text-green-500 ml-1">(New)</span>
                                @endif
                            </a>
                            <span class="hidden sm:inline-block text-xs text-gray-400">{{ $chapter->created_at->diffForHumans() }}</span>
                        </li>
                    @endforeach
                </ul>
            </div>
        </a>
    </div>
@else
    <!-- Index page -->
    <div class="flex mt-4 pb-1 border-b overflow-hidden mr-2">
        <a href="{{ route('mangas.show', $manga) }}" class="flex flex-col md:flex-row md:items-start rounded-md">
            <div class="flex-none w-24 h-36">
                <img class="rounded-md shadow-darker-xl object-cover w-full h-full" src="{{ $manga->image }}" alt="{{ $manga->title }}" loading="lazy">
            </div>
            <div class="ml-4 md:ml-4 md:mt-0 flex-1 overflow-hidden">
                <p class="text text-lg font-bold hover:text-purple-500 overflow-hidden text-ellipsis whitespace-nowrap max-w-full">{{ $manga->title }}</p>
                <ul>
                    @foreach ($manga->chapters->sortByDesc('id')->take(5) as $chapter)
                        @php
                            $userId = auth()->id();

                            $isViewed = $chapter->chapterViews->contains('user_id', $userId);
                        @endphp
                        <li class="mt-1 overflow-hidden flex items-center justify-between">
                            <a href="#" class="iframe-link {{ $isViewed ? 'text-purple-500' : 'text-gray-500' }} text-gray-500 text-ellipsis whitespace-nowrap hover:underline flex-1"
                               data-url="{{ $chapter->links->first()->url }}"
                               data-next-url="{{ $chapter->nextLinkUrl() ?? '#' }}"
                               data-previous-url="{{ $chapter->previousLinkUrl() ?? '#' }}"
                               data-chapter-id="{{ $chapter->id }}">{{ $chapter->chapter_number }}</a>
                            <span class="ml-8 hidden sm:block text-xs text-gray-400 text-ellipsis whitespace-nowrap flex-shrink-0">{{ $chapter->created_at->diffForHumans() }}</span>
                        </li>
                    @endforeach
                </ul>
            </div>
        </a>
    </div>
@endif
<div id="iframeBlur" class="fixed focus:outline-none top-0 left-0 z-[51] hidden w-full h-full bg-black blur opacity-70 "></div>
<div id="iframeContainer" class="hidden fixed top-0 left-0 right-0 h-screen z-[60] flex items-center justify-center flex-col transition-opacity opacity-0">
    <iframe id="iframe" src="" class="w-11/12 h-3/4 border rounded-lg border-gray-300"></iframe>
    <button id="closeIframe" class="absolute border border-gray-100 shadow-md shadow-slate-100 top-4 right-4 text-white bg-red-600 hover:bg-red-500 transition-colors rounded-full w-8 h-8 flex items-center justify-center focus:outline-none">X</button>
    <div class="flex w-full justify-center space-x-4 mt-4">
        <a href="" id="previousLink" class="iframe-link w-1/3 border border-gray-100 shadow-md shadow-slate-100 text-white bg-purple-600
        hover:bg-purple-500 transition-colors rounded-full p-1 flex items-center justify-center focus:outline-none">Previous</a>
        <a href="" id="nextLink" class="iframe-link w-1/3 border border-gray-100 shadow-md shadow-slate-100 text-white bg-purple-600
        hover:bg-purple-500 transition-colors rounded-full p-1 flex items-center justify-center focus:outline-none">Next</a>
    </div>
</div>



