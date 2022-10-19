<?php
include_once $_SERVER['DOCUMENT_ROOT'].'/templates/config.php';

if(isset($_GET['id'])){
    $userID = str_replace("PA","",$_GET['id']);
}else{
    $userID = "19481";
}

if($domain == "pa.test"){
  $userID = "19481";
}

$sql = "SELECT * FROM orders WHERE user_id = '$userID' ORDER BY order_id DESC";
$result = $conn->query($sql);

 while($row = $result->fetch_assoc()) {
            include_once $_SERVER['DOCUMENT_ROOT'].'/templates/order-switch.php';
            include $_SERVER['DOCUMENT_ROOT'].'/templates/progress.php';
            
            if($status=="pending"){
                $orderBTN = '<a target="_blank" href="'.$link.'" class="btn btn-dark text-uppercase w-100 mt-2">Purchase - $'.$price.'</a>';
            }elseif($status=="canceled"){
                $orderBTN = '';
            }else{
                $orderBTN = '<a href="/dashboard/order/'.$id.'" class="btn btn-dark text-uppercase w-100 mt-2">Order Details</a>';
            }

            $time = time_ago($orderDate);
             
            $orders = <<<EOT

            <div class="card mb-3 mt-2">
                <div class="card-body d-flex align-items-center p-2">
                    <div class="row g-3 mb-3">
                    <div class="col-12 col-lg-4 p-3 d-flex flex-column text-center">
                        <div class="text-uppercase fw-bold mb-0 text-grad-1 display-6">Order #$id</div>
                        <div class="product mb-2">$product</div>
                        <img style="max-width:80%" class="img-thumbnail d-block mx-auto mb-1 mt-1" src="https://$domain/assets/img/products/$productCodename/1.jpg" alt="$product Product Image" />
                    </div>
                    <div class="col-12 col-lg-8 d-flex flex-column justify-content-between order-summary p-3 text-center orders-list">
                        
                        $statusProgress
                        
                    </div>
                    </div>
                </div>
            </div>
    EOT;
echo $orders;
    }


            ?>