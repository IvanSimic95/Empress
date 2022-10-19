<?php
$pagetitle = "Facebook Ads";
$pagefile = "ads.php";


$todaysDate = date("Y-m-d");
$date = $todaysDate;

$startDate = "$date";
$endDate = "$date";

if(isset($_GET['sdate'])){
$startDate = $_GET['sdate'];
}

if(isset($_GET['edate'])){
$endDate = $_GET['edate'];
}

?>
<?php include_once $_SERVER['DOCUMENT_ROOT'].'/admin/templates/head.php'; ?>

<div class="card mb-3">
<div class="card-header bg-light">
        <div class="row g-0 flex-between-center">
            <div class="col-lg-3 pe-lg-2">
<h4> <i class="fas fa-table me-1"></i>
                    Campaigns</h4>
</div>


                    <div class="col-lg-9 pe-lg-2">
                    <form class="form-inline" action="" method="get">
<div class="input-group">
<input type="text" name="sdate" class="form-control" id="sdate" value="<?php echo $startDate; ?>">
<input type="text" name="edate" class="form-control" id="edate" placeholder="End Date" value="<?php echo $endDate; ?>">
  <button class="btn btn-outline-secondary show-orders" type="submit">Save!</button>
</div></form>
</div>
        </div>
    </div>

    <div class="card-body p-0">
    <table id="datatablesSimple" class="display table table-bordered p-0" style="width:100%">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Sales</th>
                                <th>Spend</th>
                                <th>Profit</th>
                                <th>Per Sale</th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php
                            
                        include_once $_SERVER['DOCUMENT_ROOT'].'/admin/templates/campaigns.php';
                        ?>

                        </tbody>
                  
                    </table>
    </div>
    <div class="card-footer small text-muted"><i class="fa fa-clock" style="margin-right:5px;"></i>From: <?php echo $startDate; ?> - <?php echo $endDate; ?></div>
</div>
        
     
<?php include_once $_SERVER['DOCUMENT_ROOT'].'/admin/templates/footer.php'; ?>