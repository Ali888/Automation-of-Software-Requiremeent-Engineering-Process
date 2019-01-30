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
    $_SESSION['demo_proj']) = $a[1];
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
        <?php include_once ('files.php');?>

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
                                       echo $_SESSION['demo_proj']);}
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

                    <div class="col-xs-2">
                      <!-- required for floating -->
                      <!-- Nav tabs -->
                      <ul class="nav nav-tabs tabs-left">
                        <li class="active"><a href="#home" data-toggle="tab">Select Projet</a>
                        </li>
                        <li><a href="#profile" data-toggle="tab">Invite Participants</a>
                        </li>
						<li><a href="#invite" data-toggle="tab">Invited Participants</a>
                        </li>
                        <li><a href="#per" data-toggle="tab">Requirements Permission</a>
                        </li>
                        <li><a href="#messages" data-toggle="tab">Requirement Gathering</a>
                        </li>
                        <li><a href="#settings" data-toggle="tab">Requirement Prioritization</a>
                        </li>
						<li><a href="#settings1" data-toggle="tab">Requirement Finalization</a>
                        </li>
                      </ul>
                    </div>

                    <div class="col-xs-10">
                      <!-- Tab panes -->

                      <div class="tab-content">

                        <div class="tab-pane active" id="home">
									
									 <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" method="post">
								  <div class="form-group">
								<label class="control-label col-md-3 col-sm-3 col-xs-12">Select A Project</label>
								<div class="col-md-9 col-sm-9 col-xs-12">
                                <select class="select2_single form-control" tabindex="-1" name="proj">

                              <?php
                                         $proj = Project::find_all();
                                         foreach ($proj as $project) {
                                             ?>
                                             <option value="<?php echo $project->project_id."?".$project->project_Title; ?>">
                                                 <?php echo $project->project_Title; ?>
                                             </option>

                                             <?php
                                         }
                                      ?>
                                     </select>

								</div>
							  </div>

							  <div class="form-group">
								<div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
								  <button type="submit" class="btn btn-success" name="sess">Enter</button>
								</div>
							  </div>

							</form>
                        </div>  <!-- end of tab 1 -->

                          <div class="tab-pane" id="profile">
										<div class="col-md-12 col-sm-12 col-xs-12">
							<div class="x_panel">
							  <div class="x_title">
								<h2>Invite Participants<small></small></h2>
								<ul class="nav navbar-right panel_toolbox">
								  <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
									</li>
								  
								  
								</ul>
								<div class="clearfix"></div>
							  </div>

							  <div class="x_content">
                             <div class="table-responsive">
								  <form action="reports.php" method="post"> 
								  <table class="table table-striped jambo_table bulk_action">
									<thead>
									  <tr class="headings">
							
										<th class="column-title">Invite Participent </th>
										<th class="column-title">Participent Id </th>
										<th class="column-title">Participent Name </th>
										<th class="column-title">Project ID </th>
										<th class="column-title">Project Title </th>
										<th class="column-title">Participent Role </th>
										
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
                                            $sql = "select * from partcipent_info where invited='0' and project_name='{$_SESSION['demo_proj'])}'";
                                            $part = $partcipent->find_by_sql($sql);

                                                foreach ($part as $partcipent){
                                                   echo "<tr>
                                                   <td><input type='checkbox' name='a[]' 
                                                   value='".$partcipent->participent_id."?".$partcipent->project_id."?"."'></td>
                                                   <td>".$partcipent->participent_id."</td>
                                                   <td>".$partcipent->participent_name."</td>
                                                   <td>".$partcipent->project_id."</td>
                                                   <td>".$partcipent->project_name."</td>
                                                   <td>".$partcipent->participent_role."</td></tr>";
                                                }
                                              echo "</tbody>";
                                            }
                                            ?>
							      
								  </table>
								  <button type="submit" class="btn btn-success" name="ss">Send Invitation</button>
								  </form>
                                      
								</div>
					</div>
						</div>	
						
                  </div>
						</div>

						  <div class="tab-pane" id="invite">
										<div class="col-md-12 col-sm-12 col-xs-12">
							<div class="x_panel">
							  <div class="x_title">
								<h2>Invited Participants<small></small></h2>
								<ul class="nav navbar-right panel_toolbox">
								  <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
									</li>
								</ul>
								<div class="clearfix"></div>
							  </div>

							  <div class="x_content">
                             <div class="table-responsive">

								  <table class="table table-striped jambo_table bulk_action">
									<thead>
									  <tr class="headings">
							    		<th class="column-title">Project <br> ID </th>
										<th class="column-title">Project<br> Title </th>
										<th class="column-title">Participent<br> Id </th>
										<th class="column-title">Participent <br> Name </th>
										<th class="column-title">Delete <br> Invitation </th>
                                       </tr>
									</thead>
                                     
                                      <?php 
                                      if(!isset($_SESSION['demo_proj']))
                                      {
                                            echo "<h1>No Project Is Selected</h1>";
                                        }
                                        else {
                                            echo "<tbody>";
                                            $sql = "select * from partcipent_info where invited='1' and project_name='{$_SESSION['demo_proj'])}'";
                                            $part = $partcipent->find_by_sql($sql);
                                            foreach ($part as $partcipent) {
                                                //  $id = $row['p_id'];
                                                echo "<tr>
                                                        <td>".$partcipent->project_id."</td>
                                                   <td>".$partcipent->project_name."</td>
                                                   <td>".$partcipent->participent_id."</td>
                                                   <td>".$partcipent->participent_name."</td>
                                                   
                                                  <td>
                                                  
                                                   <a href='reports.php?part={$partcipent->participent_id}&&proj={$partcipent->project_id}'>
                                                     <button type='submit' class='btn btn-sm btn-danger' name='sub1'>Delete</button>
                                                    </a>
                                                   </td></tr>";
                                            }
                                            echo "</tbody>";
                                        }

                                   ?>
							      
								  </table>
								  

                                      
								</div>
					</div>
						</div>	
						
                  </div>
						</div>
                
						 <div class="tab-pane" id="per">
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
								  <form action="reports.php" method="post"> 
								  <table class="table table-striped jambo_table bulk_action">
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

                                      if(!isset($_SESSION['demo_proj']))
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
                
                		 <div class="tab-pane" id="messages">
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

								  <form action="reports.php" method="post"> 
								  <table    class="table table-striped jambo_table bulk_action">
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
                       
                        <div class="tab-pane" id="settings">
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

                                                        $sql = "SELECT DISTINCT keyw FROM `requirements`";
                                                        $req = $requirements->find_by_sql($sql);
                                                        $weight_prior = 0;
                                                        $emp_name = "";
                                                        $emp_role = "";
                                                        foreach ($req as $requirements) {
                                                            $req1 = $requirements->find_by_sql("SELECT * FROM `requirements` WHERE keyw='{$requirements->keyw }'");
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

                                                            }
                                                        } ?>  </h2>
                                                    <ul class="nav navbar-right panel_toolbox">
                                                        <li><a class="collapse-link"><i
                                                                        class="fa fa-chevron-up"></i></a>
                                                        </li>

                                                    </ul>
                                                    <div class="clearfix"></div>
                                                </div>

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

                                                                    <td><?php echo $prior->p_name;  ?></td>
                                                                    <td><?php echo $prior->keyw;   ?></td>
                                                                    <td><?php echo $prior->req;   ?></td>
                                                                    <td><?php echo $prior->role;   ?></td>
                                                                    <td><?php echo $prior->weight;   ?></td>
                                                                </tr>

                                                                </tbody>
                                                                <?php
                                                                }
                                        ?>
                                                    </div>
						</div>
                                            </div>
                                        </div></div>
                        <div class="tab-pane" id="settings1">
										<div class="col-md-12 col-sm-12 col-xs-12">
						      <?php

                                   if(!isset($_SESSION['demo_proj']))
                                      {
                                            echo "<h1>No Project Is Selected</h1>";
                                        }
                                  else
                                  {
                                      $prio = Prioritize::find_all();
                               //  $res =  selectTag();
                                 foreach ($prio as $prior){
                                  ?>
                                <div class="x_panel">
							  <div class="x_title">
								<h2>Finalized Requirements : <?php //echo $row['keyw'] ; ?> <small></small></h2>
								<ul class="nav navbar-right panel_toolbox">
								  <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
									</li>
								  
								</ul>
								<div class="clearfix"></div>
							  </div>

							  <div class="x_content">
                                
                                 <div class="table-responsive">
								  <form action="reports.php" method="post"> 
								  <table class="table table-striped jambo_table bulk_action">
									<thead>
									  <tr class="headings">
							
										
										<th class="column-title">Participnt <br>Name </th>
										<th class="column-title">Keywords  </th>
										<th class="column-title">Requirements </th>
										<th class="column-title">Role  </th>
										<th class="column-title">Weight </th>
										
										
									  </tr>
									</thead>
                                     <tbody>

                                         <tr>
                                            
                                             <td><?php echo $prior->p_name;  ?></td>
                                             <td><?php echo $prior->keyw;   ?></td>
                                             <td><?php echo $prior->req;   ?></td>
                                             <td><?php echo $prior->role;   ?></td>
                                             <td><?php echo $prior->weight;   ?></td>
                                         </tr>

                                     </tbody>
								  </table>

								  </form>
                                      
								</div>
					       
					         </div>
						</div>	
						<?php 
                                            }}

                                            // echo "<h1>No Project Is Selected</h1>";
                                  ?>
                                        </div>

                        </div><!--  End Of Tab-->

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



    <?php include_once ('files1.php');?>


   </body>
</html>
