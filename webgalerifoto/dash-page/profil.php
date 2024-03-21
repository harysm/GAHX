<?php
    session_start();
	include '../db.php';
	if($_SESSION['status_login'] != true){
		echo '<script>window.location="../login.php"</script>';
    }
	$query = mysqli_query($conn, "SELECT * FROM tb_admin WHERE admin_id ='".$_SESSION['id']."'");
	$d = mysqli_fetch_object($query);
	
?>
<!DOCTYPE html>
<html>
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
    <div class="prfl">
        <div class="container">
            <h2>Profil </h2>
            <h4>Nama            : <span><?php echo $d->admin_name ?></span></h4>
            <h4>Username        : <span><?php echo $d->username ?></span></h4>
            <h4>Email           : <span><?php echo $d->admin_email ?></span></h4>
            <h4>No. HP    : <span><?php echo $d->admin_telp ?></span></h4>
            <h4>Alamat          : <span><?php echo $d->admin_address ?></span></h4>
            <a href="keluar.php">Logout</a>
        </div>
    </div>


 <div class="prl">
      <div class="container">
            
           
            <h3>Ubah Profil</h3>
               <form action="" method="POST">
                   <input type="text" name="nama"  class="input-control" placeholder="Masukan Nama Lengkap Baru" required>
                   <input type="text" name="user"  class="input-control" placeholder="Masukan Username Baru" required>
                   <input type="text" name="hp" class="input-control" placeholder="Masukan Nomor Telfon Baru" required>
                   <input type="email" name="email"  class="input-control" placeholder="Masukan Email Baru" required>
                   <input type="text" name="alamat"  class="input-control" placeholder="Masukan Alamat Baru" required>
                   <input type="submit" name="submit" value="Ubah Profil" class="btn">
               </form>
               <?php
                   if(isset($_POST['submit'])){
					   
					   $nama   = $_POST['nama'];
					   $user   = $_POST['user'];
					   $hp     = $_POST['hp'];
					   $email  = $_POST['email'];
					   $alamat = $_POST['alamat'];
					   
					   $update = mysqli_query($conn, "UPDATE tb_admin SET 
					                  admin_name = '".$nama."',
									  username = '".$user."',
									  admin_telp = '".$hp."',
									  admin_email = '".$email."',
									  admin_address = '".$alamat."'
									  WHERE admin_id = '".$d->admin_id."'");
					   if($update){
						   echo '<script>alert("Ubah data berhasil")</script>';
						   echo '<script>window.location="profil.php"</script>';
					   }else{
						   echo 'gagal '.mysqli_error($conn);
					   }
					   
					}   
			   ?>
            
                </div>
                </div>
            
             
            <div class="pas">
                <div class="container">
        
            <h3>Ubah Password</h3>
               <form action="" method="POST">
                   <input type="password" name="pass1" placeholder="Password Baru" class="input-control" required >
                   <input type="password" name="pass2" placeholder="Konfirmasi Password Baru" class="input-control" required>
                   <input type="submit" name="ubah_password" value="Ubah Password" class="btn">
               </form>
               <?php
                   if(isset($_POST['ubah_password'])){
					   
					   $pass1   = $_POST['pass1'];
					   $pass2   = $_POST['pass2'];
					   
					   if($pass2 != $pass1){
						   echo '<script>alert("Konfirmasi Password Baru tidak sesuai")</script>';
					   }else{
						   $u_pass = mysqli_query($conn, "UPDATE tb_admin SET 
									  password = '".$pass1."'
									  WHERE admin_id = '".$d->admin_id."'");
						   if($u_pass){
							   echo '<script>alert("Ubah data berhasil")</script>';
						       echo '<script>window.location="profil.php"</script>';
						   }else{
							   echo 'gagal '.mysqli_error($conn);
						   }
					   }
					  
					}  
			   ?>
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
</script>
</body>
</html>