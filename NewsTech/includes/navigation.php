<nav class="navbar navbar-expand-lg navbar-dark bg-dark">

    <a class="navbar-brand" href="/">NewsTech</a>

    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarToggler"
        aria-controls="navbarToggler" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarToggler">
        <ul class="navbar-nav ml-auto mt-2 mt-lg-0">
                
            <?php
                if(isLoginRole("admin")) {
                    if(isset($_GET['p_id']) && !empty($_GET['p_id'])) {
                        $the_post_id = escape($_GET['p_id']);
                        echo "<li class='nav-item'><a class='nav-link' href='/admin/posts/edit_post/{$the_post_id}'>Edit Post</a></li>";
                    }
                    echo "<li class='nav-item'><a class='nav-link' href='/admin/posts/add_post'>Add Post</a></li>";
                }



                $query = "SELECT * FROM categories";
                $categories = mysqli_query($connection,$query);

                while($row = mysqli_fetch_assoc($categories)) {
                    $cat_title = $row['cat_title'];

                    if( isset($_GET['category']) && $_GET['category'] == $cat_title ) {
                        $catClass = 'active';
                    } else {
                        $catClass = '';
                    }

                    echo "<li class='nav-item  $catClass'><a class='nav-link' href='/category/".urlencode($cat_title)."'>{$cat_title}</a></li>";
                }

                $contClass = '';
                if ( basename($_SERVER['PHP_SELF']) == 'contact.php' ) {
                    $contClass = 'active';
                } 

            ?>

            <li class="nav-item <?php echo $contClass; ?>"><a class="nav-link" href='/contact'>Contact</a></li>

        <?php if(isLoginRole("admin")): ?>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-user"></i> Admin</a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="/admin"><i class="fa fa-fw fa-user"></i> Dashboard</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="includes/logout.php"><i class="fa fa-fw fa-power-off"></i> Log Out</a>
                </div>
            </li>
        <?php endif; ?>
        </ul>

        <form class="form-inline my-2 my-lg-0 ml-lg-5" action="/search" method="GET">
            <input class="form-control mr-sm-2" name="search" type="search" placeholder="Search" aria-label="Search" required>
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
        </form>
    </div>

</nav>