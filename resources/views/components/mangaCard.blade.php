@props(['manga'])
<div class="flex mt-4">
    <div>
        <img src="https://picsum.photos/200/300" width="200" height="300">
    </div>
    <div>
        <p class="font-bold overflow-hidden text-ellipsis whitespace-nowrap w-max">{{ $manga->title }}</p>
        <div>

        </div>
    </div>

</div>
