<?php
//url 직접접근 막는 코
if($_SESSION['denyurl']){
  unset($_SESSION['denyurl']);
}
else{
  echo '<script>
        alert("정상적인 방법으로 접근해 주세요.")
        location.href = "../main.php"
  </script>';
  exit;
}
//새로운 아이디와 비밀번호(modify_form.php에서 받아온 변수)
$beforename = $_SESSION['username'];
$newname = $_POST['userid'];
$newpassword = $_POST['password'];
if(strcmp($_SESSION['permission'],'imthebest')){
  if(!strcmp($newname,'Admin')){
    echo '<script>
          alert("관리자 이름은 사용할 수 없습니다.")
          location.href = history.back();
          </script>';
    exit;
  }
}
//DB접속코드
$host = 'localhost';
$user = 'root';
$pw = 'wkfyrnwhtlqka1';
$dbName = 'login';
$mysqli = new mysqli($host,$user,$pw,$dbName);
if(mysqli_query($mysqli,"UPDATE login SET username='$newname',password='$newpassword' WHERE username='$beforename'")){
  $_SESSION['username']=$newname;
  $_SESSION['itsuserspwd']=$newpassword;
  echo '<script>
        alert("변경이 성공적으로 완료되었습니다.")
        location.href = "../main.php"
  </script>';
}
else{
  echo '<script>
        alert("변경이 실패하였습니다.")
        location.href = "../main.php"
  </script>';
}
 ?>
