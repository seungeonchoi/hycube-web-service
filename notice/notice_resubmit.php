<?php
if(strcmp($_SESSION['notice'],'on')){
  echo json_encode("notice_on_error");
  exit;
}
if(!strcmp($_POST['writer'],'Admin')){
  if(strcmp($_SESSION['permission'],'imthebest')){
    echo json_encode("permission_error");
    exit;
  }
}// DB 접속 코드 삽입
include "notice_db_info.php";
//변수
$itsnum = $_POST['thisnumber'];
$itstitle = $_POST['title'];
$itscomment = $_POST['comment'];
$content = str_replace("<p><br></p>", "", $itscomment);


if(empty($itstitle)){
  echo json_encode("no_title");
  exit;
}
else if(empty($content)){
  echo json_encode("no_comment");
  exit;
}


for($i=0;$_POST['delist'][$i]!==NULL;$i++){
    $Fename = $_POST['delist'][$i];
    $Delpath = "../noticefile/".$itsnum.'^'.$_POST['delist'][$i];
    unlink($Delpath);
    mysqli_query($mysqli,"DELETE FROM FileName WHERE (filename = '$Fename' AND pk=$itsnum)");

}


$i;
$size = 0;
for($i=0;$_FILES['file']['name'][$i]!==NULL;$i++){
  $target_dir = "../noticefile/";
  $target_file = $itsnum . "^" . $_FILES['file']['name'][$i];

  $filename = $_FILES['file']['name'][$i];
  $FileType = pathinfo($target_file,PATHINFO_EXTENSION);

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
if($size>10000000){
  echo json_encode("totalsize_error");
  exit;
}

for($i=0;$_FILES['file']['name'][$i]!==NULL;$i++){
  $target_dir = "../noticefile/";
  //첨부파일 이름
  $target_file = $itsnum . "^" . $_FILES['file']['name'][$i];
  if(move_uploaded_file($_FILES['file']['tmp_name'][$i],$target_dir. $target_file)){
    $Fname = $_FILES['file']['name'][$i];
    $writer = $_SESSION['username'];
    if(mysqli_query($mysqli,"INSERT INTO FileName (filename,pk,WRITER) values ('$Fname',$itsnum,'$writer')")){
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
$result = mysqli_query($mysqli, "UPDATE notice SET COMMENT = '$itscomment'  WHERE pk='$itsnum'");
$result = mysqli_query($mysqli, "UPDATE notice SET TITLE = '$itstitle'  WHERE pk='$itsnum'");
  if($result){
    // 안내메시지
    echo json_encode("success");
  }else{
    echo json_encode("fail");
  }

 ?>
