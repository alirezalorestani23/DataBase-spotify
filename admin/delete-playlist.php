<?php
require_once('../load.php');
is_user();
  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $d = get_posted_data(array(
        'playlist_id'
    ));

  $user = get_user();

  if (is_admin()) {
    $sql = 'SELECT * FROM playlist WHERE id = "'.$d['playlist_id'].'"';
    $res = mysqli_query($conn,$sql);
    if (mysqli_num_rows($res)>0) {
      $sql = 'DELETE FROM `playlist` WHERE id = "'.$d['playlist_id'].'"';
      $res = mysqli_query($conn,$sql);
      response(array(
        'message' => 'playlist with id "'.$d['playlist_id'].'" removed successfully!'
      ));
    }
    else {
      errResponse('no such playlist!');
    }
  }
  errResponse('you have no access to this operation!');
  }
 ?>
