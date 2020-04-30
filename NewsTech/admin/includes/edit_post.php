<?php

    if(isset($_GET['p_id'])) {
        
        $the_post_id=$_GET['p_id'];
    }
        
    $query = "SELECT * FROM posts WHERE post_id = {$the_post_id}";
    $select_posts_by_id = mysqli_query($connection,$query);
    while($row = mysqli_fetch_assoc($select_posts_by_id)) {
        $post_id = $row['post_id'];
        $post_title = $row['post_title'];
        $post_category_id = $row['post_category_id'];
        $post_status = $row['post_status'];
        $post_image = $row['post_image'];
        $post_tags = $row['post_tags'];
        $post_content = $row['post_content'];
        $post_image_src = "data:image/jpeg;base64,".base64_encode($post_image);
    }

    if(isset($_POST['update_post'])) {
        
        $post_title = $_POST['title'];
        $post_category_id = $_POST['post_category'];
        $post_status = $_POST['post_status'];
        
        $post_tags = $_POST['post_tags'];
        $post_content = $_POST['post_content'];
        
        
        if(empty($_FILES["image"]["tmp_name"])) {
            $query = "UPDATE posts SET ";
            $query .= "post_title = '{$post_title}', ";
            $query .= "post_category_id = {$post_category_id}, ";
            $query .= "post_date = now(), ";
            $query .= "post_status = '{$post_status}', ";
            $query .= "post_title = '{$post_title}', ";
            $query .= "post_content = '{$post_content}' ";
            $query .= "WHERE post_id = {$the_post_id}";
        } else {
            $post_image = addslashes(file_get_contents($_FILES["image"]["tmp_name"]));
            $query = "UPDATE posts SET ";
            $query .= "post_title = '{$post_title}', ";
            $query .= "post_category_id = {$post_category_id}, ";
            $query .= "post_date = now(), ";
            $query .= "post_status = '{$post_status}', ";
            $query .= "post_image = '{$post_image}', ";
            $query .= "post_title = '{$post_title}', ";
            $query .= "post_content = '{$post_content}' ";
            $query .= "WHERE post_id = {$the_post_id}";
        }
        
        $update_post = mysqli_query($connection,$query);
        confirmQuery($update_post);
        
        echo "<h5 class='bg-success text-light p-2'>Post Updated. <a class='text-danger uni' href='/post/{$the_post_id}'>View Post</a> or <a class='text-danger uni' href='/admin/posts'>Edit More Posts</a></h5>";
    }

?>
  
<form action="" method="post" enctype="multipart/form-data">
    
    <div class="form-group">
        <lable for="title">Post Title</lable>
        <input type="text" value="<?php echo $post_title; ?>" class="form-control" name="title">
    </div>
    
    <div class="form-group">
       <lable for="post_user">Category</lable>
        <select name="post_category" id="">
           <?php
            
                $query = "SELECT * FROM categories";
                $select_categories = mysqli_query($connection,$query);
                while($row = mysqli_fetch_assoc($select_categories)) {
                    $cat_id = $row['cat_id'];
                    $cat_title = $row['cat_title'];
                    if($cat_id == $post_category_id) {
                        echo "<option selected value='{$cat_id}'>{$cat_title}</option>";
                    } else {
                        echo "<option value='{$cat_id}'>{$cat_title}</option>";
                    }
                }
            ?>
       </select>
    </div>
    
    <div class="form-group">
        <select name="post_status" id="">
            <option value="<?php echo $post_status; ?>"><?php echo $post_status; ?></option>
            <?php
            
            if($post_status === 'Published') {
                echo "<option value='Draft'>Draft</option>";
            } else {
                echo "<option value='Published'>Published</option>";
            }
            
            ?>
        </select> 
    </div>
    
    <div class="form-group">
        <lable for="image">Post Image</lable>
        <img width="100" src="<?php echo $post_image_src; ?>" alt="image">
        <input type="file" name="image">
    </div>
    
    <div class="form-group">
        <lable for="post_tags">Post Tags</lable>
        <input type="text" value="<?php echo $post_tags; ?>" class="form-control" name="post_tags">
    </div>
    
    <div class="form-group">
        <lable for="post_content">Post Content</lable>
        <textarea class="form-control" name="post_content" id="body" cols="30" rows="10"><?php echo $post_content; ?></textarea>
    </div>
    
    <div class="form-group">
        <input type="submit" class="btn btn-primary" name="update_post" value="Update Post">
    </div>
    
    
</form>


<script>
    ClassicEditor
        .create( document.querySelector( '#body' ) )
        .catch( error => {
            console.error( error );
        } );
</script>