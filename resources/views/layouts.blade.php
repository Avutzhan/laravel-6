<!DOCTYPE html>
<html lang="en">

<head>
    <!-- meta -->
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Folio - Personal Portfolio Template</title>
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,300i,400,400i,500,500i,600,600i,700,700i|Playfair+Display:400,400i,700,700i,900,900i" rel="stylesheet">

    <!-- Bootstrap CSS File -->
    <link href="lib/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Libraries CSS Files -->
    <link href="lib/ionicons/css/ionicons.min.css" rel="stylesheet">
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="lib/magnific-popup/magnific-popup.css" rel="stylesheet">
    <link href="lib/hover/hover.min.css" rel="stylesheet">

    <!-- Main Stylesheet File -->
    <link href="css/style.css" rel="stylesheet">

    <!-- Responsive css -->
    <link href="css/responsive.css" rel="stylesheet">

    <!-- Favicon -->
    <link rel="shortcut icon" href="images/favicon.png">

    <!-- =======================================================
      Theme Name: Folio
      Theme URL: https://bootstrapmade.com/folio-bootstrap-portfolio-template/
      Author: BootstrapMade.com
      Author URL: https://bootstrapmade.com
    ======================================================= -->
</head>

<body>
    <!-- start section navbar -->
    <nav id="main-nav">
        <div class="row">
            <div class="container">

                <div class="logo">
                    <a href="index.html"><img src="images/logo.png" alt="logo"></a>
                </div>

                <div class="responsive"><i data-icon="m" class="ion-navicon-round"></i></div>

                <ul class="nav-menu list-unstyled">
                    <li><a href="#header" class="smoothScroll" {{ Request::path() === '/' ? 'style=color:black' : ' ' }}>Home</a></li>
                    <li><a href="/about" class="smoothScroll" {{ Request::path() === 'about' ? 'style=color:black' : ' ' }}>About</a></li>
                    <li><a href="#portfolio" class="smoothScroll">Portfolio</a></li>
                    <li><a href="#journal" class="smoothScroll">Blog</a></li>
                    <li><a href="#contact" class="smoothScroll">Contact</a></li>
                </ul>

            </div>
        </div>
    </nav>
    <!-- End section navbar -->

    <!-- start section header -->
    <div id="header" class="home">

        <div class="container">
            <div class="header-content">
                <h1>I'm <span class="typed"></span></h1>
                <p>designer, developeur, photographer</p>

                <ul class="list-unstyled list-social">
                    <li><a href="#"><i class="ion-social-facebook"></i></a></li>
                    <li><a href="#"><i class="ion-social-twitter"></i></a></li>
                    <li><a href="#"><i class="ion-social-instagram"></i></a></li>
                    <li><a href="#"><i class="ion-social-googleplus"></i></a></li>
                    <li><a href="#"><i class="ion-social-tumblr"></i></a></li>
                    <li><a href="#"><i class="ion-social-dribbble"></i></a></li>
                </ul>
            </div>
        </div>
    </div>
    <!-- End section header -->


    @yield('content')
<!-- start section footer -->
    <div id="footer" class="text-center">
        <div class="container">
            <div class="socials-media text-center">
                <ul class="list-unstyled">
                    <li><a href="#"><i class="ion-social-facebook"></i></a></li>
                    <li><a href="#"><i class="ion-social-twitter"></i></a></li>
                    <li><a href="#"><i class="ion-social-instagram"></i></a></li>
                    <li><a href="#"><i class="ion-social-googleplus"></i></a></li>
                    <li><a href="#"><i class="ion-social-tumblr"></i></a></li>
                    <li><a href="#"><i class="ion-social-dribbble"></i></a></li>
                </ul>
            </div>
            <p>&copy; Copyrights Folio. All rights reserved.</p>
            <div class="credits">
                <!--
                  All the links in the footer should remain intact.
                  You can delete the links only if you purchased the pro version.
                  Licensing information: https://bootstrapmade.com/license/
                  Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/buy/?theme=Folio
                -->
                Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
            </div>
        </div>
    </div>
    <!-- End section footer -->

<!-- JavaScript Libraries -->
    <script src="lib/jquery/jquery.min.js"></script>
    <script src="lib/jquery/jquery-migrate.min.js"></script>
    <script src="lib/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="lib/typed/typed.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="lib/magnific-popup/magnific-popup.min.js"></script>
    <script src="lib/isotope/isotope.pkgd.min.js"></script>

    <!-- Contact Form JavaScript File -->
    <script src="contactform/contactform.js"></script>

    <!-- Template Main Javascript File -->
    <script src="js/main.js"></script>
</body>

</html>
