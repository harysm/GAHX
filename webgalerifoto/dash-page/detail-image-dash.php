<?php

    session_start();
    include '../db.php';
    if($_SESSION['status_login'] != true){
		echo '<script>window.location="../login.php"</script>';
    }
	$kontak = mysqli_query($conn, "SELECT admin_telp, admin_email, admin_address FROM tb_admin WHERE admin_id = 2");
	$a = mysqli_fetch_object($kontak);
	
	$produk = mysqli_query($conn, "SELECT * FROM tb_image WHERE image_id = '".$_GET['id']."' ");
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


<!----------------------- product detail ------------------------->
<div class="detail">
        <div class="container">
                
                   <img src="../foto/<?php echo $p->image ?>"  /> 
                   <div class="tex">
                   <h3><?php echo $p->image_name ?></h3>
                   <h4>Kategori : <?php echo $p->category_name  ?></h4>
                   <h4>Nama User : <?php echo $p->admin_name ?></h4>
                   <h4>Upload Pada Tanggal : <?php echo $p->date_created  ?></h4>
                   <p>Deskripsi :<br />
                        <?php echo $p->image_description ?>
                   </p>
                   </div>

        </div>
    </div>

<!------------------------ like   ---------------------->
 <div class="lik">
    <div class="container">
    <?php
     $like = mysqli_query($conn,"SELECT * FROM tb_like WHERE image_id = '".$_GET['id']."' ");
     $L = mysqli_num_rows($like);
     $id1 = $_GET['id'];
     $cek1 = mysqli_query($conn,"SELECT * FROM tb_like WHERE image_id = '$id1' ");
     if (mysqli_num_rows($cek1)){
        while ($cek2 = mysqli_fetch_array($cek1)){
            if ($_SESSION['id'] == $cek2['admin_id'] ) {
        ?>

        <form method="POST" action="" >
            <input type="hidden" name="gamb" value="<?php echo $p->image_id ?>">
            <input type="hidden" name="idnam" value="<?php echo $_SESSION['a_global']->admin_id ?>" required>
            <input type="hidden" name="adnam" value="<?php echo $_SESSION['a_global']->admin_name ?>" required>
            <button name="suka" class="like1" hidden><i class='bx bxs-like'></i> <?php echo $L ?></button>
        </form>
        <?php } } } ?>
        <form method="POST" action="" >
            <input type="hidden" name="gamb" value="<?php echo $p->image_id ?>">
            <input type="hidden" name="idnam" value="<?php echo $_SESSION['a_global']->admin_id ?>" required>
            <input type="hidden" name="adnam" value="<?php echo $_SESSION['a_global']->admin_name ?>" required>
            <button name="suka" class="like2"><i class='bx bxs-like'></i>  <?php echo $L ?></button>
        </form>
        <?php
        if(isset($_POST['suka'])){
            $gamb = $_POST['gamb'];
            $idnam = $_POST['idnam'];
            $adnam = $_POST['adnam'];
            $cekk = mysqli_query($conn, "SELECT * FROM tb_like WHERE admin_name='".$adnam."' AND image_id='".$gamb."'");
            if(mysqli_num_rows($cekk) > 0) {
                $hapus = mysqli_query($conn, "DELETE FROM tb_like WHERE admin_name='".$adnam."' AND image_id='".$gamb."'");
                if($hapus) {
                    echo '<script>window.location="detail-image-dash.php?id='.$_GET['id'].'"</script>';
                }else{
                    echo 'gagal'.mysqli_error($conn);
                } 
            }else{
                $insert = mysqli_query($conn, "INSERT INTO tb_like VALUES (
                    null, 
                    '".$gamb."', 
                    '".$idnam."', 
                    '".$adnam."',
                    CURRENT_TIMESTAMP
                    ) ");
            if($insert) {
              echo '<script>window.location="detail-image-dash.php?id='.$_GET['id'].'"</script>';
            }else {
                echo 'gagal'.mysqli_error($conn);
            }
            }
        }
     ?>

    <!--<a class="shr" href="Whatsapp://send?text=http://localhost/webgalerifoto/dash-page/detail-image-dash.php?id=42">Bagikan Ke Whatsapp</a>-->
</div>
</div>
<!------------------------ Komen   ---------------------->
<div class="barkmn">
    <div class="container">
<form method="POST" action="" >
            <input type="hidden" name="gamb2" value="<?php echo $p->image_id ?>">
            <input type="hidden" name="idnam2" value="<?php echo $_SESSION['a_global']->admin_id ?>" required>
            <input type="hidden" name="adnam2" value="<?php echo $_SESSION['a_global']->admin_name ?>" required>
            <textarea name="komentar" class="barkomen" placeholder="Tulis Komentar Anda..." required></textarea>
            <input type="submit" name="submit" value="Kirim" class="btn">
        </form>

        <?php
        $komentar = mysqli_query($conn, "SELECT * FROM tb_komen WHERE image_id = '".$_GET['id']."' ");
        $kom = mysqli_num_rows($komentar);
        if(isset($_POST['submit'])) {
            $gamb2 = $_POST['gamb2'];
            $idnam2 = $_POST['idnam2'];
            $adnam2 = $_POST['adnam2'];
            $komen = $_POST['komentar'];
            $insert = mysqli_query($conn, "INSERT INTO tb_komen VALUES (
                null,
                '".$gamb2."',
                '".$idnam2."',
                '".$adnam2."',
                '".$komen."',
                CURRENT_TIMESTAMP
            ) ");

            if($insert) {
                echo '<script>window.location="detail-image-dash.php?id='.$_GET['id'].'"</script>';
            }else {
                echo 'gagal'.mysqli_error($conn);
            }
            }
        ?>
        </div>
        </div>


            <div class="kmn">
                <div class="container">
                    <h3>Komentar <?php echo $kom ?></h3>
                    <?php 
                        $up = mysqli_query($conn, "SELECT * FROM tb_komen WHERE image_id = '".$_GET['id']."' ORDER BY tanggal_komentar DESC ");
                        if(mysqli_num_rows($up) > 0) {
                            while($u = mysqli_fetch_array($up)){
                    ?>

                    <div class="inpu">
                        <h4> <?php echo $u['admin_name'] ?> | <span> <?php echo $u['tanggal_komentar'] ?></span></h4>
                        <h5> <?php echo $u['isi_komentar'] ?></h5>
                      



                        <?php
                        if($_SESSION['id'] == $u['admin_id']) {
                        ?>
                        <div class="inpu2">
                        <form action="" method="POST">
                        
                            <input type="hidden" name="image_id" value="<?php echo $p->image_id ?>">
                            <input type="hidden" name="hapus" value="<?php  echo $u['komen_id'] ?>">
                       
                            <button class ="btn" name="hapuskomen" onclick="return confirm('Yakin Mau Hapus ?')"> HAPUS </button>
                        </form>
                        <?php
                        if(isset($_POST['hapuskomen'])) {
                            if(isset($_SESSION['id'])) {
                                $user_id = $_SESSION['id'];
                                $image_id = $_POST['image_id'];
                                $kommen_id = $_POST['hapus'];
                                mysqli_query($conn, "DELETE FROM tb_komen WHERE image_id= '$image_id' && admin_id='$user_id' && komen_id='$kommen_id'");
                                echo '<script>window.location="detail-image-dash.php?id='.$_GET['id'].'"</script>';
                            }else{
                                echo 'gagal'.mysqli_error($conn);
                            }
                            }
                        }
                    ?>

                    <?php }} else { ?>
                        <p>komentar tidak ada</p>
                    <?php } ?>
                    </div>
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