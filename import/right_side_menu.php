
  <nav class="navbar navbar-default">
    <div class="container-fluid text-center">
      <div class ="row">
        <div class = "col-sm-12 text-center">
          <?php
          $username=$_SESSION["username"];
          $email = $_SESSION["email"];
          $permission = $_SESSION["permission"];
          ?>


          <h4 class = "kor bold" >
          <?php
	        /*
          로그인받은 email 값이 있는지 검사
          */

            if(isset($email)&&strcmp($permission,'imthebest')){
                echo "".$username."".'님 환영합니다';

            }

            else if(!strcmp($permission,'imthebest')){
                echo '관리자계정';
            }
            else{
              echo "로그인후 이용해 주세요".
               "<br><a href=\"../login/login.php\">로그인하기</a>";
            }
           ?>

           </h4>
           <div class="settings_wrapper" style="float:right">
             <h5 class ="kor bold">
             <?php
   	        /*
             로그인받은 email 값이 있는지 검사
             */

               if(isset($email)&&strcmp($permission,'imthebest')){
                  echo "<a href=\"../login_modify/modify_check.php\">회원정보수정</a><span>|</span>";
                  echo "<a href=\"../mypage/mypage_form.php\">마이페이지</a><span>|</span>";
                  echo "<a href=\"../login/logout.php\">로그아웃</a>";


               }
               else if(!strcmp($permission,'imthebest')){
                   echo "<a href=\"../login_modify/modify_check.php\">관리자정보수정</a><span>|</span>";
                   echo "<a href=\"../mypage/humanresource_form.php\">회원관리</a><span>|</span>";
                   echo "<a href=\"../login/logout.php\">로그아웃</a>";

               }
               else{

               }
              ?>
            </h5>

           </div>

        </div>


      </div>
      <!-- 사용자 ID명 -->




    </div>
    </nav>
    <div class="panel panel-default">
      <div class="panel-body">

          <?php
	        /*
          로그인받은 email 값이 있는지 검사
          */

            if(isset($email)&&strcmp($permission,'imthebest')){
                echo "<h2 class = \"bold\" style = \"color:rgb(115, 56, 8)\">0</h2>";

            }
            else if(!strcmp($permission,'imthebest')){
                echo "<h2 class = \"bold\" >-</h2>";
            }
            else{
              echo "<h2 class = \"bold\" >-</h2>";
            }
           ?>

        <!-- 점수
        <h2 class = "bold" style = "color:rgb(238, 246, 92)">4000</h3> // 그랜드마스터
        <h2 class = "bold" style = "color:rgb(250, 255, 0)>3500~3999</h3> // 마스터
        <h2 class = "bold" style = "rgba(155, 242, 247, 0.99)">3500~3999</h3> // 다이아
        <h2 class = "bold" style = "color:rgb(215, 214, 218)">2500~2999</h3> // 플래티넘
        <h2 class = "bold" style = "color:rgb(226, 245, 6)">2000~2499</h3> // 골드
        <h2 class = "bold" style = "color:rgb(98, 99, 97)">1500~1999</h3> // 실버
        <h2 class = "bold" style = "color:rgb(115, 56, 8)">0~1499</h3> // 브론즈


      -->
      </div>
    </div>
