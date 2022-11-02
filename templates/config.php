<?php
include $_SERVER['DOCUMENT_ROOT'].'/vendor/autoload.php';
debug_backtrace() || include $_SERVER['DOCUMENT_ROOT'].'/templates/error/403.php';

date_default_timezone_set('Europe/Zagreb');
$customJS = $customCSS = $SuccessProduct = $breadcrumbsDisable = $bCheck = $bCheck0 = $bCheck1 = $FBmeta = $TalkJS = $ChatPopup = $loadAjaxChat = $UserFBC = $UserFBP = "";

//Variables used globally
$v = include $_SERVER['DOCUMENT_ROOT'].'/templates/vars.php';
#file_put_contents($_SERVER['DOCUMENT_ROOT'].'/templates/vars.php', '<?php return ' . var_export($v, true) . ';');  //Code for saving variables to vars.php
if(isset($_GET['logout'])){
  session_start();
  $_SESSION = array();
  session_destroy();

  setcookie("loggedIn", "", time()-3600);
  setcookie("orderID", "", time()-3600);
  setcookie("userEmail", "", time()-3600);

  header("Location: /home?loggedOut=success");
  die();
  }
  




$firephp = FirePHP::getInstance(true);

//$firephp->fb('Hello World'); /* Defaults to FirePHP::LOG */

//$firephp->fb('Log message'  ,FirePHP::LOG);
//$firephp->fb('Info message' ,FirePHP::INFO);
//$firephp->fb('Warn message' ,FirePHP::WARN);
//$firephp->fb('Error message',FirePHP::ERROR);

$FBPixel  = "1129329811027858";

$sendg1 = "SG.IbkVjaCLQymTp7Esy9F";
$sendg2 = "-uQ.WlamcbbyqJ5DZRqdWqC5ecAQPsudMsAjFBtgoVL1ttw";
$sendg3 = $sendg1.$sendg2;

//Data for FB Conversions API
$accessToken1 = "EAAev7WmVjkIBANmwds5aSyyoPgZBWSw9LRkiUvbhT0LBIvB4TuUgzFnLl3OrhgBaZCCoBrKHclsIvpSDZB96J";
$accessToken2 = "ZAv7SNugw3FjWk47mgsZCgUys1yGlZAvpsOn9ACpO8DzDwZBHcXRw8ocTCSshxAapLHqnb0ZBXw0MJaEnT46o5FTELEsfCsgqVziLn1RvKREZAYZD";
$fbAccessToken = $accessToken1.$accessToken2;
$sendFBAPI = 1; #Set to 1 to send data via api




//START Order Messages
$processingWelcome = "We are now processing your *Order #%ORDERID%*\n\nYour order will be delivered to your email in %PRIORITY% hours or less.\n\nIf this is your first order your new account will be created automatically\n\nIn order to automatically login to your account just <%EMAILLINK%|Click Here!>\n\n_With Love!_\nPsychic Empress";


//Complete Soulmate, Twin Flame & Future Spouse Text added Before and After Order Text
$generalOrderHeader = "Dear %FIRSTNAME%\n\nFirst of all, thank you so much for giving me the opportunity to create a meaningful connection with you! As we continue, please make yourself comfortable and feel wholeheartedly everything I’ve seen while connecting with your aura and energy. I hope that sharing this with you will kindle a light of joy in your heart, and let you know that beautiful things are on the way.\n\n";
$generalOrderFooter = "\n\n It was such a pleasure doing your reading, my dear. I hope that you enjoy it as much as I enjoyed connecting with your beautiful soul energy!\n\nWith Love,\nPsychic Empress";

//Complete Future Baby Text added Before and After Order Text
$babyOrderHeader = "Dear %FIRSTNAME%\n\nFirst of all, thank you so much for giving me the opportunity to create a meaningful connection with you! As we continue, please make yourself comfortable and feel wholeheartedly everything I’ve seen while connecting with your aura and energy. I hope that sharing this with you will kindle a light of joy in your heart, and let you know that beautiful things are on the way.\n\n";
$babyOrderFooter = "\n\n It was such a pleasure doing your reading, my dear. I hope that you enjoy it as much as I enjoyed connecting with your beautiful soul energy!\n\nWith Love,\nPsychic Empress";

