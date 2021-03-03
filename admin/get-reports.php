<?php
require_once('../load.php');
is_user();
if ($_SERVER['REQUEST_METHOD'] === 'GET') {

  $user = get_user();

  if (is_admin()) {
    $sql = 'SELECT * FROM music_report';
    $res = mysqli_query($conn,$sql);
    if (mysqli_num_rows($res)>0) {
      for ($i=0; $i < mysqli_num_rows($res) ; $i++) {
        $data[$i] = mysqli_fetch_assoc($res);
      }
      response($data);
    }
    else {
      errResponse('no music reported!');
    }
    }
    errResponse('you have no access to this operation!');
  }
 ?>
