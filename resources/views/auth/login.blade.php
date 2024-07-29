<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="pt-6">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" placeholder="メールアドレスを入力" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-6">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="current-password"
                            placeholder="パスワードを入力"/>

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Login Button -->
        <div class="flex justify-center items-center mt-6">
            <button type="submit" class="bg-gray-900 py-2 px-8 text-white rounded-lg">ログイン</button>
        </div>

        <!-- Forgot Password -->
        <div class="flex justify-center items-center my-4">
            @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                    {{ __('パスワードをお忘れですか？') }}
                </a>
            @endif
        </div>

        <!-- Register -->
        <div class="border-t border-solid border-gray-600 flex justify-center items-center mt-8 py-6">
            <a href="/register" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                {{ __('新規会員登録') }}
            </a>
        </div>
    </form>
</x-guest-layout>
