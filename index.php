<?php
if(isset($_POST['createServerFinal'])) {
  sleep(2);
  $title = $_POST['title'];
  $pw = $_POST['password'];
  $serverId = $_POST['serverId'];
  echo '<span id="serverId" style="display:none;">'.$serverId.'</span>';
  mkdir('server/'.$serverId.''); # 폴더 생성
  $file = fopen('server/'.$serverId.'/index.php', 'w') or die('Unable to open file!'); # 폴더에 index.php 파일 생성.
  $html = '<?php $t="'.$title.'"; require("../../data/html/go-chat.php"); ?>';
  fwrite($file, $html);
  fclose($file);
  echo '<script>location.href="/server/'.$serverId.'";</script>';
}
?>
  
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>Go</title>
    <link rel="stylesheet" href="/data/styles/gochat.css?v=20221016" />
    <link href="//spoqa.github.io/spoqa-han-sans/css/SpoqaHanSansNeo.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script defer src=""></script>
  </head>
  <body>
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
            <form action="#" method="post" name="roomCreate">
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
      stamp: '1억년 전'
    });
  });
</script>
    
  </body>
</html>