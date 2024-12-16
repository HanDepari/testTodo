<x-layout></x-layout>
@vite(['resources/css/app.css', 'resources/js/app.js'])
<x-bladewind::notification />
<div class="bg-gray-100 min-h-screen flex items-center justify-center">
    <!-- Outer Container -->
    <div class="bg-white shadow-lg rounded-lg p-6 w-full max-w-md">
        <!-- Judul Halaman -->
        <h1 class="text-3xl font-bold text-blue-700 text-center mb-4">TODO-LIST</h1>
        <x-bladewind::card class="p-6 bg-gray-50 rounded-lg">
            <!-- Header Form -->
            <div class="bg-blue-600 text-white text-center py-3 rounded-t-lg">
                <h2 class="text-xl font-semibold">Create Account</h2>
            </div>

            <!-- Form -->
            <form method="POST" class="mt-4 space-y-4" action="/register">
                @csrf

                <!-- Pesan Arahannya -->
                <p class="text-gray-600 text-center text-sm">
                    Silahkan isi form untuk membuat account.
                </p>

                <!-- Input Username -->
                <x-bladewind::input name="username" required="true" label="Username" 
                    error_message="Username wajib diisi" 
                    class="bg-gray-200 text-gray-800" />

                <!-- Input No. Telp dan Password -->
                <div class="flex gap-4">
                    <x-bladewind::input name="no_telp" required="true" label="Nomor Telepon" numeric="true" 
                        class="bg-gray-200 text-gray-800" />
                    <x-bladewind::input name="password" type="password" viewable="true" required="true" label="Password" 
                        class="bg-gray-200 text-gray-800" />
                </div>

                <!-- Tombol Submit -->
                <div class="text-center mt-6">
                    <x-bladewind::button name="btn-save" has_spinner="true" type="primary" can_submit="true" 
                        class="bg-blue-600 text-white hover:bg-blue-700 transition-colors">
                        Sign Up 
                    </x-bladewind::button>
                </div>
            </form>
        </x-bladewind::card>
    </div>
</div>

<!-- Style Tambahan -->
<style>
    body {
        background-color: #F3F4F6; /* Tailwind's bg-gray-100 */
    }
</style>
