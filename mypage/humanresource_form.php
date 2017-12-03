<!DOCTYPE html>
<html lang="en">
  <head>
    <?php include("../import/config_alt.php");?>
    <?php
    $username=$_SESSION["username"];
    $email = $_SESSION["email"];
    $permission = $_SESSION["permission"];
    ?>
    <?php include "member_list.php";?>
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
          <h2>관리자페이지입니다.</h2>
            <?php
              $username=$_SESSION["username"];
              $email = $_SESSION["email"];
              $permission = $_SESSION["permission"];
            ?>

              <!--form은 여기에 action-->
                <table border=1 cellspacing=0 width=1000 bordercolordark=white bordercolorlight=#999999>
                  <tr>
                      <td width=70 bgcolor=#CCCCCC>
                          <h4><strong><p align=center>회원등급</p></h4></strong>
                      </td>
                      <td bgcolor=#CCCCCC width=400>
                        <h4><strong><p align=center>회원아이디</p></h4></strong>
                      </td>
                       <td width=180 bgcolor=#CCCCCC>
                        <h4><strong><p align=center>비밀번호</p></h4></strong>
                      </td>
                      <td width=100 bgcolor=#CCCCCC>
                        <h4><strong><p align=center>운영자지정</p></h4></srong>
                      </td>
                      <td width=100 bgcolor=#CCCCCC>
                        <h4><strong><p align=center>운영자강등</p></h4></srong>
                      </td>
                      <td width=100 bgcolor=#CCCCCC>
                        <h4><strong><p align=center>추방하기</p></h4></srong>
                      </td>
                  </tr>



          <Form>
                  <table border=1 cellspacing=0 width=1000 bordercolordark=white bordercolorlight=#9999999>

                      <?php
                        while($row = mysqli_fetch_array($result)){
                      ?>
                      <tr>
                          <td width=70 bgcolor=white>
                              <p align=center><?php echo $row[permission]; ?></p>
                          </td>
                          <td bgcolor=white width=400>
                              <p align=center><?php echo $row[email]; ?></p>
                          </td>
                           <td width=180 bgcolor=white>
                              <p align=center><?php echo $row[password];?></p>
                          </td>
                          <td width=100 bgcolor=white>
                              <Form id= "form">
                                <p align = center>
                                  <input type="button" value="지정하기" name ="<?php echo $row[email]; ?>"
                                   onclick="location.href='permission_change.php?id=<?php echo $row[email]; ?>'"
                                   >
                              </Form>
                          </td>
                          <td width=100 bgcolor=white>
                            <Form>
                              <p align = center>
                                <input type="button" value="강등"
                                onclick = "location.href='permission_nchange.php?id=<?php echo $row[email];?>'"
                                style="width:150; background-color:#eff7f9; border:1 solid #A0DBE4">
                            </Form>
                          </td>
                          <td width=100 bgcolor=white>
                            <Form>
                              <p align = center>
                                <input type="button" value="추방"
                                onclick = "if (confirm('정말 추방하시겠습니까?')) {location.href='permission_deny.php?id=<?php echo $row[email];?>'
                                          } else {}"
                                style="width:150; background-color:#eff7f9; border:1 solid #A0DBE4">
                            </Form>
                          </td>
                      </tr>
                      <?php

                        }
                      ?>
          </Form>
          </table>



          <!-- 페이지 번호 출력 -->
          <div class="row">
            <div class="col-sm-12 text-center">
              <ul class="pagination">
                <?php
                  if($start_page>$page_list_size){
                ?>
                    <li class="prev"><a href="./humanresource_form.php?no=<?php echo $start_page-$page_list_size;?>"><<</a></li>
                <?php
                  }
                ?>

                <?php
                  for($i = $start_page; $i <= $end_page; $i++){

                    if($no!=$i){
                ?>
                    <li><a href="./humanresource_form.php?no=<?php echo $i ?>"><?php echo $i?></a></li>
                <?php
                    }else{
                ?>
                    <li class="active"><a><?php echo $no?></a></li>
                <?php
                    }
                  }
                  if($total_page > $end_page){
                ?>
                    <li class="next"><a href="./humanresource_form.php?no=<?php echo ($current_block+1)*$page_list_size-($page_list_size-1); ?>">>></a></li>
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
