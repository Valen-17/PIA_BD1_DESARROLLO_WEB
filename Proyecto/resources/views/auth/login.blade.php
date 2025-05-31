<x-guest-layout>
    <div class="min-h-screen flex flex-col justify-center py-12 px-4 sm:px-6 lg:px-8 bg-gray-50">
        <div class="sm:mx-auto sm:w-full sm:max-w-md">
            <div class="text-center">
                <i class="fas fa-sign-in-alt text-indigo-600 text-5xl mb-4"></i>
                <h2 class="mt-6 text-center text-3xl font-extrabold text-gray-900">
                    Iniciar Sesión
                </h2>
                <p class="mt-2 text-center text-sm text-gray-600">
                    O <a href="{{ route('register') }}" class="font-medium text-indigo-600 hover:text-indigo-500">regístrate aquí</a>
                </p>
            </div>

            <div class="mt-8 bg-white py-8 px-6 shadow rounded-lg sm:px-10">
                <!-- Session Status -->
                <x-auth-session-status class="mb-4 p-4 bg-blue-100 text-blue-700 rounded-lg" :status="session('status')" />

                <form class="mb-0 space-y-6" method="POST" action="{{ route('login') }}">
                    @csrf

                    <!-- Email Address -->
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700">
                            <i class="fas fa-envelope mr-2 text-indigo-600"></i>Correo Electrónico
                        </label>
                        <div class="mt-1">
                            <input id="email" name="email" type="email" autocomplete="email" required
                                class="w-full border border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500 px-4 py-3"
                                value="{{ old('email') }}">
                            <x-input-error :messages="$errors->get('email')" class="mt-2 text-red-600 text-sm" />
                        </div>
                    </div>

                    <!-- Password -->
                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-700">
                            <i class="fas fa-lock mr-2 text-indigo-600"></i>Contraseña
                        </label>
                        <div class="mt-1 relative">
                            <input id="password" name="password" type="password" autocomplete="current-password" required
                                class="w-full border border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500 px-4 py-3">
                            <x-input-error :messages="$errors->get('password')" class="mt-2 text-red-600 text-sm" />
                        </div>
                    </div>

                    <!-- Remember Me & Forgot Password -->
                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <input id="remember_me" name="remember" type="checkbox"
                                class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded">
                            <label for="remember_me" class="ml-2 block text-sm text-gray-700">
                                Recordar sesión
                            </label>
                        </div>

                        @if (Route::has('password.request'))
                            <div class="text-sm">
                                <a href="{{ route('password.request') }}" class="font-medium text-indigo-600 hover:text-indigo-500">
                                    ¿Olvidaste tu contraseña?
                                </a>
                            </div>
                        @endif
                    </div>

                    <!-- Submit Button -->
                    <div>
                        <button type="submit"
                            class="w-full flex justify-center py-3 px-4 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition duration-300">
                            <i class="fas fa-sign-in-alt mr-2"></i> Iniciar Sesión
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-guest-layout>