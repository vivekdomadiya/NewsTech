<?php

function escape($string) {
    global $connection;
    return mysqli_real_escape_string($connection, trim($string));
}
function confirmQuery($result) {
    global $connection;
    if(!$result) {
        die("QFAILD ". mysqli_error($connection));
    }
}
function redirect($location) {
    header("Location: " . $location);
    exit;
}
function isMethod($method=null) {
    if($_SERVER['REQUEST_METHOD'] === strtoupper($method))
        return true;
    return false;
}
function isAdmin($username) {
    global $connection;
    $query = "SELECT user_role FROM users WHERE username = '{$username}'";
    $row = mysqli_fetch_array(mysqli_query($connection,$query));
    if($row['user_role'] === 'admin')
        return true;
    return false;
}
function isLoggedIn() {
    if(isset($_SESSION['user_role'])) {
        return true;
    }
    return false;
}
function isLoginRole($role) {
    if(isset($_SESSION['user_role']) && $_SESSION['user_role'] == $role)
        return true;
    return false;
}
function userLogin($username,$password) {
    global $connection;
    $username = escape($username);
    $password = escape($password);
    $query = "SELECT * FROM users WHERE username = '{$username}' ";
    $select_user_query = mysqli_query($connection,$query);
    confirmQuery($select_user_query);

    $row = mysqli_fetch_array($select_user_query);
    $db_id = $row['user_id'];
    $db_user_role = $row['user_role'];
    $db_username = $row['username'];
    $db_user_password = $row['user_password'];
    
    if( password_verify($password, $db_user_password) ) { 
        $_SESSION['username'] = $db_username;
        $_SESSION['user_role'] = $db_user_role;
        
        redirect("/admin");
    } else {
        redirect("/login");
    }
}
function catTitle($cat_id) {
    global $connection;
    $query = "SELECT cat_title FROM categories WHERE cat_id = $cat_id";
    $row = mysqli_query($connection,$query);
    confirmQuery($row);
    return mysqli_fetch_assoc($row)['cat_title'];
}
function catID($cat_title) {
    global $connection;
    $query = "SELECT cat_id FROM categories WHERE cat_title = '$cat_title'";
    $row = mysqli_query($connection,$query);
    confirmQuery($row);
    return mysqli_fetch_assoc($row)['cat_id'];   
}
function pagination($page_count,$page,$link) {
    if($page_count=1)
        return;
    echo '<hr>
        <nav aria-label="Page navigation">
        <ul class="pagination">';

            if($page !=1)
                echo "<li class='page-item'><a class='page-link' href='{$link}/page/".($page-1)."'  aria-label='Previous'><span aria-hidden='true'>&laquo;</span></a></li>";

            for($i=1;$i<=$page_count;$i++) {
                if($i == $page) {
                    echo "<li class='page-item active'><a class='page-link' href='$link/page/$i'>$i</a></li>";
                } else {
                    echo "<li class='page-item'><a class='page-link' href='$link/page/$i'>$i</a></li>";
                }
            }
            if($page != $page_count)
                echo "<li class='page-item'><a class='page-link' href='{$link}/page/".($page+1)."'  aria-label='Next'><span aria-hidden='true'>&raquo;</span></a></li>";

    echo '</ul>
        </nav>';
}

?>