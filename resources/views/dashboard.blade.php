<x-layout.main-layout title="Dashboard">
    <div class="min-h-screen relative overflow-hidden">

        <!-- Background brutal shapes -->
        <div class="pointer-events-none fixed inset-0">
            <div class="absolute -top-32 -left-32 w-[40rem] h-[40rem] bg-lime-500/20 rotate-12"></div>
            <div class="absolute top-1/3 -right-40 w-[35rem] h-[35rem] bg-fuchsia-600/20 -rotate-12"></div>
            <div class="absolute bottom-0 left-1/4 w-[50rem] h-[20rem] bg-cyan-400/10 skew-y-6"></div>
        </div>

        <!-- Header -->
        <x-layout.header />


        <!-- Financial Summary -->
        <!-- Financial Summary -->
        <section class="relative z-10 px-6 py-16">
            <h2 class="text-4xl font-black text-white uppercase mb-8">Resumo Financeiro</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                <div class="border-4 border-zinc-100 p-6 bg-zinc-900 shadow-[12px_12px_0_0_#000]">
                    <p class="font-bold uppercase text-zinc-300">Total Recebido</p>
                    <p class="text-lime-400 text-2xl font-black mt-2">{{ $stats['total_receive'] }}</p>
                </div>
                <div class="border-4 border-zinc-100 p-6 bg-zinc-900 shadow-[12px_12px_0_0_#000]">
                    <p class="font-bold uppercase text-zinc-300">Total Gasto</p>
                    <p class="text-red-400 text-2xl font-black mt-2">{{ $stats['total_expense'] }}</p>
                </div>
                <div class="border-4 border-zinc-100 p-6 bg-zinc-900 shadow-[12px_12px_0_0_#000]">
                    <p class="font-bold uppercase text-zinc-300">Saldo Esperado</p>
                    <p class="text-cyan-400 text-2xl font-black mt-2">{{ $stats['expected_total'] }}</p>
                </div>
            </div>

            <!-- Acessar Dashboard -->
            <div class="flex justify-center">
                <a href="{{ route('filament.admin.pages.wallet-dashboard') }}"
                    class="bg-cyan-400 text-zinc-950 px-8 py-4 font-black uppercase shadow-[6px_6px_0_0_#000] hover:shadow-[2px_2px_0_0_#000] transition">
                    Acessar Dashboard
                </a>
            </div>
        </section>

        <!-- Expenses List -->
        <section class="relative z-10 px-6 py-16" x-data="{ open: false }">
            <div x-data="{ open: false, openImport: false }">

                <!-- Header -->
                <div class="flex items-center justify-between mb-6">
                    <h3 class="text-3xl font-black text-white uppercase">
                        Despesas Recentes
                    </h3>

                    <div class="flex gap-4">
                        {{-- Exportar --}}
                        <a href="{{ route('web.export') }}"
                            class="group relative bg-zinc-100 text-zinc-950 px-6 py-3 font-black uppercase shadow-[6px_6px_0_0_#000] hover:shadow-[2px_2px_0_0_#000] hover:-translate-x-1 hover:-translate-y-1 transition-all duration-200 inline-flex items-center gap-2">
                            <svg class="w-5 h-5 group-hover:animate-bounce" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                            </svg>
                            Exportar Dados
                        </a>
                        <!-- Importar CSV -->
                        <button @click="openImport = true"
                            class="group relative bg-zinc-100 text-zinc-950 px-6 py-3 font-black uppercase shadow-[6px_6px_0_0_#000] hover:shadow-[2px_2px_0_0_#000] hover:-translate-x-1 hover:-translate-y-1 transition-all duration-200 inline-flex items-center gap-2">
                            <svg class="w-5 h-5 group-hover:animate-bounce" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                            </svg>
                            Importar CSV
                        </button>
                        <!-- Nova Despesa -->
                        <button @click="open = true"
                            class="group relative bg-lime-400 text-zinc-950 px-8 py-3 font-black uppercase shadow-[6px_6px_0_0_#000] hover:shadow-[2px_2px_0_0_#000] hover:-translate-x-1 hover:-translate-y-1 transition-all duration-200 inline-flex items-center gap-2">
                            <svg class="w-5 h-5 group-hover:rotate-90 transition-transform duration-300" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3"
                                    d="M12 4v16m8-8H4" />
                            </svg>
                            <span>Nova Despesa</span>
                            <span
                                class="absolute -top-2 -right-2 w-6 h-6 bg-red-500 text-white text-xs flex items-center justify-center rounded-full animate-pulse">
                                !
                            </span>
                        </button>
                    </div>
                </div>

                <!-- MODAL IMPORT CSV -->
                <div x-show="openImport" x-transition
                    class="fixed inset-0 z-50 flex items-center justify-center bg-black/80">
                    <div @click.outside="openImport = false"
                        class="bg-zinc-950 border-4 border-zinc-100 w-full max-w-lg p-8
                   shadow-[10px_10px_0_0_#000]">
                        <!-- Header -->
                        <div class="flex items-center justify-between mb-6">
                            <h3 class="text-2xl font-black uppercase text-white">
                                Importar CSV
                            </h3>
                            <button @click="openImport = false" class="text-zinc-100 font-black text-xl">
                                ✕
                            </button>
                        </div>

                        <!-- Descrição -->
                        <p class="text-zinc-300 mb-6 text-sm">
                            Apenas planilhas geradas pelo
                            <strong>Filament Wallet</strong>
                            são compatíveis com esta importação.
                        </p>

                        <!-- Form -->
                        <form method="POST" action="{{ route('api.import') }}" enctype="multipart/form-data"
                            class="space-y-6">
                            @csrf

                            <!-- Upload -->
                            <div>
                                <label class="block font-bold mb-2 text-zinc-100">
                                    Arquivo CSV
                                </label>
                                <input type="file" name="file" accept=".csv" required
                                    class="w-full p-3 bg-zinc-950 text-zinc-100
                               border-2 border-zinc-100
                               file:bg-lime-400 file:text-zinc-950
                               file:font-black file:px-4 file:py-2
                               file:border-0 file:mr-4
                               focus:outline-none">
                            </div>

                            <!-- Actions -->
                            <div class="flex justify-end gap-4">
                                <button type="button" @click="openImport = false"
                                    class="px-6 py-3 font-black uppercase bg-zinc-800 text-white
                               shadow-[4px_4px_0_0_#000]">
                                    Cancelar
                                </button>

                                <button type="submit"
                                    class="px-6 py-3 font-black uppercase bg-lime-400 text-zinc-950
                               shadow-[4px_4px_0_0_#000]
                               hover:shadow-[2px_2px_0_0_#000]
                               transition">
                                    Importar
                                </button>
                            </div>
                        </form>
                    </div>
                </div>




                <!-- Modal -->
                <div x-show="open" class="fixed inset-0 bg-black/70 flex items-center justify-center z-50"
                    x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0"
                    x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-200"
                    x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0">

                    <div class="bg-zinc-900 border-4 border-zinc-100 p-8 w-full max-w-lg shadow-[8px_8px_0_0_#000] relative"
                        @click.away="open = false" x-transition:enter="transform transition ease-out duration-300"
                        x-transition:enter-start="scale-90 opacity-0" x-transition:enter-end="scale-100 opacity-100"
                        x-transition:leave="transform transition ease-in duration-200"
                        x-transition:leave-start="scale-100 opacity-100" x-transition:leave-end="scale-90 opacity-0">

                        <h4 class="text-2xl font-black uppercase text-white mb-6">Nova Despesa / Entrada</h4>

                        <form action="{{ route('api.expense.store') }}" method="POST">
                            @csrf
                            <!-- Título -->
                            <div class="mb-4">
                                <label for="title" class="block font-bold mb-2 text-zinc-100">Descrição</label>
                                <input type="text" id="title" name="title" placeholder="Ex: Aluguel"
                                    class="w-full p-3 rounded border-2 border-zinc-100 bg-zinc-950 text-zinc-100 focus:outline-none focus:border-lime-400">
                            </div>

                            <!-- Valor -->
                            <!-- Valor -->
                            <div class="mb-4" x-data="{ displayAmount: '', cents: null }">
                                <label for="amount" class="block font-bold mb-2 text-zinc-100">Valor (R$)</label>

                                <!-- Input visível para o usuário -->
                                <input type="text" id="amount" x-model="displayAmount"
                                    @input="

            let numbers = $event.target.value.replace(/\D/g,''); 
            
            cents = numbers ? parseInt(numbers) : null; 
            
            displayAmount = cents ? (cents/100).toLocaleString('pt-BR', { style: 'currency', currency: 'BRL' }) : '';
        "
                                    placeholder="R$ 0,00"
                                    class="w-full p-3 rounded border-2 border-zinc-100 bg-zinc-950 text-zinc-100 focus:outline-none focus:border-lime-400">

                                <!-- Input real enviado ao backend -->
                                <input type="hidden" name="amount" :value="cents">
                            </div>


                            <!-- Tipo -->
                            {{-- <div class="mb-6">
                            <label for="type" class="block font-bold mb-2 text-zinc-100">Tipo</label>
                            <select id="type" name="type"
                                class="w-full p-3 rounded border-2 border-zinc-100 bg-zinc-950 text-zinc-100 focus:outline-none focus:border-lime-400">
                                <option value="income">Entrada</option>
                                <option value="expense">Despesa</option>
                            </select>
                        </div> --}}

                            <div class="mb-6">
                                <span class="block font-bold mb-2 text-zinc-100">Tipo</span>

                                <div class="flex gap-6">
                                    <label class="flex items-center gap-2 cursor-pointer">
                                        <input type="radio" name="type" value="income" class="hidden peer"
                                            checked>
                                        <div
                                            class="w-5 h-5 rounded-full border-2 border-zinc-100
                       peer-checked:border-lime-400
                       peer-checked:bg-lime-400 transition">
                                        </div>
                                        <span class="text-zinc-100">Entrada</span>
                                    </label>

                                    <label class="flex items-center gap-2 cursor-pointer">
                                        <input type="radio" name="type" value="expense" class="hidden peer">
                                        <div
                                            class="w-5 h-5 rounded-full border-2 border-zinc-100
                       peer-checked:border-red-400
                       peer-checked:bg-red-400 transition">
                                        </div>
                                        <span class="text-zinc-100">Despesa</span>
                                    </label>
                                </div>
                            </div>

                            <div class="mb-6" x-data="{ status: 'pending' }">
                                <label class="block font-bold mb-2 text-zinc-100">
                                    Status
                                </label>

                                <select name="status" x-model="status"
                                    :class="{
                                        'border-yellow-400': status === 'pending',
                                        'border-green-400': status === 'paid',
                                        'border-red-400': status === 'overdue'
                                    }"
                                    class="w-full p-3 rounded border-2 bg-zinc-950 text-zinc-100 focus:outline-none">
                                    <option value="pending">Pendente</option>
                                    <option value="paid">Pago</option>
                                    <option value="overdue">Em atraso</option>
                                </select>
                            </div>

                            <div class="mb-6">
                                <label for="category_id" class="block font-bold mb-2 text-zinc-100">
                                    Categoria
                                </label>

                                <select id="category_id" name="category_id"
                                    class="w-full p-3 rounded border-2 border-zinc-100 bg-zinc-950 text-zinc-100
               focus:outline-none focus:border-lime-400">
                                    <option value="">Sem categoria</option>

                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="flex justify-end gap-4">
                                <button type="button" @click="open = false"
                                    class="bg-red-500 text-zinc-100 px-6 py-3 font-black uppercase shadow-[4px_4px_0_0_#000] hover:shadow-[2px_2px_0_0_#000] transition">
                                    Cancelar
                                </button>
                                <button type="submit"
                                    class="bg-lime-400 text-zinc-950 px-6 py-3 font-black uppercase shadow-[6px_6px_0_0_#000] hover:shadow-[2px_2px_0_0_#000] transition">
                                    Salvar
                                </button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </section>
        <div class="overflow-x-auto">
            <div class="overflow-x-auto">
                <table class="w-full border-collapse">
                    <thead>
                        <tr
                            class="bg-zinc-900 text-zinc-100 font-black uppercase text-xs tracking-wider border-b-4 border-zinc-700">
                            <th class="text-center px-4 py-3">Descrição</th>
                            <th class="text-center px-4 py-3">Status</th>
                            <th class="text-left px-4 py-3">Categoria</th>
                            <th class="text-center px-4 py-3">Tipo</th>
                            {{-- <th class="text-center px-4 py-3">Vencimento</th> --}}
                            {{-- <th class="text-center px-4 py-3">Pagamento</th> --}}
                            <th class="text-left px-4 py-3">Valor</th>
                        </tr>
                    </thead>
                    <tbody class="text-zinc-200">
                        @forelse ($expenses as $expense)
                            <tr class="border-b border-zinc-800 hover:bg-zinc-800/50 transition-colors group">
                                <!-- Descrição -->
                                <td class="px-4 py-4">
                                    <div class="flex items-center gap-3">
                                        <div
                                            class="w-2 h-2 rounded-full {{ $expense->status === 'paid' ? 'bg-lime-400' : 'bg-red-500' }}">
                                        </div>
                                        <span
                                            class="font-semibold group-hover:text-lime-400 transition-colors">{{ $expense->title }}</span>
                                    </div>
                                </td>

                                <!-- Status -->
                                <td class="px-4 py-4 text-center">
                                    @if ($expense->status === 'paid')
                                        <span
                                            class="inline-flex items-center gap-1 px-3 py-1 bg-lime-400/20 border-2 border-lime-400 text-lime-400 text-xs font-black uppercase">
                                            <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd"
                                                    d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                            Pago
                                        </span>
                                    @else
                                        <span
                                            class="inline-flex items-center gap-1 px-3 py-1 bg-red-500/20 border-2 border-red-500 text-red-400 text-xs font-black uppercase">
                                            <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd"
                                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                            Pendente
                                        </span>
                                    @endif
                                </td>

                                <!-- Categoria -->
                                <td class="px-4 py-4">
                                    <span
                                        class="inline-block px-3 py-1 bg-zinc-900 border border-zinc-700 text-zinc-300 text-xs font-bold uppercase rounded-sm">
                                        {{ $expense->category }}
                                    </span>
                                </td>

                                <!-- Tipo -->
                                <td class="px-4 py-4 text-center">
                                    @if ($expense->type === 'expense')
                                        <span class="inline-flex items-center gap-1 text-red-400 font-bold text-sm">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M19 14l-7 7m0 0l-7-7m7 7V3" />
                                            </svg>
                                            Saída
                                        </span>
                                    @else
                                        <span class="inline-flex items-center gap-1 text-lime-400 font-bold text-sm">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M5 10l7-7m0 0l7 7m-7-7v18" />
                                            </svg>
                                            Entrada
                                        </span>
                                    @endif
                                </td>

                                <!-- Data Vencimento -->
                                {{-- <td class="px-4 py-4 text-center">
                                    <div class="flex flex-col items-center">
                                        <span
                                            class="text-sm font-semibold">{{ \Carbon\Carbon::parse($expense->due_date)->format('d/m/Y') }}</span>
                                        <span
                                            class="text-xs text-zinc-500">{{ \Carbon\Carbon::parse($expense->due_date)->diffForHumans() }}</span>
                                    </div>
                                </td> --}}

                                <!-- Data Pagamento -->
                                {{-- <td class="px-4 py-4 text-center">
                                    @if ($expense->payment_date)
                                        <div class="flex flex-col items-center">
                                            <span
                                                class="text-sm font-semibold">{{ \Carbon\Carbon::parse($expense->payment_date)->format('d/m/Y') }}</span>
                                            <span
                                                class="text-xs text-zinc-500">{{ \Carbon\Carbon::parse($expense->payment_date)->diffForHumans() }}</span>
                                        </div>
                                    @else
                                        <span class="text-zinc-600 text-sm">—</span>
                                    @endif
                                </td> --}}

                                <!-- Valor -->
                                <td class="px-4 py-4 text-left">
                                    <span
                                        class="text-lg font-black tabular-nums {{ $expense->type === 'expense' ? 'text-red-400' : 'text-lime-400' }}">
                                        {{ $expense->type === 'expense' ? '- ' : '+ ' }}R$
                                        {{ $expense->amount }}
                                    </span>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="px-4 py-16 text-center">
                                    <div class="flex flex-col items-center gap-4">
                                        <div
                                            class="w-16 h-16 bg-zinc-900 border-4 border-zinc-800 flex items-center justify-center">
                                            <svg class="w-8 h-8 text-zinc-700" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
                                            </svg>
                                        </div>
                                        <div>
                                            <p class="text-zinc-400 font-bold text-lg mb-1">Nenhuma transação
                                                encontrada</p>
                                            <p class="text-zinc-600 text-sm">Adicione sua primeira transação para
                                                começar</p>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Paginação (se necessário) -->
            {{-- @if ($expenses->hasPages())
                <div class="mt-6 flex justify-center">
                    {{ $expenses->links() }}
                </div>
            @endif --}}
        </div>
        </section>

        <!-- Footer -->
        <x-layout.footer />
    </div>
</x-layout.main-layout>
