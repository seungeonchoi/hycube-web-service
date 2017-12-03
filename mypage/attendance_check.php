<!-- DB 로그인 -->
<?php

  $host = 'localhost';
  $user = 'root';
  $pw = 'wkfyrnwhtlqka1';
  $dbName = 'login';
  $mysqli = new mysqli($host,$user,$pw,$dbName);
?>
<?php
echo '<script>alert("출석체크완료!")
      location.href = "../main.php"</script>';
 ?>
