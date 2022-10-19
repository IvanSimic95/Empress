<style>

#sidebar-menu {
    padding: 0;
    border-radius: 10px
}
#sidebar-menu a{
    color:#fff;
}

#sidebar-menu .h4 {
    font-weight: 500;
    padding-left: 15px
}

#sidebar-menu ul {
    list-style: none;
    margin: 0;
    padding-left: 0rem
}

#sidebar-menu ul li {
    padding: 10px 0;
    display: block;
    padding-left: 1rem;
    padding-right: 1rem;
    border-left: 5px solid transparent;
    text-align:left;
}

#sidebar-menu ul li.active {
    border-left: 5px solid #fff;
    background-color: #22222280
}

#sidebar-menu ul li a {
    display: block
}

#sidebar-menu ul li a .fas,
#sidebar-menu ul li a .far {
    color: #ddd
}

#sidebar-menu ul li a .link {
    color: #fff;
    font-weight: 500
}

#sidebar-menu ul li a .link-desc {
    font-size: 0.8rem;
    color: #ddd
}

</style>
<?php
  $page = "overview";
  $r = $_SERVER['REQUEST_URI'];
  $firephp->fb($r,FirePHP::LOG);
  $superSplitURL = explode('/',$r);
  $superCount = count($superSplitURL);
  if($superCount === 2) $superSplitURL['2'] = "overview";
  if($superCount === 3) $page = $superSplitURL['2'];

          if($superSplitURL['0']=="dashboard"){
            $page = "overview";
            if($superSplitURL['1']=="order"){
                    $page = "order";
                }else{
                    $page = $superSplitURL['1'];
                }
                

          }elseif($superSplitURL['1']=="dashboard"){
            $page = "overview";
            if($superSplitURL['2']=="order"){
                    $page = "order";
                }else{
                    $page = $superSplitURL['2'];
                }
            
        }else{
        $page = "overview";
    }
    
?>

<div class="container-fluid py-0 px-0 px-md-3 py-md-3" data-layout="container">
    <section class="py-0 overflow-hidden light" id="banner">
        <div class="container p-0 pt-2 p-md-3 pt-md-3">

        <?php if(isset($_GET['loggedin'])){ ?>
                  <div class="alert alert-success border-2 d-flex align-items-center mt-3" role="alert">
                  <div class="bg-success me-3 icon-item"><span class="fas fa-check-circle text-white fs-3"></span></div>
                  <p class="mb-0 flex-1">You have logged in to your account!</p>
                  <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>
            <?php } ?>

            <div class="row gx-0 gy-2 g-xl-2 h-100">
            <div class="col-12 col-sm-12 col-xl-4 text-center py-2 order-2 order-md-1">
            <div class="py-2 px-0 light topbar-gradient rounded-3"> 
<div id="sidebar-menu" class="text-white">
<ul>

                    <li <?php if($page=="overview"){ ?>class="active" <?php } ?>> <a href="/dashboard" class="text-decoration-none d-flex align-items-start">
                            <div class="fas fa-box pt-2 me-3"></div>
                            <div class="d-flex flex-column">
                                <div class="link">My Account</div>
                                <div class="link-desc">Your Account Overview</div>
                            </div>
                        </a> </li>
                    <li <?php if($page=="order" OR $page=="orders"){ ?>class="active" <?php } ?>> <a href="/dashboard/orders" class="text-decoration-none d-flex align-items-start">
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
                    <li <?php if($page=="profile"){ ?>class="active" <?php } ?>> <a href="/dashboard/profile" class="text-decoration-none d-flex align-items-start">
                            <div class="fa fa-user-pen pt-2 me-3"></div>
                            <div class="d-flex flex-column">
                                <div class="link">My Profile</div>
                                <div class="link-desc">Change your profile details</div>
                            </div>
                        </a> </li>
                        <li <?php if($page=="support"){ ?>class="active" <?php } ?>> <a href="/dashboard/support" class="text-decoration-none d-flex align-items-start">
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

<?php include $_SERVER['DOCUMENT_ROOT'].'/templates/dashboard/single-order-sidebar.php'; ?>

</div>
              <div class="col-12 col-sm-12 col-xl-8 py-2 order-1 order-md-2">
                  <div class="p-0 flex-grow-1 d-flex flex-column">
                  <div class="card mb-3 p-0">
                        <div class="card-header bg-light p-4 py-3 topbar-gradient">
                            <div class="d-flex flex-between-center">
                                <h3 class="mb-0 fw-semibold fs-1" style="color:#fff;"><?php echo $pageTitle1; ?></h3>
                            </div>
                        </div>
                        <div class="card-body px-1 px-md-2 px-lg-3 py-2">