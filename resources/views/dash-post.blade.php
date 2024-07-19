<x-app-layout>
    {{--表示商品一覧--}}
    <div class="flex flex-col items-center w-full pt-12">
        <div class="flex justify-start w-[80%]">
            <h2 class="text-base pb-4 md:text-xl font-semibold text-gray-800">表示投稿一覧</h2>
        </div>

        <div class="flex flex-col items-center w-full">
            {{--新規投稿 --}}
            <x-dash-new-post />

            <div class="w-full flex flex-col items-center justify-center">
                {{--既存投稿--}}
                <x-dash-show-posts :posts="$posts"/>
            </div>
        </div>
    </div>

    {{--非表示商品一覧--}}
    <x-dash-hide-posts :hiddenPosts="$hiddenPosts"/>

    {{--JS--}}
    @vite(['resources/js/admin/dash-post.js'])
</x-app-layout>



