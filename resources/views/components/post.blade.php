@props(['post' => $post])
{{-- We need to define the props that we need to pass in --}}
{{-- It's still not working becuause when we created the component we created a class as well,
Http/View/Components/Post--}}

<div>
    <div class="mb-4">
        <a href="{{ route('users.posts', $post->user) }}" class="font-bold">{{ $post->user->name }}</a> <span
            class="text-gray-600 text-sm">{{ $post->created_at->diffForHumans() }}</span>
        <p class="mb-1">{{ $post->body }}</p>
    </div>

    @can('delete', $post)
        {{-- Can we delete the post we are iterating through, can is used with the policy as a
        blade directive --}}
        <form action="{{ route('posts.delete', $post) }}" method="post">
            @csrf
            @method('DELETE')
            <button type="submit" class="text-blue-500">
                Delete
            </button>
        </form>
    @endcan

    <div class="flex items-center mb-3">
        @auth
            @if (!$post->likedBy(auth()->user()))
                <form action="{{ route('posts.like', $post) }}" method="post" class="mr-1">
                    {{-- Pass the post id into the helper that will inject it in the url --}}
                    @csrf
                    <button type="submit" class="text-blue-500">
                        Like
                    </button>
                </form>
            @else
                <form action="{{ route('posts.like', $post) }}" method="post" class="mr-1">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="text-blue-500">
                        Unlike
                    </button>
                </form>
            @endif
        @endauth

        <span>{{ $post->likes->count() }} {{ Str::plural('like', $post->likes->count()) }}</span>
        {{-- To pluralise a string we use String helper which is Str, this will pluralise the word --}}
    </div>
</div>
