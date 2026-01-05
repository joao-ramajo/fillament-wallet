<x-layout.main-layout title="Fillament Wallet">
    <div class="min-h-screen bg-zinc-950 text-zinc-100 overflow-hidden">
        <!-- Background brutal shapes com animação -->
        <div class="pointer-events-none fixed inset-0">
            <div
                class="absolute -top-32 -left-32 w-[40rem] h-[40rem] bg-lime-500/20 rotate-12 transition-transform duration-[3000ms] hover:scale-110">
            </div>
            <div
                class="absolute top-1/3 -right-40 w-[35rem] h-[35rem] bg-fuchsia-600/20 -rotate-12 transition-transform duration-[3000ms] hover:scale-110">
            </div>
            <div
                class="absolute bottom-0 left-1/4 w-[50rem] h-[20rem] bg-cyan-400/10 skew-y-6 transition-transform duration-[3000ms] hover:scale-110">
            </div>
        </div>

        <!-- Header -->
        <x-layout.header />

        <!-- Hero -->
        <x-landing-page.hero/>

        <!-- Stats rápidas -->
        <x-landing-page.stats/>

        <!-- Features com ícones e hover effects -->
       <x-landing-page.feature/>

        <x-landing-page.new-feature/>

        <!-- Call to action melhorado -->
       <x-landing-page.cta/>

        <!-- Footer -->
        <x-layout.footer />
    </div>
</x-layout.main-layout>
