<!DOCTYPE html>
<html>
  <head>
    <?php require('../data/html/head-subs.php') ?>
    <title>Go</title>
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