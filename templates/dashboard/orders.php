<?php
$order_email = $_SESSION['email'];
$sql = "SELECT * FROM orders WHERE (order_email = '$order_email' AND order_status='paid') OR (order_email = '$order_email' AND order_status='processing') OR (order_email = '$order_email' AND order_status='completed') OR (order_email = '$order_email' AND order_status='pending') ORDER BY order_id DESC";
$result = $conn->query($sql);
$orders = "";
 while($row = $result->fetch_assoc()) {
    $product = strtolower($row["order_product"]);
    $productCodename =  strtolower($row["product_codename"]);
    $product = ucwords($product);
    $product = str_replace("  "," ",$product);
    switch ($product) {
        case "Husband":
         $product = "Future Husband Drawing";
         $productCodename = "futurespouse";
          break;
      case "Pastlife":
          $product = "Past Life Drawing";
          $productCodename = "pastlife";
          break;
      case "Baby":
          $product = "Future Baby Drawing";
          $productCodename = "futurebaby";
          break;
      case "Soulmate":
          $product = "Soulmate Drawing";
          $productCodename = "soulmate";
          break;
      case "Twinflame":
          $product = "Twin Flame Drawing";
          $productCodename = "twinflamme";
          break;
          case "Future-baby":
              $product = "Future Baby Drawing";
              $productCodename = "futurebaby";
              break;

              /*
              case "General":
              $product = "Personal Reading: General";
              break;

              case "General Love":
              $product = "Personal Reading: General & Love";
              break;

              case "General Love Career":
              $product = "Personal Reading: General, Love & Career";
              break;

              case "General Love Career Health":
              $product = "Personal Reading: General, Love, Career & Health";
              break;

              
              case "Love":
              $product = "Personal Reading: Love";
              break; 

              case "Love Career":
              $product = "Personal Reading: Love & Career";
              break;

              case "Love Career Health":
              $product = "Personal Reading: Love, Career & Health";
              break;


              case "Career":
              $product = "Personal Reading: Career";
              break;

              case "Career Health":
              $product = "Personal Reading: Health & Career";
              break;
  
              case "Health":
              $product = "Personal Reading: Health";
              break;
*/
case "General":
$product = "Personal Reading";
$productCodename = "personal";
break;

case "General Love":
$product = "Personal Reading";
$productCodename = "personal";
break;

case "General Love Career":
$product = "Personal Reading";
$productCodename = "personal";
break;

case "General Love Career Health":
$product = "Personal Reading";
$productCodename = "personal";
break;


case "Love":
$product = "Personal Reading";
$productCodename = "personal";
break; 

case "Love Career":
$product = "Personal Reading";
$productCodename = "personal";
break;

case "Love Career Health":
$product = "Personal Reading";
$productCodename = "personal";
break;


case "Career":
$product = "Personal Reading";
$productCodename = "personal";
break;

case "Career Health":
$product = "Personal Reading";
$productCodename = "personal";
break;

case "Health":
$product = "Personal Reading";
$productCodename = "personal";
break;

              
          }
            $status = $row["order_status"];
            $id = $row["order_id"];
            $price = $row["order_price"];
            $orderDate = $row["order_date"];
            $link = $row["link"];

            include $_SERVER['DOCUMENT_ROOT'].'/templates/progress.php';
            
            if($status=="pending"){
                $orderBTN = '<a target="_blank" href="'.$link.'" class="btn btn-dark text-uppercase w-100 mt-2">Purchase - $'.$price.'</a>';
            }elseif($status=="canceled"){
                $orderBTN = '';
            }else{
                $orderBTN = '<a href="/dashboard/order/'.$id.'" class="btn btn-dark text-uppercase w-100 mt-2">Order Details</a>';
            }

            $time = time_ago($orderDate);
             
            $orders .= <<<EOT

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
                        <div class="d-sm-flex align-items-sm-start justify-content-sm-between">$orderBTN</div>
                    </div>
                    </div>
                </div>
            </div>
    EOT;
    
    }
    
    echo $orders;
            ?>