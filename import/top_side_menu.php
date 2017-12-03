<div class="top_nav">
  <div class="nav_menu">
    <nav>
      <div class="nav toggle">
        <a id="menu_toggle"><i class="fa fa-bars"></i></a>
      </div>

      <ul class="nav navbar-nav navbar-right">
        <li class="">
          <!-- 상단 프로필 클릭 시 드롭다운 이벤트 발생 -->
          <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
            <div class="profile_pic" style="width:50px;">
              <?php if($profile){?>
              <img src="../profile/<?php echo $profile;?>" alt="">
              </img>
              <?php }else{?>
                <?php if(isset($email)){?>
                  <img src="../import/images/user.png" alt="">
                  </img>
                <?php }else{?>
                  <img src="../import/images/user.png" alt="">
                  </img>
                  <?php }?>
              <?php }?>
            </div>
            <?php
              /*
              로그인받은 email 값이 있는지 검사
              */

                if(isset($email)){
                    echo "".$username."".'님 환영합니다 '.
                    '<span class=" fa fa-angle-down"></span>';
                }

                else{
                  echo "로그인후 이용해 주세요";

                }
               ?>

          </a>
          <!-- /상단 프로필 클릭 시 드롭다운 이벤트 발생 -->
          <!-- 드롭다운 리스트 -->
          <?php if(isset($email)){?>
          <ul class="dropdown-menu dropdown-usermenu pull-right">
            <li><a href="../login_modify/modify_check.php"><span>Settings</span></a></li>
            <li><a id="logout" href="../login/logout.php"<i class="fa fa-sign-out pull-right"></i> Log Out</a></li>
          </ul>
          <?php }else{ ?>
            <ul class="dropdown-menu dropdown-usermenu pull-right">
              <li><a href="../login/login.php"><span>Login</span></a></li>
            </ul>
          <?php } ?>
          <!-- /드롭다운 리스트 -->
        </li>


      </ul>
    </nav>
  </div>
</div>
