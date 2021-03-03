<?php
require_once('../load.php');
is_user();
if ($_SERVER['REQUEST_METHOD'] === 'GET') {

  $user = get_user();
  $sql = 'SELECT followee_id FROM `artist` JOIN `user_follow` ON artist.user_id = user_follow.followee_id WHERE user_follow.follower_id='.$user['id'].'';
  $res = mysqli_query($conn,$sql);
  $row_num = mysqli_num_rows($res);
  global $followees;
  for ($i=0; $i <$row_num ; $i++) {
    $followees[$i] = mysqli_fetch_assoc($res);
  }
  global $musics;
  global $response;

  for ($i=0; $i <$row_num ; $i++) {

    $sql = 'SELECT music.name as name, music.id as id
    FROM `music`
    JOIN `album`
    ON music.album_id = album.id
    WHERE artist_id = '.($followees[$i])['followee_id'].'
    ORDER BY music.id DESC
    LIMIT 5';
    $res = mysqli_query($conn,$sql);
    for ($j=0; $j <mysqli_num_rows($res) ; $j++) {
      $music = mysqli_fetch_assoc($res);
      $musics[$j]=array(
        'music_id'=> $music['name'],
        'music_name'=>$music['id']
      );
    }

    $response[$i] = array(
      'artist_id'=>($followees[$i])['followee_id'],
      'latest_musics'=>$musics
    );

  }
  response($response);

}
?>
