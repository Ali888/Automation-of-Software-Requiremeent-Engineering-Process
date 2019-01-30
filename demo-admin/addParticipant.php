<?php 
    include_once('includes/project.php');
    include_once('includes/employee.php');
    include_once('includes/Weight.php');
    include_once('includes/Participant.php');
    include_once('includes/Session.php');
    if(!$session->is_logged_in()){
            header('Location: index.php');
    }
	if(isset($_POST['ss'])) {
	     $partcipent->project_id       = $_POST['p2'];
         $partcipent->participent_id   = $_POST['pp'];
         $partcipent->participent_role = $_POST['p3'];
         $partcipent->invited          = 0;
         $result_set = $partcipent->find_by_sql("select * from partcipent_info where participent_id ={$_POST['pp']} and project_id={$_POST['p2']}");
        if (!sizeof($result_set) > 0) {

            $proj = Project::find_by_id($_POST['p2']);
                    foreach ($proj as $project)
                    $partcipent->project_name = $project->project_Title;

           $emp = Employee::find_by_id($_POST['pp']);
           foreach ($emp as $employee) {
               $partcipent->participent_name = $employee->p_name;
           }

           $y = $partcipent->create();
                if($y) echo "<script> alert('Particioent is added to project'); </script>";
   }
        else echo "<script> alert('Participant Is Already Added '); </script>";

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

	
    <title>Automation  </title>

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
            <div class="page-title">
              <div class="title_left">
                <h3></h3>
              </div>
            </div>
            <div class="clearfix"></div>
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Add A Participant <small></small></h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      
                      <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <br />
                    <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" method="post">

                     <div class="form-group">
							<label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Project Name  <span class="required">*</span>
							</label>
							<div class="col-md-6 col-sm-6 col-xs-12">
								<select id="heard1" class="form-control" name="p2" required>
									 
								
					  <?php
                      $proj = Project::find_all();
                      foreach ($proj as $project){
                          ?>
                      <option value="<?php echo $project->project_id; ?>"><?php echo $project->project_Title; ?></option>;
                      <?php } ?>
                        </select>
                          
                        </div>
                      </div>
                      
                      <div class="form-group">
							<label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Participant Name  <span class="required">*</span>
							</label>
							<div class="col-md-6 col-sm-6 col-xs-12">
								<select id="heard" class="form-control" name="pp" required>
							
								
					  <?php
                      $emp = Employee::find_all();
                      foreach ($emp as $employee){
                          ?>
                          <option value="<?php echo $employee->p_id; ?>"><?php echo $employee->p_name; ?></option>;
                      <?php }
					  ?>
                        </select>
                          
                        </div>
                      </div>
					  
					  
                      
                      
                     <div class="form-group">
							<label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Participant Role <span class="required">*</span>
							</label>
							<div class="col-md-6 col-sm-6 col-xs-12">
								<select id="heard" class="form-control" name="p3" required>
							
								
					  <?php
                      $we = Weight::find_all();
                      foreach ($we as $weight) {
                      ?>
                          <option value="<?php echo $weight->post; ?>"><?php echo $weight->post; ?></option>;
                          <?php
                      }
					  ?>
                        </select>
                          
                        </div>
                      </div>
                      <br><br>
                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
						  <button class="btn btn-primary" type="reset">Reset</button>
                          <button type="submit" class="btn btn-success" name="ss">Submit</button>
                        </div>
                      </div>

                    </form>
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
