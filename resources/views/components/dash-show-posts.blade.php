@foreach($posts as $idx=>$value)
    <div class="qa__item bg-white border border-solid border-gray-200 w-[80%] shrink-0">
        {{--既存商品名--}}
        <div class="qa__head js-ac flex flex-col md:flex-row items-start md:items-center justify-between gap-4 py-6 px-2 ml-4">
            <div class="product-title flex flex-col">
                <p class="text-xs md:text-base lg:text-lg font-bold leading-6 opacity-90">{{$value["name"]}}</p>
            </div>
            <aside class="flex gap-4 md:gap-6">
                <label class="inline-flex items-center cursor-pointer">
                    <span class="text-xs ms-3 md:text-sm font-medium text-gray-900 mr-2">非表示</span>
                    <input type="checkbox" value="{{$value['id']}}" class="toggleBtn sr-only peer" checked>
                    <div class="relative w-7 h-4 sm:w-11 sm:h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 rounded-full peer peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-3 after:w-3 sm:after:h-5 sm:after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600"></div>
                    <span class="text-xs ms-3 md:text-sm font-medium text-gray-900 dark:text-gray-300">表示</span>
                </label>
                <div class="flex">
                    <a data-product-id="{{$value["id"]}}" class="editBtn text-xs md:text-base font-medium text-blue-600 hover:underline mr-4">編集</a>
                    <a data-product-id="{{$value["id"]}}" class="deleteBtn text-xs md:text-base font-medium text-blue-600 hover:underline">削除</a>
                </div>
            </aside>
        </div>

        {{--既存商品詳細（最初非表示）--}}
        <div class="qa__body">
            <form class="productForm h-[400px] overflow-y-scroll flex flex-col" method="post" enctype="multipart/form-data" data-product-id="{{$value["id"]}}">
                @csrf
                <div class="flex flex-col md:flex-row md:items-center gap-4 border-y border-solid border-gray-200 py-4">
                    <p class="md:w-[250px] text-xs md:text-base">1.商品画像の設定</p>
                    <div class="flex flex-col md:flex-row gap-6 md:gap-16">
                        <aside class="flex flex-col md:items-center gap-2">
                            <p class="text-xs md:text-base">【現在の画像】</p>
                            <img src="{{asset($value->img)}}" width="100px">
                        </aside>
                        <aside class="flex flex-col gap-2">
                            <p class="text-xs md:text-base">【新しい画像】</p>
                            <input type="file" accept="image/jpeg,image/png" name="img" class="w-full text-xs h-[35px] md:h-full">
                        </aside>
                    </div>
                </div>
                <div class="flex flex-col md:flex-row md:items-center gap-4 border-y border-solid border-gray-200 py-4">
                    <p class="md:w-[250px] text-xs md:text-base">2.商品名</p>
                    <div class="flex-1">
                        <input name="name" value="{{$value['name']}}" class="w-full text-xs md:text-base h-[35px] md:h-full border border-solid border-gray-400 rounded-md">
                    </div>
                </div>
                <div class="flex flex-col md:flex-row md:items-center gap-4 border-y border-solid border-gray-200 py-4">
                    <p class="md:w-[250px] text-xs md:text-base">4.プライオリティ</p>
                    <div class="flex-1">
                        <select name="priority" class="w-full h-[35px] md:h-full text-xs md:text-base border border-solid border-gray-400 rounded-md">
                            <option value="0" @if($value["category"]==0) selected @endif>優先度：低</option>
                            <option value="3" @if($value["category"]==3) selected @endif>優先度：中</option>
                            <option value="5" @if($value["category"]==5) selected @endif>優先度：高</option>
                        </select>
                    </div>
                </div>
                <div class="flex justify-center mt-4">
                    <button type="button" data-product-id="{{$value["id"]}}" class="submit-btn update-btn btn-border shadow-xl text-sm px-10 py-3 text-center">
                        更新
                    </button>
                </div>
            </form>
        </div>
    </div>
@endforeach
