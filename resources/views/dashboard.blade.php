<x-app-layout>
    <div class="py-12 flex flex-wrap gap-4 justify-center items-center">
        <div class="flex flex-col justify-center items-center shadow-xl text-center border-4 border-solid border-black bg-white w-[40%] md:w-[30%]">
            <a href="{{route("ShowPostPage")}}" class="w-full h-full hover:bg-black hover:text-white p-3">
                <div class="flex flex-col gap-2">
                    <p><i class="fa-solid fa-file text-4xl"></i></p>
                    <p class="font-bold text-sm md:text-base">投稿</p>
                </div>
            </a>
        </div>
        <div class="flex flex-col justify-center items-center shadow-xl text-center border-4 border-solid border-black bg-white w-[40%] md:w-[30%]">
            <a href="{{route("ShowCategoryPage")}}" class="w-full h-full hover:bg-black hover:text-white p-3">
                <div class="flex flex-col gap-2">
                    <p><i class="fa-solid fa-magnifying-glass text-4xl"></i></p>
                    <p class="font-bold text-sm md:text-base">カテゴリー</p>
                </div>
            </a>
        </div>
        <div class="flex flex-col justify-center items-center shadow-xl text-center border-4 border-solid border-black bg-white w-[40%] md:w-[30%]">
            <a href="{{route("ShowMemberPage")}}" class="w-full h-full hover:bg-black hover:text-white p-3">
                <div class="flex flex-col gap-2">
                    <p><i class="fa-solid fa-user text-4xl"></i></p>
                    <p class="font-bold text-sm md:text-base">会員ユーザー</p>
                </div>
            </a>
        </div>
    </div>
</x-app-layout>
