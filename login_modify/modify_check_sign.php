<?php
//회원정보 변경하기위해 비밀번호 검사
  $insert=$_POST['password'];
  if(strcmp($insert,$_SESSION['itsuserspwd'])){
    echo '<script>
          alert("잘못된 비밀번호 입니다 다시 입력해 주세요.")
          location.href = "../login_modify/modify_check.php"
    </script>';
  }
  else{
    //url 직접접근 막기위한 변수
    $_SESSION['denyurl']='denyrul';

    echo '<script>
          alert("회원변경페이지로 이동합니다.")
          location.href = "modify.php"
    </script>';
  }
 ?>
