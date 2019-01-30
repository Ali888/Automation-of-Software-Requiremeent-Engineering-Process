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

if(isset($_POST['ll'])) {
    $bool = true;
    if(!isset($_POST['a1'])){
        echo "<script> alert('Kindly Select Atleast One Project '); </script>";
    }
    else{
        $key = $_POST['a1'];
        foreach($key as $k) {
            $token = strtok($k, "?");
            $a = array();
            while ($token !== false) {
                array_push($a, $token);
                $token = strtok("?");
            }
            $requirements->project_id   = $a[0];
            $requirements->p_id = $a[1];
            $requirements->keyw   = $a[2];
            $requirements->req    = $a[3];
            if($requirements->delete())
                $bool = true;
            else
                $bool = false;
        }
        if($bool)
            echo "<script> alert('Requirements  Are Deleted'); </script>";

        else{
            echo "<script> alert('Select A Requirement'); 
             window.open('reports.php','_self');
             </scrip>";
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
                            if(!isset($_SESSION['demo_proj']))
                            {
                                echo "No Project Is Selected";
                            }
                            else{
                                echo $_SESSION['demo_proj'];}
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

                                <div class="tab-pane active" id="messages">
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <div class="x_panel">
                                            <div class="x_title">
                                                <h2>Requirements From User<small></small></h2>
                                                <ul class="nav navbar-right panel_toolbox">
                                                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                                    </li>
                                                </ul>
                                                <div class="clearfix"></div>
                                            </div>
                                            <div class="x_content">

                                                <form action="reqGathering.php" method="post">
                                                    <table id="datatable-responsive"    class="table table-striped jambo_table bulk_action">
                                                        <thead>
                                                        <tr class="headings">

                                                            <th class="column-title"> </th>
                                                            <th class="column-title">Participent ID </th>
                                                            <th class="column-title">Participnt <br>Name </th>
                                                            <th class="column-title">Keywords  </th>
                                                            <th class="column-title">Requirements </th>

                                                        </tr>
                                                        </thead>

                                                        <?php


                                                        if(!isset($_SESSION['demo_proj']))
                                                        {
                                                            echo "<h1>No Project Is Selected</h1>";
                                                        }
                                                        else
                                                        {
                                                            echo "<tbody>";
                                                            $req = Requirements::find_all();
                                                            foreach ($req as $requirements)
                                                            {
                                                                //  $id = $row['p_id'];
                                                                echo "<tr>
                                                   <td><input type='checkbox' name='a1[]' 
                                                   value='".$requirements->project_id."?".$requirements->p_id."?".$requirements->keyw."?".$requirements->req."'></td>
                                                   <td>".$requirements->p_id."</td>
                                                   <td>".$requirements->p_name."</td>
                                                   <td>".$requirements->keyw."</td>
                                                   <td>".$requirements->req."</td>
                                                   
                                                   </tr>";
                                                            }
                                                            echo "</tbody>";
                                                        }


                                                        ?>

                                                    </table>
                                                    <div class="form-group">
                                                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                                            <button type="submit" class="btn btn-danger" name="ll">Delete</button>

                                                        </div>
                                                    </div>
                                                </form>


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
