<?php

//페이지 접근권한 확인

$userdata = $_POST['email'];
$email=$_SESSION['email'];
if(strcmp($email,$userdata)&&strcmp($_SESSION['board'],'on')){
  echo json_encode("permission_error");
  exit;
}
// DB 접속 코드 삽입
include "freeboard_db_info.php";
$db = 'login';
$mysqls = new mysqli($host,$user,$pw,$db);
mysqli_query("set session character_set_connection=utf8;");
mysqli_query("set session character_set_results=utf8;");
mysqli_query("set session character_set_client=utf8;");
// 변수
$itstitle = htmlspecialchars($_POST["title"]);
$itscomment = $_POST["comment"];
$content = str_replace("<p><br></p>", "", $itscomment);
$itsnum = $_POST['thisnumber'];
$health_minus=5;

if(empty($itstitle)){
  echo json_encode("no_title");
  exit;
}
else if(empty($content)){
  echo json_encode("no_comment");
  exit;
}
//기존파일중 원하는 파일 삭제
for($i=0;$_POST['delist'][$i]!==NULL;$i++){
  $Fename = $_POST['delist'][$i];
  $health_minus=0;
  $Delpath = "../uploadfile/".$itsnum.'^'.$_POST['delist'];
  unlink($Delpath);
  mysqli_query($mysqli,"DELETE FROM FileName WHERE (filename = '$Fename' AND NUM=$itsnum)");
}



$i;
$size=0;
for($i=0;$_FILES['file']['name'][$i]!==NULL;$i++){
  if($_SESSION['health']<5){
    echo json_encode("health_error_file");
    exit;
  }
  //첨부파일 경로
  $target_dir = "../uploadfile/";
  //첨부파일 이름
  $target_file = $itsnum . "^" . $_FILES['file']['name'][$i];

  $filename = $_FILES['file']['name'][$i];
  $FileType = pathinfo($target_file,PATHINFO_EXTENSION);

  //파일 크기 제한
  if($_FILES['file']['size'][$i] == false){
    echo json_encode("filesize_error file-'$filename'");
    exit;
  }
  //허용되는 확장자
  else if($FileType != "jpg" && $FileType != "png" && $FileType != "jpeg" && $FileType != "gif"){
    echo json_encode("filetype_error type-'$FileType'");
    exit;
  }
  else if(mb_strlen($filename,'utf-8')>30){
    echo json_encode("length_error file-'$filename'");
    exit;
  }
  $size = $size + $_FILES['file']['size'][$i];
}
if($size>100000000){
  echo json_encode("totalsize_error");
  exit;
}
  //파일첨부 성공여부

  for($i=0;$_FILES['file']['name'][$i]!==NULL;$i++){
    $target_dir = "../uploadfile/";
    //첨부파일 이름
    $target_file = $itsnum . "^" . $_FILES['file']['name'][$i];
    if(move_uploaded_file($_FILES['file']['tmp_name'][$i],$target_dir. $target_file)){
      $Fname = $_FILES['file']['name'][$i];
      $writer = $_SESSION['username'];
      if(mysqli_query($mysqli,"INSERT INTO FileName (filename,NUM,WRITER) values ('$Fname',$itsnum,'$writer')")){
        mysqli_query($mysqls,"UPDATE login set health = health-$health_minus WHERE email='$email'");
        mysqli_query($mysqls,"UPDATE login s'et EXP = EXP+$health_minus WHERE email='$email'");
        $_SESSION['health'] = $_SESSION['health']-$health_minus;
        $_SESSION['EXP'] = $_SESSION['EXP']+$health_minus;
      }
      else{
        echo json_encode("DB_error");
        exit;
      }
    }
    else{
      $filename = $_FILES['file']['name'][$i];
      echo json_encode("upload_error file-'$filename'");
      exit;
    }
  }


// 데이터베이스에서 수정
$result = mysqli_query($mysqli, "UPDATE freeboard SET COMMENT = '$itscomment'  WHERE NUM='$itsnum'");
$result = mysqli_query($mysqli, "UPDATE freeboard SET TITLE = '$itstitle'  WHERE NUM='$itsnum'");
  if($result){
    // 안내메시지후 board.php로 이동
    echo json_encode("success");
  }else{
    echo json_encode("fail");
  }

 ?>
