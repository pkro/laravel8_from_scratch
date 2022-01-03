<x-myPrettyLayout :showControls="true" :categories="$categories" :currentCategory="$currentCategory" :searchTerm="$searchTerm">
    @if($posts->count() > 0)
        @foreach($posts as $post)
            <x-postCard :post=$post/>
        @endforeach
    @endif
</x-myPrettyLayout>
