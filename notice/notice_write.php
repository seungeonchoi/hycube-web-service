<!DOCTYPE html>
<html lang="en">
  <head>
		<?php
			if(strcmp($_SESSION['notice'],'on')){
				echo '<script>
							alert("쓰기 권한이 없습니다.\n관리자에게 문의하세요.")
							location.href = "../main.php"
				</script>';
				exit;
			}

      if($_SESSION['health']<40){
        echo '<script>alert("체력이 부족합니다.")</script>';
        echo("<meta http-equiv='refresh' content='1; url=../main.php'>");
        exit;
      }
		?>
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
        <?php include("../import/left_side_menu.php"); ?>
        <!-- /좌측 사이드메뉴 -->
        <!-- 상단 프로필 메뉴 -->
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
                    <img src="../images/ahri.png" alt="">  <?php
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
                    <li><a href="#"> Profile</a></li>

                    <li><a href="../login_modify/modify_check.php"><span>Settings</span></a></li>
                    <li><a href="../login/logout.php"><i class="fa fa-sign-out pull-right"></i> Log Out</a></li>
                  </ul>
                  <?php }else{ ?>
                    <ul class="dropdown-menu dropdown-usermenu pull-right">

                    </ul>
                  <?php } ?>
                  <!-- /드롭다운 리스트 -->
                </li>


              </ul>
            </nav>
          </div>
        </div>
        <!-- /상단 프로필 메뉴 -->

        <!-- 페이지 내용 -->
        <div class="right_col" role="main">
          <div class="row padding">
            <h3 style="margin-top : 50px;">쓰기</h3>
            <!-- form 은 이 주석 바로 밑에 있습니다. -->
              <form class="form-horizontal" id="form_main" enctype="multipart/form-data" action="" method="POST" >
              <div class="form-group">
                  <!--제목 -->
                  <input type="text" class="form-control" name="title" placeholder="제목을 입력하세요..">
              </div>
                  <!-- 내용 -->
              <div class="form-group">
                  <!-- 내용쓰는창에 기존에 써있던 글 출력-->
                  <textarea class="form-control" rows="5" name="comment" id="summernote" style="display: none;"></textarea>
              </div>
                <!--파일 첨부 -->
            <div class="form-group">
              <input type="file" class="file_upload" name="filefield[]" id="upload" multiple="multiple" style="display:none">
              <button type="button" id="file_dialog" class="btn btn-success">Select file</button>
              <div class="dropzone" id="dropzone">
                Click or Drag & Drop Files Here
              </div>
            </div>
            <div class="form-group" style="margin-right:200px;float:right">
                    <input type="button" type="button" class="btn btn-success" onclick="postForm()" value="submit">
                    <button type="button" class="btn btn-primary" onclick="history.back()">Back</button>
            </div>
            </form>
					</div>
        </div>
        <!-- /페이지 내용 -->
        <!-- 풋터 내용 -->
        <footer>
          <div class="pull-left">
            <h3 class="kor">HYCUBE</h3>
            <p>
              경기도 안산시 상록구 한양대학로 55 한양대학교 ERICA캠퍼스

              4공학관 1층 SMASH 학습전용공간</p>
          </div>
          <div class="clearfix"></div>
        </footer>
        <!-- /풋터 내용 -->
      </div>
    </div>
    <script src="../js/custom.js?val=ec89742"></script>
    <script>
		$('#summernote').summernote({
			width : 825,
		  height: 400,                 // set editor height
		  minHeight: null,             // set minimum height of editor
		  maxHeight: null,             // set maximum height of editor
		                 // set focus to editable area after initializing summernote
		});
    var data; // sbumit시에 ajax에 보낼 파일 object들의 집합
    var count = 0 ; // 파일 카운트 -> 고유한 id 부여를 위해 만들었습니다.
    var pass = false; // pass가 true일 경우만 페이지가 넘어갑니다


        $(function () {


         var obj = $("#dropzone");

         //////// select file 버튼 클릭시 이벤트
         $("#file_dialog").on('click', function(e){
           if(!data){
              data = {};
              obj.html("");
              console.log("dataform created!  ")
            }
            $("#upload").trigger("click");
            console.log("upload_triggered");
         });
         /////
         //// 드래그된 상태에서 업로드 상자에 진입시
         obj.on('dragenter', function (e) {
              e.stopPropagation();
              e.preventDefault();
              $(this).css('border', '2px solid #5272A0');
         });
         //// 드래그된 상태에서 업로드 상자에서 나올시
         obj.on('dragleave', function (e) {
              e.stopPropagation();
              e.preventDefault();
              $(this).css('border', '2px dotted #8296C2');
         });
         ///
         //// 드래그된 상태에서 업로드 상자위에 있을시
         obj.on('dragover', function (e) {
              e.stopPropagation();
              e.preventDefault();
         });
         ///
         //// 드래그된 상태에서 업로드 상자위에 있을시
         //// 업로드 상자위에 파일 드랍 이벤트 발생시
         obj.on('drop', function (e) {

           if(!data){

             data = {};
             $(this).html(""); // 드랍 이벤트 발생 시 글씨를 지움
             console.log("dataform created!  ");
            }
              e.preventDefault(); // stopPropagation이 없는데 왜 뺐는지 기억이 안남
              $(this).css('border', '2px dotted #8296C2');
              $(this).css('font-size', '14px');
              $(this).css('color', '#262825');

                var files = e.originalEvent.dataTransfer.files; //이벤트 발생시킨 파일 객체 가져오기
              if(files.length < 1){
                   return;
                 }
              //// 파일마다 루프를 돕니다.
              for (var i = 0; i < files.length; i++){
                  count++;
                  data['file-'+ count ] = files[i]; // data에 고유한 키와 함께 파일 추가
                  console.log("data name : " + files[i].name);
                  ////업로드 상자안에 파일 이름 추가
                  $(this).append("<div class=\"text-left file_wrapper\" id=\"file-"+ count + "\"><span class=\"name_wrapper\">"+files[i].name+"</span><span class=\"glyphicon glyphicon-minus\"></span></div>");
                  ////
                  ////업로드 상자안에 파일 이름이 있고 그 오른쪽에 '-'버튼이 있음
                  ////'-'버튼 클릭시 이벤트 발생
                  $("#file-" + count).on('click', function(e){
                    e.stopPropagation();
                    e.preventDefault();
                    console.log(this);
                    var name = this.firstChild.innerHTML; //파일 이름 따오기
                    console.log("name : " + name);
                    console.log("file-" + $(this).attr('id').split("-")[1]);
                    //// data에서 해당 id를 가지고 있는 파일 삭제
                    delete data["file-" + $(this).attr('id').split("-")[1]];
                    ////
                    //ES6문법은 IE11에서 지원이 안됨
                    //values.forEach(values => data.append('file[]',values));
                    /*for (var value of data.values()) {
                      console.log(value);
                    }*/
                    //
                    this.parentElement.removeChild(this);
                  })
                  }
              ////
         });
         //// 파일 선택시 이벤트 발생
         ///  설명은 obj.on('drop', function (e)~ 부터 참조바람
        $("#upload").change(function(e) {
          $("#dropzone").css('border', '2px dotted #8296C2');
          $("#dropzone").css('font-size', '14px');
          $("#dropzone").css('color', '#262825');
          var filelist = document.getElementById("upload").files || []; // 마지막으로 저장된 파일객체 불러오기
          for (var i = 0; i < filelist.length; i++) {
            console.log("data name : " + filelist[i].name);
            count++;
            data['file-'+ count] = filelist[i];
            obj.append("<div class=\"text-left file_wrapper\" id=\"file-"+ count + "\"><span class=\"name_wrapper\">"+filelist[i].name+"</span><span class=\"glyphicon glyphicon-minus\"></span></div>");
            $("#file-" + count).on('click', function(e){
              e.stopPropagation();
              e.preventDefault();
              var name = this.firstChild.innerHTML;
              console.log("deleted name : " + name);

              /*
              for (var value of data.values()) {
                console.log(value);
              }
              */
              delete data["file-" + $(this).attr('id').split("-")[1]];

              /*values
                .filter(values => values.name !== name)
                .forEach(values => data.append('file[]',values));
                */

              /*for (var value of data.values()) {
                console.log(value);
              }*/
              this.parentElement.removeChild(this);
            })
          }
          $("#upload").val(""); //똑같은 파일 지웠다 올릴시 change함수가 발동하지 않습니다.
        });
        ////
    });
    //// Submit 클릭시 이 함수가 작동합니다
    function postForm() {
              var abc = document.getElementById("form_main"); //form에서 정보들을 얻습니다
              var form = new FormData(abc);//그라고 얻은 정보를 통하여 다른 폼객체를 생성합니다
              //// data에 있던 파일 객체들을 루프 돌면서 form에 추가합니다.
              for (var key in data) {
                form.append("file[]", data[key]);
                console.log("data append : "+data[key]);
              }

              ////
              console.log("postForm()");
              for(var key in form){
                console.log(form[key]);
              }
              console.log("===data.getAll===");
              console.log("===data.getAll===");
              ////나중에 게시판 글 내용 업로드가 안될때 비상용 함수
              $('textarea[name="comment"]').val($('#summernote').summernote('code'));
              ////

              try{
                var url ='../notice/notice_submit.php';
                ////form을 ajax에 실어서 보냅니다.
                $.ajax({
                  url: url,
                  method: 'post',
                  data: form,
                  dataType: 'json',
                  processData: false,
                  contentType: false,
                  success: function(res) {
                    if(res)
                    {
                      var result = res.split("-");
                      console.log("====form_Sent====");
                      console.log("message : " + res);
                      if(result[0] == "permission_error")
                      {
                        alert("권한이 없습니다. 관리자에게 문의하세요");
                        location.href=history.back();
                      }
                      else if(result[0] == "health_error"){
                        alert("체력이 부족합니다.");
                      }
                      else if(result[0] == "no_title"){
                        alert("제목이 없습니다.");
                      }
                      else if(result[0] == "no_comment"){
                        alert("내용이 없습니다.");
                      }
                      else if(result[0] == "exist_error file"){
                        alert(result[1] +" 파일은 이미 존재하는 파일입니다.");
                      }
                      else if(result[0] == "filetype_error file"){
                        alert(result[1] + "은(는) 허용되지 않는 확장자입니다.");
                      }
                      else if(result[0] == "length_error file"){
                        alert(result[1] + " 파일의 제목이 제한길이를 초과하였습니다.");
                      }
                      else if(result[0] == "totalsize_error"){
                        alert("총 파일 용량은 1Mbyte 입니다.");
                      }
                      else if(result[0] == 'fail'){
                        alert("작성 실패");
                      }

                      else{
                        alert("작성 완료");
                        console.log("confirmed");
                        pass = true;
                      }

                    }
                    else{
                      console.log("====form_Failed====");
                    }
                  },
                  error: function(request,status,error) {
                      alert("code:"+request.status+"\n"+"message:"+request.responseText+"\n"+"error:"+error);
                      return false;
                    }
                  });
                  ////
                } catch (e) {
                    if (window.bridgeGotTime) {
                        throw e;
                    } else {
                    }
                }
                //// ajax함수 실행 완료시 호출됨
                $(document).ajaxStop(function () {
                  if(pass){
                    location.href = "notice_board.php";
                  }
                });
                ////
            }
		 </script>

  </body>
</html>