//Complete Reading Text added Before and After Order Text
$readingOrderHeader = "Dear %FIRSTNAME%\n\nFirst of all, thank you so much for giving me the opportunity to create a meaningful connection with you! As we continue, please make yourself comfortable and feel wholeheartedly everything I’ve seen while connecting with your aura and energy. I hope that sharing this with you will kindle a light of joy in your heart, and let you know that beautiful things are on the way.\n\n";
$readingOrderFooter = "\n\n It was such a pleasure doing your reading, my dear. I hope that you enjoy it as much as I enjoyed connecting with your beautiful soul energy!\n\nWith Love,\nPsychic Empress";

//Complete Past Life Text added Before and After Order Text
$pastOrderHeader = "Dear %FIRSTNAME%\n\nFirst of all, thank you so much for giving me the opportunity to create a meaningful connection with you! As we continue, please make yourself comfortable and feel wholeheartedly everything I’ve seen while connecting with your aura and energy. I hope that sharing this with you will kindle a light of joy in your heart, and let you know that beautiful things are on the way.\n\n";
$pastOrderFooter = "\n\n It was such a pleasure doing your reading, my dear. I hope that you enjoy it as much as I enjoyed connecting with your beautiful soul energy!\n\nWith Love,\nPsychic Empress";


//Order Processing & Order Complete Notifications
$OrderProcessingMessage = "Your Order status is now set to *Processing*!";

$OrderCompleteMessage = "Your Order status is now set to *Complete*!";
$ContinueConvoMsg = "If you want to chat with Empress, simply reply to this conversation!";
//END Order Messages

$AbandonSubject = "The Timer’s Going Off on Your Order!";
$AbandonMessage = "Look's like you forgot to finish your order... But don't worry, we kept it safe for you! Click the button below to finish your purchase & get closer to your soulmate.";

//Check if server is localhost or guru and save DB info
$domain = $_SERVER['SERVER_NAME'];
if($domain == "empress.test"){
	$servername = "localhost";
	$username = "root";
	$password = "";
	$db = "empress";
  $base_url = "https://empress.test";
  $path_base = $_SERVER['DOCUMENT_ROOT'].'/pages';
}else{
	$servername = "localhost";
	$username = "theisenb_empress";
	$password = "Jepang123Iva";
	$db = "theisenb_empress";
  $base_url = "https://psychic-empress.com";
  $path_base = $_SERVER['DOCUMENT_ROOT'].'/pages/';
}


/////////////////////////////////////////////////////////////////////////////
////////////////////////FUNCTIONS - DO NOT EDIT\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\

// Create connection
$conn = new mysqli($servername, $username, $password, $db);
$conn->query('set character_set_client=utf8');
$conn->query('set character_set_connection=utf8');
$conn->query('set character_set_results=utf8');
$conn->query('set character_set_server=utf8');
$conn->set_charset('utf8mb4');


// Check connection
if ($conn->connect_error) {
	die("Connection failed: " . $conn->connect_error);
  }

/////////////////////////////////////////////////////////////////////////////
////////////////////////FUNCTIONS - DO NOT EDIT\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\
$s = "select * from settings"; 
$sth = $conn->prepare($s);
$sth->execute();
$data = $sth->get_result(); // get result first
$r = $data->fetch_all(MYSQLI_ASSOC); // then fetch all


//Define Main Variables
$webTitle = $r[0]['value'];
$webDescription = $r[1]['value'];
$webLogo = "https://".$domain.$r[2]['value'];
$webVersion = $r[3]['value'];
$FBToken = $r[5]['value'];

$title = $webTitle;
$sdescription = $webDescription;
$pimage = $webLogo;


$pixelActive = 1;


