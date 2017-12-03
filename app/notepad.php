<?php
session_start();
$username = $_SESSION["username"];
$enabled = $_SESSION["enabled"];
?>
<!DOCTYPE html>
<html lang="ko">
<head>
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">

    <link rel="stylesheet" href="/css/default.css">
    <link rel="stylesheet" href="/app/notepad/notepad.css">
    <script src=/script/common.js>
    </script>
    <script src="/app/notepad/notepad.js">
    </script>
</head>
<body>
<div class="header">
    <div class="logo">
        <h1>HYCUBE</h1>
        <div class="explain web">Information Security Institute of Hanyang University</div>
        <div class="mobile mlogin">
            <img class="img_user_mobile" src="/img/user.png">
        </div>
    </div>

</div>
<?php
include $_SERVER['DOCUMENT_ROOT'] . '/choi/topnav.php'
?>
<?php
include $_SERVER['DOCUMENT_ROOT'] . '/choi/sidenav.php'
?>

<div id="container" class="container">
    <?php
    if ($username != "" && $enabled == "1") {
        ?>
        <div class="notepad_section"  style="height: 800px">
            <h2>WYSIWYG Editor</h2>
            <form method="post" action="/app/notepad/notepad_result.php" enctype="multipart/form-data" id="rtf">

                <br>
                <textarea name="textarea" id="textarea" style="display: none;"></textarea>

                <br><br>
                <input type="button" onclick="formsubmit('textarea','rtf')" value="post">
            </form>


        </div>

        <?php
    } else {
        ?>
        <div class="unauthorized">
            <h1>permission denied</h1>
        </div>
        <?php
    }
    ?>

</div>
<!-- List of Modals -->
<?php include $_SERVER["DOCUMENT_ROOT"] . '/choi/modal.php'; ?>
<div id="footer">
    <h1>HYCUBE</h1>
    <p>경기도 안산시 상록구 한양대학로 55 한양대학교 ERICA캠퍼스 4공학관 1층 SMASH 학습전용공간</p>
</div>

</script>
<?php
if ($username != "" && $enabled == 0) {
?>
<
script >
modal('activation');
    </script>
<?php
}
?>
</body>
</html>
