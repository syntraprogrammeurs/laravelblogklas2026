<x-backend.shell title="Command Center">

    <x-slot:actions>
        <flux:button icon="plus" variant="primary" :href="route('backend.posts.index')" class="!rounded-2xl !bg-neon-cyan !text-slate-950 !font-black !px-6 !py-3 hover:!neon-glow-cyan transition-all">
            NEW POST
        </flux:button>
    </x-slot:actions>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 mb-16">
        <x-backend.stat-card
            title="Total Posts"
            value="128"
            icon="newspaper"
            trend="+12%"
            description="Active Content"
        />
        <x-backend.stat-card
            title="Total Users"
            value="1.2k"
            icon="users"
            trend="+5.4%"
            description="Active Network"
        />
        <x-backend.stat-card
            title="Media Cloud"
            value="452"
            icon="photo"
            trend="+23"
            description="Total Assets"
        />
        <x-backend.stat-card
            title="System Alert"
            value="02"
            icon="chat-bubble-left-right"
            trend="-2%"
            trend-color="text-neon-magenta"
            description="Pending Tasks"
        />
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-12 mb-16">
        <x-backend.card title="Recent Activity" class="lg:col-span-2">
            <div class="space-y-10">
                @foreach(range(1, 4) as $i)
                    <div class="flex items-start gap-6 group">
                        <div class="mt-1">
                            <flux:avatar size="md" initials="JD" class="!bg-white/5 !border-white/10 group-hover:!border-neon-cyan/50 transition-all" />
                        </div>
                        <div class="flex-1">
                            <div class="flex justify-between items-center mb-1">
                                <flux:text class="!text-white !font-black !text-sm">John Doe published "Laravel 12 Aura"</flux:text>
                                <flux:text class="!text-[10px] !text-slate-500 !font-mono">14:23 UTC</flux:text>
                            </div>
                            <flux:text class="!text-xs !text-slate-400 !font-medium">The post was updated to include the new futuristic glassmorph styles.</flux:text>
                        </div>
                    </div>
                @endforeach
            </div>

            <x-slot:footer>
                <flux:button variant="ghost" class="w-full !text-[10px] !font-black !tracking-[0.2em] !text-slate-400 hover:!text-neon-cyan transition-all">VIEW SYSTEM LOG</flux:button>
            </x-slot:footer>
        </x-backend.card>

        <x-backend.card title="System Core">
            <div class="space-y-8">
                <div>
                    <div class="flex items-center justify-between mb-3">
                        <flux:text class="!text-[10px] !font-black !text-slate-400 !uppercase tracking-widest">CPU LOAD</flux:text>
                        <flux:badge class="!bg-neon-lime/10 !text-neon-lime !border-neon-lime/20 !text-[9px] !font-black">OPTIMIZED</flux:badge>
                    </div>
                    <div class="w-full bg-white/5 rounded-full h-1.5 overflow-hidden">
                        <div class="bg-neon-cyan h-full rounded-full animate-pulse shadow-[0_0_10px_rgba(6,182,212,0.5)]" style="width: 24%"></div>
                    </div>
                </div>

                <div>
                    <div class="flex items-center justify-between mb-3">
                        <flux:text class="!text-[10px] !font-black !text-slate-400 !uppercase tracking-widest">MEMORY</flux:text>
                        <flux:text class="!text-[9px] !text-slate-500 !font-mono">45.2GB / 100GB</flux:text>
                    </div>
                    <div class="w-full bg-white/5 rounded-full h-1.5 overflow-hidden">
                        <div class="bg-neon-magenta h-full rounded-full shadow-[0_0_10px_rgba(217,70,239,0.5)]" style="width: 45%"></div>
                    </div>
                </div>

                <div class="pt-8 space-y-4 border-t border-white/5">
                    <div class="flex items-center justify-between">
                        <flux:text class="!text-[10px] !font-bold !text-slate-500 uppercase tracking-widest">Environment</flux:text>
                        <flux:text class="!text-[10px] !text-white !font-mono">PRODUCTION</flux:text>
                    </div>
                    <div class="flex items-center justify-between">
                        <flux:text class="!text-[10px] !font-bold !text-slate-500 uppercase tracking-widest">Kernel</flux:text>
                        <flux:text class="!text-[10px] !text-white !font-mono">v12.52.0</flux:text>
                    </div>
                </div>
            </div>
        </x-backend.card>
    </div>

    <x-backend.card title="Recent Transmissions">
        <div class="overflow-x-auto -mx-10">
            <table class="w-full text-left">
                <thead>
                    <tr class="bg-white/[0.03] border-y border-white/5">
                        <th class="px-10 py-5 font-black text-slate-500 text-[9px] uppercase tracking-[0.3em]">ID / Reference</th>
                        <th class="px-10 py-5 font-black text-slate-500 text-[9px] uppercase tracking-[0.3em]">Operator</th>
                        <th class="px-10 py-5 font-black text-slate-500 text-[9px] uppercase tracking-[0.3em]">Status</th>
                        <th class="px-10 py-5 font-black text-slate-500 text-[9px] uppercase tracking-[0.3em]">Timestamp</th>
                        <th class="px-10 py-5"></th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-white/5">
                    @foreach(range(1, 5) as $i)
                        <tr class="hover:bg-white/[0.04] transition-all group">
                            <td class="px-10 py-6">
                                <flux:text class="!text-sm !font-black !text-white !tracking-tight">POST-X-{{ 2026 + $i }}</flux:text>
                                <flux:text class="!text-[10px] !text-slate-500 !font-mono uppercase mt-1">laravel-v12-aura-v1</flux:text>
                            </td>
                            <td class="px-10 py-6">
                                <div class="flex items-center gap-3">
                                    <flux:avatar initials="JD" size="xs" class="!bg-white/5 !border-white/10" />
                                    <flux:text class="!text-xs !font-bold !text-slate-300">ADMINISTRATOR</flux:text>
                                </div>
                            </td>
                            <td class="px-10 py-6">
                                <flux:badge class="!bg-neon-cyan/10 !text-neon-cyan !border-neon-cyan/20 !text-[9px] !font-black !px-3 !py-1">ENCRYPTED</flux:badge>
                            </td>
                            <td class="px-10 py-6">
                                <flux:text class="!text-xs !text-slate-400 !font-mono">2026-03-23 14:00</flux:text>
                            </td>
                            <td class="px-10 py-6 text-right">
                                <flux:button icon="ellipsis-horizontal" variant="ghost" size="sm" class="hover:!text-neon-cyan transition-all" />
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </x-backend.card>

</x-backend.shell>
