  <table class="table">
  <thead class="thead-dark">
    <tr>
      <th scope="col">#</th>
      <th scope="col">Standard</th>
      <th scope="col">Subject</th>
      <th>Chapter</th>
      <th scope="col">*</th>
      <th scope="col">*</th>
    </tr>
  </thead>
  <tbody>
  
   <?php
        $query="SELECT * FROM chapters";
        $all_chapters_query=mysqli_query($connection,$query);
        confirmQuery($all_chapters_query);
        while($row=mysqli_fetch_assoc($all_chapters_query)){
            $c_id=$row['c_id'];
            $c_name=$row['c_name'];
            $s_id=$row['s_id'];
            
            /*query to find name of subject and standard*/
            $query="select * from subjects  where s_id=$s_id";
            $subject_standard_name_query=mysqli_query($connection,$query);
            confirmQuery($subject_standard_name_query);
            $ssrow=mysqli_fetch_assoc($subject_standard_name_query);
            $s_name=$ssrow['s_name'];
            $std_id=$ssrow['std_id'];
            /*end of query to find name of subject and standard*/
        
    ?>
    
    <tr>
      <th scope="row"><?php echo $c_id; ?></th>
      <td><?php echo $std_id ?></td>
      <td><?php echo $s_name ?></td>
      <td><?php echo $c_name?></td>
      <td><a href="chapters.php?action=edit&c_id=<?php echo $c_id;?>" class="btn btn-light">Edit</a></td>
      <td><a href="chapters.php?action=delete&c_id=<?php echo $c_id;?>" class="btn btn-secondary">Delete</a></td>
    </tr>
    
    <?php
        }/*end of while*/
    ?>
    
    </tbody>
</table>
