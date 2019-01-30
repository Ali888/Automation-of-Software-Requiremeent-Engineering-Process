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

if(isset($_POST['sess']))
{
    $proj = $_POST['proj'];
    $a =  array();
    $token = strtok($proj,"?");
    while($token!=false){
        array_push($a,$token);
        $token = strtok("?");
    }
    $_SESSION['demo_proj'] = $a[1];
    $_SESSION['id'] = $a[0];


}

$t = false;

if(isset($_POST['ss'])) {
    if (isset($_POST['a']) && sizeof($_POST['a']) > 0) {


        $t = $_POST['a'];
        foreach ($t as $r) {
            $token = strtok($r, "?");
            $id = array();
            while ($token !== false) {
                $id[] = $token;
                $token = strtok(" ");
            }
            $emp = Employee::find_by_id($id[0]);
            foreach ($emp as $employee) {
                $mail1->receiver_name = $employee->p_name;
                $mail1->receiver_mail = $employee->p_email;
                $mail1->username = $employee->username;
                $mail1->password = $employee->username;

                $sent = $mail1->sendEmail();
                if ($sent) {
                    $result_set = $database->query("update partcipent_info set invited = '1' where participent_id='{$id[0]}' and project_id='{$id[1]}';");
                    if ($result_set)
                        echo "<script> alert('Participant Has Been Invited'); </script>";
                }
            }
        }
    }
    else{
        echo "<script> alert('Select A Participent For Invitation'); </script>";
    }
}

if(isset($_GET['part']) && isset($_GET['proj'])){
    $result_set = $database->query("update partcipent_info set invited = '0' where participent_id='{$_GET['part']}' and project_id='{$_GET['proj']}';");
    if($result_set)
        echo "<script> alert('Participant Invitation Has Been Cancelled'); 
                    window.open('reports.php','_self');            
            </script>";
}


if(isset($_POST['mm']))
{
    //   echo "<script> alert('inside post'); </script>";
    $project_id = $_POST['a1'] ;
    $p_id = $_POST['a2'] ;
    if(sizeof($project_id)==2)
    {
        echo "<script> alert('Yo '); </script>";
    }
    else
        echo "<script> alert('Farig aaaa'); </script>";
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

if(isset($_POST['entt']))
{
    if(!isset($_POST['req'])){
        echo "<script> alert('Please Select Atleast One Project '); </script>";
    }
    else {
        $bool = false;
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
            if($bool)
                echo "<script> alert('Requirements Tags Are Deleted'); </script>";
            else
                echo "<script> alert('Requirements Tags Are Not Deleted'); </script>";
        }
    }
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
                                <div class="tab-pane active" id="settings">
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <?php

                                        if(!isset($_SESSION['demo_proj']))
                                        {
                                            echo "<h1>No Project Is Selected</h1>";
                                        }
                                        else
                                        {
                                        ?>
                                        <div class="x_panel">
                                            <div class="x_title">
                                                <h2>Prioritized Requirements : <?php //echo $row['keyw'] ;

                                                    $sql = "CREATE  TABLE Proritization(p_name VARCHAR(50) NOT NULL,keyw VARCHAR(50) NOT NULL,req VARCHAR(50) NOT NULL,role VARCHAR(50) NOT NULL,weight VARCHAR(50) NOT NULL)";
                                                    $database->query("DROP TABLE IF EXISTS Proritization");
                                                    $database->query($sql);

                                                    $req = $requirements->find_by_sql("SELECT DISTINCT keyw FROM `requirements` where project_id='{$_SESSION['id']}'");
                                                    $weight_prior = 0;
                                                    $emp_name = "";
                                                    $emp_role = "";
                                                    foreach ($req as $requirements) {
                                                        $req1 = $requirements->find_by_sql("SELECT * FROM `requirements` WHERE keyw='{$requirements->keyw }' and project_id='{$_SESSION['id']}'");
                                                        if (sizeof($req1) == 1) {

                                                            foreach ($req1 as $requirements) {
                                                                $wei = $weight->find_by_sql("select * from finall where post='{$requirements->role}'");
                                                                foreach ($wei as $weight) {
                                                                    $prior->p_name = $requirements->p_name;
                                                                    $prior->keyw = $requirements->keyw;
                                                                    $prior->req = $requirements->req;
                                                                    $prior->role = $requirements->role;
                                                                    $prior->weight = $weight->weight;
                                                                    $prior->create();
                                                                }
                                                            }
                                                        } else {
                                                            foreach ($req1 as $requirements) {
                                                                $wei = $weight->find_by_sql("select * from finall where post='{$requirements->role}'");
                                                                foreach ($wei as $weight) {
                                                                    $weight_prior += $weight->weight;
                                                                    $emp_name .= $requirements->p_name . ",";
                                                                    $emp_role .= $requirements->role . ",";

                                                                }

                                                            }
                                                            $prior->p_name = $emp_name;
                                                            $prior->keyw = $requirements->keyw;
                                                            $prior->req = $requirements->req;
                                                            $prior->role = $emp_role;
                                                            $prior->weight = $weight_prior;
                                                            $prior->create();
                                                            $emp_name = "";
                                                            $emp_role = "";
                                                            $weight_prior = 0;

                                                        }
                                                    } ?>  </h2>
                                                <ul class="nav navbar-right panel_toolbox">
                                                    <li><a class="collapse-link"><i
                                                                    class="fa fa-chevron-up"></i></a>
                                                    </li>

                                                </ul>
                                                <div class="clearfix"></div>
                                            </div>
                                            <?php $pr = Prioritize::find_all();
                                            foreach ($pr as $prior){
                                            ?>

                                            <div class="x_content">

                                                <div class="table-responsive">
                                                    <form action="reports.php" method="post">
                                                        <table class="table table-striped jambo_table bulk_action">
                                                            <thead>
                                                            <tr class="headings">


                                                                <th class="column-title">Participnt <br>Name</th>
                                                                <th class="column-title">Keywords</th>
                                                                <th class="column-title">Requirements</th>
                                                                <th class="column-title">Role</th>
                                                                <th class="column-title">Weight</th>


                                                            </tr>
                                                            </thead>
                                                            <tbody>

                                                            <tr>

                                                                <td><?php echo $prior->p_name; ?></td>
                                                                <td><?php echo $prior->keyw; ?></td>
                                                                <td><?php echo $prior->req; ?></td>
                                                                <td><?php echo $prior->role; ?></td>
                                                                <td><?php echo $prior->weight; ?></td>
                                                            </tr>

                                                            </tbody>
                                                            <?php
                                                            }
                                                            }
                                                            ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div></div>

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
</body>
</html>
