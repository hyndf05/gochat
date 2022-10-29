<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>Go - <?php echo $t; ?></title>
    <link rel="stylesheet" href="/data/styles/gochat.css?v=20221016" />
    <link href="//spoqa.github.io/spoqa-han-sans/css/SpoqaHanSansNeo.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script defer src=""></script>
  </head>
  <body>
    <div class="preview">
      <div class="prv-image">
        <div class="prv-close">
          <span class="material-symbols-outlined">close</span>
        </div>
        <div class="prv-body">
          <div class="prv-body-top">
            <img id="previewImg" src="#">
          </div>
          <div class="prv-body-bottom">
            <span id="uploadImageFixed" class="material-symbols-outlined">done</span>
          </div>
        </div>
      </div>
    </div>
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
          <label for="uploadImg" class="sample-image">
            <div class="sample-image">
              <span class="material-symbols-outlined">add</span>
            </div>
          </label>
          <input type="file" class="dn" id="uploadImg" name="uploadImg">
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

var c = $(location).attr('pathname');

var serverId = '0';
var messageCode;
var user;
var msg;
var stamp;

$('.w-send').click(sendMessage);
function sendMessage() {
  const starCountRef = ref(db, `server/${serverId}/message`);
  onValue(starCountRef, (snapshot) => {
    const data = snapshot.val();
    messageCode = data + 1;
    add();
  }, {
    onlyOnce: true
  })
  function add() {
    update(ref(db, `server/${serverId}`), {
      message: messageCode
    }, {
      onlyOnce: true
    });
    msgSave();
  }
  function msgSave() {
    user = $('#user').val();
    msg = $('#msg').val();
    stamp = Date();
    console.log(stamp);
    console.log(messageCode);
    $('#msg').focus();
    $('#msg').val('');
    set(ref(db, `server/${serverId}/chat/${messageCode}`), {
      user: user,
      msg: msg,
      stamp: stamp
    });
  }
}

const starCountRef = ref(db, `server/${serverId}/chat`);
onValue(starCountRef, (snapshot) => {
  const data2 = snapshot.val();
  var data20 = data2; // 채팅 array
  const starCountRef2 = ref(db, `server/${serverId}/message`);
  onValue(starCountRef2, (snapshot) => {
    const data3 = snapshot.val(); // 개수
    stat(data3, data20); // f.live
  }) 
}, {
  onlyOnce: true
})
      
function stat(data3, data20) {
console.log(`데이터 수: ${data3}`);
$('.chat--gr').remove(); // 계산후 del
var dx = Object.keys(data20).length;
for (let d=1;d<data3+1;d++) {
var xd = data20[Object.keys(data20)[d]];
const starCountRef4 = ref(db, `server/${serverId}/chat/${d}`);
onValue(starCountRef4, (snapshot) => {
  const data4 = snapshot.val();
  var data4msg = data4.msg;
  if (data4.msg.match('blob:')) {
    $('.chatlist').append(`
    <div class="chat--gr chat--tp-img">
      <img src="${data4msg}">
      <div class="chat--tp-img-text--absolute">
        <span id="username">${data4.user}</span>
      </div>
    </div>
    `);
  } else {
    $('.chatlist').append(`
        <div class="chat--gr">
          <div class="chat-me">
            <div class="chat-profile">
              <span id="username">${data4.user}</span>
            </div>
            <div class="chat-text">
              <div class="chat-text-main">
                <span id="usertext">${data4.msg}</span>
              </div>
              <div class="chat-date">
                <span id="userdate">${data4.stamp}</span>
              </div>
            </div>
          </div>
        </div>
      `);
      }
      chatAdded(data3);
    })
  }
}

function chatAdded(data3) {
  var xy = $('.chat--gr').height();
  $('.chatlist').scrollTop(xy*data3);
}

uploadImg.onchange = evt => {
  $('.prv-image').addClass('block');
  const [file] = uploadImg.files;
  if (file) {
    previewImg.src = URL.createObjectURL(file);
  }
  $('#uploadImg').val('');
}

$('#uploadImageFixed').click(imgUpload);

function imgUpload() {
  var g = $('#previewImg').attr('src');
  console.log(g);
  $('#msg').val(g);
  setTimeout(sendMessage, 1000);
  $('.prv-image').removeClass('block');
}

$('.prv-close span').click(closePreviewImgDiv);

function closePreviewImgDiv() {
  $('.prv-image').removeClass('block');
  $('#uploadImg').val('');
}
      
</script>
    
  </body>
</html>