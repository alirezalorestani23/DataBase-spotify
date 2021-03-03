<?php
require_once('../load.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $d = get_posted_data(array(
        'username',
        'password'
    ));


    $sql = 'SELECT `id`, `username`,`password` FROM user WHERE username="'.$d['username'].'" LIMIT 1';
    $res = mysqli_query($conn, $sql);
    if(mysqli_num_rows($res) > 0){
        $user = mysqli_fetch_assoc($res);
        if ($user['password'] == md5($d['password'])) {
          $_SESSION['user_id'] = $user['id'];
          response($user);
        }
        errResponse("wrong password.");
    }
}
 ?>
