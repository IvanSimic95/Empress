<?php
$pagetitle = "Orders List";
$pagefile = "orders.php";
$orders = "";
include_once $_SERVER['DOCUMENT_ROOT'].'/admin/templates/head.php';

$sql = "SELECT * FROM orders WHERE order_status='processing' OR order_status='paid' OR order_status='completed' ORDER BY order_id DESC LIMIT 100";
$result = $conn->query($sql);

 while($row = $result->fetch_assoc()) {
    $product = strtolower($row["order_product"]);
    $productCodename =  strtolower($row["product_codename"]);
    $product = ucwords($product);
    $product = str_replace("  "," ",$product);
    switch ($product) {
        case "Husband":
         $product = "Future Husband Drawing";
         $productCodename = "futurespouse";
         $belowProduct = "Main Product";
          break;
      case "Pastlife":
          $product = "Past Life Drawing";
          $productCodename = "pastlife";
          $belowProduct = "Main Product";
          break;
      case "Baby":
          $product = "Future Baby Drawing";
          $productCodename = "futurebaby";
          $belowProduct = "Upsell #2";
          break;
      case "Soulmate":
          $product = "Soulmate Drawing";
          $productCodename = "soulmate";
          $belowProduct = "Main Product";
          break;
      case "Twinflame":
          $product = "Twin Flame Drawing";
          $productCodename = "twinflamme";
          $belowProduct = "Main Product";
          break;
          case "Future-baby":
              $product = "Future Baby Drawing";
              $productCodename = "futurebaby";
              $belowProduct = "Upsell #2";
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
$belowProduct = "Upsell #1";
break;

case "General Love":
$product = "Personal Reading";
$productCodename = "personal";
$belowProduct = "Upsell #1";
break;

case "General Love Career":
$product = "Personal Reading";
$productCodename = "personal";
$belowProduct = "Upsell #1";
break;

case "General Love Career Health":
$product = "Personal Reading";
$productCodename = "personal";
$belowProduct = "Upsell #1";
break;


case "Love":
$product = "Personal Reading";
$productCodename = "personal";
$belowProduct = "Upsell #1";
break; 

case "Love Career":
$product = "Personal Reading";
$productCodename = "personal";
$belowProduct = "Upsell #1";
break;

case "Love Career Health":
$product = "Personal Reading";
$productCodename = "personal";
$belowProduct = "Upsell #1";
break;


case "Career":
$product = "Personal Reading";
$productCodename = "personal";
$belowProduct = "Upsell #1";
break;

case "Career Health":
$product = "Personal Reading";
$productCodename = "personal";
$belowProduct = "Upsell #1";
break;

case "Health":
$product = "Personal Reading";
$productCodename = "personal";
$belowProduct = "Upsell #1";
break;

              
          }
            $status = $row["order_status"];
            $id = $row["order_id"];
            $price = $row["order_price"];
            $orderDate = $row["order_date"];
            $link = $row["link"];
            $userName = $row["user_name"];
            $orderEmail = $row["order_email"];
            $price = $row["order_price"];

            include $_SERVER['DOCUMENT_ROOT'].'/templates/progress.php';
            
            if($status=="processing"){
              $statusBadge = "badge badge rounded-pill d-block badge-soft-primary";
              $statusIcon = "<i class='fa fa-redo'></i>";
            }elseif($status=="completed"){
              $statusBadge =  "badge badge rounded-pill d-block badge-soft-success";
              $statusIcon = "<i class='fa fa-check'></i>";
            }elseif($status=="pending"){
              $statusBadge =  "badge badge rounded-pill d-block badge-soft-warning";
              $statusIcon = "<i class='fa fa-stream'></i>";
            }elseif($status=="canceled"){
              $statusBadge =  "badge badge rounded-pill d-block badge-soft-secondary";
              $statusIcon = "<i class='fa fa-ban'></i>";
            }else{
              $statusBadge =  "badge badge rounded-pill d-block badge-soft-secondary";
              $statusIcon = "<i class='fa fa-ban'></i>";
            }

            $time = time_ago($orderDate);
             
$orders .= <<<EOT

    <tr class="btn-reveal-trigger">
    <td class="order py-2 align-middle white-space-nowrap">
    <a href="../../../app/e-commerce/orders/order-details.html"> 
    <!--<img style="max-width:80%" class="img-thumbnail d-block mx-auto mb-1 mt-1" src="https://$domain/assets/img/products/$productCodename/1.jpg" alt="$product Product Image" />-->
    <strong>#$id</strong></a> by <strong>$userName</strong><br><a href="mailto:$orderEmail">$orderEmail</a>
    </td>
    <td class="date py-2 align-middle">$orderDate</td>
    <td class="address py-2 align-middle white-space-nowrap">$product</td>
    <td class="status py-2 align-middle text-center fs-0 white-space-nowrap"><span class="$statusBadge">$status $statusIcon </span></td>
    <td class="amount py-2 align-middle text-end fs-0 fw-medium">$$price</td>
  </tr>
EOT;


    }
    ?>
       
