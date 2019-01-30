<?php
        include_once('includes/Weight.php');
        include_once('includes/employee.php');
        include_once('includes/Participant.php');
        include_once('includes/Session.php');
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
                    <h2>Participent List<small></small></h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    
					<form ></form>
                    <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                      <thead>
                        <tr>
                          <th>Participent ID</th>
                          <th>Participent Name</th>
                          <th>Project ID</th>
                          <th>Project Title</th>
                          <th>Participent Role</th>
                          <th>Edit</th>
                          <th>Delete</th>
                        </tr>
                      </thead>
                      <tbody>
                       <?php
                            $part = Participant::find_all();
                            foreach ($part as $partcipent)
                            {
                               echo "<tr>
                                <td>".$partcipent->participent_id."</td>
                               <td>".$partcipent->participent_name."</td>
                               <td>".$partcipent->project_id."</td>
                               <td>".$partcipent->project_name."</td>
                               <td>".$partcipent->participent_role."</td>"
                             ?> 
                            <td>
                               <a href="editParticipent.php?paid=<?php echo $partcipent->participent_id.'&&pid='.$partcipent->project_id."&&action=edit" ?>" >
                                <button type='submit' class='btn btn-sm btn-info' name='sub'>Edit</button></a>
                             </td>
                           <td>
                               <a href="editParticipent.php?paid=<?php echo $partcipent->participent_id.'&&pid='.$partcipent->project_id."&&action=delete" ?>" >
                                <button type='submit' class='btn btn-sm btn-danger' name='sub1'>Delete</button></a>
                             </td>
                              <?php
                              echo  '</tr>';
                            }


                          ?>
                      </tbody>
                    </table>
					
					
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- /page content -->


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

