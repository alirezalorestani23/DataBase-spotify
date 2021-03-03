<?php
require_once('../load.php');
is_user();
  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $d = get_posted_data(array(
        'follower_id',
        'followee_id'
    ));




    $sql = 'SELECT `id` FROM user_follow WHERE follower_id="'.$d['follower_id'].'" AND followee_id = "'.$d['followee_id'].'" LIMIT 1';
    $res = mysqli_query($conn, $sql);
    if(mysqli_num_rows($res) > 0){
      echo "unfollow";
      $sql = 'DELETE FROM user_follow WHERE follower_id="'.$d['follower_id'].'" AND followee_id = "'.$d['followee_id'].'"';
      $res = mysqli_query($conn,$sql);
    }
    else {
      $sql = 'INSERT INTO user_follow (`follower_id`,`followee_id`) VALUES ("'.$d['follower_id'].'","'.$d['followee_id'].'")';
      $res = mysqli_query($conn,$sql);

      $sql = 'SELECT `id` FROM user_follow WHERE follower_id="'.$d['follower_id'].'" AND followee_id = "'.$d['followee_id'].'" LIMIT 1';
      $res = mysqli_query($conn, $sql);
      $follow = mysqli_fetch_assoc($res);
      response($follow);

    }
  }
 ?>
