<?php 

include('../mail/PHPMailerAutoload.php');

//session_start();
function insert_into_Project_Table($ope)
{
	global $con;
	
    if($ope=='add')
    {
    $projectTitle = $_POST['pTitle'];
    $projectdis = $_POST['dis'];
    $projectTag = $_POST['tag'];
    $projectOrg = $_POST['org'];
    //$projectKey = $_POST['tag1'];
        
    $sql = "insert into project_info (project_title,project_desc,project_type,organization,Key_Words) values ('$projectTitle','$projectdis','$projectTag','$projectOrg','".$_POST['tag1']."');";
    $res = $con->query($sql);
    $last_id = mysqli_insert_id($con);    
  //    echo "<script> alert('".$last_id."'); </script>";
        
        if($res ==true)
          {
            /*
            $token = strtok($_POST['tag1'], ",");
            $a = array();
            while ($token !== false)
            {
              //  echo $token;
                array_push($a,$token);
                    $token = strtok(",");
            }
   
            $b = sizeof($a);
            foreach( $a as $c)
            {
			    $sql = "insert into req (project_id,project_Title,Keyw) values ('$last_id ','$projectTitle','$c');";
                $res = $con->query($sql);
            } */
			return 1;
    }
        else{
            return mysqli_error($con);
        }
    }
    else
    if($ope=='edit')
	{
        $id = $_POST['pid'];
		$title = $_POST['pTitle'];
		$desc = $_POST['dis'];
		$tag = $_POST['tag'];
		$type = $_POST['tag1'];
		$org = $_POST['org'];
		$sql = "update project_info  SET project_Title='".$title."',Project_Desc='".$desc."',project_Type='".$type."',organization='".$org."',key_Words='".$tag."' where project_id= '".$id."'";
	    return $res = $con->query($sql);
    }
}

function sel($proj_id)
{
global $con;
    $sql = "select * from project_info where project_id='".$proj_id."'";
	    return $res = $con->query($sql);
}

function upd($proj_id,$a)
{
global $con;
 //   echo "<script> alert('".$proj_id.$a."'); </script>"; 
    $sql = "update project_info set key_Words='".$proj_id."' where project_id = '".$a."';";
	    return $res = $con->query($sql);
}


function select_Project($ope)
{
	global $con;
    if($ope=='project')
    {
    $sql = "select * from project_info ";
    
    
    
    $res =$con->query($sql);
    return $res;
    }
    else
    if($ope=='edit')
    {
        
		$sql = "select * from project_info where project_id='".$_GET['id']."'";
	    return $res = $con->query($sql);
    }
    else
    if($ope=='delete')
    {
        
        
		$sql = "delete from project_info where project_id='".$_GET['id']."'";
	    return $res = $con->query($sql);
    }
    else
        if($ope=='proj')
    {
    $sql = "select * from project_info where project_id='".$_GET['pid']."'" ;
    $res =$con->query($sql);
    return $res;
    }

}

