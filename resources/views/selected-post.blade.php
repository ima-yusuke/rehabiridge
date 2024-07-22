<x-template title="RehaBiridge">
    <div class="flex justify-center items-center my-8 md:my-0 md:h-screen">
        <div class="bg-white rounded-2xl flex flex-col items-center pt-8 h-[90vh] w-[90%] md:w-[80%] md:relative">
            <h1 class="text-2xl font-bold">{{$selectedPost["name"]}}</h1>
            <div>
                @if($selectedPost["pdf"]!=null)
                    <div class="flex gap-6">
                        <div>
                            <embed src="{{asset($selectedPost["pdf"])}}" type="application/pdf" width="300px" height="300px"/>
                        </div>
                        <div>
                            <a href="{{asset($selectedPost["pdf"])}}" target="_blank" class="text-blue-600 hover:underline">PDFを表示</a>
                        </div>
                    </div>
                @endif
            </div>
            <div>
                @if($selectedPost["video"]!=null)
                    <video src="{{ asset($selectedPost["video"]) }}" type="video/mp4" autoplay loop muted  class="md:absolute md:bottom-0 md:-left-[50%] md:transform md:translate-x-1/2 rounded-b-2xl w-full h-[300px] md:h-[400px] object-cover" >
                    お使いのブラウザは動画タグに対応していません。
                @endif
            </div>
        </div>
    </div>
</x-template>
