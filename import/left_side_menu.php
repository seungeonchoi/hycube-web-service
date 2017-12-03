<?php
$username="user";//$_SESSION["username"];
$email = "email";//$_SESSION["email"];
$permission = "operator";
$profile = "profile";//$_SESSION["profile"];
/*
$host = 'localhost';
$user = 'root';
$pw = 'wkfyrnwhtlqka1';
$db = 'login';
$mysqll = new mysqli($host,$user,$pw,$db);

$userlevel = $_SESSION['level'];
//레벨업
if($_SESSION['EXP']>(100*$_SESSION['level']-1)-1){
  mysqli_query($mysqll,"UPDATE login SET EXP=EXP-100*$userlevel WHERE email='$email'");
  mysqli_query($mysqll,"UPDATE login SET level = level+1 WHERE email='$email'");
  $_SESSION['EXP'] = $_SESSION['EXP']-100*$_SESSION['level'];
  $_SESSION['level'] = $_SESSION['level']+1;
}
$Nowuser = mysqli_query($mysqll,"SELECT*FROM login WHERE email='$email'");
$userdata = mysqli_fetch_assoc($Nowuser);
*/
$userhealth = 100;//$userdata['health'];
$userEXP = 100;//$userdata['EXP'];



//총체력
$full_health;
if(!strcmp($permission,'hycube')){
  $full_health=200+(1)*20;
}
else if(!strcmp($permission,'normal')){
  $full_health=150+(1)*10;
}
else if(!strcmp($permission,'operator')){
  $full_health=400+(1)*40;
}else{
  $full_health=9999;
}
?>
<div class="col-md-3 left_col">
  <div class="left_col scroll-view">
    <div class="navbar nav_title" style="border: 0;">
      <a href="../main.php" class="site_title"><i class="fa fa-cube"></i> <span>Hycube w2016</span></a>
    </div>
    <div class="clearfix"></div>
    <!-- 프로필 -->
    <div class="profile clearfix">
      <div class="profile_pic">
        <?php if($profile!=NULL){ ?>
        <img src="../profile/<?php echo $profile;?>" alt="" class="img-circle profile_img" height="58" />
        <span class="image_badge bg-green"><?php echo "1";?></span>

        <?php }else{ ?>
          <?php if(isset($email)){ ?>
            <img src="../import/images/user.png" alt="" class="img-circle profile_img" height="58" />
            <span class="image_badge bg-green"><?php echo "1";?></span>

          <?php }else{ ?>
            <img src="../import/images/user.png" alt="" class="img-circle profile_img" height="58" />

            <?php } ?>
        <?php } ?>
      </div>
      <div class="profile_info">
        <h2>
          <?php
          /*
          로그인받은 email 값이 있는지 검사
          */
            if(true){
                echo "".
                "".$username."".'님 환영합니다';
            }

            else{
              echo "로그인후 이용해 주세요".
               "<br>";
            }
           ?>
        </h2>
        <?php if(true){?>
        <div href="#" data-toggle="tooltip" data-placement="bottom" title="체력 : <?php echo $userhealth;?>/<?php echo $full_health;?>">
          <div class="progress progress_sm" style="width: 100%;">
            <div class="progress-bar bg-red" role="progressbar" data-transitiongoal="<?php echo (100*$userhealth)/$full_health;?>"></div>
          </div>
        </div>
        <div href="#" data-toggle="tooltip" data-placement="bottom" title="다음 레벨까지 : <?php echo "2"?>/<?php echo 100*$userdata['level'];?>">
          <div class="progress progress_sm" style="width: 100%;">
            <div class="progress-bar bg-yellow" role="progressbar" data-transitiongoal="<?php echo "2";?>"></div>
          </div>
        </div>
        <?php }?>
      </div>
      <div class = "profile_signup">
        <?php if(!isset($email)){?>
        <button id="link_signup" class="btn btn-primary left-sm" type="button">Sign up Account</button>
        <?php } ?>
      </div>
    </div>
    <!-- /프로필 -->
    <br />
    <!-- 메뉴 버튼 -->
    <div class="glyphicons_menu">
      <ul class = "bs-glyphicons-list">
        <div class="bs-glyphicons">
          <?php if(!isset($email)){?>
          <li id= "link_login">
            <a href="../login/login.php">
              <span class="glyphicon glyphicon-log-in" aria-hidden="true"></span>
              <span class="glyphicon-class">Login</span>
            </a>
          </li>
        <?php } ?>
          <li id= "link_home">
            <a href="../main.php">
              <span class="glyphicon glyphicon-home" aria-hidden="true"></span>
              <span class="glyphicon-class">Home</span>
            </a>
          </li>
          <li id= "link_board">
            <a href="../board/board.php">
              <span class="glyphicon glyphicon-comment" aria-hidden="true"></span>
              <span class="glyphicon-class">Forum</span>
            </a>
          </li>
          <li id="link_notice">
            <a href="../notice/notice_board.php">
              <span class="glyphicon glyphicon-volume-up" aria-hidden="true"></span>
              <span class="glyphicon-class">Notice</span>
            </a>
          </li>
          <?php if(isset($email)){?>
          <!-- <li id= "link_setting">
            <a href="../login_modify/modify_check.php">
              <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
              <span class="glyphicon-class">Settings</span>
            </a>
          </li> -->
          <?php } ?>
          <li id="link_about">
            <a href="../about/about.php">
                    <span class="glyphicon glyphicon-question-sign" aria-hidden="true"></span>
                    <span class="glyphicon-class">About</span>
            </a>
          </li>
          <li id="link_contact">
            <a href="../contact/contact.php">
                    <span class="glyphicon glyphicon-info-sign" aria-hidden="true"></span>
                    <span class="glyphicon-class">Contact</span>
            </a>
          </li>

        </div>
      </ul>
    </div>
    <div class="glyphicons_menu" style="margin-top:150px;">
      <ul class = "bs-glyphicons-list">
        <div class="bs-glyphicons">
          <?php if((!strcmp($permission,'imthebest')) || (!strcmp($permission,'operator'))){?>
          <li id= "link_monitor">
            <a href="../admin_settings/admin_settings.php">
              <span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span>
              <span class="glyphicon-class">Monitor</span>
            </a>
          </li>
          <?php }?>
          <?php if(!strcmp($permission,'imthebest')){?>
          <li id= "link_operator">
            <a href="../mypage/humanresource_form.php">
                    <span class="glyphicon glyphicon-user" aria-hidden="true"></span>
                    <span class="glyphicon-class">Operator</span>
            </a>
          </li>
          <?php }?>

        </div>
      </ul>
    </div>
    <!-- /메뉴 버튼 -->
    <!-- 메뉴 하단 버튼 -->
    <div class="sidebar-footer hidden-small">
      <?php if(isset($email)){?>
      <a data-toggle="tooltip" data-placement="top" title="Settings" href="../login_modify/modify_check.php">
        <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
      </a>
        <?php }else{?>
      <a data-toggle="tooltip" data-placement="top" title="Settings" href="../login/login.php">
        <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
      </a>
      <?php }?>
      <a data-toggle="tooltip" data-placement="top" title="About" href="../about/about.php">
        <span class="glyphicon glyphicon-question-sign" aria-hidden="true"></span>
      </a>
      <a data-toggle="tooltip" data-placement="top" title="Contact" href="../contact/contact.php">
        <span class="glyphicon glyphicon-info-sign" aria-hidden="true"></span>
      </a>
      <?php if(isset($email)){?>
      <a data-toggle="tooltip" data-placement="top" title="Logout" href="../login/logout.php">
        <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
      </a>
      <?php }else{?>
      <a data-toggle="tooltip" data-placement="top" title="Login" href="../login/login.php">
        <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
      </a>
    <?php }?>
    </div>
    <!-- /메뉴 하단 버튼 -->
  </div>
</div>
