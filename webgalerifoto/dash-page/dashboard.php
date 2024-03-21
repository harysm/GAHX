<?php
    error_reporting(0);
    session_start();
	if($_SESSION['status_login'] != true){
		echo '<script>window.location="../login.php"</script>';
    }

    include '../db.php';
	$kontak = mysqli_query($conn, "SELECT admin_email FROM tb_admin WHERE admin_id = 2");
	$a = mysqli_fetch_object($kontak);
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

<!------------------------ Search Bar ---------------------->

<div class="search">
        <div class="container">
            <form action="galeri.php" method="GET">
                <input class="serc" class="search" type="text" name="search" placeholder="Cari Foto" value="<?php echo $_GET['search'] ?>" />
                <input class="butn" type="submit" name="cari" value="Cari Foto" />
            </form>
        </div>
    </div>


<!------------------------ HOME ---------------------->

<div class="home" id="home">
<div class="container">
        <h1>Welcome To GAHX</h1>
    <p>Selamat Datang di Website Galeri Foto</p>
</div>
</div>

<!------------------------ Kategori ---------------------->

<div class="katego">
        <div class="container">
                <?php
                    $kategori = mysqli_query($conn, "SELECT * FROM tb_category ORDER BY category_id DESC");
					if(mysqli_num_rows($kategori) > 0){
						while($k = mysqli_fetch_array($kategori)){
				?>
                    <a href="galeri-dash.php?kat=<?php echo $k['category_id'] ?>">
                        <div class="kat-icon">
                  <img src="../img/Icon GAHX 2024/Icon cream.png" width="50px" style="margin-bottom:5px;" />
                        <p><?php echo $k['category_name'] ?></p>

                        </div>
                    </a>
                <?php }}else{ ?>
                     <p>Kategori tidak ada</p>
                <?php } ?>
            
        </div>
    </div>



<!------------------------ Latest Image ---------------------->

<div class="image">
<div class="container">
       
       <div class="box">
          <?php
              $foto = mysqli_query($conn, "SELECT * FROM tb_image WHERE image_status = 1 ORDER BY image_id DESC LIMIT 8");
			  if(mysqli_num_rows($foto) > 0){
				  while($p = mysqli_fetch_array($foto)){
		  ?>
          <a href="detail-image-dash.php?id=<?php echo $p['image_id'] ?>">
          <div class="lat-img">
              <img src="../foto/<?php echo $p['image'] ?>" height="150px" />
              <p class="nama"><?php echo substr($p['image_name'], 0, 30)  ?></p>
              <p class="admin">Nama User : <?php echo $p['admin_name'] ?></p>
              <p class="date"><?php echo $p['date_created']  ?></p>
          </div>
          </a>
          <?php }}else{ ?>
              <p>Foto tidak ada</p>
          <?php } ?>
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
</script>

</body>
</html>












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