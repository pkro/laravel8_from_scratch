@props(['post'])
<article class="post">
    <img src="https://picsum.photos/id/{{$post->id*3}}/1200/1200" alt="nada">
    <div class="postOverview">
        <div class="overviewTop">
            <div class="overviewTopControls">
                <a href="/">&lt; back to posts</a>
                <div class="categoryButtons">
                    <a class="button" href="#">Fun</a>
                    <a class="button" href="#">Serious</a>
                </div>
            </div>
            <h2>{{ $post->title }}</h2>
            <div class="published">Published {{ $post->created_at->diffForHumans() }}</div>
            <div class="excerpt">
                {!! $post->body !!}
            </div>
        </div>
        <div class="authorRow">
            <a href="/authors/{{ $post->author->username }}" class="author">
                <img class="avatar" src="https://picsum.photos/30/30?{{ $post->author->name }}" alt="avatar">
                <div class="div">{{ $post->author->name }}</div>
            </a>
            <div class="published">Published {{ $post->created_at->diffForHumans() }}</div>
        </div>
    </div>
</article>

<script>
    const articleImage = document.querySelector('article > img:first-of-type').src;
    document.body.style.backgroundImage = `url(${articleImage})`;

</script>
