<link rel="stylesheet" href="alert/bundled.css">
    <script src="alert/bundled.js"></script>
	<link rel="stylesheet"
          href="alert/demo.css">
    <script>
        var version = '3.1.1';
    </script>
    <!-- Add the minified version of files from the /dist/ folder. -->
    <!-- jquery-confirm files -->
    <link rel="stylesheet" type="text/css" href="alert/jquery-confirm.css"/>
    <script type="text/javascript" src="alert/jquery-confirm.js"></script>
<?php

   include_once ('includes/project.php');
   include_once ('includes/database.php');
    include_once('includes/Session.php');
    if(!$session->is_logged_in()){
        header('Location: index.php');
    }

    if(isset($_GET['id']) && isset($_GET['action'])) {
        try {

        if ($_GET['action'] == 'edit') {
            $project = Project::find_by_id($_GET['id']);
        } else
            if ($_GET['action'] == 'delete') {
                $project = new Project();
                $project->project_id = $_GET['id'];
                if ($project->delete()) {
                    echo "<script> alert('Project Is Deleted'); </script>";
                    echo "<script> window.open('viewProject.php','_self'); </script>";
                } else {
                    echo "<script> alert('Foriegn Constrain Issue'); </script>";
                    echo "<script> window.open('viewProject.php','_self'); </script>";
                }

            }
	    } catch (Exception $e){
            echo "<script> alert('Foriegn Constrain Issue'); </script>";
        }
    }
	if(isset($_POST['ent']))
	{
        $project = new Project();
        $project->project_id = $_POST['pid'];
        $project->project_Title = $_POST['pTitle'];
        $project->project_Type = $_POST['tag1'];
        $project->Project_Desc = $_POST['dis'];
        $project->organization = $_POST['org'];
        $project->key_Words = $_POST['tag'];
        $y = $project->save();

        if($y)
        {
            echo "<script> alert('Project Is Updated'); </script>";
            echo "<script> window.open('viewProject.php','_self'); </script>";
             
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
                    <h2>Edit Project <small></small></h2>
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
                      <?php foreach ($project as $proj){
                          ?>

                    <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" method="post">
					<div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Project ID  <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="first-name" required="required" class="form-control col-md-7 col-xs-12" name="pid" value="<?php echo $proj->project_id; ?> " readonly>
                        </div>
                      </div>
                       <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Project Title  <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="first-name" required="required" class="form-control col-md-7 col-xs-12" name="pTitle" value="<?php echo $proj->project_Title; ?> " >
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Project Description <span class="required">*</span>
                        </label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                          <textarea class="form-control" rows="4"  name="dis">
                              <?php echo $proj->Project_Desc; ?>
                          </textarea>
                        </div>
                      </div>
                      
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Keywords For Requirements
                        <span class="required">*</span>
                        </label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                          <input id="tags_1" type="text[]" class="tags form-control" value="<?php echo $proj->key_Words; ?>"
                           name="tag"
                          />
                          
                        </div>
                      </div>
                       <div class="control-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Project Type</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                         <div class="form-group">
                        
                          <select name="tag1" class="select2_single form-control" tabindex="-1">
                           
                             <option value="Research">Research</option>
                              <option value="Developement">Developement</option>
                              <option value="Reserch & Developement">Reserch & Developement</option>
                              <option value="Other">Other</option>
                              
                            </select>
                        
                      </div>
                          <div id="suggestions-container" style="position: relative; float: left; width: 250px; margin: 10px;"></div>
                        </div>
                      </div>
                      
                      
                      <div class="form-group">
                        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Organization</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="middle-name" class="form-control col-md-7 col-xs-12" type="text" name="org" value="<?php echo $proj->organization; ?>" required>
                        </div>
                      </div>
                     
                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
						  <button class="btn btn-primary" type="reset">Reset</button>
                          <button type="submit" class="btn btn-success" name="ent">Submit</button>
                            <?php
                            } ?>
                        </div>
                      </div>

                    </form>
                  </div>
                </div>
              </div>
            </div>

           
        </div>
        

        <!-- /page content -->

        
      </div>
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
