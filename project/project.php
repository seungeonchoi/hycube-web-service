<!DOCTYPE html>
<html lang="en">

<head>
	<!-- 설정 파일 import-->
	<?php include("../import/config.php"); ?>
	<link rel="stylesheet" href="css/custom.css">

</head>

<body>
	<!-- w3IncludeHTML()을 이용한 헤더 import-->
<!-- php 방식으로 include (header.php)로 윤인호가 수정-->
	<?php include("../import/header.php");?>



<div class="container-fluid text-center">


  <div class="row content">
	<div class="col-sm-2 sidenav">
		<!-- w3IncludeHTML()을 이용한 좌측 사이드메뉴 import-->
		<!-- php 방식으로 left_side_menu.html로 윤인호가수정-->
				<?php include("../import/left_side_menu.html");?>
	</div>



	<!-- 센터 레이아웃 -->
    <div class="col-sm-8 text-left">
      <h3>Projects List</h3>


    </div>
	<!-- w3IncludeHTML()을 이용한 우측 사이드메뉴 import-->
	<div class="col-sm-2 sidenav">
		<!-- right_side_menu.php을 불러올 위치-->
		<?php include("../import/right_side_menu.php"); ?>
	</div>


  </div>
  </div>
</div>
<!-- w3IncludeHTML()을 이용한 밑에 import-->
<!-- php방식으로 footer.html로 윤인호가 수정-->

	<?php include("../import/footer.html"); ?>
<!-- html을 import하는  javascript(w3data.js)함수   -->
<script>


</script>
</body>
</html>
