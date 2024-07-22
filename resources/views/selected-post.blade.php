<x-template title="RehaBiridge">
    <div class="flex justify-center items-center my-8 md:my-0 md:h-screen">
        <div class="bg-white rounded-2xl flex flex-col items-center justify-center gap-8 md:gap-16 pt-8 h-[90vh] w-[90%] md:w-[80%] md:relative">
            <h1 class="text-2xl font-bold md:absolute md:top-8">{{$selectedPost["name"]}}</h1>
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
                    <video src="{{ asset($selectedPost['video']) }}" type="video/mp4" autoplay loop muted playsinline controls class="w-full h-[300px] object-cover">
                        お使いのブラウザは動画タグに対応していません。
                    </video>
                @endif
            </div>
        </div>
    </div>
</x-template>
