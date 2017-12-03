<!DOCTYPE html>
<html lang="en">
  <head>
    <?php
    $username=$_SESSION["username"];
    $email = $_SESSION["email"];
    $permission = $_SESSION["permission"];
    ?>

    <?php include("../import/config_alt.php");?>

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


					</script>
					<div class = "row">

					  <div class="col-sm-12 text-left">
					    <nav class="navbar navbar-default" style="margin-top:10px;">
					      <div class="container-fluid">
					            <h3>회원 정보</h3>

					      </div>
					    </nav>
					    <div class = "panel panel-default" >
					      <!-- 사용자 리스트 -->

					      <div class="panel-body" style="height:500px;" >
					        <table class="table table-striped text-center " >
					          <thead>
					            <tr >
					                <th class = "text-center">Email</th>
					                <th class = "text-center">자유게시판 수정/삭제</th>
					                <th class = "text-center">공지사항 쓰기/삭제</th>
					                <th class = "text-center">회원등급</th>

					                </th>
					            </tr>
					          </thead>
					          <tbody>
					          <!-- DB에서 데이터 불러와 사용자들의 email 출력 -->
					            <?php
					            include "admin_db_info.php";
					            include "admin_list.php";
					            while($finddata = mysqli_fetch_assoc($result)){
					            ?>
					            <!--버튼을 누르면 이벤트가 발생합니다. 이벤트는 밑에 있는 id명을 통해 발생하여 ajax요청
					          인자로 전달받게됩니다.(관리자아이디 출력 X)!-->
					            <tr id = "<?php echo $finddata['email']; ?>" >
					              <td><?php echo $finddata['email']; ?></td>
					              <?php if(!strcmp($finddata['board'],'on')){ ?>
					                <td><button type="button" class="btn btn-success" id =<?php echo $finddata['email'];?> onclick="freeboard_able(this.parentNode.parentNode.id)">On</button></td>
					              <?php }else{	?>
					                <td><button type="button" class="btn btn-default" id =<?php echo $finddata['email'];?> onclick="freeboard_able(this.parentNode.parentNode.id)">Off</button></td>
					              <?php } ?>
					              <?php if(!strcmp($finddata['notice'],'on')){ ?>
					                <td><button type="button" class="btn btn-success" id=<?php echo $finddata['email'];?> onclick="notice_able(this.parentNode.parentNode.id)">On</button></td>
					              <?php }else{ ?>
					                <td><button type="button" class="btn btn-default" id=<?php echo $finddata['email'];?> onclick="notice_able(this.parentNode.parentNode.id)">Off</button></td>
					              <?php } ?>
					              <!--회원등급 변경  -->
					                <td>
					                  <div class="dropdown">
					                    <!-- 바로 밑 태그 이름에 해당 아이디의 등급을 자동으로 불러옵니다. -->
					                    <button class="btn btn-default dropdown-toggle no-padding" type="button" data-toggle="dropdown" style="width:125px">
					                      <span id="<?php echo $finddata['email']. "-button";?>"><?php
					                          if(!strcmp($finddata['permission'],'operator')){
					                            echo "운영자";
					                          }
					                          else if(!strcmp($finddata['permission'],'hycube')){
					                            echo "하이큐브회원";
					                          }
					                          else if(!strcmp($finddata['permission'],'normal')){
					                            echo "일반";
					                          }
					                          else{
					                            echo "회원등급미설정";
					                          }
					                        ?></span>
					                      <span class="caret"></span>
					                    </button>
					                        <ul class="dropdown-menu">

					                          <!-- 현재 회원 등급은 li class= "active"가 부여됩니다. -->
					                          <li class="<?php if(!strcmp($finddata['permission'],'hycube')){echo "active";}?>" id="<?php echo $finddata['email']."-hycube";?>" onclick="privilege(this.id)" ><a href="#">하이큐브회원</a></li>
					                          <li class="<?php if(!strcmp($finddata['permission'],'normal')){echo "active";}?>" id="<?php echo $finddata['email']."-normal";?>" onclick="privilege(this.id)"><a href="#">일반</a></li>
					                        </ul>
					                  </div>
					                </td>
					            </tr>
					            <?php

					            }?>

					          </tbody>
					        </table>

					      </div>
					      <!-- 페이지 번호 출력 -->
					      <div class="row">
					        <div class="col-sm-12 text-center">
					          <ul class="pagination">
					            <?php
					              if($start_page>$page_list_size){
					            ?>
					                <li class="prev"><a href="../admin_settings/admin_settings.php?no=<?php echo $start_page-$page_list_size;?>"><<</a></li>
					            <?php
					              }
					            ?>

					            <?php
					              for($i = $start_page; $i <= $end_page; $i++){

					                if($no!=$i){
					            ?>
					                <li><a href="../admin_settings/admin_settings.php?no=<?php echo $i ?>"><?php echo $i?></a></li>
					            <?php
					                }else{
					            ?>
					                <li class="active"><a><?php echo $no?></a></li>
					            <?php
					                }
					              }
					              if($total_page > $end_page){
					            ?>
					                <li class="next"><a href="../admin_settings/admin_settings.php?no=<?php echo ($current_block+1)*$page_list_size-($page_list_size-1); ?>">>></a></li>
					            <?php
					              }
					            ?>


					          </ul>
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
    <script src = "admin_command.js?no=ec78392"></script>
  </body>
</html>
