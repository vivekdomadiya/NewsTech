<?php include "delete_modal.php" ?>
<?php

if(isset($_POST['checkBoxArray'])) {
    foreach($_POST['checkBoxArray'] as $postValueId) {
        $bulk_options = $_POST['bulk_options'];
        
        switch($bulk_options) {
            case 'Published' :
            case 'Draft' :
                $query = "UPDATE posts SET post_status = '{$bulk_options}' WHERE post_id = {$postValueId} ";
                $update_post_query = mysqli_query($connection , $query);
                break;
            case 'Delete' :
                $query = "DELETE FROM posts WHERE post_id = {$postValueId} ";
                $update_post_query = mysqli_query($connection , $query);
                break;
            case 'Clone' :
                $query = "SELECT * FROM posts WHERE post_id = {$postValueId} ";
                $select_post_query = mysqli_query($connection , $query);
                
                $row = mysqli_fetch_array($select_post_query);
                $post_category_id = $row['post_category_id'];
                $post_title = $row['post_title'];
                $post_date = $row['post_date'];
                $post_status = $row['post_status'];
                $post_image = $row['post_image'];
                $post_tags = $row['post_tags'];
                $post_content = $row['post_content'];
                
                $query = $query = "INSERT INTO posts(post_category_id, post_title, post_date, post_content, post_tags, post_status) ";
        
                $query .= "VALUES({$post_category_id}, '{$post_title}', '{$post_date}', '{$post_content}', '{$post_tags}', '$post_status')";
                
                $create_post_query = mysqli_query($connection,$query);
                confirmQuery($create_post_query);
                
                break;
        }
        
    }
}

?>

<form action="" method="post">

    <div class="form-row">
        <div class="col">
            <div id="bulkOptionContainer" class="form-group">
                <select class="form-control" name="bulk_options" id="">
                    <option disabled hidden selected>Select Options</option>
                    <option value="Published">Published</option>
                    <option value="Draft">Draft</option>
                    <option value="Delete">Delete</option>
                    <option value="Clone">Clone</option>
                </select>
            </div>
        </div>
        <div class="col">
            <div class="form-group">
               <input type="submit" name="submit" class="btn btn-success" value="Apply">
               <a href="posts/add_post" class="btn btn-primary">Add New</a>
            </div>
        </div>
    </div>

    <div class="table-responsive">
        <table class="table table-bordered table-hover">

            <thead>
                <tr>
                    <th><input id="selectAllBoxes" type="checkbox"></th>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Category</th>
                    <th>Status</th>
                    <th>Image</th>
                    <th>Tages</th>
                    <th>Comments</th>
                    <th>Date</th>
                    <th>Views</th>
                    <th>View Post</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
            </thead>
            <tbody>

               <?php

                $query = "SELECT * FROM posts ORDER BY post_id DESC";
                $select_posts = mysqli_query($connection,$query);

                while($row = mysqli_fetch_assoc($select_posts)) {
                    $post_id = $row['post_id'];
                    $post_title = $row['post_title'];
                    $post_category_id = $row['post_category_id'];
                    $post_status = $row['post_status'];
                    $post_image = $row['post_image'];
                    $post_tags = $row['post_tags'];
                    $post_date = $row['post_date'];
                    $post_views_count = $row['post_views_count'];
                    $cat_id = $post_category_id;
                    $cat_title=catTitle($post_category_id);
                    $post_image_src = "data:image/jpeg;base64,".base64_encode($post_image);

                    echo "<tr>";
                    echo "<td><input class='checkBoxes' type='checkbox' name='checkBoxArray[]' value='{$post_id}'></td>";
                    echo "<td>$post_id</td>";
                    
                    if(!empty($post_author) ) {
                        echo "<td>$post_author</td>";
                    } else if(!empty($post_user) ) {
                        echo "<td>$post_user</td>";
                    }

                    echo "<td>$post_title</td>";

                    echo "<td>$cat_title</td>";

                    echo "<td>$post_status</td>";
                    echo "<td><img width='100' src='{$post_image_src}' alt='image'></td>";
                    echo "<td>$post_tags</td>";
                    
                    $query = "SELECT * FROM comments WHERE comment_post_id = $post_id";
                    $send_comment_query = mysqli_query($connection,$query);
                    $post_comment_count = mysqli_num_rows($send_comment_query);
                    
                    echo "<td><a href='/admin/comments/post/{$post_id}'>$post_comment_count</a></td>";
                    
                    
                    echo "<td>$post_date</td>";
                    echo "<td><a onClick=\"javascript: return confirm('Are you sure to reset view count of \'{$post_title}\'?')\" href='posts.php?reset_views={$post_id}'>$post_views_count</a></td>";
                    echo "<td><a class='btn btn-info' href='/post/{$post_id}'>View</a></td>";
                    
                    
                    echo "<td><a class='btn btn-primary' href='/admin/posts/edit_post/{$post_id}'>Edit</a></td>";

                    echo "<td><button type='button' class='btn btn-danger openDeleteModal' data-toggle='modal' data-target='#deleteModal' data-id='{$post_id}'>Delete</button></td>";
                    
                    echo "</tr>";
                }


                ?>
            </tbody>
        </table>
    </div>
</form>




<?php

if(isset($_POST['delete'])) {
    $the_post_id = $_POST['delete_id'];
    
    $query = "DELETE FROM posts WHERE post_id= {$the_post_id} ";
    $delete_post_query = mysqli_query($connection,$query);
    redirect("posts");
}

if(isset($_GET['reset_views'])) {
    $the_post_id = $_GET['reset_views'];
    
    $query = "UPDATE posts SET post_views_count = 0 WHERE post_id= {$the_post_id} ";
    $reset_views_query = mysqli_query($connection,$query);
    redirect("posts");
}

?>