<x-myPrettyLayout>
<article>
    <h1>{{ $post->title }}</h1>
    {!! $post->body !!}
    <a href="/categories/{{$post->category->slug}}">{{ $post->category->name }}</a>

</article>
<a href="/">Go back</a>
</x-myPrettyLayout>
