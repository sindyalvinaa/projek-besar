<?php 
if(empty($_SESSION["order"]) OR !isset($_SESSION["order"]))
{
  echo "<script>alert('Detail Produk');</script>";
  echo "<script>location= 'produk_pembeli.php'</script>";
}
?>