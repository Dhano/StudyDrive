
<form action="questions.php" method="get">

       
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
            <label for="s_id">Subject</label>
            <select id="s_id" name="s_id" class="form-control">
            </select>
        </div>
        
        <div class="form-group">
            <label for="c_id">Chapter</label>
            <select id="c_id" name="c_id" class="form-control">
            </select>
        </div>
        
        <div class="form-group">
            <label for="q_marks">Marks</label>
            <select id="q_marks" name="q_marks" class="form-control">
                <option value='1'>1</option>
                <option value='2'>2</option>
                <option value='3'>4</option>
                <option value='6'>6</option>
                <option value='8'>8</option>    
            </select>
        </div>
        
        
        <div class="form-group">
            <label for="q_type">Type</label>
            <select id="q_type" name="q_type" class="form-control">
                <option value='easy'>Easy</option>
                <option value='medium'>Medium</option>
                <option value='hard'>Hard</option>    
            </select>
        </div>

        <div class="form-group">
            <label for="q_data">Question</label>
            <textarea cols="30" row="10" type="text" class="form-control" name="q_data" id="q_data"></textarea>
        </div>

        <input type="submit" name="add_question" value="Add" class="btn btn-dark">
    </form>
