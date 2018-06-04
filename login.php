<?php
    ob_start();
    $title="Login";
?>




<!DOCTYPE html>
<html lang="en">

    <?php
        include_once("includes/header.php");
    ?>
    
    <?php
        session_start();
        if(isset($_POST['login'])){
        
            $user_email=$_POST['user_email'];
            $user_password=$_POST['user_password'];

            $query="select * from users where user_email='$user_email'";
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
                $_SESSION['user_id']=$db_user_id;
                $_SESSION['file_id']=$file_id;                   
                header("Location: index.php?file_id=$file_id&page=dashboard");
            }else{
                header("Location: login.php");
            }

        }
    ?>

    
    

    <body>

       <!-- Page Content -->
       <br><br><br>
        <div class="container">

            <div class="row">
                <div class="col-md-3"></div>
                <div class="col-md-6 col-md-offset-3">
                    
                    <form action="" method="POST" role="form">
                        <legend>Login</legend>

                        <div class="form-group">
                            <label for="">Email id</label>
                            <input type="email" class="form-control" id="username" placeholder="Enter your username" name="user_email">
                        </div>

                        <div class="form-group">
                            <label for="">Password</label>
                            <input type="password" class="form-control" id="password" placeholder="Enter yout password" name="user_password">
                        </div>

                        <button type="submit" name="login" class="btn btn-primary">Submit</button>
                    </form>

                </div>

            </div>
            <!-- /.row -->


        </div>
        <!-- /.container -->

        <!-- jQuery -->
        <script src="js/jquery.js"></script>

        <!-- Bootstrap Core JavaScript -->
        <script src="js/bootstrap.min.js"></script>

    </body>

</html>