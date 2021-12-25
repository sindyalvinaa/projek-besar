<?php 
session_start();

$id_produk = $_GET['id_produk'];

if (isset($_SESSION['detail_produk'][$id_produk]))
{
	$_SESSION['detail_produk'][$id_produk];
}

else 
{
	$_SESSION['detail_produk'][$id_produk];
}

echo "<script>alert('Detail Produk');</script>";
echo "<script>location= 'detail_produk.php'</script>";

 ?>