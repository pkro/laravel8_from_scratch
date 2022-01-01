<header>
    <h1>Last stretch dev blog</h1>
    <p>by pkro</p>


    @if($showControls)
        <nav class="controls">
            <x-dropdown>
                <x-slot name="trigger">
                    <button>
                         <span>
                            {{ isset($currentCategory) ? ucwords($currentCategory->name) : 'Category' }}
                        </span>
                        <span>▽</span>
                    </button>
                </x-slot>

                {{-- this goes into the default {{$slot}} --}}
                <x-slot name="slot">
                @foreach($categories as $category)
                    @unless(isset($currentCategory) && $category->is($currentCategory))
                        <a href="/categories/{{$category->slug}}">{{ucwords($category->name)}}</a>
                    @endunless
                @endforeach
                </x-slot>
            </x-dropdown>

            <select name="category" id="category">
                <option value="0" disabled selected>Other filters</option>
                <option value="1">Fun</option>
                <option value="2">Serious</option>
                <option value="3">Random</option>
            </select>
            <form method="GET" action="#">
                <input type="text" name="search" placeholder="Find something">
            </form>
        </nav>
    @endif
</header>
