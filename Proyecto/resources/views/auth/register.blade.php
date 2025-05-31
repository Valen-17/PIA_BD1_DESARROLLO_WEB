<x-guest-layout>
    <div class="min-h-screen flex flex-col justify-center py-12 px-4 sm:px-6 lg:px-8 bg-gray-50">
        <div class="sm:mx-auto sm:w-full sm:max-w-md">
            <div class="text-center">
                <i class="fas fa-user-plus text-indigo-600 text-5xl mb-4"></i>
                <h2 class="mt-6 text-center text-3xl font-extrabold text-gray-900">
                    Crear una cuenta
                </h2>
                <p class="mt-2 text-center text-sm text-gray-600">
                    ¿Ya tienes una cuenta? <a href="{{ route('login') }}" class="font-medium text-indigo-600 hover:text-indigo-500">Inicia sesión aquí</a>
                </p>
            </div>

            <div class="mt-8 bg-white py-8 px-6 shadow rounded-lg sm:px-10">
                <form class="mb-0 space-y-6" method="POST" action="{{ route('register') }}">
                    @csrf

                    <!-- Username -->
                    <div>
                        <label for="username" class="block text-sm font-medium text-gray-700">
                            <i class="fas fa-user mr-2 text-indigo-600"></i>Nombre de usuario
                        </label>
                        <div class="mt-1">
                            <input id="username" name="username" type="text" autocomplete="username" required
                                class="w-full border border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500 px-4 py-3"
                                value="{{ old('username') }}">
                            <x-input-error :messages="$errors->get('username')" class="mt-2 text-red-600 text-sm" />
                        </div>
                    </div>

                    <!-- Email Address -->
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700">
                            <i class="fas fa-envelope mr-2 text-indigo-600"></i>Correo electrónico
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
                            <input id="password" name="password" type="password" autocomplete="new-password" required
                                class="w-full border border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500 px-4 py-3">
                            <x-input-error :messages="$errors->get('password')" class="mt-2 text-red-600 text-sm" />
                            <div class="text-xs text-gray-500 mt-1">
                                La contraseña debe tener al menos 8 caracteres
                            </div>
                        </div>
                    </div>

                    <!-- Confirm Password -->
                    <div>
                        <label for="password_confirmation" class="block text-sm font-medium text-gray-700">
                            <i class="fas fa-lock mr-2 text-indigo-600"></i>Confirmar contraseña
                        </label>
                        <div class="mt-1">
                            <input id="password_confirmation" name="password_confirmation" type="password" 
                                autocomplete="new-password" required
                                class="w-full border border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500 px-4 py-3">
                            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2 text-red-600 text-sm" />
                        </div>
                    </div>

                    <!-- Tipo de Usuario (opcional) -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            <i class="fas fa-user-tag mr-2 text-indigo-600"></i>Tipo de usuario
                        </label>
                        <div class="grid grid-cols-2 gap-4">
                            <label class="inline-flex items-center">
                                <input type="radio" name="user_type" value="profesor" 
                                    class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300">
                                <span class="ml-2 text-sm text-gray-700">Profesor</span>
                            </label>
                            <label class="inline-flex items-center">
                                <input type="radio" name="user_type" value="estudiante" 
                                    class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300">
                                <span class="ml-2 text-sm text-gray-700">Estudiante</span>
                            </label>
                        </div>
                    </div>

                    <!-- Términos y condiciones -->
                    <div class="flex items-center">
                        <input id="terms" name="terms" type="checkbox" required
                            class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded">
                        <label for="terms" class="ml-2 block text-sm text-gray-700">
                            Acepto los <a href="#" class="text-indigo-600 hover:text-indigo-500">términos y condiciones</a>
                        </label>
                    </div>

                    <!-- Submit Button -->
                    <div>
                        <button type="submit"
                            class="w-full flex justify-center py-3 px-4 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition duration-300">
                            <i class="fas fa-user-plus mr-2"></i> Registrarse
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-guest-layout>