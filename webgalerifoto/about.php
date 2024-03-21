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

</head>
<body>



<!------------------------ Gallery ---------------------->

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



<!------------------------ Created By ---------------------->

<section class="team">
  <div class="container">

    <div class="card-body">
      <img class="card-img-top" src="img/Creted by/Harys.png" alt="Card image">
      <div class="cd-bd">
        <h4 class="card-title">M.Harys Rusty Wibawa</h4>
        <p class="card-text">Developer Of GAHX</p>
        <p class="card-text">Do what you want, Do what you like, Show who you are <br> -HAXS</p>
      </div>
      </div>
      

  </div>
</section>




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