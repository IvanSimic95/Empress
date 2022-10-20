<?php
$NotifDisplay = $NotifPop = $NotifDisplayRead = $NotifDisplayUnread = $ReadAllShow = "";
if(isset($_SESSION['userID'])){

// Fetch User ID
$userID = $_SESSION['userID'];


//Grab notifications from DB
$sql = "SELECT * FROM notifications WHERE user_id = '$userID' ORDER BY id DESC";
$result = $conn->query($sql);

if($result->num_rows == 0) {
$noNotif = "You don't have any Notifications!";
$NotifCounter = 0;
$NotifEClass = "";
}else{
$noNotif = "";
$NotifEClass = "notification-indicator notification-indicator-danger notification-indicator-fill fa-icon-wait";
$NotifCounter = 0;


//Grab User Details
$sql2 = "SELECT * FROM users WHERE id = '$userID'";
$result2 = $conn->query($sql2);
$row2 = mysqli_fetch_assoc($result2);
        

//Grabbing all notifications, while loop
while($row = $result->fetch_assoc()) {
//Grab Notification Fields

$NotifID = $row['id'];
$NotifEmail = $row2['email'];
$NotifUser = $userID;
$NotifOrder = $row['order_id'];
$NotifURL = $row['url'];
$NotifUndread = $row['unread'];
$NotifTitle = $row['title'];
$NotifDescription = $row['description'];
$NotifCustom = $row['custom'];
$NotifTime = $row['time'];
$NotifTime = time_ago($NotifTime);

if($NotifOrder == "custom"){
  $LinkURL = $NotifURL;
  $LinkTitle = $NotifTitle;
}else{
  $LinkURL = "/dashboard/order/".$NotifOrder;
  $LinkTitle = "<b>Order #$NotifOrder:</b> ".$NotifTitle;
}

if($NotifUndread==1){
    $NotifCounter++;
$NotifDisplayUnread .= <<<EOT
<div class="list-group-item">
<a class="notification notification-flush notification-unread px-3 py-2" href="$LinkURL?notifRead=yes&notifID=$NotifID">
<div class="notification-avatar d-flex align-items-center">
<div class="avatar avatar-3xl m-0">
<img class="rounded-circle" src="/assets/img/logo-1.png" alt="">
</div>
</div>

<div class="notification-body d-flex flex-row flex-wrap">
<p class="mb-0 fw-bold w-50 fw-bold">$LinkTitle</p>
<span class="notification-time w-50 text-end fw-semi-bold"><i class="fa fa-timer"></i> $NotifTime</span>
<p class="mt-1 w-100 fw-semi-bold">$NotifDescription</p>
</div>
</a>
</div>


EOT;

}else{


$NotifDisplayRead .= <<<EOT
<div class="list-group-item">
<a class="notification notification-flush notification px-3 py-2" href="$LinkURL">
<div class="notification-avatar d-flex align-items-center">
<div class="avatar avatar-3xl m-0">
<img class="rounded-circle" src="/assets/img/logo-1.png" alt="">
</div>
</div>

<div class="notification-body d-flex flex-row flex-wrap">
<p class="mb-0 fw-bold w-50 fw-bold">$LinkTitle</p>
<span class="notification-time w-50 text-end fw-semi-bold"><i class="fa fa-timer"></i> $NotifTime</span>
<p class="mt-1 w-100 fw-semi-bold">$NotifDescription</p>
</div>
</a>
</div>
EOT;


}





}



  if($NotifCounter == 0) {
  $NotifEClass = "";
  $ReadAllShow = "0";
  $ReadAll = "#!";
  $NewShow = "0";
  }else{
  $NotifEClass = "notification-indicator notification-indicator-danger notification-indicator-fill fa-icon-wait";
  $ReadAllShow = "1";
  $ReadAll = "?notifRead=yes&notifID=all";
  $NewShow = "1";
  }


}

}else{
$noNotif = "There was a problem fetching your account user ID";

}
?>

