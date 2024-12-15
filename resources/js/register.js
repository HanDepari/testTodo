// Tambahkan efek klik untuk tombol
document.querySelectorAll('.btn-custom').forEach(button => {
    button.addEventListener('click', () => {
        button.innerHTML += '<span class="btn-spinner"></span>';
        setTimeout(() => {
            button.querySelector('.btn-spinner')?.remove();
        }, 2000); // Simulasikan spinner selama 2 detik
    });
});

// Validasi form sederhana
document.querySelector('.signup-form')?.addEventListener('submit', (e) => {
    const inputs = document.querySelectorAll('.signup-form input[required], .signup-form textarea[required]');
    let isValid = true;

    inputs.forEach(input => {
        if (!input.value.trim()) {
            isValid = false;
            input.classList.add('border-red-500');
        } else {
            input.classList.remove('border-red-500');
        }
    });

    if (!isValid) {
        e.preventDefault();
        alert('Please fill out all required fields.');
    }
});
