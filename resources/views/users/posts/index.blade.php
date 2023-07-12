@extends('layout.app')

@section('content')
    <div class="flex justify-center">
        <div class="w-8/12">
            <div class="p-6">
                <h1 class="text-2xl font-medium mb-1">{{ $user->name }}</h1>
                <p> Posted {{ $user->posts()->count() }} {{ Str::plural('post', $posts->count()) }} and recieved {{ $user->recievedLikes->count() }} likes</p>
            </div>

            <div class="bg-white p-6 rounded-lg">
                @if ($posts->count())
                    @foreach ($posts as $post)
                        <x-post :post=$post />
                        {{-- To referece the component --}}
                        {{-- php aritsan make:component --}}
                        {{-- We need to pass in the post as a prop as it's being used in the --}}
                    @endforeach

                    {{ $posts->links() }}
                    {{-- To display the pagination links --}}
                @else
                    <p>{{ $user->name }} doesnot have any posts</p>
                @endif
            </div>
        </div>
    </div>
@endsection
