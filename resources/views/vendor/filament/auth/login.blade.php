<x-filament::page>
    <div class="flex flex-col items-center justify-center min-h-screen bg-gray-100">
        <!-- Custom HTML Logo -->
        <img src="{{ asset('images/custom-logo.png') }}" alt="Custom Logo" class="mb-6 w-24 h-24">

        <!-- Custom HTML Form -->
        <form action="{{ route('filament.auth.login') }}" method="POST" class="max-w-sm w-full bg-white p-6 shadow rounded-lg">
            @csrf
            <div class="mb-4">
                <label for="email" class="block text-sm font-medium text-gray-700">Email Address</label>
                <input type="email" name="email" id="email" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required autofocus>
            </div>
            <div class="mb-6">
                <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                <input type="password" name="password" id="password" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
            </div>
            <button type="submit" class="w-full bg-indigo-600 text-white py-2 px-4 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-600 focus:ring-opacity-50">
                Login
            </button>
        </form>

        <!-- Additional Links -->
        <div class="mt-4 text-center">
            <a href="{{ route('password.request') }}" class="text-sm text-blue-600">Forgot your password?</a>
        </div>
    </div>
</x-filament::page>
