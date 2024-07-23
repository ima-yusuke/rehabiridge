<div class="flex flex-wrap justify-center items-center gap-6 gap-y-10 md:gap-y-20 my-8">
    @foreach($posts as $idx => $value)
        <a href="/detail/{{ $value['id'] }}" class="story test rounded-lg flex flex-col gap-2 cursor-pointer shadow-md">
            <div>
                <img src="{{ asset($value['img']) }}" class="rounded-t-lg w-[310px] h-[200px] object-cover">
            </div>
            <aside class="pl-2.5 py-2.5">
                <p class="text-sm">{{ $value['name'] }}</p>
                <p class="text-idx-gray text-xs">{{ $value->categories['category_name'] }}</p>
            </aside>
        </a>
    @endforeach
</div>

