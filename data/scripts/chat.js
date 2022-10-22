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

var serverId = c.slice(8);
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
    var date = new Date();
    stamp = new Date(+date + 3240 * 10000).toISOString().replace('T', ', ').replace(/\..*/, '');
    console.log(`> > > ${stamp}`);
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
    stat(data3, data20);
  }) 
}, {
  onlyOnce: true
})
      
function stat(data3, data20) {
console.log(`데이터 수: ${data3}`);
$('.chat--gr').remove();
var dx = Object.keys(data20).length;
for (let d=1;d<data3+1;d++) {
  var xd = data20[Object.keys(data20)[d]];
  const starCountRef4 = ref(db, `server/${serverId}/chat/${d}`);
  onValue(starCountRef4, (snapshot) => {
    const data4 = snapshot.val();
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
    chatAdded(data3);
  })
}
}

function chatAdded(data3) {
  var xy = $('.chat--gr').height();
  $('.chatlist').scrollTop(xy*data3);
}