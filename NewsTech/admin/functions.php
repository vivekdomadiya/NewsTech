<?php 

function insert_categories() {
    global $connection;
    if(isset($_POST['submit'])) {
        $cat_title = $_POST['cat_title'];

        if($cat_title == "" || empty($cat_title)) {
            echo "This field should not be empty";
        } else {
            $query = "INSERT INTO categories (cat_title) VALUES ('{$cat_title}');";
            $add_query = mysqli_query($connection,$query);

            if(!$add_query) {
                die("QFAILD ". mysqli_error($connection));
            }
        }
    }
}
function findAllCatefories() {
    global $connection;
    $query = "SELECT * FROM categories";
    $categories_sidebar = mysqli_query($connection,$query);
    while($row = mysqli_fetch_assoc($categories_sidebar)) {
        $cat_id = $row['cat_id'];
        $cat_title = $row['cat_title'];

        echo "<tr>";
        echo "<td>{$cat_id}</td>";
        echo "<td>{$cat_title}</td>";
        echo "<td><a class='btn btn-primary' href='categories.php?edit={$cat_id}'>Edit</a></td>";
        echo "<td><button type='button' class='btn btn-danger openDeleteModal' data-toggle='modal' data-target='#deleteModal' data-id='{$cat_id}'>Delete</button></td>";
        echo "<tr>";

    }
}
function deleteCategories() {
    global $connection;
    if(isset($_POST['delete'])) {
        $the_cat_id = $_POST['delete_id'];
        $query = "DELETE FROM categories WHERE cat_id = {$the_cat_id} ";
        $delete_query = mysqli_query($connection,$query);
        header("Location:   categories.php");
    }
}
function recordCount($table) {
    global $connection;
    $query = "SELECT * FROM " . $table;
    $select_all_table = mysqli_query($connection, $query);
    $count = mysqli_num_rows($select_all_table);
    return $count;
}

?>