$userAgent = $_SERVER['HTTP_USER_AGENT'];

if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
    $userip = $_SERVER['HTTP_CLIENT_IP'];
} elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
    $userip = $_SERVER['HTTP_X_FORWARDED_FOR'];
} else {
    $userip = $_SERVER['REMOTE_ADDR'];
}


//BREADCRUMBS CHECK & DISABLE
$bCurrent = $_SERVER['REQUEST_URI'];
$splitBread = explode('/',$bCurrent);
$breadC = unserialize($r[4]['value']);

$bSearch0 = $splitBread[0]; 
$bSearch1 = $splitBread[1]; 

if (in_array($bSearch0, $breadC)){$bCheck0 = 1;$bCheck0 = 0; }
if (in_array($bSearch1, $breadC)){$bCheck1 = 1;} else {$bCheck1 = 0; }
if($bCheck0 > 0 OR $bCheck1 > 0)$breadcrumbsDisable = 1;

if(isset($errorPage))$breadcrumbsDisable = 1;

if($domain == "empress.test"){
  // testing
  $min_allowDebugFlag = true;
  $min_errorLogger    = true;
  $min_enableBuilder  = true;
  $min_cachePath      = '/tmp';
  $min_serveOptions['maxAge'] = 0; // see changes immediately
} else {
  // production
  $min_allowDebugFlag = false;
  $min_errorLogger    = false;
  $min_enableBuilder  = false;
  $min_cachePath      = '/tmp';
  $min_serveOptions['maxAge'] = 86400;
}




//Error Reporting - None
//error_reporting(0); //Disable Error Reporting
//ini_set('display_errors', FALSE); //Hide all errors on frontend

//Error Reporting - All
#error_reporting(E_ALL);
#ini_set('display_errors', FALSE);

//Error Log Path
ini_set("log_errors", TRUE); //Log errors to file
ini_set("error_log", $_SERVER['DOCUMENT_ROOT']."/logs/php-error.log");//Path to php error log

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

//Check if session is set, if not set a new one
if(session_id() == '' || !isset($_SESSION) || session_status() === PHP_SESSION_NONE) {
  session_start();
  }
  
  //Check if user cookie ID is set, if not set a new one
  $randomNumber = rand(155654654,955654654);
  if(!isset($_SESSION['cookie'])) {
  $_SESSION['cookie'] = $randomNumber;
  }

  $randomNumber2 = rand(155534654,955654654);
  if(!isset($_SESSION['cookie2'])) {
  $_SESSION['cookie2'] = $randomNumber2;
  }

  $randomNumber3 = rand(1135654654,955654654);
  if(!isset($_SESSION['cookie3'])) {
  $_SESSION['cookie3'] = $randomNumber3;
  }
  
  //Check if funnel page is set, if not set a new one
  if(!isset($_SESSION['funnel_page'])) {
  $_SESSION['funnel_page'] = "main";
  }
  

  if(isset($_GET['affid'])){
    $_SESSION['affid'] = $_GET['affid'];
  }

  if(isset($_GET['click_id'])){
    $_SESSION['click_id'] = $_GET['click_id'];
  }
  
  if(isset($_GET['subid1'])){
    $_SESSION['subid1'] = $_GET['subid1'];
  }
  
  if(isset($_GET['subid2'])){
    $_SESSION['subid2'] = $_GET['subid2'];
  }
  


//Save to order log function
function formLog($array) {
  $dataToLog = $array;
  $data = implode(" | ", $dataToLog);
  $data .= PHP_EOL;
  $pathToFile = $_SERVER['DOCUMENT_ROOT']."/logs/order.log";
  $success = file_put_contents($pathToFile, $data, FILE_APPEND);
  if ($success === TRUE){
    //echo "log saved";
  }
}

