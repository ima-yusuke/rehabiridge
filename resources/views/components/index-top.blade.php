<i id="hamburger_icon" class="fa-solid fa-bars fixed right-4 md:right-6 top-4 md:top-6 text-2xl md:text-4xl cursor-pointer"></i>
<i id="close_icon" class="hidden z-50 fa-solid fa-xmark fixed right-4 md:right-6 top-4 md:top-6 text-2xl md:text-4xl cursor-pointer"></i>
<div class="flex justify-center gap-4 mt-16">
    {{--左側--}}
    <div class="flex flex-col gap-6 w-[45%] h-[250px] border-b-4 border-solid border-black">
        <h1 class="text-3xl md:text-4xl font-bold">RehaBiridge</h1>
        <div class="text-idx-gray text-xs flex flex-col gap-1">
            <p>Ueno Hills 123, 4-5 test-cho,</p>
            <p>Tsu-shi,Mie,514-1111,Japan</p>
            <p>Tel. 059-234-1111</p>
        </div>
    </div>

    {{--右側--}}
    <div class="flex flex-col gap-6 w-[45%] h-[250px] border-b-4 border-solid border-black relative">
        <h1 class="text-2xl md:text-4xl">リハビリの知識と臨床を繋げる</h1>
        <div class="text-idx-gray text-xs flex flex-col gap-1">
            <p>▷治せるセラピストになるための臨床に役立つ知識を発信</p>
            <p>▷学生・新人さんのお悩み相談所</p>
        </div>
        <p class="text-idx-gray text-xs text-end absolute bottom-2 border-t border-solid border-black pt-4 w-full">UPDATE:{{$latestPost["updated_at"]->format('Y.m.d') }}</p>
    </div>
</div>
