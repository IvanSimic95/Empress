<?php
/* $title          = $v['p'.$productID.'-title']; $shorttitle     = $v['p'.$productID.'-short-title']; $subtitle       = $v['p'.$productID.'-subtitle']; $description    = $v['p'.$productID.'-description']; $sdescription   = $v['p'.$productID.'-short-description']; $image          = $v['p'.$productID.'-image']; $price          = $v['p'.$productID.'-price']; $reviews        = $v['p'.$productID.'-reviews']; $avgrating      = $v['p'.$productID.'-avg-rating']; $url            = $v['p'.$productID.'-url']; $button         = $v['p'.$productID.'-button']; $pimage = $image; include $_SERVER['DOCUMENT_ROOT'].'/templates/schema.php';  */

$_SESSION['funnel_page'] = "main";

$sql = "SELECT * FROM products WHERE id = '" . $productID . "'";
$result = $conn->query($sql);
$row = $result->fetch_array(MYSQLI_NUM);


$title = $row[1];
$titleProduct = $title;
$title = $title." | Psychic Artist";

$shorttitle = $row[2];
$codename = $row[3];
$subtitle = $row[4];
$description = $row[5];
$sdescription = $row[6];
$image = $row[7];
$price = $row[8];
$url = $row[9];
$button = $row[10];
$sales = $row[11];

$retailer = $codename."_".$productID;;

if(isset($_GET['affid'])){
    $affid = $_GET['affid'];
  }else{
    $affid = "";
  }
  if(isset($_SESSION['affid'])){
    $affid = $_SESSION['affid'];
  }



  if(isset($_GET['click_id'])){
    $cid = $_GET['click_id'];
  }else{
    $cid = "";
  }
  if(isset($_SESSION['click_id'])){
    $cid = $_SESSION['click_id'];
  }



  if(isset($_GET['subid1'])){
    $subid1 = $_GET['subid1'];
  }else{
    $subid1 = "";
  }
  if(isset($_SESSION['subid1'])){
    $subid1 = $_SESSION['subid1'];
  }


  
  if(isset($_GET['subid2'])){
    $subid2 = $_GET['subid2'];
  }else{
    $subid2 = "";
  }
  if(isset($_SESSION['subid2'])){
    $subid2 = $_SESSION['subid2'];
  }

$FBmeta = <<<EOT
<meta property="og:title" content="$shorttitle Drawing & Reading">
<meta property="og:description" content="$subtitle">
<meta property="og:url" content="https://psychic-empress.com$url">
<meta property="og:image" content="https://psychic-empress.com/asets/img/email/$codename.jpg">
<meta property="product:brand" content="Facebook">
<meta property="product:availability" content="in stock">
<meta property="product:condition" content="new">
<meta property="product:price:amount" content="$price">
<meta property="product:price:currency" content="USD">
<meta property="product:retailer_item_id" content="$retailer">
<meta property="product:item_group_id" content="drawings_readings">
EOT;

$sql2 = "SELECT * FROM orders WHERE order_product = '" . $codename . "'";
$result2 = $conn->query($sql2);
$countsales = $result2->num_rows; //Count orders with this product

$sales = $sales + $countsales; //Combine orders from DB with fake value from product in DB
//$sales = number_format($sales);

$fsales = time();
$fsales = $fsales / 30;
$fsales = round($fsales);

$fsales = substr($fsales, 6);

$sales = $sales + $fsales;

include $_SERVER['DOCUMENT_ROOT'] . '/templates/rating/rating-total.php';


$reviews = $count;
$avgrating = $avg;

$pimage = $image;
include $_SERVER['DOCUMENT_ROOT'] . '/templates/schema.php';



?>


