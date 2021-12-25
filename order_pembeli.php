<?php  
error_reporting(0);
include('koneksi.php');
    session_start();
      if(!isset($_SESSION['login_user'])) {
        header("location: login.php");
      }else{
?>
<?php 
if(empty($_SESSION["order"]) OR !isset($_SESSION["order"]))
{
  echo "<script>alert('Keranjang Belanja Kosong, Silahkan Pilih Produk dahulu');</script>";
  echo "<script>location= 'produk_pembeli.php'</script>";
}
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
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css">
    <title>Nadiraa Hijab Official Shop</title>
  </head>

  <body>
  <!-- Jumbotron -->
      <div class="jumbotron jumbotron-fluid text-center">
        <div class="container">
          <h1 class="display-4"><span class="font-weight-bold">Nadiraa Hijab Official Shop</span></h1>
          <hr>
          <p class="lead font-weight-bold">WELCOME TO NADIRAA HIJAB<br> </p>
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
              <a class="nav-link mr-4" href="produk_pembeli.php">ADD CART</a>
            </li>
            <li class="nav-item">
              <a class="nav-link mr-4" href="blog.php">BLOG</a>
            </li>
            <li class="nav-item">
              <a class="nav-link mr-4" href="contact.php">CONTACT</a>
            </li>
            <li class="nav-item">
              <a class="nav-link mr-4" href="logout.php">LOGOUT</a>
            </li>
          </ul></div></div> </nav>
  <!-- Navbar -->

  <!-- Produk -->
    <div class="container">
      <div class="judul-pesanan mt-5">
        <h3 class="text-center font-weight-bold">PESANAN ANDA</h3>
      </div>
      <table class="table table-bordered" id="example">
        <thead class="thead-light">
          <tr>
            <th scope="col">No</th>
            <th scope="col">Nama Pesanan</th>
            <th scope="col">Harga</th>
            <th scope="col">Jumlah</th>
            <th scope="col">Subharga</th>
            <th scope="col">Opsi</th>
          </tr></thead>
        <tbody>
            <?php $nomor=1; ?>
            <?php $totalbelanja = 0; ?>
            <?php foreach ($_SESSION["order"] as $id_produk => $jumlah) : ?>
            <?php 
              include('koneksi.php');
              $ambil = mysqli_query($koneksi, "SELECT * FROM produk WHERE id_produk='$id_produk'");
              $pecah = $ambil -> fetch_assoc();
              $subharga = $pecah["harga"]*$jumlah;
            ?>
          <tr>
            <td><?php echo $nomor; ?></td>
            <td><?php echo $pecah["nama_produk"]; ?></td>
            <td>Rp. <?php echo number_format($pecah["harga"]); ?></td>
            <td><?php echo $jumlah; ?></td>
            <td>Rp. <?php echo number_format($subharga); ?></td>
            <td>
              <a href="hapus_order.php?id_produk=<?php echo $id_produk ?>" class="badge badge-danger">Hapus</a>
            </td>
          </tr>
            <?php $nomor++; ?>
            <?php $totalbelanja+=$subharga; ?>
            <?php endforeach ?>
        </tbody>
        <tfoot>
          <tr>
            <th colspan="4">Total Belanja</th>
            <th colspan="2">Rp. <?php echo number_format($totalbelanja) ?></th>
          </tr>
        </tfoot>
      </table><br>
      <form method="POST" action="">
        <a href="produk_pembeli.php" class="btn btn-primary btn-sm">Lihat Produk</a>
        <button class="btn btn-success btn-sm" name="konfirm">Konfirmasi Pesanan</button>
      </form>        
      <?php 
      if(isset($_POST['konfirm'])) {
          $tanggal_pemesanan=date("Y-m-d");
          // Menyimpan data ke tabel pemesanan
          $insert = mysqli_query($koneksi, "INSERT INTO pemesanan (tanggal_pemesanan, total_belanja) VALUES ('$tanggal_pemesanan', '$totalbelanja')");
          // Mendapatkan ID barusan
          $id_terbaru = $koneksi->insert_id;
          // Menyimpan data ke tabel pemesanan produk
          foreach ($_SESSION["pesanan"] as $id_produk => $jumlah)
          {
            $insert = mysqli_query($koneksi, "INSERT INTO pemesanan_produk (id_pemesanan, id_produk, jumlah) 
              VALUES ('$id_terbaru', '$id_produk', '$jumlah') ");
          }          
          // Mengosongkan pesanan
          unset($_SESSION["pesanan"]);
          // Dialihkan ke halaman nota
          echo "<script>alert('Pemesanan Sukses!');</script>";
          echo "<script>location= 'produk_pembeli.php'</script>";
      }?></div><br><br><br><br>
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
            <strong>Copyright</strong> <i class="far fa-copyright"></i>2021 -  Designed by sindyalvinaa & rinapuji</p>
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
            </ul></div></div>
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
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
    <script>
      $(document).ready(function() {
          $('#example').DataTable();
      } );</script></body></html><?php } ?>