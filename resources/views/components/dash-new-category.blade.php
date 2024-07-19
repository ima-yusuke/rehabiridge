<div class="bg-white border border-solid border-gray-200 w-[80%] shrink-0 flex items-center justify-between gap-4 py-4 px-2">
    <div class="flex flex-col w-full">
        <form class="flex justify-between w-full" id="post_form" method="post" enctype="multipart/form-data">
            @csrf
            <div class="flex items-center gap-6">
                <p class="text-xs md:text-base lg:text-lg font-bold leading-6 opacity-90 ml-2 md:ml-4">
                    <span class="bg-red-500 text-white text-xs md:text-sm font-medium me-2 px-2.5 py-0.5 rounded-8">New</span>新規カテゴリー
                </p>
                <input id="new_category"  placeholder="ここに新規カテゴリーを入力してください" name="category" class="w-[400px] rounded-md" required />
            </div>
            <div class="flex justify-end">
                <button type="button" data-route="{{ route('AddCategory') }}" id="add_category_btn" class="submit-btn text-sm px-2 py-3 text-center">
                    登録
                </button>
            </div>
        </form>
    </div>
</div>