function insert_into_Participent_Table($ope)
{
	global $con;
    if($ope=='add')
    {
        $paId = $_POST['pp'];
		$pID = $_POST['p2'];
        $paRole = $_POST['p3'];
		$pTitle = "";
		$paTitle = "";
        
        
        
        $sql = "select * from partcipent_info where project_id= '".$pID."' and participent_id='".$paId."';";
		$res= $con->query($sql);
		if($res->num_rows>0)
        {
            return "Partcipent IS Already Added";
        }
        else
        {
		$sql = "select project_Title from project_info where project_id= '".$pID."';";
		$res= $con->query($sql);
		if($res->num_rows>0)
		{
			while($row = $res->fetch_assoc()) 
                            {
                                $pTitle = $row['project_Title'];
                               
							}
		}
		
        $sql = "select p_name from partcipent where p_id= '".$paId."';";
		$res = $con->query($sql);
		if($res->num_rows>0)
		{
			while($row = $res->fetch_assoc()) 
                            {
                                $paTitle = $row['p_name'];
                            }
        }
            $paUser  = strtok($paTitle," ");
            $paPass  = $paUser."123";
			$paPass = md5($paPass);
        $sql = "insert into partcipent_info(project_id,project_name,participent_id, participent_name, participent_role,username,password) values ('$pID','$pTitle','$paId','$paTitle','$paRole','$paUser','$paPass');";
    if($con->query($sql)==true)
    {
        return 1;
    }
	else
	{
		return "farig";
	}
    }
    }
    else
    if($ope=='edit')
    {
         $sql = "update partcipent_info set participent_role='".$_POST['p3']."' where project_id='".
             $_GET['pid']."' and participent_id = '".$_GET['paid']."';";
        if($con->query($sql)==true)
        {
            return 1;
        }
	   else
	   {
		  return "farig";
	   }       
    }
    else 
        if($ope=='emp')
        {
            $p1 = $_POST['p1'];
            $p2 = $_POST['p2'];
            $p3 = $_POST['p3'];
            $p4 = strtok($p1, " ");
            $p5 = strtok($p1, " ");
           // $p5 = $p5."123";
            
            $sql = "insert into partcipent (p_name,p_designation,p_email) values ('$p1','$p2','$p3');";
            
            if($con->query($sql)==true)
            {
            return 1;
            }
        
	       else
	       {
		      return "farig";
	       } 
        }
}
function select_Post()
{
  global $con;
    
    $sql = "select * from finall ";
    $res =$con->query($sql);
    return $res;  
}

function select_Participant($ope)
{
     global $con;
    if($ope=='part')
    {
    $sql = "select * from partcipent ";
    $res =$con->query($sql);
    return $res;
    }
   else
    if($ope=='edit')
    {
        
		$sql = "select * from partcipent_info where project_id='".$_GET['id']."'";
	    return $res = $con->query($sql);
    }
    else
        if($ope=='edit1')
    {
        
		$sql = "select * from partcipent_info";
	    return $res = $con->query($sql);
    }
    else
           if($ope=='edit2')
    {
        
		$sql = "select * from partcipent where p_id='".$_GET['paid']."'";
	    return $res = $con->query($sql);
    }
    else
           if($ope=='delete')
    {
       $sql = " DELETE FROM partcipent_info WHERE project_id='".$_GET['pid']."' AND participent_id='".$_GET['paid']."';"; 
               $res =$con->query($sql);
	    if ($res){
          return $res;
        }
        else
        {
             echo "<script> alert('Data Is Not Updated'); </script>";
        }
    }
    else
           if($ope=='update')
    {
       $sql = " update partcipent set p_name='".$_POST['p2']."',p_designation='".$_POST['p3']."', p_email='".$_POST['p4']."' where p_id='".$_POST['p1']."';";       
	    if ($con->query($sql)==true){
             return 1;
        }
        else
        {
             echo "<script> alert('Data Is Not Updated'); </script>";
        }
    }
    else
           if($ope=='delete1')
    {
       $sql = " DELETE FROM partcipent WHERE p_id='".$_GET['paid']."' ;";      
	    if ($con->query($sql)==true){
            return 1;
        }
        else
        {
          return 0;
        }
    }
           if($ope=='delete2')
    {
               $sql = " update partcipent_info set invited = 0  WHERE project_id='".$_GET['pid']."' AND participent_id='".$_GET['paid']."';";
	         
	    if ($con->query($sql)==true){
            return 1;
        }
        else
        {
             echo "<script> alert('Data Is Not Updated'); </script>";
        }
    }
}

function select_role($partid,$pid)
{
    global $con;
    $sql = "select * from partcipent_info where project_id= '".$pid."' and participent_id='".$partid."';";
     return $res = $con->query($sql);
    
}
function allow_req($project_id,$p_id,$key){
    global $con;
    $sql = "update req set approve=1 where project_id = '".$project_id."' and  keyw='".$key."';";
     $res = $con->query($sql);
    if($res)
        return 1;
    else
        return 0;
        
    
}
function del_1($project_id,$p_id,$key){
    global $con;
    $sql = "delete from req where project_id = '".$project_id."' and  keyw='".$key."';";
     $res = $con->query($sql);
    if($res)
        return 1;
    
}
function invite()
{
    global $con;
    $sql = "select * from partcipent_info where project_id= '".$_SESSION['proj']."' and invited='0';";
     return $res = $con->query($sql);
    
}

