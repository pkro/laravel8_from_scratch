@props(['trigger'])

<!--- the x-data stuff is alpinejs, nothing to do with laravel / blade --->
<div class="jsPulldown" x-data="{ show: false }">
    <div
        @click="show = !show"
        @click.away="show = false">

        {{-- trigger element, which can be anything --}}
        {{ $trigger }}
    </div>
    <!-- setting display to none in the css file causes this to never show - why? -->
    <div x-show="show" style="display: none;">
        {{-- links --}}
        {{ $slot }}
    </div>
</div>
