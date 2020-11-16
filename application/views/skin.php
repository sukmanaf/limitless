<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Reveal Bootstrap Template</title>
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <meta content="" name="keywords">
  <meta content="" name="description">

  <!-- Favicons -->
  <link href="img/favicon.png" rel="icon">
  <link href="img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,700,700i|Raleway:300,400,500,700,800|Montserrat:300,400,700" rel="stylesheet">

  <!-- Bootstrap CSS File -->
  <link href="<?php echo base_url() ?>assets/lib/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <!-- Libraries CSS Files -->
  <link href="<?php echo base_url() ?>assets/lib/font-awesome/css/font-awesome.min.css" rel="stylesheet">
  <link href="<?php echo base_url() ?>assets/lib/animate/animate.min.css" rel="stylesheet">
  <link href="<?php echo base_url() ?>assets/lib/ionicons/css/ionicons.min.css" rel="stylesheet">
  <link href="<?php echo base_url() ?>assets/lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
  <link href="<?php echo base_url() ?>assets/lib/magnific-popup/magnific-popup.css" rel="stylesheet">
  <link href="<?php echo base_url() ?>assets/lib/ionicons/css/ionicons.min.css" rel="stylesheet">
  <link href="<?php echo base_url() ?>assets/css/custom.css" rel="stylesheet">
  <link href="<?php echo base_url() ?>assets/css/slick.css" rel="stylesheet">
  <link href="<?php echo base_url() ?>assets/css/slick.scss" rel="stylesheet">
  <link href="<?php echo base_url() ?>assets/css/slick-theme.css" rel="stylesheet">
  <link href="<?php echo base_url() ?>assets/css/slick-theme.scss" rel="stylesheet">

  <!-- Main Stylesheet File -->
  <link href="<?php echo base_url() ?>assets/css/style.css" rel="stylesheet">

  <style type="text/css">
    table, th, td {
  border: 1px solid gray;
}
.carousel-inner > .item {
  height: 100vh;
}
.carousel-inner > .carousel-item > img {

  width: auto;
 max-height: 500px;
    background-position: center;
    background-size: cover;
}




  </style>
  <!-- =======================================================
    Theme Name: Reveal
    Theme URL: https://bootstrapmade.com/reveal-bootstrap-corporate-template/
    Author: BootstrapMade.com
    License: https://bootstrapmade.com/license/
  ======================================================= -->
</head>

