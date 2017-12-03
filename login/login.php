<!DOCTYPE html>
<html lang="en">
  <head>

    <?php include("../import/config_alt.php");?>
    <?php include("../import/modal.php");?>
		<?php
			if($_SESSION['email']){?>
        <script>
          $(function(){
            console.log("login.php 만료");
            document.getElementById("signerrormessage").innerHTML = "만료된 페이지 입니다.";
            $("#signuperror").modal();
            $("#ok").on('click', function(e){
              location.href = history.back();
            })
            $("#close").on('click', function(e){
              location.href = history.back();
            })
          });
        </script><?php
			}
		 ?>
    <?php
    $username=$_SESSION["username"];
    $email = $_SESSION["email"];
    $permission = $_SESSION["permission"];
    ?>

  </head>

  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <!-- 좌측 사이드메뉴 -->
          <?php include("../import/left_side_menu.php"); ?>
        <!-- /좌측 사이드메뉴 -->
        <!-- 상단 프로필 메뉴 -->
        <?php include("../import/top_side_menu.php");?>
        <!-- /상단 프로필 메뉴 -->

        <!-- 페이지 내용 -->
        <div class="right_col" role="main">
					<div class>
					<h2 style="margin-left:50px">Login</h2>
					<!-- 여기 밑에다가 데이터 넘겨주시면 됩니다.-->
					<form class="form-horizontal" action = "signin.php" method="POST">
					<!-- 이메일-->
					<div class="form-group">

					  <label class="control-label col-sm-2 col-xs-12" for="email">Email:</label>
					  <div class="col-xs-10">
					    <input type="text" name = "email" class="form-control" id="email" placeholder="email">
					  </div>
					</div>
					<!-- 비밀번호-->
					<div class="form-group">

					  <label class="control-label col-sm-2 col-xs-12" for="pwd">Password:</label>
					  <div class="col-xs-10">
					    <input type="password" name = "password" class="form-control" id="pwd" placeholder="Password">
					  </div>
					</div>
					<!-- 자동로그인-->
					<div class="form-group">
					  <div class="col-sm-offset-2 col-xs-10">
					    <div class="checkbox">
					      <label><input type="checkbox" name="remember"> Remember me</label>
					    </div>
					  </div>
					</div>
					<!-- Summit = 로그인, Register = 회원가입 -->
					<div class="form-group">
					  <div class="col-sm-offset-2 col-xs-10">
              <div style="float:left">
                <button type=submit class="btn btn-success">Submit</button>
              </div>
					    <div style="float:right">
                <button type="button" class="btn btn-danger" onclick="location.href='../register/register.php'";;>Register</button>
              </div>

					  </div>
					</div>
					</form>
					</div>
        </div>
        <!-- /페이지 내용 -->

        <!-- 풋터 내용 -->
        <?php include("../import/footer.php");?>
        <!-- /풋터 내용 -->
      </div>
    </div>
    <script src="../js/custom.js?val=ec89742"></script>
  </body>
</html>
