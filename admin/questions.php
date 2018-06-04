
<?php
    ob_start();
?>


    <!DOCTYPE html>
    <html lang="en">

    <?php
        $title="Admin panel";
        include_once("includes/header.php");
    ?>
    
    <!--ACTION PHP-->    
    <?php
    if(isset($_GET['add_question'])){
        $std_id=$_GET['std_id'];
        $s_id=$_GET['s_id'];
        $c_id=$_GET['c_id'];
        $q_marks=$_GET['q_marks'];
        $q_type=$_GET['q_type'];
        $q_data=$_GET['q_data'];
        
        
        
        $query="INSERT INTO questions(s_id,q_type,q_data,std_id,c_id,q_marks) VALUES ($s_id,'$q_type','$q_data',$std_id,$c_id,$q_marks)";
        $insert_question_query=mysqli_query($connection,$query);
        confirmQuery($insert_question_query);
        header("Location: questions.php");
    
    }else if(isset($_GET['edit_question'])){
        $q_id=$_GET['q_id'];
        $std_id=$_GET['std_id'];
        $s_id=$_GET['s_id'];
        $c_id=$_GET['c_id'];
        $q_marks=$_GET['q_marks'];
        $q_type=$_GET['q_type'];
        $q_data=$_GET['q_data'];
        
        $query="UPDATE questions SET s_id=$s_id, q_type='$q_type', q_data='$q_data', std_id=$std_id, c_id=$c_id, q_marks=$q_marks WHERE q_id=$q_id";
        $update_question_query=mysqli_query($connection,$query);
        confirmQuery($update_question_query);
        header("Location: questions.php");
    }else if(isset($_GET['action'])&&$_GET['action']=='delete'){
        $q_id=$_GET['q_id'];
         $query="DELETE FROM questions where q_id=$q_id";
        $delete_question_query=mysqli_query($connection,$query);
        confirmQuery($delete_question_query);
        header("Location: questions.php");
    }
    ?>        
    <!--END OF ACTION PHP-->


        <body>

            <?php
                include_once("includes/navigation.php");
            ?>
                
                
                <!--START OF CONTAINER-->
                
                
            <br><br>

                <div class="container">
                 
                    <?
                        $action="";
                        if(isset($_GET['action'])){
                            $action=$_GET['action'];
                        }
                    
                        switch ($action){
                            case 'add':
                                include_once("includes/questions/add-questions.php");
                                break;
                            case 'edit':
                                include_once("includes/questions/edit-questions.php");
                                break;
                            default:
                                include_once("includes/questions/view-all-questions.php");
                        }
                    
                    ?>
                    
                </div>
                
                <!--END OF CONTAINER-->








                <!-- jQuery -->
                <script src="js/jquery.js"></script>
                
                <!-- script -->
                <script src="js/script.js"></script>

                <!-- Bootstrap Core JavaScript -->
                <script src="../bootstrap/dist/js/bootstrap.bundle.min.js"></script>
                

        </body>

    </html>