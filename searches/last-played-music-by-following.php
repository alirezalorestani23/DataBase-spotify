<?php
require_once('../load.php');
is_user();
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
  $user = get_user();
  $today = date("Y-m-d");

  $followings = get_followings($user['id']);


  global $response;
  for ($i=0; $i < mysqli_num_rows($followings); $i++) {
    $followee = mysqli_fetch_assoc($followings);
    $last_played_music = get_last_played_music($followee['followee_id']);
    $response[$i] = array(
      'followee_id'=>$followee['followee_id'],
      'last_played_music'=>$last_played_music
    );
  }

  response($response);

}
function get_last_played_music($user_id){
  global $conn;
  $sql = 'SELECT music_id FROM `music_play` WHERE listener_id ='.$user_id.' ORDER by id DESC LIMIT 1';
  $res = mysqli_query($conn,$sql);
  if (mysqli_num_rows($res)>0) {
    $music_id = mysqli_fetch_assoc($res);
    return (mysqli_fetch_assoc(get_music_by_id($music_id['music_id'])))['name'];
  }
  return  null;
}
?>
