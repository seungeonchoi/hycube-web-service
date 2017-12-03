<?php
  if(isset($_SESSION['email'])){
    echo '<script>
            $(function(){
              console.log("signin.php 만료");
              document.getElementById("signerrormessage").innerHTML = "만료된 페이지 입니다.";
              $("#signuperror").modal();
              $("#ok").on("click", function(e){
                location.href = history.back();
              });
              $("#close").on("click", function(e){
                location.href = history.back();
              });
            });
                  </script>';
  }
?>
<!DOCTYPE html>
<html lang="en">

<head>

<?php include("../import/config_alt.php");
      include("../import/modal.php");?>

</head>
<body>

<?php
/*
 세션 시작
*/
 session_start();
 /*
 DB(mysql)에 접속
 */
  $host = 'localhost';
  $user = 'root';
  $pw = 'wkfyrnwhtlqka1';
  $dbName = 'login';
  $mysqli = new mysqli($host,$user,$pw,$dbName);

  /*
   *로그인화면에서 사용자에게 입력받은값 변수에 저장
   */
  $email = htmlspecialchars($_POST["email"]);
  $password = htmlspecialchars($_POST["password"]);

  /*
  *입력받은 값이 DB에 있나 검사해서 있으면 result값은 true 없으면 false
    뒤에서 if문에 조건으로 넣기위해 result 사용
  */
  $result = FALSE;
  $userdata;
  $data = mysqli_query($mysqli,'select*from login');
  while($finddata = mysqli_fetch_assoc($data)){
    if(strcmp($email,$finddata["email"])){
    }
    else{
      $result = TRUE;
      $userdata = $finddata;
      break;
    }
  }


  /*
  *입력받은 password값과 DB에 있는 password값이 다르면 result값은 false
  */
  if(strcmp($userdata["password"],$password)){
    $result = FALSE;
  }

  /*
  result를 조건문으로 걸어 result가 true면 login, false면 다시입력받음
  */
  if($result){
          //총체력
          $full_health;
          if(!strcmp($userdata['permission'],'hycube')){
            $full_health=200+($userdata['level']-1)*20;
          }
          else if(!strcmp($userdata['permission'],'normal')){
            $full_health=150+($userdata['level']-1)*10;
          }
          else if(!strcmp($userdata['permission'],'operator')){
            $full_health=400+($userdata['level']-1)*40;
          }else{
            $full_health=9999;
          }
          $userEXP = $userdata['EXP'];
          //하루에 한번 실행
          date_default_timezone_set('Asia/Seoul');
          $today = date("Y-m-d");
          if($today>$userdata['logindate']){
            mysqli_query($mysqli,"UPDATE login SET health = $full_health WHERE email='$email'");
            echo '<script>alert("출석 경험치 +50")</script>';
            mysqli_query($mysqli,"UPDATE login SET EXP = EXP+50 WHERE email='$email'");
            $userdata['EXP'] = $userdata['EXP']+50;
          }

          mysqli_query($mysqli,"UPDATE login SET logindate=curdate() WHERE email = '$email'");
          $_SESSION['email'] = $email;
          $_SESSION['username'] = $userdata['username'];
          $_SESSION['permission'] = $userdata['permission'];
          $_SESSION['board'] = $userdata['board'];
          $_SESSION['notice'] = $userdata['notice'];
          $_SESSION['profile'] = $userdata['profile'];
          $_SESSION['health'] = $userdata['health'];
          $_SESSION['EXP'] = $userdata['EXP'];
          $_SESSION['level'] = $userdata['level'];
          $_SESSION['itsuserspwd'] = $userdata['password'];

          setCookie('id', $email);

          echo '<script>
                  $(function(){
                    console.log("signin.php 환영합니다");
                    document.getElementById("signerrormessage").innerHTML = "환영합니다.";
                    $("#signuperror").modal();
                    $("#ok").on("click", function(e){
                      location.href = "../main.php";
                    });
                    $("#close").on("click", function(e){
                      location.href = "../main.php";
                    });
                  });
                </script>';

  }
  else{
    	echo '<script>
                $(function(){
                  console.log("signin.php Wrong ID!!");
                  document.getElementById("signerrormessage").innerHTML = "잘못된 아이디나 비밀번호 입니다. 다시 입력해주세요.";
                  $("#signuperror").modal();
                  $("#ok").on("click", function(e){
                    location.href = "login.php";
                  });
                  $("#close").on("click", function(e){
                    location.href = "login.php";
                  });
                });
            </script>';

  }

?>

</body>
