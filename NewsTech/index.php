<?php include "includes/header.php" ?>

<!-- navigation bar-->
<?php include "includes/navigation.php" ?>	

	<div class="container mt-4">
		<div class="row">

			<!-- Page Contant -->
			<div class="col-lg-8">

				<?php
					$per_page = 12;
					if(isset($_GET['page'])) {
						$page = escape($_GET['page']);
					} else {
						$page = 1;
					}

					if($page == 1) {
						$page_1=0;
					} else {
						$page_1 = ($page * $per_page ) - $per_page;
					}

					if(isLoginRole("admin")) {
						$query = "select * from posts";
					} else {
						$query = "SELECT * FROM posts WHERE post_status = 'Published'";
					}

					$select_all_posts = mysqli_query($connection,$query);
					$post_count = mysqli_num_rows($select_all_posts);

					if($post_count < 1) {
						echo "<h1 class='text-center'>No posts available</h1>";
					} else {
						$page_count = ceil($post_count /$per_page);
                    	if($page > $page_count)
                        	redirect("PageNotFound");
				?>

				<!-- title -->
				<div class="title-wrap">
					<div class="title-head">
						<div class="title">
							<h6 class="title-text">Most Popular</h6>
						</div>
					</div>
				</div>

				<!-- Posts List -->
				<div class="row">

					<?php
						$query.=" ORDER BY post_id DESC LIMIT $page_1,$per_page";
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

					<div class="col-sm-4">
						<div class="post-thumbnail">
							<a href="/post/<?php echo $post_id; ?>">
								<img src="<?php echo $post_image_src ?>" alt="<?php echo $post_title;?>" title="<?php echo $post_title;?>" class="img-fluid">
							</a>
						</div>
						<div class="post-header">
							<span class="meta-category">
								<a href="/category/<?php echo $post_category ?>"><?php echo $post_category ?></a>
							</span>
							<h5 class="post-title">
								<a href="/post/<?php echo $post_id; ?>"><?php echo $post_title;?></a><br>
								<span class="post-time"><i class="far fa-clock"></i> <?php echo $post_date; ?></span>
							</h5>
						</div>
					</div>

					<?php } ?>

				</div>	<!-- /.row -->
				<!-- /.Posts List -->

				
		        <!-- pager -->
				<?php pagination($page_count,$page,""); ?>

				<?php } ?>
			</div>
			<!-- /.Page Contant -->

			<!-- side-bar -->
			<?php include "includes/sidebar.php" ?>

		</div>  <!-- /.row -->
	</div>  <!-- /.container -->


<!-- footer -->
<?php include "includes/footer.php" ?>