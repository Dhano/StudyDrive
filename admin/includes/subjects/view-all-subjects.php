  <table class="table">
  <thead class="thead-dark">
    <tr>
      <th scope="col">#</th>
      <th scope="col">Standard</th>
      <th scope="col">Subject</th>
      <th>Teacher</th>
      <th scope="col">*</th>
      <th scope="col">*</th>
    </tr>
  </thead>
  <tbody>
  
   <?php
        $query="SELECT * FROM subjects";
        $all_subjects_query=mysqli_query($connection,$query);
        confirmQuery($all_subjects_query);
        while($row=mysqli_fetch_assoc($all_subjects_query)){
            $s_id=$row['s_id'];
            $std_id=$row['std_id'];
            $s_name=$row['s_name'];
            $u_id=$row['u_id'];
            
            /*query to find name of teacher(user)*/
            $query="select * from users  where u_id=$u_id";
            $user_name_query=mysqli_query($connection,$query);
            confirmQuery($user_name_query);
            $urow=mysqli_fetch_assoc($user_name_query);
            $u_name=$urow['u_name'];
            /*end of query to find name of chapter*/
        
    ?>
    
    <tr>
      <th scope="row"><?php echo $s_id; ?></th>
      <td><?php echo $std_id ?></td>
      <td><?php echo $s_name ?></td>
      <td><?php echo $u_name?></td>
      <td><a href="subjects.php?action=edit&s_id=<?php echo $s_id;?>" class="btn btn-light">Edit</a></td>
      <td><a href="subjects.php?action=delete&s_id=<?php echo $s_id;?>" class="btn btn-secondary">Delete</a></td>
    </tr>
    
    <?php
        }/*end of while*/
    ?>
    
    </tbody>
</table>
