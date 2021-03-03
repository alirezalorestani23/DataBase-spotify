<?php
require_once('../load.php');
is_user();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $d = get_posted_data(array(
      'card_number',
      'card_expire',
      'expiration_datetime'
  ));

  if (is_listener()) {
      if (is_premium()) {
        errResponse('you are a premium member already!');
      }
      $listener_id = get_listener()['user_id'];
      $sql ='INSERT INTO `premium_account`(`listener_id`, `card_number`, `card_expire`, `expiration_datetime`) VALUES ('.$listener_id.',"'.$d['card_number'].'","'.$d['card_expire'].'","'.$d['expiration_datetime'].'")' ;
      $res = mysqli_query($conn,$sql);
      if (mysqli_errno($conn)>0) {
        errResponse(mysqli_error($conn));
      }
      response(array(
        "message"=>"your account changed to premium successfully!"
      ));
  }
  else {
    errResponse('you are not registered as listener yet!');
  }

}
?>
