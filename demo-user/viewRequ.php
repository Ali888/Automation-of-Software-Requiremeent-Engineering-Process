<?php
include_once ('includes/Session.php');
include_once ('includes/Project_info.php');
include_once ('includes/Requirements.php');


if(!$session->is_logged_in()){
    header('Location: index.php');
}


     
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

	
    <title>SRE </title>

     <link rel="stylesheet" type="text/css" href="../Boot/js/bootstrap.min.css">
        <!-- Bootstrap -->
    <link href="../Boot/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="../Boot/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="../Boot/vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- iCheck -->
    <link href="../Boot/vendors/iCheck/skins/flat/green.css" rel="stylesheet">
    <!-- bootstrap-wysiwyg -->
    <link href="../Boot/vendors/google-code-prettify/bin/prettify.min.css" rel="stylesheet">
    <!-- Select2 -->
    <link href="../Boot/vendors/select2/dist/css/select2.min.css" rel="stylesheet">
    <!-- Switchery -->
    <link href="../Boot/vendors/switchery/dist/switchery.min.css" rel="stylesheet">
    <!-- starrr -->
    <link href="../Boot/vendors/starrr/dist/starrr.css" rel="stylesheet">
    <!-- bootstrap-daterangepicker -->
    <link href="../Boot/vendors/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="../Boot/build/css/custom.min.css" rel="stylesheet">
  </head>

  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col">
          <div class="left_col scroll-view">
            
            <?php  include('sidemenu.php'); ?>    
          </div>
        </div>

        <!-- top navigation -->
    
                   <div class="top_nav">
                <?php include('topBar.php'); ?>
        </div>
        <!-- /top navigation -->

        <!-- page content -->
            <div class="right_col" role="main">
          <div class="">
            <div class="row">
              <div class="x_panel">
                  <div class="x_title">
                    <h2><?php  if(isset($_SESSION['demo_proj_name'])) echo $_SESSION['demo_proj_name']; ?><small></small></h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    
						<div class="col-md-12 col-sm-12 col-xs-12">
							<div class="x_panel">
							  <div class="x_title">
								<h2>Requirements From User <?php echo  $_SESSION['demo_user'] ?><small></small></h2>
								<ul class="nav navbar-right panel_toolbox">
								  <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
									</li>
								</ul>
								<div class="clearfix"></div>
							  </div>

							  <div class="x_content">
                             <div class="table-responsive">
								  
								  <table class="table table-striped jambo_table bulk_action">
									<thead>
									  <tr class="headings">
							
                                        
										<th class="column-title">Project ID  </th>
										<th class="column-title">Project Title </th>
										<th class="column-title">Keywords  </th>
										<th class="column-title">Requirements </th>
										<th class="column-title">Edit </th>
										
										<!--
										<th class="column-title no-link last"><span class="nobr">Action</span>
										</th>
										<th class="bulk-actions" colspan="7">
										  <a class="antoo" style="color:#fff; font-weight:500;">Bulk Actions ( <span class="action-cnt"> </span> ) <i class="fa fa-chevron-down"></i></a>
										</th>
										-->
									  </tr>
									</thead>
                                     
                                      <?php 
                                      if(!isset($_SESSION['demo_proj_id']))
                                      {
                                            echo "<h1>No Project Is Selected</h1>";
                                        }
                                        else
                                        {
                                            echo "<tbody>";
                                            $sql = "select * from requirements where project_id={$_SESSION['demo_proj_id'] } and p_id={$_SESSION['demo_part_id']}";
                                            $req = $requirements->find_by_sql($sql);
                                            foreach ($req as $requirements)
                                            {
                                                   echo "<tr>
                                                   <td>".$requirements->project_id."</td>
                                                   <td>".$requirements->project_Title."</td>
                                                   <td>".$requirements->keyw."</td>
                                                   <td>".$requirements->req."</td><td>";
                                                ?>
                                                <a href='editReq.php?pid=<?php echo $requirements->project_id;?>&&keyw=<?php echo $requirements->keyw; ?>&&req=<?PHp echo $requirements->req; ?>'>
                                        <button  class='btn btn-sm btn-info' > 
                                        Edit
                                        </button></a>
                                               <?php
                                               echo "</td></tr>";
                                                
                                                
                                                
                                                }
                                              
                                              echo "</tbody>";
                                              

                                                    }
                                   ?>
							      
								  </table>
								  
								
                                      
								</div>
					</div>
						</div>	
						
                  </div>
					
                  </div>
                </div>
              </div>
            </div>
          </div>
        
        <!-- /page content -->
</div>
        
      </div>

    <!-- jQuery -->
    <script src="../Boot/vendors/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="../Boot/vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- FastClick -->
    <script src="../Boot/vendors/fastclick/lib/fastclick.js"></script>
    <!-- NProgress -->
    <script src="../Boot/vendors/nprogress/nprogress.js"></script>
    <!-- bootstrap-progressbar -->
    <script src="../Boot/vendors/bootstrap-progressbar/bootstrap-progressbar.min.js"></script>
    <!-- iCheck -->
    <script src="../Boot/vendors/iCheck/icheck.min.js"></script>
    <!-- bootstrap-daterangepicker -->
    <script src="../Boot/vendors/moment/min/moment.min.js"></script>
    <script src="../Boot/vendors/bootstrap-daterangepicker/daterangepicker.js"></script>
    <!-- bootstrap-wysiwyg -->
    <script src="../Boot/vendors/bootstrap-wysiwyg/js/bootstrap-wysiwyg.min.js"></script>
    <script src="../Boot/vendors/jquery.hotkeys/jquery.hotkeys.js"></script>
    <script src="../Boot/vendors/google-code-prettify/src/prettify.js"></script>
    <!-- jQuery Tags Input -->
    <script src="../Boot/vendors/jquery.tagsinput/src/jquery.tagsinput.js"></script>
    <!-- Switchery -->
    <script src="../Boot/vendors/switchery/dist/switchery.min.js"></script>
    <!-- Select2 -->
    <script src="../Boot/vendors/select2/dist/js/select2.full.min.js"></script>
    <!-- Parsley -->
    <script src="../Boot/vendors/parsleyjs/dist/parsley.min.js"></script>
    <!-- Autosize -->
    <script src="../Boot/vendors/autosize/dist/autosize.min.js"></script>
    <!-- jQuery autocomplete -->
    <script src="../Boot/vendors/devbridge-autocomplete/dist/jquery.autocomplete.min.js"></script>
    <!-- starrr -->
    <script src="../Boot/vendors/starrr/dist/starrr.js"></script>
    <!-- Custom Theme Scripts -->
    <script src="../Boot/build/js/custom.min.js"></script>
	
  </body>
</html>

