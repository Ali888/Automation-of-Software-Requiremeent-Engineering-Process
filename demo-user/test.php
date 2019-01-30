<?php 

    if(isset($_GET['paid']))
    {
         $res =  enterReq();
    }
if(isset($_POST['ent']))
{
    $f = $_POST['message1'];
    $f1 = $_POST['message'];
    
    $t = true;
    $a = sizeof($f);
    $a1 = sizeof($f1);
    if($a==$a1)
    {
        for($i = 0 ; $i<$a; $i++)
        {
            $r = updatee($f[$i],$f1[$i]);
            if($r)
                $t = true;
             //echo "<script> alert('Entred');</script>";
            else
            {
                 $t = false;
            }
                
            
            
        }
        if($t)
        { 
            header('Location: invitedProject.php');
           echo "<script> alert('Data IS entered');</script>";
        }
            else
            {
                     header('Location: invitedProject.php');
           echo "<script> alert('Data IS Not entered');</script>";
       
            }
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
                      
                      <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <br />
                    <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" method="post">
                    <?PHP 
                        $t = "tags_1";
                         if(mysqli_num_rows($res)>0)
                         {
                             while($row = mysqli_fetch_assoc($res))
                             {
                        ?>
                        <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name"><?php echo $row['keyw']; ?>  <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                                  <input id="<?php echo $t; ?>" type="text" class="tags form-control"data-role="tagsinput"   name="message[]"/>
                                  <div id="suggestions-container" style="position: relative; float: left; width: 250px; margin: 10px;"></div>
                        </div>
                        
                        <input type="hidden" name="message1[]" value="<?php echo $row['keyw'];  ?>" />
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

