
<?php
require_once('../load.php');
is_user();
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
  $res = get_week_popular();
  if (mysqli_errno($conn)>0) {
    errResponse(mysqli_error($conn));
  }
  global $response;
  for ($i=0; $i < mysqli_num_rows($res) ; $i++) {
    $music = mysqli_fetch_assoc($res);
    $response[$i] = array(
      'music_id'=>$music['music_id'],
      'music_name'=>$music['music_name'],
      'rate'=>$music['rate']
    );
  }
  response($response);
}
?>
