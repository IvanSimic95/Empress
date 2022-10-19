<?php if($page=="order"){ ?>

<?php
$title = "Order #".$viewOrder; 
$sql = "SELECT * FROM orders WHERE order_id = '$viewOrder'";
$result = $conn->query($sql);


    if($result->num_rows == 0) {
    //$errorDisplay = "Unknown order or you don't have access to it!";
    }else{

    $row = mysqli_fetch_assoc($result);        
    $id = $row['order_id'];
    $status = $row['order_status'];
    $orderTime = $row['order_date'];
    $price = $row['order_price'];
    
    $fName = $row['first_name'];
    $lName = $row['last_name'];
    $age = $row['user_age'];
    $email = $row['order_email'];

    $productCodename = strtolower($row['order_product']);
    $product = $row['product_nice'];
    $productCodee = $row['product_codename'];

    $displayPtooltip = $product;
    
    $drawing = $row['drawing'];
    $reading = $row['reading'];

    $FTime = time_ago($orderTime);

      switch ($productCodee) {
      case '1':
      $displayPName = "Soulmate Drawing";
      break;

      case '2':
      $displayPName = "Soulmate Drawing";
      break;

      case '3':
      $displayPName = "Soulmate Drawing";
      break;

      case 'personal':
      $displayPName = "Personal Reading";
      break;
      
      default:
      $displayPName = "Soulmate Drawing";
      break;
    }
    }
    ?>
<div class="card mt-4 p-0">
<div class="card-header p-3 topbar-gradient">
    <div class="d-flex flex-between-center">
        <h3 class="mb-0 fw-semibold fs-1" style="color:#fff;">Order Information</h3>
    </div>
</div>
        
<div class="card-body p-2 rounded-3">

<div class="bg-secondary rounded p-3 mt-2 mb-2 product-stats product-stats-sales clearfix">
<span style="float:left;">Product: </span>
<span class="fw-semi-bold" style="cursor:pointer; float:right;text-transform:capitalize;" data-bs-toggle="tooltip" data-bs-placement="top" title="<?php echo $displayPtooltip; ?>"><?php echo $displayPName; ?></span>
</div>

<div class="bg-secondary rounded p-3 mt-2 mb-2 product-stats product-stats-sales clearfix">
<span style="float:left;">Status: </span>
<span class="fw-semi-bold" style="float:right;text-transform:capitalize;"><?php echo $status; ?></span>
</div>

<div class="bg-secondary rounded p-3 mt-2 mb-2 product-stats product-stats-sales clearfix">
<span style="float:left;">Date: </span>
<span class="fw-semi-bold" style="cursor: pointer; float:right;text-transform:capitalize;" data-bs-toggle="tooltip" data-bs-placement="top" title="Created on <?php echo $orderTime; ?>"><?php echo $FTime; ?> </span>
</div>

<div class="bg-secondary rounded p-3 mt-2 mb-2 product-stats product-stats-sales clearfix">
<span style="float:left;">Order ID: </span>
<span class="fw-semi-bold" style="float:right;text-transform:capitalize;">#<?php echo $id; ?></span>
</div>







            
        
</div>        
</div>

<div class="card mt-4 p-0">
<div class="card-header p-3 topbar-gradient">
    <div class="d-flex flex-between-center">
        <h3 class="mb-0 fw-semibold fs-1" style="color:#fff;">Order Updates</h3>
    </div>
</div>
        
<div class="card-body p-0 rounded-3">
<div class="table-responsive scrollbar rounded-3">
            <table class="table table-sm table-striped fs--1 mb-0 overflow-hidden">
              <thead class="bg-200 text-900">
                <tr>
                  <th class="text-start sort p-2" data-sort="date">Date & Time</th>
                  <th class="text-start sort p-2" data-sort="date">Update</th>

                </tr>
              </thead>
              <tbody class="list" id="table-orders-body">

              <?php
$sql = "SELECT * FROM orders_log WHERE order_id = '$viewOrder' ORDER BY time DESC";
$result = $conn->query($sql);


if($result->num_rows == 0) {
$EmptyLog = "No data!";
}else{
$EmptyLog = "";
echo $EmptyLog;
}
while($row = $result->fetch_assoc()) {
$id = $row["id"];
$orderID = $row["order_id"];
$type = $row["type"];
$time = $row["time"];
$notice = $row["notice"];

$FormatTime = time_ago($time);

echo '
<tr>
<td style="text-transform:capitalize;" class="text-start date p-2" title="'.$time.'">'.$FormatTime.'</td>
<td style="text-transform:capitalize;" class="text-start address p-2">'.$notice.'</p></td>
</tr>
';
}
?>

            
            </tbody>
            </table>
          </div>
</div>        
</div>
<?php  } ?>