<div class="container product-container container-bg p-0 py-sm-2 py-md-3 py-xl-4 position-relative" style="height: 100%; overflow: auto;" data-layout="container" data-bs-spy="scroll" data-bs-target="#phone-navbar" data-bs-offset="50">
    <section class="py-0 light" id="banner">
        <!-- PRODUCT START -->
        <div class="card mb-3 rounded-3 section" id="purchase-product">
            <div class="card-body rounded-3" style="padding:0!important;">
                <div class="row row ms-auto w-100">
                    <!-- Content-->
                    <div class="col-lg-6 mb-2 mb-lg-0 p-0 p-md-2 p-lg-2">
                        
                            <!-- Product Gallery -->
                        <div class="product-badge-bestselling">
                        <i class="fas fa-fire"></i>
                        <span class="caption"> Bestseller!</span>
                        </div>

                        <div class="product-badge-toprated">
                        <i class="fas fa-star"></i>
                        <span class="caption"> Top Rated!</span>
                        </div>

                        <div class="product-badge-trending">
                        <i class="fas fa-bolt"></i>
                        <span class="caption"> Featured!</span>
                        </div>

                        <div class="product-badge-new">
                        <i class="fas fa-bell-plus"></i>
                        <span class="caption"> New!</span>
                        </div>
                        
                       
                        <ul id="lightSlider">
<?php 
$g = preg_grep('~\.(jpeg|jpg|png)$~', scandir($_SERVER['DOCUMENT_ROOT'].'/assets/img/products/'.$codename));

foreach ($g as $key=>$item){
    echo ' <li data-thumb="/assets/img/products/'.$codename.'/thumbs/'.$item.'"> <img src="/assets/img/products/'.$codename.'/'.$item.'" /> </li>';
}
?>

                    </ul> 
                    <div class="d-none d-lg-block mt-4">
                                <div class="bg-secondary rounded p-3 mt-2 mb-2 product-stats clearfix">
                                <span style="float:left;">
                                <i class="fas fa-star align-middle mb-0 mt-n1 mr-2"></i> Rating: </span>
                                <p class="h4 mb-0">
                                  <span class="fa fa-star"></span>
                                  <span class="fa fa-star"></span>
                                  <span class="fa fa-star"></span>
                                  <span class="fa fa-star"></span>
                                  <?php if ($avgrating < 4.51) { ?>
                                  <span class="fa fa-star-half"></span>
                                  <?php }else{ ?>
                                  <span class="fa fa-star"></span>
                                  <?php }?>
                                </p>
                                </div>

                                <div class="bg-secondary rounded p-3 mt-2 mb-2 product-stats product-stats-sales clearfix">
                                    <span style="float:left;">
                                    <i class="fas fa-shopping-cart align-middle mb-0 mt-n1 mr-2"></i> Sales: </span>
                                    <div class="h4 mb-0" data-countup='{"endValue":<?php echo $sales; ?>, "separator":" "}'>0</div>
                                </div>

                               

                                <div class="bg-secondary rounded p-3 mt-2 mb-2 product-stats product-stats-reviews clearfix">
                                    <span style="float:left;">
                                    <i class="fas fa-comments align-middle mb-0 mt-n1 mr-2"></i> Reviews: </span>
                                    <div class="h4 mb-0" data-countup='{"endValue":<?php echo $reviews; ?>, "separator":" "}'>0</div>
                                </div>

                                  </div>
                   
                        
                    </div> 
                    <!-- Right Part-->
                    <div class="col-lg-6 border-start rounded-3 px-3 px-md-4 px-lg-4 py-0 py-md-2 position-relative">

                    <div class="d-flex flex-column justify-content-start flex-fill product-details-column py-2">
                             

                                <h1 class="mb-2 product-title text-grad-1 mt-2 text-truncate"><?php echo $titleProduct; ?></h1>
                                <div class="under-title">
                                <span class="under-title-stock"><i class="fas fa-check-circle"></i> In Stock</span>
                                
                                 <a href="#reviews" title="Scroll to Reviews!" data-bs-placement="bottom" data-bs-toggle="tooltip" data-bs-original-title="Scroll to Reviews!">
                                 <span class="under-title-reviews"><i class="fas fa-comments"></i> <?php echo $reviews; ?> Reviews</span>
                                  <span class="fa fa-star"></span>
                                  <span class="fa fa-star"></span>
                                  <span class="fa fa-star"></span>
                                  <span class="fa fa-star"></span>
                                  <?php if ($avgrating < 4.51) { ?>
                                  <span class="fa fa-star-half"></span>
                                  <?php
}
else { ?>
                                  <span class="fa fa-star"></span>
                                  <?php
}?>
                                  
                                  </a>

                                 
                                
                                </div>
                                <hr>
                                <div class="d-flex flex-row flex-wrap align-items-center position-relative fs-4">
                                    <span class="badge me-0 new_prce">$<?php echo $price; ?></span>
                                    <span class="me-1 fs-1 text-600 old_price"><del class="me-1">$<?php echo $price * 10; ?></del></span>
                                    <div class="price-side">
                                     You save: <span class="saveda text-success">$<?php echo round($price * 9); ?> </span><span class="saved-percent">(90%)</span><span class="product-loop-down-arrow-wrap d-inline-block"></span> </div>
