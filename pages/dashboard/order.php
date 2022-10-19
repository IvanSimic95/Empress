<?php
if(!isset($_SESSION['loggedIn'])){
header("Location: /dashboard");
die();
}
$title = "Order #".$viewOrder." - Dashboard | Psychic Artist";
$insertPage = "order";
$pageTitle1 = "Order #".$viewOrder."";
$sdescription = "Take a look at your order details!";
$include = $_SERVER['DOCUMENT_ROOT'].'/templates/dashboard/order.php';

include $_SERVER['DOCUMENT_ROOT'].'/templates/dashboard/menu.php'; 

$title = "Order #".$viewOrder; 
$sql = "SELECT * FROM orders WHERE order_id = '$viewOrder'";
$result = $conn->query($sql);

if($result->num_rows == 0) {
    $errorDisplay = "Unknown order or you don't have access to it!";
    include $_SERVER['DOCUMENT_ROOT'].'/templates/error/view-order.php'; 
    }else{

        $row = mysqli_fetch_assoc($result);        
    $id = $row['order_id'];
    $status = $row['order_status'];
    $orderTIme = $row['order_date'];
    $price = $row['order_price'];
    
    $fName = $row['first_name'];
    $lName = $row['last_name'];
    $age = $row['user_age'];
    $email = $row['order_email'];
    
    $drawing = $row['drawing'];
    $reading = $row['reading'];
?>
  <div class="row ">
    <div class="col-12 order-2 order-md-1">
                  
<?php
    if($_SESSION['email'] != $email){
        $errorDisplay = "Unknown order or you don't have access to it!";
        include $_SERVER['DOCUMENT_ROOT'].'/templates/error/view-order.php'; 
    }else{
        include $_SERVER['DOCUMENT_ROOT'].'/templates/progress.php'; 
        
    ?>
    </div>
    <div class="col-12 order-1 order-md-2">
<?php

if($status == "completed"){
    echo $statusProgress;
?>

<?php if($drawing != "/assets/img/products/soulmate.png"){ ?>
<img class="img-thumbnail d-block mx-auto mb-2 mt-2" src="<?php echo $drawing; ?>" alt="Drawing" />
<?php } ?>


<p class="p-3 mb-3 mt-2"><?php echo nl2br($reading);?></p>

<?php }elseif($status == "canceled"){ ?>
<p class="h3 text-center mt-4 mb-4">Order Status: <span style="text-transform:capitalize;"><?php echo $status; ?></span></p>
<p class="h6 text-center mb-7">Order was canceled because we didn't find your payment, you can re-order on our shop page!</p>
<div class="mb-7"><?php echo $statusProgress; ?> </div>

   


<?php

}else{  
    echo $statusProgress;
    ?>
<p class="h3 text-center mt-4 mb-3">Order Status: <span style="text-transform:capitalize;"><?php echo $status; ?></span></p>
<p class="h6 text-center mb-2">Once order status is completed you will be able to see your order reading and/or drawing!</p>

<span title="Drawing is not ready yet, processing!" class="placeholder-glow placeholder img-thumbnail d-block mx-auto mb-2 rounded-3" style="height:600px;"></span>
<p class="card-title placeholder-glow"><span class="placeholder col-6"></span></p>
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
   

<?php }}}?>
            </div>


         
      </div>
  </div>
            
        </div>
    </section>
</div>
</div></div>
<?php

      


$customCSS .= <<<EOT
<style>
.steps {
    margin: -1rem!important;
    margin-top: 0!important;
    margin-bottom: 1rem!important;
}
.steps-header {
    padding: 0.5rem;
    border-bottom: 1px solid #e7e7e7;
    height: 45px;
}
.steps-body {
    display: table;
    table-layout: fixed;
    width: 100%;
    height: 100px;
}
</style>
EOT;

?>