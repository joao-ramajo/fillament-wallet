{{-- resources/views/expenses/edit.blade.php --}}

<x-layout.main-layout title="Editar Movimentação">
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
        <section class="relative z-10 px-4 sm:px-6 py-8 sm:py-16 pb-32 sm:pb-16">
            <!-- Breadcrumb -->
            <div class="mb-4 sm:mb-6">
                <a href="{{ route('web.expense.details', ['id' => Crypt::encrypt($expense->id)]) }}"
                    class="inline-flex items-center gap-2 text-zinc-400 hover:text-lime-400 transition-colors font-bold uppercase text-xs sm:text-sm group">
                    <svg class="w-4 h-4 group-hover:-translate-x-1 transition-transform" fill="none"
                        stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                    </svg>
                    Voltar aos Detalhes
                </a>
            </div>

            <!-- Page Title -->
            <div class="mb-6 sm:mb-8">
                <h1 class="text-3xl sm:text-4xl md:text-5xl font-black text-white uppercase mb-2">
                    Editar Movimentação
                </h1>
                <div class="w-20 sm:w-24 h-2 bg-lime-400"></div>
            </div>

            <!-- Form Container -->
            <div class="max-w-3xl">
                <form action="{{ route('web.expenses.update', ['id' => Crypt::encrypt($expense->id)]) }}"
                    method="POST">
                    @csrf
                    @method('PUT')

                    <!-- Main Form Card -->
                    <div
                        class="border-4 border-zinc-100 p-4 sm:p-6 md:p-8 bg-zinc-900 shadow-[8px_8px_0_0_#000] sm:shadow-[12px_12px_0_0_#000] mb-6 space-y-6">

                        <!-- Título -->
                        <div>
                            <label for="title"
                                class="block font-bold mb-3 text-zinc-100 uppercase text-sm tracking-wide">
                                Descrição
                                <span class="text-red-400">*</span>
                            </label>
                            <input type="text" id="title" name="title"
                                value="{{ old('title', $expense->title) }}"
                                placeholder="Ex: Aluguel, Salário, Conta de Luz" required
                                class="w-full p-3 sm:p-4 rounded border-2 border-zinc-100 bg-zinc-950 text-zinc-100 placeholder-zinc-600 focus:outline-none focus:border-lime-400 focus:ring-2 focus:ring-lime-400/20 transition text-base">
                            @error('title')
                                <p class="mt-2 text-red-400 text-sm font-bold">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Valor -->
                        <div>
                            <label for="amount_display"
                                class="block font-bold mb-3 text-zinc-100 uppercase text-sm tracking-wide">
                                Valor (R$)
                                <span class="text-red-400">*</span>
                            </label>

                            <div class="relative">
                                <span class="absolute left-4 top-1/2 -translate-y-1/2 text-zinc-400 font-bold text-lg">
                                    R$
                                </span>

                                <!-- Campo visível (formatado) -->
                                <input type="text" id="amount_display" placeholder="0,00"
                                    class="w-full pl-12 pr-4 py-3 sm:py-4 rounded border-2 border-zinc-100 bg-zinc-950 text-zinc-100 placeholder-zinc-600 text-lg font-bold tabular-nums">

                                <!-- Valor real em centavos -->
                                <input type="hidden" id="amount" name="amount"
                                    value="{{ old('amount', $expense->amount) }}">
                            </div>

                            @error('amount')
                                <p class="mt-2 text-red-400 text-sm font-bold">{{ $message }}</p>
                            @enderror
                        </div>

                        <script>
                            const hiddenInput = document.getElementById('amount');
                            const displayInput = document.getElementById('amount_display');

                            function formatBRL(cents) {
                                return (cents / 100).toLocaleString('pt-BR', {
                                    minimumFractionDigits: 2,
                                    maximumFractionDigits: 2
                                });
                            }

                            if (hiddenInput.value) {
                                displayInput.value = formatBRL(parseInt(hiddenInput.value, 10));
                            }

                            displayInput.addEventListener('input', (e) => {
                                const numbers = e.target.value.replace(/\D/g, '');
                                const cents = numbers ? parseInt(numbers, 10) : 0;

                                hiddenInput.value = cents;
                                displayInput.value = cents ? formatBRL(cents) : '';
                            });
                        </script>


                        <!-- Tipo -->
                        <div>
                            <span class="block font-bold mb-3 text-zinc-100 uppercase text-sm tracking-wide">
                                Tipo
                                <span class="text-red-400">*</span>
                            </span>
                            <div class="grid grid-cols-2 gap-3 sm:gap-4">
                                <label class="relative cursor-pointer group">
                                    <input type="radio" name="type" value="income" class="peer hidden"
                                        {{ old('type', $expense->type) === 'income' ? 'checked' : '' }}>
                                    <div
                                        class="border-2 border-zinc-100 p-4 sm:p-5 bg-zinc-950 peer-checked:bg-lime-400/10 peer-checked:border-lime-400 transition-all hover:border-lime-400/50 shadow-[4px_4px_0_0_#000] peer-checked:shadow-[4px_4px_0_0_#22c55e]">
                                        <div class="flex items-center gap-3 mb-2">
                                            <div
                                                class="w-5 h-5 rounded-full border-2 border-zinc-100 peer-checked:border-lime-400 peer-checked:bg-lime-400 transition flex items-center justify-center">
                                                <div
                                                    class="w-2 h-2 bg-zinc-950 rounded-full opacity-0 peer-checked:opacity-100">
                                                </div>
                                            </div>
                                            <svg class="w-5 h-5 text-lime-400" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M5 10l7-7m0 0l7 7m-7-7v18" />
                                            </svg>
                                        </div>
                                        <span class="text-zinc-100 font-bold text-sm sm:text-base">Entrada</span>
                                    </div>
                                </label>

                                <label class="relative cursor-pointer group">
                                    <input type="radio" name="type" value="expense" class="peer hidden"
                                        {{ old('type', $expense->type) === 'expense' ? 'checked' : '' }}>
                                    <div
                                        class="border-2 border-zinc-100 p-4 sm:p-5 bg-zinc-950 peer-checked:bg-red-400/10 peer-checked:border-red-400 transition-all hover:border-red-400/50 shadow-[4px_4px_0_0_#000] peer-checked:shadow-[4px_4px_0_0_#ef4444]">
                                        <div class="flex items-center gap-3 mb-2">
                                            <div
                                                class="w-5 h-5 rounded-full border-2 border-zinc-100 peer-checked:border-red-400 peer-checked:bg-red-400 transition flex items-center justify-center">
                                                <div
                                                    class="w-2 h-2 bg-zinc-950 rounded-full opacity-0 peer-checked:opacity-100">
                                                </div>
                                            </div>
                                            <svg class="w-5 h-5 text-red-400" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M19 14l-7 7m0 0l-7-7m7 7V3" />
                                            </svg>
                                        </div>
                                        <span class="text-zinc-100 font-bold text-sm sm:text-base">Despesa</span>
                                    </div>
                                </label>
                            </div>
                            @error('type')
                                <p class="mt-2 text-red-400 text-sm font-bold">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Status -->
                        <div x-data="{ status: '{{ old('status', $expense->status) }}' }">
                            <label class="block font-bold mb-3 text-zinc-100 uppercase text-sm tracking-wide">
                                Status
                                <span class="text-red-400">*</span>
                            </label>
                            <select name="status" x-model="status"
                                :class="{
                                    'border-yellow-400 focus:ring-yellow-400/20': status === 'pending',
                                    'border-lime-400 focus:ring-lime-400/20': status === 'paid',
                                    'border-red-400 focus:ring-red-400/20': status === 'overdue'
                                }"
                                class="w-full p-3 sm:p-4 rounded border-2 bg-zinc-950 text-zinc-100 focus:outline-none focus:ring-2 transition text-base font-bold">
                                <option value="pending">⏱️ Pendente</option>
                                <option value="paid">✅ Pago</option>
                                <option value="overdue">🚨 Em Atraso</option>
                            </select>
                            @error('status')
                                <p class="mt-2 text-red-400 text-sm font-bold">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Categoria -->
                        <div>
                            <label for="category_id"
                                class="block font-bold mb-3 text-zinc-100 uppercase text-sm tracking-wide">
                                Categoria
                            </label>
                            <select id="category_id" name="category_id"
                                class="w-full p-3 sm:p-4 rounded border-2 border-zinc-100 bg-zinc-950 text-zinc-100 focus:outline-none focus:border-cyan-400 focus:ring-2 focus:ring-cyan-400/20 transition text-base font-bold">
                                <option value="">{{ $expense->category ?? 'Sem categoria' }}</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}"
                                        {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('category_id')
                                <p class="mt-2 text-red-400 text-sm font-bold">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Datas -->
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 sm:gap-6">
                            <!-- Data de Vencimento -->
                            <div x-data="{
                                dueDateFormatted: '{{ $expense->due_date }}',
                                dueDateInput: ''
                            }" x-init="if (dueDateFormatted) {
                                let parts = dueDateFormatted.split('/');
                                dueDateInput = `${parts[2]}-${parts[1]}-${parts[0]}`;
                            }">
                                <label for="due_date"
                                    class="block font-bold mb-3 text-zinc-100 uppercase text-sm tracking-wide">
                                    Vencimento
                                </label>
                                <input type="date" id="due_date" name="due_date" x-model="dueDateInput"
                                    class="w-full p-3 sm:p-4 rounded border-2 border-zinc-100 bg-zinc-950 text-zinc-100 focus:outline-none focus:border-lime-400 focus:ring-2 focus:ring-lime-400/20 transition text-base">
                                @error('due_date')
                                    <p class="mt-2 text-red-400 text-sm font-bold">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Data de Pagamento -->
                            <div x-data="{
                                paymentDateFormatted: '{{ $expense->payment_date }}',
                                paymentDateInput: ''
                            }" x-init="if (paymentDateFormatted) {
                                let parts = paymentDateFormatted.split('/');
                                paymentDateInput = `${parts[2]}-${parts[1]}-${parts[0]}`;
                            }">
                                <label for="payment_date"
                                    class="block font-bold mb-3 text-zinc-100 uppercase text-sm tracking-wide">
                                    Pagamento
                                </label>
                                <input type="date" id="payment_date" name="payment_date"
                                    x-model="paymentDateInput"
                                    class="w-full p-3 sm:p-4 rounded border-2 border-zinc-100 bg-zinc-950 text-zinc-100 focus:outline-none focus:border-lime-400 focus:ring-2 focus:ring-lime-400/20 transition text-base">
                                @error('payment_date')
                                    <p class="mt-2 text-red-400 text-sm font-bold">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Actions - Sticky no Mobile -->
                    <div
                        class="fixed sm:relative bottom-0 left-0 right-0 sm:bottom-auto sm:left-auto sm:right-auto bg-zinc-950 sm:bg-transparent p-4 sm:p-0 border-t-4 sm:border-t-0 border-zinc-800 z-20">
                        <div class="flex flex-col sm:flex-row gap-3 sm:gap-4 max-w-3xl mx-auto">
                            <a href="{{ route('web.expense.details', ['id' => Crypt::encrypt($expense->id)]) }}"
                                class="group flex-1 bg-zinc-800 text-white px-6 sm:px-8 py-3 sm:py-4 font-black uppercase text-center text-sm sm:text-base shadow-[4px_4px_0_0_#000] sm:shadow-[6px_6px_0_0_#000] hover:shadow-[2px_2px_0_0_#000] hover:-translate-x-0.5 hover:-translate-y-0.5 sm:hover:-translate-x-1 sm:hover:-translate-y-1 transition-all duration-200 inline-flex items-center justify-center gap-2 active:shadow-[1px_1px_0_0_#000] active:translate-x-0 active:translate-y-0">
                                <svg class="w-4 h-4 sm:w-5 sm:h-5 group-hover:-translate-x-1 transition-transform flex-shrink-0"
                                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M6 18L18 6M6 6l12 12" />
                                </svg>
                                Cancelar
                            </a>

                            <button type="submit"
                                class="group flex-1 bg-lime-400 text-zinc-950 px-6 sm:px-8 py-3 sm:py-4 font-black uppercase text-sm sm:text-base shadow-[4px_4px_0_0_#000] sm:shadow-[6px_6px_0_0_#000] hover:shadow-[2px_2px_0_0_#000] hover:-translate-x-0.5 hover:-translate-y-0.5 sm:hover:-translate-x-1 sm:hover:-translate-y-1 transition-all duration-200 inline-flex items-center justify-center gap-2 active:shadow-[1px_1px_0_0_#000] active:translate-x-0 active:translate-y-0">
                                <svg class="w-4 h-4 sm:w-5 sm:h-5 group-hover:scale-110 transition-transform flex-shrink-0"
                                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 13l4 4L19 7" />
                                </svg>
                                Salvar Alterações
                            </button>
                        </div>
                    </div>
                </form>

                <!-- Danger Zone - Deletar -->
                <div class="border-4 border-red-500 p-4 sm:p-6 bg-red-950/20 shadow-[6px_6px_0_0_#ef4444] mt-6"
                    x-data="{ showConfirm: false }">
                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                        <div>
                            <h3 class="text-lg sm:text-xl font-black text-red-400 uppercase mb-1">Zona de Perigo</h3>
                            <p class="text-zinc-400 text-sm">Esta ação é irreversível</p>
                        </div>
                        <button @click="showConfirm = true"
                            class="bg-red-500 text-white px-6 py-3 font-black uppercase text-sm shadow-[4px_4px_0_0_#000] hover:shadow-[2px_2px_0_0_#000] hover:-translate-x-0.5 hover:-translate-y-0.5 transition-all inline-flex items-center justify-center gap-2 whitespace-nowrap">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                            </svg>
                            Deletar Movimentação
                        </button>
                    </div>

                    <!-- Confirmação de Deleção -->
                    <div x-show="showConfirm" x-transition
                        class="fixed inset-0 bg-black/80 flex items-center justify-center z-50 p-4">
                        <div @click.outside="showConfirm = false"
                            class="bg-zinc-900 border-4 border-red-500 p-6 sm:p-8 w-full max-w-md shadow-[10px_10px_0_0_#ef4444]">
                            <h3 class="text-2xl font-black uppercase text-white mb-4">Confirmar Exclusão</h3>
                            <p class="text-zinc-300 mb-6">
                                Tem certeza que deseja deletar <strong
                                    class="text-white">{{ $expense->title }}</strong>?
                                Esta ação não pode ser desfeita.
                            </p>

                            <div class="flex gap-4">
                                <button @click="showConfirm = false"
                                    class="flex-1 bg-zinc-800 text-white px-6 py-3 font-black uppercase shadow-[4px_4px_0_0_#000] hover:shadow-[2px_2px_0_0_#000] transition">
                                    Cancelar
                                </button>

                                <form
                                    action="{{ route('web.expenses.destroy', ['id' => Crypt::encrypt($expense->id)]) }}"
                                    method="POST" class="flex-1">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="w-full bg-red-500 text-white px-6 py-3 font-black uppercase shadow-[4px_4px_0_0_#000] hover:shadow-[2px_2px_0_0_#000] transition">
                                        Deletar
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Footer -->
        <x-layout.footer />
    </div>
</x-layout.main-layout>
