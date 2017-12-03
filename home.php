<?php
session_start();
$username = $_SESSION["username"];
$enabled = $_SESSION["enabled"];
?>
<!DOCTYPE html>
<html lang="ko">
<head>
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="/css/default.css">
    <script src=/script/common.js>
    </script>
</head>
<body>
<div class="header">
    <div class="logo">
        <h1>HYCUBE</h1>
        <div class="explain web">Information Security Institute of Hanyang University</div>
        <div class="mobile mlogin">
            <img class="img_user_mobile" src="/img/user.png">
        </div>
    </div>

</div>
<?php
    include $_SERVER['DOCUMENT_ROOT'].'/choi/topnav.php'
?>
<?php
    include $_SERVER['DOCUMENT_ROOT'].'/choi/sidenav.php'
?>

<div id="container" class="container">
    <?php
    if ($username != "" && $enabled == "1") {
        ?>
        <div class="hycube_main">
            <h1>Dashboard</h1>
            <p>Working in progress</p>
        </div>

        <?php
    } else {
        ?>
        <div class="photo_section">
            <div class="slideshow-container">
                <div class="mySlides fade">
                    <img src="/img/bada.jpg" style="width:100%">
                </div>
                <div class="mySlides fade">
                    <img src="/img/sky.jpg" style="width:100%">
                </div>
                <div class="mySlides fade">
                    <img src="/img/sky-clouds-blue-horizon.jpg" style="width:100%">
                </div>
                <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
                <a class="next" onclick="plusSlides(1)">&#10095;</a>
                <div class="slide-dot" style="text-align:center">
                    <span class="dot" onclick="currentSlide(1)"></span>
                    <span class="dot" onclick="currentSlide(2)"></span>
                    <span class="dot" onclick="currentSlide(3)"></span>
                </div>
            </div>
        </div>
        <?php
    }
    ?>

</div>
<!-- List of Modals -->
<?php include $_SERVER["DOCUMENT_ROOT"].'/choi/modal.php';?>
<div id="footer">
    <h1>HYCUBE</h1>
    <p>경기도 안산시 상록구 한양대학로 55 한양대학교 ERICA캠퍼스 4공학관 1층 SMASH 학습전용공간</p>
</div>

<script src=/script/main.js>

</script>
<?php
if ($username != "" && $enabled == 0) {
    ?>
    <script>
        modal('activation');
    </script>
    <?php
}
?>
</body>
</html>
