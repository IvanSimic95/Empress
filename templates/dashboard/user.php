  <div class="row gx-0 gy-2 g-xl-4 h-100">
    <div class="col-12 col-sm-12 col-xl-4 text-center py-2">
      <div class="py-2 px-0 light topbar-gradient rounded-3">
         
       
   
          <?php include $_SERVER['DOCUMENT_ROOT'].'/templates/dashboard/menu.php'; ?>

          


          </div>
    </div>
  </div>


  <div class="col-12 col-sm-12 col-xl-8 py-2">
      <div class="p-0 flex-grow-1 d-flex flex-column">
          <?php include $_SERVER['DOCUMENT_ROOT'].'/templates/dashboard/orders.php'; ?>
      </div>
  </div>

<?php
$customJSPreload = '';
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
<script>
$(document).ready(function() {

  $('#orders tr').click(function() {
      var OrderID = $(this).attr("id");
      var path = "/dashboard/order/"
      var href = path.concat(OrderID);
      window.location = href;
  });

});
</script>
EOT;
?>