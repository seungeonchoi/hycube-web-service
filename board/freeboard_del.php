<?php
  include("../import/config_alt.php");
  include("../import/modal.php");?>


  <script src = "js/bootstrap.min.js" </script>
  <script src = "js/jquery-3.1.1.min.js" </script>

  <?php

  //페이지 접근권한 확인
  if(!isset($_POST['id'])){?>
    <script>
      $(function(){
        document.getElementById("signerrormessage").innerHTML = "잘못된 접근입니다.\n메인 페이지로 이동합니다.";
        $("#signuperror").modal();
        $("#ok").on('click', function(e){
          location.href = "../main.php";
        })
        $("#close").on('click', function(e){
          location.href = "../main.php";
        })
      });
    </script><?php
    exit;
  }
  if(strcmp($_SESSION['username'],$_POST['writer'])&&strcmp($_SESSION['board'],'on')){?>
    <script>
      $(function(){
        document.getElementById("signerrormessage").innerHTML = "잘못된 접근입니다.\n메인 페이지로 이동합니다.";
        $("#signuperror").modal();
        $("#ok").on('click', function(e){
          location.href = "../main.php";
        })
        $("#close").on('click', function(e){
          location.href = "../main.php";
        })
      });
    </script><?php
    exit;
  }
  if(!strcmp($_POST['writer'],'Admin')){
    if(strcmp($_SESSION['permission'],'imthebest')){?>
      <script>
        $(function(){
          document.getElementById("signerrormessage").innerHTML = "잘못된 접근입니다.\n메인 페이지로 이동합니다.";
          $("#signuperror").modal();
          $("#ok").on('click', function(e){
            location.href = "../main.php";
          })
          $("#close").on('click', function(e){
            location.href = "../main.php";
          })
        });
      </script><?php
      exit;
    }
  }
  // DB 접속
  include "freeboard_db_info.php";

  //게시글 삭제
  $result =mysqli_query($mysqli, "DELETE FROM freeboard WHERE NUM=$_POST[id]");
//업로드된 파일 있으면 서버와 DB에서 삭제
  for($i=0;$i<count($_POST['file']);$i++){
    $exist = $_POST['file'][$i];
    mysqli_query($mysqli,"DELETE FROM FileName WHERE (filename='$exist' AND NUM=$_POST[id])");
    unlink("../uploadfile/".$_POST['id'].'^'.$exist);
  }
  if($result){
    //게시글 카운트 새로고침
    mysqli_query($mysqli, "UPDATE freeboard_count SET count = count-1");?>
    <script>document.getElementById("signerrormessage").innerHTML = "삭제되었습니다.";
    $('#signuperror').modal();
    </script><?php
  }else{?>
  <script>document.getElementById("signerrormessage").innerHTML = "오류가 발생했습니다.";
  $('#signuperror').modal();
  </script><?php
  }
  echo "<meta http-equiv='refresh' content='1; url=board.php'>";
?>
