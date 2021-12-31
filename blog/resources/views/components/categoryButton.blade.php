@props(['category'])

<a class="button" href="/categories/{{$category->slug}}">{{ $category->name }}</a>
