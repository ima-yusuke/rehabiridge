<!DOCTYPE html>
<html lang="ja">
<x-head :title="$title">
    @if(isset($description))
        <meta name="description" content="{{ $description }}"/>
    @endif
    @vite(['resources/css/app.css'])
</x-head>
<body class="bg-body-bg h-full flex flex-col">
    <main class="flex-1">
        {{ $slot }}
    </main>
</body>

</html>
