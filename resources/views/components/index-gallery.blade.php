<div class="flex flex-wrap justify-center items-center gap-6 gap-y-10 md:gap-y-20 my-8">
    @foreach($posts as $idx => $value)
        <a href="/detail/{{ $value["id"] }}" class="story rounded-lg flex flex-col gap-2 cursor-pointer transform transition duration-300 hover:scale-105 shadow-md hover:shadow-lg">
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
