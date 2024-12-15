// Efek klik tombol
document.querySelectorAll('.btn-custom').forEach(button => {
    button.addEventListener('click', () => {
        button.classList.add('btn-clicked');
        setTimeout(() => {
            button.classList.remove('btn-clicked');
        }, 200);
    });
});

// Animasi scroll ke atas
document.querySelector('.scroll-to-top')?.addEventListener('click', () => {
    window.scrollTo({ top: 0, behavior: 'smooth' });
});

// Animasi muncul elemen dengan scroll
const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
        if (entry.isIntersecting) {
            entry.target.classList.add('fade-in');
        }
    });
}, { threshold: 0.2 });

document.querySelectorAll('.fade-target').forEach(element => {
    observer.observe(element);
});
