 <?php
        if(isset($_GET['edit_chapter'])){
            $s_id=$_GET['s_id'];
            $std_id=$_GET['std_id'];
            $c_name=$_GET['c_name'];
            $c_id=$_GET['c_id'];
            $query="UPDATE chapters set c_name='$c_name', s_id=$s_id where c_id=$c_id";
            $edit_chapter_query=mysqli_query($connection,$query);
            confirmQuery($edit_chapter_query);
            header('Location: chapters.php');
        }
?>


<!--Edit subject form-->
<div class="col-md-6">
 <?php
    if(isset($_GET['action'])&&($_GET['action']=='edit')){
        $get_c_id=$_GET['c_id'];
        $query="SELECT * FROM chapters where c_id='$get_c_id'";
        $chapter_query=mysqli_query($connection,$query);
        confirmQuery($chapter_query);
        $row=mysqli_fetch_assoc($chapter_query);
        $db_c_id=$row['c_id'];
        $db_c_name=$row['c_name'];
        $db_s_id=$row['s_id'];

        /*query to find name of subject and standard*/
        $query="select * from subjects  where s_id=$db_s_id";
        $subject_standard_name_query=mysqli_query($connection,$query);
        confirmQuery($subject_standard_name_query);
        $ssrow=mysqli_fetch_assoc($subject_standard_name_query);
        $db_s_name=$ssrow['s_name'];
        $db_std_id=$ssrow['std_id'];
        /*end of query to find name of subject and standard*/
        
        
    ?>
 
  <h3>Edit Chapter</h3>
    <form action="" method="get">
      
       
       <div class="form-group" style="display:none">
             <input class="form-control" type="text" name="c_id" value="<?php echo $db_c_id?>" >
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
            <label for="s_id">Subject</label>
             <select id="s_id" name="s_id" class="form-control">
                <?php
                    $query="Select * from subjects";
                    $select_all_subjects_query=mysqli_query($connection, $query);
                    confirmQuery($select_all_subjects_query);
                    while($row=mysqli_fetch_assoc($select_all_subjects_query)){
                    $s_id=$row['s_id'];
                    $s_name=$row['s_name'];
                        echo "<option value='$s_id' ";
                        if($db_s_id==$s_id)
                            echo "selected";
                        echo" >$s_name</option>";
                    }
                ?>
            </select>
        </div>
        
        <div class="form-group">
           <label for="c_name">Chapter</label>
            <input type="text" class="form-control"  name="c_name" value="<?php echo $db_c_name?>">
        </div>
        
        
        <div class="form-group">
            <input class="btn btn-primary" type="submit" name="edit_chapter" value="Edit Chapter">
        </div>
        
    </form>
    
    
    <?php
        }
    ?>
</div>
 <!--end of add subject form-->