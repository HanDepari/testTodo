<x-layout></x-layout>
<link href="{{ asset('css/login.css') }}" rel="stylesheet">
<body>
    <x-bladewind::card>
        <h1>Bladewind Card Component</h1>
        <form method="get" class="signup-form">
            <h1 class="my-2 text-2xl font-light text-blue-900/80">Login</h1>
            <p class="mt-3 mb-6 text-blue-900/80 text-sm">
                Silahkan memasukkan Username dan Password.
            </p>
            <x-bladewind::input name="username" required="true" label="Username" />
            <x-bladewind::input type="password" viewable="true" label="Password" />
            <div class="text-center">
                <x-bladewind::button name="btn-save" has_spinner="true" type="primary" can_submit="true" class="mt-3">
                    Login
                </x-bladewind::button>
            </div>
        </form>
    </x-bladewind::card>
</body>
<script src="{{ asset('js/login.js') }}" defer></script>
</html>
