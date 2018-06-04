<?php
    

    function checkUser(){
        if(!isset($_SESSION['username'])){
            die("<p style='color:white'>You have not logged in ,please login from <a href='../index.php'>here</a></p>");
        }
        $username=$_SESSION['username'];
        return $username;
    }

    function confirmQuery($result){
        global $connection;
        if(!$result){
            die("Query Failed".mysqli_error($connection));
        }
    }

    function getFilePath($file_id){
        global $connection;
        $file_path="";
        $query="select * from files where file_id=(select parent_file_id from files where file_id=$file_id)";
        $file_path_query=mysqli_query($connection,$query);
        $row=mysqli_fetch_assoc($file_path_query);
        while($row){
            $file_path=$row['file_name'].$file_path;
            $temp_file_id=$row['file_id'];
            $query="select * from files where file_id=select parent_file_id from files where file_id=$temp_file_id";
            $file_path_query=mysqli_query($connection,$query);
            $row=mysqli_fetch_assoc($file_path_query);
        }
        return $file_path;
        
    }



 
        




    function editCategory(){
        global $connection;
        if(isset($_POST['edit_submit'])){
                                            $input_cat_title=$_POST['cat_title'];
                                            $input_cat_id=$_GET['edit'];
                                            if($input_cat_title==""||empty($input_cat_title)){
                                                echo "<h5 class='text-danger'>&#42;Please enter the category field and then try</h5>";
                                            }
                                            else{
                                                $query="UPDATE categories SET cat_title ='$input_cat_title' where cat_id='$input_cat_id'";
                                                
                                                $update_cat_query=mysqli_query($connection,$query);
                                                
                                                if(!$update_cat_query){
                                                    die('Query Failed'.mysqli_error($connection));
                                                }
                                                header("Location: categories.php");
                                            }
                                        }
    }


    function addCategory(){
        global $connection;
        if(isset($_POST['submit'])){
                                            $input_cat_title=$_POST['input_cat_title'];
                                            if($input_cat_title==""||empty($input_cat_title)){
                                                echo "<h5 class='text-danger'>&#42;Please enter the category field and then try</h5>";
                                            }
                                            else{
                                                $query="INSERT INTO categories(cat_title) ";
                                                $query.="VALUE('$input_cat_title')";
                                                $add_cat_query=mysqli_query($connection,$query);
                                                
                                                if(!$add_cat_query){
                                                    die('Query Failed'.mysqli_error($connection));
                                                }
                                                header("Location: categories.php");
                                            }
                                        }
    }


    function fetchCategoryForEdit(){
        global $connection;
        
                                        /*Used to fethch category title according to the edit get request*/
                                        if(isset($_GET['edit'])){
                                            $edit_cat_id=$_GET['edit'];
                                            $query="Select * from categories where cat_id=$edit_cat_id";
                                            $edit_catgeory_title_query=mysqli_query($connection,$query);
                                            if($row=mysqli_fetch_assoc($edit_catgeory_title_query)){
                                                $edit_cat_title=$row['cat_title'];
                                            }
                                            
                                            return $edit_cat_title;
                                        }
                        
                                   
    }
?>
