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
    <link rel="stylesheet" href="css-default/detail.css">
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

    <a class="back-icon" href="/">
        <img src="icon/left.png" alt="back"> Kembali
    </a> <br>
    
    {{-- detail produk --}}

    <main class="product-detail-container">
        <section class="product-image">
            <div class="slider">
                <img src="img/celengan/celengan1-depan.jpg" alt="Produk" class="active">
                <img src="img/celengan/celengan1-kiri.jpg" alt="Produk">
                <img src="img/celengan/celengan1-kanan.jpg" alt="Produk">
            </div>
            <div class="slider-controls">
                <button class="slider-btn prev" onclick="changeSlide(-1)">&#10094;</button>
                <button class="slider-btn next" onclick="changeSlide(1)">&#10095;</button>
            </div>
        </section>
        <section class="product-info">
            <h1 class="product-name">Celengan Babi</h1>
            <p class="product-price">
                <span class="original-price">Rp. 250.000,00</span>
                <span class="discounted-price">Rp. 170.000,00</span>
            </p>

            <p class="product-description">
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Facilis maxime mollitia corrupti sint tempora
                consequuntur repellendus porro quas magnam corporis nisi facere reprehenderit molestiae quidem quasi
                dolore iste, excepturi earum placeat temporibus animi minima quaerat! Dolorem explicabo, veniam illo,
                esse repellat impedit obcaecati soluta ipsa rerum magni quo aliquam sit.
            </p>

            <div class="product-options">
                <div class="size-options">
                    <label>Ukuran: </label>
                    <button class="size-option" data-size="Kecil">Kecil</button>
                    <button class="size-option" data-size="Sedang">Sedang</button>
                    <button class="size-option" data-size="Besar">Besar</button>
                </div>

                <div class="quantity-selector">
                    <label for="quantity">Jumlah:</label>
                    <button class="quantity-btn decrease">-</button>
                    <input type="number" id="quantity" value="1" min="1">
                    <button class="quantity-btn increase">+</button>
                </div>
            </div>

            <div class="product-actions">
                <button class="buy-now-btn">BELI SEKARANG</button>
                <button class="add-to-cart-btn">TAMBAHKAN KE KERANJANG</button>
            </div>
        </section>
</body>

</html>
