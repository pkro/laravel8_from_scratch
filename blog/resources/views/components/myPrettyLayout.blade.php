@props(['showControls', 'categories', 'currentCategory'])

<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Home</title>
    <link rel="stylesheet" href="/app.css?{{time()}}">
    <script defer src="https://unpkg.com/alpinejs@3.7.1/dist/cdn.min.js"></script>
</head>
<body>
<div class="mainContent">
    <section>
        @include('partials/_navbar')
        @include('partials/_header')
        <main>
        {{ $slot }}
        </main>
        @include('partials/_footer')
    </section>
</div>
</body>
<script src="/app.js"></script>

</html>
