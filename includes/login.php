<?php
    include("db.php");
    include("../functions.php");
    session_start();
    if(isset($_POST['login'])){
        
        $user_email=$_POST['user_email'];
        $user_password=$_POST['user_password'];
        
        $query="select * from users where username='$user_email'";
        $select_user_details=mysqli_query($connection,$query);
        confirmQuery($select_user_details);
        
        if($row=mysqli_fetch_assoc($select_user_details)){    
            $db_user_id=$row['user_id'];
            $db_user_email=$row['user_email'];
            $db_hashed_password=$row['user_password'];
            $file_id=get_user_file_id($db_user_email);   
        }
        
        
            if(password_verify($user_password,$db_hashed_password) && $user_email===$db_user_email){
                $_SESSION['user_email']=$db_user_email;
                $_SESSION['user_id']=$user_id;
                $_SESSION['file_id']=$file_id;                   
                header("Location: index.php?file_id=$file_id&page=dashboard");
            }else{
                header("Location: login.php");
    
        }
       
    }
?>
