<header>
    <h1>Last stretch dev blog</h1>
    <p>by pkro</p>
    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquam aperiam, eum id modi odit omnis ut
        veniam. Numquam, saepe, unde!</p>

    @if($showControls)
        <nav class="controls">
            <!--- this is alpinejs, nothing to do with laravel / blade --->
            <div class="jsPulldown" x-data="{ show: false }">
                <button
                    @click="show = !show"
                    @click.away="show = false">
                    <span>
                        {{ isset($currentCategory) ? ucwords($currentCategory->name) : 'Category' }}
                    </span><span>▽</span>
                </button>
                <!-- setting display to none in the css file causes this to never show - why? -->
                <div x-show="show" style="display: none;">
                    @foreach($categories as $category)
                        @unless(isset($currentCategory) && $category->is($currentCategory))
                            <a href="/categories/{{$category->slug}}">{{ucwords($category->name)}}</a>
                        @endunless
                    @endforeach
                </div>
            </div>
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
