<!DOCTYPE html>
<html lang="en">
    
    <?php
    
        $title="Study Share";
        include_once("includes/header.php");
    
        session_start();
        /*Check user Session and then carry on*/
        $session_user_id=check_user();
        $session_user_email=$_SESSION['user_email'];

        if(isset($_GET['file_id'])){
            $get_file_id=$_GET['file_id'];
        }else
            $get_file_id=get_user_file_id($_SESSION['user_email']);

        echo "<p id='file_id'>$get_file_id</p>";
        check_file_owner($get_file_id);



        if(isset($_GET['task'])) {

            $task =$_GET['task'];

            if ($task == 'delete') {
                delete_file($get_file_id);
                $func_file_id=get_parent_file_id($get_file_id);
                header("Location:index.php?file_id=$func_file_id");
            }

        }else if(isset($_POST['new_folder_name'])){
            $new_folder_name=$_POST['new_folder_name'];
            $query="INSERT INTO files(file_name,parent_file_id,isdirectory,created_at,created_by,updated_at,updated_by) VALUES ('$new_folder_name',$get_file_id,'1',CURRENT_TIMESTAMP(),$session_user_id,CURRENT_TIMESTAMP(),$session_user_id)";
            $new_folder_query=mysqli_query($connection,$query);
            confirmQuery($new_folder_query);
            
            header("Location: index.php?file_id=$get_file_id");
            
        }else if(isset($_FILES['fileUpload']['name'])&&$_FILES['fileUpload']['name']!=""){
            
            /*Code when you choose a file*/
            $file_name=$_FILES['fileUpload']['name'];
            $date = new DateTime();
            $time_stamp= $date->getTimestamp();
            
            move_uploaded_file($_FILES['fileUpload']['tmp_name'],"allfiles/$time_stamp$session_user_id$file_name");
            
            $fileSize = $_FILES['fileUpload']['size'];
            $fileHash=$_GET['fileHash'];
            
            
            
            $query="INSERT INTO filecontents(blob_path,blob_size,blob_hash,created_at,created_by,updated_at,updated_by) VALUES ('$time_stamp$session_user_id$file_name','$fileSize','$fileHash',CURRENT_TIMESTAMP(),$session_user_id,CURRENT_TIMESTAMP(),$session_user_id)";
            $new_blob_query=mysqli_query($connection,$query);
            confirmQuery($new_blob_query);
            
            $blob_id=mysqli_insert_id($connection);
            
            $query="INSERT INTO files(file_name,parent_file_id,blob_id,isdirectory,created_at,created_by,updated_at,updated_by) VALUES ('$file_name',$get_file_id,$blob_id,'false',CURRENT_TIMESTAMP(),$session_user_id,CURRENT_TIMESTAMP(),$session_user_id)";
            $new_file_query=mysqli_query($connection,$query);
            confirmQuery($new_file_query);
            
            header("Location: index.php?file_id=$get_file_id");   
        }
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
                   
                    <div class="col-md-2">

                        <!--START OF ACTION DROPDOWN-->
                        <div class="dropdown" style="margin-left:50px">

                            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">NEW</button>
                            
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">

                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#newFolderModal" data-type="newFolder">Folder</button>

                                <form action="" method="post" id="actionForm" class="form-group" enctype="multipart/form-data">
                                    <input type="file" name="fileUpload"  id="fileUpload" class="form-control file-selection">
                                    <input type="file" name="folderUpload[]" id="folderUpload" multiple="" directory="" webkitdirectory="" mozdirectory="" class="form-control">        
                                </form>
                                
                            </div>
                        
                        </div>
                        <!--END OF ACTION DROPDOWN-->

                         <br>
                        <!--START OF MODAL OF NEW FILE-->
                        <div class="modal fade" id="newFolderModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">New folder</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="index.php?file_id=<?php echo $get_file_id?>" id="new-folder-form" method="post">
                                                <div class="form-group">
                                                    <label for="txtFolderName" class="col-form-label">Folder name</label>
                                                    <input type="text" class="form-control" id="txtFolderName" name="new_folder_name">
                                                </div>
                                            </form>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            <button type="button" class="btn btn-primary" id="btnCreateFolder">Create</button>
                                        </div>
                                    </div>
                                </div>
                        </div>
                        
                        <!--START OF MODAL OF NEW FILE-->
                        
                    </div>

                    <div class="col-md-10">
                        
                        <!--START OF BREADCRUMB-->

                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <?php
                                    //echo "<li class='breadcrumb-item'><a href='index.php?file_id=$get_file_id'>Home</a></li>";
                                    $temp_file_path=get_file_path($get_file_id);
                                    for ($i=(sizeof($temp_file_path)-1);$i>=0;$i--){
                                        $file_id=$temp_file_path[$i];
                                        $file_name=get_file_name($file_id);
                                        echo "<li class='breadcrumb-item'><a href='index.php?file_id=$file_id'>$file_name</a></li>";
                                    }  
                                ?>
                            </ol>
                        </nav>
                            
                        <!--START OF BREADCRUMB-->

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

                        <!--START OF PANELS-->
                        <?php
                            if(get_user_file_id($session_user_email)==$get_file_id)
                                include_once("includes/panels.php");
                        ?>
                        <!--END OF PANELS-->

                        <!--START OF TABLE ROW-->

                        <div class="row">
                            <div class="col-lg-12">
                                <table class="table table-responsive-md">
                                    <thead>
                                        <tr>
                                            <th scope="col">Name</th>
                                            <th scope="col"></th>
                                            <th scope="col">Owner</th>
                                            <th scope="col">Last modified</th>
                                            <th scope="col">File size</th>
                                            <th scope="col"></th>
                                            <th scope="col"></th>
                                            <th scope="col"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        /* and created_by=$session_user_id*/
                                            $query="SELECT * FROM files WHERE parent_file_id=$get_file_id and deleted=0";
                                            $all_files_query=mysqli_query($connection,$query);
                                            confirmQuery($all_files_query);

                                            while($row=mysqli_fetch_assoc($all_files_query)){

                                                $file_id=$row['file_id'];
                                                $file_name=$row['file_name'];
                                                $blob_id=$row['blob_id'];
                                                $parent_file_id=$row['parent_file_id'];
                                                $isdirectory=$row['isdirectory'];
                                                $created_at=$row['created_at'];
                                                $created_by=$row['created_by'];

                                                if($isdirectory==0){
                                                /*query to find size of file*/
                                                $query="select * from filecontents where blob_id=$blob_id";
                                                $file_size_query=mysqli_query($connection,$query);
                                                confirmQuery($file_size_query);
                                                $brow=mysqli_fetch_assoc($file_size_query);
                                                $blob_size=$brow['blob_size'];
                                                /*end of query to find size of file*/
                                                }

                                                /*query to find name of user*/
                                                $query="select * from users  where user_id=$created_by";
                                                $user_name_query=mysqli_query($connection,$query);
                                                confirmQuery($user_name_query);
                                                $urow=mysqli_fetch_assoc($user_name_query);
                                                $user_firstname=$urow['user_firstname'];
                                                /*end of query to find name user*/

                                        ?>

                                            <tr>
                                                <th scope="row">D</th>
                                                <td>
                                                    <a href="index.php?file_id=<?echo $file_id?>">
                                                        <?php echo $file_name ?>
                                                    </a>
                                                </td>
                                                <td>
                                                    <?php echo $user_firstname?>
                                                </td>
                                                <td>
                                                    <?php echo $created_at?>
                                                </td>
                                                <td>
                                                    <?php 
                                                        if($isdirectory==0)
                                                            echo $blob_size
                                                    ?>
                                                </td>
                                                
                                                <td>
                                                    <a href="download.php?file_id=<?echo $file_id?>"><i class="fa fa-download"></i></a>
                                                </td>

                                                <td>
                                                    <a href="index.php?file_id=<?echo $file_id?>&task=delete">delete<i class="fa fa-delete"></i></a>
                                                </td>

                                                <td>
                                                    <button type="button" class="btn btn-primary btnInitShare" data-toggle="modal" data-target="#shareModal" id="<?php echo $file_id?>">Share</button>

                                                    <div class="modal fade" id="shareModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="exampleModalLabel">Enter User Id</h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <form action="index.php?file_id=<?php echo $get_file_id?>" id="new-folder-form" method="post">
                                                                        <div class="form-group">
                                                                            <label for="txtFolderName" class="col-form-label">User_Id</label>
                                                                            <input type="text" class="form-control" id="shareUserId">
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                    <button type="button" class="btn btn-primary" data-dismiss="modal"  id="btnShare">Share</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </td>
                                            </tr>

                                        <?
                                            }
                                        ?>
                                    </tbody>
                                </table>
                                
                                
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
