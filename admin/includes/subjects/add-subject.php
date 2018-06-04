 <?php
        if(isset($_GET['add_subject'])){
            $s_name=$_GET['s_name'];
            $std_id=$_GET['std_id'];
            $u_id=$_GET['u_id'];
            $query="INSERT INTO subjects(s_name,std_id,u_id) VALUES ('$s_name',$std_id,$u_id)";
            $add_subject_query=mysqli_query($connection,$query);
            confirmQuery($add_subject_query);
            header('Location: subjects.php');
        }
?>


<!--Add subject form-->
<div class="col-md-6">
  <h3>Add Subject</h3>
    <form action="" method="get">
        <div class="form-group">
            <label for="std_id">Standard</label>
             <select id="std_id" name="std_id" class="form-control">
                <?php
                    $query="Select * from standards";
                    $select_all_standards_query=mysqli_query($connection, $query);
                    confirmQuery($select_all_standards_query);
                    while($row=mysqli_fetch_assoc($select_all_standards_query)){
                    $std_id=$row['std_id'];                                    
                        echo "<option value='$std_id'>$std_id</option>";
                    }
                ?>
            </select>
        </div>
        
        <div class="form-group">
            <label for="s_name">Subject</label>
             <input class="form-control" type="text" name="s_name">
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
                        echo "<option value='$u_id'>$u_name</option>";
                    }
                ?>
            </select>
        </div>
        
        
        <div class="form-group">
            <input class="btn btn-primary" type="submit" name="add_subject" value="Add Subject">
        </div>
    </form>
</div>
 <!--end of add subject form-->