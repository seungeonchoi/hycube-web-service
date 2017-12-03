<?php
//DB접속
$host = 'localhost';
$user = 'root';
$pw = 'wkfyrnwhtlqka1';
$dbName = 'login';
$mysqli = new mysqli($host,$user,$pw,$dbName);
//회원 추방
  if(mysqli_query($mysqli,"DELETE FROM login WHERE email='$_GET[id]'")){
   if(mysqli_query($mysqli,"UPDATE login_count SET count=count-1")){
      echo '<script>
              alert("회원이 추방되었습니다.")
              history.back();
            </script>';
    }
    else{
      echo '<script>
              alert("실패하였습니다.")
              history.back();
            </script>';
    }
}else{
  echo '<script>
          alert("추방에 실패하였습니다.")
          history.back();
        </script>';
}
 ?>
