<?php
  include("import/modal.php");


	/* url직접접속 차단	*/
	if(strcmp($_SESSION['permission'],'imthebest') && strcmp($_SESSION['permission'],'operator')){
		echo '<script>
		document.getElementById("signerrormessage").innerHTML = "접근할 수 없는 페이지입니다.\n메인 페이지로 이동합니다.";
		$("#signuperror").modal();
		$("#ok").on('click', function(e){
			location.href="../main.php";
		})
		$("#close").on('click', function(e){
			location.href="../main.php";
		})
		</script>';
		exit;
	}
	/* 서버접속 */
	include "admin_db_info.php";
	/* 해당 유저의 email 값과 현재 sign(on인지 off인지)을 admin_command.js에서 넘겨받음*/
	$sign = $_POST['sign'];
	$user = $_POST['id'];
	$target = $_POST['target'];
	$target_sign = $_POST['sign'];

	/* 해당유저의 board의 상태 변경 on->off/ off->on */
	if(!strcmp($sign,'freeboard_on')){
		mysqli_query($mysqli,"UPDATE login SET board='on' WHERE email='$user'");
		echo json_encode("freeboard_on");
	}
	else if(!strcmp($sign,'freeboard_off')){
		mysqli_query($mysqli,"UPDATE login SET board='off' WHERE email='$user'");
		echo json_encode("freeboard_off");
	}//해당 유저의 notice 상태 변경
	else if(!strcmp($sign,'notice_on')){
		mysqli_query($mysqli,"UPDATE login SET notice='on' WHERE email='$user'");
		echo json_encode("notice_on");
	}
	else if(!strcmp($sign,'notice_off')){
		mysqli_query($mysqli,"UPDATE login SET notice='off' WHERE email='$user'");
		echo json_encode("notice_off");
	}//회원등급
	else if(!strcmp($target_sign,'operator')){
		mysqli_query($mysqli,"UPDATE login SET permission='operator' WHERE email='$target'");
		echo json_encode("operator");
	}
	else if(!strcmp($target_sign,'hycube')){
		mysqli_query($mysqli,"UPDATE login SET permission='hycube' WHERE email='$target'");
		echo json_encode("hycube");
	}
	else if(!strcmp($target_sign,'normal')){
		mysqli_query($mysqli,"UPDATE login SET permission='normal' WHERE email='$target'");
		echo json_encode("normal");
	}
	else{
		echo false;
	}


	mysqli_close($mysqli);
	//회원 등급 변경





?>
