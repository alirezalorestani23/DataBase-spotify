<?php
require_once('../load.php');
if (!is_listener()) {
  errResponse('you are not registered as listener!',403);
}
$today = date("Y-m-d");
$listener = get_listener();
$listener_id = $listener['user_id'];
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
  if (isset($_GET['music_id'])) {
    $music_id = $_GET['music_id'];
    $sql = 'SELECT * FROM music WHERE id = '.$music_id.'';
    $res = mysqli_query($conn,$sql);
    if (mysqli_num_rows($res)<1) {
      errResponse('music not found!');
    }


    if (is_premium()) {
      $sql = 'INSERT INTO music_play (listener_id, music_id, datetime) VALUES('.$listener_id.', '.$music_id.', "'.$today.'")';
      $res = mysqli_query($conn, $sql);
      response(array(
        'id' => $music_id
      ));
    }
    else {
      $sql = 'SELECT COUNT(*) as num FROM music_play WHERE listener_id = "'.$listener_id.'" AND datetime LIKE "'.$today.'"' ;
      $res = mysqli_query($conn,$sql);
      $row_num = mysqli_fetch_assoc($res);
      $count = $row_num['num'];

      if ($count<5) {
          $sql = 'INSERT INTO music_play (listener_id, music_id, datetime) VALUES('.$listener_id.', '.$music_id.', "'.$today.'")';
          $res = mysqli_query($conn, $sql);
          response(array(
            'id' => $music_id
          ));
      }
      else {
          errResponse("you have reached the maximum number of plays in a day");
      }

    }
  }
  else {
    errResponse('music_id is required!');
  }
}
?>
