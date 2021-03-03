<?php
require_once('../load.php');
is_user();
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $user = get_user();
    $today = date("Y-m-d");
    if (is_artist()) {
      // best listeners of artist
      $sql = 'SELECT listener.user_id as listener_id, CONCAT(listener.first_name," ", listener.last_name) as listener_name, COUNT(music_play.id) as rate
      FROM listener
      INNER JOIN music_play
      ON listener.user_id=music_play.listener_id
      JOIN music
      ON music_play.music_id=music.id
      JOIN album
      ON music.album_id=album.id
      JOIN artist
      ON album.artist_id=artist.user_id
      WHERE artist.user_id = '.$user['id'].'
      GROUP BY listener.user_id
      HAVING COUNT(music_play.id) > 10';
      $res = mysqli_query($conn,$sql);
      global $response;
      for ($i=0; $i <mysqli_num_rows($res) ; $i++) {
        $fan = mysqli_fetch_assoc($res);
        $response[$i] = array(
          'user_id' => $fan['listener_id'],
          'listener_name' => $fan['listener_name'],
          'fan_rate' => $fan['rate']
        );

      }
      response($response);

    }
    else {
      errResponse('first login as artist!');
    }

}
?>
