<?php

   include '../db.php';
      
   if(isset($_GET['idp'])){
	   $foto = mysqli_query($conn, "SELECT image FROM tb_image WHERE image_id = '".$_GET['idp']."' ");
	   $p = mysqli_fetch_object($foto);
	   
	   unlink('../foto/'.$p->image);
	
	$deleteK = mysqli_query($conn, "DELETE FROM tb_komen WHERE image_id = '".$_GET['idp']."' ");
	$deleteL = mysqli_query($conn, "DELETE FROM tb_like WHERE image_id = '".$_GET['idp']."' ");
	$delete = mysqli_query($conn, "DELETE FROM tb_image WHERE image_id = '".$_GET['idp']."' ");
	echo '<script>window.location="data-image.php"</script>';
   }

?>