<div class="card mb-3" id="ordersTable" data-list="{&quot;valueNames&quot;:[&quot;order&quot;,&quot;date&quot;,&quot;address&quot;,&quot;status&quot;,&quot;amount&quot;],&quot;page&quot;:10,&quot;pagination&quot;:true}">
            <div class="card-header">
              <div class="row flex-between-center">
                <div class="col-4 col-sm-auto d-flex align-items-center pe-0">
                  <h5 class="fs-0 mb-0 text-nowrap py-2 py-xl-0">Orders</h5>
                </div>
                <div class="col-8 col-sm-auto ms-auto text-end ps-0">
                  <div class="d-none" id="orders-bulk-actions">
                    <div class="d-flex">
                      <select class="form-select form-select-sm" aria-label="Bulk actions">
                        <option selected="">Bulk actions</option>
                        <option value="Refund">Refund</option>
                        <option value="Delete">Delete</option>
                        <option value="Archive">Archive</option>
                      </select>
                      <button class="btn btn-falcon-default btn-sm ms-2" type="button">Apply</button>
                    </div>
                  </div>
                  <div id="orders-actions">
                    <button class="btn btn-falcon-default btn-sm" type="button"><svg class="svg-inline--fa fa-plus fa-w-14" data-fa-transform="shrink-3 down-2" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="plus" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" data-fa-i2svg="" style="transform-origin: 0.4375em 0.625em;"><g transform="translate(224 256)"><g transform="translate(0, 64)  scale(0.8125, 0.8125)  rotate(0 0 0)"><path fill="currentColor" d="M416 208H272V64c0-17.67-14.33-32-32-32h-32c-17.67 0-32 14.33-32 32v144H32c-17.67 0-32 14.33-32 32v32c0 17.67 14.33 32 32 32h144v144c0 17.67 14.33 32 32 32h32c17.67 0 32-14.33 32-32V304h144c17.67 0 32-14.33 32-32v-32c0-17.67-14.33-32-32-32z" transform="translate(-224 -256)"></path></g></g></svg><!-- <span class="fas fa-plus" data-fa-transform="shrink-3 down-2"></span> Font Awesome fontawesome.com --><span class="d-none d-sm-inline-block ms-1">New</span></button>
                    <button class="btn btn-falcon-default btn-sm mx-2" type="button"><svg class="svg-inline--fa fa-filter fa-w-16" data-fa-transform="shrink-3 down-2" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="filter" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg="" style="transform-origin: 0.5em 0.625em;"><g transform="translate(256 256)"><g transform="translate(0, 64)  scale(0.8125, 0.8125)  rotate(0 0 0)"><path fill="currentColor" d="M487.976 0H24.028C2.71 0-8.047 25.866 7.058 40.971L192 225.941V432c0 7.831 3.821 15.17 10.237 19.662l80 55.98C298.02 518.69 320 507.493 320 487.98V225.941l184.947-184.97C520.021 25.896 509.338 0 487.976 0z" transform="translate(-256 -256)"></path></g></g></svg><!-- <span class="fas fa-filter" data-fa-transform="shrink-3 down-2"></span> Font Awesome fontawesome.com --><span class="d-none d-sm-inline-block ms-1">Filter</span></button>
                    <button class="btn btn-falcon-default btn-sm" type="button"><svg class="svg-inline--fa fa-external-link-alt fa-w-16" data-fa-transform="shrink-3 down-2" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="external-link-alt" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg="" style="transform-origin: 0.5em 0.625em;"><g transform="translate(256 256)"><g transform="translate(0, 64)  scale(0.8125, 0.8125)  rotate(0 0 0)"><path fill="currentColor" d="M432,320H400a16,16,0,0,0-16,16V448H64V128H208a16,16,0,0,0,16-16V80a16,16,0,0,0-16-16H48A48,48,0,0,0,0,112V464a48,48,0,0,0,48,48H400a48,48,0,0,0,48-48V336A16,16,0,0,0,432,320ZM488,0h-128c-21.37,0-32.05,25.91-17,41l35.73,35.73L135,320.37a24,24,0,0,0,0,34L157.67,377a24,24,0,0,0,34,0L435.28,133.32,471,169c15,15,41,4.5,41-17V24A24,24,0,0,0,488,0Z" transform="translate(-256 -256)"></path></g></g></svg><!-- <span class="fas fa-external-link-alt" data-fa-transform="shrink-3 down-2"></span> Font Awesome fontawesome.com --><span class="d-none d-sm-inline-block ms-1">Export</span></button>
                  </div>
                </div>
              </div>
            </div>
            <div class="card-body p-0">
              <div class="table-responsive scrollbar">
                <table class="table table-sm table-striped fs--1 mb-0 overflow-hidden">
                  <thead class="bg-200 text-900">
                    <tr>
                      <th class="sort pe-1 align-middle white-space-nowrap" data-sort="order">Order</th>
                      <th class="sort pe-1 align-middle white-space-nowrap pe-7" data-sort="date">Date</th>
                      <th class="sort pe-1 align-middle white-space-nowrap" data-sort="address" style="min-width: 12.5rem;">Ship To</th>
                      <th class="sort pe-1 align-middle white-space-nowrap text-center" data-sort="status">Status</th>
                      <th class="sort pe-1 align-middle white-space-nowrap text-end" data-sort="amount">Amount</th>
                    </tr>
                  </thead>
                  <tbody class="list" id="table-orders-body">
                    
                  <?php echo $orders; ?>
                    
                  </tbody>
                </table>
              </div>
            </div>
            <div class="card-footer">
              <div class="d-flex align-items-center justify-content-center">
                <button class="btn btn-sm btn-falcon-default me-1 disabled" type="button" title="Previous" data-list-pagination="prev" disabled=""><svg class="svg-inline--fa fa-chevron-left fa-w-10" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="chevron-left" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512" data-fa-i2svg=""><path fill="currentColor" d="M34.52 239.03L228.87 44.69c9.37-9.37 24.57-9.37 33.94 0l22.67 22.67c9.36 9.36 9.37 24.52.04 33.9L131.49 256l154.02 154.75c9.34 9.38 9.32 24.54-.04 33.9l-22.67 22.67c-9.37 9.37-24.57 9.37-33.94 0L34.52 272.97c-9.37-9.37-9.37-24.57 0-33.94z"></path></svg><!-- <span class="fas fa-chevron-left"></span> Font Awesome fontawesome.com --></button>
                <ul class="pagination mb-0"><li class="active"><button class="page" type="button" data-i="1" data-page="10">1</button></li><li><button class="page" type="button" data-i="2" data-page="10">2</button></li><li><button class="page" type="button" data-i="3" data-page="10">3</button></li></ul>
                <button class="btn btn-sm btn-falcon-default ms-1" type="button" title="Next" data-list-pagination="next"><svg class="svg-inline--fa fa-chevron-right fa-w-10" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="chevron-right" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512" data-fa-i2svg=""><path fill="currentColor" d="M285.476 272.971L91.132 467.314c-9.373 9.373-24.569 9.373-33.941 0l-22.667-22.667c-9.357-9.357-9.375-24.522-.04-33.901L188.505 256 34.484 101.255c-9.335-9.379-9.317-24.544.04-33.901l22.667-22.667c9.373-9.373 24.569-9.373 33.941 0L285.475 239.03c9.373 9.372 9.373 24.568.001 33.941z"></path></svg><!-- <span class="fas fa-chevron-right">             </span> Font Awesome fontawesome.com --></button>
              </div>
            </div>
          </div>

<?php include_once $_SERVER['DOCUMENT_ROOT'].'/admin/templates/footer.php'; ?>