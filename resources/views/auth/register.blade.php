<x-layout></x-layout>

<x-bladewind::notification />

<x-bladewind::card class="center-card bg-blue-100 w-3/4 mx-auto p-6">
<div class="bg-red-500 p-4 rounded-lg w-3/4 mx-auto">
    <h1 class="my-2 text-2xl font-light text-blue-900/80 text-center">Create Account</h1>
</div>
    <form method="get" class="signup-form">
        <!-- Latar belakang biru muda untuk judul -->

        <!-- Latar belakang biru muda untuk paragraf -->
        <div class="bg-blue-100 p-4 rounded-lg mt-3">
            <p class="mt-3 mb-6 text-blue-900/80 text-sm text-center">
                This is a sign up form example to demonstrate how to validate forms using Bladewind.
            </p>
        </div>

        <!-- Input Full Name -->
        <x-bladewind::input name="fname" required="true" label="Full Name"
            error_message="You will need to enter your full name" class="bg-blue-100" />

        <!-- Input Email dan Mobile -->
        <div class="flex gap-4">
            <x-bladewind::input name="email" required="true" label="Email" class="bg-blue-100" />
            <x-bladewind::input name="mobile" label="Mobile" numeric="true" class="bg-blue-100" />
        </div>

        <!-- Textarea -->
        <x-bladewind::textarea required="true" name="bio" error_message="Yoh! write something nice about yourself"
            show_error_inline="true" label="Describe yourself" class="bg-blue-100"></x-bladewind::textarea>

        <!-- Tombol Sign Up -->
        <div class="text-center">
            <x-bladewind::button name="btn-save" has_spinner="true" type="primary" can_submit="true" class="mt-3">
                Sign Up Today
            </x-bladewind::button>
        </div>
    </form>
</x-bladewind::card>

<style>
    body {
        background-color: #DBEAFE; /* Biru muda */
    }
    .center-card {
        max-width: 600px; /* Membatasi lebar kartu */
        margin: 0 auto; /* Memposisikan kartu di tengah */
    }
</style>
