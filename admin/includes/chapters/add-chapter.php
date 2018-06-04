 <?php
        if(isset($_GET['add_chapter'])){
            $c_name=$_GET['c_name'];
            $s_id=$_GET['s_id'];
            $query="INSERT INTO chapters(c_name,s_id) VALUES ('$c_name',$s_id)";
            $add_chapter_query=mysqli_query($connection,$query);
            confirmQuery($add_chapter_query);
            header('Location: chapters.php');
        }
?>


<!--Add subject form-->
<div class="col-md-6">
  <h3>Add Chapter</h3>
    <form action="" method="get">
        <div class="form-group">
            <label for="std_id">Standard</label>
             <select id="std_id" name="std_id" class="form-control">
               <option value="" disabled selected>Select your option</option>
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
            <label for="s_id">Subjects</label>
             <select id="s_id" name="s_id" class="form-control">
            </select>
        </div>
    
        
        <div class="form-group">
            <label for="c_name">Chapter</label>
            <input type="text" class="form-control" name="c_name">
        </div>
        
        
        <div class="form-group">
            <input class="btn btn-primary" type="submit" name="add_chapter" value="Add Chapter">
        </div>
    </form>
</div>
 <!--end of add subject form-->