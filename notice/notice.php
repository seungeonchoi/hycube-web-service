

<div class = "row">
  <div class="notice_wrapper">




<h3>NOTICE</h3>
      <!--DB 접속 코드-->
<?php include "notice_db_info.php";?>
  <!--공지사항 권한 코드-->
<?php if(!strcmp($_SESSION['notice'],'on')){?>
  <!-- 공지사항 작성버튼-->
<button type="button" class="btn btn-success" onclick="location.href='/notice/notice_write.php'";;>New Notice</button>
<?php }else{}?>

<!-- 공지사항 버튼입니다. 클릭 시 data-target에 id를 지정하여 해당 id에 내용을 표시합니다. -->
<div id = "accordion" style="margin-top:10px">
  <div class="panel">
      <?php

        $result = mysqli_query($mysqli,'SELECT*FROM notice ORDER BY pk DESC LIMIT 5');


        while($notice = mysqli_fetch_array($result)){
          $pk = "#".$notice[pk]." ";
          //파일있는지 여부확인
          $number = $notice[pk];
          $File_count = mysqli_query($mysqli,"SELECT*FROM FileName WHERE pk=$number");


          $File_exist=0;

          if($Fname = mysqli_fetch_assoc($File_count)){
            $File_exist=1;
          }


      ?>
        <button id=<?php echo "button-".$notice[pk]." ";?> class="list-group-item" data-toggle="collapse" data-target=<?php echo $pk;?> data-parent="#accordion">
          <h4 class="list-group-item-heading kor dropdown-toggle" >
            <span id=<?php echo "title_list-".$notice[pk]." ";?>><?php echo "$notice[title]";?></span>
            <?php if($File_exist){?>
                    <span class="glyphicon glyphicon-paperclip" aria-hidden="true"></span>
            <?php }?>
            <span class="caret" style="float:right;margin-top:15px;" ></span></h4>
            <span><?php echo $notice[date]?></span>
        </button>
      <?php }
      $i=0;
      $res = mysqli_query($mysqli,'SELECT*FROM notice ORDER BY pk DESC LIMIT 5');
      $arr = array();
      while($comm=mysqli_fetch_array($res)){?>
        <!-- 버튼을 누르먄 표시될 요소들의 목록들입니다.-->
      <div id=<?php echo "".$comm[pk]." ";?> class="collapse panel panel-default padding-sm" data-parent="#accordion" style="position:relative">
        <h3 class id=<?php echo "title-".$comm[pk]." ";?> = "kor"><?php echo $comm[writer];?></h3>
        <!--첨부파일-->
        <?php $ForFile = mysqli_query($mysqli,"SELECT*FROM FileName WHERE pk=$comm[pk]");
              $File_exist = mysqli_query($mysqli,"SELECT count(*) FROM FileName WHERE pk = $comm[pk]");
              $count = mysqli_fetch_assoc($File_exist);
              if($count['count(*)']!=0){?>
                <div class="wrapper" style="position:absolute; right:10px; z-index:5">
                    <header>
                        <button style="float:right" onclick="showfile('navigation-list+<?php echo $i?>');">
                        <span class="menuBtn" style="font-weight:bold">첨부파일 <span style="color:red; font-weight:bold">(<?php echo $count['count(*)']?>)</span></span>
                      </button>
                        <nav id="navigation-list+<?php echo $i?>" style="display:none">
                            <div style="float:right; border:1px solid gray; width:80%; background-color:white">
                              <ul>
                            <?php
                              while($Finame = mysqli_fetch_assoc($ForFile)){
                                  array_push($arr,$Finame['filename']);
                                  ?>
                                <li><a id=<?php echo "filename-".$comm[pk]." ";?> style= "font-weight:bold" href="notice/notice_download.php?filename=<?php echo $comm[pk].'^'.$Finame['filename']?>"><?php echo $Finame['filename'];?></a></li>
                                <?php }?>
                              </ul>
                          </div>
                        </nav>
                    </header>
                </div>

              <?php
                $i++;
              }?>
              <!-- 공지사항 내용-->
          <div id=<?php echo "comment-".$comm[pk]." ";?>><?php echo $comm[comment];?></div>
          <div class = "row">


        <!--modify 클릭시 notice.js폴더내의 함수로 넘어갑니다. -->
        <!-- delete는 바로 notice_delete.php로-->
        <?php if(!strcmp($_SESSION['notice'],'on')){
                if(!strcmp($comm[writer],'Admin')){
                  if(!strcmp($_SESSION['permission'],'imthebest')){?>
                   

                    <form action = 'notice/notice_rewrite.php' method = "POST">
                      <input type = 'hidden' name = 'id' value = '<?php echo $comm[pk];?>'>
                      <input type = 'hidden' name = 'title' value = '<?php echo $comm[title];?>'>
                      <input type = 'hidden' name = 'comment' value = '<?php echo $comm[comment];?>'>
                    <button type="submit" style="float:left" class="btn btn-info">Modify</button>
                    </form>
                    <form action="notice/notice_delete.php" method="POST">
                    <input type='hidden' name='writer' value='<?php echo $comm[writer]?>'>
                    <?php for($i=0;$i<count($arr);$i++){?>
                    <input type='hidden' name='file[]' value='<?php echo $arr[$i];?>'>
                    <?php }?>
                    <input type='hidden' name='id' value='<?php echo $comm[pk]?>'>
                    <button type="submit" style="float:right" class="btn btn-danger";;>Delete</button>
                    </form>

            <?php }
                }
                else{?>
                  <form action = 'notice/notice_rewrite.php' method = "POST">
                    <input type = 'hidden' name = 'id' value = '<?php echo $comm[pk];?>'>
                    <input type = 'hidden' name = 'title' value = '<?php echo $comm[title];?>'>
                    <input type = 'hidden' name = 'comment' value = '<?php echo $comm[comment];?>'>
                  <button type="submit" style="float:left" class="btn btn-info">Modify</button>
                </form>
                <form action="notice/notice_delete.php" method="POST">
                  <input type='hidden' name='writer' value='<?php echo $comm[writer]?>'>
                  <?php for($i=0;$i<count($arr);$i++){?>
                  <input type='hidden' name='file[]' value='<?php echo $arr[$i];?>'>
                  <?php }?>
                  <input type='hidden' name='id' value='<?php echo $comm[pk]?>'>
                  <button type="submit" style="float:right" class="btn btn-danger";;>Delete</button>
                </form>
            <?php }
                ?>

        <?php }else{}?>
        </div>
      </div>

    <?php }?>
    </div>
  </div>
</div>
</div>
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
</script>
