<!-- 프로필 이미지 업로드 하는 코드입니다 -->
<?php
  // 로그인 여부 확인
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
  mysqli_query("set session character_set_connection=utf8;");
  mysqli_query("set session character_set_results=utf8;");
  mysqli_query("set session character_set_client=utf8;");
  $username = $_SESSION['username'];
  $email = $_SESSION['email'];
  $profile =$_SESSION['profile'];

    //첨부파일 이름
    $target_file = $_SESSION['username']. "_" .$_FILES['pro']['name'];
    //첨부파일 경로
    $target_dir = "../profile/";
    // 프로필 이미지가 있는지 확인 후 있으면 삭제
    if($profile!=null){
      unlink($target_dir . $profile);
    }
    //DB에 파일명 저장 쿼리
    $result = mysqli_query($mysqli,"UPDATE login SET profile='$target_file' WHERE email='$email' ");

    if($result){
    //첨부파일 업로드
    if($_FILES['pro']['name']){
      $uploadOk=1;
      //확장자 제한
      $FileType = pathinfo($target_file,PATHINFO_EXTENSION);
      //존재하는 파일인지 확인
      if(file_exists($target_file)){
        echo '<script> alert("이미 존재하는 파일입니다.")</script>';
        $uploadOk=0;
      }
      //파일 크기 제한
      if($_FILES['pro']['size'] > 1000000){
        echo '<script> alert("파일의 크기가 너무 큽니다.")</script>';
        $uploadOk=0;
      }
      //허용되는 확장자
      if($FileType != "jpg" && $FileType != "png" && $FileType != "jpeg" && $FileType != "gif"){
        echo '<script> alert("허용되지않는 확장자 입니다.")</script>';
        $uploadOk=0;
      }
      //파일첨부 성공여부
      if($uploadOk == 0){
        echo '<script> alert("파일 업로드에 실패하였습니다.")
                location.href=history.back()</script>';
      }
      else{
        if(move_uploaded_file($_FILES['pro']['tmp_name'],$target_dir . $target_file)){
            $_SESSION['profile'] = $target_file;
            echo '<script>alert("파일 업로드에 성공하였습니다.")
                  location.href="../main.php"</script>';
        }
        else{
          echo '<script>alert("파일 업로드에 실패하였습니다.1")</script>';
        }
      }
    }
      echo '<script>alert("작성 완료.")</script>';
      echo("<meta http-equiv='refresh' content='1; url=modify_check.php'>");
    }else{
      echo '<script>alert("작성 실패.")</script>';
      echo("<meta http-equiv='refresh' content='1; url=modify_check.php'>");
    }

?>