//Save to order log function
function formErrorLog($array) {
  $dataToLog = $array;
  $data = implode(" | ", $dataToLog);
  $data .= PHP_EOL;
  $pathToFile = $_SERVER['DOCUMENT_ROOT']."/logs/order-error.log";
  $success = file_put_contents($pathToFile, $data, FILE_APPEND);
  if ($success === TRUE){
    //echo "log saved";
  }
}

//Save to order log function
function SuperLog($array, $logname) {
  $dataToLog = $array;
  $data = implode(" | ", $dataToLog);
  $data .= PHP_EOL;
  $pathToFile = $_SERVER['DOCUMENT_ROOT']."/logs/".$logname.".log";
  $success = file_put_contents($pathToFile, $data, FILE_APPEND);
}

//Function to check if user is from US
$formDate = "";
    $langs = array();
    if (isset($_SERVER['HTTP_ACCEPT_LANGUAGE'])) {
        // break up string into pieces (languages and q factors)
        preg_match_all('/([a-z]{1,8}(-[a-z]{1,8})?)\s*(;\s*q\s*=\s*(1|0\.[0-9]+))?/i', $_SERVER['HTTP_ACCEPT_LANGUAGE'], $lang_parse);
        if (count($lang_parse[1])) {
            // create a list like "en" => 0.8
            $langs = array_combine($lang_parse[1], $lang_parse[4]);
            // set default to 1 for any without q factor
            foreach ($langs as $lang => $val) {
                if ($val === '') $langs[$lang] = 1;
            }
            // sort list based on value	
            arsort($langs, SORT_NUMERIC);
        }
    }
    if (array_key_first($langs)=="en-US")$formDate = "US";

$rcountdown = rand(1,10);
if($rcountdown <= 3){
  $countdownRandom = "no";
  }
if($rcountdown > 3){
  $countdownRandom = "yes";
  }
    


//Disable notifications in menu
$notificationsOn = "no";


//START Order Messages
$processingWelcome = "We are now processing your *Order #%ORDERID%*\n\nYour order will be delivered to your email in %PRIORITY% hours or less.\n\nIf this is your first order your new account will be created automatically\n\nIn order to automatically login to your account just <%EMAILLINK%|Click Here!>\n\n_With Love!_\nPsychic Empress";


//Complete Soulmate, Twin Flame & Future Spouse Text added Before and After Order Text
$generalOrderHeader = "Dear %FIRSTNAME%\n\nFirst of all, thank you so much for giving me the opportunity to create a meaningful connection with you! As we continue, please make yourself comfortable and feel wholeheartedly everything I’ve seen while connecting with your aura and energy. I hope that sharing this with you will kindle a light of joy in your heart, and let you know that beautiful things are on the way.\n\n";
$generalOrderFooter = "\n\n It was such a pleasure doing your reading, my dear. I hope that you enjoy it as much as I enjoyed connecting with your beautiful soul energy!\n\nWith Love,\nPsychic Empress";

//Complete Future Baby Text added Before and After Order Text
$babyOrderHeader = "Dear %FIRSTNAME%\n\nFirst of all, thank you so much for giving me the opportunity to create a meaningful connection with you! As we continue, please make yourself comfortable and feel wholeheartedly everything I’ve seen while connecting with your aura and energy. I hope that sharing this with you will kindle a light of joy in your heart, and let you know that beautiful things are on the way.\n\n";
$babyOrderFooter = "\n\n It was such a pleasure doing your reading, my dear. I hope that you enjoy it as much as I enjoyed connecting with your beautiful soul energy!\n\nWith Love,\nPsychic Empress";

//Complete Reading Text added Before and After Order Text
$readingOrderHeader = "Dear %FIRSTNAME%\n\nFirst of all, thank you so much for giving me the opportunity to create a meaningful connection with you! As we continue, please make yourself comfortable and feel wholeheartedly everything I’ve seen while connecting with your aura and energy. I hope that sharing this with you will kindle a light of joy in your heart, and let you know that beautiful things are on the way.\n\n";
$readingOrderFooter = "\n\n It was such a pleasure doing your reading, my dear. I hope that you enjoy it as much as I enjoyed connecting with your beautiful soul energy!\n\nWith Love,\nPsychic Empress";

