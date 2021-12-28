<x-myPrettyLayout>
@foreach($posts as $post)
    <article>
        <a href="/post/{{ $post->slug }}"> <h1>{{ $post->title }}</h1></a>
        <div>{{ $post->excerpt }}</div>
        <a href="/categories/{{$post->category->slug}}">{{ $post->category->name }}</a>
    </article>
@endforeach
</x-myPrettyLayout>
