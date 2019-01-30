<?php 

include('../mail/PHPMailerAutoload.php');
session_start();

function login()
{
    global $con;
   //s  echo "<script> alert('".$_POST['a'].$_POST['b']."'); </script>";
    $sql = "select * from partcipent_info where username= '".$_POST['a']."' AND password='".md5($_POST['b'])."' and invited = 1;";
    return $res = $con->query($sql);
}

function role($id,$name)
{
      global $con;
   //s  echo "<script> alert('".$_POST['a'].$_POST['b']."'); </script>";
    $sql = "select * from partcipent where p_id= '".$id."' AND p_name='".$name."';";
    return $res = $con->query($sql);
}

function up1($tag,$value,$req)
{
    global $con;
    $sql = "update prio set req ='".$value ."' where keyw='".$tag."' and req='".$req."' and project_id='".$_SESSION['proj']."' and p_id='".$_SESSION['id']."';";
    $res = $con->query($sql);
    if($res)
    {
        return 1;
    }
    else
    {
           echo "<script> alert('inside insert'); </script>";

   echo "<script> alert('".$tag."  ".$value."  ".$req." '); </script>";
                $res =  weight($_SESSION['role']);
                $row=mysqli_fetch_array($res,MYSQLI_NUM);
                 $weight = $row[0];
                
         $sql = "select project_title from project_info where project_id= '".$_SESSION['proj']."'";
        $res =  $con->query($sql);
        $row=mysqli_fetch_array($res,MYSQLI_NUM);
                 $title = $row[0];
        
            $sql = "INSERT INTO prio(project_id, project_Title, p_id, p_name, keyw, req,role,weight) VALUES ('".$_SESSION['proj']."','".$title."','".$_SESSION['id']."','".$_SESSION['name']."','".$tag."','".$value."','".$_SESSION['role']."','".$weight."' );";
           $res = $con->query($sql); 
        return 1;
    }
}

function view_Project()
{
    global $con;
    $sql = "select * from partcipent_info where username= '".$_SESSION['name_user']."' AND password='".$_SESSION['pass_user']."' and invited = 1;";
     $res = $con->query($sql);
     $row = mysqli_fetch_array($res);
     //$t = $row['project_id'];
     //echo "<script> alert('".$t."');</script>";
    return $res = $con->query($sql);
}

function enterReq()
{
    global $con;
    $sql = "select key_Words from project_info where project_id= '".$_GET['paid']."';";
    return $res = $con->query($sql);
}

function updatee($k,$k1)
{
    global $con;
      // $_SESSION['id']
    
    $sql = "select project_Title from project_info where project_id= '".$_GET['paid']."'";
     $res =  $con->query($sql);
    $res = $con->query($sql);
    $row=mysqli_fetch_array($res,MYSQLI_NUM);
    $title = $row[0];
 //  echo "<script> alert('".$title."');</script>"; 
    
    $sql = "select * from  req where project_id = '".$_GET['paid']."' and p_id ='" .$_SESSION['id']."' and keyw='".$k."';";
     $res = $con->query($sql);
    if(mysqli_num_rows($res)>0)
    {
        $row=mysqli_fetch_array($res,MYSQLI_NUM);
        $des = $row[5];
        if($des == $k1)
        {
            
        }
        if($des==" ")
        {
        //    $k1 = $des.",".$k1; 
        }
            else
        {
                 
            $k1 = $des.",".$k1; 
          //      echo "<script> alert('".$des."');</script>";
           
         }
        $sql = "update req  set descr = '".$k1."' where project_id = '".$_GET['paid']."' and keyw = '".$k."' and p_id='".$_SESSION['id']."';";
        if($con->query($sql))
            return 1;
         echo "<script> alert('Update'); </script>";
    }
    else
    {
    $sql = "insert into req values('".$_GET['paid']."' , '".$title."','".$_SESSION['id']."','". $_SESSION['name']."','".$k."','".$k1."','1');";
    
    
//    $sql = "update req  set p_id='". $_SESSION['id']."' , p_name= '".$_SESSION['name']."',descr = '".$k1."' where project_id = '".$_GET['paid']."' and keyw = '".$k."';";
     $res = $con->query($sql);
        if($con->query($sql))
            return 1;
        else
            return mysqli_error($con);
        }
}


