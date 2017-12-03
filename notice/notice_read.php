<!DOCTYPE html>
<html lang="en">
  <head>

    <?php include("../import/config_alt.php");?>
    <?php
      if(!isset($_SESSION['username'])){
        echo '<script>alert("로그인 후 이용 가능합니다\n로그인 페이지로 이동합니다")
              location.href = "../login/login.php"
        </script>';
      }
    ?>
    <?php
    $username=$_SESSION["username"];
    $email = $_SESSION["email"];
    $permission = $_SESSION["permission"];
    ?>
    <?php
      // DB 접속코드
      include "notice_db_info.php";

      //조회수 갱신
      mysqli_query($mysqli, "UPDATE notice set see=see+1 where pk=$_GET[id]");

      // DB에서 정보 가져오기
      $result = mysqli_query($mysqli, "SELECT * FROM notice where pk=$_GET[id]");
      $row = mysqli_fetch_array($result);
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
          <div class = "row">
            <div class="col-sm-1 text-left">
            </div>
            <div class="col-sm-10 text-left">
              <div class = "panel panel-default" style="margin-top:50px;">
                <div class="panel-heading">
                  <div class = "row">
                    <!--게시물 번호, 게시물 제목, 조회수 -->
                    <div class="col-sm-8 text-left">
                      <h4 style="color:rgb(143, 141, 141)">#<?php echo $row[pk]; ?></h4>

                    </div>
                    <!--게시물 날짜, 작성자 -->
                    <div class="col-sm-4 text-right">
                      <h5><?php echo $row[date]; ?></h5>

                    </div>
                  </div>

                  <div class = "row">
                    <div class="col-sm-8 text-left">
                      <h4 class="kor"><?php echo $row[title]; ?> <span class="badge"><?php echo $row[see];?></span></h4>
                    </div>
                    <div class="col-sm-4 text-right">
                      <h4 class = "kor" >작성자: <?php echo $row[writer]; ?></h4>
                    </div>
                  </div>

                </div>
                <div class="panel-body" stye="position:relative" >
                  <!-- 첨부파일 다운로드-->
                  <?php   $arr = array();
                    $number = $row[pk];
                    $ForFile = mysqli_query($mysqli,"SELECT*FROM FileName WHERE pk = $number");
                    $File_exist = mysqli_query($mysqli,"SELECT count(*) FROM FileName WHERE pk = $number");
                    $count = mysqli_fetch_assoc($File_exist);
                    if($count['count(*)']!=0){
                  ?>
                        <div class="wrapper" style="position:absolute; right:30px; z-index:5">
                            <header>
                                <button style="float:right" onclick="showfile('navigation-list');">
                                <span class="menuBtn" style="font-weight:bold">첨부파일 <span style="color:red; font-weight:bold">(<?php echo $count['count(*)']?>)</span></span>
                              </button>
                                <nav id="navigation-list" style="display: none">
                                  <div style="float:right; border:1px solid gray; width:80%; background-color:white">
                                    <ul>
                                    <?php
                                      while($Fname = mysqli_fetch_assoc($ForFile)){

                                          array_push($arr,$Fname['filename']);
                                          ?>
                                        <li><a style= "font-weight:bold" href="notice_download.php?filename=<?php echo $Fname['pk'].'^'.$Fname['filename']?>"><?php echo $Fname['filename'];?></a></li>
                                        <?php }?>
                                    <ul>
                                  </div>
                                </nav>
                            </header>
                        </div>
                      <?php }?>
          <br>

                  <div>
                    <?php echo $row[comment]; ?>
                  </div>
                  <div style="float:left">
                    <button type="button" class="btn btn-info" onclick="location.href='notice_board.php'">Back</button>
                  </div>
                  <div style="float:right" id=<?php echo $row[pk];?> class = "col-sm-6 text-right">
                    <?php if(strcmp($row[writer],'Admin')){
                       if(!strcmp($_SESSION['notice'],"on")){?>
                     <form action='notice_rewrite.php' method="POST">
                       <input type='hidden' name='writer' value='<?php echo $row[writer]?>'>
                       <input type='hidden' name='id' value='<?php echo $row[pk]?>'>
                       <input type='hidden' name='file' value='<?php echo $Fname['filename']?>'>
                       <button type="submit" class="btn btn-success">Modify</button>
                     </form>
                      <form action='notice_delete.php' method="POST">
                         <input type='hidden' name='writer' value='<?php echo $row[writer]?>'>
                         <input type='hidden' name='id' value='<?php echo $row[pk]?>'>
                         <?php for($i=0;$i<count($arr);$i++){?>
                         <input type='hidden' name='file[]' value='<?php echo $arr[$i];?>'>
                         <?php }?>
                         <button type="submit" class="btn btn-danger">Delete</button>
                      </form>
                  <?php }
                  }else{
                    if(!strcmp($_SESSION['permission'],'imthebest')){?>
                    <form action='notice_rewrite.php' method="POST">
                      <input type='hidden' name='file' value='<?php echo $Fname['filename']?>'>
                      <input type='hidden' name='id' value='<?php echo $row[pk]?>'>
                      <input type='hidden' name='writer' value='<?php echo $row[pk]?>'>
                      <button type="submit" class="btn btn-success">Modify</button>
                    </form>
                    <form action='notice_delete.php' method="POST">
                      <input type='hidden' name='writer' value='<?php echo $row[writer]?>'>
                      <input type='hidden' name='id' value='<?php echo $row[pk]?>'>
                      <?php for($i=0;$i<count($arr);$i++){?>
                      <input type='hidden' name='file[]' value='<?php echo $arr[$i];?>'>
                      <?php }?>
                      <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                   <?php
                     }
                  }?>
                  </div>
                </div>

              </div>
            </div>
            <div class="col-sm-1 text-left">
            </div>

          </div>

          <!-- 왼쪽부터 뒤로가기, 수정, 삭제입니다. -->
          <div class="col-sm-12 text-right">

           </div>


          </div>


        </div>
        <!-- /페이지 내용 -->

        <!-- 풋터 내용 -->
        <?php include("../import/footer.php");?>
        <!-- /풋터 내용 -->
      </div>
    </div>
    <script src="../js/custom.js?val=ec89742"></script>

    <script type="text/javascript">
    function showfile(id){
      obj=document.getElementById(id)

      if(obj.style.display == "none"){
        obj.style.display="inline";
      }
      else{
        obj.style.display="none";
      }
    }
    </script>
</script>
  </body>
</html>
