<?php
require_once('load.php');
// $_SESSION['user_id'] = 1;
print_r(mysqli_fetch_assoc(get_week_popular()));
// print_r($conn);
// is_admin();
// echo is_verified();
?>
