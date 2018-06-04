
<?php
    ob_start();
?>


    <!DOCTYPE html>
    <html lang="en">

    <?php
        $title="Admin panel";
        include_once("includes/header.php");
    ?>

        <body>

            <?php
                include_once("includes/navigation.php");
            ?>
                
                
                <!--START OF CONTAINER-->
                
                
            <br><br>

                <div class="container">
                 
                    <?
                        if(isset($_GET['action'])){
                            $action=$_GET['action'];
                        }
                    
                        switch ($action){
                            case 'add':
                                include_once("");
                            case 'edit':
                                include_once("");
                            case default:
                                include_once("");
                        }
                    
                    ?>
                    
                </div>
                
                <!--END OF CONTAINER-->








                <!-- jQuery -->
                <script src="js/jquery.js"></script>

                <!-- Bootstrap Core JavaScript -->
                <script src="../bootstrap/dist/js/bootstrap.bundle.min.js"></script>

        </body>

    </html>