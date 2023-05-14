<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('success')" />
    <h2 class="text-xl font-semibold text-center">Login</h2>
    <form method="POST" action="{{ route('login.email') }}">
        @csrf
        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>
        <div class="mt-3">
            <x-primary-button>Get magic link</x-primary-button>
        </div>
    </form>
</x-guest-layout>
