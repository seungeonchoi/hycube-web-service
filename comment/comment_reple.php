<!--입력받은 답글의 데이터를 db에 저장하는 파일-->
<?php
//로그인 유무 검사
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
?>
<?php
  //DB 정보 불러오기
  include "comment_db_info.php";
  //변수선언
  $board_num = $_POST['b_num'];
  $id = $_POST['no'];
  $name = $_SESSION['username'];
  $comment = $_POST["comment"];
  $email = $_SESSION['email'];
  $partition_page = $_POST['partition_page'];
  $group_num = $_POST['group_num'];
  $insert = mysqli_query($mysqli, "insert into comment (B_NO, NAME, COMMENT, GROUP_NUM, DEPTH, DATE, email, TO_NO) values('$board_num', '$name', '$comment', $group_num, 1, now(), '$email', $id)");
  $repeat_query = mysqli_query($mysqli, "SELECT * FROM comment WHERE B_NO = $board_num AND GROUP_NUM = $group_num AND DEPTH != 0");
  $count = 1;
  while($row = mysqli_fetch_array($repeat_query)){
    $update = "UPDATE comment SET DEPTH = $count  WHERE NO = $row[NO]";
    $update_query = mysqli_query($mysqli, $update);
    $count++;
  }
  if($insert){
    echo '<script>alert("답글 등록 성공.")</script>';
    echo("<meta http-equiv='refresh' content='1; url=../board/freeboard_read.php?id=$board_num&no=$partition_page'>");
  }
  else{
    echo '<script>alert("답글 등록 실패.")</script>';
    echo("<meta http-equiv='refresh' content='1; url=../board/freeboard_read.php?id=$board_num&no=$partition_page'>");
  }
?>
