<?php
include_once ('includes/project.php');
include_once ('includes/database.php');

$project = new Project();
?>
 

     
     <?php
	if (isset($_REQUEST['id'])) {
			
		$id = intval($_REQUEST['id']);
    //    echo "<script> alert(".$id."); </script>";
		$query = "SELECT * FROM project_info WHERE project_id='".$id."' LIMIT 1;";
        $proj = $project->find_by_sql($query);
	    //echo $project->project_Title;
	  //	$res = $con->query($query);
     
		// while($row = $res->fetch_assoc()) {
        foreach ($proj as $project){
   //     echo "<script> alert(".$row["project_id"]."); </script>";
    
		?>
			
		<div class="table-responsive">
		  <form id="contact_form" method="get" action="editProject.php?id=<?php //$id; ?>?&&action=edit">
                <table class="table table-striped table-bordered">
		         <tr>
			    <th>Project Id</th>
				
				<td>
				      <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="first-name" required="required" class="form-control col-md-7 col-xs-12" name="pTitle" value="<?php echo $project->project_id;  ?> " readonly>
                        </div>
                      </div>
				</td>
	     		</tr>
			<tr>
				<th>Projct Title</th>
				<td>
				<div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="first-name" required="required" class="form-control col-md-7 col-xs-12" name="pTitle" value="<?php echo $project->project_Title;  ?> " readonly>
                        </div>
                      </div>
			    </td>
			</tr>
			<tr>
				<th>Project Keywords</th>
				<td>
				<div class="control-group">
                        
                        <div class="col-md-9 col-sm-9 col-xs-12">
                          <input id="tags_1" type="text" class="tags form-control"   name="tag1" value="<?php echo  $project->key_Words;  ?>" readonly/>
                          <div id="suggestions-container" style="position: relative; float: left; width: 250px; margin: 10px;" ></div>
                        </div>
                      </div>
				
			    </td>
			</tr>
			
			<tr>
				<th>Projct Description</th>
				<td>
				<div class="form-group">
                         <div class="col-md-12 col-sm-12 col-xs-12">
                          <textarea class="form-control" rows="4"  name="dis"
                              value="" readonly><?php echo $project->Project_Desc;  ?>
                              </textarea>
                        </div>
                          
                      </div>
				
                </td>
			</tr>
			<tr>
				<th>Project Type</th>
				<td>
				<div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="first-name" required="required" class="form-control col-md-7 col-xs-12" name="pTitle" value="<?php  echo $project->project_Type;  ?> " readonly>
                        </div>
                      </div> 
			    </td>
			</tr>
			<tr>
				<th>Organization</th>
				<td>
				<div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="first-name" required="required" class="form-control col-md-7 col-xs-12" name="pTitle" value="<?php   echo $project->organization;  ?> " readonly>
                        </div>
                      </div>
				</td>
			</tr>
			
		</table>
			</form>
		</div>
			
		<?php				
	}
    
    }
?>
 
	


 <!-- jQuery -->
    <script src="../Boot/vendors/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="../Boot/vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    
    
    <!-- bootstrap-wysiwyg -->
    
    <!-- jQuery Tags Input -->
    <script src="../Boot/vendors/jquery.tagsinput/src/jquery.tagsinput.js"></script>
    
    
    
    <!-- Custom Theme Scripts -->
    <script src="../Boot/build/js/custom.min.js"></script>
