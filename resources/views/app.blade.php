<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title inertia>Idea</title>
        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Scripts -->
        @routes
        @vite(["resources/js/app.js",
        "resources/css/app.css"])

        @inertiaHead
    </head>
    <body class="font-sans antialiased">
        @inertia

        <script>
            window.user = @json(auth()->user());
            window.userRoles = @json(auth()->user()->roles);
            window.userPermissions = @json(auth()->user()->permissions);
        </script>
    </body>
</html>
