@props(['keys' => ['success', 'error', 'warning', 'info']])

@php
    $typeMap = [
        'success' => ['bg' => 'bg-emerald-500/10', 'border' => 'border-emerald-500/20', 'text' => 'text-emerald-400', 'icon' => 'check-circle'],
        'error'   => ['bg' => 'bg-rose-500/10',   'border' => 'border-rose-500/20',   'text' => 'text-rose-400',    'icon' => 'x-circle'],
        'warning' => ['bg' => 'bg-amber-500/10',  'border' => 'border-amber-500/20',  'text' => 'text-amber-400',   'icon' => 'exclamation-triangle'],
        'info'    => ['bg' => 'bg-blue-500/10',   'border' => 'border-blue-500/20',   'text' => 'text-blue-400',    'icon' => 'information-circle'],
    ];
@endphp

<div class="space-y-4 mb-10">
    @if ($errors->any())
        <div class="glass bg-rose-500/10 border-rose-500/20 backdrop-blur-xl p-5 rounded-2xl flex gap-4 items-start">
            <flux:icon name="exclamation-triangle" class="text-rose-400 mt-0.5 shrink-0" />
            <div>
                <h4 class="text-rose-200 font-black text-sm uppercase tracking-wider mb-1">Validation Errors</h4>
                <ul class="list-disc list-inside text-sm text-rose-300/80 space-y-1">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    @endif

    @foreach ($keys as $key)
        @if (session()->has($key))
            @php
                $style = $typeMap[$key] ?? $typeMap['info'];
                $value = session()->get($key);
                $messages = is_array($value) ? $value : [$value];
                session()->forget($key);
            @endphp

            <div class="glass {{ $style['bg'] }} {{ $style['border'] }} backdrop-blur-xl p-5 rounded-2xl flex justify-between items-center group transition-all">
                <div class="flex items-center gap-4">
                    <flux:icon :name="$style['icon']" class="{{ $style['text'] }} shrink-0" />
                    <div class="text-sm font-bold {{ $style['text'] }}">
                        @foreach ($messages as $message)
                            <p>{{ $message }}</p>
                        @endforeach
                    </div>
                </div>
                <button onclick="this.parentElement.remove()" class="text-white/20 hover:text-white transition-colors p-1">
                    <flux:icon name="x-mark" size="xs" />
                </button>
            </div>
        @endif
    @endforeach
</div>
