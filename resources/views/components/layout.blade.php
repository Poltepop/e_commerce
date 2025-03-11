<!DOCTYPE html>
<html lang="en" class="h-full bg-base-100">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link rel="stylesheet" href="https://rsms.me/inter/inter.css" />
    @vite('resources/css/app.css')
    @livewireStyles
    <title>{{ $title }}</title>
</head>
<body class="h-full">
<div class="min-h-full">
    <x-navbar></x-navbar>
    
    <main>
     {{ $slot }}
    </main>
  </div>
  @livewireScripts
</body>
</html>