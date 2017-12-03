<?php
//url 직접접근 막기위한 코드
if($_SESSION['denyurl']){
  unset($_SESSION['denyurl']);}
else{
  echo '<script>
        alert("정상적인 방법으로 접근해 주세요.")
        location.href = "../main.php"
  </script>';
}
//DB접속 코드
$host = 'localhost';
$user = 'root';
$pw = 'wkfyrnwhtlqka1';
$dbName = 'login';
$mysqli = new mysqli($host,$user,$pw,$dbName);
//해당 아이디 삭제
$target=$_SESSION['email'];
if(mysqli_query($mysqli,"DELETE from login WHERE email='$target'")){
  mysqli_query($mysqli,"UPDATE login_count SET count=count-1");
  session_destroy();
  echo '<script>
        alert("성공적으로 완료되었습니다.")
        location.href = "../main.php"
  </script>';
}
else{
  echo '<script>
        alert("실패하였습니다.")
        location.href = "../main.php"
  </script>';
}
?>
