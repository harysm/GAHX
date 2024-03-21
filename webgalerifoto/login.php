<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>GAHX</title>
    <link rel="stylesheet" type="text/css" href="css/reg-log.css">

    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Chakra+Petch:wght@300;400&family=Dosis:wght@300&family=Poiret+One&display=swap" rel="stylesheet">
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.5/dist/sweetalert2.all.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.5/dist/sweetalert2.min.css">


</head>
<body>

<!------------------------ Loading---------------------->

<div class="loading-screen">
        <div class="loader"></div>
    </div>

<!------------------------ Login ---------------------->
     <div class="wrapper">
         <h1>Sign In To GAHX</h1>
         <form action="" method="POST">
		 <div class="input-box">
                <div class="input-field">
                    <input type="text" name="user" placeholder="Username" required oninvalid="this.setCustomValidity('Masukan Username Anda!')" oninput="this.setCustomValidity('')">
                    <i class='bx bxs-user'></i>
                </div>
                
            </div>


            <div class="input-box">
                <div class="input-field">
                    <input type="password" id="password" name="pass" class="form-control"  placeholder="Password" required oninvalid="this.setCustomValidity('Masukan Password Anda!')" oninput="this.setCustomValidity('')">
                    
                    <span  id="showHide">
                     <i class="bi-eye"></i>
                    </span>
                </div>
             
            </div>
             <input type="submit" name="submit" value="Sign In" class="btn">
			 <div class="register-link">
                    <div class="regs">
                    <a href="register.php">Dont Have an Account?</a>
                    </div>
                    <div class="backs">
                    <a href="index.php">Back To Home!</a>
                    </div>
                </div>
</div> 
         </form>
         <?php
		     if(isset($_POST['submit'])){
				 session_start();
				 include 'db.php';

				 $user = mysqli_real_escape_string($conn, $_POST['user']);
				 $pass = mysqli_real_escape_string($conn, $_POST['pass']);
				 
				 $cek = mysqli_query($conn, "SELECT * FROM tb_admin WHERE username = '".$user."'AND password = '".$pass."'");
				 if(mysqli_num_rows($cek) > 0){
					 $d = mysqli_fetch_object($cek);
					 $_SESSION['status_login'] = true;
					 $_SESSION['a_global'] = $d;
					 $_SESSION['id'] = $d->admin_id;
					 echo '<script>window.location="dash-page/dashboard.php"</script>';
				 }else{
					$_SESSION['er']="Username atau Password kamu salah!";
				 }
			 }
	     ?><br />
      </div>
      



	  <?php if(@$_SESSION['er']){ ?>
    <script>
		Swal.fire({
  position: "center",
  icon: "error",
  title: "<?php echo $_SESSION['er']; ?>",
  showConfirmButton: false,
  timer: 2000
});
    </script>
    <?php unset($_SESSION['er']); }?>


	  <script>// Ini akan menghilangkan layar loading saat semua konten dimuat
    window.addEventListener('load', function () {
        const loadingScreen = document.querySelector('.loading-screen');
        const content = document.querySelector('.content');
    
        loadingScreen.style.display = 'none';
        content.style.display = 'block';
    });

    const password = document.getElementById('password'); // id dari input password
    const showHide = document.getElementById('showHide'); // id span showHide dalam input group password

    password.type = 'password'; // set type input password menjadi password
    showHide.innerHTML = '<i class="bi bi-eye"></i>'; // masukan icon eye dalam icon bootstrap 5
    showHide.style.cursor = 'pointer'; // ubah cursor menjadi pointer
// jadi ketika span di hover maka cursornya berubah pointer

    showHide.addEventListener('click', () => {
// ketika span diclick
    if (password.type === 'password') {
        // jika type inputnya password
        password.type = 'text'; // ubah type menjadi text
        showHide.innerHTML = '<i class="bi-eye-slash"></i>'; // ubah icon menjadi eye slash
    } else {
        // jika type bukan password (text)
        showHide.innerHTML = '<i class="bi-eye"></i>'; // ubah icon menjadi eye
        password.type = 'password'; // ubah type menjadi password
    }
        });
    </script>
</body>
</html>