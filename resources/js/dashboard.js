document.addEventListener("DOMContentLoaded", () => {
    const todoForm = document.getElementById("todoForm");
    const taskTable = document.getElementById("taskTable");

    // Tambahkan kegiatan baru ke tabel
    todoForm.addEventListener("submit", (e) => {
        e.preventDefault();

        const taskName = document.getElementById("taskName").value;
        const startTime = todoForm.querySelector('input[name="startTime"]').value;
        const endTime = todoForm.querySelector('input[name="endTime"]').value;

        if (taskName && startTime && endTime) {
            const newRow = document.createElement("tr");
            newRow.innerHTML = `
                <td class="border border-gray-300 px-4 py-2">${taskName}</td>
                <td class="border border-gray-300 px-4 py-2">${startTime}</td>
                <td class="border border-gray-300 px-4 py-2">${endTime}</td>
                <td class="border border-gray-300 px-4 py-2 text-center">
                    <input type="checkbox" class="rounded-full completed-checkbox">
                </td>
                <td class="border border-gray-300 px-4 py-2 text-center">
                    <button class="bg-green-500 text-white px-2 py-1 rounded-md hover:bg-green-600 btn-complete">Selesai</button>
                    <button class="bg-red-500 text-white px-2 py-1 rounded-md hover:bg-red-600 btn-delete">Hapus</button>
                </td>
            `;
            taskTable.appendChild(newRow);

            todoForm.reset();
        } else {
            alert("Semua kolom wajib diisi!");
        }
    });

    // Event delegation untuk tombol hapus dan selesai
    taskTable.addEventListener("click", (e) => {
        if (e.target.classList.contains("btn-delete")) {
            // Hapus baris
            e.target.closest("tr").remove();
        } else if (e.target.classList.contains("btn-complete")) {
            // Tandai selesai
            const row = e.target.closest("tr");
            row.querySelector(".completed-checkbox").checked = true;
            row.style.textDecoration = "line-through";
        }
    });

    // Checkbox selesai otomatis menandai kegiatan
    taskTable.addEventListener("change", (e) => {
        if (e.target.classList.contains("completed-checkbox")) {
            const row = e.target.closest("tr");
            row.style.textDecoration = e.target.checked ? "line-through" : "none";
        }
    });
});