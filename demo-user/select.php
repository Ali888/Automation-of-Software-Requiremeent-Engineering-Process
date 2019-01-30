<?php
include_once ('includes/Session.php');
include_once ('includes/Project_info.php');


if(!$session->is_logged_in()){
    header('Location: index.php');
}

    
    if(isset($_POST['ent']))
    {
    
        $info= $_POST['a'];
        $sel = array();
        $token = strtok($info,"?");
        while($token!=false){
            array_push($sel, $token);
            $token = strtok("?");
        }
        $_SESSION['demo_proj_id']   = $sel[0];
        $_SESSION['demo_proj_name'] = $sel[1];
      //  $_SESSION['demo_proj_proj'] = $sel[1];

        header('location:viewRequ.php');
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
               <div class="row">
                  <div class="col-md-12 col-sm-3 col-xs-3">
                        <div class="x_panel">
                          <div class="x_title">
                            <h2>Select A Project<small></small></h2>
                                <ul class="nav navbar-right panel_toolbox">
                                  <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                  </li>
                                  
                                </ul>
                                <div class="clearfix"></div>
                            </div>
                            
                            <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12"> Selected Project</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                          <form method="post">
                          <select class="select2_group form-control" name="a">
                           <?Php
                           $proj = $project_info->find_by_sql("select * from partcipent_info where participent_id={$_SESSION['demo_part_id']} and invited = 1");

                           foreach ($proj as $project_info){
                                    ?>
                                    <option value="<?php echo $project_info->project_id."?".$project_info->project_name."?"; ?>">
                                        <?php echo $project_info->project_name;  ?>
                                    </option>
                                <?php
                                }

                                  
                              ?>
                            </select>
                            <div class="ln_solid"></div>
                            <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
					    <button type="submit" class="btn btn-success" name="ent">Submit</button>
                        </div>
                      </div>
                            </form>
                        </div>
                      </div>
                      
					  
                      
                </div>
              </div>
            </div><!-- end of row -->
          </div>
        </div><!-- /page content -->

        
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
