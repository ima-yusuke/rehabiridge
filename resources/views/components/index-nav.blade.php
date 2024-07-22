<div class="flex flex-col md:flex-row items-center justify-center gap-4 mt-10">
    {{--左側--}}
    <div class="flex flex-col md:w-[45%] md:h-[150px]">
        <h1 class="text-xl md:text-2xl font-bold">SELECTED WORKS</h1>
    </div>

    {{--右側--}}
    <div class="flex md:w-[45%] md:h-[150px]">
        <div class="flex flex-col md:flex-row items-center md:justify-start md:items-start gap-4 md:gap-12">
            <h3 class="text-sm">Category</h3>
            <div class="text-idx-gray text-xs w-full grid grid-cols-2 gap-x-8 gap-y-1">
                @foreach($categories as $category)
                    <p class="hover:text-white hover:cursor-pointer">{{ $category["category_name"] }}</p>
                @endforeach
            </div>
        </div>
    </div>
</div>
