<?php include "includes/header.php" ?>

<!-- navigation  bar-->
<?php include "includes/navigation.php" ?>  

    <div class="container mt-4">
        <div class="row">

            <!-- contant -->
            <div class="col-lg-8">

                <?php    
                    if(isset($_GET['search']) && !empty($_GET['search']))
                        $search = escape($_GET['search']);
                    else
                        redirect("PageNotFound");
                        
                    $query = "SELECT * FROM posts WHERE (post_tags LIKE '%$search%' OR post_title LIKE '%$search%') AND post_status = 'Published' ORDER BY post_id DESC";

                    $search_query = mysqli_query($connection,$query);
                    confirmQuery($search_query);
                    $post_count = mysqli_num_rows($search_query);
                    
                ?>

                <!-- title -->
                <div class="title-wrap">
                    <div class="title-head">
                        <div class="title">
                            <h6 class="title-text">SEARCH RESULTS FOR - <?php echo $search; ?></h6>
                        </div>
                    </div>
                </div>

                <!-- search bar -->
                <div class="card bg-light mb-3">
					<div class="card-body">
						<form class="form-inline" action="/search" method="get" role="form">
                            <input type="text" class="form-control form-control-lg w-75" name="search" placeholder="Search For..." required>
                            <button type="submit" class="btn btn-primary form-control-lg">Submit</button>
						 </form>
					</div>
				</div>

                <?php
                    if($post_count < 1 ) {
                        echo "<h1 class='text-center mt-4'> NO RESULT FOUND!!! </h1>";
                    } else {
                ?>

                <!-- page-contant -->
                <div class="row">

                <?php
                    while($row = mysqli_fetch_assoc($search_query)) {
                        $post_id = $row['post_id'];
                        $post_title = $row['post_title'];
                        $post_date = $row['post_date'];
                        $post_image = $row['post_image'];
                        $post_image_src = "data:image/jpeg;base64,".base64_encode($post_image);

                        $post_category = catTitle($row['post_category_id']);
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

                </div>

            
                <!-- /.page-contant -->

                <?php } ?>                

            </div>  <!-- /.contant -->

            <!-- side-bar -->
            <?php include "includes/sidebar.php" ?>

        </div>  <!-- /.row -->
    </div>  <!-- /.container -->


<!-- footer -->
<?php include "includes/footer.php" ?>