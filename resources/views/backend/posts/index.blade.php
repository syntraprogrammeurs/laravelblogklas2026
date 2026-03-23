<x-backend.shell title="Posts">

    <x-slot:actions>
        @can('create', \App\Models\Post::class)
            <flux:button icon="plus" variant="primary" class="rounded-xl" :href="route('backend.posts.create')">New Post</flux:button>
        @endcan
    </x-slot:actions>

    <x-backend.card>
        {{-- Filters Section --}}
        <form method="GET" action="{{ route('backend.posts.index') }}" class="mb-10">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-6 gap-6 items-end">
                <div class="lg:col-span-2">
                    <flux:field>
                        <flux:label class="!text-white/70 font-bold text-[10px] uppercase tracking-widest mb-2">Search</flux:label>
                        <flux:input
                            name="q"
                            value="{{ $filters['q'] }}"
                            placeholder="Search title, slug, excerpt or body..."
                            clearable
                            class="!bg-white/5 !border-white/10 focus:!border-white/20 !text-white rounded-xl h-11"
                        />
                    </flux:field>
                </div>

                <div>
                    <flux:field>
                        <flux:label class="!text-white/70 font-bold text-[10px] uppercase tracking-widest mb-2">Author</flux:label>
                        <flux:select name="author" class="!bg-white/5 !border-white/10 !text-white rounded-xl h-11">
                            <flux:select.option value="">All authors</flux:select.option>
                            @foreach($authors as $author)
                                <flux:select.option value="{{ $author->id }}" @selected((string) $filters['author'] === (string) $author->id)>
                                    {{ $author->name }}
                                </flux:select.option>
                            @endforeach
                        </flux:select>
                    </flux:field>
                </div>

                <div>
                    <flux:field>
                        <flux:label class="!text-white/70 font-bold text-[10px] uppercase tracking-widest mb-2">Category</flux:label>
                        <flux:select name="category" class="!bg-white/5 !border-white/10 !text-white rounded-xl h-11">
                            <flux:select.option value="">All categories</flux:select.option>
                            @foreach($categories as $category)
                                <flux:select.option value="{{ $category->id }}" @selected((string) $filters['category'] === (string) $category->id)>
                                    {{ $category->name }}
                                </flux:select.option>
                            @endforeach
                        </flux:select>
                    </flux:field>
                </div>

                <div>
                    <flux:field>
                        <flux:label class="!text-white/70 font-bold text-[10px] uppercase tracking-widest mb-2">Status</flux:label>
                        <flux:select name="status" class="!bg-white/5 !border-white/10 !text-white rounded-xl h-11">
                            <flux:select.option value="">All</flux:select.option>
                            <flux:select.option value="published" @selected($filters['status'] === 'published')>Published</flux:select.option>
                            <flux:select.option value="draft" @selected($filters['status'] === 'draft')>Draft</flux:select.option>
                        </flux:select>
                    </flux:field>
                </div>

                <div class="flex gap-2">
                    <flux:button type="submit" variant="filled" class="flex-1 rounded-xl h-11 !bg-white/10 hover:!bg-white/20 !border-white/10 !text-white transition-all">Apply</flux:button>
                    <flux:button :href="route('backend.posts.index')" variant="ghost" icon="x-mark" class="rounded-xl h-11 hover:!bg-white/10 !text-slate-400" />
                </div>
            </div>
        </form>

        {{-- Posts Table --}}
        <div class="overflow-x-auto -mx-8">
            <table class="w-full text-left">
                <thead>
                    <tr class="bg-white/5 border-y border-white/10">
                        <th class="px-8 py-4 font-bold text-slate-400 text-xs uppercase tracking-wider">
                            Title / Slug
                        </th>
                        <th class="px-8 py-4 font-bold text-slate-400 text-xs uppercase tracking-wider text-center">
                            Categories
                        </th>
                        <th class="px-8 py-4 font-bold text-slate-400 text-xs uppercase tracking-wider">
                            Author
                        </th>
                        <th class="px-8 py-4 font-bold text-slate-400 text-xs uppercase tracking-wider text-center">
                            Status
                        </th>
                        <th class="px-8 py-4 font-bold text-slate-400 text-xs uppercase tracking-wider">
                            Created
                        </th>
                        <th class="px-8 py-4"></th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-white/10">
                    @forelse ($posts as $post)
                        <tr class="hover:bg-white/5 transition-colors group">
                            <td class="px-8 py-5">
                                <flux:text size="sm" class="font-bold !text-white group-hover:text-white transition-colors">
                                    {{ $post->title }}
                                </flux:text>
                                <flux:text size="xs" class="!text-slate-500 group-hover:text-slate-400 transition-colors">
                                    {{ $post->slug }}
                                </flux:text>
                            </td>
                            <td class="px-8 py-5">
                                <div class="flex flex-wrap justify-center gap-1.5">
                                    @foreach($post->categories as $cat)
                                        <flux:badge size="sm" class="rounded-lg !bg-white/5 !border-white/10 !text-slate-300" inset="top bottom">{{ $cat->name }}</flux:badge>
                                    @endforeach
                                </div>
                            </td>
                            <td class="px-8 py-5">
                                <div class="flex items-center gap-2.5">
                                    <flux:avatar initials="{{ $post->user?->initials() }}" size="xs" class="border border-white/10" />
                                    <flux:text size="sm" class="!text-slate-300">{{ $post->user->name ?? 'Unknown' }}</flux:text>
                                </div>
                            </td>
                            <td class="px-8 py-5 text-center">
                                @if ($post->status === 'published')
                                    <flux:badge variant="success" size="sm" class="rounded-lg" inset="top bottom">Published</flux:badge>
                                @else
                                    <flux:badge variant="neutral" size="sm" class="rounded-lg !bg-white/5 !border-white/10 !text-slate-400" inset="top bottom">Draft</flux:badge>
                                @endif
                            </td>
                            <td class="px-8 py-5">
                                <flux:text size="sm" class="whitespace-nowrap font-medium !text-slate-300">
                                    {{ $post->created_at->format('M d, Y') }}
                                </flux:text>
                                <flux:text size="xs" class="!text-slate-500">
                                    {{ $post->created_at->diffForHumans() }}
                                </flux:text>
                            </td>
                            <td class="px-8 py-5 text-right">
                                <flux:dropdown>
                                    <flux:button icon="ellipsis-horizontal" variant="ghost" size="sm" class="rounded-xl hover:!bg-white/10" />
                                    <flux:menu class="!bg-slate-900/90 !backdrop-blur-xl !border-white/10 min-w-48">
                                        @can('view', $post)
                                            <flux:menu.item icon="eye" :href="route('backend.posts.show', $post)">View</flux:menu.item>
                                        @endcan
                                        @can('update', $post)
                                            <flux:menu.item icon="pencil-square" :href="route('backend.posts.edit', $post)">Edit</flux:menu.item>
                                        @endcan
                                        <flux:menu.separator class="!border-white/5" />
                                        @can('delete', $post)
                                            <form action="{{ route('backend.posts.destroy', $post) }}" method="POST" onsubmit="return confirm('Are you sure?')">
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
                            <td colspan="6" class="px-8 py-16 text-center">
                                <div class="flex flex-col items-center justify-center">
                                    <flux:icon name="newspaper" size="xl" class="text-white/10 mb-4" />
                                    <flux:text class="!text-slate-500 italic">No posts found matching your criteria.</flux:text>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if ($posts->hasPages())
            <div class="px-8 py-6 border-t border-white/10">
                {{ $posts->links() }}
            </div>
        @endif
    </x-backend.card>

</x-backend.shell>

