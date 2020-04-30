<?php include "includes/header.php" ?>

    <!-- Navigation -->
    <?php include "includes/navigation.php" ?>
    
    <!-- Page Content -->
    <div class="container mt-4">
        <div class="row">
            
            <div class="col-lg-8 text-center">

                <div class="row">

                    <div class="error-title">

                        <header class="entry-header">
                            <h1 class="text-light">404 error: Page not found</h1>
                        </header>   

                        <span><img src="/vender/images/error.png" class="img-fluid"></span>

                    </div>

                    <div class="col-lg-12 col-md-12 mx-auto mt-4">                  
                            <h2 class="entry-title"><b>What is happening?</b></h2>
                            <p class="text-muted">The page that you are looking for does not exist on this website. You may have accidentally mistype the page address, or followed an expired link. Anyway, we will help you get back on track. Why not try to search for the page you were looking for:</p>

                            <!-- search bar -->
                            <div class="card bg-light mb-3">
					            <div class="card-body">
						            <form class="form-inline" action="/search.php" method="get" role="form">
                                        <input type="text" class="form-control form-control-lg w-75" name="search" placeholder="Search For..." required>
                                        <button type="submit" class="btn btn-primary form-control-lg">Submit</button>
						            </form>
					            </div>
				            </div>

                    </div>
                </div>
            </div>

            <!-- Blog Sidebar Widgets Column -->
            
            <?php include "includes/sidebar.php" ?>

        </div>  <!-- /.row -->
    </div>  <!-- ./container -->

<?php include "includes/footer.php" ?>