//Complete Past Life Text added Before and After Order Text
$pastOrderHeader = "Dear %FIRSTNAME%\n\nFirst of all, thank you so much for giving me the opportunity to create a meaningful connection with you! As we continue, please make yourself comfortable and feel wholeheartedly everything I’ve seen while connecting with your aura and energy. I hope that sharing this with you will kindle a light of joy in your heart, and let you know that beautiful things are on the way.\n\n";
$pastOrderFooter = "\n\n It was such a pleasure doing your reading, my dear. I hope that you enjoy it as much as I enjoyed connecting with your beautiful soul energy!\n\nWith Love,\nPsychic Empress";


//Order Processing & Order Complete Notifications
$OrderProcessingMessage = "Your Order status is now set to Processing!";

$OrderCompleteMessage = "Your Order status is now set to Complete!";
$ContinueConvoMsg = "If you want to chat with Emperss, simply reply to this conversation!";
//END Order Messages



//SESSION DATA FOR TESTING ONLY, REMOVE LATER
//$_SESSION['id'] = "1";
//$_SESSION['name'] = "Ivan Simic";
//$_SESSION['fname'] = "Ivan";
//$_SESSION['email'] = "ivan.simic2903@gmail.com";
//$_SESSION['orders'] = "14";
//$_SESSION['loggedIn'] = "yes";
//SESSION DATA FOR TESTING ONLY, REMOVE LATER
if(!isset($customTrigger)){
  $customTrigger="";
}

//Check if user logged in, if yes save variables
if(isset($_SESSION['id'])){
$userID = $_SESSION['userID'];
$userName = $_SESSION['name'];
$userFName = $_SESSION['fname'];
$userEmail = $_SESSION['email'];
$userOrders = $_SESSION['orders'];

$ChatPopup = <<<EOT
<a href="/dashboard/support">
<div id="chat-popup" class="py-2 px-0 light topbar-gradient rounded-3 chat-hide"> 
            <div id="sidebar-menu" class="text-white">
                    <ul>
                        <li> <a href="/dashboard/support" class="text-decoration-none d-flex align-items-start">
                            <div class="fa fa-comment-question pt-2 me-3"></div>
                            <div class="d-flex flex-column">
                                <div class="link position-relative">
                                Live Chat   
                                <span style="" id="notifier-badge-popup" class="position-absolute badge rounded-pill bg-danger">1</span>
                                </div>
                                <div class="link-desc">You have unread messages!</div>
                            </div>
                        </a> </li>   
</ul>
</div>
</div>
</a>
EOT;

$signature = hash_hmac('sha256', strval("PA".$userID), 'sk_test_dmh9xKYFEPiN2BxC0Z9GuAlrdEe6kRKL');

$TalkJS = <<<EOT
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

$('#talkjs-container').hide;


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


$loadAjaxChat = <<<EOT
$.ajaxSetup({
  cache: Boolean
});
        // specify loading spinner
        var spinner = "<img src='https://i.imgur.com/pKopwXp.gif' alt='loading...' />";
        // specify the server/url you want to load data from

        var loadLink = "https://$domain/templates/ajax/load-chat.php?id=$userID";
        var windowHeight = '&height=';
        windowHeight += $("#offcanvas-bddy-h").height()
        $("#result").html(spinner).load(loadLink);
EOT;

$TalkJSpop = <<<EOT
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
EOT;

}else{ //If not logged in make those variables empty
$userID = "";
$userName = "";
$userEmail = "";
$userOrders = "0";
} 


