@props(['title' => null])

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>{{ $title ?? config('app.name') }} - Aura Pro</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700,800" rel="stylesheet" />

        @vite(['resources/css/app.css', 'resources/js/app.js'])
        @fluxAppearance

        {{ $head ?? '' }}
    </head>
    <body class="min-h-screen bg-[#020617] text-slate-100 selection:bg-neon-cyan/30 overflow-x-hidden p-6 lg:p-10">
        
        {{-- DEEP AURA BLOBS --}}
        <div class="fixed inset-0 overflow-hidden pointer-events-none -z-10">
            <div class="absolute -top-[20%] -left-[10%] w-[70%] h-[70%] rounded-full bg-neon-cyan/10 blur-[150px] animate-pulse"></div>
            <div class="absolute bottom-[-20%] right-[-10%] w-[60%] h-[60%] rounded-full bg-neon-magenta/10 blur-[180px] animate-pulse" style="animation-delay: -3s"></div>
            <div class="absolute inset-0 grain opacity-[0.4]"></div>
        </div>

        <div class="flex flex-col lg:flex-row gap-10 min-h-[calc(100vh-80px)] items-stretch">
            
            {{-- FLOATING SIDEBAR PANEL --}}
            <aside class="lg:w-80 shrink-0">
                <div class="glass-panel h-full rounded-[2.5rem] p-8 flex flex-col sticky top-10">
                    <div class="flex items-center gap-4 mb-12 px-2">
                        <div class="size-10 rounded-2xl bg-gradient-to-br from-neon-cyan to-neon-indigo shadow-[0_0_20px_rgba(34,211,238,0.4)] flex items-center justify-center">
                            <flux:icon name="command-line" size="sm" class="text-slate-900" />
                        </div>
                        <h2 class="text-xl font-black text-white tracking-tighter uppercase">Aura Pro</h2>
                    </div>

                    <flux:sidebar class="flex-1">
                        <flux:sidebar.nav>
                            <flux:sidebar.group heading="CORE" class="!text-slate-600 !tracking-[0.4em] !text-[9px] !font-black !mb-6">
                                @can('view-backend-dashboard')
                                    <flux:sidebar.item icon="home" :href="route('backend.dashboard')" :current="request()->routeIs('backend.dashboard')">Dashboard</flux:sidebar.item>
                                @endcan
                            </flux:sidebar.group>

                            <flux:sidebar.group heading="WORKSPACE" class="!text-slate-600 !tracking-[0.4em] !text-[9px] !font-black !mb-6 !mt-8">
                                <flux:sidebar.item icon="newspaper" :href="route('backend.posts.index')" :current="request()->routeIs('backend.posts.*')">Posts</flux:sidebar.item>
                                <flux:sidebar.item icon="folder" :href="route('backend.categories.index')" :current="request()->routeIs('backend.categories.*')">Categories</flux:sidebar.item>
                                <flux:sidebar.item icon="photo" :href="route('backend.media.index')" :current="request()->routeIs('backend.media.*')">Media</flux:sidebar.item>
                            </flux:sidebar.group>

                            <flux:sidebar.group heading="ADMIN" class="!text-slate-600 !tracking-[0.4em] !text-[9px] !font-black !mb-6 !mt-8">
                                <flux:sidebar.item icon="users" :href="route('backend.users.index')" :current="request()->routeIs('backend.users.*')">Users</flux:sidebar.item>
                                <flux:sidebar.item icon="shield-check" :href="route('backend.roles.index')" :current="request()->routeIs('backend.roles.*')">Roles</flux:sidebar.item>
                            </flux:sidebar.group>
                        </flux:sidebar.nav>
                    </flux:sidebar>

                    <div class="mt-auto pt-8 border-t border-white/5 flex items-center justify-between">
                        <flux:dropdown position="top" align="start">
                            <div class="flex items-center gap-3 cursor-pointer group">
                                <flux:avatar initials="{{ auth()->user()->initials() }}" size="sm" class="!bg-white/5 !border-white/10 group-hover:!border-neon-cyan/50 transition-all" />
                                <div class="hidden lg:block">
                                    <div class="text-[11px] font-black text-white uppercase tracking-wider">{{ auth()->user()->name }}</div>
                                    <div class="text-[9px] font-bold text-slate-500 uppercase tracking-[0.2em] mt-0.5">Administrator</div>
                                </div>
                            </div>
                            <flux:menu class="!bg-black/80 !backdrop-blur-[40px] !border-white/10 !rounded-3xl min-w-56">
                                <flux:menu.item icon="cog-8-tooth" :href="route('profile.edit')">Settings</flux:menu.item>
                                <flux:menu.separator class="!border-white/5" />
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <flux:menu.item as="button" type="submit" icon="arrow-right-start-on-rectangle" class="!text-rose-400">Log Out</flux:menu.item>
                                </form>
                            </flux:menu>
                        </flux:dropdown>
                        <flux:button variant="ghost" icon="bell" size="sm" class="!text-slate-500 hover:!text-white" />
                    </div>
                </div>
            </aside>

            {{-- MAIN CONTENT PANEL --}}
            <main class="flex-1 min-w-0">
                <div class="glass-panel h-full rounded-[2.5rem] p-10 lg:p-14 relative overflow-hidden">
                    {{-- Page Header --}}
                    <div class="flex flex-col md:flex-row md:items-end justify-between gap-6 mb-16 relative z-10">
                        <div>
                            @if($title)
                                <h1 class="text-6xl font-[1000] text-white tracking-tighter uppercase leading-[0.9] mb-4">
                                    {{ $title }}
                                </h1>
                            @endif
                            <div class="flex items-center gap-3">
                                <span class="size-1.5 rounded-full bg-neon-cyan shadow-[0_0_10px_rgba(34,211,238,1)]"></span>
                                <flux:breadcrumbs class="!text-[10px] !font-black !text-slate-500 uppercase tracking-[0.3em]" />
                            </div>
                        </div>
                        <div class="flex items-center gap-3">
                            {{ $actions ?? '' }}
                        </div>
                    </div>

                    <x-backend.flash />

                    <div class="relative z-10">
                        {{ $slot }}
                    </div>

                    {{-- Background Aura inside main content --}}
                    <div class="absolute -top-[10%] -right-[10%] w-64 h-64 bg-neon-indigo/5 rounded-full blur-[100px] pointer-events-none"></div>
                </div>
            </main>

        </div>

        @fluxScripts
        {{ $scripts ?? '' }}
    </body>
</html>