<li class="nav-item dropdown nav-notifications btn btn-light p-0">
	<a class="nav-link p-2 px-lg-3 <?php echo $NotifEClass; ?>" id="navbarDropdownNotification" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-bs-offset="0,25">
	<span class="fas fa-bell" style="font-size: 32px;"></span>
    <?php if($NotifCounter != "0"){ ?>
    <span class="notification-indicator-number"><?php echo $NotifCounter; ?></span>
    <?php } ?>
	</a>
	
	
	
	<div class="dropdown-menu dropdown-menu-end dropdown-menu-card dropdown-menu-notification shadow-lg" aria-labelledby="navbarDropdownNotification" data-bs-popper="none">
		<div class="card card-notification shadow-sm">
		
			<div class="" style="max-height:19rem">
				<div class="os-resize-observer-host observed">
					<div class="os-resize-observer" style="left: 0px; right: auto;"></div>
				</div>
				<div class="os-size-auto-observer observed" style="height: calc(100% + 1px); float: left;">
					<div class="os-resize-observer"></div>
				</div>
				<div class="os-content-glue" style="margin: 0px; height: 515px; width: 450px;"></div>
				<div class="os-padding">
					<div class="os-viewport os-viewport-native-scrollbars-invisible" style="overflow-y: scroll;">
						<div class="os-content" style="padding: 0px; height: auto; width: 100%;">
							<div class="list-group list-group-flush fw-normal fs--1">

                            <div class="card-header topbar-gradient p-0">
				<div class="row justify-content-between align-items-center">
					<div class="col-auto">
						<p class="fs-1 fw-semi-bold card-header-title mb-0 px-4 py-3" style="color:#fff;">Notifications (<?php echo $NotifCounter; ?>)</p>
					</div>
          <?php if($ReadAllShow == 1){ ?>
					<div class="col-auto ps-0 ps-sm-4"><a class="card-link fw-semi-bold btn btn-light" href="<?php echo $ReadAll; ?>">Mark all as read <i class="fa-solid fa-circle-check"></i></a></div>
          <?php } ?>
				</div>
			</div>

                        <?php if($noNotif != ""){ ?>

                        <div class="alert alert-info border-2 d-flex align-items-center" role="alert">
                        <div class="bg-info me-3 icon-item"><span class="fas fa-info-circle text-white fs-3"></span></div>
                        <p class="mb-0 flex-1"><?php echo $noNotif; ?></p>
                        <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>

                        <?php }else{ ?>

                        <?php if($NewShow == 1){ ?>
                        <!--- NEW NOTIFICATIONS --->
                        <div class="list-group-title border-bottom">NEW</div>
                        <?php } ?>
							
						<?php echo $NotifDisplayUnread; ?>

                        <!--- OLD NOTIFICATIONS --->
						<div class="list-group-title border-bottom">EARLIER</div>
							
                        <?php echo $NotifDisplayRead; ?>


                        <?php } ?>
                        




							    </div>
						</div>
					</div>
				</div>
				<div class="os-scrollbar os-scrollbar-horizontal os-scrollbar-unusable os-scrollbar-auto-hidden">
					<div class="os-scrollbar-track os-scrollbar-track-off">
						<div class="os-scrollbar-handle" style="transform: translate(0px, 0px); width: 100%;"></div>
					</div>
				</div>
				<div class="os-scrollbar os-scrollbar-vertical os-scrollbar-auto-hidden">
					<div class="os-scrollbar-track os-scrollbar-track-off">
						<div class="os-scrollbar-handle" style="transform: translate(0px, 0px); height: 59.0291%;"></div>
					</div>
				</div>
				<div class="os-scrollbar-corner"></div>
			</div>
			<div class="card-footer text-center border-top"><a class="card-link d-block" href="app/social/notifications.html">View all</a></div>
		</div>
	</div>
</li>






<!---
     <div class="list-group-item">
									<a class="notification notification-flush notification-unread" href="#!">
										<div class="notification-avatar">
											<div class="avatar avatar-3xl me-1">
												<img class="rounded-circle" src="/assets/img/logo-1.png" alt="">
											</div>
										</div>
										<div class="notification-body">
											<p class="mb-1"><strong>Psychic Empress</strong> completed your order: "Soulmate Drawing & Reading"</p>
											<span class="notification-time"><span class="me-2" role="img" aria-label="Emoji"><i class="fa fa-check"></i></span>Just now</span>
										</div>
									</a>
								</div>

-->