function time_ago($timestamp)  
 {  
      $time_ago = strtotime($timestamp);  
      $current_time = time();  
      $time_difference = $current_time - $time_ago;  
      $seconds = $time_difference;  
      $minutes      = round($seconds / 60 );           // value 60 is seconds  
      $hours           = round($seconds / 3600);           //value 3600 is 60 minutes * 60 sec  
      $days          = round($seconds / 86400);          //86400 = 24 * 60 * 60;  
      $weeks          = round($seconds / 604800);          // 7*24*60*60;  
      $months          = round($seconds / 2629440);     //((365+365+365+365+366)/5/12)*24*60*60  
      $years          = round($seconds / 31553280);     //(365+365+365+365+366)/5 * 24 * 60 * 60  
      if($seconds <= 60)  
      {  
     return "Just Now";  
   }  
      else if($minutes <=60)  
      {  
     if($minutes==1)  
           {  
       return "one minute ago";  
     }  
     else  
           {  
       return "$minutes minutes ago";  
     }  
   }  
      else if($hours <=24)  
      {  
     if($hours==1)  
           {  
       return "an hour ago";  
     }  
           else  
           {  
       return "$hours hrs ago";  
     }  
   }  
      else if($days <= 7)  
      {  
     if($days==1)  
           {  
       return "yesterday";  
     }  
           else  
           {  
       return "$days days ago";  
     }  
   }  
      else if($weeks <= 4.3) //4.3 == 52/12  
      {  
     if($weeks==1)  
           {  
       return "a week ago";  
     }  
           else  
           {  
       return "$weeks weeks ago";  
     }  
   }  
       else if($months <=12)  
      {  
     if($months==1)  
           {  
       return "a month ago";  
     }  
           else  
           {  
       return "$months months ago";  
     }  
   }  
      else  
      {  
     if($years==1)  
           {  
       return "one year ago";  
     }  
           else  
           {  
       return "$years years ago";  
     }  
   }  
 } 

 $RbaseUrl = "https://".$_SERVER['SERVER_NAME'] . parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

 if(isset($_GET['b'])){
  $btncolor = $_GET['b'];
}else{
  $rcolor = rand(1,2);
  $btncolor = "normal";
  if($rcolor == 1)$btncolor = "green";
  if($rcolor == 2)$btncolor = "normal";
}
$cFBC = "_fbc";
$cFBP = "_fbp";

if(isset($_COOKIE[$cFBC])){
  $UserFBC = $_COOKIE[$cFBC];
}else{
  $UserFBC = "";
}

if(isset($_COOKIE[$cFBP])){
  $UserFBP = $_COOKIE[$cFBP];
}else{
  $UserFBP = "";
}


$cookie_aff = "affid";
$cookie_clickid = "clickid";


if(isset($_COOKIE[$cookie_aff])){

  $affID = $_COOKIE[$cookie_aff];

}else{

  if(isset($_GET['affid'])){
    $affIDSet = $_GET['affid'];
    setcookie($cookie_aff, $affIDSet, time() + (86400 * 30), "/");
  }else{
    $affIDSet = "0";
    setcookie($cookie_aff, $affIDSet, time() + (86400 * 30), "/");
  }

  $affID = $affIDSet;

}


if(isset($_COOKIE[$cookie_clickid])){

  $clickID = $_COOKIE[$cookie_clickid];

}else{

  if(isset($_GET['clickid'])){
    $clickIDSet = $_GET['clickid'];
    setcookie($cookie_clickid, $clickIDSet, time() + (86400 * 30), "/");
  }else{
    $clickIDSet = "0";
    setcookie($cookie_clickid, $clickIDSet, time() + (86400 * 30), "/");
  }

  $clickID = $clickIDSet;

}


if(isset($_GET['utm_campaign'])){
  if($_GET['utm_campaign'] != "website"){
$fbTrack = 1;

$fbVariable = $_GET['utm_campaign'];
$ex = explode(" ",$fbVariable);

$fbCampaign = $ex["0"];
$fbAdset = $ex["1"];
$fbAd = $ex["2"];

//Set fb ads session variables
$_SESSION['fbCampaign'] = $fbCampaign;
$_SESSION['fbAdset'] = $fbAdset;
$_SESSION['fbAd'] = $fbAd;
 }

}else{
$fbTrack = 0;

  $fbCampaign = "";
  $fbAdset = "";
  $fbAd = "";

  if(!isset($_SESSION['fbCampaign'])){
    $_SESSION['fbCampaign'] = $fbCampaign;
  }

  if(!isset($_SESSION['fbAdset'])){
    $_SESSION['fbAdset'] = $fbAdset;
  }

  if(!isset($_SESSION['fbAd'])){
    $_SESSION['fbAd'] = $fbAd;
  }


}


