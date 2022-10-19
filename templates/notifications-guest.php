<?php
$NotifDisplay = $NotifPop = $NotifDisplayRead = $NotifDisplayUnread = "";

$NotifCounter = "1";
$NotifEClass = "notification-indicator notification-indicator-danger notification-indicator-fill fa-icon-wait";

?>

<li id="notif-button" class="nav-item dropdown nav-notifications btn btn-light p-0">
	<a class="nav-link p-2 px-lg-3 <?php echo $NotifEClass; ?>" id="navbarDropdownNotification" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"  data-bs-offset="0,15">
	<span class="fas fa-bell" style="font-size: 32px;"></span>
    <?php if($NotifCounter != "0"){ ?>
    <span class="notification-indicator-number"><?php echo $NotifCounter; ?></span>
    <?php } ?>
	</a>
	
	
	
	<div class="dropdown-menu dropdown-menu-end dropdown-menu-card dropdown-menu-notification" aria-labelledby="navbarDropdownNotification" data-bs-popper="none">
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

                            <div class="card-header">
				<div class="row justify-content-between align-items-center">
					<div class="col-auto">
						<p class="fs-1 fw-bold card-header-title mb-0" style="color:#344050;">Notifications</p>
					</div>
				
				</div>
			</div>

                       

                        <!--- NEW NOTIFICATIONS --->
                        <div class="list-group-title border-bottom">NEW</div>
							
<div class="list-group-item">
<a class="notification notification-flush notification-unread px-3 py-2" href="/shop/soulmate#purchase-product">
<div class="notification-avatar">
<div class="avatar avatar-3xl me-1">
<svg viewBox="0 0 48 48">
            <path class="hover-fillLight" fill="#F6A4EB" d="M41.364 21.886h6.538c.06.697.098 1.4.098 2.114 0 13.255-10.745 24-24 24S0 37.255 0 24 10.745 0 24 0c6.833 0 12.993 2.86 17.364 7.442v14.444z"></path>
            <path fill="#FFF" d="M37.746 37.4a1.3 1.3 0 0 1 .92-.38c.72 0 1.303.444 1.303 1.163 0 .503-.353.982-.708 1.292-3.484 3.122-8.325 5.53-13.783 5.53-11.75 0-19.486-9.538-19.486-18.83 0-8.72 7.195-16.19 15.25-16.19s11.227 5.54 11.227 5.54L37.747 37.4z"></path>
            <path class="hover-fillDark" fill="#9251AC" d="M47.995 24zm0 0c0-.995-.807-1.974-1.802-1.974-1.15 0-1.8.94-1.8 1.83-.09 3.174-1.228 7.127-3.453 10.182-2.355 3.232-6.91 6.956-13.242 6.956-7.625 0-13.213-5.767-13.213-11.925 0-4.3 2.886-7.17 5.828-7.17 1.588 0 2.48.683 2.965 1.312.362.468 1.063.493 1.482.074L40.968 7.032A23.926 23.926 0 0 1 47.995 24z"></path>
          </svg>
</div>
</div>

<div class="notification-body d-flex flex-row flex-wrap">
<p class="mb-0 fw-bold w-100 fw-bold">90% Discount is Applied</p>
<p class="mt-1 w-100 fw-semi-bold">When you purchase <b>Soulmate Drawing</b></p>
</div>
</a>
</div>



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
		</div>
	</div>
</li>