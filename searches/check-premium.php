<?php
require_once('../load.php');
is_user();
if ($_SERVER['REQUEST_METHOD'] === 'GET') {

  $user = get_user();
  $today = date("Y-m-d");
  if (is_admin()) {

    $sql = 'SELECT id FROM premium_account WHERE expiration_datetime < NOW()';
    $res = mysqli_query($conn,$sql);
    $row_num = mysqli_num_rows($res);
    if ($row_num>0) {

      $sql = 'DELETE FROM premium_account WHERE expiration_datetime < NOW()';
      $res = mysqli_query($conn,$sql);
      if (mysqli_errno($conn)>0) {
        errResponse(mysqli_error($conn));
      }
      response(array(
        'message' =>''.$row_num.' expired premium users converted to free users successfully! '
      ));
    }
    response(array(
      'message'=>'no expired account found!'
    ));


  }
  else {
    errResponse('permission denied!',403);
  }



}
?>
