<!DOCTYPE html>
<html lang="ja">
<x-head :title="$title">
    @if(isset($description))
        <meta name="description" content="{{ $description }}"/>
    @endif
    @vite(['resources/css/app.css','resources/css/posts.css','resources/css/side-menu.css', 'resources/js/user.js'])
</x-head>
<body class="bg-body-bg h-full flex flex-col">
    <main class="flex-1">
        <x-side-menu></x-side-menu>
        {{ $slot }}
    </main>
</body>

</html>
