<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('success')" />
    <h2 class="text-xl font-semibold text-center">Register</h2>

    <form method="POST" action="{{ route('register.email') }}">
        @csrf
        <input type="hidden" value="register" name="type">
        <!-- Email Address -->
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="email" class="block mt-1 w-full" type="text" name="name" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>
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
