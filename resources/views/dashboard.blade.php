<x-layout></x-layout>

<body class="bg-gray-100">
    <div class="container mx-auto mt-10 p-5 bg-white shadow-md rounded-lg">
        <h1 class="text-2xl font-bold mb-4">To-Do List</h1>
        <!-- Form Input Kegiatan -->
        <form id="todoForm" class="mb-6">
            <div class="mb-4">
                <label for="taskName" class="block text-gray-700 font-medium mb-2">Nama Kegiatan:</label>
                <input type="text" id="taskName" name="taskName"
                    class="w-full px-4 py-2 border rounded-md focus:ring focus:ring-blue-300"
                    placeholder="Masukkan nama kegiatan" required>
            </div>

            <div class="mb-4">
                <label for="startTime" class="block text-gray-700 font-medium mb-2">Waktu Mulai:</label>
                @if (class_exists('Bladewind\Components\Datepicker'))
                    <x-bladewind::datepicker required="true" name="startTime"
                        class="w-full px-4 py-2 border rounded-md" />
                @else
                    <input type="datetime-local" name="startTime" required class="w-full px-4 py-2 border rounded-md">
                @endif
            </div>

            <div class="mb-4">
                <label for="endTime" class="block text-gray-700 font-medium mb-2">Waktu Selesai:</label>
                @if (class_exists('Bladewind\Components\Datepicker'))
                    <x-bladewind::datepicker required="true" name="endTime"
                        class="w-full px-4 py-2 border rounded-md" />
                @else
                    <input type="datetime-local" name="endTime" required class="w-full px-4 py-2 border rounded-md">
                @endif
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
                        <th class="border border-gray-300 px-4 py-2 text-left">Waktu Mulai</th>
                        <th class="border border-gray-300 px-4 py-2 text-left">Waktu Selesai</th>
                        <th class="border border-gray-300 px-4 py-2 text-center">Selesai</th>
                        <th class="border border-gray-300 px-4 py-2 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody id="taskTable">
                    <!-- Data kegiatan akan dimasukkan di sini -->
                    <tr class="bg-white">
                        <td class="border border-gray-300 px-4 py-2">Contoh Kegiatan</td>
                        <td class="border border-gray-300 px-4 py-2">2024-12-13 09:00</td>
                        <td class="border border-gray-300 px-4 py-2">2024-12-13 11:00</td>
                        <td class="border border-gray-300 px-4 py-2 text-center">
                            <input type="checkbox" class="rounded-full completed-checkbox">
                        </td>
                        <td class="border border-gray-300 px-4 py-2 text-center">
                            <button
                                class="bg-green-500 text-white px-2 py-1 rounded-md hover:bg-green-600">Selesai</button>
                            <button class="bg-red-500 text-white px-2 py-1 rounded-md hover:bg-red-600">Hapus</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <script>
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

</html>
