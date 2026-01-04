<x-filament-panels::page>
    @push('scripts')
        <script src="https://cdn.tailwindcss.com"></script>
    @endpush
    <div class="grid gap-6">
        {{-- Card de Usuário --}}
        <x-filament::card>
            <div class="flex items-start justify-between gap-4">
                {{-- Informações do Usuário --}}
                <div class="flex items-center gap-4">
                    {{-- Avatar --}}
                    <div class="flex h-16 w-16 items-center justify-center rounded-full bg-black text-white">
                        <span class="text-2xl font-bold uppercase">
                            {{ substr(auth()->user()->name, 0, 1) }}
                        </span>
                    </div>

                    {{-- Nome e Email --}}
                    <div>
                        <h3 class="text-lg font-semibold text-black">
                            {{ auth()->user()->name }}
                        </h3>
                        <p class="text-sm text-gray-900 dark:text-gray-400">
                            {{ auth()->user()->email }}
                        </p>
                    </div>
                </div>

                {{-- Botão de Logout --}}
                <x-filament::button color="danger" icon="heroicon-o-arrow-right-on-rectangle" tag="a"
                    href="{{ route('filament.admin.auth.logout') }}"
                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    Sair
                </x-filament::button>

                <form id="logout-form" action="{{ route('filament.admin.auth.logout') }}" method="POST" class="hidden">
                    @csrf
                </form>
            </div>
        </x-filament::card>
    </div>
</x-filament-panels::page>