<body id="body">

  <!--==========================
    Top Bar
  ============================-->
  <section id="topbar" class="d-none d-lg-block">
    <div class="container clearfix">
      <div class="contact-info float-left">
        <i class="fa fa-envelope-o"></i> <a href="mailto:contact@example.com"><?php echo $profil['email'] ?></a>
        <i class="fa fa-phone"></i> <?php echo $profil['telp'] ?>
      </div>
      <div class="social-links float-right">
        <a href="<?php echo $sosmed['twitter'] ?>" class="twitter"><i class="fa fa-twitter"></i></a>
        <a href="<?php echo $sosmed['facebook'] ?>" class="facebook"><i class="fa fa-facebook"></i></a>
        <a href="<?php echo $sosmed['instagram'] ?>" class="instagram"><i class="fa fa-instagram"></i></a>
        <a href="<?php echo $sosmed['youtube'] ?>" class="youtube"><i class="fa fa-youtube"></i></a>
        <!-- <a href="<?php echo $sosmed[''] ?>" class="linkedin"><i class="fa fa-linkedin"></i></a> -->
      </div>
    </div>
  </section>

  <!--==========================
    Header
  ============================-->
  <header id="header">
    <div class="container">

      <div id="logo" class="pull-left">
        <h1><a href="<?php echo base_url(); ?>" class="scrollto">Mobil <span>Mobilan</span></a></h1>
        <!-- Uncomment below if you prefer to use an image logo -->
        <!-- <a href="#body"><img src="img/logo.png" alt="" title="" /></a>-->
      </div>

      <nav id="nav-menu-container">
        <ul class="nav-menu">
          <li class="menu-active"><a href="<?php echo base_url(); ?>">Home</a></li>
          <li class="menu-has-children"><a href="">Produk</a>
            <ul>
              <li><a href="#">Drop Down 1</a></li>
              <li><a href="#">Drop Down 3</a></li>
              <li><a href="#">Drop Down 4</a></li>
              <li><a href="#">Drop Down 5</a></li>
            </ul>
          </li>
          <li><a href="<?php echo base_url().'daftar_mobil' ?>">Daftar Harga</a></li>
          <li><a href="#services">Artikel & romo</a></li>
          <li><a href="#portfolio">Video</a></li>
          <li><a href="#team">Sales</a></li>
          
        </ul>
      </nav><!-- #nav-menu-container -->
    </div>
  </header><!-- #header -->
    
  <?php echo $body ?>

    </section><!-- #contact -->
    <!--==========================
      Call To Action Section
    ============================-->
    <section id="call-to-action" class="wow fadeInUp">
      <div class="container">
        <div class="row">
          <div class="col-lg-9 text-center text-lg-left">
            <h3 class="cta-title" align="center"><?php echo $profil['kontak_judul'] ?></h3>
            <p class="cta-text"><?php echo $profil['kontak_isi'] ?>.</p>
          </div>
          <div class="col-lg-3 cta-btn-container text-center">
            <a class="cta-btn align-middle" href="#"><?php echo $profil['kontak_judul'] ?></a>
          </div>
        </div>

      </div>
    </section><!-- #call-to-action -->

    <!-- #clients -->

    <!--==========================
      Our Portfolio Section
    ============================-->

    <!--==========================
      Testimonials Section
    ============================-->
  <!--   <section id="testimonials" class="wow fadeInUp">
      <div class="container">
        <div class="section-header">
          <h2>Testimonials</h2>
          <p>Sed tamen tempor magna labore dolore dolor sint tempor duis magna elit veniam aliqua esse amet veniam enim export quid quid veniam aliqua eram noster malis nulla duis fugiat culpa esse aute nulla ipsum velit export irure minim illum fore</p>
        </div>
        <div class="owl-carousel testimonials-carousel">

            <div class="testimonial-item">
              <p>
                <img src="img/quote-sign-left.png" class="quote-sign-left" alt="">
                Proin iaculis purus consequat sem cure digni ssim donec porttitora entum suscipit rhoncus. Accusantium quam, ultricies eget id, aliquam eget nibh et. Maecen aliquam, risus at semper.
                <img src="img/quote-sign-right.png" class="quote-sign-right" alt="">
              </p>
              <img src="img/testimonial-1.jpg" class="testimonial-img" alt="">
              <h3>Saul Goodman</h3>
              <h4>Ceo &amp; Founder</h4>
            </div>

            <div class="testimonial-item">
              <p>
                <img src="img/quote-sign-left.png" class="quote-sign-left" alt="">
                Export tempor illum tamen malis malis eram quae irure esse labore quem cillum quid cillum eram malis quorum velit fore eram velit sunt aliqua noster fugiat irure amet legam anim culpa.
                <img src="img/quote-sign-right.png" class="quote-sign-right" alt="">
              </p>
              <img src="img/testimonial-2.jpg" class="testimonial-img" alt="">
              <h3>Sara Wilsson</h3>
              <h4>Designer</h4>
            </div>

            <div class="testimonial-item">
              <p>
                <img src="img/quote-sign-left.png" class="quote-sign-left" alt="">
                Enim nisi quem export duis labore cillum quae magna enim sint quorum nulla quem veniam duis minim tempor labore quem eram duis noster aute amet eram fore quis sint minim.
                <img src="img/quote-sign-right.png" class="quote-sign-right" alt="">
              </p>
              <img src="img/testimonial-3.jpg" class="testimonial-img" alt="">
              <h3>Jena Karlis</h3>
              <h4>Store Owner</h4>
            </div>

        </div>

      </div>
    </section> --><!-- #testimonials -->

    <!--==========================
      Call To Action Section
    ============================-->

    <!--==========================
      Contact Section
    ============================-->

  </main>

  <!--==========================
    Footer
  ============================-->
  <footer id="footer">
    <div class="container">
      <div class="copyright">
        &copy; Copyright <strong>Reveal</strong>. All Rights Reserved
      </div>
      <div class="credits">
        <!--
          All the links in the footer should remain intact.
          You can delete the links only if you purchased the pro version.
          Licensing information: https://bootstrapmade.com/license/
          Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/buy/?theme=Reveal
        -->
        Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
      </div>
    </div>
  </footer><!-- #footer -->

  <a href="#" class="back-to-top"><i class="fa fa-chevron-up"></i></a>

  <!-- JavaScript Libraries -->
  <script src="<?php echo base_url() ?>assets/lib/jquery/jquery.min.js"></script>
  <script src="<?php echo base_url() ?>assets/lib/jquery/jquery-migrate.min.js"></script>
  <script src="<?php echo base_url() ?>assets/lib/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="<?php echo base_url() ?>assets/lib/easing/easing.min.js"></script>
  <script src="<?php echo base_url() ?>assets/lib/superfish/hoverIntent.js"></script>
  <script src="<?php echo base_url() ?>assets/lib/superfish/superfish.min.js"></script>
  <script src="<?php echo base_url() ?>assets/lib/wow/wow.min.js"></script>
  <script src="<?php echo base_url() ?>assets/lib/owlcarousel/owl.carousel.min.js"></script>
  <script src="<?php echo base_url() ?>assets/lib/magnific-popup/magnific-popup.min.js"></script>
  <script src="<?php echo base_url() ?>assets/lib/sticky/sticky.js"></script>

  <!-- Contact Form JavaScript File -->
  <script src="<?php echo base_url() ?>assets/contactform/contactform.js"></script>

  <!-- Template Main Javascript File -->
  <script src="<?php echo base_url() ?>assets/js/main.js"></script>
    <!-- <script src="<?php echo base_url() ?>assets/js/multislider.min.js"></script> -->
    <script src="<?php echo base_url() ?>assets/js/slick.min.js"></script>

    <script>
$( document ).ready(function() {
      $(".center-slide").slick({
        dots: true,
        infinite: true,
        centerMode: true,
        slidesToShow: 3,
        slidesToScroll: 1
      });
});
    // $('#exampleSlider').multislider({
    //     interval: 4000,
    //     slideAll: false,
    //     duration: 1500
    // });
    </script>
</body>
</html>
