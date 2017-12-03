<!DOCTYPE html>
<html lang="en">

<head>
	<!-- 설정 파일 import-->
	<?php include("../import/config.php");?>
	<link rel="stylesheet" href="..//css/main.css">
	<link href="../board_plugin/summernote.css" rel="stylesheet">
	<script src="../board_plugin/summernote.js"></script>

	<!-- SNS등에서 url입력시 미리보기 -->
	<meta property="og:image" content="http://i.huffpost.com/gen/2162812/images/o-EMMA-STONE-BIRDMAN-facebook.jpg">
	<meta property="og:title" content="하이큐브 동계웹프로젝트">
	<meta property="og:description" content="하이큐브 웹프로젝트 홈페이지입니다.">


</head>

<body>
	<!-- header.html 불러올 위치-->
<?php include("../import/header.php"); ?>




<div class="container-fluid text-center">


  <div class="row content">
	<div class="col-sm-2 sidenav">
		<!-- left_side_menu.html을 불러올 위치-->
			<?php include("../import/left_side_menu.html"); ?>
	</div>



    <div class="col-sm-8 text-left">
			<!-- welcome.html.html을 불러올 위치-->
    </div>
	<div class="col-sm-2 sidenav">
			<!-- right_side_menu.php을 불러올 위치-->
		<?php include("../import/right_side_menu.php"); ?>



	</div>
	</div>

  </div>
</div>

<?php include("../import/footer.html"); ?>
</body>
</html>
