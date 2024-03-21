<?php
    session_start();
	include '../db.php';
	if($_SESSION['status_login'] != true){
		echo '<script>window.location="../login.php"</script>';
    }
	
	$produk = mysqli_query($conn, "SELECT * FROM  tb_image WHERE image_id = '".$_GET['id']."'");
	if(mysqli_num_rows($produk) == 0){
	    echo '<script>window.location="data-image.php"</script>';
	}
	$p = mysqli_fetch_object($produk);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GAHX</title>
    <link rel="Icon" href="img/Icon GAHX 2024/Big Icon White.png">
    <link rel="stylesheet" href="../css/all.css">

    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Chakra+Petch:wght@300;400&family=Dosis:wght@300&family=Poiret+One&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" crossorigin="anonymous" referrerpolicy="no-referrer">
    <link href="https://fonts.googleapis.com/css2?family=Josefin+Slab:ital,wght@0,100..700;1,100..700&display=swap" rel="stylesheet">
    <script src="https://cdn.ckeditor.com/4.20.0/standard/ckeditor.js"></script>
</head>
<body>

<!------------------------ navbar ---------------------->

<section class="nvbr">
    <header>
        <div class="navbar ">
            <div class="logo"><a href="#">GAHX</a></div>
            <ul class="links">
                <li><a href="dashboard.php">Home</a></li>
                <li><a href="profil.php">Profile</a></li>
                <li><a href="galeri-dash.php">Gallery</a></li>
                <li><a href="about-dash.php">About</a></li>
                <li><a href="data-image.php">Data Foto</a></li>
            </ul>

            <div class="toggle_btn">
                <i class="fa-solid fa-bars"></i>
            </div>
        </div>

        <div class="dropdown_menu">
            <li><a href="dashboard.php">Home</a></li>
            <li><a href="profil.php">Profile</a></li>
            <li><a href="galeri-dash.php">Gallery</a></li>
            <li><a href="about-dash.php">About</a></li>
            <li><a href="data-image.php">Data Foto</a></li>
        </div>
    </header>
</section>




    <!-- content -->
    <div class="edit">
        <div class="container">
            <h3>Edit Data Foto</h3>
            
            <div class="box">
        
    <form action="" method="POST" enctype="multipart/form-data">
            <input type="text" name="kategori" class="input-control" placeholder="Kategori Foto" value="<?php echo $p->category_name ?>" readonly="readonly">
            <input type="text" name="namauser" class="input-control" placeholder="Nama User" value="<?php echo $p->admin_name ?>" readonly="readonly">
            <input type="text" name="nama" class="input-control" placeholder="Nama Foto" value="<?php echo $p->image_name ?>" required>
                   
                   <img src="../foto/<?php echo $p->image ?>" width="200px" style="margin:10px;" />
                   <input type="hidden" name="foto" value="<?php echo $p->image ?>" />
                   <input type="file" name="gambar" class="input-control">
                   <textarea class="input-control" name="deskripsi" placeholder="Deskripsi"><?php echo $p->image_description ?></textarea><br />
                   <select class="input-control" name="status">
                       <option value="">--Pilih--</option>
                       <option value="1" <?php echo ($p->image_status == 1)? 'selected':''; ?>>Aktif</option>
                       <option value="0"<?php echo ($p->image_status == 0)? 'selected':''; ?>>Tidak Aktif</option> 
                   </select>
                   <input type="submit" name="submit" value="Submit" class="btn">
               </form>
               <?php
                   if(isset($_POST['submit'])){
					
					// data inputan dari form
					$kategori  = $_POST['kategori'];
					$user      = $_POST['namauser'];
					$nama      = $_POST['nama'];
					$deskripsi = $_POST['deskripsi'];
					$status    = $_POST['status'];
					$foto      = $_POST['foto'];
					
					// data gambar yang baru 
					$filename = $_FILES['gambar']['name'];
					$tmp_name = $_FILES['gambar']['tmp_name'];
					   
					//jika admin ganti gambar
					if($filename != ''){
						
						$type1 = explode('.', $filename);
					    $type2 = $type1[1];

                        $newname = 'foto'.time().'.'.$type2;
					
					    // menampung data format file yang diizinkan
					    $tipe_diizinkan = array('jpg', 'jpeg', 'png', 'gif');
					
					  // validasi format file
					  if(!in_array($type2, $tipe_diizinkan)){
				        // jika format file tidak ada di dalam tipe diizinkan
				        echo '<script>alert("Format file tidak diizinkan")</script>';
						
					  }else{
						unlink('../foto/'.$foto); 
					    move_uploaded_file($tmp_name, '../foto/'.$newname);
						$namagambar = $newname;  
					  }
					
					}else{
					   // jika admin tidak ganti gambar
					   $namagambar = $foto;
					   
					}
					
					//query update data produk
					$update = mysqli_query($conn, "UPDATE tb_image SET
					                       category_name       = '".$kategori."',
										   admin_name          = '".$user."',
										   image_name          = '".$nama."',
										   image_description   = '".$deskripsi."',
										   image               = '".$namagambar."',
										   image_status        = '".$status."'
										   WHERE image_id      = '".$p->image_id."' ");
					 if($update){
						echo '<script>alert("Ubah data berhasil")</script>';
					    echo '<script>window.location="data-image.php"</script>';
					 }else{
					    echo 'gagal'.mysqli_error($conn);
							   
						   }
			      }
			   ?>
        </div>
        </div>
    </div>

 <!------------------------ footer ---------------------->

 <div class="footer">
    <div class="container">
    <p>Copyright &copy; 2024 - GAHX | Haxs.</p>
</div>
</div>


<script>
    const toggleBtn = document.querySelector('.toggle_btn')
    const toggleBtnIcon = document.querySelector('.toggle_btn i')
    const dropDownMenu = document.querySelector('.dropdown_menu')

    toggleBtn.onclick = function () {
        dropDownMenu.classList.toggle('open')
        const isOpen = dropDownMenu.classList.contains('open')

        toggleBtnIcon.classList = isOpen
        ? 'fa-solid fa-xmark'
        : 'fa-solid fa-bars'
    }
    
    CKEDITOR.replace( 'deskripsi' );
</script>

</body>
</html>