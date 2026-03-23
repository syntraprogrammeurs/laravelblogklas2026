@props([
    'title',
    'value' => null,
    'icon' => null,
    'description' => null,
    'trend' => null,
    'trendColor' => 'text-neon-cyan',
])

<div {{ $attributes->class(["bg-white/[0.03] backdrop-blur-3xl p-10 rounded-[2.5rem] border border-white/10 group hover:border-white/20 transition-all duration-700 relative overflow-hidden"]) }}>
    <div class="absolute -right-6 -top-6 size-32 bg-white/[0.02] rounded-full blur-3xl group-hover:bg-neon-cyan/5 transition-all duration-700"></div>

    <div class="flex items-center justify-between mb-8 relative z-10">
        <h4 class="text-[10px] font-black text-slate-500 uppercase tracking-[0.4em]">
            {{ $title }}
        </h4>
        @if ($icon)
            <div class="size-10 rounded-xl bg-white/5 flex items-center justify-center border border-white/5 group-hover:border-white/20 transition-all">
                <flux:icon :name="$icon" size="sm" class="text-white/40 group-hover:text-white" />
            </div>
        @endif
    </div>

    <div class="flex items-baseline gap-4 relative z-10">
        <span class="text-5xl font-[1000] text-white tracking-tighter group-hover:scale-110 transition-transform duration-700 origin-left">
            {{ $value }}
        </span>
        @if ($trend)
            <div class="px-3 py-1 bg-white/5 rounded-lg border border-white/5">
                <span class="text-[9px] font-black {{ $trendColor }} uppercase tracking-widest">{{ $trend }}</span>
            </div>
        @endif
    </div>

    @if ($description)
        <p class="mt-6 text-[10px] text-slate-500 font-bold uppercase tracking-[0.2em] relative z-10">
            {{ $description }}
        </p>
    @endif
</div>
