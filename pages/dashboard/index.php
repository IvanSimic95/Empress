<?php
include $_SERVER['DOCUMENT_ROOT'].'/templates/dashboard/login-function.php';
$breadcrumbsDisable = "1";
$title = "Dashboard | Psychic Empress"; 
$insertPage = "main";
$pageTitle1 = "Dashboard";
$sdescription = "Access your user account and your orders";
$customCSS = '
<!--=====================================CUSTOM CSS================================================-->
<link rel="stylesheet" type="text/css" href="/assets/css/overview.css">
<!--===============================================================================================-->
';
$customJS = <<<EOT
<script src="/vendors/select2/select2.min.js"></script>
EOT;

$include = $_SERVER['DOCUMENT_ROOT'].'/templates/dashboard/main.php';
    if(isset($_SESSION['loggedIn'])){ 
        if($_SESSION['loggedIn']=="yes"){ //Check if user is logged in
            include $_SERVER['DOCUMENT_ROOT'].'/templates/dashboard/menu.php'; ?>
            
                        <?php include $include; ?>
                        </div>
                  </div>
            </div>
<?php }}else{ include $_SERVER['DOCUMENT_ROOT'].'/templates/dashboard/login.php'; }?>
        </div>
    </section>
</div>