</div>
                                <hr>
                                <?php 
                                if(isset($_GET['f'])){
                                $r = $_GET['f'];
                                    if($r==1 OR $r==2 OR $r==3){
                                        if($r == 1) include $_SERVER['DOCUMENT_ROOT'] . '/templates/forms/interactive.php';
                                        if($r == 2) include $_SERVER['DOCUMENT_ROOT'] . '/templates/forms/normal.php';
                                        if($r == 3) include $_SERVER['DOCUMENT_ROOT'] . '/templates/forms/progressive.php';
                                    }
                                }else{
                                $r = rand(2,2);
                                if(isset($_SESSION['loggedIn'])) $r = 2;
                                    if($r==1 OR $r==2 OR $r==3){
                                        if($r == 1) include $_SERVER['DOCUMENT_ROOT'] . '/templates/forms/interactive.php';
                                        if($r == 2) include $_SERVER['DOCUMENT_ROOT'] . '/templates/forms/normal.php';
                                        if($r == 3) include $_SERVER['DOCUMENT_ROOT'] . '/templates/forms/progressive.php';
                                    }
                                }
                                ?>

                       
                                <hr>
                                
                                <?php 
                                if(isset($_SESSION['loggedIn'])) $countdownRandom = "no";
                                if($countdownRandom == "yes"){ 
                                ?>
                                <div><div class="elfsight-app-83415bf8-04e8-4c86-aa6e-1640cd17ee70"></div></div>
                                <?php } ?>

                                <div class="d-block d-lg-none pb-3">
                                <div class="bg-secondary rounded p-3 mt-2 mb-2 product-stats clearfix">
                                <span style="float:left;">
                                <i class="fas fa-star align-middle mb-0 mt-n1 mr-2"></i> Rating: </span>
                                <p class="h4 mb-0">
                                  <span class="fa fa-star"></span>
                                  <span class="fa fa-star"></span>
                                  <span class="fa fa-star"></span>
                                  <span class="fa fa-star"></span>
                                  <?php if ($avgrating < 4.51) { ?>
                                  <span class="fa fa-star-half"></span>
                                  <?php }else{ ?>
                                  <span class="fa fa-star"></span>
                                  <?php }?>
                                </p>
                                </div>

                                <div class="bg-secondary rounded p-3 mt-2 mb-2 product-stats product-stats-sales clearfix">
                                    <span style="float:left;">
                                    <i class="fas fa-shopping-cart align-middle mb-0 mt-n1 mr-2"></i> Sales: </span>
                                    <div class="h4 mb-0" data-countup='{"endValue":<?php echo $sales; ?>, "separator":" "}'>0</div>
                                </div>

                               

                                <div class="bg-secondary rounded p-3 mt-2 mb-2 product-stats product-stats-reviews clearfix">
                                    <span style="float:left;">
                                    <i class="fas fa-comments align-middle mb-0 mt-n1 mr-2"></i> Reviews: </span>
                                    <div class="h4 mb-0" data-countup='{"endValue":<?php echo $reviews; ?>, "separator":" "}'>0</div>
                                </div>

                                  </div>
                   



                                <?php //  include $_SERVER['DOCUMENT_ROOT'].'/templates/badges.php'; ?>
                                <?php //include $_SERVER['DOCUMENT_ROOT'].'/templates/product-discounts.php'; ?>

                    </div>

                    </div>
                    <!-- END SIDEBAR -->
                </div>
            </div>
        
        <!-- PRODUCT END -->
  <!-- HIGHLIGHTS START -->
  <div class="card mb-3 p-0 section" id="highlights">
        <div class="card-header bg-light py-3 px-4 topbar-gradient text-white">
                <div class="d-flex flex-between-center">
                    <h3 class="mb-0 fw-semibold fs-1 text-white "> What makes us special? </h3>
                </div>
            </div>
            <div class="card-body px-3 px-md-4 px-lg-4 py-3">
            
            <div class="row justify-content-center mt-4">
                <div class="col-xl-4 col-lg-4 col-md-12 col-12 mb-4">
                    <div class="info-item">
                        <div class="info-icon">
                            
                        <img src="/assets/img/placeholder.png" data-src="/assets/img/icons/ball.gif" class="lazyload" alt="Ball GIF"></div>
                        <div class="info-contentt">
                            <p class="h4 text-center">Beautiful Hand-Drawn Sketch</p>
                            <p class="text-center">Your psychic artist will draw a highly detailed and hand-drawn image addressed to you only. It can be printed off for your own framing if you'd like!</p>
                            <hr class="d-block d-xl-none mt-5">
                        </div>
                    </div>
                </div> <div class="col-xl-4 col-lg-4 col-md-12 col-12 mb-4">
                    <div class="info-item">
                        <div class="info-icon">
                        <img src="/assets/img/placeholder.png" data-src="/assets/img/icons/fortune.gif" class="lazyload" alt="Fortune GIF">
                        </div>
                        <div class="info-contentt">
                            <p class="h4 text-center">Experienced Psychic Artist</p>
                            <p class="text-center">Our psychics have been performing soulmate drawings & readings for years. This is a time-tested technique that has created excellent results for thousands of our clients.</p>
                            <hr class="d-block d-xl-none mt-5">
                        </div>
                    </div>
                </div> <div class="col-xl-4 col-lg-4 col-md-12 col-12 mb-4">
                    <div class="info-item">
                        <div class="info-icon">
                        <img src="/assets/img/placeholder.png" data-src="/assets/img/icons/tarot.png" class="lazyload" alt="Tarot Icon"></div>
                        <div class="info-contentt">
                            <p class="h4 text-center">Detailed Psychic Reading</p>
                            <p class="text-center">Using your name, birthday, and preferences our psychics use their deep understanding of tarot to provide an accurate depiction of your soulmate.</p>
                            <br class="d-block d-xl-none mt-5">
                          
                        </div>
                    </div>
                </div>
                         
                    </div>
        </div>
      
    </div>
        <!--  HIGHLIGHTS END -->
        <!-- DESCRIPTION START -->
        <div class="card mb-3 p-0 section" id="description">
        <div class="card-header bg-light py-3 px-4 topbar-gradient text-white">
                <div class="d-flex flex-between-center">
                    <h3 class="mb-0 fw-semibold fs-1 text-white "> <?php echo $titleProduct; ?> </h3>
                </div>
        </div>
        <div class="card-body px-3 px-md-4 px-lg-4 py-3">
        <div class="row justify-content-center mb-30-none">
        

        <div class="col-xl-8 col-lg-8 col-md-8 col-12 mb-4 d-flex flex-wrap align-content-around">
        <?php echo $description; ?>
        </div>
        <div class="col-xl-4 col-lg-4 col-md-4 col-12 mb-4">
        <img src="/assets/img/placeholder.png" data-src="/assets/img/icons/drawing.jpg" class="lazyload rounded-3 d-block mx-auto" alt="Drawing" style="width:70%;"></div>
        </div>
        </div>
        </div>
        <!-- DESCRIPTION END -->


      

       

        <!-- DESCRIPTION START -->
        <div class="card mb-3 p-0 section" id="more-info">
            <div class="card-header bg-light py-3 px-4  topbar-gradient ">
                <div class="d-flex flex-between-center">
                    <h3 class="mb-0 fw-semibold fs-1 text-white"> What is a Soulmate Drawing? </h3>
                </div>
            </div>
            <div class="card-body px-3 px-md-4 px-lg-4 py-3">
            <div class="row justify-content-center mb-30-none">
                    <div class="col-xl-4 col-lg-4 col-md-4 col-12 mb-4">
                    <img src="/assets/img/placeholder.png" data-src="/assets/img/icons/tarot-card.jpg" class="lazyload img-fluid" alt="Tarot Card"></div>
                    <div class="col-xl-8 col-lg-8 col-md-8 col-12 mb-4 d-flex flex-wrap align-content-around">
                        <p class="h3">What is a Soulmate Drawing?</p>
                        <p class="mb-3 more-info-paragraph">Simply put, a soulmate sketch is a drawing of your soul's other half performed by a psychic. Your psychic will use your metaphysical attributes to connect with your soul mate and do their best to recreate that image for you.</p>
                        <p class="mb-3 more-info-paragraph">Soulmate drawings can be important and meaningful, as many psychics see your soulmate's face in a vision. A true soulmate is eternal and exists beyond the physicality of the world. <strong>We all have someone out there for us</strong>, but finding that right person can take time too!</p>
                        <p class="mb-3 more-info-paragraph">Our sketches are unique, spiritual gifts that you will cherish forever.</p>
                        <p class="mb-3 more-info-paragraph">Hand-drawn portrait sketches should not be confused with a photograph or a work of art that you would purchase from an online shop. Whenever we speak to our clients or read their energy through clairvoyance, we receive images from spirits as well as feelings and sensations about their partner. This information comes through as symbol readings and images, that we sketch for you.</p>
                        <p class="mb-3 more-info-paragraph"><strong>Soulmate drawing is a psychic artist gift, and it is never the same</strong>. The reason why it is so difficult to find your perfect match is that there's so much competition out there! Every soul on this planet deserves true love, which is why we decided to create our business. We want you all to feel loved and happy with yourself.</p>
                
                    </div>
                </div>
             
            </div>
        </div>
        <!-- DESCRIPTION END -->

         <!-- MORE INFO START -->
         <div class="card mb-3 p-0 more-info">
        <div class="card-header bg-light py-3 px-4 topbar-gradient text-white">
                <div class="d-flex flex-between-center">
                    <h3 class="mb-0 fw-semibold fs-1 text-white "> Perfection takes time! </h3>
                </div>
            </div>
            <div class="card-body px-3 px-md-4 px-lg-4 py-3">
                <div class="row justify-content-center mb-30-none">
                    <div class="col-xl-8 col-lg-8 col-md-8 col-12 mb-4 d-flex flex-wrap align-content-around">
                        <p class="h3">Soulmate Drawings Are a Time-Consuming Activity That Can't Be Rushed or Controlled.</p>
                        <p class="mb-3 more-info-paragraph">We cannot rush the spirit world, that's how everything works here. This service will take time as well as patience since it takes an incredibly long time for each soulmate drawing to come through correctly for you.</p>
                        <p class="mb-3 more-info-paragraph">There are many steps involved in creating your portrait; including cleansing and meditating. <strong>Drawing someone's physical appearance takes time, even for a psychic artist</strong>.</p>
                        <p class="mb-3 more-info-paragraph">Your unique reading will be performed by a psychic.</p>
                        <p class="mb-3 more-info-paragraph">Our psychic abilities are channeled with the use of tarot to perform deep readings. This tarot spread is included with your soulmate drawings. These readings are incredibly deep and allow you to gain insight into yourself, your relationship, and the people involved. Our psychic readers are very experienced at what they do, meaning that <strong>each reading that comes through will be detailed and accurate.</strong></p>
                        <p class="mb-3 more-info-paragraph">This means that every soul will receive a different image of their soul mate since everyone in this world is unique.</p>
                    </div>
                    <div class="col-xl-4 col-lg-4 col-md-4 col-12 mb-4">
                    <img src="/assets/img/placeholder.png" data-src="/assets/img/icons/tarot-card2.jpg" class="lazyload img-fluid" alt="Tarot Card #2"></div>
                </div>
            </div>  
        </div>
        <!--  MORE INFO END -->

    
        <!-- Review List START -->
        <div class="card mb-3 p-0 section" id="reviews">
            <div class="card-header bg-light py-3 px-4 topbar-gradient text-white">
                <div class="d-flex flex-between-center">
                    <h3 class="mb-0 fw-semibold fs-1 text-truncate text-white" title="Reviews - <?php echo $reviews; ?>"> Reviews - <?php echo $reviews; ?> </h3>
                </div>
            </div>
            <div class="card-body p-2">
               <?php include("templates/rating/rating-product.php"); ?>
            </div>
        </div>
        <!-- Review List END -->
        <!-- FAQ START -->
        <div class="card mb-3 faq-card" id="faq">
        <div class="card-header bg-light py-3  px-4  topbar-gradient text-white">
                <div class="d-flex flex-between-center">
                    <h3 class="mb-0 fw-semibold fs-1 text-truncate text-white" title="Frequently Asked Questions"> Frequently Asked Questions</h3>
                </div>
            </div>
        <div class="card-body p-0 py-1">
            




