<?php
if(isset($_SESSION['funnel_page'])) {

//Last page set as funnel step variable
$sPage = $_SESSION['funnel_page'];

//Currently loaded page
$currentURL = $_SERVER['REQUEST_URI'];




//If user was last on Main Product Page
if($sPage == "main") {
    if($currentURL == "/shop/soulmate" OR $currentURL == "/shop/soulmate/" OR $currentURL=="/shop/twin-flame" OR $currentURL=="/shop/twin-flame/" OR $currentURL=="/shop/future-spouse" OR $currentURL=="/shop/future-spouse/"){ 
    //Correct Funnel Page
    }else{ 
    header('Location: /shop/soulmate');
    die();
    }
    
}

//If user was last on Upsell #1 Page
if($sPage == "personal-reading") {
    if($currentURL == "/offer/personal-reading" OR $currentURL == "/offer/personal-reading/"){ 
    //Correct Funnel Page
    }else{ 
    header('Location: /offer/personal-reading');
    die();
    }
    
}

//If user was last on Upsell #2 Page
if($sPage == "future-baby") {
    if($currentURL == "/offer/future-baby" OR $currentURL == "/offer/future-baby"){ 
    //Correct Funnel Page
    }else{ 
    header('Location: /offer/future-baby');
    die();
    }
}

//If user was last on thank you Page
if($sPage == "funnel-complete") {
    if($currentURL == "/order/complete" OR $currentURL == "/order/complete/"){ 
    //Correct Funnel Page
    }else{ 
    header('Location: /order/complete');
    die();
    }
}

}else{ 
header('Location: /shop/soulmate');
die();
}
?>