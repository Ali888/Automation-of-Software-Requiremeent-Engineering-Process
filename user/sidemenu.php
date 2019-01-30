
            <div class="navbar nav_title" style="border: 0;">
              <a href="invitedProject.php" class="site_title"><i class="fa fa-paw"></i> <span>User Panel</span></a>
            </div>

            <div class="clearfix"></div>
                <!-- menu profile quick info -->
            <div class="profile clearfix">
              <div class="profile_pic">
                <img src="images/img.jpg" alt="..." class="img-circle profile_img">
              </div>
              <div class="profile_info">
                <span>Welcome,</span>
                <h2><?php echo $_SESSION['name']; ?></h2>
              </div>
            </div>
            <!-- /menu profile quick info -->

            <br />

            <!-- sidebar menu -->
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
              <div class="menu_section">
                <h3></h3>
                <ul class="nav side-menu">
                  <li><a href="invitedProject.php">
                         Invited Projects   
                       </a>
                  </li>
                  <li><a>View Requirements <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="select.php">Select A Project</a></li>
                      <li><a href="viewRequ.php">Requirements</a></li>
                       <li><a href="showRequirements.php">Reqested Requirements </a></li>


                    </ul>
                  </li>
               </ul>
              </div>

            </div>
            <!-- /sidebar menu -->
