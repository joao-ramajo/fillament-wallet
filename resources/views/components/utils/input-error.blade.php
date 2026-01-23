@props(['message'])

@if($message)
    <div {{ $attributes->merge(['class' => 'mt-4 border-4 border-red-500 bg-zinc-900 p-3 shadow-[4px_4px_0_0_#ef4444]']) }}>
        <div class="flex items-start gap-3">
            <div class="flex-shrink-0 w-6 h-6 bg-red-500 flex items-center justify-center font-black text-zinc-950 text-sm">
                !
            </div>
            <p class="text-red-400 text-sm font-bold leading-tight flex-1">
                {{ $message }}
            </p>
        </div>
    </div>
@endif