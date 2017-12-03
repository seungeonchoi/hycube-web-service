<!DOCTYPE html>
<html lang="en">
<head>
    <!-- config.php import하는 함수(자바스크립트 아님) -->
    <?php include("../import/config.php"); ?>

  <link rel="stylesheet" href="../css/register.css">
  <script type="text/javascript" src="../js/json2.js"></script>





</head>
<body>

<!-- header.html import 위치 -->

<!--header.php로 수정-->
<?php include("../import/header.php");?>

<div class="container-fluid text-center">
  <div class="row content">
    <div class="col-sm-2 sidenav">
      <!-- left_side_menu.html import 위치 -->

      <?php include("../import/left_side_menu.html"); ?>
	</div>
    <div class="col-sm-8 text-left">
<h2>My page</h2>
  <?php
    $username=$_SESSION["username"];
    $email = $_SESSION["email"];
    $permission = $_SESSION["permission"];
  ?>

    <!--form은 여기에 action-->
    <a href="./profile.php">프로필 이미지 설정하기</a>
    <div class="fArea">
  <div style="float:left; width:49%;">
    <h3>내가 쓴 글</h3>


<ul class="my-latest-list">
</ul>		</div>
  <div class="fRight" style="float:right; width:49%;">
    <h3>내글에 대한 반응 </h3>


<ul class="my-latest-list">
</ul>		</div>
    </div>




  <!-- content : E -->




</td>
<td></td>


</tr></table>

<br>
</div>

      <!-- right_side_menu.html import 위치 -->
    <div class="col-sm-2 sidenav">

    <?php include("../import/right_side_menu.php");?>
  </div>
  </div>
  </div>
  <!-- footer.html import 위치 -->
  <?php include("../import/footer.html");?>
  <script>

  </script>

  <script src = "../js/login_modify.js">

  </script>
  </body>
  <!-- html import하는 함수-->

  </html>
