<?php
include_once ('includes/Session.php');
include_once ('../admin/includes/project.php');
include_once ('includes/Requirements.php');
include_once ('includes/Project_info.php');



if(!$session->is_logged_in()){
    header('Location: index.php');
}

if(isset($_POST['ent'])) {
    $key = $_POST['message1'];
    $req = $_POST['message'];
    $proj = $_POST['project'];
    $size = sizeof($req);
    $create = false;

    if (sizeof($key) == sizeof($req)) {
          for ($i = 0; $i<sizeof($key); $i++) {
                $req1 = $req[$i];
              $key1 = $key[$i];
              $token = strtok($req1, ",");
            while ($token != false) {
               $res = Requirements::find_by_id($proj, $_SESSION['part_id'],$token,$key1);

                $requirements->project_id = $proj;
                $sql = "select * from partcipent_info where project_id='{$proj}' and participent_name='{$_SESSION['name']}' and participent_id='{$_SESSION['part_id']}'";
                $result = $project_info->find_by_sql($sql);
                foreach ($result as $project_info) {
                    $requirements->project_Title = $project_info->project_name;
                    $requirements->p_name = $project_info->participent_name;
                    $requirements->role = $project_info->participent_role;
                    $requirements->req = $token;
                }
                $requirements->p_id = $_SESSION['part_id'];
                $requirements->keyw = $key1;
                if (!$res) {
                    $create = $requirements->create();
                    if($create)
                        $create = true;
                  }
                else{
                    $create = $requirements->update();
                    if($create)
                        $create = true;


                }
                $token = strtok(",");
              }
            //  if($create)
             // echo "<script> alert('Requirements are Entered'); </script>";
        }
    }
    header('location:select.php');
}



if(isset($_GET['paid']))
    {
        $proj = Project::find_by_id($_GET['paid']);
        $result = 0;
        foreach ($proj as $project){
                $result = $project->key_Words;
        }
           $token = strtok($result, ",");
            $a = array();
            while ($token !== false) {
                array_push($a, $token);
                $token = strtok(",");
            }
    }


?><!DOCTYPE html>
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
    
    <!-- Tag input -->
    <link href="../Boot/css/bootstrap-tokenfield.css" rel="stylesheet">

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
                    <h2>Requirement Form <small></small></h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      
                      
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <br />
                    <h2>Requirement Should Be in Tags format and separated with commas like tag1,tag2,tab3 <small></small></h2>
                    <div class="clearfix"></div>
                    <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" method="post">
                    <?PHP 
                        $t = "tags_1";
                        if(sizeof($a)>0)
                         {
                             foreach( $a as $c)
                             {
                        ?>
                        <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name"><?php echo $c; ?>  <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                         <textarea class="form-control" rows="3"  name="message[]"></textarea>
                        
                        </div>
                        
                        <input type="hidden" name="message1[]" value="<?php echo $c;  ?>" />
                            <input type="hidden" name="project" value="<?php echo $_GET['paid'];  ?>" />
                      </div>
                      
                      <?PHP
                            }
                         }
                        else
                            echo "No Keyword IS Found"
                        ?>
                      
                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
					    <button type="submit" class="btn btn-success" name="ent">Submit</button>
                        </div>
                      </div>
                      
                      
                    </form>
                  <h2><a href="add.php?paid=<?php echo $_GET['paid']; ?>">Add Your Own Requirement Tag</a>
                       </h2>
                       
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
    
    <script src="../Boot/css/bootstrap-tokenfield.js"></script>
	<script>
	$('#tokenfield').tokenfield()
	</script>
	
  </body>
</html>

