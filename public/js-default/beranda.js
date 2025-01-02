document.addEventListener('DOMContentLoaded', function () {
    // Smooth Scroll untuk Navigasi
    const navLinks = document.querySelectorAll('.nav a');

    navLinks.forEach(link => {
        link.addEventListener('click', function (e) {
            e.preventDefault(); // Mencegah perilaku default link

            const targetId = this.getAttribute('href').substring(1); // Ambil ID tujuan
            const targetElement = document.getElementById(targetId);

            if (targetElement) {
                window.scrollTo({
                    top: targetElement.offsetTop - 50, // Jarak atas (header offset jika perlu)
                    behavior: 'smooth' // Scroll dengan animasi halus
                });
            }
        });
    });

    // Dropdown Menu untuk Profil
    const dropdownToggle = document.querySelector('.dropdown-toggle');
    const dropdownMenu = document.querySelector('.dropdown-menu');

    dropdownToggle.addEventListener('click', function (event) {
        event.stopPropagation(); // Mencegah event bubbling
        const isVisible = dropdownMenu.style.display === 'block';
        dropdownMenu.style.display = isVisible ? 'none' : 'block';
    });

    // Menutup Dropdown saat Klik di Luar
    document.addEventListener('click', function () {
        dropdownMenu.style.display = 'none';
    });
});
