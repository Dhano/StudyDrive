<!DOCTYPE html>
<html lang="en">

    <?php

        $title="Shared With Me";
        include_once("includes/header.php");

        session_start();
        /*Check user Session and then carry on*/
        $session_user_id=check_user();
        $session_user_email=$_SESSION['user_email'];

        //if(isset($_GET['file_id'])){
          //  $get_file_id=$_GET['file_id'];
        //}else
            //$get_file_id=get_user_share_file_id($_SESSION['user_email']);

       // echo "<p id='file_id'>$get_file_id</p>";
        /*check shares table*/
        //check_file_is_shared($get_file_id);
    ?>

    <body>

        <?php
            include_once("includes/navigation.php");
        ?>

        <br>

        <!--START OF CONTAINER-->

        <div class="container-fluid">

            <!--START OF 1ROW-->
            <div class="row">

                <div class="col-md-2"></div>

                <div class="col-md-10">

                    <!--START OF BREADCRUMB-->

                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <?php
                            //echo "<li class='breadcrumb-item'><a href='index.php?file_id=$get_file_id'>Home</a></li>";
                           /* $temp_file_path=get_file_path($get_file_id);
                            for ($i=(sizeof($temp_file_path)-1);$i>=0;$i--){
                                $file_id=$temp_file_path[$i];
                                $file_name=get_file_name($file_id);
                                echo "<li class='breadcrumb-item'><a href='share.php?file_id=$file_id'>$file_name</a></li>";
                            }*/
                            ?>
                        </ol>
                    </nav>

                    <!--END OF BREADCRUMB-->

                </div>

            </div>
            <!--END OF 1ROW-->


            <!--START OF 2ROW-->
            <div class="row">

                <!--START OF SIDEBAR-->
                <?php
                include_once("includes/sidebar.php");
                ?>
                <!--END OF SIDEBAR-->


                <!--START OF CONTENT-->

                <div class="col-lg-10">

                    <!--START OF TABLE ROW-->

                    <div class="row">

                        <div class="col-lg-12">

                            <?php
                            $query="SELECT * FROM shares join usertokens join filetokens join userfiletokens where shares.share_id=usertokens.share_id and shares.share_id=filetokens.share_id and usertokens.user_id=$session_user_id and userfiletokens.user_token_id=usertokens.user_token_id and shares.deleted=0";
                            $share_details_query=mysqli_query($connection,$query);

                            while($row=mysqli_fetch_assoc($share_details_query)) {

                                /*Type of share 1 strict share 0 link share*/
                                $share_type=$row['share_type'];
                                /*Person who shared the file*/
                                $share_user_id=$row['share_user_id'];
                                $created_at=$row['created_at'];
                                $validity=$row['validity'];
                                $user_file_token_file_id=$row['user_file_token_file_id'];

                            ?>
                                <div class="card">
                                    <h5 class="card-header">Share Type <?php echo $share_type?></h5>
                                    <div class="card-body">
                                        <p class="card-text">This was shared by <?php echo $share_user_id?> on <?php echo $created_at?></p>
                                        <a href="index.php?file_id=<?php echo $user_file_token_file_id?>" class="btn btn-primary">Open</a>
                                    </div>
                                </div>
                            <?php
                            }
                            ?>

                        </div>

                    </div>
                    <!--END OF TABLE ROW-->


                </div>
                <!--END OF CONTENT-->

            </div>
            <!--END OF 2ROW-->

</div>
<!--END OF CONTAINER-->
<div id="hash"></div>


<!-- jQuery -->
<script src="js/jquery.js"></script>

<!-- Bootstrap Core JavaScript -->
<script src="bootstrap/dist/js/bootstrap.bundle.min.js"></script>

<!--SHA-3 script-->
<!-- <script src="js/sha3.js"></script>-->

<script src="js/sha512.js"></script>

<!--JZIP scrip-->
<script src="js/jszip.js"></script>

<script src="js/blob.js"></script>

<!--File saver -->
<script src="js/FileSaver.js"></script>

<!-- <script src="zip.js/zip.js"></script>-->

<!--Script -->
<!--<script src="js/script.js"></script>-->

<script src="js/scriptdemo.js"></script>
</body>

</html>
