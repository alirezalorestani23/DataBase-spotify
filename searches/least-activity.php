<?php
require_once('../load.php');
is_user();
if ($_SERVER['REQUEST_METHOD'] === 'GET') {

  $user = get_user();
  // $sql = 'DELETE FROM `user` WHERE id ='.$user['id'].' ';
  // $res = mysqli_query($conn,$sql);
  // if (mysqli_errno($conn)>0) {
  //   errResponse(mysqli_error($conn));
  // }

  response(array(
    'message' => 'here it is: list of users'
  ));

}
?>
