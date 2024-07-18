<div class="flex flex-col items-center w-full py-12">
    <div class="flex justify-start w-[80%]">
        <h2 class="text-base pb-4 md:text-xl font-semibold text-gray-800">非表示商品一覧</h2>
    </div>

    @foreach($hiddenPosts as $idx=>$value)
        <div class="bg-white border border-solid border-gray-200 w-[80%] shrink-0">
            <div class="qa__head js-ac flex flex-col md:flex-row items-start md:items-center justify-between gap-4 py-6 px-2 ml-4">
                <div>
                    <p class="text-xs md:text-base lg:text-lg font-bold leading-6 opacity-90">{{$value["name"]}}</p>
                </div>
                <aside class="flex gap-4 md:gap-6 mr-2">
                    <label class="inline-flex items-center cursor-pointer">
                        <span class="ms-3 text-xs md:text-sm font-medium text-gray-900 dark:text-gray-300 mr-2">非表示</span>
                        <input type="checkbox" value="{{$value['id']}}" class="toggleBtn sr-only peer">
                        <div class="relative w-7 h-4 sm:w-11 sm:h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 rounded-full peer peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-3 after:w-3 sm:after:h-5 sm:after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600"></div>
                        <span class="ms-3 text-xs md:text-sm font-medium text-gray-900 dark:text-gray-300">表示</span>
                    </label>
                    <div class="flex justify-end">
                        <a data-product-id="{{$value["id"]}}" class="deleteBtn text-xs md:text-base font-medium text-blue-600 hover:underline">削除</a>
                    </div>
                </aside>
            </div>
        </div>
    @endforeach
</div>
