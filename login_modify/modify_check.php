<!DOCTYPE html>
<html lang="en">
  <head>

    <?php include("../import/config_alt.php");?>

    <?php
    $username=$_SESSION["username"];
    $email = $_SESSION["email"];
    $permission = $_SESSION["permission"];
    ?>

    <script type="text/javascript" src="../js/json2.js"></script>
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


          <!-- 회원정보 관리 (비밀번호, 닉네임 등) -->
        </br></br></br><h3>Modify Information</h3>
            <?php
              $username=$_SESSION["username"];
              $email = $_SESSION["email"];
              $permission = $_SESSION["permission"];
            ?>

              <!--form은 여기에 action-->
              <form class="form-horizontal" id="form_main" action="modify_check_sign.php" method="POST" autocomplete="off">
          	      <!--비밀번호 -->
                <div class="form-group">
                  <label class="control-label col-xs-12 col-sm-2" for="pwd">Password:</label>
                  <div class="col-xs-12 col-sm-10">
                    <input type="password" name="password" class="form-control" id="pwd" placeholder="Enter password">
                  </div>
                  <div class = "error" id = "pwerr">
                    <div class="alert alert-danger" id = "pwerr_info">

                    </div>
                  </div>
                </div>

                  <!--제출버튼 -->
                <div class="form-group">
                  <div class="col-sm-offset-2 col-xs-10">
                    <button type="Submit" vlaue = 'Submit' class="btn btn-success" ;;>Submit</button>
                    <button type="button" style="float:right;" class="btn btn-danger" onclick="window.history.back()";;>Back</button>

                  </div>
                </div>
              </form>

        </div>
        <!-- /페이지 내용 -->

        <!-- 풋터 내용 -->
      <?php include("../import/footer.php");?>
        <!-- /풋터 내용 -->
      </div>
    </div>
    <script src="../js/custom.js?val=ec89742"></script>
    <script src = "login_modify.js"></script>
  </body>
</html>
