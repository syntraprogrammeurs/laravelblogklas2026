<x-backend.shell title="Post Details">
    <x-slot:actions>
        @if(! $post->deleted_at)
            @can('update', $post)
                <flux:button :href="route('backend.posts.edit', $post)" icon="pencil-square" variant="primary" class="rounded-xl">
                    Edit Post
                </flux:button>
            @endcan
        @endif
        <flux:button :href="route('backend.posts.index')" icon="arrow-left" variant="ghost" class="rounded-xl hover:!bg-white/10 !text-slate-300">
            Back to List
        </flux:button>
    </x-slot:actions>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <div class="lg:col-span-2 space-y-8">
            <x-backend.card title="Post Content">
                <div class="space-y-8">
                    @if($post->media)
                        <div class="p-2 bg-white/5 border border-white/10 rounded-2xl overflow-hidden shadow-2xl">
                            <img
                                src="{{ $post->media->url() }}"
                                class="w-full h-auto rounded-xl object-cover"
                                style="max-height: 400px;"
                            >
                        </div>
                    @endif

                    <div class="space-y-4">
                        <flux:heading size="xl" class="!text-white font-black tracking-tight">{{ $post->title }}</flux:heading>
                        <flux:text size="sm" class="!text-slate-400 font-mono bg-white/5 px-3 py-1 rounded-lg w-fit border border-white/5">
                            {{ $post->slug }}
                        </flux:text>
                    </div>

                    <div class="prose prose-invert max-w-none">
                        <flux:text class="!text-slate-300 leading-relaxed text-lg">
                            {{ $post->excerpt }}
                        </flux:text>
                        
                        <div class="my-8 border-t border-white/10"></div>
                        
                        <flux:text class="!text-slate-200 leading-relaxed whitespace-pre-wrap">
                            {{ $post->body }}
                        </flux:text>
                    </div>
                </div>
            </x-backend.card>
        </div>

        <div class="space-y-8">
            <x-backend.card title="Meta Information">
                <div class="space-y-6">
                    <div class="flex flex-col gap-1.5">
                        <flux:text size="xs" class="!text-slate-500 font-bold uppercase tracking-widest">Status</flux:text>
                        @if($post->is_published)
                            <flux:badge variant="success" size="sm" class="rounded-lg w-fit px-3">Published</flux:badge>
                        @else
                            <flux:badge variant="neutral" size="sm" class="rounded-lg w-fit px-3 !bg-white/5 !border-white/10 !text-slate-400">Draft</flux:badge>
                        @endif
                    </div>

                    <div class="flex flex-col gap-1.5">
                        <flux:text size="xs" class="!text-slate-500 font-bold uppercase tracking-widest">Author</flux:text>
                        <div class="flex items-center gap-3 p-3 bg-white/5 border border-white/10 rounded-xl">
                            <flux:avatar initials="{{ $post->user?->initials() }}" size="sm" class="border border-white/10" />
                            <flux:text class="!text-white font-medium">{{ $post->user?->name ?? 'Unknown' }}</flux:text>
                        </div>
                    </div>

                    <div class="flex flex-col gap-1.5">
                        <flux:text size="xs" class="!text-slate-500 font-bold uppercase tracking-widest">Categories</flux:text>
                        <div class="flex flex-wrap gap-2">
                            @forelse($post->categories as $category)
                                <flux:badge size="sm" class="rounded-lg !bg-white/5 !border-white/10 !text-slate-300" inset="top bottom">{{ $category->name }}</flux:badge>
                            @empty
                                <flux:text size="sm" class="italic !text-slate-600">No categories assigned</flux:text>
                            @endforelse
                        </div>
                    </div>

                    <div class="pt-4 border-t border-white/10 space-y-4">
                        <div class="flex justify-between items-center">
                            <flux:text size="xs" class="!text-slate-500 font-bold uppercase tracking-widest">Published At</flux:text>
                            <flux:text size="sm" class="!text-slate-300">{{ optional($post->published_at)->format('M d, Y H:i') ?? '-' }}</flux:text>
                        </div>
                        <div class="flex justify-between items-center">
                            <flux:text size="xs" class="!text-slate-500 font-bold uppercase tracking-widest">Created At</flux:text>
                            <flux:text size="sm" class="!text-slate-300">{{ optional($post->created_at)->format('M d, Y H:i') }}</flux:text>
                        </div>
                        <div class="flex justify-between items-center">
                            <flux:text size="xs" class="!text-slate-500 font-bold uppercase tracking-widest">Updated At</flux:text>
                            <flux:text size="sm" class="!text-slate-300">{{ optional($post->updated_at)->format('M d, Y H:i') }}</flux:text>
                        </div>
                    </div>
                </div>
            </x-backend.card>

            <x-backend.card title="System Data">
                <div class="space-y-4">
                    <div class="flex justify-between items-center">
                        <flux:text size="xs" class="!text-slate-500 font-bold uppercase tracking-widest">Post ID</flux:text>
                        <flux:text size="sm" class="!text-slate-300 font-mono">{{ $post->id }}</flux:text>
                    </div>
                    <div class="flex justify-between items-center">
                        <flux:text size="xs" class="!text-slate-500 font-bold uppercase tracking-widest">Created By</flux:text>
                        <flux:text size="sm" class="!text-slate-300">{{ $post->creator?->name ?? '-' }}</flux:text>
                    </div>
                    <div class="flex justify-between items-center">
                        <flux:text size="xs" class="!text-slate-500 font-bold uppercase tracking-widest">Last Editor</flux:text>
                        <flux:text size="sm" class="!text-slate-300">{{ $post->editor?->name ?? '-' }}</flux:text>
                    </div>
                </div>
            </x-backend.card>
        </div>
    </div>
</x-backend.shell>
