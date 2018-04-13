<?php

require_once('../../../../wp-load.php');
global $wpdb;
 
// Escape user inputs for security
$term = $_REQUEST['term'];

if(isset($term)){
    // Attempt select query execution    
	$execute = $wpdb->get_results("SELECT * FROM lms_course WHERE course_tags LIKE '" . $term . "%' limit 5");
	$row_count = count($execute);
    if($execute){
        if($row_count > 0){
			foreach($execute as $row){
				echo "<p>" . $row->course_tags . "</p>";
			}           
        } else{
            echo "<p>No matches found</p>";
        }
    } else{
        //echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
    }
}
 
// close connection
//mysqli_close($link);
?>