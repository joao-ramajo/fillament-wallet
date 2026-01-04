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
                    <div>
                        <label for="password" class="block font-bold mb-2">Senha</label>
                        <input type="password" name="password" id="password" placeholder="••••••••"
                            class="w-full p-3 rounded border-2 border-zinc-100 bg-zinc-950 text-zinc-100 focus:outline-none focus:border-lime-400"
                            required>
                    </div>

                    <!-- Lembrar -->
                    <div class="flex items-center justify-between">
                        <label class="flex items-center space-x-2">
                            <input type="checkbox" name="remember"
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
