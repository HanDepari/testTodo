<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>landing</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body >

    <!-- Background Image -->
    <div class="relative h-screen w-full bg-center bg-cover" style="background-image: url('{{ asset('img/list21.jpg') }}');">
        <!-- Overlay -->
        <div class="absolute inset-0 bg-black bg-opacity-50"></div>

        <!-- Content -->
        <div class="absolute inset-0 flex items-center justify-center">
            <div class="bg-white/70 backdrop-blur-md p-8 rounded-lg shadow-lg text-center">
                <p class="text-gray-800 mt-4 text-lg font-semibold">Todo-list</p>
                <div class="mt-6 space-x-4">
                    <a class="bladewind-button bg-blue-500 text-white hover:bg-blue-600 hover:text-white px-6 py-2 rounded-lg">Login</a>
                    <a class="bladewind-button bg-white text-blue-500 border border-blue-500 hover:bg-blue-500 hover:text-white px-6 py-2 rounded-lg">Register</a>
                </div>
            </div>
        </div>
    </div>

</body>
</html>
