<?php
if($notificationsOn=="yes"){
if(isset($_SESSION['id'])){
//User is logged in, display user menu

?>

<li class="nav-item dropdown d-none d-sm-block">
            <a class="nav-link notification-indicator notification-indicator-warning notification-indicator-fill px-0 fa-icon-wait" id="navbarDropdownNotification" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-hide-on-body-scroll="data-hide-on-body-scroll"><span class="fas fa-bell" data-fa-transform="shrink-6" style="font-size: 33px;"></span><span class="notification-indicator-number">1</span></a>    <div class="dropdown-menu dropdown-menu-end dropdown-menu-card dropdown-menu-notification" aria-labelledby="navbarDropdownNotification">
                <div class="card card-notification shadow-none">
                  <div class="card-header">
                    <div class="row justify-content-between align-items-center">
                      <div class="col-auto">
                        <h6 class="card-header-title mb-0">Notifications</h6>
                      </div>
                      <div class="col-auto ps-0 ps-sm-3"><a class="card-link fw-normal" href="#">Mark all as read</a></div>
                    </div>
                  </div>
                  <div class="scrollbar-overlay os-host os-theme-dark os-host-resize-disabled os-host-scrollbar-horizontal-hidden os-host-scrollbar-vertical-hidden os-host-transition" style="max-height:19rem"><div class="os-resize-observer-host observed"><div class="os-resize-observer" style="left: 0px; right: auto;"></div></div><div class="os-size-auto-observer observed" style="height: calc(100% + 1px); float: left;"><div class="os-resize-observer"></div></div><div class="os-content-glue" style="margin: 0px;"></div><div class="os-padding"><div class="os-viewport os-viewport-native-scrollbars-invisible"><div class="os-content" style="padding: 0px; height: 100%; width: 100%;">
                    <div class="list-group list-group-flush fw-normal fs--1">
                      <div class="list-group-title border-bottom">NEW</div>
                      <div class="list-group-item">
                        <a class="notification notification-flush notification-unread" href="#!">
                          <div class="notification-avatar">
                            <div class="avatar avatar-2xl me-3">
                              <img class="rounded-circle" src="assets/img/team/1-thumb.png" alt="">
                            </div>
                          </div>
                          <div class="notification-body">
                            <p class="mb-1"><strong>Emma Watson</strong> replied to your comment : "Hello world 😍"</p>
                            <span class="notification-time"><span class="me-2" role="img" aria-label="Emoji">💬</span>Just now</span>
                          </div>
                        </a>
                      </div>
                      <div class="list-group-item">
                        <a class="notification notification-flush notification-unread" href="#!">
                          <div class="notification-avatar">
                            <div class="avatar avatar-2xl me-3">
                              <div class="avatar-name rounded-circle"><span>AB</span></div>
                            </div>
                          </div>
                          <div class="notification-body">
                            <p class="mb-1"><strong>Albert Brooks</strong> reacted to <strong>Mia Khalifa's</strong> status</p>
                            <span class="notification-time"><svg class="svg-inline--fa fa-gratipay fa-w-16 me-2 text-danger" aria-hidden="true" focusable="false" data-prefix="fab" data-icon="gratipay" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 496 512" data-fa-i2svg=""><path fill="currentColor" d="M248 8C111.1 8 0 119.1 0 256s111.1 248 248 248 248-111.1 248-248S384.9 8 248 8zm114.6 226.4l-113 152.7-112.7-152.7c-8.7-11.9-19.1-50.4 13.6-72 28.1-18.1 54.6-4.2 68.5 11.9 15.9 17.9 46.6 16.9 61.7 0 13.9-16.1 40.4-30 68.1-11.9 32.9 21.6 22.6 60 13.8 72z"></path></svg><!-- <span class="me-2 fab fa-gratipay text-danger"></span> Font Awesome fontawesome.com -->9hr</span>
                          </div>
                        </a>
                      </div>
                      <div class="list-group-title border-bottom">EARLIER</div>
                      <div class="list-group-item">
                        <a class="notification notification-flush" href="#!">
                          <div class="notification-avatar">
                            <div class="avatar avatar-2xl me-3">
                              <img class="rounded-circle" src="assets/img/icons/weather-sm.jpg" alt="">
                            </div>
                          </div>
                          <div class="notification-body">
                            <p class="mb-1">The forecast today shows a low of 20℃ in California. See today's weather.</p>
                            <span class="notification-time"><span class="me-2" role="img" aria-label="Emoji">🌤️</span>1d</span>
                          </div>
                        </a>
                      </div>
                      <div class="list-group-item">
                        <a class="border-bottom-0 notification-unread  notification notification-flush" href="#!">
                          <div class="notification-avatar">
                            <div class="avatar avatar-xl me-3">
                              <img class="rounded-circle" src="assets/img/logos/oxford.png" alt="">
                            </div>
                          </div>
                          <div class="notification-body">
                            <p class="mb-1"><strong>University of Oxford</strong> created an event : "Causal Inference Hilary 2019"</p>
                            <span class="notification-time"><span class="me-2" role="img" aria-label="Emoji">✌️</span>1w</span>
                          </div>
                        </a>
                      </div>
                      <div class="list-group-item">
                        <a class="border-bottom-0 notification notification-flush" href="#!">
                          <div class="notification-avatar">
                            <div class="avatar avatar-xl me-3">
                              <img class="rounded-circle" src="assets/img/team/10.jpg" alt="">
                            </div>
                          </div>
                          <div class="notification-body">
                            <p class="mb-1"><strong>James Cameron</strong> invited to join the group: United Nations International Children's Fund</p>
                            <span class="notification-time"><span class="me-2" role="img" aria-label="Emoji">🙋&zwj;</span>2d</span>
                          </div>
                        </a>
                      </div>
                    </div>
                  </div></div></div><div class="os-scrollbar os-scrollbar-horizontal os-scrollbar-unusable os-scrollbar-auto-hidden"><div class="os-scrollbar-track os-scrollbar-track-off"><div class="os-scrollbar-handle" style="transform: translate(0px, 0px);"></div></div></div><div class="os-scrollbar os-scrollbar-vertical os-scrollbar-unusable os-scrollbar-auto-hidden"><div class="os-scrollbar-track os-scrollbar-track-off"><div class="os-scrollbar-handle" style="transform: translate(0px, 0px);"></div></div></div><div class="os-scrollbar-corner"></div></div>
                  <div class="card-footer text-center border-top"><a class="card-link d-block" href="app/social/notifications.html">View all</a></div>
                </div>
              </div>
            </li>

            <?php 
}else{
    //User is NOT logged in, display default menu
?>


<li class="nav-item dropdown d-none d-sm-block">
            <a class="nav-link notification-indicator notification-indicator-warning notification-indicator-fill px-0 fa-icon-wait" id="navbarDropdownNotification" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-hide-on-body-scroll="data-hide-on-body-scroll"><span class="fas fa-bell" data-fa-transform="shrink-6" style="font-size: 33px;"></span>
            <span class="notification-indicator-number">0</span></a>    <div class="dropdown-menu dropdown-menu-end dropdown-menu-card dropdown-menu-notification" aria-labelledby="navbarDropdownNotification">
                <div class="card card-notification shadow-none">
                  <div class="card-header">
                    <div class="row justify-content-between align-items-center">
                      <div class="col-auto">
                        <h6 class="card-header-title mb-0">Notifications</h6>
                      </div>
                      <div class="col-auto ps-0 ps-sm-3"><a class="card-link fw-normal" href="#">Mark all as read</a></div>
                    </div>
                  </div>
                  <div class="scrollbar-overlay os-host os-theme-dark os-host-resize-disabled os-host-scrollbar-horizontal-hidden os-host-scrollbar-vertical-hidden os-host-transition" style="max-height:19rem"><div class="os-resize-observer-host observed"><div class="os-resize-observer" style="left: 0px; right: auto;"></div></div><div class="os-size-auto-observer observed" style="height: calc(100% + 1px); float: left;"><div class="os-resize-observer"></div></div><div class="os-content-glue" style="margin: 0px;"></div><div class="os-padding"><div class="os-viewport os-viewport-native-scrollbars-invisible"><div class="os-content" style="padding: 0px; height: 100%; width: 100%;">
                    <div class="list-group list-group-flush fw-normal fs--1">
                      <div class="list-group-title border-bottom">NEW</div>
                      <div class="list-group-item">
                        <a class="notification notification-flush notification-unread" href="#!">
                          <div class="notification-avatar">
                            <div class="avatar avatar-2xl me-3">
                              <img class="rounded-circle" src="assets/img/team/1-thumb.png" alt="">
                            </div>
                          </div>
                          <div class="notification-body">
                            <p class="mb-1"><strong>Emma Watson</strong> replied to your comment : "Hello world 😍"</p>
                            <span class="notification-time"><span class="me-2" role="img" aria-label="Emoji">💬</span>Just now</span>
                          </div>
                        </a>
                      </div>
                      <div class="list-group-item">
                        <a class="notification notification-flush notification-unread" href="#!">
                          <div class="notification-avatar">
                            <div class="avatar avatar-2xl me-3">
                              <div class="avatar-name rounded-circle"><span>AB</span></div>
                            </div>
                          </div>
                          <div class="notification-body">
                            <p class="mb-1"><strong>Albert Brooks</strong> reacted to <strong>Mia Khalifa's</strong> status</p>
                            <span class="notification-time"><svg class="svg-inline--fa fa-gratipay fa-w-16 me-2 text-danger" aria-hidden="true" focusable="false" data-prefix="fab" data-icon="gratipay" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 496 512" data-fa-i2svg=""><path fill="currentColor" d="M248 8C111.1 8 0 119.1 0 256s111.1 248 248 248 248-111.1 248-248S384.9 8 248 8zm114.6 226.4l-113 152.7-112.7-152.7c-8.7-11.9-19.1-50.4 13.6-72 28.1-18.1 54.6-4.2 68.5 11.9 15.9 17.9 46.6 16.9 61.7 0 13.9-16.1 40.4-30 68.1-11.9 32.9 21.6 22.6 60 13.8 72z"></path></svg><!-- <span class="me-2 fab fa-gratipay text-danger"></span> Font Awesome fontawesome.com -->9hr</span>
                          </div>
                        </a>
                      </div>
                      <div class="list-group-title border-bottom">EARLIER</div>
                      <div class="list-group-item">
                        <a class="notification notification-flush" href="#!">
                          <div class="notification-avatar">
                            <div class="avatar avatar-2xl me-3">
                              <img class="rounded-circle" src="assets/img/icons/weather-sm.jpg" alt="">
                            </div>
                          </div>
                          <div class="notification-body">
                            <p class="mb-1">The forecast today shows a low of 20℃ in California. See today's weather.</p>
                            <span class="notification-time"><span class="me-2" role="img" aria-label="Emoji">🌤️</span>1d</span>
                          </div>
                        </a>
                      </div>
                      <div class="list-group-item">
                        <a class="border-bottom-0 notification-unread  notification notification-flush" href="#!">
                          <div class="notification-avatar">
                            <div class="avatar avatar-xl me-3">
                              <img class="rounded-circle" src="assets/img/logos/oxford.png" alt="">
                            </div>
                          </div>
                          <div class="notification-body">
                            <p class="mb-1"><strong>University of Oxford</strong> created an event : "Causal Inference Hilary 2019"</p>
                            <span class="notification-time"><span class="me-2" role="img" aria-label="Emoji">✌️</span>1w</span>
                          </div>
                        </a>
                      </div>
                      <div class="list-group-item">
                        <a class="border-bottom-0 notification notification-flush" href="#!">
                          <div class="notification-avatar">
                            <div class="avatar avatar-xl me-3">
                              <img class="rounded-circle" src="assets/img/team/10.jpg" alt="">
                            </div>
                          </div>
                          <div class="notification-body">
                            <p class="mb-1"><strong>James Cameron</strong> invited to join the group: United Nations International Children's Fund</p>
                            <span class="notification-time"><span class="me-2" role="img" aria-label="Emoji">🙋&zwj;</span>2d</span>
                          </div>
                        </a>
                      </div>
                    </div>
                  </div></div></div><div class="os-scrollbar os-scrollbar-horizontal os-scrollbar-unusable os-scrollbar-auto-hidden"><div class="os-scrollbar-track os-scrollbar-track-off"><div class="os-scrollbar-handle" style="transform: translate(0px, 0px);"></div></div></div><div class="os-scrollbar os-scrollbar-vertical os-scrollbar-unusable os-scrollbar-auto-hidden"><div class="os-scrollbar-track os-scrollbar-track-off"><div class="os-scrollbar-handle" style="transform: translate(0px, 0px);"></div></div></div><div class="os-scrollbar-corner"></div></div>
                  <div class="card-footer text-center border-top"><a class="card-link d-block" href="app/social/notifications.html">View all</a></div>
                </div>
              </div>
            </li>

<?php
}} //End if else Loop?>