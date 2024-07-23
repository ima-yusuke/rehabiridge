<x-template title="RehaBiridge">
    @php
        $clear = !empty($clear) ? $clear : null;
    @endphp
    <x-index-top :latestPost="$latestPost"></x-index-top>
    <x-index-nav :categories="$categories" :clear="$clear"/>
    <x-index-gallery :posts="$posts"></x-index-gallery>

    <!-- drawer component -->
    <div class="side_wrapper">
        <div class="side_menu_off pt-4">
            <h5 class="text-base font-semibold text-gray-500 px-5">メニュー</h5>
            <button type="button" class="side_li text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 absolute top-2.5 end-2.5 inline-flex items-center" >
                <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                <span class="sr-only">Close menu</span>
            </button>

            <div class="py-4 overflow-y-auto">
                <ul class="space-y-2 font-medium">
                    <li class="side_li">
                        <a href="#" class="flex items-center p-2 text-gray-900 rounded-lg hover:bg-gray-100 group">
                            <span class="ms-3">会社紹介</span>
                        </a>
                    </li>
                    <li class="side_li">
                        <a href="#message" class="flex items-center p-2 text-gray-900 rounded-lg hover:bg-gray-100 group">
                            <span class="ms-3">社長メッセージ</span>
                        </a>
                    </li>
                    <li class="side_li">
                        <a href="#product" class="flex items-center p-2 text-gray-900 rounded-lg hover:bg-gray-100 group">
                            <span class="ms-3">製品紹介</span>
                        </a>
                    </li>
                    <li class="side_li">
                        <a href="#interview" class="flex items-center p-2 text-gray-900 rounded-lg hover:bg-gray-100 group">
                            <span class="ms-3">社員インタビュー</span>
                        </a>
                    </li>
                    <li class="side_li">
                        <a href="#reqruitment" class="flex items-center p-2 text-gray-900 rounded-lg hover:bg-gray-100 group">
                            <span class="ms-3">採用窓口</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="screen_cover"></div>
</x-template>
