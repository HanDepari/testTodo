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
                <form method="POST" action="{{ route('logout') }}" class="inline">
                    @csrf
                    <button type="submit" class="px-4 py-2 bg-red-500 hover:bg-red-600 rounded-md">
                        Logout
                    </button>
                </form>
            </div>
        </div>
    </nav>

    <div class="container mx-auto mt-10 p-5 bg-white shadow-md rounded-lg">
        <h1 class="text-2xl font-bold mb-4">To-Do List</h1>
                <!-- Form Input Kegiatan -->
        <form id="todoForm" class="mb-6" action="{{ route('tasks.store') }}" method="POST">
            @csrf
            <input type="hidden" id="taskId" name="task_id" value="">
            <div class="mb-4">
                <label for="taskDetails" class="block text-gray-700 font-medium mb-2">Nama Kegiatan:</label>
                <div class="flex items-center border rounded-md px-4 py-2">
                    <!-- Input Nama Kegiatan -->
                    <input type="text" id="taskName" name="title"
                        class="flex-1 border-none focus:ring-0 placeholder-gray-400"
                        placeholder="Masukkan nama kegiatan" required>
                    
                    <!-- Input Deadline -->
                    <input type="datetime-local" name="due_date" required 
                        class="ml-4 w-40 border-none focus:ring-0" id="taskDeadline">
                </div>
            </div>

            <button type="submit" id="submitButton"
                class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 focus:ring focus:ring-blue-300">
                Tambah Kegiatan
            </button>
            <button type="button" id="cancelEditButton" 
                class="bg-gray-500 text-white px-4 py-2 rounded-md hover:bg-gray-600 focus:ring focus:ring-gray-300 hidden ml-2">
                Batal
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
                    @forelse($tasks as $task)
                    <tr class="bg-white" data-task-id="{{ $task['id'] }}">
                        <td class="border border-gray-300 px-4 py-2 task-title">{{ $task['title'] }}</td>
                        <td class="border border-gray-300 px-4 py-2 task-deadline">
                            {{ $task['due_date'] ?? 'Tidak ada deadline' }}
                        </td>
                        <td class="border border-gray-300 px-4 py-2 text-center">
                            <input type="checkbox" 
                                class="rounded-full completed-checkbox"
                                {{ $task['is_completed'] ? 'checked' : '' }}>
                        </td>
                        <td class="border border-gray-300 px-4 py-2 text-center">
                            <button 
                                class="edit-task bg-green-500 text-white px-2 py-1 rounded-md hover:bg-green-600">
                                Edit
                            </button>
                            
                            <form action="{{ route('tasks.destroy', $task['id']) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" 
                                        class="bg-red-500 text-white px-2 py-1 rounded-md hover:bg-red-600"
                                        onclick="return confirm('Apakah Anda yakin ingin menghapus tugas ini?')">
                                    Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="text-center p-4">
                            Tidak ada tugas. Tambahkan tugas baru!
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

    </div>

</body>
<script src="{{ asset('js/dashboard.js') }}" defer></script>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const taskTable = document.getElementById('taskTable');

        taskTable.addEventListener('change', (e) => {
            if (e.target.classList.contains('completed-checkbox')) {
                const checkbox = e.target;
                const row = checkbox.closest('tr');
                const taskId = row.dataset.taskId;
                const isChecked = checkbox.checked;

                // Retrieve the base URL and Bearer token from Laravel config and session
                const baseUrl = '{{ config('services.todo_api.base_url') }}';
                const apiToken = '{{ session('api_token') }}';

                // Construct the full URL for the PATCH request
                const url = `${baseUrl}/tasks/${taskId}/complete`;

                // Post a PATCH request to the API
                fetch(url, {
                    method: 'PATCH',
                    headers: {
                        'Content-Type': 'application/json',
                        'Authorization': `Bearer ${apiToken}`,
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({ is_completed: isChecked })
                })
                .then(response => {
                    if (response.ok) {
                        // Update UI: Move task to the bottom if completed
                        if (isChecked) {
                            row.querySelector('.task-title').classList.add('line-through', 'text-gray-500');
                            row.querySelector('.task-deadline').classList.add('text-gray-500');
                            taskTable.appendChild(row);
                        } else {
                            row.querySelector('.task-title').classList.remove('line-through', 'text-gray-500');
                            row.querySelector('.task-deadline').classList.remove('text-gray-500');
                            // Optionally, move back to active tasks if necessary
                            taskTable.prepend(row);
                        }
                    } else {
                        alert('Failed to update task status.');
                        checkbox.checked = !isChecked; // Revert checkbox on failure
                    }
                })
                .catch(error => {
                    console.error('Error updating task:', error);
                    alert('An error occurred while updating the task.');
                    checkbox.checked = !isChecked; // Revert checkbox on error
                });
            }
        });
    });
</script>

<style>
    .line-through {
        text-decoration: line-through;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const form = document.getElementById('todoForm');
        const taskNameInput = document.getElementById('taskName');
        const taskDeadlineInput = document.getElementById('taskDeadline');
        const submitButton = document.getElementById('submitButton');
        const cancelEditButton = document.getElementById('cancelEditButton');
        const taskIdInput = document.getElementById('taskId');
    
        // Edit task functionality
        document.getElementById('taskTable').addEventListener('click', (e) => {
            if (e.target.classList.contains('edit-task')) {
                const row = e.target.closest('tr');
                const taskId = row.dataset.taskId;
                const titleCell = row.querySelector('.task-title');
                const deadlineCell = row.querySelector('.task-deadline');
    
                // Populate form with current task details
                taskNameInput.value = titleCell.textContent.trim();
                
                // Convert text deadline to datetime-local format
                if (deadlineCell.textContent.trim() !== 'Tidak ada deadline') {
                    const formattedDeadline = convertToDateTimeLocal(deadlineCell.textContent.trim());
                    taskDeadlineInput.value = formattedDeadline;
                }
    
                // Set task ID for update
                taskIdInput.value = taskId;
    
                // Change button text and show cancel button
                submitButton.textContent = 'Update Kegiatan';
                cancelEditButton.classList.remove('hidden');
    
                // Change form action to update route
                form.action = `/tasks/${taskId}`;
                form.method = 'POST';
                
                // Add hidden method spoofing for PUT/PATCH
                const methodInput = document.createElement('input');
                methodInput.type = 'hidden';
                methodInput.name = '_method';
                // methodInput.value = 'PUT';
                form.appendChild(methodInput);
            }
        });
    
        // Cancel edit functionality
        cancelEditButton.addEventListener('click', () => {
            // Reset form
            form.reset();
            taskIdInput.value = '';
            submitButton.textContent = 'Tambah Kegiatan';
            cancelEditButton.classList.add('hidden');
            
            // Reset form action
            form.action = "{{ route('tasks.store') }}";
            form.method = 'POST';
            
            // Remove method spoofing input
            const methodInput = form.querySelector('input[name="_method"]');
            if (methodInput) {
                methodInput.remove();
            }
        });
    
        // Helper function to convert text date to datetime-local format
        function convertToDateTimeLocal(dateString) {
            // Assuming date is in a format like '2024-12-13 11:00'
            try {
                const date = new Date(dateString);
                // Format to datetime-local (YYYY-MM-DDTHH:MM)
                return date.toISOString().slice(0,16);
            } catch (error) {
                console.error('Error converting date:', error);
                return '';
            }
        }
    });
    
    // Existing checkbox and completed task scripts remain the same
    </script>
</html>
