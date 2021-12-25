<?php 
error_reporting(0);
    session_start();
      if(!isset($_SESSION['login_user'])) {
        header("location: login.php");
      }else{
?>

<!doctype html> 
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" 
    integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="index.css">
    <link rel="stylesheet" type="text/css" href="fontawesome/css/all.min.css">
    <title>Nadiraa Hijab Official Shop</title>
  </head>

  <body>
  <!-- Jumbotron -->
      <div class="jumbotron jumbotron-fluid text-center">
        <div class="container">
          <h1 class="display-4"><span class="font-weight-bold">Nadiraa Hijab Official Shop</span></h1>
          <hr>
          <p class="lead font-weight-bold">WELCOME TO NADIRAA HIJAB <br> </p>
        </div>
      </div>
  <!-- Jumbotron -->

  <!-- Navbar -->
      <nav class="navbar navbar-expand-lg  bg-dark">
        <div class="container">
        <a class="navbar-brand text-white" href="user.php"><strong>Nadiraa</strong>Hijab</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" 
        aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item">
              <a class="nav-link mr-4" href="user.php">HOME</a>
            </li>
            <li class="nav-item">
              <a class="nav-link mr-4" href="produk_pembeli.php">PRODUCT</a>
            </li>
            <li class="nav-item">
              <a class="nav-link mr-4" href="order_pembeli.php">ADD CART</a>
            </li>
            <li class="nav-item">
              <a class="nav-link mr-4" href="blog.php">BLOG</a>
            </li>
            <li class="nav-item">
              <a class="nav-link mr-4" href="contact.php">CONTACT</a>
            </li>
            <li class="nav-item">
              <a class="nav-link mr-4" href="logout.php">LOGOUT</a>
            </li></ul></div></div> </nav>
  <!-- Navbar -->

  <!-- Produk -->
      <div class="container">
        <div class="row mt-3">
          <?php 
          include('koneksi.php');
          $query = mysqli_query($koneksi, 'SELECT * FROM produk');
          $result = mysqli_fetch_all($query, MYSQLI_ASSOC);
          ?>
          <?php foreach($result as $result) : ?>
          <div class="col-md-3 mt-4">
            <div class="card brder-dark">
              <img src="upload/<?php echo $result['gambar'] ?>" class="card-img-top" alt="...">
              <div class="card-body">
                <h5 class="card-title font-weight-bold"><?php echo $result['nama_produk'] ?></h5>
               <label class="card-text harga"><strong>Rp.</strong> <?php echo number_format($result['harga']); ?></label><br>
                <a href="beli.php?id_produk=<?php echo $result['id_produk']; ?>" class="btn btn-success btn-sm btn-block ">BELI</a>
                <a href="detail_produk.php?id_produk=<?php echo $result['id_produk']; ?>" class="btn btn-success btn-sm btn-block ">DETAIL</a>
              </div></div></div>
          <?php 
          endforeach;?>
         </div></div><br><br><br><br>
  <!-- Produk -->

  <div class="row">
  <div class="container">
        <div class="row footer-body">
          <section class="large-3 medium-4 columns column-widget right-align">
          <aside id="nav_menu-5" class="widget widget_nav_menu">
            <h3 class="widget-title">Information</h3>
            <div class="menu-information-container">
              <ul id="menu-information" class="menu">
                <li id="menu-item-3141" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-3141">
            <a href="about_us.php">About Us</a></li>
          <li id="menu-item-3142" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-3142">
            <a href="contact.php">Contact Us</a></li>
          <li id="menu-item-3143" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-3143">
            <a href="ThePrivacyPolicy.php">The Privacy Policy</a></li>
          <li id="menu-item-3144" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-3144">
            <a href="FAQ.php">FAQ</a></li>
          </ul></div></aside></section>
          <section class="large-3 medium-4 columns column-widget right-align">
          <aside id="nav_menu-2" class="widget widget_nav_menu"><h3 class="widget-title">Collections</h3><div 
          class="menu-main-navigation-container"><ul id="menu-main-navigation-1" class="menu"><li id="menu-item-1328" 
          class="menu-item menu-item-type-post_type_archive menu-item-object-product menu-item-1328">
          <a href="produk_pembeli.php">Product</a></li>
          <li id="menu-item-1698" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-1698">
            <a href="order_pembeli.php">Add Cart</a></li>
          <li id="menu-item-1700" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-1700">
            <a href="blog.php">Blog</a></li>
          <li id="menu-item-1701" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-1701">
            <a href="contact.php">Contact</a></li>
          </ul></div></aside> </section>

  <!-- Footer -->
      <hr class="footer">
      <div class="container">
        <div class="row footer-body">
          <div class="col-md-6">
          <div class="copyright">
            <strong>Copyright</strong> <i class="far fa-copyright"></i> 2021 -  Designed by sindyalvinaa & rinapuji </p>
          </div>
          </div>
  <!-- Footer -->

    <!-- Header -->
    <div class="medsos">
        <div class="container">
            <ul>
            <label class="font-weight-bold"> Follow Us </label>
                <li><a href="https://www.facebook.com/Nadiraahijab"><i class="fab fa-facebook"></i></a></li>
                <li><a href="https://www.instagram.com/nadiraa_hijab/"><i class="fab fa-instagram"></i></a></li>
                <li><a href="https://www.youtube.com/watch?v=jVcqWVzRdVA&feature=youtu.be"><i class="fab fa-youtube"></i></a></li>
                <li><a href="http://twitter.com/NadiraaHijab"><i class="fab fa-twitter"></i></a></li>
            </ul>
        </div>
    </div>
    <!-- Header -->

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" 
    integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" 
    integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" 
    integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
    <script type="text/javascript" src="js/jquery.js"></script>
  </body></html><?php } ?>