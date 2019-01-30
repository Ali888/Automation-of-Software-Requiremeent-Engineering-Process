<?php 
 include_once('../admin/includes/employee.php');

include_once('includes/Session.php');
if($session->is_logged_in()){
    header('Location: home.php');
}



if(isset($_POST['as']))
{
    $user = $employee->authenticate($_POST['a'],$_POST['b']);
    if($user){
        $session->login($user);
        header('Location: home.php');
      //
    } else {
    echo "<script> alert('Wrong Information'); </script>";
    }
    /*
    $res = login();
    if($res->num_rows>0)
            {
                while($row = $res->fetch_assoc()) 
            {
                    $_SESSION['name_user'] = $row['username'];
                    $_SESSION['pass_user'] = $row['password'];
                    $_SESSION['part_id'] = $row['participent_id'];
                    $_SESSION['name'] = $row['participent_name'];
                    $_SESSION['role'] = $row['participent_role'];
                    /*
                    $res = role($_SESSION['part_id'],$_SESSION['name']);
                    $row=mysqli_fetch_array($res,MYSQLI_NUM);
                    //$res = $row[2];
                    $_SESSION['role'] = $row[2];

                    header('Location: invitedProject.php');
            }
          }
    else
        echo "<script> alert('Wrong Information. No User Exist'); </script>";
*/
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
    <!-- Animate.css -->
    <link href="../Boot/vendors/animate.css/animate.min.css" rel="stylesheet">

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
              <h1>User Login</h1>
              <div>
                <input type="text" class="form-control" placeholder="Username" required="" name="a"/>
              </div>
              <div>
                <input type="password" class="form-control" placeholder="Password" required="" name="b" />
              </div>
              <div>
                <input type="submit" name="as" value="Login" align="center">
                <!--
                <a class="reset_pass" href="#">Lost your password?</a>
                 -->
              </div>

              <div class="clearfix"></div>

              <div class="separator">
              <!-- 
                <p class="change_link">New to site?
                  <a href="#signup" class="to_register"> Create Account </a>
                </p>
                  -->
                <div class="clearfix"></div>
                <br />

                <div>
                  <h1><i class="fa fa-paw"></i>User Dashboard</h1>
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