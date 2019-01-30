<?php
include_once ('includes/project.php');
include_once ('includes/database.php');
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
                  <div class="col-md-12 col-sm-3 col-xs-3">
                        <div class="x_panel">
                          <div class="x_title">
                            <h2>Project List<small></small></h2>
                                <ul class="nav navbar-right panel_toolbox">
                                  <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                  </li>
                                  
                                </ul>
                                <div class="clearfix"></div>
                            </div>
                      <div class="x_content">
                           <table id="datatable" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                              <thead>
                                <tr>
                                  <th>Project ID</th>
                                  <th>Project Ttile</th>
                                  <th>Project Type</th>
                                  <th>Project Detail</th>
                                  
                                  <th>Operation</th>
                                 
                                </tr>
                              </thead>
                              <tbody>
                               <?php 
                                  $res = Project::find_all();

                                    //while($row = $database->fetch_array($res))
                                    foreach ($res as $obj)
                                    {
                                       // $id = $row['project_id'];
                                       ?>
                                        <tr>

                                       <td><?php echo $obj->project_id ?></td>
                                       <td><?php echo $obj->project_Title ?></td>
                                        <td><?php echo $obj->project_Type ?></td>

                                            <td>
                                          <button data-toggle="modal" data-target="#myModal" data-id="<?php echo $obj->project_id; ?>" id="getUser" class="btn btn-sm btn-info">Detail</button>
                                       </td>
                                      <td>
                                        <a href='editProject.php?id=<?php echo $obj->project_id; ?>&&action=edit'>
                                        <button type='submit' class='btn btn-sm btn-info' > 
                                        Edit
                                        </button></a>
                                        
                                       <a href='editProject.php?id=<?php echo $obj->project_id;
                                                ?>&&action=delete'>  
                                        <button type='submit' class='btn btn-sm btn-danger' > 
                                       Delete
                                        </button></a>
                                      </td>
                                       </tr>
                                       <?php 				
		
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
        
          <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Project Information</h4>
        </div>
        <div class="modal-body">
          
          <div id="modal-loader" style="display: none; text-align: center;">
                       	   	<img src="ajax-loader.gif">
                       	   </div>
                            
                           <!-- content will be load here -->                          
                           <div id="dynamic-content"></div>
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


        <script>
$(document).ready(function(){
	
	$(document).on('click', '#getUser', function(e){
		
		e.preventDefault();
		
		var uid = $(this).data('id');   // it will get id of clicked row
		
		$('#dynamic-content').html(''); // leave it blank before ajax call
		$('#modal-loader').show();      // load ajax loader
		
		$.ajax({
			url: 'getuser.php',
			type: 'POST',
			data: 'id='+uid,
			dataType: 'html'
		})
		.done(function(data){
			console.log(data);	
			$('#dynamic-content').html('');    
			$('#dynamic-content').html(data); // load response 
			$('#modal-loader').hide();		  // hide ajax loader	
		})
		.fail(function(){
			$('#dynamic-content').html('<i class="glyphicon glyphicon-info-sign"></i> Something went wrong, Please try again...');
			$('#modal-loader').hide();
		});
		
	});
	
});

</script>
  
  

  </body>
</html>
