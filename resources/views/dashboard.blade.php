<x-layout></x-layout>
<style>
    .flex {
        display: flex;
        align-items: center;
    }

    .flex-1 {
        flex: 1;
    }

    .placeholder-gray-400::placeholder {
        color: #9ca3af;
        /* Warna placeholder abu-abu */
    }

    .ml-4 {
        margin-left: 1rem;
        /* Spasi antara Nama Kegiatan dan Deadline */
    }

    .w-40 {
        width: 10rem;
        /* Lebar tetap untuk input Deadline */
    }

    .border-none {
        border: none;
    }
</style>
<link href="{{ asset('css/dashboard.css') }}" rel="stylesheet">

<body class="bg-gray-100">
    <!-- Navbar -->
    <nav class="bg-blue-500 text-white py-4">
        <div class="container mx-auto flex justify-between items-center">
            <a href="#" class="text-lg font-semibold">To-Do List App</a>
            <div>
                <a href="#" class="px-4 py-2 hover:bg-blue-600 rounded-md">Profile</a>
                <button class="px-4 py-2 bg-red-500 hover:bg-red-600 rounded-md">Logout</button>
            </div>
        </div>
    </nav>

    <div class="container mx-auto mt-10 p-5 bg-white shadow-md rounded-lg">
        <h1 class="text-2xl font-bold mb-4">To-Do List</h1>
        <!-- Form Input Kegiatan -->
        <form id="todoForm" class="mb-6">
            <div class="mb-4">
                <label for="taskDetails" class="block text-gray-700 font-medium mb-2">Nama Kegiatan:</label>
                <div class="flex items-center border rounded-md px-4 py-2">
                    <!-- Input Nama Kegiatan -->
                    <input type="text" id="taskName" name="taskName"
                        class="flex-1 border-none focus:ring-0 placeholder-gray-400"
                        placeholder="Masukkan nama kegiatan" required>
                    <!-- Input Deadline -->
                    @if (class_exists('Bladewind\Components\Datepicker'))
                        <x-bladewind::datepicker required="true" name="endTime"
                            class="ml-4 w-40 border-none focus:ring-0" />
                    @else
                        <input type="datetime-local" name="endTime" required class="ml-4 w-40 border-none focus:ring-0">
                    @endif
                </div>
            </div>

            <button type="submit"
                class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 focus:ring focus:ring-blue-300">
                Tambah Kegiatan
            </button>
        </form>


        <!-- Tabel Kegiatan -->
        <div>
            <table class="w-full border-collapse border border-gray-300">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="border border-gray-300 px-4 py-2 text-left">Nama Kegiatan</th>
                        <th class="border border-gray-300 px-4 py-2 text-left">Deadline</th>
                        <th class="border border-gray-300 px-4 py-2 text-center">Selesai</th>
                        <th class="border border-gray-300 px-4 py-2 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody id="taskTable">
                    <!-- Data kegiatan akan dimasukkan di sini -->
                    <tr class="bg-white">
                        <td class="border border-gray-300 px-4 py-2">Contoh Kegiatan</td>
                        <td class="border border-gray-300 px-4 py-2">2024-12-13 11:00</td>
                        <td class="border border-gray-300 px-4 py-2 text-center">
                            <input type="checkbox" class="rounded-full completed-checkbox">
                        </td>
                        <td class="border border-gray-300 px-4 py-2 text-center">
                            <button
                                class="bg-green-500 text-white px-2 py-1 rounded-md hover:bg-green-600">Edit</button>
                            <button class="bg-red-500 text-white px-2 py-1 rounded-md hover:bg-red-600">Hapus</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <script>
        document.addEventListener('click', (e) => {
            // Jika tombol "Selesai" diklik
            if (e.target.dataset.action === 'mark-completed') {
                const row = e.target.closest('tr'); // Baris terkait
                const checkbox = row.querySelector('.completed-checkbox'); // Checkbox di baris tersebut

                // Tandai checkbox sebagai selesai
                checkbox.checked = true;

                // Tambahkan gaya coret pada baris
                row.style.textDecoration = 'line-through';
            }
        });

        // Script untuk checkbox selesai dan coret tulisan
        document.addEventListener('change', (e) => {
            if (e.target.classList.contains('completed-checkbox')) {
                const row = e.target.closest('tr');
                if (e.target.checked) {
                    row.style.textDecoration = 'line-through';
                } else {
                    row.style.textDecoration = 'none';
                }
            }
        });
    </script>

</body>
<script src="{{ asset('js/dashboard.js') }}" defer></script>

</html>
