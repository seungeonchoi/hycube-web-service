<?php

include("../import/config_alt.php");
include("../import/modal.php");

//수정 권한은 관리자 혹은
  if(!isset($_SESSION['username'])){?>
    <script>
      $(function(){
        document.getElementById("signerrormessage").innerHTML = "로그인 후 이용 가능합니다.\n로그인 페이지로 이동합니다.";
        $("#signuperror").modal();
        $("#ok").on('click', function(e){
          location.href = "../login/login.php";
        })
        $("#close").on('click', function(e){
          location.href = "../login/login.php";
        })
      });
    </script><?php
  }
  if($_SESSION['health']<10){?>
    <script>
      $(function(){
        document.getElementById("signerrormessage").innerHTML = "체력이 부족합니다.";
        $("#signuperror").modal();
        $("#ok").on('click', function(e){
          location.href = history.back();
        })
        $("#close").on('click', function(e){
          location.href = history.back();
        })
      });
    </script><?php
    exit;
  }
  if(strcmp($email,$_SESSION['email']) && strcmp($my_perm, "imthebest") && strcmp($my_perm,'operator')){?>
    <script>
      $(function(){
        document.getElementById("signerrormessage").innerHTML = "권한이 없습니다.";
        $("#signuperror").modal();
        $("#ok").on('click', function(e){
          location.href = "../main.php"
        })
        $("#close").on('click', function(e){
          location.href = "../main.php"
        })
      });
    </script><?php
    exit;
?>
<?php
  //db 정보 불러오기
  include "comment_db_info.php";
  //변수선언
  $no = $_POST['no'];
  $comment = $_POST['comment'];
  $board_num = $_POST['b_num'];
  $partition_page = $_POST['partition_page'];
  //db 정보 수정하기(내용 수정 및 db등록 날짜 최신화)
  $modi_query = mysqli_query($mysqli, "UPDATE comment SET COMMENT = '$comment' WHERE NO = $no");
  //db에 정상등록이 되어 있는지 확인
  $select_query = mysqli_query($mysqli, "SELECT * FROM comment WHERE NO = $no");
  $array = mysqli_fetch_array($select_query);
  if($array[COMMENT] == $comment){
    echo '<script>alert("수정 성공.")</script>';
    echo("<meta http-equiv='refresh' content='1; url=../board/freeboard_read.php?id=$board_num&no=$partition_page'>");
  }
  else{
    echo '<script>alert("수정 실패.")</script>';
    echo("<meta http-equiv='refresh' content='1; url=../board/freeboard_read.php?id=$board_num&no=$partition_page'>");
  }
?>
