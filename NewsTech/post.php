<?php include "includes/header.php" ?>

<!-- navigation  bar-->
<?php include "includes/navigation.php" ?>

	<div class="container mt-4">
		<div class="row">

			<!-- contant -->
			<div class="col-lg-8">

				<?php
    
	                if(isset($_GET['p_id']) && !empty($_GET['p_id']))
						$the_post_id = escape($_GET['p_id']);
					else
	                	redirect("PageNotFound");
	                  
	                if(!isLoginRole("admin")) {
                    	$query = "UPDATE posts SET post_views_count = post_views_count + 1 WHERE post_id= $the_post_id";
                    	$update_views_count = mysqli_query($connection,$query);
                    	confirmQuery($update_views_count);
                	}
                    
                    if(isLoginRole("admin")) {
                        $query = "SELECT * FROM posts WHERE post_id = $the_post_id";
                    } else {
                        $query = "SELECT * FROM posts WHERE post_id = $the_post_id AND post_status = 'Published'";
                    }
                    
                    $posts = mysqli_query($connection,$query);
                    confirmQuery($posts);
                    
                    if(mysqli_num_rows($posts) <1){
                        echo "<h1 class='text-center'>No posts available</h1>";
                    } else {

                    $row = mysqli_fetch_assoc($posts);
                    $post_title = $row['post_title'];
                    $post_date = $row['post_date'];
                    $post_content = $row['post_content'];
                    $post_category_id = $row['post_category_id'];

                    $post_category = catTitle($post_category_id);

                ?>

				<!-- Blog Post -->
				<div class="post-header">
					<span class="meta-category">
						<a href="/category/<?php echo $post_category ?>"><?php echo $post_category?></a>
					</span>
					<h2 class="post-title"><strong><?php echo $post_title; ?></strong></h2>
					<p><i class="far fa-clock"></i> <?php echo $post_date; ?></p>
				</div>
				<hr>
				<p class="mr-lg-3"><?php echo $post_content;?></p>
				<hr>
				<!-- ./ Blog Post -->


				<?php
                
	                if(isset($_POST['create_comment'])) {                    
	                    $the_post_id = escape($_GET['p_id']);
	                    $comment_author = escape($_POST['comment_author']);
	                    $comment_email = escape($_POST['comment_email']);
	                    $comment_content = escape($_POST['comment_content']);
	                    
	                    if(!empty($comment_author) && !empty($comment_email) && !empty($comment_content) ) {
	                        $query = "INSERT INTO comments(comment_post_id, comment_author, comment_email, comment_content, comment_date) ";
	                        $query .="VALUES($the_post_id,'$comment_author','$comment_email','$comment_content',now())";

	                        $create_comment_query = mysqli_query($connection,$query);
	                        confirmQuery($create_comment_query);
	                    }
	                }
                
                ?>

				<!-- comment -->
				<div class="card bg-light mb-3">
					<div class="card-header">Leave a Comment:</div>
					<div class="card-body">
						<form action="" method="post" role="form">
							<div class="form-group">
								<lable for="comment_author">Author:</lable>
								 <input type="text" class="form-control" name="comment_author" required>
							 </div>
							 <div class="form-group">
								<lable for="comment_email">Email:</lable>
								 <input type="email" class="form-control" name="comment_email" required>
							 </div>
							 <div class="form-group">
								<lable for="comment_content">Comment:</lable>
								 <textarea class="form-control" rows="3" name="comment_content" required></textarea>
							 </div>
							 <button type="submit" name="create_comment" class="btn btn-primary">Submit</button>
						 </form>
					</div>
				  </div>

				<hr>
				
				<?php
                
	                $query = "SELECT * FROM comments WHERE comment_post_id = $the_post_id ";
	                $query .= "ORDER BY comment_id DESC ";
	                $select_comment_query = mysqli_query($connection,$query);
	                confirmQuery($select_comment_query);
	                
	                while($row = mysqli_fetch_assoc($select_comment_query)) {
	                    $comment_date = $row['comment_date'];
	                    $comment_content = $row['comment_content'];
	                    $comment_author = $row['comment_author'];
                ?> 

				<!-- Posted Comments -->
                
                <div class="media mt-3">
					<img class="mr-3" src="http://placehold.it/64x64" alt="Generic placeholder image">
					<div class="media-body">
						<h5 class="mt-0"><?php echo $comment_author; ?>
                            <small><?php echo $comment_date; ?></small>
                        </h5>
						<?php echo $comment_content; ?>
					</div>
				</div>

			<?php 
				}	}
			                
			?>
				
			</div>
			<!-- /.contant -->

			<!-- side-bar -->
			<?php include "includes/sidebar.php" ?>

		</div>  <!-- /.row -->
	</div>  <!-- /.container -->

<!-- footer -->
<?php include "includes/footer.php" ?>