<div class="bg-white border border-solid border-gray-200 w-[80%] shrink-0">
    {{--アコーディオンタイトル部分--}}
    <div class="flex items-center justify-between gap-4 py-6 px-2 ml-2 md:ml-4">
        <div>
            <p class="text-xs md:text-base lg:text-lg font-bold leading-6 opacity-90">
                <span class="bg-red-500 text-white text-xs md:text-sm font-medium me-2 px-2.5 py-0.5 rounded-8">New</span>新規カテゴリー
            </p>
        </div>
        <aside>
            <div>
                <a class="editBtn addProductBtn text-xs md:text-base font-medium text-blue-600 hover:underline"><i class="fa-solid fa-plus"></i></a>
            </div>
        </aside>
    </div>

    {{--新規投稿詳細登録フォーム（最初非表示）--}}
    <div class="qa__body flex flex-col">
        <form class="h-[200px] overflow-y-scroll flex flex-col" id="post_form" method="post" enctype="multipart/form-data">
            @csrf
            <div class="flex flex-col md:flex-row md:items-center gap-4 border-y border-solid border-gray-200 py-4">
                <x-required-title title="1.カテゴリー" />
                <div class="flex-1">
                    <input id="new_category" name="category" class="w-full h-[35px] md:h-full border border-solid border-gray-400 rounded-md" required />
                </div>
            </div>
            <div class="flex justify-center mt-4">
                <button type="button" data-route="{{ route('AddCategory') }}" id="add_category_btn" class="submit-btn btn-border shadow-xl text-sm px-10 py-3 text-center">
                    登録
                </button>
            </div>

        </form>
    </div>
</div>