<?php
//SQL Query for fetching FAQ from Database
$conn = new mysqli($servername, $username, $password, $db);
$sql = "SELECT * FROM faq ORDER BY id DESC";
$result = $conn->query($sql);
$count = $result->num_rows;
$i = 0;
?>




    <div class="accordion border-x border-top rounded" id="accordionFaq">
    <?php
            if($result->num_rows != 0) {
                while($row = $result->fetch_assoc()) {
                $i++;
                if($count==$i){ //Last loop
                    echo '
                    <div class="card shadow-none border-bottom">
                    <div class="card-header p-0" id="faqAccordionHeading'.$row["id"].'">
                        <button class="accordion-button btn btn-link text-decoration-none d-block w-100 py-3 px-4 border-0 text-start collapsed text-truncate" data-bs-toggle="collapse" data-bs-target="#collapseFaqAccordion'.$row["id"].'" aria-expanded="false" aria-controls="collapseFaqAccordion'.$row["id"].'">
                            <span class="fas fa-caret-right accordion-icon me-0" data-fa-transform="shrink-2"></span> 
                            <span class="fw-medium font-sans-serif text-900">'.$row["question"].'</span></button>
                    </div>
                    <div class="bg-light collapse" id="collapseFaqAccordion'.$row["id"].'" aria-labelledby="faqAccordionHeading'.$row["id"].'" data-parent="#accordionFaq" style="">
                        <div class="card-body p-2">
                            <p class="ps-3 py-3 mb-0">'.$row["answer"].'</p>
                        </div>
                    </div>
                </div>';  
                }else{
                echo '
                <div class="card shadow-none border-bottom rounded-bottom-0">
                <div class="card-header p-0" id="faqAccordionHeading'.$row["id"].'">
                    <button class="accordion-button btn btn-link text-decoration-none d-block w-100 py-3 px-4 border-0 text-start collapsed text-truncate" data-bs-toggle="collapse" data-bs-target="#collapseFaqAccordion'.$row["id"].'" aria-expanded="false" aria-controls="collapseFaqAccordion'.$row["id"].'">
                        <span class="fas fa-caret-right accordion-icon me-0" data-fa-transform="shrink-2"></span> 
                        <span class="fw-medium font-sans-serif text-900">'.$row["question"].'</span></button>
                </div>
                <div class="bg-light collapse" id="collapseFaqAccordion'.$row["id"].'" aria-labelledby="faqAccordionHeading'.$row["id"].'" data-parent="#accordionFaq" style="">
                    <div class="card-body p-2">
                        <p class="ps-3 py-3 mb-0">'.$row["answer"].'</p>
                    </div>
                </div>
            </div>';  
        }
            
        }
                } else {
                    echo "No FAQ";
                }
                  $conn->close();
                ?>


        
       
    </div>

        </div>
        
    </div>
        <!-- FAQ END -->



        <!--- NEWS ARTICLES -->
        <div class="card mb-3 p-0 articles-card">
            <div class="card-header bg-light py-3  px-4 topbar-gradient text-white">
            <div class=""><h3 class=" d-inline-block mb-0 fw-semibold fs-1 text-white"> Psychic Artist in Media </h3></div>
            </div>
            
        <div class="card-body px-3 px-md-4 px-lg-4 py-4">

        <div class="logo-slider">
        <div class="logos d-flex flex-wrap flex-row justify-content-around align-items-center">

        <a class="logofab" href="https://www.yahoo.com/lifestyle/wanna-know-soulmate-looks-psychic-152853147.html" target="_blank" data-bs-toggle="tooltip" data-bs-placement="top" title="Artist goes viral for selling 'realistic' drawings of people's soulmates">
        <img src="/assets/img/placeholder.png" data-src="/assets/img/logos/new/yahoo.png" class="lazyload landing-cta-img"  alt="Yahoo" >
        </a>

        <a class="logofab" href="https://www.theverge.com/21291864/tiktok-etsy-psychic-soulmate-drawing-trend-meme" target="_blank" data-bs-toggle="tooltip" data-bs-placement="top" title="I paid an Psychic Artist to draw my Soulmate">
        <img src="/assets/img/placeholder.png" data-src="/assets/img/logos/new/the-verge-logo.png" class="lazyload landing-cta-img"  alt="The Verge" >
    </a>

        <a class="logofab" href="https://www.foxnews.com/lifestyle/psychic-artist-on-etsy-trending-drawing-soul-mate" target="_blank" data-bs-toggle="tooltip" data-bs-placement="top" title="Psychic Artist gains popularity for drawing pictures of your soulmate">
        <img src="/assets/img/placeholder.png" data-src="/assets/img/logos/new/fox-news.png" class="lazyload landing-cta-img"  alt="Fox News" >
        </a>

        <a class="logofab" href="https://www.dailymail.co.uk/femail/article-8429195/Etsy-psychic-draw-soulmate-just-30.html" target="_blank" data-bs-toggle="tooltip" data-bs-placement="top" title="Singles go wild over Psychic Artist who will draw your Soulmate">
        <img src="/assets/img/placeholder.png" data-src="/assets/img/logos/new/daily-mail.png" class="lazyload landing-cta-img"  alt="Daily Mail" >
        </a>
        </div>

            </div>

            </div>
            </div>

        
        
        <!-- BUYER PROTECTION START -->
        <div class="card p-0 features-card">
        <div class="card-header bg-light py-3  px-4 topbar-gradient text-white">
                <div class="">
                <h3 class=" d-inline-block mb-0 fw-semibold fs-1 text-white"> Buyer Protection & Satisfaction </h3>
                </div>
            </div>
            <div class="card-body px-3 px-md-4 px-lg-4 py-4">
            
            <div class="row justify-content-center mb-30-none">
                <div class="col-xl-4 col-lg-4 col-md-4 col-4 mb-2">
                    <div class="info-item" title="We Protect Your Privacy!" data-bs-placement="bottom" data-bs-toggle="tooltip">
                        <div class="info-icon"><img src="/assets/img/icons/privacy.svg" alt="Ribbon"></div>
                        <div class="info-content d-none d-md-block">
                            <p class="">We Protect Your Privacy</p>
                        </div>
                    </div>
                </div> <div class="col-xl-4 col-lg-4 col-md-4 col-4 mb-2">
                    <div class="info-item" title="100% Satisfaction Guaranteed" data-bs-placement="bottom" data-bs-toggle="tooltip">
                        <div class="info-icon"><img src="/assets/img/icons/ribbon.svg" alt="Ribbon"></div>
                        <div class="info-content d-none d-md-block">
                            <p class="">100% Satisfaction Guaranteed</p>
                        </div>
                    </div>
                </div> <div class="col-xl-4 col-lg-4 col-md-4 col-4 mb-2">
                    <div class="info-item" title="Your Information Is Secure" data-bs-placement="bottom" data-bs-toggle="tooltip">
                        <div class="info-icon"><img src="/assets/img/icons/secure.svg" alt="Ribbon"></div>
                        <div class="info-content d-none d-md-block">
                            <p class="">Your Information Is Secure</p>
                        </div>
                    </div>
                </div>
                         
                    </div>
                    <div class="privacy-message alert alert-info">We Respect Your Privacy &amp; Information</div>
        </div>
       
    </div>
        <!--  BUYER PROTECTION END




            <div class="card card-body">
                <div class="media align-items-center align-items-md-start flex-column flex-md-row"> <a href="#" class="text-teal mr-md-3 align-self-md-center marginon-top" data-abc="true"> <i class="fa fa-question-circle-o fa-4x"></i> </a>
                    <div class="media-body text-center text-md-left">
                        <h6 class="media-title font-weight-semibold">Can't find what you're looking for?</h6> 'lorem ipsum' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident.
                    </div> <a href="#" class="btn align-self-md-center ml-md-3 mt-md-0 ticket-button" data-abc="true"><i class="fa fa-envelope-o mr-2"></i> Submit a ticket</a>
                </div>
            </div>
 -->

        
    </section>
</div>
<?php  

include $_SERVER['DOCUMENT_ROOT'].'/templates/navbar/phone-navbar.php';



$customJSPreload .= '

';

$customJS .= '

';
?>
