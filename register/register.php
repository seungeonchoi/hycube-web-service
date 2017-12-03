<!DOCTYPE html>
<html lang="en">
  <head>
    <?php include("../import/config_alt.php");?>
    <?php
    $username=$_SESSION["username"];
    $email = $_SESSION["email"];
    $permission = $_SESSION["permission"];
    ?>
    <?php include("../import/modal.php");?>
  </head>

  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <!-- 좌측 사이드메뉴 -->
        <?php include("../import/left_side_menu.php");?>
        <!-- /좌측 사이드메뉴 -->
        <!-- 상단 프로필 메뉴 -->
        <?php include("../import/top_side_menu.php");?>
        <!-- /상단 프로필 메뉴 -->

        <!-- 페이지 내용 -->
        <div class="right_col" role="main">
          <div>
            <h2 style="margin-left:50px">Register</h2>
            <!--form은 여기에 -->
            <form class="form-horizontal" id="form_main" action="" method="POST" autocomplete="off">
                <div class="form-group">
                    <label class="control-label col-sm-3" for="email">Username:</label>
                    <div class="col-sm-9">
                        <!--사용자 id -->
                        <input type="text" name="userid" class="form-control" id="username" placeholder="Display name">
                    </div>
                    <div class="error" id="iderr">
                        <div class="alert alert-danger" id="iderr_info">

                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <!--이메일  -->
                    <label class="control-label col-sm-3" for="email">Email:</label>
                    <div class="col-sm-9">
                        <!--이메일 중복 체크 : email_check.php -->
                        <input type="email" name="email" class="form-control" id="email" placeholder="id@examples.com">
                    </div>
                    <div class="error" id="emailerr">
                        <div class="alert alert-danger" id="emailerr_info">

                        </div>
                    </div>
                </div>
                <!--비밀번호 -->
                <div class="form-group">
                    <label class="control-label col-sm-3" for="pwd">Password:</label>
                    <div class="col-sm-9">
                        <input type="password" name="password" class="form-control" id="pwd" placeholder="Enter password">
                    </div>
                    <div class="error" id="pwerr">
                        <div class="alert alert-danger" id="pwerr_info">

                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-3" for="pwd">Confirm Password:</label>
                    <div class="col-sm-9">
                        <input type="password" name="password" class="form-control" id="pwd_check" placeholder="Enter password">
                    </div>
                    <div class="error" id="pwd_checkerr">
                        <div class="alert alert-danger" id="pwd_checkerr_info">

                        </div>
                    </div>
                </div>
                <!--제출버튼 -->
                <div class="form-group">
                    <div class="col-sm-offset-3 col-sm-9">
                        <button type="button" class="btn btn-success" onclick="Signup()" ;;>Submit</button>
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
    <script src = "signup.js?val=ec1938272"></script>
  </body>
</html>
