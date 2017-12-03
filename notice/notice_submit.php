
<?php
  if(strcmp($_SESSION['notice'],'on')){
    echo json_encode("permission_error");
    exit;
  }
  if($_SESSION['health']<40){
    echo json_encode("health_error");
    exit;
  }
  // DB 접속 코드 삽입
  include "notice_db_info.php";
  $db = 'login';
  $mysqls = new mysqli($host,$user,$pw,$db);
  mysqli_query("set session character_set_connection=utf8;");
  mysqli_query("set session character_set_results=utf8;");
  mysqli_query("set session character_set_client=utf8;");

  // 변수
  $title = htmlspecialchars($_POST["title"]);
  $comment = $_POST["comment"];
  $content = str_replace("<p><br></p>","",$comment);
  $writer = $_SESSION['username'];
  $email = $_SESSION['email'];

  if(empty($content)){
    echo json_encode("no_comment");
    exit;
  }
  else if(empty($title)){
    echo json_encode("no_title");
    exit;
  }
  // 데이터베이스에 전달
  $i;
  $size=0;
  for($i=0;$_FILES['file']['name'][$i]!==NULL;$i++){
    $target_dir = "../noticefile/";
    //첨부파일 이름
    $target_file = $_FILES['file']['name'][$i];


    //파일 타입
    $FileType = pathinfo($target_file,PATHINFO_EXTENSION);
    //존재하는 파일인지 검사
    if(file_exists($target_file)){
      echo json_encode("exist_error file-'$target_file'");
      exit;
    }
    //파일 타입 지정
    else if($FileType != "jpg" && $FileType != "png" && $FileType != "jpeg" && $FileType != "gif"){
      echo json_encode("filetype_error type-'$FileType'");
    }
    //파일 사이즈가 php.ini에서 지정한 크기(현재 2M)를 넘어가면 파일크기 에러
    else if($_FILES['file']['size'][$i] == false){
      echo json_encode("filesize_error file-'$target_file'");
      exit;
    }
    else if(mb_strlen($target_file,'utf-8')>30){
      echo json_encode("length_error file-'$target_file'");
      exit;
    }
    $size = $size+$_FILES['file']['size'][$i];
  }
  if($size > 10000000){
    echo json_encode("totalsize_error");
    $uploadOk=0;
  }
    if(mysqli_query($mysqli, "INSERT INTO notice (title, comment, writer, date, see, email) VALUES('$title', '$comment', '$writer', now(), 0,'$email')")){

      $fornum = mysqli_query($mysqli,"SELECT*FROM notice ORDER BY pk DESC");
      $num = mysqli_fetch_assoc($fornum);

      for($i=0;$_FILES['file']['name'][$i]!==NULL;$i++){
        $target_dir = "../noticefile/";
        //첨부파일 이름
        $target_file = $num['pk'] . "^". $_FILES['file']['name'][$i];
        if(move_uploaded_file($_FILES['file']['tmp_name'][$i],$target_dir . $target_file)){
          $Fname = $_FILES['file']['name'][$i];
          $writer = $_SESSION['username'];
          $number = $num['pk'];
          if(mysqli_query($mysqli,"INSERT INTO FileName (filename,pk,WRITER) values('$Fname',$number,'$writer')")){
          }
          else{
            echo json_encode("DB_error");
            exit;
          }
        }
        else{
          $filename = $_FILES['file']['name'][$i];
          echo json_encode("upload_error file-'.$filename.'");
          exit;
        }

      }


      //  공지사항 총개수 카운트
      mysqli_query($mysqli, "UPDATE notice_count SET count = count+1");
      mysqli_query($mysqls,"UPDATE login SET health=health-40 WHERE email='$email'");
      mysqli_query($mysqls,"UPDATE login SET EXP = EXP+40 WHERE email='$email'");
      $_SESSION['health'] = $_SESSION['health']-40;
      $_SESSION['EXP'] = $_SESSION['EXP'] + 40;
      echo json_encode("success");
    }else{
      echo json_encode("fail");
    }

?>
