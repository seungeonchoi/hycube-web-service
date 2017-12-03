<!DOCTYPE html>
<html lang="en">
  <head>
    <?php include("../import/config_alt.php");?>
		<?php
    $username=$_SESSION["username"];
    $email = $_SESSION["email"];
    $permission = $_SESSION["permission"];
    ?>
    
    <script type="text/javascript" src="../js/json2.js"></script>
  </head>

  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <!-- 좌측 사이드메뉴 -->
        <?php include("../import/left_side_menu.php");?>
        <!-- /좌측 사이드메뉴 -->
        <!-- 상단 프로필 메뉴 -->
        <?php include("../import/top_side_menu.php");?>
        <!-- /상단 프로필 메뉴 -->

        <!-- 페이지 내용 -->
        <div class="right_col" role="main">
					<h3 class = "kor"> 담당자 연락처 </h3>
					<p class = "kor"> 최승언 : choi610@hanyang.ac.kr </h3>
					<hr>
					<h3 class = "kor"> HYCUBE 학회 </h3>
					<p class = "kor"> 경기도 안산시 상록구 한양대학로 55 한양대학교 ERICA캠퍼스 </h3>
					<p class = "kor"> 4공학관 1층 SMASH 학습전용공간 </h3>
					<!-- 구글맵이 들어갈 위치 -->
					<div id="googleMap" style="height:400px;width:100%;"></div>

					<!-- 구글맵 api -->
					<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBZxtR7_uSAVDw7blkn8kDDJkXeyfBoCW4"></script>
					<script>
					var myCenter = new google.maps.LatLng(37.296827, 126.836311);

					function initialize() {
					var mapProp = {

					  center:myCenter,
					  zoom:17,
					  scrollwheel:false,
					  draggable:false,
					  mapTypeId:google.maps.MapTypeId.ROADMAP
					};

					var map = new google.maps.Map(document.getElementById("googleMap"),mapProp);

					var marker = new google.maps.Marker({
					  position:myCenter,
					});

					marker.setMap(map);
					}

					google.maps.event.addDomListener(window, 'load', initialize);
					</script>


        </div>
        <!-- /페이지 내용 -->

        <!-- 풋터 내용 -->
        <?php include("../import/footer.php");?>
        <!-- /풋터 내용 -->
      </div>
    </div>
    <script src="../js/custom.js?val=ec89742"></script>

  </body>
</html>
