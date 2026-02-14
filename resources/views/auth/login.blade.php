@extends('layouts.auth')

@section('title', 'Login - FreshSoy')

@section('content')
    <div class="bg-gray-50 min-h-screen flex items-center justify-center py-12 px-6">
        <div class="max-w-md w-full">

            {{-- Logo & Title --}}
            <div class="text-center mb-8">
                <img src="{{ asset('images/logo.jpg') }}" alt="FreshSoy" class="h-16 mx-auto mb-4">
                <h2 class="text-3xl font-bold text-gray-900">Welcome Back</h2>
                <p class="text-gray-600 mt-2">Sign in to your account</p>
            </div>

            {{-- Form --}}
            <div class="bg-white border border-gray-200 rounded-lg p-8">

                {{-- Session Status --}}
                @if (session('status'))
                    <div class="mb-4 bg-green-50 border-l-4 border-green-500 p-4 rounded">
                        <p class="text-green-700 text-sm">{{ session('status') }}</p>
                    </div>
                @endif

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    {{-- Email --}}
                    <div class="mb-6">
                        <label for="email" class="block text-sm font-medium text-gray-900 mb-2">Email Address</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                </svg>
                            </div>
                            <input id="email" type="email" name="email" value="{{ old('email') }}" required
                                autofocus autocomplete="username" placeholder="FreshSoy@gmail.com"
                                class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:border-gray-900 @error('email') border-red-500 @enderror">
                        </div>
                        @error('email')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Password --}}
                    <div class="mb-6">
                        <label for="password" class="block text-sm font-medium text-gray-900 mb-2">Password</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                </svg>
                            </div>
                            <input id="password" type="password" name="password" required autocomplete="current-password"
                                placeholder="••••••••"
                                class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:border-gray-900 @error('password') border-red-500 @enderror">
                        </div>
                        @error('password')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Remember Me --}}
                    <div class="flex items-center justify-between mb-6">
                        <label class="flex items-center">
                            <input type="checkbox" name="remember"
                                class="w-4 h-4 text-gray-900 border-gray-300 rounded focus:ring-2 focus:ring-gray-900">
                            <span class="ml-2 text-sm text-gray-600">Remember me</span>
                        </label>
                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}" class="text-sm text-gray-600 hover:text-gray-900">
                                Forgot password?
                            </a>
                        @endif
                    </div>

                    {{-- Submit Button --}}
                    <button type="submit"
                        class="w-full bg-[#DC2626] text-white py-3.5 rounded-lg font-semibold hover:bg-red-700 transition-colors mb-4">
                        Sign In
                    </button>

                    {{-- Register Link --}}
                    <p class="text-center text-sm text-gray-600">
                        Don't have an account?
                        <a href="{{ route('register') }}" class="font-semibold text-gray-900 hover:text-[#DC2626]">
                            Sign up
                        </a>
                    </p>
                </form>
            </div>
        </div>
    </div>
@endsection
