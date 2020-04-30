<?php

    if(isset($_POST['create_post'])) {
        $post_title = escape($_POST['title']);
        $post_category_id = escape($_POST['post_category']);
        $post_status = $_POST['post_status'];
        
        $post_image = addslashes(file_get_contents($_FILES["image"]["tmp_name"]));
        
        $post_tags = $_POST['post_tags'];
        $post_content = $_POST['post_content'];
        $post_date = date('d-m-y');
        
        
        
        $query = "INSERT INTO posts(post_category_id, post_title, post_date, post_image, post_content, post_tags, post_status) ";
        
        $query .= "VALUES({$post_category_id},'{$post_title}', now(),'{$post_image}','{$post_content}','{$post_tags}','$post_status')";
        
        $create_post_query = mysqli_query($connection,$query);
        confirmQuery($create_post_query);
        
        $the_post_id = mysqli_insert_id($connection);
        
        echo "<h5 class='bg-success text-light p-2'>Post Created. <a class='text-danger uni' href='/post/{$the_post_id}'>View Post</a> or <a class='text-danger uni' href='/admin/posts'>View All Posts</a></h5>";
        
    }
?>

  
<div class="row">
    <div class="col-lg-8">
        <form action="" method="post" enctype="multipart/form-data">
            
            <div class="form-group">
                <lable for="title">Post Title</lable>
                <input type="text" class="form-control" name="title" required>
            </div>
            
            <div class="form-group">
                <lable for="post_category">Category</lable>
                <select name="post_category" class="form-control" required>
                    <option disabled hidden selected>Category</option>
                   <?php
                    
                        $query = "SELECT * FROM categories";
                        $select_categories = mysqli_query($connection,$query);
                        while($row = mysqli_fetch_assoc($select_categories)) {
                            $cat_id = $row['cat_id'];
                            $cat_title = $row['cat_title'];
                            
                            echo "<option value='{$cat_id}'>{$cat_title}</option>";
                        }
                    ?>
                </select>
            </div>
            
            <div class="form-group">
                <label for="post_status">Post Status</label>
                <select name="post_status" class="form-control" id="" required>
                    <option disabled hidden selected>Post Status</option>
                    <option value='Draft'>Draft</option>
                    <option value='Published'>Published</option>
                </select>
            </div>
            
            <div class="form-group">
                <lable for="image">Post Image</lable>
                <input type="file" name="image" required>
            </div>
            
            <div class="form-group">
                <lable for="post_tags">Post Tags</lable>
                <input type="text" class="form-control" name="post_tags" required>
            </div>
            
            <div class="form-group">
                <lable for="post_content">Post Content</lable>
                <textarea class="form-control" name="post_content" id="body" cols="30" rows="20"></textarea>
            </div>
            
            <div class="form-group">
                <input type="submit" class="btn btn-primary" name="create_post" value="Publish Post">
            </div>
        </form>
    </div>
</div>

<script>
    ClassicEditor
        .create( document.querySelector( '#body' ) )
        .catch( error => {
            console.error( error );
        } );
</script>