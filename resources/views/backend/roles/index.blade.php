<x-backend.shell title="Roles">

    <x-slot:actions>
        @can('create', \App\Models\Role::class)
            <flux:button icon="plus" variant="primary" :href="route('backend.roles.create')" class="!rounded-xl !bg-blue-600">New Role</flux:button>
        @endcan
    </x-slot:actions>

    <x-backend.card>
        <div class="overflow-x-auto -mx-8">
            <table class="w-full text-left">
                <thead>
                    <tr class="bg-white/5 border-y border-white/10">
                        <th class="px-8 py-4 font-bold text-slate-400 text-xs uppercase tracking-widest">Name</th>
                        <th class="px-8 py-4 font-bold text-slate-400 text-xs uppercase tracking-widest">Permissions Count</th>
                        <th class="px-8 py-4 font-bold text-slate-400 text-xs uppercase tracking-widest">Users</th>
                        <th class="px-8 py-4"></th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-white/5">
                    @forelse ($roles as $role)
                        <tr class="hover:bg-white/5 transition-all group">
                            <td class="px-8 py-5">
                                <div class="text-sm font-bold text-white tracking-tight">{{ $role->name }}</div>
                                <div class="text-xs text-slate-500 font-medium">Internal ID: {{ $role->id }}</div>
                            </td>
                            <td class="px-8 py-5">
                                <flux:badge variant="neutral" size="sm" class="!bg-white/10 !border-white/10 !text-white">
                                    {{ count($role->permissions ?? []) }} Permissions
                                </flux:badge>
                            </td>
                            <td class="px-8 py-5">
                                <div class="flex -space-x-2">
                                    @foreach($role->users->take(5) as $user)
                                        <flux:avatar initials="{{ $user->initials() }}" size="xs" class="!ring-2 !ring-slate-900 !bg-white/10 !border-white/10" />
                                    @endforeach
                                    @if($role->users->count() > 5)
                                        <div class="size-6 rounded-full glass flex items-center justify-center text-[10px] font-bold text-white ring-2 ring-slate-900">
                                            +{{ $role->users->count() - 5 }}
                                        </div>
                                    @endif
                                </div>
                            </td>
                            <td class="px-8 py-5 text-right">
                                <flux:dropdown>
                                    <flux:button icon="ellipsis-horizontal" variant="ghost" size="sm" class="hover:!bg-white/10" />
                                    <flux:menu class="!bg-slate-900/95 !backdrop-blur-xl !border-white/10">
                                        @can('update', $role)
                                            <flux:menu.item icon="pencil-square" :href="route('backend.roles.edit', $role)">Edit</flux:menu.item>
                                        @endcan
                                        @can('delete', $role)
                                            <flux:menu.separator class="!border-white/5" />
                                            <form action="{{ route('backend.roles.destroy', $role) }}" method="POST" onsubmit="return confirm('Delete this role?')">
                                                @csrf
                                                @method('DELETE')
                                                <flux:menu.item as="button" type="submit" icon="trash" variant="danger">Delete</flux:menu.item>
                                            </form>
                                        @endcan
                                    </flux:menu>
                                </flux:dropdown>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-8 py-16 text-center italic text-slate-500 font-medium">No roles found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </x-backend.card>

</x-backend.shell>
