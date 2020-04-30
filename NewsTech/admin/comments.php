<?php include "includes/header.php" ?>

<!-- Navigation -->
<?php include "includes/navigation.php" ?>

    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
                    Welcome to admin
                    <small>WhatUWant</small>
                </h1>
                <hr class="mb-5">

                <?php
                
                    if(isset($_GET['source'])) {
                        $source = $_GET['source'];
                    } else {
                        $source = '';
                    }
                    
                    switch($source) {
                        case 'post' :
                        include "includes/post_comments.php";
                        break;
                            
                        case 'edit_post':
                        include "includes/edit_post.php";
                        break;
                            
                        default :
                        include "includes/view_all_comments.php";
                        break;
                    }

                ?>
                
            </div>
        </div>
        <!-- /.row -->

    </div>
    <!-- /.container-fluid -->

<!-- footer -->
<?php include "includes/footer.php" ?>