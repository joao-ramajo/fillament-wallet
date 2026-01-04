<x-layout.main-layout title="Cadastro">
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
                <h2 class="text-3xl font-black uppercase mb-6 text-center">Criar Conta</h2>

                <form action="{{ route('api.register') }}" method="POST" class="space-y-6">
                    @csrf

                    <!-- Nome -->
                    <!-- Nome -->
                    <div>
                        <label for="name" class="block font-bold mb-2">Nome</label>
                        <input type="text" name="name" id="name" placeholder="Seu nome completo"
                            class="w-full p-3 rounded border-2 border-zinc-100 bg-zinc-950 text-zinc-100 focus:outline-none focus:border-lime-400"
                            value="{{ old('name') }}">
                        @error('name')
                            <x-utils.input-error :message="$message" />
                        @enderror
                    </div>

                    <!-- Email -->
                    <div>
                        <label for="email" class="block font-bold mb-2">E-mail</label>
                        <input type="email" name="email" id="email" placeholder="seu@email.com"
                            class="w-full p-3 rounded border-2 border-zinc-100 bg-zinc-950 text-zinc-100 focus:outline-none focus:border-lime-400"
                            value="{{ old('email') }}">
                        @error('email')
                            <x-utils.input-error :message="$message" />
                        @enderror
                    </div>

                    <!-- Senha -->
                    <div>
                        <label for="password" class="block font-bold mb-2">Senha</label>
                        <input type="password" name="password" id="password" placeholder="••••••••"
                            class="w-full p-3 rounded border-2 border-zinc-100 bg-zinc-950 text-zinc-100 focus:outline-none focus:border-lime-400">
                        @error('password')
                            <x-utils.input-error :message="$message" />
                        @enderror
                    </div>

                    <!-- Confirmar Senha -->
                    <div>
                        <label for="password_confirmation" class="block font-bold mb-2">Confirmar Senha</label>
                        <input type="password" name="password_confirmation" id="password_confirmation"
                            placeholder="••••••••"
                            class="w-full p-3 rounded border-2 border-zinc-100 bg-zinc-950 text-zinc-100 focus:outline-none focus:border-lime-400">
                        @error('password_confirmation')
                            <x-utils.input-error :message="$message" />
                        @enderror
                    </div>

                    {{-- Termos e condicoes --}}
                    <div class="flex items-center gap-3 mt-4">
                        <input type="checkbox" name="terms" id="terms"
                            class="w-5 h-5 border-2 border-zinc-100 bg-zinc-950 text-lime-400 focus:outline-none focus:ring-2 focus:ring-lime-400"
                            {{ old('terms') ? 'checked' : '' }}>
                        <label for="terms" class="text-zinc-300 text-sm">
                            Aceito os <a href="{{  route('web.termos-e-condicoes') }}" class="underline text-lime-400">Termos e Condições</a>
                        </label>
                    </div>

                    @error('terms')
                        <x-utils.input-error :message="$message" />
                    @enderror

                    <!-- Botão -->
                    <div class="flex justify-center">
                        <button type="submit"
                            class="px-8 py-4 bg-lime-400 text-zinc-950 font-black uppercase shadow-[6px_6px_0_0_#000] hover:shadow-[2px_2px_0_0_#000] transition w-full">
                            Criar minha conta
                        </button>
                    </div>
                </form>

                <!-- Login link -->
                <p class="mt-6 text-center text-zinc-400">
                    Já tem uma conta?
                    <a href="{{ route('web.login') }}" class="text-lime-400 font-bold hover:underline">Entrar</a>
                </p>
            </div>
        </div>

        <!-- Footer -->
        <x-layout.footer />
    </div>
</x-layout.main-layout>
