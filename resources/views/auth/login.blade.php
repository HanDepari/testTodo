<x-layout></x-layout>
@vite(['resources/css/app.css', 'resources/js/app.js'])
<body class="flex items-center justify-center min-h-screen bg-blue-200">
<div class="bg-blue-200">
    <!-- Card Container -->
    <x-bladewind::card class="bg-blue-500 w-96 mx-auto p-6">
        <h1 class="text-center text-2xl font-bold mb-4 text-gray-800">Todo</h1>
        <form method="get" class="signup-form ">
            <div class="bg-blue-950">
            <h1 class="my-2 text-xl font-light text-white bg-blue-950">Login</h1>
            <p class="mt-3 mb-6 text-white text-sm ">
                Silahkan memasukkan Username dan Password.
            </p>
        </div>
            <!-- Input Fields -->
            <x-bladewind::input name="username" required="true" label="Username" class="text-blue-100 "/>
            <x-bladewind::input type="password" required="true" viewable="true"  label="Password" />
            
            <!-- Submit Button -->
            <div class="text-center">
                <x-bladewind::button name="btn-save" has_spinner="true" type="primary" can_submit="true" class="mt-3">
                    Login
                </x-bladewind::button>
            </div>
        </form>
    </x-bladewind::card>
</div>
</body>
</html>
