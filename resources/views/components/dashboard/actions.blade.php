   <div class="flex gap-4">
       {{-- Exportar --}}
       <a href="{{ route('web.export') }}"
           class="group relative bg-zinc-100 text-zinc-950 px-6 py-3 font-black uppercase shadow-[6px_6px_0_0_#000] hover:shadow-[2px_2px_0_0_#000] hover:-translate-x-1 hover:-translate-y-1 transition-all duration-200 inline-flex items-center gap-2 hidden lg:inline-flex ">
           <svg class="w-5 h-5 group-hover:animate-bounce" fill="none" stroke="currentColor" viewBox="0 0 24 24">
               <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                   d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
           </svg>
           Planilha de Backup
       </a>
       <!-- Importar CSV -->
       <button @click="openImport = true"
           class="group relative bg-zinc-100 text-zinc-950 px-6 py-3 font-black uppercase shadow-[6px_6px_0_0_#000] hover:shadow-[2px_2px_0_0_#000] hover:-translate-x-1 hover:-translate-y-1 transition-all duration-200 inline-flex items-center gap-2 hidden lg:inline-flex">
           <svg class="w-5 h-5 group-hover:animate-bounce" fill="none" stroke="currentColor" viewBox="0 0 24 24">
               <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                   d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
           </svg>
           Importar CSV
       </button>
       <!-- Nova Despesa -->
       <button @click="open = true"
           class="group relative bg-lime-400 text-zinc-950 px-8 py-3 font-black uppercase shadow-[6px_6px_0_0_#000] hover:shadow-[2px_2px_0_0_#000] hover:-translate-x-1 hover:-translate-y-1 transition-all duration-200 inline-flex items-center gap-2 hidden lg:inline-flex">
           <svg class="w-5 h-5 group-hover:rotate-90 transition-transform duration-300" fill="none"
               stroke="currentColor" viewBox="0 0 24 24">
               <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M12 4v16m8-8H4" />
           </svg>
           <span>Nova Despesa</span>
           <span
               class="absolute -top-2 -right-2 w-6 h-6 bg-red-500 text-white text-xs flex items-center justify-center rounded-full animate-pulse">
               !
           </span>
       </button>

       {{-- MOBILE BUTTONS --}}
       <div class="flex lg:hidden flex-col gap-3 w-full">
           {{-- Exportar --}}
           <a href="{{ route('web.export') }}"
               class="bg-zinc-100 text-zinc-950 px-6 py-3 font-black uppercase text-center shadow-[4px_4px_0_0_#000] hover:shadow-[2px_2px_0_0_#000] transition-all inline-flex items-center justify-center gap-2">
               <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                   <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                       d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
               </svg>
               Exportar
           </a>

           <!-- Importar CSV -->
           <button @click="openImport = true"
               class="bg-zinc-100 text-zinc-950 px-6 py-3 font-black uppercase shadow-[4px_4px_0_0_#000] hover:shadow-[2px_2px_0_0_#000] transition-all inline-flex items-center justify-center gap-2">
               <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                   <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                       d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
               </svg>
               Importar
           </button>

           <!-- Nova Despesa -->
           <button @click="open = true"
               class="bg-lime-400 text-zinc-950 px-6 py-4 font-black uppercase shadow-[4px_4px_0_0_#000] hover:shadow-[2px_2px_0_0_#000] transition-all inline-flex items-center justify-center gap-2 relative">
               <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                   <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M12 4v16m8-8H4" />
               </svg>
               Nova Despesa
           </button>
       </div>
   </div>
