<?php include "includes/header.php" ?>

<!-- Navigation -->
<?php include "includes/navigation.php" ?>

    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
                    Welcome to admin
                    <small>Author</small>
                </h1>
                <hr class="mb-5">
                        
                <?php

                    if(isset($_SESSION['username'])) {
                        $username = $_SESSION['username'];
                        
                        $query = "SELECT * FROM users WHERE username = '{$username}' ";
                        $select_user_profile = mysqli_query($connection, $query);
                        
                        while($row = mysqli_fetch_array($select_user_profile)) {
                            $user_id = $row['user_id'];
                            $username = $row['username'];
                            $user_password = $row['user_password'];
                        }
                    }

                    if(isset($_POST['update_profile'])) {
                       
                        $username = escape($_POST['username']);
                        $user_password = escape($_POST['user_password']);

                        $user_password = password_hash($user_password, PASSWORD_BCRYPT, array('cost' => 12));

                        $query = "UPDATE users SET ";
                        $query .= "username = '{$username}', ";
                        $query .= "user_password = '{$user_password}' ";
                        $query .= "WHERE username = '{$_SESSION['username']}' ";
                        
                        $update_user = mysqli_query($connection,$query);
                        confirmQuery($update_user);
                        
                        $_SESSION['username'] = $username;
                        
                        echo "<h5 class='bg-success p-3'>Profile Updated.</h5>";
                    }

                ?>
                        
                        
                <form action="" method="post" enctype="multipart/form-data">

                    <div class="form-group">
                        <lable for="username">Username</lable>
                        <input type="text" class="form-control" name="username"  value="<?php echo $username; ?>">
                    </div>

                    <div class="form-group">
                        <lable for="post_content">Password</lable>
                        <input autocomplete="off" type="password" class="form-control" name="user_password" value="">
                    </div>

                    <div class="form-group">
                        <input type="submit" class="btn btn-primary" name="update_profile" value="Update Profile">
                    </div>

                </form>
                
            </div>
        </div>  <!-- /.row -->

    </div>  <!-- /.container-fluid -->

<!-- footer -->
<?php include "includes/footer.php" ?>