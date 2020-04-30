<?php include "includes/header.php" ?>
<script src="https://cdn.ckeditor.com/ckeditor5/15.0.0/classic/ckeditor.js"></script>

<!-- Navigation -->
<?php include "includes/navigation.php" ?>

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
            case 'add_post' ;
            include "includes/add_post.php";
            break;
                
            case 'edit_post';
            include "includes/edit_post.php";
            break;
                
            default ; 
            include "includes/view_all_posts.php";
            break;
        }

    ?>
                

<?php include "includes/footer.php" ?>