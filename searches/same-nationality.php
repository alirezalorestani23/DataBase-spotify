
<?php
require_once('../load.php');
is_user();
if ($_SERVER['REQUEST_METHOD'] === 'GET') {

  $user = get_user();
  $sql = 'SELECT artist.name as artist_name, album.name as album_name, album.id as album_id, genre
  FROM artist
  JOIN album ON artist.user_id = album.artist_id
  WHERE nationality=(SELECT nationality
    FROM listener
    WHERE user_id = '.$user['id'].'
    LIMIT 1)';
  $res = mysqli_query($conn,$sql);
  $row_num = mysqli_num_rows($res);
  global $response;
  for ($i=0; $i < $row_num ; $i++) {
    $album = mysqli_fetch_assoc($res);
    $response[$i] = array(
      'artist_name' => $album['artist_name'],
      'album_id' => $album['album_id'],
      'album_name' => $album['album_name'],
      'album_genre' => $album['genre']
    );
  }
  response($response);

}
?>
