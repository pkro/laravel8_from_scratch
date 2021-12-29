<x-myPrettyLayout>
    <article>
        <h1>{{ $post->title }}</h1>
        <div class="postBody">
            {!! $post->body !!}
        </div>
        <div class="postInfo">
            By <a href="#">{{ $post->author->name }}</a> in <a
                href="/categories/{{$post->category->slug}}">{{ $post->category->name }}</a>
        </div>

    </article>
    <a href="/">Go back</a>
</x-myPrettyLayout>
