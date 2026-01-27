{{-- resources/views/expenses/details.blade.php --}}

<x-layout.main-layout title="Detalhes da Movimentação">
    <div class="min-h-screen relative overflow-hidden bg-zinc-950">

        <!-- Background brutal shapes -->
        <div class="pointer-events-none fixed inset-0">
            <div class="absolute -top-32 -left-32 w-[40rem] h-[40rem] bg-lime-500/20 rotate-12"></div>
            <div class="absolute top-1/3 -right-40 w-[35rem] h-[35rem] bg-fuchsia-600/20 -rotate-12"></div>
            <div class="absolute bottom-0 left-1/4 w-[50rem] h-[20rem] bg-cyan-400/10 skew-y-6"></div>
        </div>

        <!-- Header -->
        <x-layout.header />

        <!-- Main Content -->
        <section class="relative z-10 px-4 sm:px-6 py-8 sm:py-16 pb-24 sm:pb-16">
            <!-- Breadcrumb -->
            <div class="mb-4 sm:mb-6">
                <a href="{{ route('web.dashboard') }}"
                    class="inline-flex items-center gap-2 text-zinc-400 hover:text-lime-400 transition-colors font-bold uppercase text-xs sm:text-sm group">
                    <svg class="w-4 h-4 group-hover:-translate-x-1 transition-transform" fill="none"
                        stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                    </svg>
                    Voltar ao Dashboard
                </a>
            </div>

            <!-- Page Title -->
            <div class="mb-6 sm:mb-8">
                <h1 class="text-3xl sm:text-4xl md:text-5xl font-black text-white uppercase mb-2">
                    Detalhes da Movimentação
                </h1>
                <div class="w-20 sm:w-24 h-2 bg-lime-400"></div>
            </div>

            <!-- Main Card -->
            <div class="max-w-4xl">
                <!-- Header Card com Valor Destacado -->
                <div
                    class="border-4 border-zinc-100 p-4 sm:p-6 md:p-8 bg-zinc-900 shadow-[8px_8px_0_0_#000] sm:shadow-[12px_12px_0_0_#000] mb-4 sm:mb-6">
                    <div class="flex flex-col gap-4 sm:gap-6">
                        <!-- Título e Status Indicator -->
                        <div class="flex-1">
                            <div class="flex items-start gap-2 sm:gap-3 mb-3 sm:mb-4">
                                <div
                                    class="w-3 h-3 mt-1.5 sm:mt-2 rounded-full flex-shrink-0 {{ $expense->status === 'paid' ? 'bg-lime-400' : ($expense->status === 'overdue' ? 'bg-red-500' : 'bg-yellow-400') }}">
                                </div>
                                <h2 class="text-xl sm:text-2xl md:text-3xl font-black text-white break-words">
                                    {{ $expense->title }}
                                </h2>
                            </div>

                            <!-- Tipo Badge -->
                            <div class="inline-flex items-center gap-2">
                                @if ($expense->type === 'expense')
                                    <span
                                        class="inline-flex items-center gap-1.5 sm:gap-2 px-3 sm:px-4 py-1.5 sm:py-2 bg-red-500/20 border-2 border-red-500 text-red-400 text-xs sm:text-sm font-black uppercase">
                                        <svg class="w-3 h-3 sm:w-4 sm:h-4" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M19 14l-7 7m0 0l-7-7m7 7V3" />
                                        </svg>
                                        Despesa
                                    </span>
                                @else
                                    <span
                                        class="inline-flex items-center gap-1.5 sm:gap-2 px-3 sm:px-4 py-1.5 sm:py-2 bg-lime-400/20 border-2 border-lime-400 text-lime-400 text-xs sm:text-sm font-black uppercase">
                                        <svg class="w-3 h-3 sm:w-4 sm:h-4" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M5 10l7-7m0 0l7 7m-7-7v18" />
                                        </svg>
                                        Entrada
                                    </span>
                                @endif
                            </div>
                        </div>

                        <!-- Valor Destacado - Mobile Friendly -->
                        <div class="pt-4 border-t-4 sm:border-t-0 sm:border-l-4 border-zinc-700 sm:pl-6">
                            <p class="text-zinc-400 font-bold text-xs sm:text-sm uppercase mb-2">Valor Total</p>
                            <p
                                class="text-3xl sm:text-4xl md:text-5xl font-black tabular-nums {{ $expense->type === 'expense' ? 'text-red-400' : 'text-lime-400' }} break-all">
                                {{ $expense->type === 'expense' ? '- ' : '+ ' }}R$ {{ $expense->amount }}
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Informações Principais -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 sm:gap-6 mb-4 sm:mb-6">
                    <!-- Status -->
                    <div
                        class="border-4 border-zinc-100 p-4 sm:p-6 bg-zinc-900 shadow-[6px_6px_0_0_#000] sm:shadow-[8px_8px_0_0_#000]">
                        <p class="text-zinc-400 font-bold text-xs sm:text-sm uppercase mb-2 sm:mb-3">Status</p>
                        @if ($expense->status === 'paid')
                            <span
                                class="inline-flex items-center gap-1.5 sm:gap-2 px-3 sm:px-4 py-1.5 sm:py-2 bg-lime-400/20 border-2 border-lime-400 text-lime-400 text-sm sm:text-base font-black uppercase">
                                <svg class="w-4 h-4 sm:w-5 sm:h-5 flex-shrink-0" fill="currentColor"
                                    viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                        clip-rule="evenodd" />
                                </svg>
                                Pago
                            </span>
                        @elseif($expense->status === 'overdue')
                            <span
                                class="inline-flex items-center gap-1.5 sm:gap-2 px-3 sm:px-4 py-1.5 sm:py-2 bg-red-500/20 border-2 border-red-500 text-red-400 text-sm sm:text-base font-black uppercase">
                                <svg class="w-4 h-4 sm:w-5 sm:h-5 flex-shrink-0" fill="currentColor"
                                    viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                                        clip-rule="evenodd" />
                                </svg>
                                Em Atraso
                            </span>
                        @else
                            <span
                                class="inline-flex items-center gap-1.5 sm:gap-2 px-3 sm:px-4 py-1.5 sm:py-2 bg-yellow-400/20 border-2 border-yellow-400 text-yellow-400 text-sm sm:text-base font-black uppercase">
                                <svg class="w-4 h-4 sm:w-5 sm:h-5 flex-shrink-0" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                Pendente
                            </span>
                        @endif
                    </div>

                    <!-- Categoria -->
                    <div
                        class="border-4 border-zinc-100 p-4 sm:p-6 bg-zinc-900 shadow-[6px_6px_0_0_#000] sm:shadow-[8px_8px_0_0_#000]">
                        <p class="text-zinc-400 font-bold text-xs sm:text-sm uppercase mb-2 sm:mb-3">Categoria</p>
                        <span
                            class="inline-block px-3 sm:px-4 py-1.5 sm:py-2 bg-cyan-400/20 border-2 border-cyan-400 text-cyan-400 text-sm sm:text-base font-black uppercase break-words">
                            {{ $expense->category->name ?? 'Sem categoria' }}
                        </span>
                    </div>
                </div>

                <!-- Datas -->
                <div
                    class="border-4 border-zinc-100 p-4 sm:p-6 md:p-8 bg-zinc-900 shadow-[6px_6px_0_0_#000] sm:shadow-[12px_12px_0_0_#000] mb-4 sm:mb-6">
                    <h3
                        class="text-lg sm:text-xl font-black text-white uppercase mb-4 sm:mb-6 flex items-center gap-2 sm:gap-3">
                        <svg class="w-5 h-5 sm:w-6 sm:h-6 text-lime-400 flex-shrink-0" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                        <span class="text-sm sm:text-lg md:text-xl">Informações de Data</span>
                    </h3>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 sm:gap-6">
                        <!-- Vencimento -->
                        <div class="space-y-1.5 sm:space-y-2 p-3 sm:p-0 bg-zinc-950/50 sm:bg-transparent rounded">
                            <p class="text-zinc-400 font-bold text-xs sm:text-sm uppercase">Data de Vencimento</p>
                            <p class="text-white text-lg sm:text-xl font-bold">
                                @if (!empty($expense->due_date))
                                    {{ \Carbon\Carbon::createFromFormat('d/m/Y', $expense->due_date)->format('d/m/Y') }}
                                @else
                                    <span class="text-zinc-600 text-base sm:text-xl">Não definida</span>
                                @endif


                            </p>
                        </div>

                        <!-- Pagamento -->
                        <div class="space-y-1.5 sm:space-y-2 p-3 sm:p-0 bg-zinc-950/50 sm:bg-transparent rounded">
                            <p class="text-zinc-400 font-bold text-xs sm:text-sm uppercase">Data de Pagamento</p>
                            <p class="text-white text-lg sm:text-xl font-bold">
                                @if (!empty($expense->payment_date))
                                    {{ \Carbon\Carbon::createFromFormat('d/m/Y', $expense->payment_date)->format('d/m/Y') }}
                                @else
                                    <span class="text-zinc-600 text-base sm:text-xl">Não definida</span>
                                @endif

                            </p>
                        </div>
                    </div>
                </div>

                <!-- Actions - Sticky no Mobile -->
                <div
                    class="fixed sm:relative bottom-0 left-0 right-0 sm:bottom-auto sm:left-auto sm:right-auto bg-zinc-950 sm:bg-transparent p-4 sm:p-0 border-t-4 sm:border-t-0 border-zinc-800 z-20">
                    <div class="flex flex-col sm:flex-row gap-3 sm:gap-4 max-w-4xl mx-auto">
                        <a href="{{ route('web.dashboard') }}"
                            class="group flex-1 bg-zinc-800 text-white px-6 sm:px-8 py-3 sm:py-4 font-black uppercase text-center text-sm sm:text-base shadow-[4px_4px_0_0_#000] sm:shadow-[6px_6px_0_0_#000] hover:shadow-[2px_2px_0_0_#000] hover:-translate-x-0.5 hover:-translate-y-0.5 sm:hover:-translate-x-1 sm:hover:-translate-y-1 transition-all duration-200 inline-flex items-center justify-center gap-2 active:shadow-[1px_1px_0_0_#000] active:translate-x-0 active:translate-y-0">
                            <svg class="w-4 h-4 sm:w-5 sm:h-5 group-hover:-translate-x-1 transition-transform flex-shrink-0"
                                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                            </svg>
                            Voltar
                        </a>

                        <button
                            onclick="window.location='{{ route('web.expenses.edit', ['id' => Crypt::encrypt($expense->id)]) }}'"
                            class="group flex-1 bg-lime-400 text-zinc-950 px-6 sm:px-8 py-3 sm:py-4 font-black uppercase text-sm sm:text-base shadow-[4px_4px_0_0_#000] sm:shadow-[6px_6px_0_0_#000] hover:shadow-[2px_2px_0_0_#000] hover:-translate-x-0.5 hover:-translate-y-0.5 sm:hover:-translate-x-1 sm:hover:-translate-y-1 transition-all duration-200 inline-flex items-center justify-center gap-2 active:shadow-[1px_1px_0_0_#000] active:translate-x-0 active:translate-y-0">
                            <svg class="w-4 h-4 sm:w-5 sm:h-5 group-hover:rotate-12 transition-transform flex-shrink-0"
                                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                            </svg>
                            <span class="truncate">Editar Movimentação</span>
                        </button>
                    </div>
                </div>
            </div>
        </section>

        <!-- Footer -->
        <x-layout.footer />
    </div>
</x-layout.main-layout>
