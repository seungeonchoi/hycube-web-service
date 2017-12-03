<!--댓글 등록을 눌렀을 때 그 정보를 db에 넣는 작업을 하는 페이지 입니다.-->
<?php
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
?>
<?php
  //DB 접속 코드 삽입
  include "comment_db_info.php";
  $db = 'login';
  $mysqls = new mysqli($host,$user,$pw,$db);

  //변수선언
  $board_num = $_POST['b_num'];
  $name = $_SESSION['username'];
  $comment = $_POST["comment"];
  $email = $_SESSION['email'];
  $partition_page = $_POST['partition_page'];

  //db에 전달
  $registering = mysqli_query($mysqli, "insert into comment (B_NO, NAME, COMMENT, GROUP_NUM, DEPTH, DATE, email, TO_NO) values('$board_num', '$name', '$comment', 0, 0, now(), '$email', 0)");

  //GROUP_NUM 요소 추가 -> 답글을 달때 어느 댓글의 답글인지 구분하기위해 지정한 변수 및 db요소
  $query = mysqli_query($mysqli, "SELECT * FROM comment WHERE B_NO = $board_num and DEPTH = 0");
  $count = 1;
  while($result = mysqli_fetch_row($query)){
    $update = mysqli_query($mysqli, "UPDATE comment SET GROUP_NUM = $count WHERE NO = '$result[0]' AND B_NO = '$board_num' AND DEPTH = 0 ");
    $count++;
  }
  //등록이 되었는지 확인작업 및 댓글목록 업데이트
  if($registering){
    mysqli_query($mysqls,"UPDATE login SET health=health-10 WHERE email='$email'");
    mysqli_query($mysqls,"UPDATE login SET EXP=EXP+10 WHERE email = '$email'");
    $_SESSION['health'] = $_SESSION['health']-10;
    $_SESSION['EXP'] = $_SESSION['EXP']+10;
    echo '<script>alert("댓글 등록 성공.")</script>';
    echo("<meta http-equiv='refresh' content='1; url=../board/freeboard_read.php?id=$board_num&no=$partition_page'>");
  }
  else{
    echo '<script>alert("댓글 등록 실패.")</script>';
    echo("<meta http-equiv='refresh' content='1; url=../board/freeboard_read.php?id=$board_num&no=$partition_page'>");
  }


?>