function add($k)
{
    global $con;
    $sql = "select project_Title from project_info where project_id= '".$_GET['paid']."'";
     $res =  $con->query($sql);
    $res = $con->query($sql);
    $row=mysqli_fetch_array($res,MYSQLI_NUM);
    $title = $row[0];
   
    
    $sql = "select * from  req where project_id = '".$_GET['paid']."' and p_id ='" .$_SESSION['id']."' and keyw='".$k."';";
     $res = $con->query($sql);
    if(mysqli_num_rows($res)>0)
    {
         echo "<script> alert('".$k."  Tag ALready Exist'); </script>";
        return 0;
    }
    else
    {
        $sql = "select * from  req where project_id = '".$_GET['paid']."' and  keyw='".$k."';";
        $res = $con->query($sql);
        if(mysqli_num_rows($res)>0)
        {
                     echo "<script> alert('".$k."  Tag ALready Exist'); </script>";
                    return 0;
        }
        else
        {
                $sql = "insert into req values('".$_GET['paid']."' , '".$title."','".$_SESSION['id']."','". $_SESSION['name']."','".$k."',' ','0');";
                 $res = $con->query($sql);
                if($con->query($sql))
                return 1;
        }
        }
}
function view()
{
    global $con;
     $sql = "select * from prio where project_id= '".$_SESSION['proj']."' and p_name = '".$_SESSION['name']."' and p_id = '".$_SESSION['id']."';";
     return $con->query($sql);
}

function  weight($role)
{
    global $con;
     $sql = "select weight from finall where post= '".$role."'";
     $res =  $con->query($sql);
    if($res)
        return $res;
}

function priorize($tag,$value)
{   
    global $con;
    //echo "<script> alert('inside proio');</script>";
     $sql = "select * from project_info where project_id= '".$_GET['paid']."'";
     $res =  $con->query($sql);
    if(mysqli_num_rows($res)>0)
    {
     //   echo "<script> alert('".$tag.$value."'); </script>";
        while($row = mysqli_fetch_array($res))
        {
            $title = $row['project_Title'];        
        }
         
        $sql = "select * from prio where keyw= '".$tag."' and req='".$value."' and project_id ='".$_GET['paid']."' and p_id='".$_SESSION['id']."';";
        $res =  $con->query($sql);
        if(mysqli_num_rows($res)>0)
        {    
      //         echo "<script> alert('Inside update for session'); </script>";
             
             
            
             $sql = "update  prio set req='".$value."', role='".$_SESSION['role']."'  where keyw= '".$tag."' and req='".$value."' and project_id ='".$_GET['paid']."' and p_id='".$_SESSION['id']."' ;";
            $res =  $con->query($sql);
        }
        else
        {
            $sql = "select * from prio where keyw= '".$tag."' and req='".$value."' and project_id ='".$_GET['paid']."';";
            $res =  $con->query($sql);
            if(mysqli_num_rows($res)>0)
            {
                
                $row=mysqli_fetch_array($res,MYSQLI_NUM);
                $project_id =$row[0];
                $p_name =$row[3];
                $p_id =$row[2];
                $role =$row[6];
                $weight =$row[7];
                
                
                if (strpos($p_id, $_SESSION['id']) !== FALSE)
                    {
                   //echo "<script> alert('ALready Exist '); </script>";
                }
                else
                {
                $project_idd = $p_id.",".$_SESSION['id'];
                $p_idd = $p_name.",".$_SESSION['name'];
                $p_role = $role.",".$_SESSION['role'];
                    
                $res =  weight($_SESSION['role']);
                $row=mysqli_fetch_array($res,MYSQLI_NUM);
                 $weight = $weight + $row[0];   
        //    echo "<script> alert('".$tag."   ".$value."  ".$_GET['paid']."'); </script>";
                
                $sql = "update prio set p_id='".$project_idd."',p_name='".$p_idd."', role='".$p_role."',weight='".$weight."' where keyw= '".$tag."' and req='".$value."' and project_id ='".$_GET['paid']."' ;";
                
            //    $sql = "update prio set p_id='".$project_id."', p_name='".$p_id."' where keyw= '".$tag."' and req='".$value."' and project_id ='".$_GET['paid']."';";
                $res =  $con->query($sql);
                if($res)
                {
                  $sql = "delete prio where keyw= '".$tag."' and req='".$value."' and project_id ='".$_GET['paid']."' ;";
                   
                }else
                    echo "<script> alert('".mysqli_error($res)."'); </script>";
                }
                    /*
                $sql = "update  prio set per=".++$per." where keyw= '".$tag."' and req='".$value."' and project_id ='".$_GET['paid']."' ;";
                $res =  $con->query($sql);
                */
            }
            else{
                 $res =  weight($_SESSION['role']);
                $row=mysqli_fetch_array($res,MYSQLI_NUM);
                 $weight = $row[0];
                $sql = "INSERT INTO prio(project_id, project_Title, p_id, p_name, keyw, req,role,weight) VALUES ('".$_GET['paid']."','".$title."','".$_SESSION['id']."','".$_SESSION['name']."','".$tag."','".$value."','".$_SESSION['role']."','".$weight."' );";
                return $con->query($sql);
            }
        }
        
    }
    
    
    
}

function delte(){
     global $con;
     $sql = "delete  from prio where project_id= '".$_GET['paid']."' and p_id = '".$_SESSION['id']."';";
     $res =  $con->query($sql);
    
}




?>