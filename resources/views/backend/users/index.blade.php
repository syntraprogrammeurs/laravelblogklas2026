<x-backend.shell title="Users">

    <x-slot:actions>
        @can('create', \App\Models\User::class)
            <flux:button icon="plus" variant="primary" :href="route('backend.users.create')" class="!rounded-xl !bg-blue-600">New User</flux:button>
        @endcan
    </x-slot:actions>

    <x-backend.card>
        <form method="GET" action="{{ route('backend.users.index') }}" class="mb-10">
            <div class="grid grid-cols-1 md:grid-cols-4 lg:grid-cols-5 gap-6 items-end">
                <div class="md:col-span-2">
                    <flux:field>
                        <flux:label>Search</flux:label>
                        <flux:input name="q" value="{{ $filters['q'] }}" placeholder="Search name or email..." clearable />
                    </flux:field>
                </div>

                <div>
                    <flux:field>
                        <flux:label>Role</flux:label>
                        <flux:select name="role">
                            <flux:select.option value="">All roles</flux:select.option>
                            @foreach($roles as $role)
                                <flux:select.option value="{{ $role->id }}" @selected((string) $filters['role'] === (string) $role->id)>
                                    {{ $role->name }}
                                </flux:select.option>
                            @endforeach
                        </flux:select>
                    </flux:field>
                </div>

                <div class="flex gap-3">
                    <flux:button type="submit" variant="filled" class="flex-1 !rounded-xl !bg-white/10 !border-white/10">Apply</flux:button>
                    <flux:button :href="route('backend.users.index')" variant="ghost" icon="x-mark" class="!rounded-xl" />
                </div>
            </div>
        </form>

        <div class="overflow-x-auto -mx-8">
            <table class="w-full text-left">
                <thead>
                    <tr class="bg-white/5 border-y border-white/10">
                        <th class="px-8 py-4 font-bold text-slate-400 text-xs uppercase tracking-widest">User</th>
                        <th class="px-8 py-4 font-bold text-slate-400 text-xs uppercase tracking-widest text-center">Role</th>
                        <th class="px-8 py-4 font-bold text-slate-400 text-xs uppercase tracking-widest text-center">Status</th>
                        <th class="px-8 py-4 font-bold text-slate-400 text-xs uppercase tracking-widest">Joined</th>
                        <th class="px-8 py-4"></th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-white/5">
                    @forelse ($users as $user)
                        <tr class="hover:bg-white/5 transition-all group">
                            <td class="px-8 py-5">
                                <div class="flex items-center gap-4">
                                    <flux:avatar initials="{{ $user->initials() }}" size="sm" class="!bg-white/10 !border-white/10" />
                                    <div>
                                        <div class="text-sm font-bold text-white">{{ $user->name }}</div>
                                        <div class="text-xs text-slate-500 font-medium">{{ $user->email }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-8 py-5 text-center">
                                @foreach($user->roles as $role)
                                    <flux:badge size="sm" class="!bg-white/10 !text-white !border-white/10">{{ $role->name }}</flux:badge>
                                @endforeach
                            </td>
                            <td class="px-8 py-5 text-center">
                                @if($user->is_active)
                                    <flux:badge variant="success" size="sm" inset="top bottom">Active</flux:badge>
                                @else
                                    <flux:badge variant="danger" size="sm" inset="top bottom">Inactive</flux:badge>
                                @endif
                            </td>
                            <td class="px-8 py-5">
                                <div class="text-sm font-medium text-slate-300">{{ $user->created_at->format('M d, Y') }}</div>
                                <div class="text-xs text-slate-500 font-medium">{{ $user->created_at->diffForHumans() }}</div>
                            </td>
                            <td class="px-8 py-5 text-right">
                                <flux:dropdown>
                                    <flux:button icon="ellipsis-horizontal" variant="ghost" size="sm" class="hover:!bg-white/10" />
                                    <flux:menu class="!bg-slate-900/95 !backdrop-blur-xl !border-white/10">
                                        @can('update', $user)
                                            <flux:menu.item icon="pencil-square" :href="route('backend.users.edit', $user)">Edit</flux:menu.item>
                                        @endcan
                                        @can('delete', $user)
                                            <flux:menu.separator class="!border-white/5" />
                                            <form action="{{ route('backend.users.destroy', $user) }}" method="POST" onsubmit="return confirm('Delete this user?')">
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
                            <td colspan="5" class="px-8 py-16 text-center italic text-slate-500 font-medium">No users found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if ($users->hasPages())
            <div class="px-8 py-6 border-t border-white/10 bg-white/5 mt-4 rounded-b-2xl">
                {{ $users->links() }}
            </div>
        @endif
    </x-backend.card>

</x-backend.shell>
