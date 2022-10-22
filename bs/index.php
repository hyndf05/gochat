<?php
if (isset($_POST['createServerFinal'])) {
  sleep(2);
  $title = $_POST['title'];
  $pw = $_POST['password'];
  $serverId = $_POST['serverId'];
  echo '<span id="serverId" style="display:none;">'.$serverId.'</span>';
  mkdir('server/'.$serverId.''); # 폴더 생성
  $file = fopen('server/'.$serverId.'/index.php', 'w') or die('Unable to open file!'); # 폴더에 index.php 파일 생성.
  $html = '<?php $t="'.$title.'"; require("../../data/html/chat.php"); ?>';
  fwrite($file, $html);
  fclose($file);
  echo '<script>location.href="/server/'.$serverId.'";</script>';
}
?>
<!DOCTYPE html>
<html>
  <head>
    <?php require('../data/html/head-subs.php') ?>
    <title>Go - prealpha v1.0.0</title>
    <style>iframe{width:100%;height:100%;outline:none;border:0;background-color:#ffffff;}*{overflow:hidden;}*::-webkit-scrollbar{display:none;}span{position: fixed;top: 11vw;left: 0;z-index: -1;right: 0;text-align: center;}</style>
    <?php require('../data/html/head-files.php') ?>
  </head>
  <body>
    <span>처리 중..</span>
    <iframe src="/"></iframe>
    <?php
    $serverIdQ = $_GET['s'];
    $serverIdQLen = strlen($serverIdQ);
    if ($serverIdQLen > 0) {
      if (file_exists('../server/'.$serverIdQ.'/index.php')) {
        echo '<script defer>$("iframe").attr("src", "/server/'.$serverIdQ.'");</script>';
      } else {
        echo '<script defer>$("iframe").attr("src", "/data/pages/server/notfound");</script>';
      }
    }
    ?>
  </body>
</html>