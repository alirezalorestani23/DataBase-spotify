<?php
require_once('../load.php');
is_user();
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (isset($_GET['action'])) {
      if (isset($_GET['user_id'])) {

        $user_id = $_GET['user_id'];
        $action = $_GET['action'];

        if ($action === 'follower') {
          $followers = get_followers($user_id);
          for ($i=0; $i < mysqli_num_rows($followers) ; $i++) {
            $response[$i] = mysqli_fetch_assoc($followers);
          }
          response($response);
        }
        elseif($action === 'following'){
          $followings = get_followings($user_id);
          for ($i=0; $i < mysqli_num_rows($followings) ; $i++) {
            $response[$i] = mysqli_fetch_assoc($followings);
          }
          response($response);
        }
        else {
          errResponse('invalid action!');
        }

      }
      else {
        errResponse('more data is required!');
      }



      $user = get_user();
      $today = date("Y-m-d");

    }

}
?>
