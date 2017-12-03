<!-- 프로필 변경 -->
<div class="row">
<h3>Modify Profile</h3></br>
<div class="col-md-3">
    <?php if($profile!=NULL){?>
      <div id='d_pro'>
        <img src="../profile/<?php echo $profile;?>" alt="" class="img-thumbnail" width="200" height="200">
      </div>
    <?php }else{?>
      <?php if(isset($email)){?>
      <div id='d_pro'>  <img src="../import/images/user.png" alt="" class="img-thumbnail" width="200" height="200">  </div>
      <?php }else{?>
      <div id='d_pro'>  <img src="../import/images/user.png" alt="" class="img-thumbnail" width="200" height="200">  </div>
        <?php }?>
    <?php }?>
  </br></br></br>
</div>
<div class="col-md-2">
    <form enctype="multipart/form-data" action=profile_up.php method="POST" />
    <article>
    <label class="btn btn-primary btn-file btn-sm">
      이미지 선택<input type="file" style="display: none" name="pro">
    </label>
      <input type='submit' class="btn btn-info btn-sm" value='이미지 전송 ' name=submit >
      <input type='button' class="btn btn-warning btn-sm" value='프로필 삭제' name=submit onclick="location.href='profile_delete.php'">
    </article>
    </form>
</div>

</div>

<h3>Modify Information</h3>
  <?php
    $username=$_SESSION["username"];
    $email = $_SESSION["email"];
    $permission = $_SESSION["permission"];
  ?>

    <!--form은 여기에 action-->
    <form class="form-horizontal" id="form_main" action="" method="POST" autocomplete="off">
		<div class="form-group">
        <label class="control-label col-sm-2" for="email">Username:</label>
        <div class="col-sm-10">
          <!--사용자 id -->
          <input type="text" name="userid" class="form-control" id="username" value = "<?php echo "".$username .""; ?>" placeholder="Display name">
        </div>
        <div class = "error" id = "iderr">
          <div class="alert alert-danger" id = "iderr_info">

          </div>
        </div>
      </div>
      <div class="form-group">
          <!--이메일  -->
        <label class="control-label col-sm-2" for="email">Email:</label>
        <div class="col-sm-10">
          <!--이메일 중복 체크 : email_check.php -->
          <h4 class = "kor bold"><?php echo "".$email .""; ?></h4>
          <input type="hidden" name="email" class="form-control" id="email" value ="<?php echo "".$email .""; ?> ">
        </div>
        <div class = "error" id = "emailerr">
          <div class="alert alert-danger" id = "emailerr_info">

          </div>
        </div>
      </div>
        <!--비밀번호 -->
      <div class="form-group">
        <label class="control-label col-sm-2" for="pwd">New Password:</label>
        <div class="col-sm-10">
          <input type="password" name="password" class="form-control" id="pwd" placeholder="Enter password">
        </div>
        <div class = "error" id = "pwerr">
          <div class="alert alert-danger" id = "pwerr_info">

          </div>
        </div>
      </div>
      <!--비밀번호 중복 확인 -->
      <div class="form-group">
          <label class="control-label col-sm-2" for="pwd">Confirm Password:</label>
          <div class="col-sm-10">
              <input type="password" name="password" class="form-control" id="pwd_check" placeholder="Enter password">
          </div>
          <div class="error" id="pwd_checkerr">
              <div class="alert alert-danger" id="pwd_checkerr_info">

              </div>
          </div>
      </div>
        <!--제출버튼 -->
      <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
          <button type="button" class="btn btn-success" onclick="Modify_action()";;>Submit</button>
          <div id="right-button-wrapper" style="float:right;margin-right:200px">
            <button type="button" class="btn btn-danger" onclick="if (confirm('정말 탈퇴하시겠습니까?')) {
                                                                                          location.href='modify_delete.php'
                                                                                      } else {}";;>회원탈퇴</button>
            <button type="button" class="btn btn-success" onclick="window.history.back()";;>Back</button>
          </div>


        </div>
      </div>
    </form>
    <!-- 파일 선택 눌렀을시 이미지 나오게 하는 스크립트 -->
    <script>
      var upload = document.getElementsByName('pro')[0];
      var holder = document.getElementById('d_pro');

      upload.onchange = function (e) {
      e.preventDefault();

      var file = upload.files[0];
      var reader = new FileReader();
      reader.onload = function (event) {
        var img = new Image();
        img.src = event.target.result;

        if (img.width > 180) {
          img.width = 180;
        }
        holder.innerHTML = '';
        holder.appendChild(img);
      };
      reader.readAsDataURL(file);

      return false;
      };
  </script>
