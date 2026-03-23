<x-backend.shell title="Edit Post">

    <x-backend.card title="Edit: {{ $post->title }}">
        <form method="POST"
              action="{{ route('backend.posts.update',$post) }}"
              enctype="multipart/form-data">
            @csrf
            @method('PATCH')

            @include('backend.posts.partials.form', [
                'post' => $post,
                'authors' => $authors,
                'categories' => $categories,
                'submitLabel' => 'Save changes',
            ])
        </form>
    </x-backend.card>

</x-backend.shell>

