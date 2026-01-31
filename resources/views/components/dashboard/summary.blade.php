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