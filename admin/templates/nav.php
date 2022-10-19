
         <nav class="navbar navbar-light navbar-vertical navbar-expand-xl">
          <script>
            var navbarStyle = localStorage.getItem("navbarStyle");
            if (navbarStyle && navbarStyle !== 'transparent') {
              document.querySelector('.navbar-vertical').classList.add(`navbar-${navbarStyle}`);
            }
          </script>
        
        <div class="d-flex align-items-center">
            <a class="navbar-brand" href="../index.html">
              <div class="d-flex align-items-center py-3"><img class="me-2" src="/assets/img/logo-1.svg" alt="" width="40" /><span class="font-sans-serif">PA Admin</span>
              </div>
            </a>
          </div>
          <div class="collapse navbar-collapse" id="navbarVerticalCollapse">
            <div class="navbar-vertical-content scrollbar">
                <ul class="navbar-nav flex-column mb-3" id="navbarVerticalNav">
                   
                    <li class="nav-item">
                        
                    <a class="nav-link <?php if($pagefile == "index.php"){ echo "active";} ?>" href="/admin/" role="button" aria-expanded="false">
                        <div class="d-flex align-items-center"><span class="nav-link-icon"><span class="fas fa-chart-pie"></span></span><span class="nav-link-text ps-1">Dashboard</span></div>
                    </a>

                    <div class="row navbar-vertical-label-wrapper mt-3 mb-2">
                    <div class="col-auto navbar-vertical-label">Data</div>
                    <div class="col ps-0"><hr class="mb-0 navbar-vertical-divider"></div>
                    </div>

                    <a class="nav-link<?php if($pagefile == "orders.php"){ echo "active";} ?>" href="/admin/orders.php" role="button" aria-expanded="false">
                        <div class="d-flex align-items-center"><span class="nav-link-icon"><span class="fas fa-chart-line"></span></span><span class="nav-link-text ps-1">Orders</span></div>
                    </a>

                    <a class="nav-link<?php if($pagefile == "customers.php"){ echo "active";} ?>" href="/admin/customers.php" role="button" aria-expanded="false">
                        <div class="d-flex align-items-center"><span class="nav-link-icon"><span class="fas fa-user"></span></span><span class="nav-link-text ps-1">Customers</span></div>
                    </a>

                    <a class="nav-link<?php if($pagefile == "ads.php"){ echo "active";} ?>" href="/admin/facebook.php" role="button" aria-expanded="false">
                        <div class="d-flex align-items-center"><span class="nav-link-icon"><span class="fa fa-facebook"></span></span><span class="nav-link-text ps-1">Facebook Ads</span></div>
                    </a>

                    <div class="row navbar-vertical-label-wrapper mt-3 mb-2">
                    <div class="col-auto navbar-vertical-label">Support</div>
                    <div class="col ps-0"><hr class="mb-0 navbar-vertical-divider"></div>
                    </div>

                    <a class="nav-link<?php if($pagefile == "support.php"){ echo "active";} ?>" href="/admin/support.php" role="button" aria-expanded="false">
                        <div class="d-flex align-items-center"><span class="nav-link-icon"><span class="fas fa-question-circle"></span></span><span class="nav-link-text ps-1">Customer Chat</span></div>
                    </a>

                  
                    </li>
                </ul>
            </div>
          </div>
        </nav>

        
         