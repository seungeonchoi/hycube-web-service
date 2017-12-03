<?php
  /*접근권한 코드*/
  if(!isset($_POST['id'])){
    echo '<script>
          location.href = "../main.php"
          alert("잘못된 접근입니다.\n메인페이지로 이동합니다.")
    </script>';
    exit;
  }
  if(strcmp($_SESSION['notice'],'on')){
    echo '<script>
          location.href = "../main.php"
          alert("잘못된 접근입니다.\n메인페이지로 이동합니다.")
    </script>';
    exit;
  }
  if(!strcmp($_POST['writer'],'Admin')){
    if(strcmp($_SESSION['permission'],'imthebest')){
      echo '<script>
            alert("잘못된 접근입니다.\n메인페이지로 이동합니다.")
            location.href = "../main.php"
      </script>';
      exit;
    }
  }

  //게시글 번호
  $DeleteNum=$_POST['id'];
  //DB접속코드
  include "notice_db_info.php";


  //업로드된 파일 있으면 서버와 DB에서 삭제
    for($i=0;$i<count($_POST['file']);$i++){
      $exist = $_POST['file'][$i];
      mysqli_query($mysqli,"DELETE FROM FileName WHERE (filename='$exist' AND pk = $DeleteNum)");
      unlink("../noticefile/".$DeleteNum.'^'.$exist);
    }



  //DB에서 삭제코드
  if(mysqli_query($mysqli,"DELETE FROM notice WHERE pk=$DeleteNum")){
    //공지사항 게시글 총개수 카운트
    mysqli_query($mysqli,"UPDATE notice_count SET count=count-1");
    echo '<script>alert("삭제하였습니다.")
          location.href="../main.php"
          </script>';
  }
  else{
    echo '<script>alert("삭제에 실패하였습니다.")
          location.href="../main.php"
          </script>';
  }
 ?>
