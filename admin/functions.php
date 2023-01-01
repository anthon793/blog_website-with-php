<?php
function fill_category_list($conn){
    $query = "SELECT * FROM categories ORDER BY category_id";
        $run_query = mysqli_query($conn, $query) or die(mysqli_error($conn));
        if (mysqli_num_rows($run_query) > 0) {
        while ($row = mysqli_fetch_array($run_query)) {
            $category_id = $row['category_id'];
            $category_name = $row['category_name'];
            echo "<option value ='$category_id'>$category_name</option>";
            //'<option value="'.$row["category_id"].'">'.$row["category_name"].'</option>';
        }
        }
        else{
        echo "<option>No categories yet</option>";
        }
}
function display_category_total($conn){
   
}
?>