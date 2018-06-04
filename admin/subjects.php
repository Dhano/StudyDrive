<?php
    ob_start();
?>


    <!DOCTYPE html>
    <html lang="en">

    <?php 
        $title="Subjects";
    include_once("includes/header.php");
?>

    <body>

       <!--Code to delete a subject-->
        <?php
            if(isset($_GET['action'])){
                if($_GET['action']=='delete'){
                    $s_id=$_GET['s_id'];
                    $query="DELETE FROM subjects where s_id=$s_id";
                    $delete_subject_query=mysqli_query($connection,$query);
                    confirmQuery($delete_subject_query);
                    header("Location: subjects.php");   
                }
            }
        ?>
        <!--end of Code to delete a subject-->

            <!--NAVIGATION-->
            <?php include_once("includes/navigation.php");?>


            <div class="container">

                <!-- Page Heading -->
                <div class="row">

                        <?php include_once("includes/subjects/add-subject.php");?>

                        <?php include_once("includes/subjects/edit-subject.php");?>

                        <?php include_once("includes/subjects/view-all-subjects.php");?>

                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

            <!-- jQuery -->
            <script src="js/jquery.js"></script>

             <!-- Bootstrap Core JavaScript -->
                <script src="../bootstrap/dist/js/bootstrap.bundle.min.js"></script>

    </body>

    </html>
