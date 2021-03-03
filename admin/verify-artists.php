<?php
require_once('../load.php');
is_user();
if (!is_admin()) {
  errResponse('permission denied!',403);
}
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
  $sql = 'SELECT * FROM artist WHERE is_active=0';
  $res = mysqli_query($conn,$sql);
  for ($i=0; $i <mysqli_num_rows($res) ; $i++) {
    $data[$i] = mysqli_fetch_assoc($res);
  }
  response($data);
}
elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $d = get_posted_data(array(
    'artist_id',
    'verify'
  ));

  if ($d['verify'] == true) {
    $sql = 'UPDATE `artist` SET `is_active`= 1 WHERE user_id = '.$d['artist_id'].' ';
    $res = mysqli_query($conn,$sql);
    if (mysqli_errno($conn)>0) {
      errResponse(mysqli_error($conn));
    }
    response(array(
      'message' => 'artist with id '.$d['artist_id'].' is verified'
    ));
  }
  else {
    $sql = 'DELETE FROM `artist` WHERE user_id = '.$d['artist_id'].'';
    $res = mysqli_query($conn,$sql);
    if (mysqli_errno($conn)>0) {
      errResponse(mysqli_connect_error($conn));
    }
    response(array(
      'message' =>'artist rejected successfully!'
    ));
  }

}

 ?>
