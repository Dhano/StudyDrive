<?php
    if(isset($_GET['q_id'])){
        $get_q_id=$_GET['q_id'];
        $get_query="SELECT * FROM questions where q_id=$get_q_id";
        $get_question_query=mysqli_query($connection,$get_query);
        confirmQuery($get_question_query);
        $get_row=mysqli_fetch_assoc($get_question_query);
        $get_q_id=$get_row['q_id'];
        $get_s_id=$get_row['s_id'];
        $get_c_id=$get_row['c_id'];
        $get_std_id=$get_row['std_id'];
        $get_q_marks=$get_row['q_marks'];
        $get_q_data=$get_row['q_data'];
        $get_q_type=$get_row['q_type'];
    
    }
?>

<form action="questions.php?<?php echo $get_q_id;?>" method="get">
       
       <input readonly type="text" id="q_id" name="q_id" value="<?php echo $get_q_id;?>" class="form-control">
       
        <div class="form-group">
            <label for="std_id">Standard</label>
            <select id="std_id" name="std_id" class="form-control">
            <?php
                $query="Select * from standards";
                $select_all_standards_query=mysqli_query($connection, $query);
                confirmQuery($select_all_standards_query);
                while($row=mysqli_fetch_assoc($select_all_standards_query)){
                $std_id=$row['std_id'];
                        echo "<option value='$std_id'";
                        if($std_id==$get_std_id)
                            echo" selected";
                        echo ">$std_id</option>";
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
                $std_id=$row['std_id'];
                    echo "<option value='$s_id'";
                    if($s_id==$get_s_id)
                        echo"selected";
                    echo" >$s_name-$std_id</option>"; 
                }
            ?>
            </select>
        </div>
        
        <div class="form-group">
            <label for="c_id">Chapter</label>
            <select id="c_id" name="c_id" class="form-control">
            <?php
                $query="Select * from chapters";
                $select_all_chapters_query=mysqli_query($connection, $query);
                confirmQuery($select_all_chapters_query);
                while($row=mysqli_fetch_assoc($select_all_chapters_query)){
                $c_id=$row['c_id'];
                $c_name=$row['c_name'];
                    echo "<option value='$c_id'";
                    if($c_id==$get_c_id)
                        echo"selected";
                    echo" >$c_name</option>"; 
                }
            ?>
            </select>
        </div>
        
        <div class="form-group">
            <label for="q_marks">Marks</label>
            <select id="q_marks" name="q_marks" class="form-control">
               
               <?php
                    $marks=array('1','2','3','4','6','8');
                    foreach($marks as $m){
                        echo "<option ";
                        if($get_q_marks==$m)
                            echo"selected";
                    echo" >$m</option>";   
                    }
                      
                ?>
                <option value=""></option>
            </select>
        </div>

        <div class="form-group">
            <label for="q_type">Type</label>
            <select id="q_type" name="q_type" class="form-control">
                <option value='easy' <?php if($get_q_type=='easy')echo "selected";?>>Easy</option>
                <option value='medium' <?php if($get_q_type=='medium')echo "selected";?>>Medium</option>
                <option value='hard' <?php if($get_q_type=='hard')echo "selected";?>>Hard</option>    
            </select>
        </div>

        <div class="form-group">
            <label for="q_data">Question</label>
            <textarea cols="30" row="10" type="text" class="form-control" name="q_data" id="q_data"><?php echo $get_q_data;?></textarea>
        </div>

        <input type="submit" name="edit_question" value="Edit" class="btn btn-dark">
    </form>
