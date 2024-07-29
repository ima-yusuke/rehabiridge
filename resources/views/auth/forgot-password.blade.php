<x-guest-layout>
    <div class="mb-4 text-sm text-gray-600">
        {{ __('メールアドレスを入力してください。') }}
    </div>

    <!-- Session Status -->
    @props(['status'])

    @if (session('status'))
        <div {{ $attributes->merge(['class' => 'mb-4 font-medium text-sm text-green-600']) }}>
           メールを送信しました。
        </div>
    @endif

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>


        <div class="my-4 text-xs text-gray-600">
            {{ __('ご登録されているメールアドレスにリンクをお送り致します。') }}
        </div>

        <div class="flex items-center justify-between mt-4">
            <a href="/login" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                {{ __('ログイン画面') }}
            </a>
            <x-primary-button>
                {{ __('送信') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
