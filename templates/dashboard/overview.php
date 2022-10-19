<?php if(isset($_GET['loggedin'])){ 
//CrowdPowerLogin($userID, $userEmail, $userName);
?>
      <div class="alert alert-success border-2 d-flex align-items-center mt-3" role="alert">
      <div class="bg-success me-3 icon-item"><span class="fas fa-check-circle text-white fs-3"></span></div>
      <p class="mb-0 flex-1">You have logged in to your account!</p>
      <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
        <?php } ?>
<div class="row gx-0 gy-2 g-xl-4 h-100">
    <div class="col-12 col-sm-12 col-xl-4 text-center py-2">
      <div class="py-2 px-0 light topbar-gradient rounded-3">
         
       
   
          <?php include $_SERVER['DOCUMENT_ROOT'].'/templates/dashboard/menu.php'; ?>

          
 

  
  </div>
  <?php 
  
switch ($page) {          
case 'overview':
$title = "Dashboard | Psychic Artist"; 
$insertPage = "main";
$pageTitle1 = "Dashboard > Account Overview";
$sdescription = "Access your user account and your orders";
$customCSS = '
<!--=====================================CUSTOM CSS================================================-->
<link rel="stylesheet" type="text/css" href="/assets/css/overview.css">
<!--===============================================================================================-->
';
$customJS = <<<EOT
<script src="/vendors/select2/select2.min.js"></script>
EOT;
break;

case 'orders':
$title = "Dashboard - Orders | Psychic Artist"; 
$insertPage = "orders";
$pageTitle1 = "Dashboard > Orders";
$sdescription = "A full list of all your orders in one place";
$customCSS = '
<!--=====================================CUSTOM CSS================================================-->
<link rel="stylesheet" type="text/css" href="/vendors/animate/animate.css">
<!--===============================================================================================-->
<link rel="stylesheet" type="text/css" href="/vendors/select2/select2.min.css">
<!--===============================================================================================-->
<link rel="stylesheet" type="text/css" href="/vendors/perfect-scrollbar/perfect-scrollbar.css">
<!--===============================================================================================-->
<link rel="stylesheet" type="text/css" href="/assets/css/orders.css">
<!--===============================================================================================-->
';
$customJS = <<<EOT
<script src="/vendors/select2/select2.min.js"></script>
EOT;
break;

    case 'order':
    $title = "Order #".$viewOrder." - Dashboard | Psychic Artist";
    $insertPage = "order";
    $pageTitle1 = "Order #".$viewOrder."";
    $sdescription = "Take a look at your order details!";
    break;

            case 'profile':
            $title = "Dashboard - Profile | Psychic Artist"; 
            $insertPage = "profile";
            $pageTitle1 = "Dashboard > Profile";
            $sdescription = "Manage & Edit your user profile";
            break;
              
            default:
            $insertPage = "main";
            $pageTitle1 = "Dashboard";
            $sdescription = "Access your user account and your orders";
            break;
          }
         
          $include = $_SERVER['DOCUMENT_ROOT'].'/templates/dashboard/'.$insertPage.'.php';
         
          ?>

  <div class="col-12 col-sm-12 col-xl-8 py-2">
      <div class="p-0 flex-grow-1 d-flex flex-column">

     

      <div class="card mb-3 p-0">
            <div class="card-header bg-light px-1 px-md-2 px-lg-3 py-3 py-1 topbar-gradient">
                <div class="d-flex flex-between-center">
                    <h3 class="mb-0 fw-semibold fs-1" style="color:#fff;"><?php echo $pageTitle1; ?></h3>
                </div>
            </div>
            <div class="card-body px-1 px-md-2 px-lg-3 py-0">
            <?php include $include; ?>
            </div>


         
      </div>
  </div>