function invite2()
{
    global $con;
    $sql = "select * from req where project_id= '".$_SESSION['proj']."' and approve='0';";
     return $res = $con->query($sql);
    
}

function invite1()
{
    global $con;
    $sql = "select * from partcipent_info where project_id= '".$_SESSION['proj']."' and invited='1';";
     return $res = $con->query($sql);
    
}

function login()
{
    global $con;
    $sql = "select * from user where name= '".$_POST['a']."' AND pass='".md5($_POST['b'])."';";
     return $res = $con->query($sql);
    
}

function ss()
{
    global $con;
    $sql = "select project_id,project_Title,Project_Desc,project_Type,organization,SUBSTR(key_Words,10) from project_info ";
    return $res = $con->query($sql); 
}

function sendMail($id){
      global $con;
    $sql = "select p_name,p_email from partcipent where p_id ='".$id."';";
    $res = $con->query($sql); 
    while($row = $res->fetch_assoc())
    {
        $name = $row['p_name'];
        $mail1 = $row['p_email'];
    }
        $n = strtok($name," ");
        $p = $n."123";
		$p = md5($p);
        $mail = new PHPMailer;
        $mail->isSMTP();                                     
        $mail->Host = 'smtp.gmail.com'; 
        $mail->Port = 587; 
        $mail->SMTPSecure = 'tls'; 
        $mail->SMTPAuth = true;                               
        $mail->Username = 'sulehry888@gmail.com';                 
        $mail->Password = 'Sajjad888';                          
      //  $mail->setFrom($name, 'Mailer');
        $mail->addAddress($mail1, $name);     
        $mail->addReplyTo('01113003065072@SKT.UMT.EDU.PK', 'Information');
        $mail->Subject = 'Inviatation For Project';
        $mail->Body    = 'Hello '.$name." \n\n it is Inform You that you are invited  to a project. \n\n For Further Detail, Login To Your Account\n\n Your USername is ".$n." And password is ".$p. "\nADmin \n\n Thanks";
        if(!$mail->send()) {
           // echo 'Message could not be sent.';
        //    echo 'Mailer Error: ' . $mail->ErrorInfo;
            return false;
        } else {
            return true;
            //echo 'Message has been sent';
        }
}

function selectTag(){
    global $con;
    
    $sql = "select distinct keyw from prio where project_id='".$_SESSION['proj']. "'";
    $res = $con->query($sql);
    if($res)
        return $res;
}

function selectTagg($res1){
    global $con;
    $sql = "select * from prio where keyw= '".$res1."' and project_id='".$_SESSION['proj']."';";
    $res = $con->query($sql);
    if($res)
        return $res;
}



function select_weight($t)
{
     global $con;
    if($t=="select")
    {
        $sql = "select * from finall";
         $res = $con->query($sql);
        if($res)
        {
            return $res;
        }
    }
    else
        if($t=="edit")
    {
             //echo "<script> alert('".$_POST['pid']."  ".$_POST['pid']."'); </script>";
        $sql = "update finall set weight = '".$_POST['pid']."' where post = '".$_GET['post']."';";
         $res = $con->query($sql);
        if($res)
        {
            return $res;
        }
    }
    else
        if($t=="add")
    {
             //echo "<script> alert('".$_POST['pid']."  ".$_POST['pid']."'); </script>";
        $sql = "insert into finall values('".$_POST['post']."','".$_POST['weight']."');";
         $res = $con->query($sql);
        if($res)
        {
            return $res;
        }
    }
         
}

function inv($r)
{
     global $con;
         $sql = "update partcipent_info set invited='1'  where  participent_id = '".$r."';";
        if($con->query($sql)==true)
        {
            return 1;
        }
	   else
	   {
		  return "farig";
	   }       
}

function view()
{
    global $con;
    
     $sql = "select * from prio where project_id= '".$_SESSION['proj']."' order by keyw;";
     return $con->query($sql);
      
}

function del($key,$req)
{
    global $con;
    
     $sql = "delete from prio where keyw= '".$key."' and req = '".$req."';";
   // echo "<script> alert('Key is ".$key."ANd Value is  ".$req. "'); </script>";
     return $con->query($sql);
      
}


?>