<x-template title="RehaBiridge">
    <div class="flex justify-center items-center my-8 md:my-0 md:h-screen">
        <div class="bg-white rounded-2xl flex flex-col items-center justify-center gap-8 md:gap-16 pt-8 h-[90vh] w-[90%] md:w-[80%] md:relative">
            <div class="flex flex-col items-center gap-8 md:absolute md:top-12">
                <h1 class="text-3xl md:text-4xl font-bold">{{$selectedPost["name"]}}</h1>
                <p class="border-b-2 border-solid border-black w-[80px]"></p>
                <p class="text-idx-gray text-xs">{{$selectedPost->categories["category_name"]}}</p>
            </div>
            @can('read')
            <div>
                @if($selectedPost["pdf"]!=null)
                    <div class="flex gap-6">
{{--                        <div>--}}
{{--                            <iframe src="{{ asset($selectedPost['pdf']) }}" width="100%" height="500px" style="border:none;">--}}
{{--                                このブラウザでは PDF の表示に対応していません。--}}
{{--                            </iframe>                        --}}
{{--                        </div>--}}
                        <div>
                            <a href="{{asset($selectedPost["pdf"])}}" target="_blank" class="text-blue-600 hover:underline">PDFを表示</a>
                        </div>
                    </div>
                @endif
            </div>
            <div>
                @if($selectedPost["video"]!=null)
                    <video src="{{ asset($selectedPost['video']) }}" type="video/mp4" loop muted playsinline controls class="w-full h-[300px] object-cover">
                        お使いのブラウザは動画タグに対応していません。
                    </video>
                @endif
            </div>
            @endcan
            @cannot('read')
                <h1><a href="/login" class="text-blue-500">こちら</a>からログインしてください</h1>
            @endcannot
        </div>
    </div>
</x-template>