if(isset($_SESSION['userID'])){           //Check if user logged in
if(isset($_GET['notifRead'])){            //Check if notifRead is in URL
  if($_GET['notifRead']=="yes"){          //Check if notifRead is set to yes
    if(isset($_GET['notifID'])){          //Check if notifID is set in URL
      if($_GET['notifID']=="all"){        //Check if notifID is set to ALL

        $nUserID = $_SESSION['userID'];
        $sql = "UPDATE `notifications` SET `unread`='0' WHERE `user_id`='$nUserID'" ;
        if ($conn->query($sql) === TRUE) {
        //  $showError = 0;
        header("Location: ".$RbaseUrl);
        die();
        } else {
        // $showErrorText = "Error: " . $sql->error . "<br>" . $conn->error;
        }

        }else{                            //If notifID is not set to all fetch ID and update just that one notification

        $notifID = $_GET['notifID'];
        $sql = "UPDATE `notifications` SET `unread`='0' WHERE `id`='$notifID'" ;
        if ($conn->query($sql) === TRUE) {
          //  $showError = 0;
        header("Location: ".$RbaseUrl);
        die();
        } else {
          // $showErrorText = "Error: " . $sql->error . "<br>" . $conn->error;
        }


        }
      }
    }
  }
}

//START FUNCTION FOR INDEX.PHP
if (isset($_SERVER['PATH_INFO'])) {//Check URL Path to figure out what template to use
    //Check if URL Ends with "/"
    if (str_ends_with($_SERVER['PATH_INFO'], '/')) {
    $path = substr($_SERVER['PATH_INFO'], 0, -1); //If / is found at the end remove it and then Map the URL to variable $path
    }else{ 
    $path = $_SERVER['PATH_INFO']; //Map the URL to variable $path
    }
}else{
$path = "/home";//Default URL is pointing to home template
}
$splitURL = explode('/',$path);
$template = $path_base.$path.'.php';
//END FUNCTION FOR INDEX.PHP

//START FUNCTION FOR INDEX.PHP ADDON FOR VIEW ORDERS
if(isset($splitURL[1])){//If variable is set proceed
    if($splitURL[1]=="dashboard"){
        if(isset($splitURL[2])){
           if($splitURL[2]=="order"){
            $path="dashboard/order";
            $template = $path_base.$path.'.php';
              if(isset($splitURL[3])){
              $viewOrder = $splitURL[3];
              }
           }
        }
    }
}
//END FUNCTION FOR INDEX.PHP ADDON FOR VIEW ORDERS

//START FUNCTION FOR INDEX.PHP ADDON FOR SUCCESS PAGE
if(isset($splitURL[1])){//If variable is set proceed
  if($splitURL[1]=="order"){
      if(isset($splitURL[2])){
         if($splitURL[2]=="success"){
          $path="/order/success";
          $template = $path_base.$path.'.php';
            if(isset($splitURL[3])){
            $SuccessProduct = $splitURL[3];
            }
         }
      }
  }
}
//END FUNCTION FOR INDEX.PHP ADDON FOR SUCCESS PAGE

//START FUNCTION FOR INDEX.PHP ADDON FOR ORDER PAGE
if(isset($splitURL[1])){//If variable is set proceed
  if($splitURL[1]=="order"){
      if(isset($splitURL[2])){
         if($splitURL[2]=="order"){
          $title = "Order Error";
         }
      }
  }
}
//END FUNCTION FOR INDEX.PHP ADDON FOR SUCCESS PAGE


?>