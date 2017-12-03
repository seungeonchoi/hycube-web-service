<?php
  if(!strcmp($_SESSION['permission'],'normal')||!isset($_SESSION['email'])){
    echo '<script>alert("다운로드 권한이 없습니다. 관리자에게 문의하세요.")
          location.href = "../main.php";
    </script>';
    exit;
  }
  $Finame = $_GET['filename'];
  $DownPath = "../noticefile/".$Finame;
  $exname = explode('^',$Finame);
  Header("Content-Type: file/unknown");
  Header("Content-Disposition: attachment; filename=". $exname[1]);
  Header("Content-Length: ".filesize("$DownPath"));
  Header("Content-Transfer-Encoding: binary ");
  Header("Pragma: no-cache");
  Header("Expires: 0");
  flush();

  if($fp=fopen("$DownPath", "r")){
    print fread($fp, filesize("$DownPath"));
  }
  fclose($fp);

 ?>
