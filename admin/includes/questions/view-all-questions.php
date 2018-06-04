 <table class="table">
  <thead class="thead-dark">
    <tr>
      <th scope="col">#</th>
      <th scope="col">Standard</th>
      <th scope="col">Subject</th>
      <th>Chapter</th>
      <th>Marks</th>
      <th scope="col">Type</th>
      <th scope="col">Question</th>
      <th scope="col">*</th>
      <th scope="col">*</th>
    </tr>
  </thead>
  <tbody>
  
   <?php
        $query="SELECT * FROM questions";
        $all_questions_query=mysqli_query($connection,$query);
        confirmQuery($all_questions_query);
        while($row=mysqli_fetch_assoc($all_questions_query)){
            $q_id=$row['q_id'];
            $std_id=$row['std_id'];
            $s_id=$row['s_id'];
            $c_id=$row['c_id'];
            $q_marks=$row['q_marks'];
            $q_data=$row['q_data'];
            $q_type=$row['q_type'];
            
            /*query to find name of subject*/
            $query="select * from subjects  where s_id=$s_id";
            $subject_name_query=mysqli_query($connection,$query);
            confirmQuery($subject_name_query);
            $srow=mysqli_fetch_assoc($subject_name_query);
            $s_name=$srow['s_name'];
            /*end of query to find name of subject*/
            
            /*query to find name of chapter*/
            $query="select * from chapters  where c_id=$c_id";
            $chapter_name_query=mysqli_query($connection,$query);
            confirmQuery($chapter_name_query);
            $crow=mysqli_fetch_assoc($chapter_name_query);
            $c_name=$crow['c_name'];
            /*end of query to find name of chapter*/
        
    ?>
    
    <tr>
      <th scope="row"><?php echo $q_id; ?></th>
      <td><?php echo $std_id ?></td>
      <td><?php echo $s_name ?></td>
      <td><?php echo $c_name?></td>
      <td><?php echo $q_marks?></td>
      <td><?php echo $q_type ?></td>
      <td><?php echo $q_data ?></td>
      <td><a href="questions.php?action=edit&q_id=<?php echo $q_id;?>" class="btn btn-light">Edit</a></td>
      <td><a href="questions.php?action=delete&q_id=<?php echo $q_id;?>" class="btn btn-secondary">Delete</a></td>
    </tr>
    
    <?php
        }/*end of while*/
    ?>
    
    </tbody>
</table>
