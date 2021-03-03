<?php
require_once('../load.php');
is_user();
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
  if (is_admin()) {
    $sql = 'SELECT artist.user_id,artist.name, COUNT(music.id) as activity
            FROM artist
            JOIN album ON artist.user_id = album.artist_id
            JOIN music ON music.album_id = album.id
            GROUP BY artist.user_id
            ORDER BY activity DESC';

    $res = mysqli_query($conn,$sql);
    $response;
    for ($i=0; $i <mysqli_num_rows($res) ; $i++) {
      $artist = mysqli_fetch_assoc($res);
      $response[$i] = array(
        'artist_id' => $artist['user_id'],
        'name' => $artist['name'],
        'acrivity_rate' => $artist['activity']
      );

    }
    response($response);
  }


}
?>
