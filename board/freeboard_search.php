<!DOCTYPE html>
<html lang="en">
  <head>

    <?php include("../import/config_alt.php");?>
    <?php include("../import/modal.php");?>
		<?php
      if($_GET['ser']){
        $arr = explode('-',$_GET['ser']);
        $arr = array_flip($arr);
      }else{
        $arr = array_flip($_GET['chk']);
      }
			$str='';
      $forpage = array_flip($arr);
      for($i=0;$i<count($arr);$i++){
        $str = $str.$forpage[$i].'-';
      }
			include "freeboard_db_info.php";
			$SearchData = $_GET['name'];
			//검색 경우의수
			if(isset($arr['title'])){
				$ForSearchCount=mysqli_query($mysqli,"SELECT*FROM freeboard WHERE title LIKE '%$SearchData%'");
				if(isset($arr['article'])){
					$ForSearchCount=mysqli_query($mysqli,"SELECT*FROM freeboard WHERE (title LIKE '%$SearchData%' or comment LIKE '%$SearchData%')");
					if(isset($arr['writer'])){
						$ForSearchCount=mysqli_query($mysqli,"SELECT*FROM freeboard WHERE (title LIKE '%$SearchData%' or comment LIKE '%$SearchData%' or writer LIKE '%$SearchData%')");
					}
				}
				else if(isset($arr['writer'])){
					$ForSearchCount=mysqli_query($mysqli,"SELECT*FROM freeboard WHERE (title LIKE '%$SearchData%' or writer LIKE '%$SearchData%')");
				}
			}
			else if(isset($arr['article'])){
				$ForSearchCount=mysqli_query($mysqli,"SELECT*FROM freeboard WHERE comment LIKE '%$SearchData%'");
				if(isset($arr['writer'])){
					$ForSearchCount=mysqli_query($mysqli,"SELECT*FROM freeboard WHERE (comment LIKE '%$SearchData%' or writer LIKE '%$SearchData%')");
				}
			}
			else if(isset($arr['writer'])){
				$ForSearchCount=mysqli_query($mysqli,"SELECT*FROM freeboard WHERE writer LIKE '%$SearchData%'");
			}
			else{
				$ForSearchCount=mysqli_query($mysqli,"SELECT*FROM freeboard");
			}

			include "freeboard_list.php";
			$count=0;
			while(mysqli_fetch_assoc($ForSearchCount)){
				$count++;
			}

			$total_page = (int)ceil($count/$page_size);
			if($total_page < $end_page){
				 $end_page=$total_page;
			}
		?>
    <?php
    $username=$_SESSION["username"];
    $email = $_SESSION["email"];
    $permission = $_SESSION["permission"];
    ?>
    <link rel="stylesheet" href="../css/board.css">
  </head>

  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <!-- 좌측 사이드메뉴 -->
        <?php include("../import/left_side_menu.php"); ?>
        <!-- /좌측 사이드메뉴 -->
        <!-- 상단 프로필 메뉴 -->
        <?php include("../import/top_side_menu.php");?>
        <!-- /상단 프로필 메뉴 -->

        <!-- 페이지 내용 -->
        <div class="right_col" role="main">
					<div class="row" >

					    <div class="col-sm-12 text-left">
					    <h3>
					      자유게시판입니다.
					    </h3>
					  </div>
					</div>
					<!--쓰기 버튼-->
					<div class="row" >
					  <div class="col-sm-12 text-right">
					    <?php
					      if($_SESSION['email']){
					        if(!strcmp($_SESSION['board'],'on')){
					    ?>
					        <button type="button" class="btn btn-primary" onclick="location.href='write.php'">Write</button>
					    <?php
					        }else{
					    ?>
					        <button type="button" class="btn btn-primary" onclick="
                    document.getElementById('signerrormessage').innerHTML = "쓰기권한이 없습니다.";
                    $('#signuperror').modal();
                    $('#ok').on('click', function(e){
                      location.href = 'board.php';
                    })
                    $('#close').on('click', function(e){
                      location.href = 'board.php';
                    })">Write</button>
					    <?php
					        }
					      }else{
					    ?>
					        <button type="button" class="btn btn-primary" onclick="
                    document.getElementById('signerrormessage').innerHTML = "로그인 후 이용 가능합니다\n로그인 페이지로 이동합니다.";
                    $('#signuperror').modal();
                    $('#ok').on('click', function(e){
                      location.href = '../login/login.php';
                    })
                    $('#close').on('click', function(e){
                      location.href = '../login/login.php';
                    })">Write</button>
					    <?php
					      }
					    ?>

					  </div>
					</div>

					<div class="row" >
					  <div class="col-sm-2 text-left">

					  </div>
					  <div class="col-sm-10 text-right">
					    &nbsp;


					    <!-- 게시물 검색 -->
					    <form action="freeboard_search.php" method="GET">
					      <input type = "checkbox" name = chk[] value = "title" checked>제목
					      <input type = "checkbox" name = chk[] value = "article">내용
					      <input type = "checkbox" name = chk[] value = "writer">작성자
					      <div class="input-group">
					          <input type="text" name="name" class="form-control" placeholder="제목">
					        <div class="input-group-btn">
					          <button class="btn btn-default" type="submit">
					            <i class="glyphicon glyphicon-search">							</i>
					          </button>
					        </div>
					      </div>
					    </form>
					  </div>
					</div>
					<!-- 게시물 리스트 출력 -->

					<div class="row">

					  &nbsp;
					  <div class="col-sm-12 text-left">

					    <div class="list-group">
					      <?php
					      if(isset($arr['title'])){
					        $result=mysqli_query($mysqli,"SELECT*FROM freeboard WHERE title LIKE '%$SearchData%' ORDER BY NUM DESC limit $start_article,$page_size");
					        if(isset($arr['article'])){
					          $result=mysqli_query($mysqli,"SELECT*FROM freeboard WHERE (title LIKE '%$SearchData%' or comment LIKE '%$SearchData%') ORDER BY NUM DESC limit $start_article,$page_size");
					          if(isset($arr['writer'])){
					            $result=mysqli_query($mysqli,"SELECT*FROM freeboard WHERE (title LIKE '%$SearchData%' or comment LIKE '%$SearchData%' or writer LIKE '%$SearchData%') ORDER BY NUM DESC limit $start_article,$page_size");
					          }
					        }
					        else if(isset($arr['writer'])){
					          $result=mysqli_query($mysqli,"SELECT*FROM freeboard WHERE (title LIKE '%$SearchData%' or writer LIKE '%$SearchData%') ORDER BY NUM DESC limit $start_article,$page_size");
					        }
					      }
					      else if(isset($arr['article'])){
					        $result=mysqli_query($mysqli,"SELECT*FROM freeboard WHERE comment LIKE '%$SearchData%' ORDER BY NUM DESC limit $start_article,$page_size");
					        if(isset($arr['writer'])){
					          $result=mysqli_query($mysqli,"SELECT*FROM freeboard WHERE (comment LIKE '%$SearchData%' or writer LIKE '%$SearchData%') ORDER BY NUM DESC limit $start_article,$page_size");
					        }
					      }
					      else if(isset($arr['writer'])){
					        $result=mysqli_query($mysqli,"SELECT*FROM freeboard WHERE writer LIKE '%$SearchData%' ORDER BY NUM DESC limit $start_article,$page_size");
					      }
					      else{
					        $result=mysqli_query($mysqli,"SELECT*FROM freeboard ORDER BY NUM DESC limit $start_article,$page_size");
					      }
					        while($row = mysqli_fetch_array($result)){

                    $mysqli2 = new mysqli($host,$user,$pw,'login');
                    $writer= mysqli_query($mysqli2,"SELECT * FROM login WHERE email='$row[EMAIL]'");
                    $writer_perm = mysqli_fetch_assoc($writer);
                    $perm = $writer_perm['permission'];
                    $writer_profile = $writer_perm['profile'];
                    $ForFile = mysqli_query($mysqli,"SELECT*FROM FileName");

                    //파일있는지 여부확인
                    $File_exist=0;
                    while($Fname=mysqli_fetch_assoc($ForFile)){
                      if(!strcmp($row[NUM],$Fname['NUM'])){

                        $File_exist=1;
                        break;
                      }
                    }
					      ?>
					        <!--게시글 읽기권한 확인-->
					        <?php
					          if($_SESSION['username']){
					        ?>
					        <a href="freeboard_read.php?id=<?php echo $row[NUM]; ?>&no=<?php echo $no ?>" class="list-group-item">
					        <?php }else{
					        ?>
					        <a href="../login/login.php" onclick="
                    document.getElementById('signerrormessage').innerHTML = "로그인 후 이용 가능합니다\n로그인 페이지로 이동합니다.";
                    $('#signuperror').modal();
                    $('#ok').on('click', function(e){
                      location.href = '../login/login.php';
                    })
                    $('#close').on('click', function(e){
                      location.href = '../login/login.php';
                    })" class="list-group-item">
					        <?php } ?>

					          <div class="row">
					            <div class = "col-sm-8 text-left">
					            <h4 class="list-group-item-heading"><?php echo $row[TITLE];?> <span class="badge"><?php echo $row[SEE];?></span></h4>
                      <p class="list-group-item-text">
                      <!-- 작성자 프로필 -->
                    <?php if($writer_profile == NULL){ ?>
                            <img src="../import/images/user.png" class="img-rounded" alt="" width="15" height="15">
                    <?php }else{ ?>
                            <img src="../profile/<?php echo $writer_profile; ?>" class="img-rounded" alt="" width="15" height="15">
                    <?php } ?>

                    <?php echo $row[WRITER];?>
                        <?php if(!strcmp($perm,'imthebest')){
                        ?>
                          <span class="label label-primary">관리자</span>
                          <?php }
                              if(!strcmp($perm,'operator')){
                          ?>
                            <span class="label label-warning">운영자</span>
                        <?php }
                              if($File_exist){
                        ?>
                            <span class="glyphicon glyphicon-paperclip" aria-hidden="true"></span>

                        <?php } ?>
                      </p>
					            </div>
					            <div class = "col-sm-4 text-right">
					              <h4 class="list-group-item-heading">#<?php echo $row[NUM];?></h4>
					              <p class="list-group-item-text"><?php echo $row[DATE];?></p>
					            </div>
					          </div>


					        </a>
					      <?php
					        }
					      ?>

					      </div>
					  </div>	<!--게시물 리스트 출력 끝-->
					</div>
					<!-- 페이지 번호 출력 -->
					<div class="row">
					  <div class="col-sm-12 text-center">
					    <ul class="pagination">
					      <?php
					        if($start_page>$page_list_size){
					      ?>
					          <li class="prev"><a href="../board/freeboard_search.php?no=<?php echo $start_page-$page_list_size;?>&name=<?php echo $SearchData ?>&ser=<?php echo $str;?>"><<</a></li>
					      <?php
					        }
					      ?>

					      <?php
					        for($i = $start_page; $i <= $end_page; $i++){

					          if($no!=$i){
					      ?>

					          <li><a href="../board/freeboard_search.php?no=<?php echo $i ?>&name=<?php echo $SearchData ?>&ser=<?php echo $str;?>"><?php echo $i?></a></li>

					      <?php
					          }else{
					      ?>
					          <li class="active"><a><?php echo $no?></a></li>
					      <?php
					          }
					        }
					        if($total_page > $end_page){

					      ?>
					          <li class="next"><a href="../board/freeboard_search.php?no=<?php echo ($current_block+1)*$page_list_size-($page_list_size-1); ?>&name=<?php echo $SearchData ?>&ser=<?php echo $str;?>">>></a></li>
					      <?php
					        }
					      ?>


					    </ul>
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
