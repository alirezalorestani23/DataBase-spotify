<?php
require_once('../load.php');
is_user();
  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $d = get_posted_data(array(
        'album_id'

    ));

  $user = get_user();



  if (is_admin()) {
    $sql = 'SELECT * FROM album WHERE id = "'.$d['album_id'].'"';
    $res = mysqli_query($conn,$sql);
    if (mysqli_num_rows($res)>0) {
      $sql = 'DELETE FROM `album` WHERE id='.$d['album_id'];
      $res = mysqli_query($conn,$sql);
      response(array(
        'message' => 'album with id "'.$d['album_id'].'" removed successfully!'
      ));
    }
    else {
      errResponse('there is no such album!');
    }

  }
  errResponse('you have no access to this operation!');
  }
 ?>
