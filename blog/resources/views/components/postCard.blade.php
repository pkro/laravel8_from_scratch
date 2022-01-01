@props(['post'])
<article>
    <img src="https://picsum.photos/id/{{$post->id*3}}/1200/1200" alt="nada">
    <div class="postOverview">
        <div class="overviewTop">
            <div class="categoryButtons">
                <x-categoryButton :category="$post->category"></x-categoryButton>
            </div>
            <h2>{{ $post->title }}</h2>
            <div class="published">Published {{ $post->created_at->diffForHumans() }}</div>
            <div class="excerpt">
                {!!  $post->excerpt !!}
            </div>
        </div>
        <div class="authorRow">
            <a href="/authors/{{ $post->author->username }}" class="author">
                <img class="avatar" src="https://picsum.photos/30/30?{{ $post->author->name }}" alt="avatar">
                <div class="div">{{ $post->author->name }}</div>
            </a>
            <a class="button navLink" href="/post/{{ $post->slug }}">Read more</a>
        </div>
    </div>
</article>
