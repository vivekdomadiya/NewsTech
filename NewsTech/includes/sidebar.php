<div class="col-lg-4 col-md-6">

    <!-- title -->
    <div class="title-wrap">
        <div class="title-head">
            <div class="title">
                <h6 class="title-text">Latest Article</h6>
            </div>
        </div>
    </div>

    <?php
        $query = "select * from posts where post_status = 'Published' ORDER BY post_id DESC LIMIT 8";
        $posts = mysqli_query($connection,$query);

        while($row = mysqli_fetch_assoc($posts)) {
            $post_id = $row['post_id'];
            $post_title = $row['post_title'];
            $post_date = $row['post_date'];
            $post_image = $row['post_image'];
            $post_category_id = $row['post_category_id'];
            $post_image_src = "data:image/jpeg;base64,".base64_encode($post_image);

            $post_category = catTitle($post_category_id);

    ?>

    <!-- contant -->
    <div class="row mt-3">
        <div class="col-4">
            <div class="post-thumbnail">
                <a href="/post/<?php echo $post_id; ?>">
                    <img src="<?php echo $post_image_src ?>" alt="<?php echo $post_title;?>" title="<?php echo $post_title;?>" class="img-fluid">
                </a>
            </div>
        </div>
        <div class="col-8">
            <h6 class="post-title-small">
                <a href="/post/<?php echo $post_id; ?>"><?php echo $post_title;?></a><br>
            </h6>
        </div>
        
    </div>
    <!-- /.contant -->

    <?php } ?>

</div>