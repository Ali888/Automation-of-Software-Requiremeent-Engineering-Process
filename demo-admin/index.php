<?php 
 //include_once('../includes/functions.php');
 include_once ('includes/User.php');
include_once ('includes/Session.php');

if($session->is_logged_in()){
    header('Location: home.php');
}


 /*
if(isset($_SESSION['name']) && isset($_SESSION['pass']))
     header('Location: home.php');
*/
 if(isset($_POST['as']))
{
    $us = $user->authenticate($_POST['a'],$_POST['b']);
    if($us){
         $session->login($us);
        header('Location: home.php');
        } else {
         echo "<script> alert('Wrong Information'); </script>";
        }
    }
    /*
    $res = login();
    if($res->num_rows>0)
            {
                while($row = $res->fetch_assoc()) 
            {
                    $_SESSION['name'] = $row['name'];
                    $_SESSION['pass'] = $row['pass'];
                    header('Location: viewProject.php');
            }
          }
    else
        echo "<script> alert('Wrong Information'); </script>";
    */
   // header('Location: viewProject.php');

//}
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



      <link rel="stylesheet" href="sweetalert.css">
      <script src="sweetalert.min.js"></script>
      <link rel="stylesheet" type="text/css" href="../Boot/js/bootstrap.min.css">
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

      <link href="../Boot/vendors/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
      <link href="../Boot/vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css" rel="stylesheet">
      <link href="../Boot/vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css" rel="stylesheet">
      <link href="../Boot/vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css" rel="stylesheet">
      <link href="../Boot/vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css" rel="stylesheet">

      <!-- Custom Theme Style -->
      <link href="../Boot/build/css/custom.min.css" rel="stylesheet">


      <script src="alertify.min.js"></script>
      <link rel="stylesheet" href="alertify.css" />
      <link rel="stylesheet" href="alertify.default.css" />




      <!-- Custom Theme Style -->
      <link href="../Boot/build/css/custom.min.css" rel="stylesheet">



  </head>

  <body class="login">
    <div>
      <a class="hiddenanchor" id="signup"></a>
      <a class="hiddenanchor" id="signin"></a>

      <div class="login_wrapper">
        <div class="animate form login_form">
          <section class="login_content">
            <form method="post">
              <h1>Admin Login</h1>
              <div>
                <input type="text" class="form-control" placeholder="Username" required="" name="a"/>
              </div>
              <div>
                <input type="password" class="form-control" placeholder="Password" required="" name="b" />
              </div>
              <div>
                <input type="submit" name="as" value="Login" align="center">
               </div>

              <div class="clearfix"></div>

              <div class="separator">
                <div class="clearfix"></div>
                <br />

                <div>
                  <h1><i class="fa fa-paw"></i>Admin Panel Login</h1>
                  <!--
                  <p>©2016 All Rights Reserved. Gentelella Alela! is a Bootstrap 3 template. Privacy and Terms</p>
                  -->
                </div>
              </div>
            </form>
          </section>
        </div>

        <div id="register" class="animate form registration_form">
          <section class="login_content">
            <form>
              <h1>Create Account</h1>
              <div>
                <input type="text" class="form-control" placeholder="Username" required="" />
              </div>
              <div>
                <input type="email" class="form-control" placeholder="Email" required="" />
              </div>
              <div>
                <input type="password" class="form-control" placeholder="Password" required="" />
              </div>
              <div>
                <a class="btn btn-default submit" href="index.html">Submit</a>
              </div>

              <div class="clearfix"></div>

              <div class="separator">
                <p class="change_link">Already a member ?
                  <a href="#signin" class="to_register"> Log in </a>
                </p>

                <div class="clearfix"></div>
                <br />

                <div>
                  <h1><i class="fa fa-paw"></i> Gentelella Alela!</h1>
                  <p>©2016 All Rights Reserved. Gentelella Alela! is a Bootstrap 3 template. Privacy and Terms</p>
                </div>
              </div>
            </form>
          </section>
        </div>
      </div>
    </div>
  </body>
</html>
