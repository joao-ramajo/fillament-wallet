<x-layout.main-layout title="Funcionalidades">
    <div class="min-h-screen bg-zinc-950 text-zinc-100 overflow-hidden">
        <!-- Background brutal shapes com animação -->
        <div class="pointer-events-none fixed inset-0">
            <div class="absolute -top-32 -left-32 w-[40rem] h-[40rem] bg-lime-500/20 rotate-12 transition-transform duration-[3000ms] hover:scale-110"></div>
            <div class="absolute top-1/3 -right-40 w-[35rem] h-[35rem] bg-fuchsia-600/20 -rotate-12 transition-transform duration-[3000ms] hover:scale-110"></div>
            <div class="absolute bottom-0 left-1/4 w-[50rem] h-[20rem] bg-cyan-400/10 skew-y-6 transition-transform duration-[3000ms] hover:scale-110"></div>
        </div>

        <!-- Header -->
        <x-layout.header />

        <!-- Hero / Título com breadcrumb -->
        <section class="relative z-10 px-6 pt-12 pb-16">
            <!-- Breadcrumb -->
            {{-- <nav class="flex justify-center mb-8">
                <ol class="flex items-center space-x-2 text-sm">
                    <li><a href="{{ route('web.home') }}" class="text-zinc-400 hover:text-lime-400 transition">Home</a></li>
                    <li class="text-zinc-600">/</li>
                    <li class="text-lime-400 font-bold">Funcionalidades</li>
                </ol>
            </nav> --}}

            <!-- Título -->
            <div class="text-center">
                <h2 class="text-5xl md:text-7xl font-extrabold uppercase mb-6 leading-tight">
                    <span class="block">O que você pode</span>
                    <span class="text-lime-400">fazer aqui</span>
                </h2>
                <p class="text-lg md:text-xl text-zinc-300 max-w-2xl mx-auto leading-relaxed">
                    Conheça as principais funcionalidades do <strong class="text-lime-400">Filament Wallet</strong> e veja como ele ajuda você
                    a controlar suas finanças de forma clara e eficiente.
                </p>
            </div>
        </section>

        <!-- Features grid com hover effects melhorados -->
        <section class="relative z-10 px-6 pb-32">
            <div class="max-w-7xl mx-auto grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                
                <!-- Feature 1 -->
                <div class="group border-4 border-zinc-100 p-8 bg-zinc-900 shadow-[12px_12px_0_0_#000] hover:shadow-[6px_6px_0_0_#000] hover:-translate-x-1 hover:-translate-y-1 transition-all duration-300">
                    <div class="flex items-start gap-4 mb-4">
                        <div class="flex-shrink-0 w-12 h-12 bg-lime-400 flex items-center justify-center text-zinc-950 font-black text-2xl">
                            $
                        </div>
                        <h4 class="font-black text-xl uppercase group-hover:text-lime-400 transition-colors">
                            Registro de Transações
                        </h4>
                    </div>
                    <p class="text-zinc-300 leading-relaxed">
                        Cadastre despesas e entradas com categorias, datas de pagamento e vencimento, mantendo total controle das suas finanças.
                    </p>
                    <div class="mt-4 inline-flex items-center text-sm font-bold text-lime-400 opacity-0 group-hover:opacity-100 transition-opacity">
                        Saiba mais →
                    </div>
                </div>

                <!-- Feature 2 -->
                <div class="group border-4 border-zinc-100 p-8 bg-zinc-900 shadow-[12px_12px_0_0_#000] hover:shadow-[6px_6px_0_0_#000] hover:-translate-x-1 hover:-translate-y-1 transition-all duration-300">
                    <div class="flex items-start gap-4 mb-4">
                        <div class="flex-shrink-0 w-12 h-12 bg-cyan-400 flex items-center justify-center text-zinc-950 font-black text-2xl">
                            🏦
                        </div>
                        <h4 class="font-black text-xl uppercase group-hover:text-cyan-400 transition-colors">
                            Contas Bancárias
                        </h4>
                    </div>
                    <p class="text-zinc-300 leading-relaxed">
                        Registre suas contas bancárias para controlar melhor os gastos e acompanhar o saldo de cada conta.
                    </p>
                    <div class="mt-4 inline-flex items-center text-sm font-bold text-cyan-400 opacity-0 group-hover:opacity-100 transition-opacity">
                        Saiba mais →
                    </div>
                </div>

                <!-- Feature 3 -->
                <div class="group border-4 border-zinc-100 p-8 bg-zinc-900 shadow-[12px_12px_0_0_#000] hover:shadow-[6px_6px_0_0_#000] hover:-translate-x-1 hover:-translate-y-1 transition-all duration-300">
                    <div class="flex items-start gap-4 mb-4">
                        <div class="flex-shrink-0 w-12 h-12 bg-fuchsia-500 flex items-center justify-center text-zinc-950 font-black text-2xl">
                            #
                        </div>
                        <h4 class="font-black text-xl uppercase group-hover:text-fuchsia-500 transition-colors">
                            Categorias Personalizadas
                        </h4>
                    </div>
                    <p class="text-zinc-300 leading-relaxed">
                        Crie categorias próprias para organizar suas despesas e receitas de forma prática e intuitiva.
                    </p>
                    <div class="mt-4 inline-flex items-center text-sm font-bold text-fuchsia-500 opacity-0 group-hover:opacity-100 transition-opacity">
                        Saiba mais →
                    </div>
                </div>

                <!-- Feature 4 -->
                <div class="group border-4 border-zinc-100 p-8 bg-zinc-900 shadow-[12px_12px_0_0_#000] hover:shadow-[6px_6px_0_0_#000] hover:-translate-x-1 hover:-translate-y-1 transition-all duration-300">
                    <div class="flex items-start gap-4 mb-4">
                        <div class="flex-shrink-0 w-12 h-12 bg-lime-400 flex items-center justify-center text-zinc-950 font-black text-2xl">
                            📊
                        </div>
                        <h4 class="font-black text-xl uppercase group-hover:text-lime-400 transition-colors">
                            Estatísticas Financeiras
                        </h4>
                    </div>
                    <p class="text-zinc-300 leading-relaxed">
                        Acompanhe saldo atual, total de entradas, total de gastos e projeções futuras com base nas suas transações.
                    </p>
                    <div class="mt-4 inline-flex items-center text-sm font-bold text-lime-400 opacity-0 group-hover:opacity-100 transition-opacity">
                        Saiba mais →
                    </div>
                </div>

                <!-- Feature 5 -->
                <div class="group border-4 border-zinc-100 p-8 bg-zinc-900 shadow-[12px_12px_0_0_#000] hover:shadow-[6px_6px_0_0_#000] hover:-translate-x-1 hover:-translate-y-1 transition-all duration-300">
                    <div class="flex items-start gap-4 mb-4">
                        <div class="flex-shrink-0 w-12 h-12 bg-cyan-400 flex items-center justify-center text-zinc-950 font-black text-2xl">
                            💰
                        </div>
                        <h4 class="font-black text-xl uppercase group-hover:text-cyan-400 transition-colors">
                            Saldo e Projeções
                        </h4>
                    </div>
                    <p class="text-zinc-300 leading-relaxed">
                        Veja de forma clara como suas decisões financeiras impactam o saldo final esperado do mês.
                    </p>
                    <div class="mt-4 inline-flex items-center text-sm font-bold text-cyan-400 opacity-0 group-hover:opacity-100 transition-opacity">
                        Saiba mais →
                    </div>
                </div>
            </div>
        </section>

        <!-- Stats section - Nova seção -->
        <section class="relative z-10 px-6 py-20 border-t-4 border-zinc-800">
            <div class="max-w-5xl mx-auto text-center">
                <h3 class="text-3xl md:text-4xl font-black uppercase mb-12">
                    Por que usar o Filament Wallet?
                </h3>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <div class="p-6">
                        <div class="text-5xl font-black text-lime-400 mb-2">100%</div>
                        <div class="text-sm uppercase tracking-wider text-zinc-400">Gratuito</div>
                    </div>
                    <div class="p-6">
                        <div class="text-5xl font-black text-cyan-400 mb-2">0</div>
                        <div class="text-sm uppercase tracking-wider text-zinc-400">Taxas Ocultas</div>
                    </div>
                    <div class="p-6">
                        <div class="text-5xl font-black text-fuchsia-500 mb-2">∞</div>
                        <div class="text-sm uppercase tracking-wider text-zinc-400">Transações</div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Call to action melhorado -->
        <section class="relative z-10 px-6 py-32 bg-zinc-100 text-zinc-950">
            <div class="max-w-4xl mx-auto text-center">
                <h3 class="text-4xl md:text-6xl font-black uppercase mb-6 leading-tight">
                    Comece a controlar suas finanças
                    <span class="block text-lime-600">agora mesmo</span>
                </h3>
                <p class="text-lg text-zinc-600 mb-10 max-w-2xl mx-auto">
                    Cadastre-se gratuitamente e tenha acesso a todas as funcionalidades sem limitações.
                </p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center items-center">
                    <a href="{{ route('web.register') }}"
                        class="inline-block bg-zinc-950 text-zinc-100 px-12 py-5 font-black uppercase shadow-[8px_8px_0_0_#000] hover:shadow-[3px_3px_0_0_#000] hover:-translate-x-1 hover:-translate-y-1 transition-all duration-200">
                        Criar minha carteira
                    </a>
                    <a href="{{ route('web.home') }}"
                        class="inline-block border-4 border-zinc-950 text-zinc-950 px-12 py-5 font-black uppercase hover:bg-zinc-950 hover:text-zinc-100 transition-all duration-200">
                        Voltar ao início
                    </a>
                </div>
            </div>
        </section>

        <!-- Footer -->
        <x-layout.footer />
    </div>
</x-layout.main-layout>