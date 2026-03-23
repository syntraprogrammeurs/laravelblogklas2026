<x-backend.shell title="{{ isset($post) ? 'Edit Post' : 'Create Post' }}">

    <x-slot:actions>
        <flux:button variant="ghost" icon="chevron-left" :href="route('backend.posts.index')" class="!rounded-xl">Back to List</flux:button>
    </x-slot:actions>

    <form method="POST" action="{{ isset($post) ? route('backend.posts.update', $post) : route('backend.posts.store') }}" enctype="multipart/form-data">
        @csrf
        @if(isset($post)) @method('PUT') @endif

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 items-start">
            {{-- Main Content --}}
            <div class="lg:col-span-2 space-y-8">
                <x-backend.card title="Content Details">
                    <div class="space-y-6">
                        <flux:field>
                            <flux:label>Title</flux:label>
                            <flux:input name="title" value="{{ old('title', $post->title ?? '') }}" placeholder="Enter post title..." />
                        </flux:field>

                        <flux:field>
                            <flux:label>Excerpt</flux:label>
                            <flux:textarea name="excerpt" rows="3" placeholder="Brief summary of the post...">{{ old('excerpt', $post->excerpt ?? '') }}</flux:textarea>
                        </flux:field>

                        <flux:field>
                            <flux:label>Body Content</flux:label>
                            <flux:textarea name="body" rows="15" placeholder="Write your content here...">{{ old('body', $post->body ?? '') }}</flux:textarea>
                        </flux:field>
                    </div>
                </x-backend.card>
            </div>

            {{-- Sidebar --}}
            <div class="space-y-8">
                <x-backend.card title="Publication">
                    <div class="space-y-6">
                        <flux:field>
                            <flux:label>Status</flux:label>
                            <flux:select name="status">
                                <flux:select.option value="draft" @selected(old('status', $post->status ?? '') === 'draft')>Draft</flux:select.option>
                                <flux:select.option value="published" @selected(old('status', $post->status ?? '') === 'published')>Published</flux:select.option>
                            </flux:select>
                        </flux:field>

                        <flux:field>
                            <flux:label>Categories</flux:label>
                            <div class="glass bg-white/5 p-5 rounded-2xl border border-white/10 space-y-3">
                                @foreach($categories as $category)
                                    <flux:checkbox :label="$category->name" name="categories[]" :value="$category->id" 
                                        :checked="in_array($category->id, old('categories', isset($post) ? $post->categories->pluck('id')->toArray() : []))" />
                                @endforeach
                            </div>
                        </flux:field>

                        <div class="pt-6 border-t border-white/5 flex flex-col gap-3">
                            <flux:button type="submit" variant="primary" class="w-full !rounded-xl !bg-blue-600">
                                {{ isset($post) ? 'Update Post' : 'Publish Post' }}
                            </flux:button>
                            <flux:button variant="ghost" class="w-full !rounded-xl !bg-white/5 !border-white/10">
                                Save as Draft
                            </flux:button>
                        </div>
                    </div>
                </x-backend.card>

                @if(isset($post))
                    <x-backend.card title="Meta Information">
                        <div class="space-y-4">
                            <div class="flex justify-between items-center text-xs">
                                <span class="text-slate-500 font-bold uppercase tracking-widest">Author</span>
                                <span class="text-white font-medium">{{ $post->user->name }}</span>
                            </div>
                            <div class="flex justify-between items-center text-xs">
                                <span class="text-slate-500 font-bold uppercase tracking-widest">Created</span>
                                <span class="text-white font-medium">{{ $post->created_at->format('M d, Y') }}</span>
                            </div>
                            <div class="flex justify-between items-center text-xs">
                                <span class="text-slate-500 font-bold uppercase tracking-widest">Last Update</span>
                                <span class="text-white font-medium">{{ $post->updated_at->diffForHumans() }}</span>
                            </div>
                        </div>
                    </x-backend.card>
                @endif
            </div>
        </div>
    </form>
</x-backend.shell>
