<?php 

if($path == "/home" OR $breadcrumbsDisable == 1){ 

}else{
?>

<nav class="breadcrumbs-nav bg-light p-2 px-3 rounded-3 <?php if($path == "/home") echo "d-none"; ?>" style="--falcon-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
<div class="container p-0 p-sm-2">
<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="/"><i class="fas fa-home"></i> Home</a></li>
<?php

$fullLink = "https://".$domain;
$crumbs = explode('/' , $path);
foreach($crumbs as $i =>$key) {

if (array_key_last($crumbs) > 1){ //Start If path has multiple pages/links

    if ($i === array_key_first($crumbs)) {
    //Skip first from array

    }elseif ($i === array_key_last($crumbs)) {
    //add active class naem if alst
    $fullLink .= "/".$key;
    $keySlash = str_replace("-"," ",$key);
    


    //Function to find all files in this folder
    $d = $_SERVER['DOCUMENT_ROOT']."/pages/".$crumbs['1']."/";
    $dir = scandir($d);
    if(is_array($dir)){
    foreach($dir as $index => &$item)
    {
        if(is_dir($d. '/' . $item)){ unset($dir[$index]); } }$dir = array_values($dir);
    //End find all files function
    $keySlash = str_replace("-"," ",$key);
    echo '
    <li class="breadcrumb-item active">
    <div class="btn-group">
    <button class="btn btn-link breadcrumb-dropdown dropdown-toggle icon dropdown-item-'.$key.'" type="button" id="'.$key.'MenuButton" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> '.$keySlash.'</button>

    <div class="dropdown-menu breadcrumbs-dropdown-menu py-0 rounded-3" aria-labelledby="'.$key.'MenuButton">';

    foreach($dir as $ii =>$kkey) {
    $realKey = str_replace(".php","",$kkey);
    $realKeySlash = str_replace("-"," ",$realKey);
    
    $active = "";
    $pfullLink = "https://".$domain."/".$crumbs['1'];
    $pfullLink .= "/".$realKey;

    if($realKey == $key) $active = "active";
    
    echo '<a class="dropdown-item icon '.$active.' dropdown-item-'.$realKey.'  rounded-3" href="'.$pfullLink.'"> '.$realKeySlash.'</a>'; 

    }
    echo '
    </div></div>
    </li>
    ';
}

    }elseif ($i == "1") {
        $fullLink .= "/".$key;
        $a1 = $a2 = $a3 = "";
        switch ($key) {
            case 'shop':
            $a1 = "active";
            break;
            case 'support':
            $a2 = "active";
            break;
            case 'legal':
            $a3 = "active";
            break;
            default:
            $a1 = $a2 = $a3 = "";
            break;
        }
        echo '
        <li class="breadcrumb-item">
        <div class="btn-group">
        <button class="btn btn-link breadcrumb-dropdown dropdown-toggle icon dropdown-item-'.$key.'" type="button" id="'.$key.'MenuButton" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> '.$key.'</button>
       
    
        <div class="dropdown-menu breadcrumbs-dropdown-menu py-0 rounded-3" aria-labelledby="'.$key.'MenuButton">    
        <a class="dropdown-item icon dropdown-item-shop '.$a1.'  rounded-3" href="/shop"> Shop</a>
        <a class="dropdown-item icon dropdown-item-support '.$a2.' rounded-3" href="/support"> Support</a>
        <a class="dropdown-item icon dropdown-item-legal '.$a3.' rounded-3" href="/legal"> Legal</a>
     
        </div></div>
        </li>
        ';


    }else {
    $fullLink .= "/".$key;
    $keySlash = str_replace("-"," ",$key);
    echo '<li class="breadcrumb-item"><a href="'.$fullLink.'">'.$keySlash.'</a></li>';
    }
     //END If path has multiple pages/links
}else{
    if ($i === array_key_first($crumbs)) {
        //Skip first from array
    
        }elseif ($i === array_key_last($crumbs)) {
        //add active class naem if alst
        $fullLink .= "/".$key;
        $keySlash = str_replace("-"," ",$key);
        echo '<li class="breadcrumb-item active" aria-current="page"><a href="'.$fullLink.'">'.$keySlash.'</a></li>';
    
        }else {
        $fullLink .= "/".$key;
        $keySlash = str_replace("-"," ",$key);
        echo '<li class="breadcrumb-item"><a href="'.$fullLink.'">'.$keySlash.'</a></li>';
        }
} 

}
?>
    
  </ol>
</nav>


<?php
if($path != "/home"){
 echo '
 <!-- BREADCRUMBS SCHEMA -->
 <script type="application/ld+json">
 {
   "@context": "https://schema.org",
   "@type": "BreadcrumbList",
   "itemListElement": [';
foreach($crumbs as $i =>$key) {
    $fullLink = "https://".$domain;
    if ($i === array_key_first($crumbs)) {
        echo '{
            "@type": "ListItem",
            "position": "0",
            "name": "Home",
            "item": "https://pa.test"
          }';
        
    }elseif ($i === array_key_last($crumbs)) {
    //add active class naem if alst
        $fullLink .= "/".$key;
        echo ',{
            "@type": "ListItem",
            "position": '.$i.',
            "name": "'.$key.'",
            "item": "'.$fullLink.'"
          }';
         
    
    }else {
    $fullLink .= "/".$key;
    echo ',{
        "@type": "ListItem",
        "position": '.$i.',
        "name": "'.$key.'",
        "item": "'.$fullLink.'"
      }';
    }



} 
echo '
] }
</script>
';
}
}
?>