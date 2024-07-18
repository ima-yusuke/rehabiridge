<div class="flex flex-wrap justify-center items-center gap-6 gap-y-20 mt-8">
    @foreach($posts as $idx=>$value)
        <div class="flex flex-col gap-2">
            <div>
                <img src="{{asset($value['img'])}}" class="w-[310px] h-[200px] object-cover">
            </div>
            <aside>
                <p class="text-sm">{{$value["name"]}}</p>
                <p class="text-idx-gray text-xs">{{$value["category"]}}</p>
            </aside>
        </div>
    @endforeach
</div>
