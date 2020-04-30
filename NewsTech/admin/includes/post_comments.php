<?php

if(isset($_POST['checkBoxArray'])) {
    foreach($_POST['checkBoxArray'] as $commentValueId) {
        $bulk_options = $_POST['bulk_options'];
        
        switch($bulk_options) {
            case 'approve' :
            case 'unapprove' :
                $query = "UPDATE comments SET comment_status = '{$bulk_options}' WHERE comment_id = {$commentValueId} ";
                $update_comment_query = mysqli_query($connection , $query);
                break;
            case 'Delete' :

                $query = "DELETE FROM comments WHERE comment_id = {$commentValueId} ";
                $update_comment_query = mysqli_query($connection , $query);
                break;
        }
    }
}

?>

<form action="" method="post">

<table class="table table-bordered table-hover">
      
    <div id="bulkOptionContainer" class="col-xs-4">
       <select class="form-control" name="bulk_options" id="">
           <option value="">Select Options</option>
           <option value="approve">Approve</option>
           <option value="unapprove">Unapprove</option>
           <option value="Delete">Delete</option>
       </select>
    </div>

    <div class="col-xs-4">
       <input type="submit" name="submit" class="btn btn-success" value="Apply">
    </div>
   
    <thead>
        <tr>
           <th><input id="selectAllBoxes" type="checkbox"></th>
            <th>ID</th>
            <th>Author</th>
            <th>Comment</th>
            <th>Email</th>
            <th>Status</th>
            <th>In Response to</th>
            <th>Date</th>
            <th>Approve</th>
            <th>Unapprove</th>
            <th>Delete</th>
        </tr>
    </thead>
    <tbody>

       <?php
        
        if(isset($_GET['p_id'])) {
            $post_id= $_GET['p_id'];

            $query = "SELECT * FROM comments WHERE comment_post_id={$post_id} ORDER BY comment_id DESC";
            $select_comments = mysqli_query($connection,$query);
            while($row = mysqli_fetch_assoc($select_comments)) {
                $comment_id = $row['comment_id'];
                $comment_post_id = $row['comment_post_id'];
                $comment_author = $row['comment_author'];
                $comment_email = $row['comment_email'];
                $comment_content = $row['comment_content'];
                $comment_status = $row['comment_status'];
                $comment_date = $row['comment_date'];

                echo "<tr>";
                echo "<td><input class='checkBoxes' type='checkbox' name='checkBoxArray[]' value='{$comment_id}'></td>";
                echo "<td>$comment_id</td>";
                echo "<td>$comment_author</td>";
                echo "<td>$comment_content</td>";
                echo "<td>$comment_email</td>";
                echo "<td>$comment_status</td>";

                $query = "SELECT * FROM posts WHERE post_id = {$comment_post_id}";
                    $select_post = mysqli_query($connection,$query);
                    while($row = mysqli_fetch_assoc($select_post)) {
                        $post_title = $row['post_title'];

                        echo "<td><a href='../post.php?p_id=$comment_post_id'>$post_title</a></td>";
                    } 

                echo "<td>$comment_date</td>";
                echo "<td><a href='comments.php?source=post&p_id={$post_id}&approve={$comment_id}'>Approve</a></td>";
                echo "<td><a href='comments.php?source=post&p_id={$post_id}&unapprove={$comment_id}'>Unapprove</a></td>";
                echo "<td><a href='comments.php?source=post&p_id={$post_id}&delete={$comment_id}'>Delete</a></td>";
                echo "</tr>";
            }
            
        }


        ?>
    </tbody>
</table>


<?php

if(isset($_GET['delete'])) {
    $the_comment_id = $_GET['delete_id'];
    
    $query = "DELETE FROM comments WHERE comment_id= {$the_comment_id} ";
    $delete_comment_query = mysqli_query($connection,$query);
    header("Location: comments.php?source=post&p_id={$post_id}");
}

if(isset($_GET['approve'])) {
    $the_comment_id = $_GET['approve'];
    
    $query = "UPDATE comments SET comment_status = 'approved' WHERE comment_id= {$the_comment_id} ";
    $approve_comment_query = mysqli_query($connection,$query);
    header("Location: comments.php?source=post&p_id={$post_id}");
}

if(isset($_GET['unapprove'])) {
    $the_comment_id = $_GET['unapprove'];
    
    $query = "UPDATE comments SET comment_status = 'unapproved' WHERE comment_id= {$the_comment_id} ";
    $unapprove_comment_query = mysqli_query($connection,$query);
    header("Location: comments.php?source=post&p_id={$post_id}");
}

?>