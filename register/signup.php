<?php

	/*
 	* mysql에 접속하는 코드 	*/
	$host = 'localhost';
	$user = 'root';
	$pw = 'wkfyrnwhtlqka1';
	$dbName = 'login';
	$mysqli = new mysqli($host,$user,$pw,$dbName);

	/*
	 *가입화면에서 사용자에게 입력받은값 변수에 저장
	 */
	$username = htmlspecialchars($_POST["userid"]);
	$pw = htmlspecialchars($_POST["password"]);
	$eml = htmlspecialchars($_POST["email"]);

	include("../import/modal.php");
	include("../import/config_alt.php");


	/*
	 *가입시 페스워드를 8~12자로 제한
	*/
	while(strlen($pw) < 8 || strlen($pw) > 12){
		echo'<script>
			alert("8~12자리를 입력해 주세요.");
			location.replace("./register/register.php")</script>';
	}

	if(strpos($username,' ') !== false){
		echo'<script>alert("username에 공백문자가 포함되어 있습니다.");
			location.replace("./register/register.php")</script>';
	}

	if(strpos($pw,' ') !== false){
		echo'<script>alert("password에 공백문자가 포함되어 있습니다.");
			location.replace("./register/register.php")</script>';
	}

	if(strpos($eml,' ') !== false){
		echo'<script>alert("e-mail에 공백문자가 포함되어 있습니다.");
			location.replace("./register/register.php")</script>';
	}

	/*
	 * DB에있는 값중에 같은 id 있는지 여부 확인하는 코드
	   result는 같은게 있으면 FALSE 없으면 TRUE
	*/
  $result = TRUE;
  $data = mysqli_query($mysqli,'select*from login');
	while($finddata = mysqli_fetch_assoc($data)){
		if(strcmp($eml,$finddata["email"])){
			}
		else{
			$result = FALSE;
			break;
		}
	}

	/*
	 빈칸이 있으면 경고메시지 출력
	*/
	if($username==''|| $pw==''|| $eml==''){
		echo '<script>alert("양식을 모두 채워주세요")
				history.back()</script>';

	}
  else{
	/*
	 *DB에 입력받은 id값이랑 같은값 없으면 db에 넣고 있으면 경고창 출력
	 */
		if($result){
			$sql = "insert into login (username,password,email,permission,board,notice,profile,health,EXP,level,logindate)";
			$sql = $sql. "values('$username','$pw','$eml','normal','off','off',NULL,150,0,1,'1000-01-01')";
	  	if($mysqli->query($sql)){
				mysqli_query($mysqli,"UPDATE login_count SET count=count+1");
				echo '<script>alert("가입이 성공적으로 완료되습니다.")</script>';
				echo("<meta http-equiv='refresh' content='1; url=../login/login.php'>");
			}else{
				echo 'fail';
			}
		}
		else{
			echo '<script>alert("같은 이메일이 존재합니다.")
						history.back()
						</script>';
					}
	}
?>
