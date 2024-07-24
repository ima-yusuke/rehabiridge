<x-template title="RehaBiridge">
    @php
        $clear = !empty($clear) ? $clear : null;
    @endphp
    <x-index-top :latestPost="$latestPost"></x-index-top>
    <x-index-nav :categories="$categories" :clear="$clear"/>
    <x-index-gallery :posts="$posts"></x-index-gallery>
    <h1>eeeeeeeeeeeeeeeeeeee</h1>
</x-template>
