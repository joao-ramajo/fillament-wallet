<x-layout.main-layout title="Login">
    <div class="min-h-screen bg-zinc-950 text-zinc-100 overflow-hidden">
        <!-- Background brutal shapes -->
        <div class="pointer-events-none fixed inset-0">
            <div class="absolute -top-32 -left-32 w-[40rem] h-[40rem] bg-lime-500/20 rotate-12"></div>
            <div class="absolute top-1/3 -right-40 w-[35rem] h-[35rem] bg-fuchsia-600/20 -rotate-12"></div>
            <div class="absolute bottom-0 left-1/4 w-[50rem] h-[20rem] bg-cyan-400/10 skew-y-6"></div>
        </div>

        <!-- Header -->
        <x-layout.header />
        <!-- Form container -->
        <div class="relative z-10 flex justify-center items-center py-24 px-6">
            <div class="w-full max-w-md bg-zinc-900 border-4 border-zinc-100 p-10 shadow-[12px_12px_0_0_#000]">
                <h2 class="text-3xl font-black uppercase mb-6 text-center">Entrar</h2>

                <form action="{{ route('api.login') }}" method="POST" class="space-y-6">
                    @csrf

                    <!-- E-mail -->
                    <div>
                        <label for="email" class="block font-bold mb-2">E-mail</label>
                        <input type="email" name="email" id="email" placeholder="seu@email.com"
                            class="w-full p-3 rounded border-2 border-zinc-100 bg-zinc-950 text-zinc-100 focus:outline-none focus:border-lime-400"
                            required value="{{ old('email') }}">
                        @error('email')
                            <x-utils.input-error :message="$message" />
                        @enderror
                    </div>

                    <!-- Senha -->
                    <div x-data="{ showPassword: false }">
                        <label for="password" class="block font-bold mb-2">Senha</label>
                        <div class="relative">
                            <input :type="showPassword ? 'text' : 'password'" name="password" id="password"
                                placeholder="••••••••"
                                class="w-full p-3 pr-12 rounded border-2 border-zinc-100 bg-zinc-950 text-zinc-100 focus:outline-none focus:border-lime-400"
                                required>

                            <!-- Botão Toggle -->
                            <button type="button" @click="showPassword = !showPassword"
                                class="absolute right-3 top-1/2 -translate-y-1/2 text-zinc-400 hover:text-lime-400 transition-colors focus:outline-none">
                                <svg x-show="!showPassword" class="w-5 h-5" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                </svg>
                                <svg x-show="showPassword" x-cloak class="w-5 h-5" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" />
                                </svg>
                            </button>
                        </div>
                    </div>

                    <!-- Alpine.js (se ainda não tiver no layout) -->
                    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

                    <style>
                        [x-cloak] {
                            display: none !important;
                        }
                    </style>

                    <!-- Lembrar -->
                    <div class="flex items-center justify-between">
                        <label class="flex items-center space-x-2">
                            <input type="checkbox" name="remember" id="remember"
                                class="rounded border-zinc-100 text-lime-400 focus:ring-lime-400">
                            <span>Lembrar-me</span>
                        </label>
                        <a href="#" class="text-lime-400 font-bold hover:underline">
                            Esqueceu a senha?
                        </a>
                    </div>

                    <!-- Botão -->
                    <div class="flex justify-center">
                        <button type="submit"
                            class="px-8 py-4 bg-lime-400 text-zinc-950 font-black uppercase shadow-[6px_6px_0_0_#000] hover:shadow-[2px_2px_0_0_#000] transition w-full">
                            Entrar
                        </button>
                    </div>
                </form>

                <!-- Cadastro link -->
                <p class="mt-6 text-center text-zinc-400">
                    Não tem uma conta?
                    <a href="{{ route('web.register') }}" class="text-lime-400 font-bold hover:underline">Criar
                        conta</a>
                </p>
            </div>
        </div>

        <!-- Footer -->
        <x-layout.footer />
    </div>
</x-layout.main-layout>
