<?php 


if(isset($_POST['sess']))
{
    $proj = $_POST['proj'];
    $_SESSION['proj_proj'] = $proj;
}

if(isset($_POST['ss'])){
    //$f = $_POST['a'];
    foreach($_POST['a'] as $f)
    {
       $y = sendMail($f);
        if($y)
        {
            inv($f);
        }
        else
        {
         echo "<script> alert('Error'); </script>";    
        }
    }
        
    
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

<!--    <!-- Bootstrap -->-->
<!--    <link href="../Boot/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">-->
<!--    <!-- Font Awesome -->-->
<!--    <link href="../Boot/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">-->
<!--    <!-- NProgress -->-->
<!--    <link href="../Boot/vendors/nprogress/nprogress.css" rel="stylesheet">-->
<!--    <!-- iCheck -->-->
<!--    <link href="../Boot/vendors/iCheck/skins/flat/green.css" rel="stylesheet">-->
<!--    <!-- bootstrap-wysiwyg -->-->
<!--    <link href="../Boot/vendors/google-code-prettify/bin/prettify.min.css" rel="stylesheet">-->
<!--    <!-- Select2 -->-->
<!--    <link href="../Boot/vendors/select2/dist/css/select2.min.css" rel="stylesheet">-->
<!--    <!-- Switchery -->-->
<!--    <link href="../Boot/vendors/switchery/dist/switchery.min.css" rel="stylesheet">-->
<!--    <!-- starrr -->-->
<!--    <link href="../Boot/vendors/starrr/dist/starrr.css" rel="stylesheet">-->
<!--    <!-- bootstrap-daterangepicker -->-->
<!--    <link href="../Boot/vendors/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">-->
<!---->
<!--    <!-- Custom Theme Style -->-->
<!--    <link href="../Boot/build/css/custom.min.css" rel="stylesheet">-->

      <?PHP include_once('files.php');?>
  </head>

   <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col">
          <div class="left_col scroll-view">
            
            <?php  include('sidemenu.php'); ?> 

            <div class="clearfix"></div>

            
          </div>
        </div>

        <!-- top navigation -->
        <?php include('topBar.php'); ?>
        <!-- /top navigation -->

        <!-- page content -->
         
		 
		 <div class="right_col" role="main">
          <div class="">
                       
              
              <div class="clearfix"></div>

              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2> Peoject Reports <small></small></h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      
                      <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">

                    <div class="col-xs-2">
                      <!-- required for floating -->
                      <!-- Nav tabs -->
                      <ul class="nav nav-tabs tabs-left">
                        <li class="active"><a href="#home" data-toggle="tab">Select Projet</a>
                        </li>
                        <li><a href="#profile" data-toggle="tab">Invite Participants</a>
                        </li>
						<li><a href="#invite" data-toggle="tab">Invited Participants</a>
                        </li>
                        <li><a href="#messages" data-toggle="tab">Requirement Gathering</a>
                        </li>
                        <li><a href="#settings" data-toggle="tab">Requirement Prioritization</a>
                        </li>
						<li><a href="#settings" data-toggle="tab">Requirement Finalization</a>
                        </li>
                      </ul>
                    </div>

                    <div class="col-xs-9">
                      <!-- Tab panes -->
                      <div class="tab-content">
                        <div class="tab-pane active" id="home">
									
									 <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" method="post">
								  <div class="form-group">
								<label class="control-label col-md-3 col-sm-3 col-xs-12">Select A Project</label>
								<div class="col-md-9 col-sm-9 col-xs-12">
                                <select class="select2_single form-control" tabindex="-1" name="proj">

                              <?php
                                        $res = select_Project('project');
                                        if($res->num_rows>0)
                                        {
                                             while($row = $res->fetch_assoc()) 
                                            {
                                            
                                    ?>
									<option value="<?php echo $row["project_id"]; ?>">
									<?php echo $row["project_Title"]; ?>
									</option>
								  
								  <?php 
                                          //   $progTitle = $row["project_Title"];
                                                 }
                                        }
                                   
                                    ?>
                                     </select>
								</div>
							  </div>

							  <div class="form-group">
								<div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
								  <button type="submit" class="btn btn-success" name="sess">Enter</button>
								</div>
							  </div>
							</form>
                        </div>  <!-- end of tab 1 -->
                <div class="tab-pane" id="profile">
										<div class="col-md-12 col-sm-12 col-xs-12">
							<div class="x_panel">
							  <div class="x_title">
								<h2>Invite Participants<small></small></h2>
								<ul class="nav navbar-right panel_toolbox">
								  <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
									</li>
								  <li><a class="close-link"><i class="fa fa-close"></i></a>
								  </li>
								</ul>
								<div class="clearfix"></div>
							  </div>

							  <div class="x_content">
                             <div class="table-responsive">
								  <form action="reports.php" method="post"> 
								  <table class="table table-striped jambo_table bulk_action">
									<thead>
									  <tr class="headings">
							<!--
                                      			<th>
										  <input type="checkbox" id="check-all" class="flat">
										</th>
								-->
                                        
										<th class="column-title">Invite Participent </th>
										<th class="column-title">Project ID </th>
										<th class="column-title">Project Title </th>
										<th class="column-title">Participent Id </th>
										<th class="column-title">Participent Name </th>
										<th class="column-title">Participent Role </th>
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
                                      if(!isset($_SESSION['proj_proj']))
                                      {
                                            echo "<h1>No Project Is Selected</h1>";
                                        }
                                        else
                                        {
                                            echo "<tbody>";
                                            $res = invite();
                                          if($res->num_rows>0)
                                            {
                                                while($row = $res->fetch_assoc()) 
                                                {
                                                  //  $id = $row['p_id'];
                                                   echo "<tr>
                                                   <td><input type='checkbox' name='a[]' 
                                                   value='".$row["participent_id"]."'></td>
                                                   <td>".$row["participent_id"]."</td>
                                                   <td>".$row['participent_name']."</td>
                                                   <td>".$row['project_id']."</td>
                                                   <td>".$row['project_name']."</td>
                                                   <td>".$row["participent_role"]."</td></tr>";
                                                }
                                              echo "</tbody>";
                                            }
                                            else
                                            {
                                            echo '<h2>All Perticipents Are Invited<h2>';
                                            }
                                                    }
                                   ?>
							      
								  </table>
								  <button type="submit" class="btn btn-success" name="ss">Send Invitation</button>
								  </form>
                                      
								</div>
					</div>
						</div>	
						
                  </div>
						</div>
						 <div class="tab-pane" id="invite">
										<div class="col-md-12 col-sm-12 col-xs-12">
							<div class="x_panel">
							  <div class="x_title">
								<h2>Invited Participants<small></small></h2>
								<ul class="nav navbar-right panel_toolbox">
								  <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
									</li>
								  <li><a class="close-link"><i class="fa fa-close"></i></a>
								  </li>
								</ul>
								<div class="clearfix"></div>
							  </div>

							  <div class="x_content">
                             <div class="table-responsive">
								  <form action="reports.php" method="post"> 
								  <table class="table table-striped jambo_table bulk_action">
									<thead>
									  <tr class="headings">
							<!--
                                      			<th>
										  <input type="checkbox" id="check-all" class="flat">
										</th>
								-->
                                        
										
										<th class="column-title">Project ID </th>
										<th class="column-title">Project Title </th>
										<th class="column-title">Participent Id </th>
										<th class="column-title">Participent Name </th>
										<th class="column-title">Participent Role </th>
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
                                      if(!isset($_SESSION['proj_proj']))
                                      {
                                            echo "<h1>No Project Is Selected</h1>";
                                        }
                                        else
                                        {
                                            echo "<tbody>";
                                            $res = invite1();
                                          if($res->num_rows>0)
                                            {
                                                while($row = $res->fetch_assoc()) 
                                                {
                                                  //  $id = $row['p_id'];
                                                   echo "<tr>
                                                   <td>".$row["participent_id"]."</td>
                                                   <td>".$row['participent_name']."</td>
                                                   <td>".$row['project_id']."</td>
                                                   <td>".$row['project_name']."</td>
                                                   <td>".$row["participent_role"]."</td></tr>";
                                                }
                                              echo "</tbody>";
                                            }
                                            else
                                            {
                                            echo '<h1>No Participant  Is Invited<h1>';
                                            }
                                                    }
                                   ?>
							      
								  </table>
								  
								  </form>
                                      
								</div>
					</div>
						</div>	
						
                  </div>
						</div>
                 <div class="tab-pane" id="messages">
													  <div class="">
													  <div class="row">
								 <div class="col-md-12 col-sm-12 col-xs-12">
									<div class="x_panel">
									  <div class="x_title">
										<h2>Requirements from The Participants <small></small></h2>
										<ul class="nav navbar-right panel_toolbox">
										  <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
										  </li>
										  
										  <li><a class="close-link"><i class="fa fa-close"></i></a>
										  </li>
										</ul>
										<div class="clearfix"></div>
									  </div>
									  <div class="x_content">
									   
										
										<table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
										  <thead>
											<tr>
											  <th>First name</th>
											  <th>Last name</th>
											  <th>Position</th>
											  <th>Office</th>
											  <th>Age</th>
											  <th>Start date</th>
											  <th>Salary</th>
											  <th>Extn.</th>
											  <th>E-mail</th>
											</tr>
										  </thead>
										  <tbody>
											
											<tr>
											  <td>Shad</td>
											  <td>Decker</td>
											  <td>Regional Director</td>
											  <td>Edinburgh</td>
											  <td>51</td>
											  <td>2008/11/13</td>
											  <td>$183,000</td>
											  <td>6373</td>
											  <td>s.decker@datatables.net</td>
											</tr>
										   
											
										  </tbody>
										</table>
										
										<table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
										  <thead>
											<tr>
											  <th>First name</th>
											  <th>Last name</th>
											  <th>Position</th>
											  <th>Office</th>
											  <th>Age</th>
											  <th>Start date</th>
											  <th>Salary</th>
											  <th>Extn.</th>
											  <th>E-mail</th>
											</tr>
										  </thead>
										  <tbody>
											
											<tr>
											  <td>Shad</td>
											  <td>Decker</td>
											  <td>Regional Director</td>
											  <td>Edinburgh</td>
											  <td>51</td>
											  <td>2008/11/13</td>
											  <td>$183,000</td>
											  <td>6373</td>
											  <td>s.decker@datatables.net</td>
											</tr>
										   
											
										  </tbody>
										</table>
										
										
									  </div>
									</div>
								  </div>
								</div>
							  </div>
						</div>
                        <div class="tab-pane" id="settings">Settings Tab.</div>
                      
                    

                    <div class="clearfix"></div>

                  </div>
                
              </div>
              </div> <!-- end of col -->
            </div>
         </div> <!-- End of page -->
          <div class="clearfix"></div>
        </div> <!-- endd of main container -->
        <!-- /page content -->
		
		
            </div><!-- end of main -->
          
        
      
    

    <!-- jQuery -->
<!--    <script src="../Boot/vendors/jquery/dist/jquery.min.js"></script>-->
<!--    <!-- Bootstrap -->-->
<!--    <script src="../Boot/vendors/bootstrap/dist/js/bootstrap.min.js"></script>-->
<!--          <script src="../Boot/vendors/bootstrap-daterangepicker/daterangepicker.js"></script>-->
<!--          <!-- bootstrap-wysiwyg -->-->
<!--          <script src="../Boot/vendors/bootstrap-wysiwyg/js/bootstrap-wysiwyg.min.js"></script>-->
<!--          <script src="../Boot/vendors/jquery.hotkeys/jquery.hotkeys.js"></script>-->
<!--          <script src="../Boot/vendors/google-code-prettify/src/prettify.js"></script>-->
<!--          <!-- jQuery Tags Input -->-->
<!--          <script src="../Boot/vendors/jquery.tagsinput/src/jquery.tagsinput.js"></script>-->
<!--          <!-- Switchery -->-->
<!--          <script src="../Boot/vendors/switchery/dist/switchery.min.js"></script>-->
<!--          <!-- Select2 -->-->
<!--          <script src="../Boot/vendors/select2/dist/js/select2.full.min.js"></script>-->
<!--          <!-- Parsley -->-->
<!--          <script src="../Boot/vendors/parsleyjs/dist/parsley.min.js"></script>-->
<!--          <!-- Autosize -->-->
<!--          <script src="../Boot/vendors/autosize/dist/autosize.min.js"></script>-->
<!--          <!-- jQuery autocomplete -->-->
<!--          <script src="../Boot/vendors/devbridge-autocomplete/dist/jquery.autocomplete.min.js"></script>-->
<!--          <!-- starrr -->-->
<!--          <script src="../Boot/vendors/starrr/dist/starrr.js"></script>-->
<!--          <!-- Custom Theme Scripts -->-->
<!--          <script src="../Boot/build/js/custom.min.js"></script> <!-- FastClick -->-->
<!--    <script src="../Boot/vendors/fastclick/lib/fastclick.js"></script>-->
<!--    <!-- NProgress -->-->
<!--    <script src="../Boot/vendors/nprogress/nprogress.js"></script>-->
<!--    <!-- bootstrap-progressbar -->-->
<!--    <script src="../Boot/vendors/bootstrap-progressbar/bootstrap-progressbar.min.js"></script>-->
<!--    <!-- iCheck -->-->
<!--    <script src="../Boot/vendors/iCheck/icheck.min.js"></script>-->
<!--    <!-- bootstrap-daterangepicker -->-->
<!--    <script src="../Boot/vendors/moment/min/moment.min.js"></script>-->

      <?php include_once ('files1.php');?>

	
  </body>
</html>
