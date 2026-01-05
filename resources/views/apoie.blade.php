<x-layout.main-layout title="Apoie">
    <x-layout.header />

    <div x-data="{ open: false, pixKey: 'sua-chave-pix-aqui@email.com', copied: false }" class="max-w-7xl mx-auto px-6 py-24 space-y-24">

        {{-- Hero Section --}}
        <section class="text-center space-y-6">
            <h1
                class="text-6xl md:text-8xl font-black uppercase tracking-tighter text-white italic underline decoration-lime-400 decoration-8 underline-offset-8">
                Sobre o Projeto
            </h1>
            <p class="text-xl md:text-2xl text-zinc-300 max-w-3xl mx-auto font-medium">
                Independente. Simples. <span class="">Gratuito.</span>
            </p>
        </section>

        {{-- Grid de Informações (Cards) --}}
        <section class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <div class="group border-4 border-zinc-100 p-8 bg-zinc-900 shadow-[12px_12px_0_0_#000]">
                <div
                    class="w-12 h-12 bg-lime-400 flex items-center justify-center text-zinc-950 font-black text-2xl mb-6">
                    ?</div>
                <h4 class="font-black text-2xl uppercase mb-4 text-white">A Proposta</h4>
                <p class="text-zinc-300 leading-relaxed">Eliminar a complexidade. Registrar despesas e entradas sem
                    ferramentas pesadas.</p>
            </div>

            <div class="group border-4 border-zinc-100 p-8 bg-zinc-900 shadow-[12px_12px_0_0_#000]">
                <div
                    class="w-12 h-12 bg-cyan-400 flex items-center justify-center text-zinc-950 font-black text-2xl mb-6">
                    0</div>
                <h4 class="font-black text-2xl uppercase mb-4 text-white">100% Gratuito</h4>
                <p class="text-zinc-300 leading-relaxed">Sem anúncios ou venda de dados. O foco é acessibilidade
                    financeira real.</p>
            </div>

            <div class="group border-4 border-zinc-100 p-8 bg-zinc-900 shadow-[12px_12px_0_0_#000]">
                <div
                    class="w-12 h-12 bg-fuchsia-500 flex items-center justify-center text-zinc-950 font-black text-2xl mb-6">
                    ⚡</div>
                <h4 class="font-black text-2xl uppercase mb-4 text-white">Objetividade</h4>
                <p class="text-zinc-300 leading-relaxed">Feito para quem registra gastos rapidamente, inclusive pelo
                    celular no dia a dia.</p>
            </div>
        </section>

        {{-- Seção de Apoio (Gatilho do Modal) --}}
        <section class="relative">
            <div class="bg-lime-400 p-1 md:p-2 border-4 border-zinc-100 shadow-[16px_16px_0_0_#000]">
                <div class="bg-zinc-950 p-8 md:p-16 text-center space-y-8 border-4 border-zinc-950">
                    <h2 class="text-4xl md:text-6xl font-black uppercase text-white tracking-tighter">☕ Apoie o Projeto
                    </h2>
                    <p class="text-zinc-300 text-lg max-w-2xl mx-auto">Contribuições ajudam a manter a infraestrutura e
                        a evolução contínua do sistema.</p>

                    <button @click="open = true"
                        class="px-12 py-5 bg-white text-zinc-950 text-xl font-black uppercase border-4 border-zinc-100 shadow-[8px_8px_0_0_#27272a] hover:shadow-none hover:translate-x-1 hover:translate-y-1 transition-all">
                        Apoiar Agora
                    </button>
                </div>
            </div>
        </section>

        {{-- Modal Neobrutalista --}}
        <div x-show="open" x-transition.opacity
            class="fixed inset-0 z-50 flex items-center justify-center bg-zinc-950/80 backdrop-blur-sm p-4"
            style="display: none; margin-top: 0;">
            <div @click.away="open = false"
                class="bg-zinc-900 border-4 border-zinc-100 shadow-[20px_20px_0_0_#000] max-w-lg w-full p-8 relative">
                <button @click="open = false"
                    class="absolute top-4 right-4 text-zinc-400 hover:text-white font-black text-2xl uppercase">
                    [ X ]
                </button>

                <div class="text-center space-y-6">
                    <div class="inline-block bg-cyan-400 text-zinc-950 px-4 py-1 font-black uppercase text-sm italic">
                        Obrigado pelo apoio!
                    </div>

                    <h3 class="text-3xl font-black uppercase text-white leading-tight">Você é demais!</h3>

                    <p class="text-zinc-400 text-sm">
                        Sua ajuda mantém este projeto vivo e gratuito para todos. Escaneie o QR Code abaixo ou copie a
                        chave PIX.
                    </p>

                    <div class="bg-white p-4 inline-block border-4 border-zinc-100 mx-auto">
                        <img src="https://placehold.co/200x200/FFFFFF/000000?text=QR+CODE+PIX" alt="QR Code PIX"
                            class="w-48 h-48">
                    </div>

                    <div class="space-y-3 text-left">
                        <label class="text-xs font-black uppercase text-zinc-500 tracking-widest">Chave PIX
                            (E-mail)</label>
                        <div class="flex border-4 border-zinc-100 bg-zinc-950">
                            <input type="text" readonly :value="pixKey"
                                class="bg-transparent text-white p-3 flex-grow font-mono text-sm focus:outline-none">
                            <button
                                @click="
                                    navigator.clipboard.writeText(pixKey); 
                                    copied = true; 
                                    setTimeout(() => copied = false, 2000)
                                "
                                :class="copied ? 'bg-lime-400 text-zinc-950' : 'bg-zinc-100 text-zinc-950'"
                                class="px-4 font-black uppercase text-xs transition-colors border-l-4 border-zinc-100">
                                <span x-text="copied ? 'Copiado!' : 'Copiar'"></span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <x-layout.footer />
</x-layout.main-layout>
