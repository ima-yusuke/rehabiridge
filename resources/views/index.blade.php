<x-template title="RehaBiridge">
    @php
        $clear = !empty($clear) ? $clear : null;
    @endphp
    <x-index-top></x-index-top>
    <x-index-nav :categories="$categories" :clear="$clear"/>
    <x-index-gallery :posts="$posts"></x-index-gallery>
</x-template>
