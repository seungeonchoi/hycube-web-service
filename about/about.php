<!DOCTYPE html>
<html lang="en">
  <head>

    <?php include("../import/config_alt.php");?>
		<?php
    $username=$_SESSION["username"];
    $email = $_SESSION["email"];
    $permission = $_SESSION["permission"];
    ?>


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
					<div class="row" >

					  <div class="col-sm-12 text-left">
					  <div class = "well-sm kor" style="background-color:#D8D8D8">
					      <h1> Seung-Eon Choi(최승언)</h1>
					      <div class="row">

					        <div class="col-sm-3 text-left">

					        </div>
					        <div class="col-sm-9 text-left" >
					          <h3> ·Client-side</h3>
					          <h4 class = "kor"> 1994년 6월 10일 인천 부평구 출생. 08-09년도에 싱가포르에서 Yusof Ishak Secondary school을 다니면서 2년 동안 거주하다가 귀국하여 인제고등학교를 거치고 2013년 한양대학교 ERICA캠퍼스 재학 중에 있습니다.  </h5>
					        <h5> ·(2015년 8월) 국방오픈소스아카데미 Infra부문 수료 및 위탁교육에 선발 </h5>
					        <h5> ·(2016년 5월) 정보처리산업기사 취득</h5>
					        <h5> ·(2016년 11월) 정보보안산업기사 취득</h5>

					        </div>

					        </div>
					    </div>
					</div>

					</div>
					<!-- 여기서부터 다른 사람들 들어갈 프로필1  -->
					<div class="row" style="margin-top:50px;">
					<div class="col-sm-12 text-left">
					  <div class = "well-sm kor" style="background-color:#D8D8D8">
					      <h1> Yun In ho(윤인호)</h1>
					      <div class="row">

					        <div class="col-sm-3 text-left">

					          <img class="img-responsive" src="/images/Yun in ho2.JPG" alt="" width="150" height="150">
					        </div>
					        <div class="col-sm-9 text-left" >
					          <h3> ·Client-side</h3>
					          <h4 class = "kor" > O A she's mine O A she's mine </h> </h5>
					        <h5> (2012년 12월) 운전면허 1종 보통 취득· </h5>
					        <h5> ·</h5>
					        <h5>  </h5>
					      </div>
					      </div>
					  </div>

					</div>

					</div>


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
