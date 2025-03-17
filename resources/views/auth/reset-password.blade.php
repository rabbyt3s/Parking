@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700">
                <h1 class="text-2xl font-bold mb-4 text-gray-800 dark:text-white">{{ __('Réinitialiser le mot de passe') }}</h1>

                <form method="POST" action="{{ route('password.update') }}">
                    @csrf

                    <!-- Token de réinitialisation du mot de passe -->
                    <input type="hidden" name="token" value="{{ $request->route('token') }}">

                    <!-- Email Address -->
                    <div class="mb-4">
                        <label for="email" class="block font-medium text-sm text-gray-700 dark:text-gray-300">Email</label>
                        <input id="email" type="email" name="email" value="{{ old('email', $request->email) }}" required autofocus
                               class="mt-1 block w-full rounded-md shadow-sm border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-primary-500 focus:ring focus:ring-primary-500 focus:ring-opacity-50">
                        @error('email')
                            <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Password -->
                    <div class="mb-4">
                        <label for="password" class="block font-medium text-sm text-gray-700 dark:text-gray-300">{{ __('Nouveau mot de passe') }}</label>
                        <input id="password" type="password" name="password" required
                               class="mt-1 block w-full rounded-md shadow-sm border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-primary-500 focus:ring focus:ring-primary-500 focus:ring-opacity-50">
                        @error('password')
                            <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Confirm Password -->
                    <div class="mb-4">
                        <label for="password_confirmation" class="block font-medium text-sm text-gray-700 dark:text-gray-300">{{ __('Confirmation du mot de passe') }}</label>
                        <input id="password_confirmation" type="password" name="password_confirmation" required
                               class="mt-1 block w-full rounded-md shadow-sm border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-primary-500 focus:ring focus:ring-primary-500 focus:ring-opacity-50">
                        @error('password_confirmation')
                            <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex items-center justify-end mt-4">
                        <button type="submit" class="inline-flex items-center px-4 py-2 bg-primary-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-primary-700 active:bg-primary-800 focus:outline-none focus:border-primary-800 focus:ring ring-primary-300 disabled:opacity-25 transition ease-in-out duration-150">
                            {{ __('Réinitialiser le mot de passe') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection 