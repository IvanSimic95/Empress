<?php
if(!isset($_SESSION['loggedIn'])){
header("Location: /dashboard");
die();
}
$title = "Dashboard - Support | Psychic Artist"; 
$insertPage = "support";
$pageTitle1 = "Support Chat";
$sdescription = "Need help? This is the best place for you!";
$firstTime = "";

if(isset($_GET['startChat'])){

//Now create new conversation
$ch2 = curl_init();
$data2 = [
"participants" => ["PAadmin", "PA".$userID]
];
$data22 = json_encode($data2);
curl_setopt($ch2, CURLOPT_URL, 'https://api.talkjs.com/v1/t2X08S4H/conversations/PA'.$userID);
curl_setopt($ch2, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch2, CURLOPT_CUSTOMREQUEST, 'PUT');

curl_setopt($ch2, CURLOPT_POSTFIELDS, $data22);

$headers = array();
$headers[] = 'Content-Type: application/json';
$headers[] = 'Authorization: Bearer sk_test_dmh9xKYFEPiN2BxC0Z9GuAlrdEe6kRKL';
curl_setopt($ch2, CURLOPT_HTTPHEADER, $headers);

$result2 = curl_exec($ch2);
if (curl_errno($ch2)) {
    echo 'Error:' . curl_error($ch2);
}
curl_close($ch2);
$firstTime = "0";

}else{

//Check if user has chat already
$ch2 = curl_init();
$data2 = [];
curl_setopt($ch2, CURLOPT_URL, 'https://api.talkjs.com/v1/t2X08S4H/users/PA'.$userID);
curl_setopt($ch2, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch2, CURLOPT_CUSTOMREQUEST, 'GET');

curl_setopt($ch2, CURLOPT_POSTFIELDS, $data2);

$headers = array();
$headers[] = 'Content-Type: application/json';
$headers[] = 'Authorization: Bearer sk_test_dmh9xKYFEPiN2BxC0Z9GuAlrdEe6kRKL';
curl_setopt($ch2, CURLOPT_HTTPHEADER, $headers);

$result2 = curl_exec($ch2);
if (curl_errno($ch2)) {
    echo 'Error:' . curl_error($ch2);
}
curl_close($ch2);
if($result2=='{"errorCode":"USER_NOT_FOUND"}'){
$firstTime = 1;
}

}



?>

<div class="container-fluid py-0 px-0 px-md-3 py-md-3" data-layout="container">
    <section class="py-0 overflow-hidden light" id="banner">
        <div class="container p-0 pt-2 p-md-3 pt-md-3">

            <div class="row gx-0 gy-2 g-xl-2 h-100">
            <div class="col-12 col-sm-12 col-xl-4 text-center py-2 order-2 order-md-1">
                

            <div class="py-2 px-0 light topbar-gradient rounded-3"> 
            <div class="elfsight-app-f9baa5f9-4e55-4c19-bae9-2445b696abcf"></div>
<div id="sidebar-menu" class="text-white">
    
<ul>

                    <li> <a href="/dashboard" class="text-decoration-none d-flex align-items-start">
                            <div class="fas fa-box pt-2 me-3"></div>
                            <div class="d-flex flex-column">
                                <div class="link">My Account</div>
                                <div class="link-desc">Your Account Overview</div>
                            </div>
                        </a> </li>
                        <li> <a href="/dashboard/orders" class="text-decoration-none d-flex align-items-start">
                            <div class="fas fa-box-open pt-2 me-3"></div>
                            <div class="d-flex flex-column">
                                <div class="link">My Orders 
                            <?php 
                                if(isset($_SESSION['loggedIn'])){ 
                                    if($_SESSION['loggedIn']=="yes"){
                                        echo "(".$_SESSION['orders'].")"; 
                                    }
                                }
                            ?> </div>
                                <div class="link-desc">View & Manage Orders</div>
                            </div>
                        </a> </li>
                        <li> <a href="/dashboard/profile" class="text-decoration-none d-flex align-items-start">
                            <div class="fa fa-user-pen pt-2 me-3"></div>
                            <div class="d-flex flex-column">
                                <div class="link">My Profile</div>
                                <div class="link-desc">Change your profile details</div>
                            </div>
                        </a> </li>
                        <li class="active"> <a href="/dashboard/support" class="text-decoration-none d-flex align-items-start">
                            <div class="fa fa-comment-question pt-2 me-3"></div>
                            <div class="d-flex flex-column">
                                <div class="link position-relative">
                                Support   
                                <span id="notifier-badge" class="position-absolute badge rounded-pill bg-danger">0</span>
                                </div>
                                <div class="link-desc">Need help with something?</div>
                            </div>
                        </a> </li>
                    <li> <a href="/dashboard?logout=yes" class="text-decoration-none d-flex align-items-start">
                            <div class="fa fa-right-from-bracket pt-2 me-3"></div>
                            <div class="d-flex flex-column">
                                <div class="link">Logout</div>
                                <div class="link-desc">All done? Click here to sign out!</div>
                            </div>
                        </a> </li>
</ul>

                            </div>
      
                            </div>

</div>
              <div class="col-12 col-sm-12 col-xl-8 py-2 order-1 order-md-2">
                  <div class="p-0 flex-grow-1 d-flex flex-column">

                  <?php if($firstTime == 1){ ?>
                  <div class="card mb-3 p-0">
                        <div class="card-header bg-light p-4 py-3 topbar-gradient">
                            <div class="d-flex flex-between-center">
                                <h3 class="mb-0 fw-semibold fs-1" style="color:#fff;">Support Chat - Not Started Yet</h3>
                            </div>
                        </div>
                        <div class="card-body px-1 px-md-2 px-lg-3 py-2">
                       
                        <div class="alert alert-info border-2 d-flex align-items-center mt-1" role="alert">
                        <div class="bg-info me-3 icon-item d-none d-sm-flex"><span class="fas fa-info-circle text-white fs-3"></span></div>
                        <p class="mb-0 flex-1">If you need help and wish to start the chat just click the button below!</p>
                        </div>


<p class="card-text placeholder-glow">
<span class="d-block placeholder mb-2 col-10"></span>
<span class="d-block placeholder mb-2 col-9"></span>
<span class="d-block placeholder mb-2 col-12"></span>
<span class="d-block placeholder mb-2 col-11"></span>
<span class="d-block placeholder mb-2 col-9"></span>
<span class="d-block placeholder mb-2 col-8"></span>
<span class="d-block placeholder mb-2 col-9"></span>
<span class="d-block placeholder mb-2 col-8"></span>
<span class="d-block placeholder mb-2 col-12"></span>
<span class="d-block placeholder mb-2 col-8"></span>
<span class="d-block placeholder mb-2 col-9"></span>
<span class="d-block placeholder mb-2 col-10"></span>
<span class="d-block placeholder mb-2 col-9"></span>
<span class="d-block placeholder mb-2 col-11"></span>
<span class="d-block placeholder mb-2 col-12"></span>
<span class="d-block placeholder mb-2 col-8"></span>
</p>
                        
                        

                        <a href="?startChat=Yes" class="btn btn-dark text-uppercase w-100 mt-2">Start Chat!</a>
                        </div>
                    </div>

                        <?php }else{ ?>

<!-- container element in which TalkJS will display a chat UI -->
<div id="talkjs-container" style="width: 100%; margin: 0px; height: 600px">
  <i>Loading chat...</i>
</div>

                            <?php
                        $customJS .= <<<EOT
                        <script>
                        Talk.ready.then(function() {
                            var me = new Talk.User({
                                id: 'PA$userID',
                                role: 'PAcustomer',
                                name: '$userFName',
                                email: '$userEmail',
                                photoUrl: 'https://avatars.dicebear.com/api/adventurer/$userEmail.svg',
                                custom: { email: '$userEmail' }
                            });
                              
                            window.talkSession = new Talk.Session({
                            appId: 't2X08S4H',
                            me: me,
                            signature: "$signature"
                            });
                            
                            var operator = new Talk.User({
                                id: 'PAadmin',
                                role: 'PAadmin',
                                name: 'Psychic Artist',
                                email: 'contact@psychic-artist.com',
                                photoUrl: 'https://$domain/assets/img/logo-1.png',
                                welcomeMessage: 'Hey, how can I help you?'
                            });
                            
                            var conversation = window.talkSession.getOrCreateConversation("PA$userID");
                            conversation.setParticipant(me);
                            conversation.setParticipant(operator);
                        
                            var chatbox = window.talkSession.createChatbox(conversation);
                            chatbox.mount(document.getElementById("talkjs-container"));
                        
                        
                            
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


                        } ?>



</div>
        </div>
    </section>
</div>

<?php

//$customCSSPreload = '<link rel="preload" href="/assets/css/baby.css" as="style">';
//$customCSS = '<link href="/assets/css/baby.css" rel="stylesheet">';



?>