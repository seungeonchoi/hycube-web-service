<?php
  //로그인 여부 확인
  if(!isset($_SESSION['username'])){
    echo '<script>alert("로그인 후 이용 가능합니다\n로그인 페이지로 이동합니다")
            location.href = "../login/login.php"
          </script>';
    exit;
  }
  // DB 접속 코드 삽입
  $host = 'localhost';
  $user = 'root';
  $pw = 'wkfyrnwhtlqka1';
  $dbName = 'login';
  $mysqli = new mysqli($host,$user,$pw,$dbName);

  $profile = $_SESSION['profile'];
  $email = $_SESSION["email"];
  $target_dir = "../profile/";

  unlink($target_dir . $profile);
  mysqli_query($mysqli,"UPDATE login SET profile=NULL WHERE email='$email' ");

  echo '<script>alert("프로필 초기화 완료.")
        location.href="./modify_check.php"</script>';
?>
