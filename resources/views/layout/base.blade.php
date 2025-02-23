<!DOCTYPE html>
<html lang="en" class="bg-gray-100">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Multiple crud system</title>
    <link href="https://cdn.tailwindcss.com/2.2.19/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://rsms.me/inter/inter.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha512-ABC...xyz" crossorigin="anonymous" referrerpolicy="no-referrer" />


</head>
<body class="flex justify-center bg-gray-100">
    <div class="w-full md:w-3/4 bg-white p-4 md:p-8 rounded-lg lg:my-10">
        @include('layout.nav')
        @yield('content')
    </div>
</body>
</html>