<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Booking Counseling Sekolah Darma Bangsa</title>
    <meta content="" name="description">
    <meta content="" name="keywords">
    <link href="{{ asset('ui/assets/img/favicon.png') }}" rel="icon">
    <link href="{{ asset('ui/assets/img/apple-touch-icon.png') }}" rel="apple-touch-icon">

    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

    <link href="{{ asset('ui/assets/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet">
    <link href="{{ asset('ui/assets/vendor/animate.css/animate.min.css') }}" rel="stylesheet">
    <link href="{{ asset('ui/assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('ui/assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('ui/assets/vendor/boxicons/css/boxicons.min.css') }}" rel="stylesheet">
    <link href="{{ asset('ui/assets/vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">
    <link href="{{ asset('ui/assets/vendor/remixicon/remixicon.css') }}" rel="stylesheet">
    <link href="{{ asset('ui/assets/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">

    <link href="{{ asset('ui/assets/css/style.css') }}" rel="stylesheet">    
    @livewireStyles
</head>
<body>
        <header class="d-flex align-items-center fixed-top" id="header">
            <div class="container d-flex align-items-center">
                <h1 class="logo me-auto">Booking Counseling SDB</h1>
                <nav class="navbar order-last order-lg-0" id="navbar">
                    <ul>
                        <li><a class="nav-link scrollto active" href="#hero">Home</a></li>
                        <li><a class="nav-link scrollto" href="#contact">Contact</a></li>
                    </ul>
                    <i class="bi bi-list mobile-nav-toggle"></i>
                </nav>
                <a href="#appointment" class="appointment-btn scrollto"><span class="d-none d-md-inline">Buat</span> Janji</a>
            </div>
        </header>

        <section class="d-flex align-items-center" id="hero">
            <div class="container">
                <h1>Selamat Datang</h1>
                <h2>Booking Counseling Sekolah Darma Bangsa</h2>
                
            </div>
        </section>
        
        <main id="main">
            {{ $slot }}

            <section class="contact" id="contact">
                <div class="container">
                    <div class="section-title">
                        <h2>Hubungi Kami</h2>
                        <p>Temukan di alamat berikut ini untuk konsultasi lebih lanjut</p>
                    </div>
                </div>
                <div>
                    <iframe style="border:0; width: 100%; height: 350px;" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3972.2560901546017!2d105.24839631426097!3d-5.377870455286361!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e40dac03c003739%3A0x616ad4636ec74d46!2sDarma%20Bangsa%20School!5e0!3m2!1sen!2sid!4v1663256698387!5m2!1sen!2sid" frameborder="0" allowfullscreen></iframe>
                </div>
                </div>
            </section>
        </main>
        <footer id="footer">
            <div class="container d-md-flex py-4">
                <div class="me-md-auto text-center text-md-start">
                    <div class="copyright">
                        <strong><span>Booking Counseling SDB</span></strong>. by IT Sekolah Darma Bangsa
                    </div>
                  
                </div>
                <div class="social-links text-center text-md-right pt-3 pt-md-0">
                    
                </div>
            </div>
        </footer>
        <div id="preloader"></div>
        <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
        
        <script src="https://cdn.jsdelivr.net/npm/@srexi/purecounterjs/dist/purecounter_vanilla.js"></script>
        <script src="{{ asset('ui/assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
        <script src="{{ asset('ui/assets/vendor/glightbox/js/glightbox.min.js') }}"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/8.4.2/swiper-bundle.min.js"></script>
        <script src="{{ asset('ui/assets/vendor/php-email-form/validate.js') }}"></script>
    
        <script src="{{ asset('ui/assets/js/main.js') }}"></script>
        @livewireScripts
    
</body>
</html>