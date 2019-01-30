<?php
include_once('includes/project.php');
include_once('includes/employee.php');
include_once('includes/Weight.php');
include_once('includes/Participant.php');
include_once('includes/Session.php');
if(!$session->is_logged_in()){
    header('Location: index.php');
}
    //$u = insert_into_Table();
    if(isset($_GET['paid']) && isset($_GET['action']))
	{
        if($_GET['action']=='edit')
        {
            $res = Employee::find_by_id($_GET['paid']);
	   }
        else
            if($_GET['action']=='delete')
        {
            $employee = new Employee();
            $employee->p_id          = $_GET['paid'];
            $res =   $employee->delete();
         if($res){
            echo "<script> alert('Data Is Deleted'); ";
            echo " window.open('viewEmployees.php','_self'); </script>";
        }
        else
            echo "<script> alert('Data Is Not Updated'); </script>";
	   }
    }
 if(isset($_GET['pid']) && isset($_GET['paid']))
	{
        $i = select_Participant('delete2');
        if($i){
               echo "<script> alert('The participent invitation  has been cancelled'); </script>";
            
                echo "<script> window.open('reports.php','_self'); </script>";
        }
    }
	if(isset($_POST['ss']))
	{
        $employee = new Employee();
        $employee->p_id          = $_POST['p1'];
        $employee->p_name        = $_POST['p2'];
        $employee->p_email       = $_POST['p4'];
        $employee->p_designation = $_POST['p21'];
        $i = $employee->update();
        if($i){
               echo "<script> alert('Record Is Updated'); </script>";
                echo "<script> window.open('viewEmployees.php','_self'); </script>";
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
                    <h2>Edit Employee Information <small></small></h2>
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

                        <?php
                        foreach ($res as $employee)
                        {
                            ?>

                     <div class="form-group">
							<label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Participent ID  <span class="required">*</span>
							</label>
							<div class="col-md-6 col-sm-6 col-xs-12">
                               <input type="text" id="last-name"  required="required" name="p1" class="form-control col-md-7 col-xs-12" readonly value="<?php echo $employee->p_id ; ?>">
                            </div>
                      </div>
                     
                     <div class="form-group">
							<label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Participent Name  <span class="required">*</span>
							</label>
							<div class="col-md-6 col-sm-6 col-xs-12">
                               <input type="text" id="last-name"  required="required" name="p2" class="form-control col-md-7 col-xs-12" value="<?php echo $employee->p_name; ?> " required>
                            </div>
                      </div>

                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Participant Role <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select id="heard" class="form-control" name="p21" required>


                                        <?php
                                        $weight = new Weight();
                                        $res = Weight::find_all();
                                        foreach ($res as $weight){    ?>

                                            <option value="<?php echo $weight->post; ?>"><?php echo $weight->post; ?></option>;
                                            <?php
                                        }
                                        ?>
                                    </select>

                                </div>
                            </div>

                     
                       <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Participant Email <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="email" id="last-name"  required="required" name="p4" class="form-control col-md-7 col-xs-12" value="<?php echo  $employee->p_email ; ; ?> " required>
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
<?php } ?>
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
