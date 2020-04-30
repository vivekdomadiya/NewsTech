<?php include "includes/header.php" ?>
<?php include "functions.php" ?>
<?php include "delete_modal.php"; ?>


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

                <div class="col-xs-6">
                   
                    <?php insert_categories(); ?>
                       
                    <form action="" method="post">
                        <div class="form-group">
                            <lable for="cat_title">Add Category</lable>
                            <input class="form-control" type="text" name="cat_title">
                        </div>
                        <div class="form-group">
                            <input class="btn btn-primary" type="submit" name="submit" value="Add Category">
                        </div>
                    </form>
                        
                    <?php
                        if(isset($_GET['edit'])) {
                            $cat_id = $_GET['edit'];
                            include "includes/update_categories.php";
                        }    
                    ?>
                    
                </div> <!--    Add category form-->

                
                <div class="col-xs-6">
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Category Title</th>
                                <th>Edit</th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                         
                          <?php findAllCatefories(); ?>
                          <?php deleteCategories(); ?>
                          
                        </tbody>
                    </table>
                </div>
                
            </div>
        </div>
        <!-- /.row -->

    </div>
    <!-- /.container-fluid -->

<!-- footer -->
<?php include "includes/footer.php" ?>