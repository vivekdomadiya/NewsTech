<?php include "includes/header.php" ?>

<?php

if(isset($_POST['submit'])) {

    $email = escape($_POST['email']);
    $subject = escape($_POST['subject']);
    $body = escape($_POST['body']);

    $query = "INSERT INTO contact(contact_email,contact_subject,contact_message,contact_date) VALUES ('{$email}','{$subject}','{$body}',now())";
    $create_contact_query = mysqli_query($connection,$query);
    confirmQuery($create_contact_query);
        
    if($create_contact_query)
        $message = "<h5 class='p-2 text-center bg-success text-light'>Your Registration has been submitted</h5>";
    else
       $message = "<h5 class='p-2 text-center bg-danger text-light'>Somthig went wrong!</h5>";   
} else {
    $message = "";
}

?>
    <!-- Navigation -->
    
    <?php  include "includes/navigation.php"; ?>
    
 
    <!-- Page Content -->
    <div class="container mt-4">
        <div class="row">
            <div class="col-xs-6 col-xs-offset-3 mx-auto">
                    <h1>Contact</h1>
                    <form role="form" action="" method="post" id="contact-form" autocomplete="off">
                       <h6 class="text-center"><?php echo $message; ?></h6>
                        <div class="form-group">
                            <label for="email">Email:</label>
                            <input type="email" name="email" id="email" class="form-control" placeholder="Enter your email" required>
                        </div>
                        <div class="form-group">
                            <label for="subject">Subject:</label>
                            <input type="text" name="subject" id="subject" class="form-control" placeholder="Enter your subject" required>
                        </div>
                        <div class="form-group">
                            <label for="body">Message:</label>
                            <textarea class="form-control" style="resize: none;" name="body" id="body" cols="40" rows="10" required></textarea>
                        </div>
                
                        <input type="submit" name="submit" class="btn btn-success btn-lg btn-block" value="Send Message">
                    </form>
            </div> <!-- /.col-xs-12 -->
        </div> <!-- /.row -->
    </div> <!-- /.container -->



<?php include "includes/footer.php";?>
