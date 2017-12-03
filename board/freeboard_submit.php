
<?php
//로그인 에러
  if(!isset($_SESSION['username'])){
    echo json_encode("login_error");
    exit;
  }
//체력 부족 에러
  if($_SESSION['health']<15){
    echo json_encode("health_error_nofile");
    exit;
  }

  // DB 접속 코드 삽입
  include "freeboard_db_info.php";
  $db ='login';
  $mysqls = new mysqli($host,$user,$pw,$db);
  //문자셋 변환
  mysqli_query("set session character_set_connection=utf8;");
  mysqli_query("set session character_set_results=utf8;");
  mysqli_query("set session character_set_client=utf8;");

  // 변수
  $title = htmlspecialchars($_POST["title"]);
  $comment = $_POST["comment"];

  $content = str_replace("<p><br></p>","",$comment);

  $username = $_SESSION['username'];
  $email = $_SESSION['email'];
  $health_minus = 15;
//제목이 비었는지 확인
  if(empty($title)){
    echo json_encode("no_title");
    exit;
  }
  //내용이 비었는지 확인
  if(empty($content)){
    echo json_encode("no_comment");
    exit;
  }






    //첨부파일 업로드
    $i;
    $size=0;
    for($i=0;$_FILES['file']['name'][$i]!==NULL;$i++){
      //체력 부족 에러-파일 업로드시
      if($_SESSION['health']<20){
        echo json_encode("health_error_file");
        exit;
      }
        //첨부파일 경로
        $target_dir = "../uploadfile/";
        //첨부파일 이름
        $target_file = $_FILES['file']['name'][$i];


        //파일 타입
        $FileType = pathinfo($target_file,PATHINFO_EXTENSION);
        //존재하는 파일인지 확인
        if(file_exists($target_file)){
          echo json_encode("exist_error file-'$target_file'");
          exit;
        }

        //허용되는 확장자
        else if($FileType != "jpg" && $FileType != "png" && $FileType != "jpeg" && $FileType != "gif"){
          echo json_encode("filetype_error type-'$FileType'");
          exit;
        }
        //파일 사이즈가 php.ini에서 지정한 크기(현재 2M)를 넘어가면 파일크기 에러
        else if($_FILES['file']['size'][$i] == false){
          echo json_encode("filesize_error file-'$target_file'");
          exit;
        }
        //파일이름 길이 에러
        else if(mb_strlen($target_file,'utf-8')>30){
          echo json_encode("length_error file-'$target_file'");
          exit;
        }
          $size = $size+$_FILES['file']['size'][$i];

    }
    //총 파일 크기 제한
    if($size>10000000){
      echo json_encode("totalsize_error");
      exit;
    }
    //DB에 내용 입력
    $result = mysqli_query($mysqli, "insert into freeboard (TITLE, COMMENT, DATE, SEE, WRITER, EMAIL) values('$title', '$comment', now(), 0, '$username', '$email')");
    //첨부파일
    $fornum = mysqli_query($mysqli,"SELECT*FROM freeboard ORDER BY NUM DESC");
    $num = mysqli_fetch_assoc($fornum);
    if($result){
        for($i=0;$_FILES['file']['name'][$i]!==NULL;$i++){
          //첨부파일 경로
          $target_dir = "../uploadfile/";
          //첨부파일 이름
          $target_file = $num['NUM'] . "^". $_FILES['file']['name'][$i];
            if(move_uploaded_file($_FILES['file']['tmp_name'][$i],$target_dir . $target_file)){
              $Fname = $_FILES['file']['name'][$i];
              $number = $num['NUM'];
              $writer = $_SESSION['username'];
              if(mysqli_query($mysqli,"INSERT INTO FileName (filename,NUM,WRITER) values('$Fname',$number,'$writer')")){
                $health_minus=20;
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



      // 게시글 카운트 새로고침
      mysqli_query($mysqli, "UPDATE freeboard_count SET count = count+1");
      mysqli_query($mysqls,"UPDATE login SET health = health-$health_minus WHERE email='$email'");
      mysqli_query($mysqls,"UPDATE login SET EXP = EXP+$health_minus WHERE email='$email'");
      $_SESSION['health'] = $_SESSION['health'] - $health_minus;
      $_SESSION['EXP'] = $_SESSION['EXP']+$health_minus;
      echo json_encode('success');

    }else{
      echo json_encode('fail');

    }

?>
