@foreach($categories as $idx=>$value)
    <div class="bg-white border border-solid border-gray-200 w-[80%] shrink-0">
        <div class="flex flex-col md:flex-row items-start md:items-center justify-between gap-4 py-6 px-2 ml-4">
            <div class="flex flex-col">
                <p class="text-xs md:text-base lg:text-lg font-bold leading-6 opacity-90">{{$value["category_name"]}}</p>
            </div>
            <aside class="flex">
                <a data-category-id="{{$value["id"]}}" class="deleteBtn text-xs md:text-base font-medium text-blue-600 hover:underline">削除</a>
            </aside>
        </div>
    </div>
@endforeach
