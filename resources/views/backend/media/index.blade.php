<x-backend.shell title="Media">

    <x-slot:actions>
        @can('create', \App\Models\Media::class)
            <flux:button icon="plus" variant="primary" :href="route('backend.media.create')" class="!rounded-xl !bg-blue-600">Upload Media</flux:button>
        @endcan
    </x-slot:actions>

    <x-backend.card>
        <form method="GET" action="{{ route('backend.media.index') }}" class="mb-10">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6 items-end">
                <div class="md:col-span-2">
                    <flux:field>
                        <flux:label>Search</flux:label>
                        <flux:input name="q" value="{{ $filters['q'] }}" placeholder="Search filename or description..." clearable />
                    </flux:field>
                </div>

                <div class="flex gap-3">
                    <flux:button type="submit" variant="filled" class="flex-1 !rounded-xl !bg-white/10 !border-white/10">Apply</flux:button>
                    <flux:button :href="route('backend.media.index')" variant="ghost" icon="x-mark" class="!rounded-xl" />
                </div>
            </div>
        </form>

        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-6">
            @forelse ($media as $item)
                <div class="group relative aspect-square glass rounded-2xl overflow-hidden hover:scale-[1.02] transition-all duration-300">
                    <img src="{{ $item->url() }}" alt="{{ $item->filename }}" class="w-full h-full object-cover">
                    
                    {{-- Overlay info --}}
                    <div class="absolute inset-0 bg-slate-950/60 opacity-0 group-hover:opacity-100 transition-opacity backdrop-blur-sm p-4 flex flex-col justify-between">
                        <div class="flex justify-end">
                            <flux:dropdown>
                                <flux:button icon="ellipsis-vertical" variant="ghost" size="xs" class="!text-white hover:!bg-white/20" />
                                <flux:menu class="!bg-slate-900/95 !backdrop-blur-xl !border-white/10">
                                    <flux:menu.item icon="eye" :href="route('backend.media.show', $item)">Details</flux:menu.item>
                                    @can('update', $item)
                                        <flux:menu.item icon="pencil-square" :href="route('backend.media.edit', $item)">Edit</flux:menu.item>
                                    @endcan
                                    @can('delete', $item)
                                        <flux:menu.separator class="!border-white/5" />
                                        <form action="{{ route('backend.media.destroy', $item) }}" method="POST" onsubmit="return confirm('Delete this media?')">
                                            @csrf
                                            @method('DELETE')
                                            <flux:menu.item as="button" type="submit" icon="trash" variant="danger">Delete</flux:menu.item>
                                        </form>
                                    @endcan
                                </flux:menu>
                            </flux:dropdown>
                        </div>
                        
                        <div>
                            <div class="text-xs font-bold text-white truncate">{{ $item->filename }}</div>
                            <div class="text-[10px] text-slate-300 font-medium">{{ $item->mime_type }}</div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-full py-16 text-center italic text-slate-500 font-medium">No media found.</div>
            @endforelse
        </div>

        @if ($media->hasPages())
            <div class="px-8 py-6 border-t border-white/10 bg-white/5 mt-10 rounded-b-2xl">
                {{ $media->links() }}
            </div>
        @endif
    </x-backend.card>

</x-backend.shell>
