<?php
include_once('includes/project.php');
include_once('includes/employee.php');
include_once('includes/Weight.php');
include_once('includes/Participant.php');
include_once('includes/Session.php');
include_once ('includes/Mail.php');
include_once ('includes/database.php');
include_once ('includes/Requirements.php');
include_once ('includes/Requested.php');
include_once ('includes/Prioritize.php');




if(!$session->is_logged_in()){
    header('Location: index.php');
}


if(isset($_POST['zz'])){
    $bool = false;
    $app = "";
    if(!isset($_POST['req'])){
        echo "<script> alert('Please Select Atleast One Project '); </script>";
    }
    else {
        $key = $_POST['req'];
        if (sizeof($key) < 0) {
            echo "<script> alert('Please Select Atleast One Project '); </script>";

        } else {
            foreach($key as $k)
            {
                $token = strtok($k, "?");
                $a = array();
                while ($token !== false)
                {
                    array_push($a,$token);
                    $token = strtok("?");
                }

                $requested->project_id    = $a[0];
                $requested->p_id          = $a[1];
                $requested->keyw          = $a[2];
                $requested->project_Title = $a[3];
                $requested->p_name        = $a[4];
                $requested->approve       = 1;
                if($requested->update()){
                    $bool = true;
                    $app .= ",".$requested->keyw;
                }
                else{
                    $bool = false;
                }
            }
            if($bool){
                $obj = project::find_by_id($requested->project_id);
                foreach($obj as $peoject){
                    $peoject->key_Words .=$app;
                }
                $sql = "update project_info set key_Words='".$database->escape_value($peoject->key_Words)."' where project_id='".$database->escape_value($requested->project_id )."';";
                $database->query($sql);

                echo "<script> alert('Requirements Tags Are Updated'); </script>";
            }
            else
                echo "<script> alert('Requirements Tags Are Not Updated'); </script>";
            // echo "<script> alert('".$peoject->key_Words."'); </script>";
        }
    }
}

if(isset($_POST['entt'])){
    $bool = false;
    $app = "";
    if(!isset($_POST['req'])){
        echo "<script> alert('Please Select Atleast One Project '); </script>";
    }
    else {
        $key = $_POST['req'];
        if (sizeof($key) < 0) {
            echo "<script> alert('Please Select Atleast One Project '); </script>";

        } else {
            foreach($key as $k)
            {
                $token = strtok($k, "?");
                $a = array();
                while ($token !== false)
                {
                    array_push($a,$token);
                    $token = strtok("?");
                }

                $requested->project_id    = $a[0];
                $requested->p_id          = $a[1];
                $requested->keyw          = $a[2];
                $requested->project_Title = $a[3];
                $requested->p_name        = $a[4];
                $requested->approve       = 1;
                if($requested->delete()){
                    $bool = true;
                }
                else{
                    $bool = false;
                }
            }
            if($bool){

                echo "<script> alert('Requirements Tags Are Deleted'); </script>";
            }
            else
                echo "<script> alert('Requirements Tags Are Not Deleted'); </script>";

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
    <link href="../Boot/vendors/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
    <link href="../Boot/vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css" rel="stylesheet">
    <link href="../Boot/vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css" rel="stylesheet">
    <link href="../Boot/vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css" rel="stylesheet">
    <link href="../Boot/vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css" rel="stylesheet">


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



            <div class="clearfix"></div>

            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2> Project Reports <br><br><small></small>
                            <?Php
                            if(!isset($_SESSION['proj']))
                            {
                                echo "No Project Is Selected";
                            }
                            else{
                                echo $_SESSION['proj'];}
                            ?>
                        </h2>
                        <ul class="nav navbar-right panel_toolbox">
                            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                            </li>

                            <li><a class="close-link"><i class="fa fa-close"></i></a>
                            </li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>

                    <div class="x_content">



                        <div class="col-xs-12">
                            <!-- Tab panes -->

                            <div class="tab-content">

                                <div class="tab-pane active" id="per">
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <div class="x_panel">
                                            <div class="x_title">
                                                <h2>Requirements Permission<small></small></h2>
                                                <ul class="nav navbar-right panel_toolbox">
                                                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                                    </li>

                                                </ul>
                                                <div class="clearfix"></div>
                                            </div>

                                            <div class="x_content">
                                                <div class="table-responsive">
                                                    <form action="reqPermission.php" method="post">
                                                        <table id="datatable-responsive"  class="table table-striped jambo_table bulk_action">
                                                            <thead>
                                                            <tr class="headings">
                                                                <th class="column-title"><br>  </th>
                                                                <th class="column-title">Project <br> ID </th>
                                                                <th class="column-title">Project<br> Title </th>
                                                                <th class="column-title">Participent  <br> ID </th>
                                                                <th class="column-title">Participent  <br> Name </th>
                                                                <th class="column-title">Keyword  <br> Tag </th>

                                                            </tr>
                                                            </thead>

                                                            <?php

                                                            if(!isset($_SESSION['proj']))
                                                            {
                                                                echo "<h1>No Project Is Selected</h1>";
                                                            }
                                                            else
                                                            {
                                                                echo "<tbody>";
                                                                $sql = "select * from req_permission where project_id='{$_SESSION['id']}' and approve = '0' ";
                                                                $rest = $requested->find_by_sql($sql);
                                                                foreach($rest as $requested)
                                                                {
                                                                    echo "<tr>
                                                   <td><input type='checkbox' name='req[]'
                                                   value='".$requested->project_id."?".$requested->p_id."?".$requested->keyw."?".$requested->project_Title."?".$requested->p_name."'></td>
                                                   <td>".$requested->project_id."</td>
                                                   <td>".$requested->project_Title."</td>
                                                   <td>".$requested->p_id."</td>
                                                   <td>".$requested->p_name."</td> 
                                                   <td>".$requested->keyw."</td>
                                                                            </tr>";
                                                                }
                                                                echo "</tbody>";


                                                            }

                                                            ?>

                                                        </table>
                                                        <div class="form-group">
                                                            <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                                                <button type="submit" class="btn btn-success" name="zz">Allow</button>
                                                                <button type="submit" class="btn btn-danger" name="entt">Delete</button>

                                                            </div>
                                                        </div>

                                                    </form>
                                                    <!--
                                                     <td>
                                                                 <a href='editEmployee.php?pid={$row['project_id']}&&paid={$row['p_id']}>
                                                                  <button type='submit' class='btn btn-sm btn-danger' name='sub1'>Delete</button>
                                                                  </a>
                                                                 </td> -->



                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>

                            </div>



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

<script src="../Boot/vendors/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="../Boot/vendors/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<script src="../Boot/vendors/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
<script src="../Boot/vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js"></script>
<script src="../Boot/vendors/datatables.net-buttons/js/buttons.flash.min.js"></script>
<script src="../Boot/vendors/datatables.net-buttons/js/buttons.html5.min.js"></script>
<script src="../Boot/vendors/datatables.net-buttons/js/buttons.print.min.js"></script>
<script src="../Boot/vendors/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js"></script>
<script src="../Boot/vendors/datatables.net-keytable/js/dataTables.keyTable.min.js"></script>
<script src="../Boot/vendors/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
<script src="../Boot/vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js"></script>
<script src="../Boot/vendors/datatables.net-scroller/js/datatables.scroller.min.js"></script>
<script src="../Boot/vendors/jszip/dist/jszip.min.js"></script>
<script src="../Boot/vendors/pdfmake/build/pdfmake.min.js"></script>
<script src="../Boot/vendors/pdfmake/build/vfs_fonts.js"></script>


</body>
</html>
