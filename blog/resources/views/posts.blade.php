<x-myPrettyLayout>
@foreach($posts as $post)
    <article>
        <a href="/post/{{ $post->slug }}"> <h1>{{ $post->title }}</h1></a>
        <div>{{ $post->excerpt }}</div>
        <div class="postInfo">
            By <a href="/authors/{{ $post->author->username }}">{{ $post->author->name }}</a> in <a
                href="/categories/{{$post->category->slug}}">{{ $post->category->name }}</a>
            on {{ $post->published }}
        </div>
    </article>
@endforeach
</x-myPrettyLayout>
