<?php

	/*
 	* DB에있는 값중에 같은 id 있는지 여부 확인하는 코드
    result는 같은게 있으면 TRUE 없으면 FALSE*/
	$host = 'localhost';
	$user = 'root';
	$pw = 'wkfyrnwhtlqka1';
	$dbName = 'login';
	$mysqli = new mysqli($host,$user,$pw,$dbName);

  $result = FALSE;
  $userdata;
	
  $email = $_POST['email'];

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
	//datatype이 json이므로..
  echo json_encode($result);
?>
