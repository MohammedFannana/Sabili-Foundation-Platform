<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('البريد الالكتروني')" style="color:white;text-align:end"/>
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" style="text-align:end"/>
            <x-input-error :messages="$errors->get('email')" class="mt-2" style="color:white !important"/>
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('كلمة المرور')" style="color:white;text-align:end"/>

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="current-password" style="text-align:end"/>

            <x-input-error :messages="$errors->get('password')" class="mt-2 "  style="color:white !important"/>
        </div>

        <!-- Remember Me -->
        <div class="block mt-4" style="text-align: end">
            <label for="remember_me" class="inline-flex items-center">
                <span class="text-sm text-gray-600" style="color:white;">{{ __('Remember me') }}</span>
                <input id="remember_me" type="checkbox" class="rounded ms-2  border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
            </label>
        </div>

        <div class="flex items-center mt-4" style="justify-content:space-between">

            <button type="submit" style="color:rgba(1, 143, 145, 1);background-color:white" class="inline-flex ms-3 items-center px-4 py-2  border border-transparent rounded-md font-semibold text-sm  uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                تسجيل الدخول
            </button>


            @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}" style="color:white;">
                    {{ __('Forgot your password?') }}
                </a>
            @endif


        </div>
    </form>
</x-guest-layout>
