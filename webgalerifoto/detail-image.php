<?php
    error_reporting(0);
    include 'db.php';
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
    <link rel="stylesheet" href="css/all.css">

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
                <li><a href="index.php">Home</a></li>
                <li><a href="galeri.php">Gallery</a></li>
                <li><a href="about.php">About</a></li>
            </ul>
            <a href="login.php" class="action_btn">Sign In</a>
            <div class="toggle_btn">
                <i class="fa-solid fa-bars"></i>
            </div>
        </div>

        <div class="dropdown_menu">
            <li><a href="index.php">Home</a></li>
            <li><a href="galeri.php">Gallery</a></li>
            <li><a href="about.php">About</a></li>
            <li><a href="login.php" class="action_btn">Sign In</a></li>
        </div>
    </header>
</section>

<!------------------------ Search Bar ---------------------->

<div class="search">
        <div class="container">
            <form action="galeri.php">
                <input class="serc" class="search" type="text" name="search" placeholder="Cari Foto" />
                <input class="butn" type="submit" name="cari" value="Cari Foto" />
            </form>
        </div>
    </div>

<!----------------------- product detail ------------------------->
<div class="detail">
        <div class="container">
                
                   <img src="foto/<?php echo $p->image ?>"  /> 
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


<!------------------------ like and komen ---------------------->
<div class="lik">
    <div class="container">
    
<form action="" method="POST">
    <?php
    $qt = mysqli_query ($conn, "SELECT * FROM tb_like WHERE image_id = '".$_GET['id']."' ");
    if(mysqli_num_rows($qt) > 0) {
        
        ?>
        
            <button class="like2" name="suka"><i class='bx bxs-like'></i> <?php echo $q['id'] ?></button><br>
        
        <?php }else{ ?>

            <p>Tidak Ada Like</p>

        <?php  }  ?>
        
            </form>
        
        <?php
        if(isset($_POST['suka'])){
            include 'db.php';
            echo '<script>window.location="login.php"</script>';
        } ?>


        </div>
        </div>
            

        <div class="kmn">
                <div class="container">
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
                    <h3>Komentar <?php echo $kom ?></h3>
                    <?php 
                        $up = mysqli_query($conn, "SELECT * FROM tb_komen WHERE image_id = '".$_GET['id']."' ORDER BY tanggal_komentar DESC ");
                        if(mysqli_num_rows($up) > 0) {
                            while($u = mysqli_fetch_array($up)){
                    ?>

                    <div class="inpu">
                        <h4> <?php echo $u['admin_name'] ?> | <span> <?php echo $u['tanggal_komentar'] ?></span></h4>
                        <h5> <?php echo $u['isi_komentar'] ?></h5>
                    </div>
                   
                    
                    <?php
                        if($_SESSION['id'] == $u['admin_id']) {
                    ?>



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