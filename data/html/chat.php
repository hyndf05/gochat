<!DOCTYPE html>
<html>
  <head>
    <?php require('../../data/html/head-subs.php') ?>
    <title>Go - <?php echo $t; ?></title>
    <?php require('../../data/html/head-files.php') ?>
  </head>
  <body class="ins">
    <?php require('../../data/html/noscript.php'); ?>
    <div class="gochat">
      <div class="header">
        <div class="inner">
          <div class="header-logo">
            <span>G</span>
          </div>
          <div class="header-box"></div>
          <div class="header-aside">
            <span class="material-symbols-outlined">menu</span>
          </div>
        </div>
      </div>
      <div class="container">
        <div class="chatlist"></div>
        <div class="sample">
          <div class="sample-username">
            <textarea id="user" placeholder="닉네임" maxlength="16"></textarea>
          </div>
        </div>
        <div class="write">
          <div class="w-text">
            <textarea id="msg" placeholder="메세지를 입력하세요"></textarea>
          </div>
          <div class="w-send">
            <span class="material-symbols-outlined">send</span>
          </div>
        </div>
      </div>
    </div>
    <script type="module" src="/data/scripts/chat.js"></script>
  </body>
</html>