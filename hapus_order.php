<?php 
session_start();
$id_produk = $_GET["id_produk"];
unset($_SESSION["order"][$id_produk]);
echo "<script>alert('Produk telah dihapus');</script>"; 
echo "<script>location= 'order_pembeli.php'</script>";
?>