<!--댓글을 db에서 삭제후, 테이블 GROUP_NUM 요소 재 배열하는 파일 -->

<?php
//로그인 유무 검사
  if(!isset($_SESSION['username'])){
    echo '<script>alert("로그인 후 이용 가능합니다\n로그인 페이지로 이동합니다")
          location.href = "../login/login.php"
    </script>';
    exit;
  }
?>
<?php
  //댓글 db정보 불러오기
  include "comment_db_info.php";
  //변수 선언
  $email = $_POST['email'];
  $board_num = $_POST['b_num'];
  $id = $_POST['no'];
  $query = mysqli_query($mysqli, "SELECT * FROM comment WHERE NO = $id");
  $result = mysqli_fetch_array($query);
  $my_perm = $_SESSION['permission'];
  $partition_page = $_POST['partition_page'];
  $count = 1;
  //댓글을 삭제할 수 있는 자격 -> 아이디의 정보가 댓글 아이디 정보와 동일한지, 운영자인지

  if(strcmp($email,$_SESSION['email']) && strcmp($my_perm, "imthebest") && strcmp($my_perm,'operator')){
    echo '<script>alert("권한이 없습니다.")
          location.href = "../main.php"
    </script>';
    exit;
  }
  //댓글 삭제
    if($result[DEPTH] == 0){
    //삭제하는 댓글에 달려있는 답글 또한 모조리 삭제
      $del = mysqli_query($mysqli, "DELETE FROM comment WHERE B_NO = $board_num AND GROUP_NUM = $result[GROUP_NUM]");
      //댓글 db의 group_num 요소 재 정렬
      $comment_array = mysqli_query($mysqli, "SELECT * FROM comment WHERE B_NO = '$board_num' AND DEPTH = 0");
      while($row = mysqli_fetch_row($comment_array)){
        $resetting = mysqli_query($mysqli, "UPDATE comment SET GROUP_NUM = $count WHERE NO = $row[0] AND B_NO = $board_num AND DEPTH = 0 ");
        $count++;
      }
      $reple_array = mysqli_query($mysqli, "SELECT * FROM comment WHERE B_NO = '$board_num' AND DEPTH != 0");
      while($row = mysqli_fetch_row($reple_array)){
        $parents_query = mysqli_query($mysqli, "SELECT * FROM comment WHERE NO = $row[8]");
        $parents = mysqli_fetch_row($parents_query);
        $resetting = mysqli_query($mysqli, "UPDATE comment SET GROUP_NUM = GROUP_NUM - 1 WHERE NO = $row[0] AND GROUP_NUM != $parents[4]");
      }
      echo '<script>alert("댓글 삭제 성공.")</script>';
      echo("<meta http-equiv='refresh' content='1; url=../board/freeboard_read.php?id=$board_num&no=$partition_page'>");
    }

    //답글 삭제
    else{
      $count = 0;

      //해당하는 답글만 삭제
      $del = mysqli_query($mysqli, "DELETE FROM comment WHERE B_NO = $board_num AND GROUP_NUM = $result[GROUP_NUM] AND DEPTH = $result[DEPTH]");
      $in_reple_query = mysqli_query($mysqli, "SELECT * FROM comment WHERE B_NO = $board_num AND GROUP_NUM = $result[GROUP_NUM]");
      while($row = mysqli_fetch_row($in_reple_query)){
        $resetting = mysqli_query($mysqli, "UPDATE comment SET DEPTH = $count WHERE NO = $row[0]");
        $count++;
      }
      echo '<script>alert("답글 삭제 성공.")</script>';
      echo("<meta http-equiv='refresh' content='1; url=../board/freeboard_read.php?id=$board_num&no=$partition_page'>");
    }


?>
