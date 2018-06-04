 <?php
        if(isset($_GET['edit_subject'])){
            $s_name=$_GET['s_name'];
            $std_id=$_GET['std_id'];
            $u_id=$_GET['u_id'];
            $s_id=$_GET['s_id'];
            $query="UPDATE subjects set s_name='$s_name', std_id=$std_id, u_id=$u_id where s_id=$s_id";
            $edit_subject_query=mysqli_query($connection,$query);
            confirmQuery($edit_subject_query);
            header('Location: subjects.php');
        }
?>


<!--Edit subject form-->
<div class="col-md-6">
 <?php
    if(isset($_GET['action'])&&($_GET['action']=='edit')){
        $get_s_id=$_GET['s_id'];
        $query="SELECT * FROM subjects where s_id='$get_s_id'";
        $subject_query=mysqli_query($connection,$query);
        confirmQuery($subject_query);
        $row=mysqli_fetch_assoc($subject_query);
        $db_s_id=$row['s_id'];
        $db_std_id=$row['std_id'];
        $db_s_name=$row['s_name'];
        $db_u_id=$row['u_id'];

        /*query to find name of teacher(user)*/
        $query="select * from users  where u_id=$db_u_id";
        $db_user_name_query=mysqli_query($connection,$query);
        confirmQuery($db_user_name_query);
        $db_urow=mysqli_fetch_assoc($db_user_name_query);
        $db_u_name=$db_urow['u_name'];
        /*end of query to find name of teacher*/
        
        
    ?>
 
  <h3>Edit Subject</h3>
    <form action="" method="get">
      
       
       <div class="form-group" style="display:none">
             <input class="form-control" type="text" name="s_id" value="<?php echo $db_s_id?>" >
        </div>
       
        <div class="form-group">
            <label for="std_id">Standard</label>
             <select id="std_id" name="std_id" class="form-control">
                <?php
                    $query="Select * from standards";
                    $select_all_standards_query=mysqli_query($connection, $query);
                    confirmQuery($select_all_standards_query);
                    while($row=mysqli_fetch_assoc($select_all_standards_query)){
                    $std_id=$row['std_id'];                                    
                        echo "<option value='$std_id' ";
                        if($db_std_id==$std_id)
                            echo "selected";
                        echo" >$std_id</option>";
                    }
                ?>
            </select>
        </div>
        
        <div class="form-group">
            <label for="s_name">Subject</label>
             <input class="form-control" type="text" name="s_name" value="<?php echo $db_s_name?>">
        </div>
        
        <div class="form-group">
            <label for="u_id">Teacher</label>
             <select id="u_id" name="u_id" class="form-control">
                <?php
                    $query="Select * from users";
                    $select_all_users_query=mysqli_query($connection, $query);
                    confirmQuery($select_all_users_query);
                    while($urow=mysqli_fetch_assoc($select_all_users_query)){
                    $u_id=$urow['u_id'];
                    $u_name=$urow['u_name'];
                        echo "<option value='$u_id' ";
                        if($db_u_name==$u_name)
                            echo"selected ";
                        echo">$u_name</option>";
                    }
                ?>
            </select>
        </div>
        
        
        <div class="form-group">
            <input class="btn btn-primary" type="submit" name="edit_subject" value="Edit Subject">
        </div>
        
    </form>
    
    
    <?php
        }
    ?>
</div>
 <!--end of add subject form-->