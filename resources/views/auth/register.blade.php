<x-layout></x-layout>

<x-bladewind::notification />
<div class="center-card bg-blue-500 p-4 rounded-lg w-3/4 mx-auto">
    <h1 class="my-2 text-2xl font-red text-blue-900/80 text-center"> TODO-LIST</h1>
    <x-bladewind::card class="center-card bg-red-700 p-4 w-3/4 mx-auto p-6">
        <div class="bg-blue-500 p-4 rounded-lg w-3/4 mx-auto">
            <h1 class="my-2 text-2xl font-light text-blue-900/80 text-center">Create Account</h1>
        </div>
        <form method="get" class="signup-form">
            <!-- Latar belakang biru muda untuk judul -->

            <div class="bg-blue-500 p-4 rounded-lg mt-3">
                <div class="bg-cyan-500 p-4 rounded-lg mt-3">
                    <p class="mt-3 mb-6 text-white-900/80 text-sm text-center">
                        Silahkan isi untuk melakukan daftar
                    </p>

                    <div class="bg-blue-500 p-4 rounded-lg mt-3">
                        <!-- Input Full Name -->
                        <x-bladewind::input name="Username " required="true" label="Username" 
    error_message="You will need to enter your username" 
    class="p-4 rounded-lg mt-3" 
    style="background-color: #006994; color: white;" />

<!-- Input username dan Mobile -->
<div class="flex gap-4">
    <x-bladewind::input name="mobile" required="true" label="Mobile" numeric="true" 
        class="p-4 rounded-lg" 
        style="background-color: #006994; color: white;" />
    <x-bladewind::input name="password" required="true" label="Password" 
        class="p-4 rounded-lg" 
        style="background-color: #006994; color: white;" />
</div>

                        </div>
                    </div>
                </div>
            </div>

            <!-- Tombol Sign Up -->
            <div class="text-center">
                <x-bladewind::button name="btn-save" has_spinner="true" type="primary" can_submit="true" class="mt-3">
                    Sign Up Today
                </x-bladewind::button>
            </div>
        </form>
    </x-bladewind::card>
</div>

<style>
    body {
        background-color: #94a0a0;
        /* Biru muda */
    }

    .outer-container {
        display: flex;
        align-items: center;
        justify-content: center;
        min-height: 100vh;
        padding: 20px;
    }

    .inner-container {
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    }

    .center-card {
        max-width: 600px;
        /* Membatasi lebar kartu */
        margin: 0 auto;
        /* Memposisikan kartu di tengah */
        margin-top: 100px;
    }
    
</style>
