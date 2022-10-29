<?php
if(isset($_POST['createServerFinal'])) {
  sleep(2);
  $title = $_POST['title'];
  $pw = $_POST['password'];
  $serverId = $_POST['serverId'];
  echo '<span id="serverId" style="display:none;">'.$serverId.'</span>';
  mkdir('s/'.$serverId.''); # create folder
  $file = fopen('s/'.$serverId.'/index.php', 'w') or die('Unable to open file!'); # create index.php on folder which created before
  $html = '<?php $t="'.$title.'"; require("../../data/html/chat.php"); ?>';
  fwrite($file, $html);
  fclose($file);
  echo '<script>location.href="/s/'.$serverId.'";</script>';
}
?>
  
<!DOCTYPE html>
<html>
  <head>
    <?php require('data/html/head-subs.php') ?>
    <title>Go</title>
    <?php require('data/html/head-files.php') ?>
  </head>
  <body>
    <?php require('data/html/noscript.php'); ?>
    <?php require('data/html/aside.php'); ?>
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
        <div class="create">
          <div class="det">
            <span>채팅방 생성</span>
          </div>
          <div class="dex" id="createForm">
            <form action="/#/server?sb=2" method="post" name="roomCreate">
              <input type="text" class="ix" id="serverId" name="serverId" style="display:none;">
              <div class="dex-line">
                <input type="text" class="ix" id="title" name="title" placeholder="제목" required>
              </div>
              <div class="dex-line">
                <input type="password" class="ix" id="password" name="password" placeholder="비밀번호">
              </div>
              <div class="dex-line">
                <input type="submit" id="createServerFinal" name="createServerFinal" value="생성">
              </div>
            </form>
          </div>
        </div>
      </div>
      <div class="footer"></div>
    </div>
<script>
  var serverIdGen = Math.floor((Math.random() * 199299399499599) + 27);
  $('#serverId').val(serverIdGen);
</script>
    <script type="module">
  // Import the functions you need from the SDKs you need
  import { initializeApp } from "https://www.gstatic.com/firebasejs/9.9.2/firebase-app.js";
  import { getAnalytics } from "https://www.gstatic.com/firebasejs/9.9.2/firebase-analytics.js";
  import { getDatabase, ref, set, onValue, update, child, get, remove } from "https://www.gstatic.com/firebasejs/9.9.2/firebase-database.js";
  // TODO: Add SDKs for Firebase products that you want to use
  // https://firebase.google.com/docs/web/setup#available-libraries

  // Your web app's Firebase configuration
  // For Firebase JS SDK v7.20.0 and later, measurementId is optional
const firebaseConfig = {
    apiKey: "AIzaSyC4bhjegDYFJVtN0iwHgYjrbeLpOJnGoCI",
    authDomain: "gochat-d0c25.firebaseapp.com",
    projectId: "gochat-d0c25",
    storageBucket: "gochat-d0c25.appspot.com",
    messagingSenderId: "762052362142",
    appId: "1:762052362142:web:257a1356400fdec9a6208f",
    measurementId: "G-NF2D9ZJ3VQ"
  };

  // Initialize Firebase
const app = initializeApp(firebaseConfig);
const analytics = getAnalytics(app);
const db = getDatabase();

  $('#createServerFinal').click(function(){
    var serverId = $('input#serverId').val();
    var password = $('#password').val();
    var title = $('#title').val();
    set(ref(db, `server/${serverId}`), {
      password: password,
      title: title,
      message: 1,
    });
    update(ref(db, `server/${serverId}/chat/1`), {
      user: 'SERVER', 
      msg: 'Server Created.',
      stamp: '1yr ago'
    });
  });
</script>
    
  </body>
</html>