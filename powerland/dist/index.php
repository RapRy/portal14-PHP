<!DOCTYPE html>
<?php 
    include('./backend/connection.php');
    include('./backend/backend.php'); 

    $actives = [
        'category' => isset($_GET['cat']) ? str_replace("+", " ", $_GET['cat']) : "Games-apk" , 
        'subcategory' => isset($_GET['subcat']) ? str_replace("+", " ", $_GET['subcat']) : "Action"];
    $catsRef = ['Games-apk', 'VIDEOS', 'Apps', 'Tones'];
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./style/main.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous" defer></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.7.1/gsap.min.js" integrity="sha512-UxP+UhJaGRWuMG2YC6LPWYpFQnsSgnor0VUF3BHdD83PS/pOpN+FYbZmrYN+ISX8jnvgVUciqP/fILOXDjZSwg==" crossorigin="anonymous" referrerpolicy="no-referrer" defer></script>
    <script src="./script/main.js" defer></script>
    <title>Powerland 14</title>
</head>
<body class="bg-site-bg bg-center bg-fixed bg-no-repeat bg-cover font-poppins">
    <div class="container mx-auto p-5">
        <div id="headerContainer" class="bg-white5 backdrop-filter backdrop-blur-effectBlur shadow-effect1Shadow rounded-radius15 overflow-y-hidden">
            <div id="header" class="p-5 grid grid-cols-12 items-center">
                <div class="col-start-1 col-end-12 lg:col-end-5">
                    <h1 class="text-lg font-bold text-main">POWERLAND</h1>
                </div>
                <?php include('./components/navDesktop.php'); ?>
                <div class="col-start-12 col-end-13 justify-self-end lg:hidden">
                    <img class="cursor-pointer" id="burgMenu" src="./assets/menuBurg.svg" alt="menu">
                </div>
            </div>
            <?php include('./components/navMobile.php'); ?>
        </div>
    </div>
</body>
</html>