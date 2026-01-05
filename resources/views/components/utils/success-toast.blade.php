@props(['message'])
    <div
        x-data="{ show: true }"
        x-init="setTimeout(() => show = false, 4000)"
        x-show="show"
        x-transition:enter="transform transition ease-out duration-300"
        x-transition:enter-start="translate-x-10 opacity-0"
        x-transition:enter-end="translate-x-0 opacity-100"
        x-transition:leave="transform transition ease-in duration-300"
        x-transition:leave-start="translate-x-0 opacity-100"
        x-transition:leave-end="translate-x-10 opacity-0"
        class="fixed top-6 right-6 z-[9999]"
    >
        <div
            class="bg-lime-400 text-zinc-950 border-4 border-zinc-950
                   px-6 py-4 font-black uppercase
                   shadow-[6px_6px_0_0_#000]
                   flex items-center gap-3"
        >
            <!-- Ícone -->
            <svg class="w-6 h-6" fill="none" stroke="currentColor"
                 viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3"
                      d="M5 13l4 4L19 7" />
            </svg>

            <!-- Texto -->
            <span>{{ $message }} </span>

            <!-- Botão fechar -->
            <button
                @click="show = false"
                class="ml-4 text-zinc-900 hover:scale-110 transition"
            >
                ✕
            </button>
        </div>
    </div>
