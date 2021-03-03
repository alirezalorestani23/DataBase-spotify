<?php
require_once('../load.php');
is_user();
  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $d = get_posted_data(array(
        'user_id'

    ));

  $user = get_user();


  if (is_admin()) {
    $sql = 'SELECT * FROM user WHERE id = "'.$d['user_id'].'"';
    $res = mysqli_query($conn,$sql);
    if (mysqli_num_rows($res)>0) {
      $sql = 'DELETE FROM `user` WHERE id = "'.$d['user_id'].'"';
      $res = mysqli_query($conn,$sql);
      response(array(
        'message' => 'user with id "'.$d['user_id'].'" removed successfully!'
      ));
    }
    else{
        errResponse('there is no such user!');
    }
  }
  errResponse('you have no access to this operation!');
  }
 ?>
