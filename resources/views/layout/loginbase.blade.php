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
    <div class="w-full p-4 md:p-8 lg:my-10 ">
        <div class="bg-white rounded-lg mx-auto lg:w-2/3 p-8">
            <nav class="relative">
                <div class="flex justify-center items-center w-full h-full">
                    <img class="w-40" src="{{ asset('images/LOVKlogo.jpg') }}" alt="Logo">
                </div>
            </nav>
            @yield('content')
        </div>
        <div class="fixed bottom-0 w-full">
            <img src="{{ asset('images/RotterdamSkylineWshiptrans.png') }}" alt="Skyline" class="w-full mx-auto object-cover">
            {{-- <div class="absolute inset-0 flex justify-center items-center top-14">
                <img src="{{ asset('images/binnenvaartschip_Lovk.svg') }}" alt="Binnenvaartschip Lovk" class="w-60">
            </div> --}}
        </div>
    </div>
</body>
</html>