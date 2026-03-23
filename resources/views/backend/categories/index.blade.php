<x-backend.shell title="Categories">
    <x-slot:actions>
        @can('create', \App\Models\Category::class)
            <flux:button :href="route('backend.categories.create')" icon="plus" variant="primary" class="rounded-xl">
                New Category
            </flux:button>
        @endcan
    </x-slot:actions>

    <x-backend.card>
        {{-- Filters Section --}}
        <form method="GET" action="{{ route('backend.categories.index') }}" class="mb-10">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-6 items-end">
                <div class="lg:col-span-2">
                    <flux:field>
                        <flux:label class="!text-white/70 font-bold text-[10px] uppercase tracking-widest mb-2">Search</flux:label>
                        <flux:input
                            name="q"
                            value="{{ $filters['q'] }}"
                            placeholder="Search name, slug or description..."
                            clearable
                            class="!bg-white/5 !border-white/10 focus:!border-white/20 !text-white rounded-xl h-11"
                        />
                    </flux:field>
                </div>

                <div>
                    <flux:field>
                        <flux:label class="!text-white/70 font-bold text-[10px] uppercase tracking-widest mb-2">Per Page</flux:label>
                        <flux:select name="per_page" class="!bg-white/5 !border-white/10 !text-white rounded-xl h-11">
                            @foreach($perPageAllowed as $n)
                                <flux:select.option value="{{ $n }}" @selected((int)$filters['per_page'] === (int)$n)>{{ $n }}</flux:select.option>
                            @endforeach
                        </flux:select>
                    </flux:field>
                </div>

                <div>
                    <flux:field>
                        <flux:label class="!text-white/70 font-bold text-[10px] uppercase tracking-widest mb-2">Deleted</flux:label>
                        <flux:select name="trashed" class="!bg-white/5 !border-white/10 !text-white rounded-xl h-11">
                            <flux:select.option value="">Active only</flux:select.option>
                            <flux:select.option value="with" @selected($filters['trashed'] === 'with')>Active + deleted</flux:select.option>
                            <flux:select.option value="only" @selected($filters['trashed'] === 'only')>Deleted only</flux:select.option>
                        </flux:select>
                    </flux:field>
                </div>

                <div class="flex gap-2">
                    <flux:button type="submit" variant="filled" class="flex-1 rounded-xl h-11 !bg-white/10 hover:!bg-white/20 !border-white/10 !text-white transition-all">Apply</flux:button>
                    <flux:button :href="route('backend.categories.index')" variant="ghost" icon="x-mark" class="rounded-xl h-11 hover:!bg-white/10 !text-slate-400" />
                </div>
            </div>
            
            <input type="hidden" name="sort" value="{{ $filters['sort'] }}">
            <input type="hidden" name="dir" value="{{ $filters['dir'] }}">
        </form>

        @php
            $sortUrl = function (string $col) use ($filters) {
                $newDir = ($filters['sort'] === $col && $filters['dir'] === 'asc') ? 'desc' : 'asc';

                return route('backend.categories.index', [
                    'q' => $filters['q'],
                    'trashed' => $filters['trashed'],
                    'per_page' => $filters['per_page'],
                    'sort' => $col,
                    'dir' => $newDir,
                ]);
            };

            $sortIcon = function (string $col) use ($filters) {
                if ($filters['sort'] !== $col) return 'arrows-up-down';
                return $filters['dir'] === 'asc' ? 'chevron-up' : 'chevron-down';
            };
        @endphp

        {{-- Categories Table --}}
        <div class="overflow-x-auto -mx-8">
            <table class="w-full text-left">
                <thead>
                    <tr class="bg-white/5 border-y border-white/10">
                        <th class="px-8 py-4">
                            <a href="{{ $sortUrl('id') }}" class="flex items-center gap-2 font-bold text-slate-400 text-xs uppercase tracking-wider hover:text-white transition-colors">
                                ID <flux:icon :name="$sortIcon('id')" size="xs" />
                            </a>
                        </th>
                        <th class="px-8 py-4">
                            <a href="{{ $sortUrl('name') }}" class="flex items-center gap-2 font-bold text-slate-400 text-xs uppercase tracking-wider hover:text-white transition-colors">
                                Name <flux:icon :name="$sortIcon('name')" size="xs" />
                            </a>
                        </th>
                        <th class="px-8 py-4 font-bold text-slate-400 text-xs uppercase tracking-wider">Slug</th>
                        <th class="px-8 py-4 font-bold text-slate-400 text-xs uppercase tracking-wider">Description</th>
                        <th class="px-8 py-4 font-bold text-slate-400 text-xs uppercase tracking-wider text-center">Posts</th>
                        <th class="px-8 py-4">
                            <a href="{{ $sortUrl('created_at') }}" class="flex items-center gap-2 font-bold text-slate-400 text-xs uppercase tracking-wider hover:text-white transition-colors">
                                Created <flux:icon :name="$sortIcon('created_at')" size="xs" />
                            </a>
                        </th>
                        <th class="px-8 py-4"></th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-white/10">
                    @forelse($categories as $category)
                        <tr class="hover:bg-white/5 transition-colors group">
                            <td class="px-8 py-5">
                                <flux:text size="sm" class="font-mono !text-slate-400">{{ $category->id }}</flux:text>
                            </td>
                            <td class="px-8 py-5">
                                <div class="flex items-center gap-2">
                                    <flux:text size="sm" class="font-bold !text-white group-hover:text-white transition-colors">{{ $category->name }}</flux:text>
                                    @if($category->deleted_at)
                                        <flux:badge variant="danger" size="sm" class="rounded-lg">deleted</flux:badge>
                                    @endif
                                </div>
                            </td>
                            <td class="px-8 py-5">
                                <flux:text size="xs" class="!text-slate-500 group-hover:text-slate-400 transition-colors">{{ $category->slug }}</flux:text>
                            </td>
                            <td class="px-8 py-5">
                                <flux:text size="sm" class="!text-slate-400 line-clamp-1">{{ $category->description ?: '-' }}</flux:text>
                            </td>
                            <td class="px-8 py-5 text-center">
                                <flux:badge size="sm" class="rounded-lg !bg-white/5 !border-white/10 !text-slate-300">{{ $category->posts_count }}</flux:badge>
                            </td>
                            <td class="px-8 py-5">
                                <flux:text size="sm" class="!text-slate-400 whitespace-nowrap">{{ optional($category->created_at)->format('M d, Y') }}</flux:text>
                            </td>
                            <td class="px-8 py-5 text-right">
                                <flux:dropdown>
                                    <flux:button icon="ellipsis-horizontal" variant="ghost" size="sm" class="rounded-xl hover:!bg-white/10" />
                                    <flux:menu class="!bg-slate-900/90 !backdrop-blur-xl !border-white/10 min-w-48">
                                        <flux:menu.item icon="eye" :href="route('backend.categories.show', $category)">View</flux:menu.item>
                                        
                                        @if(! $category->deleted_at)
                                            <flux:menu.item icon="pencil-square" :href="route('backend.categories.edit', $category)">Edit</flux:menu.item>
                                            <flux:menu.separator class="!border-white/5" />
                                            <form method="POST" action="{{ route('backend.categories.destroy', $category) }}">
                                                @csrf
                                                @method('DELETE')
                                                <flux:menu.item as="button" type="submit" icon="trash" variant="danger" onclick="return confirm('Are you sure?')">
                                                    Delete
                                                </flux:menu.item>
                                            </form>
                                        @else
                                            <flux:menu.separator class="!border-white/5" />
                                            <form method="POST" action="{{ route('backend.categories.restore', $category->id) }}">
                                                @csrf
                                                @method('PATCH')
                                                <flux:menu.item as="button" type="submit" icon="arrow-path" onclick="return confirm('Restore this category?')">
                                                    Restore
                                                </flux:menu.item>
                                            </form>
                                            <form method="POST" action="{{ route('backend.categories.forceDelete', $category->id) }}">
                                                @csrf
                                                @method('DELETE')
                                                <flux:menu.item as="button" type="submit" icon="trash" variant="danger" onclick="return confirm('Permanently delete?')">
                                                    Force Delete
                                                </flux:menu.item>
                                            </form>
                                        @endif
                                    </flux:menu>
                                </flux:dropdown>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-8 py-16 text-center">
                                <div class="flex flex-col items-center justify-center">
                                    <flux:icon name="folder" size="xl" class="text-white/10 mb-4" />
                                    <flux:text class="!text-slate-500 italic">No categories found matching your criteria.</flux:text>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="px-8 py-6 border-t border-white/10 flex flex-col md:flex-row items-center justify-between gap-4">
            <flux:text size="sm" class="!text-slate-500">
                Showing {{ $categories->firstItem() ?? 0 }} to {{ $categories->lastItem() ?? 0 }} of {{ $categories->total() }}
            </flux:text>
            <div>
                {{ $categories->links() }}
            </div>
        </div>
    </x-backend.card>
</x-backend.shell>
