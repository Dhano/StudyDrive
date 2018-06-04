<?php
    ob_start();
?>


    <!DOCTYPE html>
    <html lang="en">

    <?php 
        $title="Chapters";
    include_once("includes/header.php");
?>

    <body>

       <!--Code to delete a subject-->
        <?php
            if(isset($_GET['action'])){
                if($_GET['action']=='delete'){
                    $c_id=$_GET['c_id'];
                    $query="DELETE FROM chapters where c_id=$c_id";
                    $delete_chapter_query=mysqli_query($connection,$query);
                    confirmQuery($delete_chapter_query);
                    header("Location: chapters.php");   
                }
            }
        ?>
        <!--end of Code to delete a subject-->

            <!--NAVIGATION-->
            <?php include_once("includes/navigation.php");?>


            <div class="container">

                <!-- Page Heading -->
                <div class="row">

                        <?php include_once("includes/chapters/add-chapter.php");?>

                        <?php include_once("includes/chapters/edit-chapter.php");?>

                        <?php include_once("includes/chapters/view-all-chapters.php");?>

                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

            <!-- jQuery -->
            <script src="js/jquery.js"></script>
             
              <!-- script -->
                <script src="js/script.js"></script>

             <!-- Bootstrap Core JavaScript -->
                <script src="../bootstrap/dist/js/bootstrap.bundle.min.js"></script>

    </body>

    </html>
