@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700">
                <div class="mb-4 text-gray-600 dark:text-gray-400">
                    {{ __('Vous avez oublié votre mot de passe ? Pas de problème. Indiquez-nous simplement votre adresse e-mail et nous vous enverrons un lien de réinitialisation de mot de passe.') }}
                </div>

                @if (session('status'))
                    <div class="mb-4 font-medium text-sm text-green-600 dark:text-green-400">
                        {{ session('status') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('password.email') }}">
                    @csrf

                    <!-- Email Address -->
                    <div class="mb-4">
                        <label for="email" class="block font-medium text-sm text-gray-700 dark:text-gray-300">Email</label>
                        <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus
                               class="mt-1 block w-full rounded-md shadow-sm border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-primary-500 focus:ring focus:ring-primary-500 focus:ring-opacity-50">
                        @error('email')
                            <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex items-center justify-between mt-4">
                        <a href="{{ route('login') }}" class="text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100">
                            {{ __('Retour à la connexion') }}
                        </a>

                        <button type="submit" class="inline-flex items-center px-4 py-2 bg-primary-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-primary-700 active:bg-primary-800 focus:outline-none focus:border-primary-800 focus:ring ring-primary-300 disabled:opacity-25 transition ease-in-out duration-150">
                            {{ __('Envoyer le lien de réinitialisation') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection 