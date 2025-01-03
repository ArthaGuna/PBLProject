<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>UD. Amerta Sedana</title>
    @vite('resources/css/app.css')
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="css/beranda.css">
</head>

<body>

    {{-- header --}}
    <header class="header">
        <div class="logo">
            <a href="#home">
                <img src="/img/logo/logo.png" alt="logo" class="logo-img">
            </a>
        </div>
        <nav class="nav">
            <a href="#home">Beranda</a>
            <a href="#about">Tentang Kami</a>
            <a href="#produk">Produk Kami</a>
        </nav>
        <div class="header-icons">
            <div class="search-container">
                <input type="text" placeholder="Cari produk.." class="search-bar">
                <span class="search-icon">
                    <img src="icon/search-icon.png" alt="Search">

                </span>
            </div>
            <div class="icon cart">
                <img src="icon/cart-icon.png" alt="Cart">
            </div>
            <div class="icon profile dropdown">
                <img src="icon/user-icon.png" alt="Profile" class="dropdown-toggle">
                <div class="dropdown-menu">
                    <div class="user-info">
                        <p class="user-name">user</p>
                        <p class="user-email">user@example.com</p>
                    </div>
                    <hr>
                    <a href="/edit-profile" class="dropdown-item">Edit Profil</a>
                    <a href="/login" class="dropdown-item">Keluar</a>
                </div>
            </div>
        </div>

    </header>

    {{-- content --}}

    <main class="hero" id="home">
        <div class="overlay"></div>
        <div class="content">
            <p class="title">
                <span class="line"></span>
                <span>UD. AMERTA SEDANA</span>
            </p>
            <h1>Hadirkan nuansa alami di rumah Anda <br>
                dengan sentuhan seni kerajinan terbaik kami.</h1>
            <a href="#produk" class="cta-button">LIHAT SEKARANG</a>
        </div>
    </main>

    {{-- tentang kami --}}

    <section id="about" class="about">
        <div class="container">
            <h2 class="judul-about">
                Tentang Kami
                <span class="underline"></span>
            </h2>
            <div class="about-content">
                <div class="about-image">
                    <img src="img/tentang-kami.jpg" alt="Gambar Toko UD. Amerta Sedana">
                </div>
                <div class="about-text">
                    <p>
                        Selamat datang di UD. Amerta Sedana. Pusat kerajinan tanah liat yang terletak di Desa Pejaten,
                        Kediri, Tabanan. Kami dengan bangga menawarkan beragam produk berkualitas, mulai dari patung,
                        pot, celengan, hingga dekorasi unik yang cocok untuk memperindah setiap sudut rumah Anda. <br>
                        Dengan sentuhan seni tradisional dan keahlian lokal, kami berkomitmen untuk menghadirkan produk
                        terbaik yang menggambarkan keindahan dan keunikan budaya Bali.
                    </p>

                </div>
            </div>
        </div>
    </section>

    {{-- kategori produk --}}

    <main class="kategori-produk">
        <h1 class="judul-kategori" id="produk">Produk Kami
            <span class="underline"></span>
        </h1>
        <div class="card-container">
            <a href="{{ route('products.category', ['category' => 'celengan']) }}" class="card">
                <img src="img/kategori-celengan.jpg" alt="Kategori 1">
                <div class="card-overlay">
                    <h2>CELENGAN</h2>
                </div>
            </a>
            <!-- Mengarahkan ke kategori dekorasi -->
            <a href="{{ route('products.category', ['category' => 'dekorasi']) }}" class="card">
                <img src="img/kategori-dekorasi.jpg" alt="Kategori 2">
                <div class="card-overlay">
                    <h2>DEKORASI</h2>
                </div>
            </a>
            <!-- Mengarahkan ke kategori patung -->
            <a href="{{ route('products.category', ['category' => 'patung']) }}" class="card">
                <img src="img/kategori-patung.jpg" alt="Kategori 3">
                <div class="card-overlay">
                    <h2>PATUNG</h2>
                </div>
            </a>
            <!-- Mengarahkan ke kategori pot -->
            <a href="{{ route('products.category', ['category' => 'pot']) }}" class="card">
                <img src="img/kategori-pot.jpg" alt="Kategori 4">
                <div class="card-overlay">
                    <h2>POT</h2>
                </div>
            </a>
        </div>
    </main>

    {{-- footer --}}
    <footer>
        <div class="footer-content">
            <div class="column">
                <h3>UD. Amerta Sedana</h3>
                <p>Selamat datang di UD. Amerta Sedana. Pusat kerajinan tanah liat yang terletak di Desa Pejaten,
                    Kediri, Tabanan. Kami dengan.. <a class="link-about"href="#about">lihat selengkapnya</a></p>
            </div>
            <div class="column">
                <h3>Produk Kami</h3>
                <ul>
                    <li><a href="/celengan">CELENGAN</a></li>
                    <li><a href="/dekorasi">DEKORASI</a></li>
                    <li><a href="/patung">PATUNG</a></li>
                    <li><a href="/pot">POT</a></li>
                </ul>
            </div>
            <div class="column">
                <h3>Kontak Kami</h3>
                <ul class="kontak">
                    <li>
                        <a href="https://www.instagram.com/">
                            <img src="icon/instagram.png" alt="Instagram" class="social-icon">
                        </a>
                        <p>ud.amertasedana</p>
                    </li>
                    <li>
                        <a href="https://wa.me/">
                            <img src="icon/whatsapp.png" alt="WhatsApp" class="social-icon">
                        </a>
                        <p>+6281234567890</p>
                    </li>
                    <li>
                        <a href="mailto:ud.amertasedana@gmail.com">
                            <img src="icon/mail.png" alt="Email" class="social-icon">
                        </a>
                        <p>ud.amertasedana@gmail.com</p>
                    </li>
                </ul>
            </div>
            <div class="column">
                <h3>Temukan Kami</h3>
                <div class="maps">
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3945.1659434441767!2d115.10140340000001!3d-8.5800384!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd23a1255555555%3A0x8db7de9f6cd58512!2sUD.Amerta%20Sedana!5e0!3m2!1sid!2sid!4v1734583936754!5m2!1sid!2sid"
                        width="200" height="200" style="border:0;" allowfullscreen="" loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
            </div>
        </div>
        <div class="copyright">
            <p>© 2024 Copyright UD. Amerta Sedana</p>
        </div>

    </footer>
    <script src="js-default/beranda.js" defer></script>





</body>

</html>
