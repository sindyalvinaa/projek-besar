<?php 
session_start();
$id_produk = $_GET['id_produk'];
if (isset($_SESSION['order'][$id_produk]))
{
	$_SESSION['order'][$id_produk]+=1;
}
else 
{
	$_SESSION['order'][$id_produk]=1;
}
echo "<script>alert('Produk telah masuk ke keranjang belanja anda');</script>";
echo "<script>location= 'order_pembeli.php'</script>";
 ?>