<?php
$title = "Order Log"; 
$sdescription = "Show all orders";

$file = file($_SERVER['DOCUMENT_ROOT'].'logs/order.log');
$a = array();
foreach($file as $log){
    $a[] = explode ('|', $log);
}


// Recursively traverses a multi-dimensional array.
function traverseArray($array)
{ 
	// Loops through each element. If element again is array, function is recalled. If not, result is echoed.
	foreach($array as $key=>$value)
	{ 
		if(is_array($value))
		{ 
			traverseArray($value); 
            echo '<tr class="align-middle">';
		}else{
            switch ($value) {
                case '1':
                $value = "Soulmate";
                break;
                    case '2':
                    $value = "Twin Flame";
                    break;
                        case '3':
                        $value = "Future Spouse";
                        break;
                            case '4':
                            $value = "Past Life";
                            break;
            }
            echo '<td class="text-nowrap">'.$value.'</td>';
		} 
	}
}

?>
<div class="container-fluid" data-layout="container" style="padding:0!important;padding-top:20px!important;">
    <section class="py-0 light" id="banner">
        <div class="container">


            <div class="card mb-3">
                <div class="bg-holder d-none d-lg-block bg-card" style="background-image:url(/assets/img/icons/spot-illustrations/corner-4.png);"></div>
                    <div class="card-body position-relative">
                    <div class="row">
                    <div class="col-lg-12">
                    <div class="table-responsive scrollbar">
  <table class="table table-hover table-striped overflow-hidden">
    <!--<thead>
      <tr>
        <th scope="col">Date</th>
        <th scope="col">IP</th>
        <th scope="col">Name</th>
        <th scope="col">Email</th>
        <th scope="col">DoB</th>
        <th scope="col">Product</th>
        <th scope="col">Priority</th>
      </tr>
    </thead>-->
    <tbody>

    <?php traverseArray($a); ?>
     
     

    </tbody>
  </table>
</div>
                    </div>
              </div>
            </div>


        </div>
    </section>
</div>