@php
    /**
     * Deze partial wordt gedeeld tussen create en edit.
     *
     * old() wint altijd na validatiefouten.
     * $post kan null zijn bij create.
     */
@endphp

<div class="grid grid-cols-1 md:grid-cols-2 gap-8">

    {{-- ========================= TITLE ========================= --}}
    <flux:field>
        <flux:label class="!text-white/70 font-bold text-[10px] uppercase tracking-widest mb-3">Title</flux:label>
        <flux:input
            name="title"
            value="{{ old('title', $post?->title ?? '') }}"
            class="!bg-white/5 !border-white/10 focus:!border-white/20 !text-white rounded-xl h-11"
        />
        <flux:error name="title" />
    </flux:field>

    {{-- ========================= SLUG ========================= --}}
    <flux:field>
        <flux:label class="!text-white/70 font-bold text-[10px] uppercase tracking-widest mb-3">Slug</flux:label>
        <flux:input
            name="slug"
            value="{{ old('slug', $post?->slug ?? '') }}"
            placeholder="Auto-generated if left blank"
            class="!bg-white/5 !border-white/10 focus:!border-white/20 !text-white rounded-xl h-11"
        />
        <flux:error name="slug" />
    </flux:field>

    {{-- ========================= AUTHOR ========================= --}}
    <flux:field>
        <flux:label class="!text-white/70 font-bold text-[10px] uppercase tracking-widest mb-3">Author</flux:label>
        <flux:select name="user_id" class="!bg-white/5 !border-white/10 !text-white rounded-xl h-11">
            <flux:select.option value="">No author</flux:select.option>
            @foreach($authors as $author)
                <flux:select.option value="{{ $author->id }}"
                    @selected((string) old('user_id', $post?->user_id ?? '') === (string) $author->id)>
                    {{ $author->name }}
                </flux:select.option>
            @endforeach
        </flux:select>
        <flux:error name="user_id" />
    </flux:field>

    <div class="grid grid-cols-2 gap-8">
        {{-- ========================= STATUS ========================= --}}
        <flux:field>
            <flux:label class="!text-white/70 font-bold text-[10px] uppercase tracking-widest mb-3">Status</flux:label>
            <flux:select name="is_published" class="!bg-white/5 !border-white/10 !text-white rounded-xl h-11">
                <flux:select.option value="1" @selected((string) old('is_published', $post?->is_published ?? '0') === '1')>Published</flux:select.option>
                <flux:select.option value="0" @selected((string) old('is_published', $post?->is_published ?? '0') === '0')>Draft</flux:select.option>
            </flux:select>
            <flux:error name="is_published" />
        </flux:field>

        {{-- ========================= PUBLISHED AT ========================= --}}
        <flux:field>
            <flux:label class="!text-white/70 font-bold text-[10px] uppercase tracking-widest mb-3">Published at</flux:label>
            <flux:input
                type="datetime-local"
                name="published_at"
                value="{{ old('published_at', optional($post?->published_at)->format('Y-m-d\TH:i')) }}"
                class="!bg-white/5 !border-white/10 focus:!border-white/20 !text-white rounded-xl h-11"
            />
            <flux:error name="published_at" />
        </flux:field>
    </div>

    {{-- ========================= EXCERPT ========================= --}}
    <flux:field class="md:col-span-2">
        <flux:label class="!text-white/70 font-bold text-[10px] uppercase tracking-widest mb-3">Excerpt</flux:label>
        <flux:textarea
            name="excerpt"
            rows="3"
            class="!bg-white/5 !border-white/10 focus:!border-white/20 !text-white rounded-xl"
        >{{ old('excerpt', $post?->excerpt ?? '') }}</flux:textarea>
        <flux:error name="excerpt" />
    </flux:field>

    {{-- ========================= BODY ========================= --}}
    <flux:field class="md:col-span-2">
        <flux:label class="!text-white/70 font-bold text-[10px] uppercase tracking-widest mb-3">Body</flux:label>
        <flux:textarea
            name="body"
            rows="10"
            class="!bg-white/5 !border-white/10 focus:!border-white/20 !text-white rounded-xl min-h-[300px]"
        >{{ old('body', $post?->body ?? '') }}</flux:textarea>
        <flux:error name="body" />
    </flux:field>

    {{-- ========================= CATEGORIES ========================= --}}
    <flux:field class="md:col-span-2">
        <flux:label class="!text-white/70 font-bold text-[10px] uppercase tracking-widest mb-3">Categories</flux:label>

        @php
            $selectedCategories = old(
                'categories',
                isset($post) && $post
                    ? $post->categories->pluck('id')->map(fn ($id) => (string) $id)->all()
                    : []
            );
        @endphp

        <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-4">
            @foreach($categories as $category)
                <flux:checkbox
                    name="categories[]"
                    value="{{ $category->id }}"
                    label="{{ $category->name }}"
                    id="category_{{ $category->id }}"
                    @checked(in_array((string) $category->id, array_map('strval', $selectedCategories), true))
                    class="!text-white"
                />
            @endforeach
        </div>

        <flux:error name="categories" />
    </flux:field>

    <flux:field class="md:col-span-2">
        <flux:label class="!text-white/70 font-bold text-[10px] uppercase tracking-widest mb-3">Featured image</flux:label>

        <flux:input
            type="file"
            name="image"
            accept=".jpg,.jpeg,.png,.webp"
            class="!bg-white/5 !border-white/10 focus:!border-white/20 !text-white rounded-xl"
        />

        <flux:text size="xs" class="mt-2 !text-slate-500">
            Allowed formats: jpg, jpeg, png, webp (max 4MB)
        </flux:text>

        @error('image')
        <flux:error>{{ $message }}</flux:error>
        @enderror

        @if($post?->media)
            <div class="mt-6 flex flex-col gap-2">
                <flux:text size="xs" class="!text-slate-400 font-bold uppercase tracking-wider">Current image</flux:text>
                <div class="p-2 bg-white/5 border border-white/10 rounded-2xl w-fit">
                    <img
                        src="{{ $post->media->url() }}"
                        class="rounded-xl shadow-lg"
                        style="max-width:200px;"
                    >
                </div>
            </div>
        @endif
    </flux:field>

    {{-- ========================= ACTIONS ========================= --}}
    <div class="md:col-span-2 flex gap-4 mt-6">
        <flux:button variant="primary" type="submit" class="rounded-xl px-8 h-12">
            {{ $submitLabel ?? 'Save' }}
        </flux:button>

        <flux:button variant="ghost" :href="route('backend.posts.index')" class="rounded-xl px-8 h-12 hover:!bg-white/10 !text-slate-300">
            Cancel
        </flux:button>
    </div>

</div>
