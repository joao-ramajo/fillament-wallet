<x-layout.main-layout title="Guia de uso">

    <x-layout.header />

    <x-bricks />

    <section class="mt-24 relative">
        <!-- Background decorativo -->
        <div class="absolute inset-0 pointer-events-none opacity-5">
            <div class="absolute top-0 right-0 w-64 h-64 bg-lime-400 blur-3xl"></div>
            <div class="absolute bottom-0 left-0 w-64 h-64 bg-red-500 blur-3xl"></div>
        </div>

        <div class="max-w-6xl mx-auto px-6 relative z-10">
            <!-- Header -->
            <div class="mb-12 text-center">
                <span
                    class="inline-block px-4 py-2 bg-zinc-900 border border-zinc-700 text-lime-400 text-xs font-black uppercase tracking-wider mb-4">
                    Entenda o Projeto
                </span>
                <h2 class="text-4xl md:text-6xl font-black uppercase text-white mb-4 leading-tight">
                    Para quem é <span class="text-lime-400">esta plataforma</span>
                </h2>
                <p class="text-zinc-400 text-lg max-w-2xl mx-auto">
                    Antes de começar, é importante saber se o Filament Wallet atende suas necessidades
                </p>
            </div>

            <div class="grid md:grid-cols-2 gap-8">
                <!-- Coluna: Ideal para (POSITIVO) -->
                <div
                    class="group border-4 border-lime-400 bg-zinc-900/50 backdrop-blur-sm p-8 shadow-[8px_8px_0_0_rgba(132,204,22,0.3)] hover:shadow-[4px_4px_0_0_rgba(132,204,22,0.5)] hover:-translate-x-1 hover:-translate-y-1 transition-all duration-300">
                    <!-- Header do card -->
                    <div class="flex items-center gap-4 mb-6 pb-4 border-b-2 border-lime-400/30">
                        <div
                            class="flex-shrink-0 w-14 h-14 bg-lime-400 flex items-center justify-center shadow-[4px_4px_0_0_#000]">
                            <svg class="w-8 h-8 text-zinc-950" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                    clip-rule="evenodd" />
                            </svg>
                        </div>
                        <h3 class="text-2xl md:text-3xl font-black uppercase text-lime-400">
                            Ideal para
                        </h3>
                    </div>

                    <ul class="space-y-4">
                        <li class="flex items-start gap-3 group/item">
                            <div
                                class="flex-shrink-0 w-6 h-6 bg-lime-400/20 border-2 border-lime-400 flex items-center justify-center mt-0.5">
                                <svg class="w-3 h-3 text-lime-400" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>
                            <p class="text-zinc-200 leading-relaxed group-hover/item:text-zinc-100 transition-colors">
                                Pessoas que querem <strong class="text-lime-400">controle simples e direto</strong> das
                                próprias finanças
                            </p>
                        </li>

                        <li class="flex items-start gap-3 group/item">
                            <div
                                class="flex-shrink-0 w-6 h-6 bg-lime-400/20 border-2 border-lime-400 flex items-center justify-center mt-0.5">
                                <svg class="w-3 h-3 text-lime-400" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>
                            <p class="text-zinc-200 leading-relaxed group-hover/item:text-zinc-100 transition-colors">
                                Quem já usava <strong class="text-lime-400">planilhas</strong> e quer algo mais prático,
                                sem perder controle
                            </p>
                        </li>

                        <li class="flex items-start gap-3 group/item">
                            <div
                                class="flex-shrink-0 w-6 h-6 bg-lime-400/20 border-2 border-lime-400 flex items-center justify-center mt-0.5">
                                <svg class="w-3 h-3 text-lime-400" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>
                            <p class="text-zinc-200 leading-relaxed group-hover/item:text-zinc-100 transition-colors">
                                Usuários que preferem <strong class="text-lime-400">organização manual</strong>, sem
                                automações complexas
                            </p>
                        </li>

                        <li class="flex items-start gap-3 group/item">
                            <div
                                class="flex-shrink-0 w-6 h-6 bg-lime-400/20 border-2 border-lime-400 flex items-center justify-center mt-0.5">
                                <svg class="w-3 h-3 text-lime-400" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>
                            <p class="text-zinc-200 leading-relaxed group-hover/item:text-zinc-100 transition-colors">
                                Quem quer registrar <strong class="text-lime-400">entradas, despesas e
                                    categorias</strong> de forma clara
                            </p>
                        </li>

                        <li class="flex items-start gap-3 group/item">
                            <div
                                class="flex-shrink-0 w-6 h-6 bg-lime-400/20 border-2 border-lime-400 flex items-center justify-center mt-0.5">
                                <svg class="w-3 h-3 text-lime-400" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>
                            <p class="text-zinc-200 leading-relaxed group-hover/item:text-zinc-100 transition-colors">
                                Quem usa <strong class="text-lime-400">múltiplas contas</strong> (Picpay, Next, Nubank)
                                e quer unificar tudo
                            </p>
                        </li>
                    </ul>
                </div>

                <!-- Coluna: Não é para (NEGATIVO) -->
                <div
                    class="group border-4 border-red-500 bg-zinc-900/50 backdrop-blur-sm p-8 shadow-[8px_8px_0_0_rgba(239,68,68,0.3)] hover:shadow-[4px_4px_0_0_rgba(239,68,68,0.5)] hover:-translate-x-1 hover:-translate-y-1 transition-all duration-300">
                    <!-- Header do card -->
                    <div class="flex items-center gap-4 mb-6 pb-4 border-b-2 border-red-500/30">
                        <div
                            class="flex-shrink-0 w-14 h-14 bg-red-500 flex items-center justify-center shadow-[4px_4px_0_0_#000]">
                            <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                                    clip-rule="evenodd" />
                            </svg>
                        </div>
                        <h3 class="text-2xl md:text-3xl font-black uppercase text-red-400">
                            Não é para você se
                        </h3>
                    </div>

                    <ul class="space-y-4">
                        <li class="flex items-start gap-3 group/item">
                            <div
                                class="flex-shrink-0 w-6 h-6 bg-red-500/20 border-2 border-red-500 flex items-center justify-center mt-0.5">
                                <svg class="w-3 h-3 text-red-400" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>
                            <p class="text-zinc-200 leading-relaxed group-hover/item:text-zinc-100 transition-colors">
                                Você espera <strong class="text-red-400">conexão automática com bancos</strong> ou
                                leitura de extratos em tempo real
                            </p>
                        </li>

                        <li class="flex items-start gap-3 group/item">
                            <div
                                class="flex-shrink-0 w-6 h-6 bg-red-500/20 border-2 border-red-500 flex items-center justify-center mt-0.5">
                                <svg class="w-3 h-3 text-red-400" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>
                            <p class="text-zinc-200 leading-relaxed group-hover/item:text-zinc-100 transition-colors">
                                Procura um sistema de <strong class="text-red-400">investimentos, cartões ou
                                    crédito</strong>
                            </p>
                        </li>

                        <li class="flex items-start gap-3 group/item">
                            <div
                                class="flex-shrink-0 w-6 h-6 bg-red-500/20 border-2 border-red-500 flex items-center justify-center mt-0.5">
                                <svg class="w-3 h-3 text-red-400" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>
                            <p class="text-zinc-200 leading-relaxed group-hover/item:text-zinc-100 transition-colors">
                                Quer <strong class="text-red-400">relatórios financeiros avançados</strong> ou
                                previsões automáticas complexas
                            </p>
                        </li>

                        <li class="flex items-start gap-3 group/item">
                            <div
                                class="flex-shrink-0 w-6 h-6 bg-red-500/20 border-2 border-red-500 flex items-center justify-center mt-0.5">
                                <svg class="w-3 h-3 text-red-400" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>
                            <p class="text-zinc-200 leading-relaxed group-hover/item:text-zinc-100 transition-colors">
                                Prefere um aplicativo que faça <strong class="text-red-400">tudo sozinho</strong> sem
                                sua intervenção
                            </p>
                        </li>

                        <li class="flex items-start gap-3 group/item">
                            <div
                                class="flex-shrink-0 w-6 h-6 bg-red-500/20 border-2 border-red-500 flex items-center justify-center mt-0.5">
                                <svg class="w-3 h-3 text-red-400" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>
                            <p class="text-zinc-200 leading-relaxed group-hover/item:text-zinc-100 transition-colors">
                                Busca <strong class="text-red-400">gamificação, ranking</strong> ou recursos sociais de
                                compartilhamento
                            </p>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Observação destacada -->
            <div
                class="mt-12 bg-gradient-to-r from-zinc-900 to-zinc-800 border-l-4 border-lime-400 p-8 shadow-[4px_4px_0_0_#000]">
                <div class="flex items-start gap-4">
                    <div class="flex-shrink-0 w-12 h-12 bg-lime-400 flex items-center justify-center">
                        <svg class="w-6 h-6 text-zinc-950" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                                clip-rule="evenodd" />
                        </svg>
                    </div>
                    <div class="flex-1">
                        <h4 class="text-xl font-black uppercase text-lime-400 mb-3">
                            Nossa Filosofia
                        </h4>
                        <p class="text-zinc-300 leading-relaxed text-lg">
                            A proposta aqui é <strong class="text-white">controle consciente</strong>.
                            Você decide o que entra, como categoriza e quando registra.
                            Sem esconder nada atrás de automações.
                            <span class="text-lime-400 font-bold">Transparência total, controle nas suas mãos.</span>
                        </p>
                    </div>
                </div>
            </div>

            <!-- CTA opcional -->
            <div class="mt-12 text-center">
                <p class="text-zinc-400 mb-6">Se identificou com o perfil? Comece agora mesmo</p>
                <a href="{{ route('web.register') }}"
                    class="inline-block bg-lime-400 text-zinc-950 px-10 py-4 font-black uppercase shadow-[6px_6px_0_0_#000] hover:shadow-[3px_3px_0_0_#000] hover:-translate-x-1 hover:-translate-y-1 transition-all duration-200">
                    Criar Minha Conta Gratuita
                </a>
            </div>
        </div>
    </section>

    <section class="mt-24 relative pb-24">
        <!-- Background decorativo -->
        <div class="absolute inset-0 pointer-events-none opacity-5">
            <div class="absolute top-1/2 left-0 w-96 h-96 bg-lime-400 blur-3xl"></div>
        </div>

        <div class="max-w-7xl mx-auto px-6 relative z-10">
            <!-- Header -->
            <div class="mb-12">
                <span
                    class="inline-block px-4 py-2 bg-zinc-900 border border-zinc-700 text-lime-400 text-xs font-black uppercase tracking-wider mb-4">
                    Guia Rápido
                </span>
                <h2 class="text-4xl md:text-6xl font-black uppercase text-white mb-4 leading-tight">
                    Como <span class="text-lime-400">começar</span>
                </h2>
                <p class="text-zinc-400 text-lg max-w-2xl">
                    Siga estes passos simples para começar a controlar suas finanças
                </p>
            </div>

            <!-- Step 1: Cadastro -->
            <div class="mb-12">
                <div class="flex items-center gap-4 mb-6">
                    <div
                        class="w-12 h-12 bg-lime-400 flex items-center justify-center font-black text-2xl text-zinc-950 shadow-[4px_4px_0_0_#000]">
                        1
                    </div>
                    <h3 class="text-3xl md:text-4xl font-black uppercase text-lime-400">
                        Criando sua conta
                    </h3>
                </div>

                <div class="grid md:grid-cols-2 gap-8 items-start">
                    <!-- Conteúdo -->
                    <div
                        class="border-4 border-lime-400 p-8 bg-zinc-900/50 backdrop-blur-sm shadow-[6px_6px_0_0_rgba(132,204,22,0.3)]">
                        <div class="space-y-4">
                            <p class="text-zinc-200 leading-relaxed text-lg">
                                Para começar, acesse a página de <strong class="text-lime-400">cadastro</strong> e crie
                                sua conta em menos de 1 minuto.
                            </p>

                            <div class="flex items-start gap-3 bg-zinc-950/50 p-4 border-l-4 border-lime-400">
                                <svg class="w-6 h-6 text-lime-400 flex-shrink-0 mt-0.5" fill="currentColor"
                                    viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                                        clip-rule="evenodd" />
                                </svg>
                                <div>
                                    <p class="text-zinc-300 leading-relaxed">
                                        Após concluir o cadastro e realizar o <strong
                                            class="text-white">login</strong>, você terá acesso imediato ao sistema.
                                    </p>
                                </div>
                            </div>

                            <div class="pt-4 border-t border-zinc-800">
                                <p class="text-zinc-400 text-sm mb-3 uppercase font-bold tracking-wider">
                                    Áreas disponíveis:
                                </p>
                                <div class="flex flex-wrap gap-3">
                                    <span
                                        class="px-4 py-2 bg-zinc-950 border-2 border-lime-400 text-lime-400 text-sm font-bold">
                                        📱 Painel de Controle
                                    </span>
                                    <span
                                        class="px-4 py-2 bg-zinc-950 border-2 border-cyan-400 text-cyan-400 text-sm font-bold">
                                        🖥️ Dashboard
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Screenshot -->
                    <div class="relative group">
                        <div
                            class="absolute -inset-1 bg-gradient-to-r from-lime-400 to-cyan-400 opacity-20 blur-lg group-hover:opacity-30 transition-opacity">
                        </div>
                        <div class="relative border-4 border-zinc-800 shadow-[8px_8px_0_0_#000] overflow-hidden">
                            <img src="{{  asset('assets/img/tela-de-cadastro.png') }}"
                                alt="Tela de Cadastro"
                                class="w-full h-auto grayscale hover:grayscale-0 transition-all duration-300">
                            <div
                                class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-zinc-950 to-transparent p-4">
                                <p class="text-zinc-400 text-sm font-bold">Tela de Cadastro</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Step 2: Painel de Controle -->
            <div class="mb-12">
                <div class="flex items-center gap-4 mb-6">
                    <div
                        class="w-12 h-12 bg-cyan-400 flex items-center justify-center font-black text-2xl text-zinc-950 shadow-[4px_4px_0_0_#000]">
                        2
                    </div>
                    <h3 class="text-3xl md:text-4xl font-black uppercase text-cyan-400">
                        Painel de Controle
                    </h3>
                </div>

                <div class="grid md:grid-cols-2 gap-8 items-start">
                    <!-- Screenshot -->
                    <div class="relative group order-2 md:order-1">
                        <div
                            class="absolute -inset-1 bg-gradient-to-r from-cyan-400 to-blue-400 opacity-20 blur-lg group-hover:opacity-30 transition-opacity">
                        </div>
                        <div class="relative border-4 border-zinc-800 shadow-[8px_8px_0_0_#000] overflow-hidden">
                            <img src="{{ asset('assets/img/paingel-de-controle.png') }}"
                                alt="Painel de Controle"
                                class="w-full h-auto grayscale hover:grayscale-0 transition-all duration-300">
                            <div
                                class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-zinc-950 to-transparent p-4">
                                <p class="text-zinc-400 text-sm font-bold">Painel de Controle</p>
                            </div>
                        </div>
                    </div>

                    <!-- Conteúdo -->
                    <div
                        class="border-4 border-cyan-400 p-8 bg-zinc-900/50 backdrop-blur-sm shadow-[6px_6px_0_0_rgba(34,211,238,0.3)] order-1 md:order-2">
                        <div class="mb-6">
                            <span
                                class="inline-block px-3 py-1 bg-cyan-400/20 border border-cyan-400 text-cyan-400 text-xs font-black uppercase mb-4">
                                Acesso Rápido
                            </span>
                            <p class="text-zinc-200 leading-relaxed text-lg">
                                O Painel de Controle foi pensado para ser <strong class="text-cyan-400">rápido, direto
                                    e objetivo</strong>.
                            </p>
                        </div>

                        <div class="space-y-3">
                            <div class="flex items-start gap-3 bg-zinc-950/50 p-4 hover:bg-zinc-950 transition-colors">
                                <div
                                    class="flex-shrink-0 w-8 h-8 bg-cyan-400/20 border-2 border-cyan-400 flex items-center justify-center">
                                    <svg class="w-4 h-4 text-cyan-400" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M10 12a2 2 0 100-4 2 2 0 000 4z" />
                                        <path fill-rule="evenodd"
                                            d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-white font-bold mb-1">Visualização Resumida</p>
                                    <p class="text-zinc-400 text-sm">Veja rapidamente suas informações financeiras
                                        principais</p>
                                </div>
                            </div>

                            <div class="flex items-start gap-3 bg-zinc-950/50 p-4 hover:bg-zinc-950 transition-colors">
                                <div
                                    class="flex-shrink-0 w-8 h-8 bg-cyan-400/20 border-2 border-cyan-400 flex items-center justify-center">
                                    <svg class="w-4 h-4 text-cyan-400" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-white font-bold mb-1">Adição Rápida</p>
                                    <p class="text-zinc-400 text-sm">Registre uma nova despesa em segundos</p>
                                </div>
                            </div>

                            <div class="flex items-start gap-3 bg-zinc-950/50 p-4 hover:bg-zinc-950 transition-colors">
                                <div
                                    class="flex-shrink-0 w-8 h-8 bg-cyan-400/20 border-2 border-cyan-400 flex items-center justify-center">
                                    <svg class="w-4 h-4 text-cyan-400" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-white font-bold mb-1">Últimos Registros</p>
                                    <p class="text-zinc-400 text-sm">Consulte suas transações mais recentes</p>
                                </div>
                            </div>
                        </div>

                        <div class="mt-6 pt-6 border-t border-cyan-400/30">
                            <div class="flex items-center gap-2 text-cyan-400">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                    <path
                                        d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 5V3z" />
                                </svg>
                                <p class="text-sm font-bold">Ideal para acesso pelo celular ou verificação rápida</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Step 3: Dashboard -->
            <div class="mb-12">
                <div class="flex items-center gap-4 mb-6">
                    <div
                        class="w-12 h-12 bg-fuchsia-500 flex items-center justify-center font-black text-2xl text-white shadow-[4px_4px_0_0_#000]">
                        3
                    </div>
                    <h3 class="text-3xl md:text-4xl font-black uppercase text-fuchsia-400">
                        Dashboard Completo
                    </h3>
                </div>

                <div class="grid md:grid-cols-2 gap-8 items-start">
                    <!-- Conteúdo -->
                    <div
                        class="border-4 border-fuchsia-500 p-8 bg-zinc-900/50 backdrop-blur-sm shadow-[6px_6px_0_0_rgba(232,121,249,0.3)]">
                        <div class="mb-6">
                            <span
                                class="inline-block px-3 py-1 bg-fuchsia-500/20 border border-fuchsia-500 text-fuchsia-400 text-xs font-black uppercase mb-4">
                                Gestão Avançada
                            </span>
                            <p class="text-zinc-200 leading-relaxed text-lg">
                                O Dashboard oferece uma visão <strong class="text-fuchsia-400">completa e
                                    detalhada</strong> do sistema, com acesso a funcionalidades avançadas.
                            </p>
                        </div>

                        <div class="space-y-3">
                            <div class="flex items-start gap-3 bg-zinc-950/50 p-4 hover:bg-zinc-950 transition-colors">
                                <div
                                    class="flex-shrink-0 w-8 h-8 bg-fuchsia-500/20 border-2 border-fuchsia-500 flex items-center justify-center">
                                    <svg class="w-4 h-4 text-fuchsia-400" fill="currentColor" viewBox="0 0 20 20">
                                        <path
                                            d="M7 3a1 1 0 000 2h6a1 1 0 100-2H7zM4 7a1 1 0 011-1h10a1 1 0 110 2H5a1 1 0 01-1-1zM2 11a2 2 0 012-2h12a2 2 0 012 2v4a2 2 0 01-2 2H4a2 2 0 01-2-2v-4z" />
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-white font-bold mb-1">Gerenciamento de Categorias</p>
                                    <p class="text-zinc-400 text-sm">Organize com categorias globais e pessoais</p>
                                </div>
                            </div>

                            <div class="flex items-start gap-3 bg-zinc-950/50 p-4 hover:bg-zinc-950 transition-colors">
                                <div
                                    class="flex-shrink-0 w-8 h-8 bg-fuchsia-500/20 border-2 border-fuchsia-500 flex items-center justify-center">
                                    <svg class="w-4 h-4 text-fuchsia-400" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M4 4a2 2 0 00-2 2v4a2 2 0 002 2V6h10a2 2 0 00-2-2H4zm2 6a2 2 0 012-2h8a2 2 0 012 2v4a2 2 0 01-2 2H8a2 2 0 01-2-2v-4zm6 4a2 2 0 100-4 2 2 0 000 4z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-white font-bold mb-1">Contas Bancárias</p>
                                    <p class="text-zinc-400 text-sm">Cadastre e gerencie todas suas contas</p>
                                </div>
                            </div>

                            <div class="flex items-start gap-3 bg-zinc-950/50 p-4 hover:bg-zinc-950 transition-colors">
                                <div
                                    class="flex-shrink-0 w-8 h-8 bg-fuchsia-500/20 border-2 border-fuchsia-500 flex items-center justify-center">
                                    <svg class="w-4 h-4 text-fuchsia-400" fill="currentColor" viewBox="0 0 20 20">
                                        <path
                                            d="M8.433 7.418c.155-.103.346-.196.567-.267v1.698a2.305 2.305 0 01-.567-.267C8.07 8.34 8 8.114 8 8c0-.114.07-.34.433-.582zM11 12.849v-1.698c.22.071.412.164.567.267.364.243.433.468.433.582 0 .114-.07.34-.433.582a2.305 2.305 0 01-.567.267z" />
                                        <path fill-rule="evenodd"
                                            d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-13a1 1 0 10-2 0v.092a4.535 4.535 0 00-1.676.662C6.602 6.234 6 7.009 6 8c0 .99.602 1.765 1.324 2.246.48.32 1.054.545 1.676.662v1.941c-.391-.127-.68-.317-.843-.504a1 1 0 10-1.51 1.31c.562.649 1.413 1.076 2.353 1.253V15a1 1 0 102 0v-.092a4.535 4.535 0 001.676-.662C13.398 13.766 14 12.991 14 12c0-.99-.602-1.765-1.324-2.246A4.535 4.535 0 0011 9.092V7.151c.391.127.68.317.843.504a1 1 0 101.511-1.31c-.563-.649-1.413-1.076-2.354-1.253V5z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-white font-bold mb-1">Controle Total</p>
                                    <p class="text-zinc-400 text-sm">Gerencie todas despesas e entradas com filtros
                                        avançados</p>
                                </div>
                            </div>

                            <div class="flex items-start gap-3 bg-zinc-950/50 p-4 hover:bg-zinc-950 transition-colors">
                                <div
                                    class="flex-shrink-0 w-8 h-8 bg-fuchsia-500/20 border-2 border-fuchsia-500 flex items-center justify-center">
                                    <svg class="w-4 h-4 text-fuchsia-400" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M11.49 3.17c-.38-1.56-2.6-1.56-2.98 0a1.532 1.532 0 01-2.286.948c-1.372-.836-2.942.734-2.106 2.106.54.886.061 2.042-.947 2.287-1.561.379-1.561 2.6 0 2.978a1.532 1.532 0 01.947 2.287c-.836 1.372.734 2.942 2.106 2.106a1.532 1.532 0 012.287.947c.379 1.561 2.6 1.561 2.978 0a1.533 1.533 0 012.287-.947c1.372.836 2.942-.734 2.106-2.106a1.533 1.533 0 01.947-2.287c1.561-.379 1.561-2.6 0-2.978a1.532 1.532 0 01-.947-2.287c.836-1.372-.734-2.942-2.106-2.106a1.532 1.532 0 01-2.287-.947zM10 13a3 3 0 100-6 3 3 0 000 6z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-white font-bold mb-1">Recursos Extras</p>
                                    <p class="text-zinc-400 text-sm">Acesso a configurações e funcionalidades
                                        adicionais</p>
                                </div>
                            </div>
                        </div>

                        <div class="mt-6 pt-6 border-t border-fuchsia-500/30">
                            <div class="flex items-center gap-2 text-fuchsia-400">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                    <path
                                        d="M3 12v3c0 1.657 3.134 3 7 3s7-1.343 7-3v-3c0 1.657-3.134 3-7 3s-7-1.343-7-3z" />
                                    <path
                                        d="M3 7v3c0 1.657 3.134 3 7 3s7-1.343 7-3V7c0 1.657-3.134 3-7 3S3 8.657 3 7z" />
                                    <path d="M17 5c0 1.657-3.134 3-7 3S3 6.657 3 5s3.134-3 7-3 7 1.343 7 3z" />
                                </svg>
                                <p class="text-sm font-bold">Recomendado para organização detalhada e gestão completa
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Screenshot -->
                    <div class="relative group">
                        <div
                            class="absolute -inset-1 bg-gradient-to-r from-fuchsia-500 to-purple-500 opacity-20 blur-lg group-hover:opacity-30 transition-opacity">
                        </div>
                        <div class="relative border-4 border-zinc-800 shadow-[8px_8px_0_0_#000] overflow-hidden">
                            <img src="{{  asset('assets/img/dashboard.png') }}"
                                alt="Dashboard Completo"
                                class="w-full h-auto grayscale hover:grayscale-0 transition-all duration-300">
                            <div
                                class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-zinc-950 to-transparent p-4">
                                <p class="text-zinc-400 text-sm font-bold">Dashboard com Gestão Avançada</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- CTA Final -->
            <div
                class="mt-16 text-center bg-gradient-to-r from-zinc-900 to-zinc-800 border-4 border-lime-400 p-12 shadow-[8px_8px_0_0_#000]">
                <h4 class="text-3xl font-black uppercase text-white mb-4">
                    Pronto para começar?
                </h4>
                <p class="text-zinc-300 mb-8 max-w-2xl mx-auto text-lg">
                    Crie sua conta gratuita agora e tenha controle total sobre suas finanças em minutos
                </p>
                <a href="{{ route('web.register') }}"
                    class="inline-block bg-lime-400 text-zinc-950 px-12 py-5 font-black uppercase text-lg shadow-[6px_6px_0_0_#000] hover:shadow-[3px_3px_0_0_#000] hover:-translate-x-1 hover:-translate-y-1 transition-all duration-200">
                    Criar Conta Gratuita
                </a>
            </div>
        </div>
    </section>

    <x-layout.footer />

</x-layout.main-layout>
