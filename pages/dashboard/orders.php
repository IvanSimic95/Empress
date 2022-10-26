<?php
if(!isset($_SESSION['loggedIn'])){
header("Location: /dashboard");
die();
}
$title = "Dashboard - Orders | Psychic Empress"; 
$insertPage = "orders";
$pageTitle1 = "All Orders";
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

$include = $_SERVER['DOCUMENT_ROOT'].'/templates/dashboard/orders.php';
include $_SERVER['DOCUMENT_ROOT'].'/templates/dashboard/menu.php'; ?>

           
            <?php include $include; ?>
            </div>


         
      </div>
  </div>
            
        </div>
    </section>
</div>