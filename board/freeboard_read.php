<!DOCTYPE html>
<html lang="en">
  <head>
    <?php
      include("../import/config_alt.php");
      include("../import/modal.php");?>


      <?php
      if(!isset($_SESSION['username'])){?>
        <script>
          $(function(){
            document.getElementById("signerrormessage").innerHTML = "로그인 후 이용 가능합니다.\n로그인 페이지로 이동합니다.";
            $("#signuperror").modal();
            $("#ok").on('click', function(e){
              location.href = "../login/login.php";
            })
            $("#close").on('click', function(e){
              location.href = "../login/login.php";
            })
          });
        </script><?php
        exit;
      }

    ?>
    <?php
      // DB 접속코드
      include "freeboard_db_info.php";
      $db = 'login';
      $mysqls = new mysqli($host,$user,$pw,$db);
      //조회수 갱신
      mysqli_query($mysqli, "update freeboard set see=see+1 where NUM=$_GET[id]");

      // DB에서 정보 가져오기
      $result = mysqli_query($mysqli, "SELECT * FROM freeboard where NUM=$_GET[id]");
      $row = mysqli_fetch_array($result);
     //  DB에서 댓글 정보 가져오기
      $cresult = mysqli_query($mysqli, "SELECT * FROM comment where B_NO = $_GET[id] order by GROUP_NUM asc");
     ?>

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
        <?php include("../import/left_side_menu.php"); ?>
        <!-- /좌측 사이드메뉴 -->
        <!-- 상단 프로필 메뉴 -->
        <?php include("../import/top_side_menu.php");?>
        <!-- /상단 프로필 메뉴 -->

        <!-- 페이지 내용 -->
        <div class="right_col" role="main">
          <div class = "row">
            <div class="col-xs-1 text-left">
            </div>
            <div class="col-xs-10 text-left">
              <div class = "panel panel-default" style="margin-top:50px;">
                <div class="panel-heading">
                  <div class = "row">
                    <!--게시물 번호, 게시물 제목, 조회수 -->
                    <div class="col-xs-8 text-left">
                      <h4 style="color:rgb(143, 141, 141)">#<?php echo $row[NUM]; ?></h4>

                    </div>
                    <!--게시물 날짜, 작성자 -->
                    <div class="col-xs-4 text-right">
                      <h5><?php echo $row[DATE]; ?></h5>

                    </div>
                  </div>

                  <div class = "row">
                    <div class="col-xs-8 text-left">
                      <h4 class="kor"><?php echo $row[TITLE]; ?> <span class="badge"><?php echo $row[SEE];?></span></h4>
                    </div>
                    <div class="col-xs-4 text-right">
                      <h4 class = "kor" >작성자: <?php echo $row[WRITER]; ?></h4>
                    </div>
                  </div>
                </div>
                <div class="panel-body" style="position:relative">
                  <!--첨부된 파일 다운로드 -->


                    <?php   $arr = array();
                      $number = $row[NUM];
                      $ForFile = mysqli_query($mysqli,"SELECT*FROM FileName WHERE NUM = $number");
                      $File_exist = mysqli_query($mysqli,"SELECT count(*) FROM FileName WHERE NUM = $number");
                      $count = mysqli_fetch_assoc($File_exist);
                      if($count['count(*)']!=0){
                    ?>
                          <div class="wrapper" style="position:absolute; right:15px; z-index:5" >
                              <header>
                                  <button style="float:right" onclick="showfile('navigation-list');">
                                  <span class="menuBtn" style="font-weight:bold">첨부파일 <span style="color:red; font-weight:bold">(<?php echo $count['count(*)']?>)</span></span>
                                </button>
                                  <nav id="navigation-list" style="display:none">
                                    <div style="float:right; border:1px solid gray; z-index:5; width:80%; background-color:white">
                                      <ul>
                                    <?php
                                      while($Fname = mysqli_fetch_assoc($ForFile)){
                                          array_push($arr,$Fname['filename']);
                                    ?>
                                          <li><a style= "font-weight:bold" href="freeboard_download.php?filename=<?php echo $Fname['NUM'].'^'.$Fname['filename']?>"><?php echo $Fname['filename'];?></a></li>
                                          <?php }?>
                                       </ul>
                                    </div>
                                  </nav>
                              </header>
                          </div>
                        <?php }?>




                  <div class="content_wrapper">
                    <?php echo $row[COMMENT]; ?>
                  </div>
                  <div class="row">
                    <!-- 수정 삭제 버튼-->
                    <div class = "read_option_wrapper col-xs-12">

                      <?php if(strcmp($row[WRITER],'Admin')){
                         if(!strcmp($_SESSION['email'],$row[email]) || !strcmp($_SESSION['board'],"on")){?>
                      <div class= "col-xs-3">
                       <form action='freeboard_rewrite.php' method="POST">
                         <button type="submit" class="btn btn-success auto">Modify</button>
                         <input type='hidden' name='writer' value='<?php echo $row[WRITER]?>'>
                         <input type='hidden' name='id' value='<?php echo $row[NUM]?>'>
                       </form>
                      </div>
                      <div class="col-xs-3">
                        <button class="btn btn-primary auto" onclick='history.back();'>Back</button>
                      </div>
                      <div class="col-xs-3">
                        <form  action='freeboard_del.php' method="POST">
                          <input type='hidden' name='writer' value='<?php echo $row[WRITER]?>'>
                          <input type='hidden' name='id' value='<?php echo $row[NUM]?>'>
                          <?php for($i=0;$i<count($arr);$i++){?>
                          <input type='hidden' name='file[]' value='<?php echo $arr[$i]?>'>
                          <?php }?>
                          <button type="submit" class="btn btn-danger auto">Delete</button>
                        </form>
                      </div>
                      <div class="col-xs-3">
                        <button class="btn btn-danger auto" data-target="#layerpop" data-toggle="modal">Report</button><br/>
<div class="modal fade" id="layerpop" >
  <link href="https://fonts.googleapis.com/css?family=Oleo+Script:400,700" rel="stylesheet">
   	<link href="https://fonts.googleapis.com/css?family=Teko:400,700" rel="stylesheet">
   	<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">

<section id="contact">
			<div class="section-content">
				<h1 class="section-header">신고해주세요 <span class="content-header wow " data-wow-delay="0.2s" data-wow-duration="2s"> 좆</span></h1>
				<h3>Lorem Ipsum is simply dummy text of the printing and typesetting industry</h3>
			</div>
			<div class="contact-section">
			<div class="container">
				<form>
					<div class="col-md-6 form-line">
			  			<div class="form-group">
			  				<label for="exampleInputUsername">Your name</label>
					    	<input type="text" class="form-control" id="" placeholder=" Enter Name">
				  		</div>
				  		<div class="form-group">
					    	<label for="exampleInputEmail">Email Address</label>
					    	<input type="email" class="form-control" id="exampleInputEmail" placeholder=" Enter Email id">
					  	</div>
					  	<div class="form-group">
					    	<label for="telephone">Mobile No.</label>
					    	<input type="tel" class="form-control" id="telephone" placeholder=" Enter 10-digit mobile no.">
			  			</div>
			  		</div>
			  		<div class="col-md-6">
			  			<div class="form-group">
			  				<label for ="description"> Message</label>
			  			 	<textarea  class="form-control" id="description" placeholder="Enter Your Message"></textarea>
			  			</div>
			  			<div>

			  				<button type="button" class="btn btn-default submit"><i class="fa fa-paper-plane" aria-hidden="true"></i>  Send Message</button>
			  			</div>

					</div>
				</form>
			</div>
		</section>
                      </div>
                    <?php }
                    }else{
                      if(!strcmp($_SESSION['permission'],'imthebest')){?>
                    <div class= "col-xs-4">
                      <form action='freeboard_rewrite.php' method="POST">
                        <input type='hidden' name='id' value='<?php echo $row[NUM]?>'>
                        <input type='hidden' name='writer' value='<?php echo $row[NUM]?>'>
                        <button type="submit" class="btn btn-success auto">Modify</button>
                      </form>
                    </div>
                    <div class="col-xs-4">
                      <button class="btn btn-primary auto" onclick='history.back();'>Back</button>
                    </div>
                    <div class="col-xs-4">
                      <form action='freeboard_del.php' method="POST">
                        <input type='hidden' name='writer' value='<?php echo $row[WRITER]?>'>
                        <input type='hidden' name='id' value='<?php echo $row[NUM]?>'>
                        <?php for($i=0;$i<count($arr);$i++){?>
                        <input type='hidden' name='file[]' value='<?php echo $arr[$i]?>'>
                        <?php }?>
                        <button type="submit" class="btn btn-danger auto ">Delete</button>
                      </form>
                    </div>

                     <?php
                       }
                    }?>

                    </div>
                    </div>
                  </div>







                </div>
              </div>
                <!--댓글 기능-->
                 <div class="comment" >
                        <form method="post" action="../comment/comment_submit.php" style="margin: 0" >
                        <input type = "hidden" name="b_num" value="<?php echo $row[NUM];?>">
                        <input type = "hidden" name="partition_page" value="<?php echo $_GET['no'];?>">
                        <div class="commentWrite">
                            <div class="row">
                              <div class="col-xs-12">
                                <input style="display:inline;" type="checkbox" name="secret" id="secret_" class="checkbox" />
                                <span>이 댓글을 비밀 댓글로</span>
                              </div>
                            </div>

                          <div class="row">
                            <div class="col-xs-12">
                              <textarea class="form-control" placeholder="내용을 입력하세요." name="comment" rows="6"></textarea>
                            </div>
                          </div>
                          <button class="btn btn-primary" type="submit" onclick="location.href='../comment/comment_submit.php'" class="submit" style="margin-top:10px;">
                            <i class="fa fa-check"></i>
                            댓글 달기
                          </button>
                        </div>
                      </form>
                    </div>
                        <?php
                          while($crow = mysqli_fetch_array($cresult)){
                            $this_writer = $crow[email];
                              $sresult = mysqli_query($mysqls,"SELECT*FROM login WHERE email='$this_writer'");
                              $writerdata = mysqli_fetch_assoc($sresult);

                        ?>



                        <div class="commentList" style="margin-top:10px;">

                          <ol style="<?php if($crow[DEPTH] != 0){echo 'padding-left:100px';} ?>">
                            <li id="comment10917698">
                              <div class="media" >
                                <div class="pull-left">
                                <?php if(isset($writerdata['profile'])){?>
                                        <img src="../profile/<?php echo $writerdata['profile'];?>"  style="width:60px;height:60px;border-radius:50em;margin:3px 3px 3px 10px;"/>
                                <?php }else{ ?>
                                        <img src="../import/images/user.png" style="width:60px;border-radius:50em;margin:3px 3px 3px 10px;"/>
                                <?php } ?>
                            </div>
                                  <div class="writer_info">
                                      <div class="comment-action">
                                        <form action="../comment/comment_delete.php" method="POST">
                                          <input type = "hidden" name="b_num" value="<?php echo $row[NUM];?>">
                                          <input type = "hidden" name="perm" value="<?php echo $_SESSION["permission"];?>">
                                          <input type = "hidden" name="no" value="<?php echo $crow[NO];?>">
                                          <input type = "hidden" name="email" value="<?php echo $crow[email];?>">
                                          <input type = "hidden" name="partition_page" value="<?php echo $_GET['no'];?>">
                                          <a href="javascript:function none(){return false}" onclick="this.parentNode.getElementsByTagName('ul')[0].style.display='block';this.parentNode.removeChild(this);"><i class="fa fa-ellipsis-h fa-2x"></i></a>

                                            <ul class="list-inline">
                                                <li>
                                                  <a href ="#" onclick = "showmydiv('write','<?php echo $crow[NO];?>')" title="답글쓰기">
                                                    <i class="fa fa-share fa-2x"></i>
                                                  </a>
                                                </li>


                                                <li>
                                                  <a href="#" onclick = "showmydiv('modify','<?php echo $crow[NO];?>')" title="수정하기">
                                                    <i class="fa fa-link fa-2x"></i>
                                                  </a>
                                                </li>
                                                <li>
                                                  <button type="submit" onclick="location.href='../comment/comment_delete.php'" title="삭제하기">
                                                    <i class="fa fa-trash-o fa-2x"></i>
                                                  </button>
                                                </li>
                                              </ul>
                                            </div>
                                            <ul class="list-unstyled">
                                              <b><li><?php echo $crow['COMMENT'].'<br>';?></li><b>
                                              <b><li><?php echo $crow['NAME'].'<br>';?></li></b>
                                              <li class="time"><?php echo $crow['DATE']; ?><a href="/toolbar/popup/abuseReport/?entryId=589&commentId=10917698" onclick="window.open(this.href, 'tistoryThisBlogPopup', 'width=550, height=510, toolbar=no, menubar=no, status=no, scrollbars=no'); return false;">신고</a></li>
                                            </ul>
                                          </form>
                                          <!--답글폼-->
                                          <form action="../comment/comment_reple.php" method="POST">
                                            <input type = "hidden" name="b_num" value="<?php echo $row[NUM];?>">
                                            <input type = "hidden" name="perm" value="<?php echo $_SESSION["permission"];?>">
                                            <input type = "hidden" name="no" value="<?php echo $crow[NO];?>">
                                            <input type = "hidden" name="email" value="<?php echo $crow[email];?>">
                                            <input type = "hidden" name="partition_page" value="<?php echo $_GET['no'];?>">
                                            <input type = "hidden" name="group_num" value="<?php echo $crow[GROUP_NUM]?>">
                                          <div class="comment-form" id = "comment-rise-<?php echo $crow[NO];?>" style = "display:none">
                                            <div class="row">
                                              <div class="col-xs-12">
                                                <textarea class="form-control" placeholder="내용을 입력하세요." name="comment" rows="2"></textarea>
                                                <button class="btn btn-primary" type="submit" onclick="location.href='../comment/comment_reple.php'" class="submit" style="margin-top:10px;">
                                                  <i class="fa fa-check"></i>
                                                  등록하기
                                                </button>
                                              </div>
                                            </div>
                                          </div>
                                        </form>
                                        <!--답글수정폼-->
                                        <form action="../comment/comment_modify.php" method="POST">
                                          <input type = "hidden" name="b_num" value="<?php echo $row[NUM];?>">
                                          <input type = "hidden" name="perm" value="<?php echo $_SESSION["permission"];?>">
                                          <input type = "hidden" name="no" value="<?php echo $crow[NO];?>">
                                          <input type = "hidden" name="email" value="<?php echo $crow[email];?>">
                                          <input type = "hidden" name="partition_page" value="<?php echo $_GET['no'];?>">
                                          <input type = "hidden" name="group_num" value="<?php echo $crow[GROUP_NUM]?>">
                                        <div class="comment-form" id = "comment-modify-rise-<?php echo $crow[NO];?>" style = "display:none">
                                          <div class="row">
                                            <div class="col-xs-12">
                                              <textarea class="form-control" placeholder="내용을 입력하세요." name="comment" rows="2"></textarea>
                                              <button class="btn btn-primary" type="submit" onclick="location.href='../comment/comment_modify.php'" class="submit" style="margin-top:10px;">
                                                <i class="fa fa-check"></i>
                                                수정하기
                                              </button>
                                            </div>
                                          </div>
                                        </div>
                                      </form>
                                          </div>
                                        </div>
                                      </li>
                                    </ol>
                            </div>
                                    <?php
                                      }
                                    ?>
          </div>
            <div class="col-xs-2 text-left">
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
    <script type="text/javascript">
    function showmydiv(param,param2) {
      var con;
      var con2;
      con = document.getElementById("comment-rise-"+param2);
      con2 = document.getElementById("comment-modify-rise-"+param2);
        if(param=='write'){
          if(con.style.display =='none' ){
              con.style.display = 'block';
              con2.style.display ='none';
          }
          else{
            con.style.display='none';
            con2.style.display='none';
          }

        }
        else{
          if(con2.style.display =='none'){
            con2.style.display = 'block';
            con.style.display= 'none';
          }
          else{
            con.style.display='none';
            con2.style.display='none';
          }

        }

   }
    </script>


    <script type="text/javascript">
    function showfile(id){
      obj=document.getElementById(id)

      if(obj.style.display == "none"){
        obj.style.display="inline";
      }
      else{
        obj.style.display="none";
      }
    }
    </script>
  </body>
</html>
