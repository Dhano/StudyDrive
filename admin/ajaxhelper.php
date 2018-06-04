<?php
     include_once("../includes/db.php");
    include_once("functions.php");
    
    if(isset($_GET['std_id'])){
        $std_id=$_GET['std_id'];
        setSubjects($std_id);
    }else if(isset($_GET['s_id'])){
        $s_id=$_GET['s_id'];
        setChapters($s_id);
    }

    function setSubjects($std_id){
        global $connection;
         $query="Select * from subjects where std_id=$std_id";
         $select_subjects_query=mysqli_query($connection, $query);
         confirmQuery($select_subjects_query);
         while($row=mysqli_fetch_assoc($select_subjects_query)){
            $s_id=$row['s_id'];
            $s_name=$row['s_name'];
            echo "-$s_id,$s_name?";
         }
    }


    function setChapters($s_id){
        global $connection;
         $query="Select * from chapters where s_id=$s_id";
         $select_chapters_query=mysqli_query($connection, $query);
         confirmQuery($select_chapters_query);
         while($row=mysqli_fetch_assoc($select_chapters_query)){
            $c_id=$row['c_id'];
            $c_name=$row['c_name'];
            echo "-$c_id,$c_name?";
         }
    }
    
?>
