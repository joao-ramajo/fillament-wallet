<x-layout.main-layout title="Fillament Wallet">
    <div class="min-h-screen bg-zinc-950 text-zinc-100 overflow-hidden">
        <!-- Background brutal shapes -->
        <div class="pointer-events-none fixed inset-0">
            <div class="absolute -top-32 -left-32 w-[40rem] h-[40rem] bg-lime-500/20 rotate-12"></div>
            <div class="absolute top-1/3 -right-40 w-[35rem] h-[35rem] bg-fuchsia-600/20 -rotate-12"></div>
            <div class="absolute bottom-0 left-1/4 w-[50rem] h-[20rem] bg-cyan-400/10 skew-y-6"></div>
        </div>

        <!-- Header -->
        <x-layout.header/>
        <!-- Hero -->
        <section class="relative z-10 px-6 py-24 grid grid-cols-1 lg:grid-cols-2 gap-16">
            <div>
                <h2 class="text-5xl md:text-7xl font-extrabold leading-none uppercase">
                    Controle
                    <span class="block text-lime-400">Financeiro</span>
                </h2>
                <p class="mt-8 text-lg text-zinc-300 max-w-xl">
                    O <strong>Filament Wallet</strong> é um gerenciador de contas que ajuda você a acompanhar
                    pagamentos, recebimentos e a controlar seu saldo de forma clara e eficiente.
                    Registre suas transações e visualize o impacto real de cada movimento financeiro.
                </p>
                <div class="mt-10 flex flex-wrap gap-6">
                    <a href="{{ route('web.register') }}"
                        class="bg-lime-400 text-zinc-950 px-8 py-4 font-black uppercase shadow-[6px_6px_0_0_#000] hover:shadow-[2px_2px_0_0_#000] transition">
                        Começar agora
                    </a>
                    <a href="#features"
                        class="border-4 border-zinc-100 px-8 py-4 font-black uppercase hover:bg-zinc-100 hover:text-zinc-950 transition">
                        Ver recursos
                    </a>
                </div>
            </div>

            <!-- Visual block -->
            <div class="relative">
                <div class="bg-zinc-900 border-4 border-zinc-100 p-8 shadow-[12px_12px_0_0_#000]">
                    <p class="font-mono text-sm text-zinc-400">Resumo financeiro</p>
                    <div class="mt-6 space-y-4">
                        <div class="flex justify-between font-bold">
                            <span>Total recebido</span>
                            <span class="text-lime-400">R$ 12.450</span>
                        </div>
                        <div class="flex justify-between font-bold">
                            <span>Total gasto</span>
                            <span class="text-red-400">R$ 8.320</span>
                        </div>
                        <div class="h-1 bg-zinc-700"></div>
                        <div class="flex justify-between text-xl font-black">
                            <span>Saldo final</span>
                            <span class="text-cyan-400">R$ 4.130</span>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Features -->
        <section id="features" class="relative z-10 px-6 py-24 border-t border-zinc-800">
            <h3 class="text-4xl font-black uppercase mb-16">O que o Filament faz</h3>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-10">
                <div class="border-4 border-zinc-100 p-6 bg-zinc-900">
                    <h4 class="font-black text-xl uppercase mb-4">Contas claras</h4>
                    <p class="text-zinc-300">
                        Cadastre contas de pagamento e recebimento com valores fixos ou variáveis.
                    </p>
                </div>

                <div class="border-4 border-zinc-100 p-6 bg-zinc-900">
                    <h4 class="font-black text-xl uppercase mb-4">Expectativas reais</h4>
                    <p class="text-zinc-300">
                        Veja quanto você <strong>espera gastar</strong> e <strong>espera receber</strong> antes do mês
                        acabar.
                    </p>
                </div>

                <div class="border-4 border-zinc-100 p-6 bg-zinc-900">
                    <h4 class="font-black text-xl uppercase mb-4">Impacto final</h4>
                    <p class="text-zinc-300">
                        O sistema calcula o saldo final projetado com base nas suas decisões financeiras.
                    </p>
                </div>
            </div>
        </section>

        <!-- Call to action -->
        <section class="relative z-10 px-6 py-32 bg-zinc-100 text-zinc-950">
            <h3 class="text-5xl font-black uppercase max-w-3xl">
                Pare de adivinhar.
                <span class="block">Veja o dinheiro como ele é.</span>
            </h3>
            <a href="{{ route('web.register') }}"
                class="inline-block mt-12 bg-zinc-950 text-zinc-100 px-10 py-5 font-black uppercase shadow-[8px_8px_0_0_#000] hover:shadow-[3px_3px_0_0_#000] transition">
                Criar minha carteira
            </a>
        </section>

        <!-- Footer -->
        <x-layout.footer/>
    </div>
</x-layout.main-layout>
