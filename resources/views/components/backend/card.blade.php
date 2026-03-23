@props(['title' => null, 'footer' => null])

<div {{ $attributes->class(['bg-white/[0.02] backdrop-blur-3xl rounded-[2rem] border border-white/5 mb-8 overflow-hidden']) }}>
    @if ($title)
        <div class="px-8 py-5 border-b border-white/5 bg-white/[0.01] flex items-center justify-between">
            <h3 class="text-sm font-black text-white uppercase tracking-[0.2em]">{{ $title }}</h3>
            <flux:icon name="ellipsis-horizontal" size="xs" class="text-slate-600" />
        </div>
    @endif

    <div class="p-8">
        {{ $slot }}
    </div>

    @if ($footer)
        <div class="px-8 py-5 border-t border-white/5 bg-white/[0.01]">
            {{ $footer }}
        </div>
    @endif
</div>
