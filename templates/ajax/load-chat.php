<?php
include_once $_SERVER['DOCUMENT_ROOT'].'/templates/config.php';
include_once $_SERVER['DOCUMENT_ROOT'].'/templates/signedin-scripts.php'; 

//Fetch Chat Height
if(isset($_GET['height'])){
    $height = $_GET['height'];
}else{
    $height = "90vh";
}

//Fetch ID
if(isset($_GET['id'])){
    $userID = $_GET['id'];
}else{
    $userID = "unkown";
}



$sql = "SELECT * FROM users WHERE id = '$userID'";
$result = $conn->query($sql);

$row = mysqli_fetch_assoc($result);
$ChatID = $row['id'];
$ChatName = $row['full_name'];
$ChatDOB = $row['dob'];
$ChatDOBus = date("m/d/Y", strtotime($_SESSION['dob']));
$ChatGender = $row['gender'];
$ChatPGender = $row['partner_gender'];
$ChatEmail = $row['email'];

$ChatSignature = hash_hmac('sha256', strval("PA".$ChatID), 'sk_test_dmh9xKYFEPiN2BxC0Z9GuAlrdEe6kRKL');

if(isset($ChatID)){ 
$STalkJS = <<<EOT
    <script>
    Talk.ready.then(function() {
var me = new Talk.User({
    id: 'PA$ChatID',
    role: 'PAcustomer',
    name: '$ChatName',
    email: '$ChatEmail',
    photoUrl: 'https://avatars.dicebear.com/api/adventurer/$ChatEmail.svg',
    custom: { email: '$ChatEmail' }
});
  
window.talkSession = new Talk.Session({
appId: 't2X08S4H',
me: me,
signature: "$ChatSignature"
});

var operator = new Talk.User({
    id: 'PAadmin',
    role: 'PAadmin',
    name: 'Psychic Artist',
    email: 'contact@psychic-artist.com',
    photoUrl: 'https://$domain/assets/img/logo-1.png',
    welcomeMessage: 'Hey, how can I help you?'
});

var conversation = window.talkSession.getOrCreateConversation("PA$ChatID");
conversation.setParticipant(me);
conversation.setParticipant(operator);
    
var chatbox = window.talkSession.createChatbox(conversation);
chatbox.mount(document.getElementById("talkjs-container-pop"));
    
    

    window.talkSession.unreads.on('change', function (unreadConversations) {
      var amountOfUnreads = unreadConversations.length;
      var oldtitle = document.title;
      amountOfUnreads += document.title;
    
$('#notifier-badge')
  .text(amountOfUnreads)
  .toggle(amountOfUnreads > 0);
    
  $('#notifier-badge-popup')
  .text(amountOfUnreads)
  .toggle(amountOfUnreads > 0);
      
if (amountOfUnreads > 0) {
  document.title = '(' + amountOfUnreads + ')';
  $('#chat-popup').removeClass('chat-hide');
} else {
  document.title = oldtitle;
  $('#chat-popup').addClass('chat-hide');
}
      });
    });
    </script>
EOT;
    }else{
$STalkJS = "";
} 

echo $STalkJS;
?>

<div style="height:<?php echo $height; ?>;">
<div id="talkjs-container-pop" style="width: 100%; margin: 0px; height: 100%">
<i>Loading chat...</i>
</div>
</div>