<?php
  //DB접속
  $host = 'localhost';
  $user = 'root';
  $pw = 'wkfyrnwhtlqka1';
  $dbName = 'login';
  $mysqli = new mysqli($host,$user,$pw,$dbName);
  //운영자 강등
  $target = mysqli_query($mysqli,"SELECT*FROM login WHERE email='$_GET[id]'");
  $target_name = mysqli_fetch_assoc($target);
  if(!strcmp($target_name['permission'],'operator')){
    if(mysqli_query($mysqli,"UPDATE login SET permission = 'hycube' WHERE email='$_GET[id]'")){
        mysqli_query($mysqli,"UPDATE login SET board='off',notice='off' WHERE email='$_GET[id]'");
        echo '<script>
                alert("변경되었습니다.")
                history.back();
              </script>';

    }else{
        echo '<script>
                alert("변경에 실패하였습니다.")
                history.back();
              </script>';
      }
  }else{
    echo '<script>
            alert("운영자가 아닌 회원입니다.")
            history.back();
          </script>';
  }
 ?>
