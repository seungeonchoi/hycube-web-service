<!DOCTYPE html>
<html lang="en">
  <head>

    <?php
    $username=$_SESSION["username"];
    $email = $_SESSION["email"];
    $permission = $_SESSION["permission"];
    $profile = $_SESSION["profile"];
    ?>
    <?php include("import/config_alt.php"); ?>

    <meta property="og:type" content="article">
  	<meta property="og:title" content="하이큐브 웹프로젝트">
  	<meta property="og:url" content="http://13.124.2.154/main.php">
  	<meta property="og:description" content="하이큐브 웹프로젝트 입니다.">


  </head>

  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <!-- 좌측 사이드메뉴 -->
        <?php include("import/left_side_menu.php");?>
        <!-- /좌측 사이드메뉴 -->
        <!-- 상단 프로필 메뉴 -->
        <?php include("import/top_side_menu.php");?>
        <!-- /상단 프로필 메뉴 -->

        <!-- 페이지 내용 -->
        <div class="right_col" role="main">
          <div class = "row">
            <div class = "col-xs-6">
              <?php include("notice/notice.php"); ?>
            </div>
            <div class = "col-xs-6">
              <div class = "chat-wrapper">
                <?php if($_SESSION['username']){?>
                  <embed height="400" width="90%" src="http://www.gagalive.kr/livechat1.swf?chatroom=아리&user=<?php echo $_SESSION['username']; ?>"></embed>
                <?php }else{?>
                  <div class="chat_login">
                    <div class="chat_login_pic">
                      <h3>로그인해야 채팅창을 볼 수 있습니다.</h3>
                    </div>

                  </div>


              <?php }?>
              </div>
            </div>
          </div>

        </div>
        <!-- /페이지 내용 -->
        <?php include("import/modal.php");?>
        <!-- 풋터 내용 -->
        <?php include("import/footer.php");?>
        <!-- /풋터 내용 -->

      </div>
    </div>

    <script>
    $(function () {
      $("#logout").on('click', function(e){
        e.preventDefault();
        e.stopPropagation();
        $("#logoutModal").modal();
      })
      $("#oklogout").on('click', function(e){
        location.href="login/logout.php";
      })
    });
    </script>
    <script src="../js/custom.js?val=ec89742"></script>



  </body>
</html>
