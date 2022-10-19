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
                    
<form id="normalproduct" class="form-order needs-validation display-block" name="order_form" action="/order/order" method="get">


<div class="form-floating form-floating-icon mb-2">
<input class="form-control" id="userName" type="text" name="userName" placeholder="Your Full Name" required="" />
<span class="icon-inside"><i class="fas fa-user"></i> </span>
<label for="userName">First & Last Name</label>
</div>





<div class="form-floating mb-2 form-floating-icon mb-3">

<input class="form-control " id="userDob" name="userDob" placeholder="DD-MM-YYYY" type="date" autocomplete="bday" inputmode="numeric" pattern="[0-9]*" type="text" required />
<span class="icon-inside"><i class="fa fa-clock"></i> </span>
<label for="userDob">Date of Birth</label>

</div>


<hr class="mb-3">

<div class="form-floating form-floating-icon">
<input class="form-control" id="userEmail" type="email" name="userEmail" placeholder="email@gmail.com" required="">
<span class="icon-inside"><i class="fas fa-envelope"></i> </span>
<label for="userEmail">E-mail Address</label>
</div>


<hr class="mb-3">

<div class="mb-2 mt-2 userDeliveryWrapper" style="display:block;">
<div class="position-relative">
<label class="fs-1 fw-semi-bold">Delivery Priority </label> 
<div class="product-badge product-available delivery-options mt-n1 dropdown-toggle" data-bs-toggle="collapse" href="#deliveryCollapse" role="button" aria-expanded="false" aria-controls="deliveryCollapse">
    <i class="fas fa-question-circle"></i><span class="delivery-full-text">Delivery Options</span> <span class="delivery-partial-text">Options</span>
</div>
</div>
<div id="delivery-speed" class="delivery-speed-clicked">
<div class="btn-group d-flex delivery-speed-flex" style="width:100%;" role="group" aria-label="Delivery Speed">

<div class="mb-111">
<input type="radio" class="btn-check" name="priority" id="prio12" value="12">
<label class="btn btn-outline-oran prio12" for="prio12"><span><i class="fas fa-bolt"></i> Express</span></label>
</div>

<div class="mb-111">
<input type="radio" class="btn-check" name="priority" id="prio24" value="24">
<label class="btn btn-outline-oran prio24" for="prio24"><span><i class="fas fa-stopwatch"></i> Fast</span></label>
</div>

<div class="mb-111">
<input type="radio" class="btn-check" name="priority" id="prio48" value="48" checked>
<label class="btn btn-outline-oran prio48" for="prio48"><span><i class="fas fa-clock"></i> Standard</span></label>
</div>
</div></div>
</div>



    <div class="collapse multi-collapse mb-3 mb-sm-0 show" id="deliveryCollapse">
        <div class="accordion mb-4" id="productPanels">
            <div class="accordion-item">
                <div class="accordion-header bg-light">
                <div class="d-flex flex-between-center">
                <h3 class="mb-0 fw-bold delivery-title"><i class="fas fa-shipping-fast" style="margin-right:15px;margin-left:20px;font-size:120%;"></i> <span class="title-text">Delivery Options</span> </h3>
                <a id="close-deliveryCollapse" class="btn btn-link btn-sm px-2" href="#!"><span class="fas fa-times" style="font-size: 200%!important;color: #000;"></span></a>
                </div>
                   
                </div>
                <div class="accordion-collapse collapse show" id="shippingOptions" data-bs-parent="#productPanels">
                    <div class="accordion-body fs-sm">
                        <div id="helper-delivery-express" class="d-flex justify-content-start border-bottom pb-2 align-items-center" style="cursor:pointer;">
                            <div class="px-3"><i class="fas fa-bolt"></i></div>
                        <div class="flex-grow-1">
                                <div class="fw-bold text-dark">Express <span class="delivery">Delivery</span></div>
                                <div class="fs-sm text-muted">8 - 12 <span class="hours">Hours</span><span class="h">H</span></div>
                            </div>
                            <div class="fw-bold badge bg-success">$14.99</div>
                        </div>


                        <div id="helper-delivery-fast" class="d-flex justify-content-start border-bottom py-2 align-items-center" style="cursor:pointer;">
                        <div class="px-3"><i class="fas fa-stopwatch"></i></div>
                        <div class="flex-grow-1">
                                <div class="fw-bold text-dark">Fast <span class="delivery">Delivery</span></div>
                                <div class="fs-sm text-muted">18 - 24 <span class="hours">Hours</span><span class="h">H</span></div>
                            </div>
                            <div class="fw-bold badge bg-success">$9.99</div>
                        </div>


                        <div id="helper-delivery-standard" class="d-flex justify-content-start pt-2 align-items-center" style="cursor:pointer;">
                        <div class="px-3"><i class="fas fa-clock"></i></div>
                        <div class="flex-grow-1">
                                <div class="fw-bold text-dark">Standard <span class="delivery">Delivery</span></div>
                                <div class="fs-sm text-muted">36 - 48 <span class="hours">Hours</span><span class="h">H</span></div>
                            </div>
                            <div class="fw-bold badge bg-success">$0.00</div>
                        </div>


                    </div>
                </div>
            </div>
        </div>
    </div>
    <hr class="mb-3">

<div class="error-container">
<ol>
</ol>
</div>
<?php if($btncolor == "green") { ?>
<style>
.btn-primary, .btn-primary:hover, .btn-primary:active, .btn-primary:focus, .btn-primary.active, .btn-primary.show {
color: #fff!important;
background-color: #00d27a!important;
border-color: #00d27a!important;
background-image: none!important;
box-shadow: 0 0.5rem 1.125rem -0.5rem #00d27a!important;
}
</style>

<?php } ?>


<input class="product" type="hidden" name="product" value="<?php echo $productID; ?>">
<input class="cookie" type="hidden" name="cookie_id" value="<?php echo $_SESSION['cookie']; ?>">
<input class="formused" type="hidden" name="formused" value="normal">
<input class="btncolor" type="hidden" name="btncolor" value="<?php echo $btncolor; ?>">
<input class="countdown" type="hidden" name="countdown" value="<?php echo $countdownRandom; ?>">
<input class="landingpage" type="hidden" name="landingpage" value="LP1">
<div class="mb-2 mt-3"> <input id="PlaceOrder" type="submit" name="form_submit" class="btn btn-submit-form btn-primary btn-shadow w-100 btn-add-to-cart mb-1 mt-1 fw-bold fs-2" value="Place an Order!"></div>



</form>
                    </div>
              </div>
            </div>


        </div>
    </section>
</div>