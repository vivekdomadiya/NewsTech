<?php include "delete_modal.php"; ?>
<?php

if(isset($_POST['checkBoxArray'])) {
    foreach($_POST['checkBoxArray'] as $commentValueId) {        
        $query = "DELETE FROM comments WHERE comment_id = {$commentValueId} ";
        $update_comment_query = mysqli_query($connection , $query);
    }
}

?>

<form action="" method="post">
    <div class="form-row">
        <div class="col">
            <div class="form-group">
               <input type="submit" name="submit" class="btn btn-danger" value="Delete All Selected Comments">
            </div>
        </div>
    </div>

    <div class="table-responsive">
        <table class="table table-bordered table-hover">
           
            <thead>
                <tr>
                    <th><input id="selectAllBoxes" type="checkbox"></th>
                    <th>ID</th>
                    <th>Author</th>
                    <th>Comment</th>
                    <th>Email</th>
                    <th>In Response to</th>
                    <th>Date</th>
                    <th>Delete</th>
                </tr>
            </thead>
            <tbody>

               <?php

                $query = "SELECT * FROM comments ORDER BY comment_id DESC";
                $select_comments = mysqli_query($connection,$query);
                while($row = mysqli_fetch_assoc($select_comments)) {
                    $comment_id = $row['comment_id'];
                    $comment_post_id = $row['comment_post_id'];
                    $comment_author = $row['comment_author'];
                    $comment_email = $row['comment_email'];
                    $comment_content = $row['comment_content'];
                    $comment_date = $row['comment_date'];
                    
                    echo "<tr>";
                    echo "<td><input class='checkBoxes' type='checkbox' name='checkBoxArray[]' value='{$comment_id}'></td>";
                    echo "<td>$comment_id</td>";
                    echo "<td>$comment_author</td>";
                    echo "<td>$comment_content</td>";
                    echo "<td>$comment_email</td>";
                    
                    $query = "SELECT post_title FROM posts WHERE post_id = {$comment_post_id}";
                    $row = mysqli_fetch_assoc(mysqli_query($connection,$query));
                    $post_title = "none";
                    if(!empty($row))
                        $post_title = $row['post_title'];
                    echo "<td><a href='../post/$comment_post_id'>$post_title</a></td>";
                            
                    echo "<td>$comment_date</td>";
                    echo "<td><button type='button' class='btn btn-danger openDeleteModal' data-toggle='modal' data-target='#deleteModal' data-id='{$comment_id}'>Delete</button></td>";
                    echo "</tr>";
                }


                ?>
            </tbody>
        </table>
    </div>
</form>


<?php

if(isset($_POST['delete'])) {
    $the_comment_id = $_POST['delete_id'];
    
    $query = "DELETE FROM comments WHERE comment_id= {$the_comment_id} ";
    $delete_comment_query = mysqli_query($connection,$query);
    header("Location: comments.php");
}

if(isset($_GET['approve'])) {
    $the_comment_id = $_GET['approve'];
    
    $query = "UPDATE comments SET comment_status = 'approved' WHERE comment_id= {$the_comment_id} ";
    $approve_comment_query = mysqli_query($connection,$query);
    header("Location: comments.php");
}

if(isset($_GET['unapprove'])) {
    $the_comment_id = $_GET['unapprove'];
    
    $query = "UPDATE comments SET comment_status = 'unapproved' WHERE comment_id= {$the_comment_id} ";
    $unapprove_comment_query = mysqli_query($connection,$query);
    header("Location: comments.php");
}

?>