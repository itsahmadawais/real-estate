 <div id="layoutSidenav">
     <div id="layoutSidenav_nav">
         <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
             <div class="sb-sidenav-menu">
                 <div class="nav">
                     <div class="sb-sidenav-menu-heading">Core</div>
                     <a class="nav-link" href="index.php">
                         <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                         Dashboard
                     </a>
                     <div class="sb-sidenav-menu-heading">Properties</div>
                     <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                         <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                         Listing
                         <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                     </a>
                     <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                         <nav class="sb-sidenav-menu-nested nav"><a class="nav-link" href="post.php?action=add">Add New</a><a class="nav-link" href="listings.php">View All</a></nav>
                     </div>
                     <?php if($_SESSION['role']=="admin"):?>
                     <div class="sb-sidenav-menu-heading">Agents</div>
                     <a class="nav-link" href="agents.php">
                         <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                         Registered Agents
                     </a>
                     <?php endif;?>
                     <div class="sb-sidenav-menu-heading">Settings</div>
                     <a class="nav-link" href="profile.php?userid=<?php echo $_SESSION['uid']?>">
                         <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                         My Profile
                     </a>
                 </div>
             </div>
             <div class="sb-sidenav-footer">
                 <div class="small">Logged in as:</div>
                 <?php
                  if($_SESSION['role']=="admin")
                  {
                        echo "Admin";
                  }
                 else{
                     echo "Agent";
                 }
                 echo " | ". $_SESSION['email'];
                 ?>
             </div>
         </nav>
     </div>
 </div>
 <div id="layoutSidenav_content">
